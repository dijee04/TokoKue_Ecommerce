<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;

class HomeController extends Controller
{
    public function index()
    {
        $produks = Produk::with('kategori')->get();
        return view('user.landing_page.home', compact('produks'));
    }

    public function ourStory()
    {
        return view('user.landing_page.our_story');
    }

    public function menu()
    {
        $produks = Produk::with('kategori')->get();
        return view('user.landing_page.menu', compact('produks'));
    }

    public function katering()
    {
        return view('user.landing_page.katering');
    }
}
