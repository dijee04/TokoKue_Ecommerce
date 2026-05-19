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

    public function show($id)
    {
        $produk = Produk::with('kategori')->findOrFail($id);
        
        // Fetch reviews associated with this product's orders
        $reviews = \App\Models\Review::whereHas('order.items', function($query) use ($id) {
            $query->where('produk_id', $id);
        })->with('user')->latest()->get();
        
        // Calculate average rating
        $averageRating = $reviews->avg('rating') ?: 5.0;
        $reviewCount = $reviews->count();
        
        // Fetch related products in the same category
        $relatedProduks = Produk::where('kategori_id', $produk->kategori_id)
            ->where('id', '!=', $id)
            ->take(4)
            ->get();
            
        return view('user.landing_page.detail', compact('produk', 'reviews', 'averageRating', 'reviewCount', 'relatedProduks'));
    }

    public function katering()
    {
        return view('user.landing_page.katering');
    }
}
