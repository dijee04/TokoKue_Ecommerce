<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Produk;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProduk = Produk::count();
        $pesananBaru = Order::where('status', 'baru')->count();
        $pendapatan = Order::where('status', 'selesai')->sum('total_harga');

        return view('admin.dashboard', compact('totalProduk', 'pesananBaru', 'pendapatan'));
    }
}
