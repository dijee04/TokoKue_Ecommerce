<?php

namespace App\Http\Controllers\Kurir;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DashboardController extends Controller
{
    /**
     * Tampilkan dashboard kurir dengan pesanan yang sedang dalam pengiriman.
     */
    public function index()
    {
        $orders = Order::where('status', 'dikirim')
            ->where('kurir_id', auth()->guard('kurir')->id())
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('kurir.dashboard', compact('orders'));
    }

    public function pendingOrders()
    {
        $orders = Order::where('status', 'menunggu_kurir')
            ->orderBy('created_at', 'asc')
            ->get();
            
        return view('kurir.pending_orders', compact('orders'));
    }

    public function showConfirm(Order $order)
    {
        if ($order->status !== 'menunggu_kurir') {
            return redirect()->route('kurir.orders.pending')->with('error', 'Pesanan tidak tersedia untuk dikonfirmasi.');
        }
        
        return view('kurir.confirm_order', compact('order'));
    }

    public function acceptOrder(Request $request, Order $order)
    {
        if ($order->status !== 'menunggu_kurir') {
            return redirect()->route('kurir.orders.pending')->with('error', 'Pesanan sudah diambil kurir lain atau tidak valid.');
        }
        
        $order->update([
            'status' => 'dikirim',
            'kurir_id' => auth()->guard('kurir')->id()
        ]);
        
        return redirect()->route('kurir.dashboard')->with('success', 'Berhasil menerima pesanan! Silakan selesaikan pengantaran.');
    }

    /**
     * Kurir mengunggah bukti pengiriman dan menyelesaikan pesanan.
     */
    public function completeDelivery(Request $request, Order $order)
    {
        if ($order->status !== 'dikirim') {
            return back()->with('error', 'Pesanan ini tidak sedang dalam pengiriman.');
        }

        $request->validate([
            'bukti_pengiriman' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        if ($request->hasFile('bukti_pengiriman')) {
            $file = $request->file('bukti_pengiriman');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $destinationPath = public_path('uploads/bukti_pengiriman');
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }

            $file->move($destinationPath, $filename);
            $fotoPath = 'uploads/bukti_pengiriman/' . $filename;

            $order->update([
                'status' => 'selesai',
                'bukti_pengiriman' => $fotoPath,
            ]);

            return back()->with('success', 'Pesanan #' . $order->id . ' berhasil diselesaikan dan bukti pengiriman telah diunggah!');
        }

        return back()->with('error', 'Gagal mengunggah foto bukti pengiriman.');
    }

    /**
     * Tampilkan riwayat pengiriman kurir.
     */
    public function history()
    {
        $orders = Order::where('status', 'selesai')
            ->where('kurir_id', auth()->guard('kurir')->id())
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('kurir.riwayat_pengiriman', compact('orders'));
    }
}
