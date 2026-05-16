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
            ->with('items.produk')
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('user.pesanan_saya', compact('orders'));
    }
}
