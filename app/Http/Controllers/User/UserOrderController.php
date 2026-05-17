<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class UserOrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
            ->with(['items.produk', 'reviews'])
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('user.pesanan_saya', compact('orders'));
    }

    public function nota(Order $order)
    {
        // Pastikan order milik user yang login
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load('items.produk');
        return view('user.order.nota', compact('order'));
    }

    public function storeReview(Request $request, Order $order)
    {
        if ($order->user_id !== auth()->id() || $order->status !== 'selesai') {
            abort(403);
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'ulasan' => 'nullable|string'
        ]);

        \App\Models\Review::create([
            'user_id' => auth()->id(),
            'order_id' => $order->id,
            'rating' => $request->rating,
            'ulasan' => $request->ulasan
        ]);

        return back()->with('success', 'Terima kasih atas ulasan Anda!');
    }
}
