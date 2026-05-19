<?php

namespace App\Http\Controllers\Kurir;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DashboardController extends Controller
{
    public function index()
    {
        // Query orders with status 'dikirim' (dispatched / out for delivery)
        $orders = Order::where('status', 'dikirim')
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('kurir.dashboard', compact('orders'));
    }

    public function completeDelivery(Request $request, Order $order)
    {
        // Ensure the order is currently 'dikirim'
        if ($order->status !== 'dikirim') {
            return back()->with('error', 'Pesanan ini tidak sedang dalam pengiriman.');
        }

        $request->validate([
            'bukti_pengiriman' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
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

            // Update order status to 'selesai' and save the proof photo
            $order->update([
                'status' => 'selesai',
                'bukti_pengiriman' => $fotoPath
            ]);

            return back()->with('success', 'Pesanan #' . $order->id . ' berhasil diselesaikan dan bukti pengiriman telah diunggah!');
        }

        return back()->with('error', 'Gagal mengunggah foto bukti pengiriman.');
    }
}
