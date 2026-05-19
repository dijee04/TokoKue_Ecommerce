<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class UserOrderController extends Controller
{
    public function notifikasi()
    {
        $latest_orders = Order::where('user_id', auth()->id())
            ->with(['items.produk'])
            ->orderBy('updated_at', 'desc')
            ->take(10)
            ->get();
            
        return view('user.notifikasi', compact('latest_orders'));
    }

    public function index()
    {
        // Pesanan Aktif: status baru, disiapkan, dikirim, ATAU selesai tapi belum diulas
        $active_orders = Order::where('user_id', auth()->id())
            ->where(function($query) {
                $query->whereIn('status', ['baru', 'disiapkan', 'dikirim'])
                      ->orWhere(function($q) {
                          $q->where('status', 'selesai')
                            ->doesntHave('reviews');
                      });
            })
            ->with(['items.produk', 'reviews'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Riwayat Pembelian: status dibatalkan, ATAU selesai yang sudah diulas
        $completed_orders = Order::where('user_id', auth()->id())
            ->where(function($query) {
                $query->where('status', 'dibatalkan')
                      ->orWhere(function($q) {
                          $q->where('status', 'selesai')
                            ->has('reviews');
                      });
            })
            ->with(['items.produk', 'reviews'])
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('user.pesanan_saya', compact('active_orders', 'completed_orders'));
    }

    public function riwayat()
    {
        return redirect()->route('pesanan_saya', ['tab' => 'riwayat']);
    }

    public function completeOrder(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        if ($order->status !== 'dikirim') {
            return back()->with('error', 'Pesanan hanya dapat diselesaikan jika sudah dikirim.');
        }

        $order->update([
            'status' => 'selesai'
        ]);

        return redirect()->route('pesanan_saya', ['tab' => 'aktif'])->with('success', 'Pesanan telah diselesaikan! Silakan berikan ulasan Anda di bawah.');
    }

    public function checkStatus()
    {
        $orders = Order::where('user_id', auth()->id())
            ->select('id', 'status')
            ->get();
            
        return response()->json($orders);
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
            'ulasan' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            if (!file_exists(public_path('uploads/reviews'))) {
                mkdir(public_path('uploads/reviews'), 0777, true);
            }
            $file->move(public_path('uploads/reviews'), $filename);
            $fotoPath = 'uploads/reviews/' . $filename;
        }

        \App\Models\Review::create([
            'user_id' => auth()->id(),
            'order_id' => $order->id,
            'rating' => $request->rating,
            'ulasan' => $request->ulasan,
            'foto' => $fotoPath
        ]);

        return redirect()->route('pesanan_saya', ['tab' => 'riwayat'])->with('success', 'Terima kasih atas ulasan Anda!');
    }

    public function cancelOrder(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        // Batal pesanan hanya jika status masih 'baru' (belum disiapkan/dikirim)
        if ($order->status !== 'baru') {
            return back()->with('error', 'Pesanan tidak dapat dibatalkan karena sedang diproses atau sudah dikirim.');
        }

        $order->update([
            'status' => 'dibatalkan',
            'payment_status' => 'failed'
        ]);

        return redirect()->route('pesanan_saya', ['tab' => 'riwayat'])->with('success', 'Pesanan Anda telah berhasil dibatalkan.');
    }
}
