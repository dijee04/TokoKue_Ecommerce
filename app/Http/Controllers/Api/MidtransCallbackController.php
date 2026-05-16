<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Midtrans\Config;
use Midtrans\Notification;

class MidtransCallbackController extends Controller
{
    public function callback(Request $request)
    {
        // Konfigurasi midtrans
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Instance midtrans notification
        $notification = new Notification();

        $transaction = $notification->transaction_status;
        $type = $notification->payment_type;
        $order_id = $notification->order_id;
        $fraud = $notification->fraud_status;

        // Cari transaksi berdasarkan ID, catatan: order_id dari midtrans biasanya format 'ORDER-123', kita filter angkanya saja
        $orderIdDb = str_replace('ORDER-', '', $order_id);
        $order = Order::find($orderIdDb);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        // Handle notification status
        if ($transaction == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $order->payment_status = 'pending';
                } else {
                    $order->payment_status = 'paid';
                }
            }
        } else if ($transaction == 'settlement') {
            $order->payment_status = 'paid';
        } else if ($transaction == 'pending') {
            $order->payment_status = 'pending';
        } else if ($transaction == 'deny') {
            $order->payment_status = 'failed';
        } else if ($transaction == 'expire') {
            $order->payment_status = 'expired';
        } else if ($transaction == 'cancel') {
            $order->payment_status = 'failed';
        }

        $order->save();

        return response()->json(['message' => 'Callback received successfully']);
    }
}
