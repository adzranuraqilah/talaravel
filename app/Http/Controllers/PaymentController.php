<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Order;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function getSnapToken(Request $request)
    {
        $order = Order::with('user')->findOrFail($request->order_id);

        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized = config('midtrans.is_sanitized');
        \Midtrans\Config::$is3ds = config('midtrans.is_3ds');

        $midtransOrderId = 'ORDER-' . $order->id . '-' . time();

        // ✅ Simpan ke kolom midtrans_order_id
        $order->midtrans_order_id = $midtransOrderId;
        $order->save();

        $params = [
            'transaction_details' => [
                'order_id' => $midtransOrderId,
                'gross_amount' => (int) $order->budget,
            ],
            'customer_details' => [
                'first_name' => $order->user->name,
                'email' => $order->user->email,
                'phone' => $order->user->phone,
            ],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return response()->json(['token' => $snapToken]);
    }

            public function handleWebhook(Request $request)
    {
        Log::info('Webhook received:', $request->all());

        $serverKey = config('midtrans.server_key');

        $signature = hash('sha512',
            $request->order_id .
            $request->status_code .
            $request->gross_amount .
            $serverKey
        );

        if ($signature !== $request->signature_key) {
            Log::warning('Invalid signature for order_id: ' . $request->order_id);
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        // Ambil ID dari order_id
        $id = explode('-', $request->order_id)[1] ?? null;
        $order = Order::find($id);

        if (!$order) {
            Log::warning('Order not found: ' . $request->order_id);
            return response()->json(['message' => 'Order not found'], 404);
        }

        if (in_array($request->transaction_status, ['settlement', 'capture'])) {
            $order->status = 'selesai';
            $order->save();

            Log::info("Order {$order->id} status updated to dibayar.");
        }

        return response()->json(['message' => 'Webhook handled']);
    }



}
