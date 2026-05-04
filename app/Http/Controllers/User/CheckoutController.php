<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        // Konfigurasi Midtrans
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $items = $request->input('items', []);
        $total = $request->input('total', 0);
        $customerDetails = $request->input('customer', [
            'first_name' => 'Guest',
            'email' => 'guest@example.com',
            'phone' => '081234567890',
        ]);

        $orderId = 'TRX-' . time() . '-' . Str::random(5);

        // Map items for midtrans
        $itemDetails = [];
        foreach ($items as $item) {
            $itemDetails[] = [
                'id'       => $item['id'],
                'price'    => $item['price'],
                'quantity' => $item['quantity'],
                'name'     => substr($item['name'], 0, 50) // Midtrans limits item name length
            ];
        }

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $total,
            ],
            'item_details' => $itemDetails,
            'customer_details' => $customerDetails,
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            return response()->json(['snapToken' => $snapToken, 'orderId' => $orderId]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
