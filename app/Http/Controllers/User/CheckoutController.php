<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'no_wa' => 'required|string|max:20',
            'alamat' => 'required|string',
            'metode_pembayaran' => 'required|string',
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
                'nama_pelanggan' => $request->nama_pelanggan,
                'no_wa' => $request->no_wa,
                'alamat' => $request->alamat,
                'metode_pembayaran' => $request->metode_pembayaran,
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

            DB::commit();
            return response()->json(['success' => true, 'order_id' => $order->id]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
