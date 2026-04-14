<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;

class HomeController extends Controller
{
    public function index()
    {
        $produks = Produk::with('kategori')->get();
        return view('frontend.home', compact('produks'));
    }
}
