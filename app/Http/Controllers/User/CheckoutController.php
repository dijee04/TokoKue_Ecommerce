<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'no_wa' => 'required|string|max:20',
            'alamat' => 'required|string',
            'items' => 'required|json',
            'total_harga' => 'required|numeric'
        ]);

        $items = json_decode($request->items, true);
        if (empty($items)) {
            return response()->json(['success' => false, 'message' => 'Keranjang kosong']);
        }

        try {
            DB::beginTransaction();

            $order = Order::create([
                'user_id' => auth()->id(),
                'nama_pelanggan' => $request->nama_pelanggan,
                'no_wa' => $request->no_wa,
                'alamat' => $request->alamat,
                'metode_pembayaran' => 'Midtrans',
                'total_harga' => $request->total_harga,
                'status' => 'baru'
            ]);

            foreach ($items as $item) {
                // Karena struktur cart frontend mungkin menggunakan 'base_price' atau 'total_price', kita beri fallback
                $unitPrice = $item['price'] ?? $item['base_price'] ?? ($item['total_price'] / max(1, $item['quantity']));

                OrderItem::create([
                    'order_id' => $order->id,
                    'produk_id' => $item['id'],
                    'jumlah' => $item['quantity'],
                    'harga_satuan' => $unitPrice
                ]);
            }

            // Set Midtrans configuration
            Config::$serverKey = config('services.midtrans.server_key');
            Config::$isProduction = config('services.midtrans.is_production');
            Config::$isSanitized = true;
            Config::$is3ds = true;

            $params = [
                'transaction_details' => [
                    'order_id' => $order->id . '-' . time(),
                    'gross_amount' => (int) $order->total_harga,
                ],
                'customer_details' => [
                    'first_name' => $order->nama_pelanggan,
                    'phone' => $order->no_wa,
                    'billing_address' => [
                        'address' => $order->alamat,
                    ]
                ]
            ];

            $snapToken = Snap::getSnapToken($params);
            
            $order->update([
                'snap_token' => $snapToken
            ]);

            DB::commit();
            return response()->json(['success' => true, 'order_id' => $order->id, 'snap_token' => $snapToken]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function successLocal(Request $request)
    {
        $order = Order::where('snap_token', $request->snap_token)->first();
        if ($order) {
            $order->payment_status = 'paid';
            $order->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }
}
