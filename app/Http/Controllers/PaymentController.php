<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Order;

class PaymentController extends Controller
{
    public function getSnapToken(Request $request)
    {
        $order = Order::with('user')->findOrFail($request->order_id);

        // Konfigurasi Midtrans
        \Midtrans\Config::$serverKey     = config('midtrans.server_key');
        \Midtrans\Config::$isProduction  = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized   = config('midtrans.is_sanitized');
        \Midtrans\Config::$is3ds         = config('midtrans.is_3ds');

        // Sanitize gross amount (hindari "1.200.000" jadi 1)
        $grossAmount = (int) preg_replace('/[^\d]/', '', (string) $order->budget);
        if ($grossAmount < 1) {
            Log::warning('Invalid gross_amount for order '.$order->id.': '.$order->budget);
            return response()->json(['message' => 'Invalid amount'], 422);
        }

        $midtransOrderId = 'ORDER-'.$order->id.'-'.time();
        $order->midtrans_order_id = $midtransOrderId; // pastikan kolom ada di DB
        $order->save();

        $params = [
            'transaction_details' => [
                'order_id'      => $midtransOrderId,
                'gross_amount'  => $grossAmount,
            ],
            'customer_details' => [
                'first_name' => $order->user->name,
                'email'      => $order->user->email,
                'phone'      => $order->user->phone,
            ],
            // (opsional) biar setelah bayar diarahkan ke halaman kamu
            'callbacks' => [
                'finish' => url('/order/'.$order->id),
            ],
            // (opsional) item_details kalau mau
            // 'item_details' => [...]
        ];

        try {
            $snapToken = \Midtrans\Snap::getSnapToken($params);
            Log::info('Snap token OK', ['order_id' => $midtransOrderId]);
            return response()->json(['token' => $snapToken]);
        } catch (\Throwable $e) {
            Log::error('Snap token error: '.$e->getMessage(), ['order_id' => $midtransOrderId]);
            return response()->json(['message' => 'Snap error'], 500);
        }
    }

    public function handleWebhook(Request $request)
    {
        Log::info('Webhook received', $request->all());

        $serverKey = config('midtrans.server_key');

        // Validasi signature key
        $raw = $request->order_id . $request->status_code . $request->gross_amount . $serverKey;
        $calcSignature = hash('sha512', $raw);

        if (!hash_equals($calcSignature, (string) $request->signature_key)) {
            Log::warning('Invalid signature for order_id: '.$request->order_id);
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        // Cari order berdasarkan midtrans_order_id (lebih robust)
        $order = Order::where('midtrans_order_id', $request->order_id)->first();

        // Fallback: kalau belum ada kolom/isinya kosong, coba parse ID lama "ORDER-{id}-timestamp"
        if (!$order && strpos($request->order_id, 'ORDER-') === 0) {
            $parts = explode('-', $request->order_id);
            $id = $parts[1] ?? null;
            if ($id) {
                $order = Order::find($id);
            }
        }

        if (!$order) {
            Log::warning('Order not found for order_id: '.$request->order_id);
            return response()->json(['message' => 'Order not found'], 404);
        }

        $trx = strtolower($request->transaction_status);

        // Map status midtrans -> status internal
        switch ($trx) {
            case 'capture':
            case 'settlement':
                // ✅ Setelah bayar jadi "menunggu konfirmasi"
                $order->status = 'menunggu konfirmasi';
                break;

            case 'pending':
                $order->status = 'menunggu pembayaran';
                break;

            case 'deny':
            case 'cancel':
            case 'expire':
                $order->status = 'ditolak';
                break;

            default:
                // status lain biarkan apa adanya supaya tidak aneh
                Log::info("Unhandled transaction_status: {$trx} for order {$order->id}");
                break;
        }

        $order->save();

        Log::info("Order {$order->id} updated by webhook to status: {$order->status}");

        return response()->json(['message' => 'OK']);
    }

}
