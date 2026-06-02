<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->get();
        return view('admin.order.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['items.produk', 'reviews.user']);
        return view('admin.order.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:baru,disiapkan,menunggu_kurir,dikirim,selesai,dibatalkan',
            'ongkir' => 'nullable|numeric|min:0',
        ]);

        $data = ['status' => $validated['status']];

        if ($request->has('ongkir')) {
            $data['ongkir'] = $validated['ongkir'] ?? 0;
        }

        $order->update($data);
        return back()->with('success', 'Status pesanan berhasil diperbarui!');
    }
}
