<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Order;
use App\Models\Produksi;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class PaymentController extends Controller
{
    /**
     * Ambil Snap Token untuk sebuah order.
     * Menyimpan midtrans_order_id ke tabel orders (ORDER-{orderId}-{timestamp})
     */
    public function getSnapToken(Request $request)
    {
        $order = Order::with('user')->findOrFail($request->order_id);

        // Konfigurasi Midtrans
        Config::$serverKey    = (string) config('midtrans.server_key');
        Config::$isProduction = (bool)  config('midtrans.is_production', false);
        Config::$isSanitized  = (bool)  config('midtrans.is_sanitized', true);
        Config::$is3ds        = (bool)  config('midtrans.is_3ds', true);

        // Buat order id khusus Midtrans (unik)
        $midtransOrderId = 'ORDER-' . $order->id . '-' . time();
        $order->midtrans_order_id = $midtransOrderId;

        // (Opsional) kalau mau, saat user klik bayar, tandai status lokal jadi "menunggu pembayaran"
        // if ($order->status !== 'diproses' && $order->status !== 'selesai') {
        //     $order->status = 'menunggu pembayaran';
        // }

        $order->save();

        // Payload dasar Snap
        $params = [
            'transaction_details' => [
                'order_id'     => $midtransOrderId,
                'gross_amount' => (int) $order->budget,
            ],
            'customer_details'    => [
                'first_name' => $order->user->name,
                'email'      => $order->user->email,
                'phone'      => $order->user->phone,
            ],
            // 'callbacks' => [
            //     'finish' => url('/order/'.$order->id), // opsional
            // ],
        ];

        $snapToken = Snap::getSnapToken($params);
        return response()->json(['token' => $snapToken]);
    }

    /**
     * Webhook/HTTP Notification dari Midtrans.
     * - Validasi signature
     * - Tarik id order aplikasi dari ORDER-{id}-{timestamp}
     * - Simpan ringkasan metode bayar ke orders.payment_info (JSON)
     * - Update orders.midtrans_tx_status (status terakhir Midtrans)
     * - Kalau settlement/capture: update order->status = 'diproses' dan buat Produksi bila belum ada
     */
    public function handleWebhook(Request $request)
    {
        $payload = $request->all();
        Log::info('Midtrans Webhook received', $payload);

        $serverKey = (string) config('midtrans.server_key');

        // --- Validasi signature ---
        $orderId     = (string) ($payload['order_id']     ?? '');
        $statusCode  = (string) ($payload['status_code']  ?? '');
        $grossAmount = (string) ($payload['gross_amount'] ?? '');
        $signature   = (string) ($payload['signature_key'] ?? '');

        $expected = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);

        if (!hash_equals($expected, $signature)) {
            Log::warning('Invalid signature for order_id: ' . $orderId);
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        // --- Ambil ID aplikasi dari order_id Midtrans: ORDER-{id}-{timestamp}
        $appId = explode('-', $orderId)[1] ?? null;
        if (!$appId) {
            Log::warning('Cannot parse app order id from: ' . $orderId);
            return response()->json(['message' => 'Invalid order id'], 422);
        }

        $order = Order::find($appId);
        if (!$order) {
            Log::warning('Order not found for id: ' . $appId);
            return response()->json(['message' => 'Order not found'], 404);
        }

        // --- Ringkasan metode bayar (DISIMPAN DI orders.payment_info) ---
        $paymentType = $payload['payment_type'] ?? null;
        $channel     = $paymentType;
        $bank = $store = $va = $billKey = $billerCode = $paycode = null;

        // Bank Transfer VA (BCA/BNI/BRI/CIMB) & Permata khusus
        if ($paymentType === 'bank_transfer') {
            if (!empty($payload['va_numbers'][0]['va_number'])) {
                $va   = $payload['va_numbers'][0]['va_number'];
                $bank = $payload['va_numbers'][0]['bank'] ?? null;
                $channel = strtolower(($bank ?? 'unknown') . '_va'); // contoh: bca_va
            } elseif (!empty($payload['permata_va_number'])) {
                $va = $payload['permata_va_number'];
                $bank = 'permata';
                $channel = 'permata_va';
            }
        }
        // Mandiri e-Channel
        elseif ($paymentType === 'echannel') {
            $billKey    = $payload['bill_key']    ?? null;
            $billerCode = $payload['biller_code'] ?? null;
            $channel    = 'mandiri_bill';
        }
        // Convenience Store
        elseif ($paymentType === 'cstore') {
            $store   = $payload['store'] ?? null;
            $paycode = $payload['payment_code'] ?? null;
            $channel = strtolower($store ?? 'cstore'); // indomaret / alfamart
        }
        // Kartu
        elseif ($paymentType === 'credit_card') {
            $channel = 'cc_' . strtolower($payload['card_type'] ?? 'credit'); // cc_credit / cc_debit
        }
        // e-wallet (gopay/shopeepay) & qris: channel = payment_type apa adanya

        // Simpan ringkasan (MASKING: VA last4, kartu sudah masked oleh Midtrans)
        $order->payment_info = [
            'payment_type'     => $paymentType,
            'channel'          => $channel,
            'bank'             => $bank,
            'store'            => $store,
            'va_last4'         => $va ? substr($va, -4) : null,
            'payment_code'     => $paycode,
            'bill_key'         => $billKey,
            'biller_code'      => $billerCode,
            'masked_card'      => $payload['masked_card'] ?? null,
            'card_type'        => $payload['card_type']   ?? null,
            'issuer'           => $payload['issuer']      ?? null,
            'acquirer'         => $payload['acquirer']    ?? null,
            'transaction_time' => $payload['transaction_time'] ?? null,
            'settlement_time'  => $payload['settlement_time']  ?? null,
        ];

        // Simpan status transaksi Midtrans terakhir (buat ditampilkan cepat di UI)
        $order->midtrans_tx_status = $payload['transaction_status'] ?? null;

        // --- Update status Order lokal bila perlu ---
        $txStatus = $payload['transaction_status'] ?? null;

        if (in_array($txStatus, ['settlement', 'capture'])) {
            // kalau kartu, capture bisa "challenge"; di sini kita anggap sukses sesuai flow kamu
            $order->status = 'diproses';
            $order->save();

            // Buat jadwal produksi kalau belum ada
            $existing = Produksi::where('order_id', $order->id)->first();
            if (!$existing) {
                $tanggalMulai   = Carbon::now();
                $tanggalSelesai = $order->tenggat ? Carbon::parse($order->tenggat) : Carbon::now()->addDays(7);

                Produksi::create([
                    'nama_produksi'   => 'Produksi ' . ($order->nama_proyek ?? 'Pesanan #' . $order->id),
                    'order_id'        => $order->id,
                    'status'          => 'terjadwal',
                    'tanggal_mulai'   => $tanggalMulai->format('Y-m-d'),
                    'tanggal_selesai' => $tanggalSelesai->format('Y-m-d'),
                ]);
            }

            Log::info("Order {$order->id} updated to 'diproses' and produksi ensured.");
        } else {
            // Simpan perubahan non-settlement (pending/expire/cancel/deny) tanpa mengubah status produksi
            $order->save();

            // Contoh (opsional):
            // if ($txStatus === 'pending') { $order->status = 'menunggu pembayaran'; }
            // if (in_array($txStatus, ['expire','cancel','deny'])) { $order->status = 'ditolak'; }
            // $order->save();
        }

        return response()->json(['message' => 'OK']);
    }
}
