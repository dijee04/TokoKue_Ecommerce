<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized', 'redirect' => route('login')], 401);
        }
        $keranjang = Keranjang::with('produk')->where('user_id', Auth::id())->get();
        return response()->json($keranjang);
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized', 'redirect' => route('login')], 401);
        }

        $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'jumlah' => 'required|integer|min:1',
            'opsi' => 'nullable|array',
            'total_harga' => 'required|integer'
        ]);

        // Cari apakah produk dengan opsi yang sama sudah ada di keranjang
        $keranjang = Keranjang::where('user_id', Auth::id())
            ->where('produk_id', $request->produk_id)
            // Karena MySQL json bisa rumit, untuk simplifikasi kita bisa abaikan whereJsonContains atau serialize, 
            // tapi yang paling aman fetch berdasarkan produk_id lalu filter by opsi di PHP atau asumsikan opsi sama.
            ->get()
            ->first(function($item) use ($request) {
                return $item->opsi == $request->opsi;
            });

        if ($keranjang) {
            $keranjang->jumlah += $request->jumlah;
            $keranjang->total_harga += $request->total_harga;
            $keranjang->save();
        } else {
            $keranjang = Keranjang::create([
                'user_id' => Auth::id(),
                'produk_id' => $request->produk_id,
                'jumlah' => $request->jumlah,
                'opsi' => $request->opsi,
                'total_harga' => $request->total_harga
            ]);
        }

        return response()->json(['success' => true, 'data' => $keranjang]);
    }

    public function update(Request $request, $id)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized', 'redirect' => route('login')], 401);
        }

        $request->validate([
            'jumlah' => 'required|integer|min:1',
            'total_harga' => 'required|integer'
        ]);

        $keranjang = Keranjang::where('user_id', Auth::id())->findOrFail($id);
        $keranjang->jumlah = $request->jumlah;
        $keranjang->total_harga = $request->total_harga;
        $keranjang->save();

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized', 'redirect' => route('login')], 401);
        }

        $keranjang = Keranjang::where('user_id', Auth::id())->findOrFail($id);
        $keranjang->delete();

        return response()->json(['success' => true]);
    }

    public function clear()
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized', 'redirect' => route('login')], 401);
        }

        Keranjang::where('user_id', Auth::id())->delete();
        return response()->json(['success' => true]);
    }
}
