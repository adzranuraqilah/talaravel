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
    public function getSnapToken(Request $request)
    {
        $order = Order::with('user')->findOrFail($request->order_id);

        Config::$serverKey    = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized  = config('midtrans.is_sanitized');
        Config::$is3ds        = config('midtrans.is_3ds');

        $midtransOrderId = 'ORDER-' . $order->id . '-' . time();

        $order->midtrans_order_id = $midtransOrderId;
        $order->save();

        $params = [
            'transaction_details' => [
                'order_id'      => $midtransOrderId,
                'gross_amount'  => (int) $order->budget,
            ],
            'customer_details'    => [
                'first_name' => $order->user->name,
                'email'      => $order->user->email,
                'phone'      => $order->user->phone,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);
        return response()->json(['token' => $snapToken]);
    }

    public function handleWebhook(Request $request)
    {
        Log::info('Midtrans Webhook received', $request->all());

        $serverKey = config('midtrans.server_key');

        // Validasi signature
        $expected = hash('sha512',
            $request->order_id .
            $request->status_code .
            $request->gross_amount .
            $serverKey
        );

        if (!hash_equals($expected, (string) $request->signature_key)) {
            Log::warning('Invalid signature for order_id: ' . $request->order_id);
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        // Ambil ID aplikasi kita dari order_id Midtrans (ORDER-{id}-{timestamp})
        $id = explode('-', (string) $request->order_id)[1] ?? null;
        if (!$id) {
            Log::warning('Cannot parse app order id from: ' . $request->order_id);
            return response()->json(['message' => 'Invalid order id'], 422);
        }

        $order = Order::find($id);
        if (!$order) {
            Log::warning('Order not found for id: ' . $id);
            return response()->json(['message' => 'Order not found'], 404);
        }

        // Ubah status saat settle/capture
        if (in_array($request->transaction_status, ['settlement', 'capture'])) {
            $order->status = 'diproses';
            $order->save();

            // Buat jadwal produksi kalau belum ada
            $existing = \App\Models\Produksi::where('order_id', $order->id)->first();
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
        }

        return response()->json(['message' => 'OK']);
    }
}
