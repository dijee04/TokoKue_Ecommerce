@extends('user.layouts.app')

@section('content')
<div class="container" style="max-width: 900px; margin: 40px auto; padding: 0 20px; min-height: 60vh;">
    <h2 style="color: #6d4c41; font-weight: 900; margin-bottom: 20px; font-size: 32px; border-bottom: 3px solid #fce4ec; padding-bottom: 10px;">🛒 Pesanan Saya</h2>

    <!-- Tabs UI Navigasi -->
    <div style="display: flex; gap: 15px; margin-bottom: 30px; border-bottom: 2px solid #fce4ec; padding-bottom: 10px; flex-wrap: wrap;">
        <a href="{{ route('pesanan_saya') }}" style="text-decoration: none; padding: 10px 22px; border-radius: 50px; font-weight: 800; font-size: 14px; background: #fff5f5; color: #f06292; border: 1px solid rgba(240,98,146,0.2); transition: all 0.3s; display: flex; align-items: center; gap: 6px;" onmouseover="this.style.background='#fce4ec'" onmouseout="this.style.background='#fff5f5'">
            📦 Pesanan Aktif
        </a>
        <a href="{{ route('riwayat_pembelian') }}" style="text-decoration: none; padding: 10px 22px; border-radius: 50px; font-weight: 800; font-size: 14px; background: linear-gradient(135deg, #f06292, #ec407a); color: white; box-shadow: 0 4px 15px rgba(240,98,146,0.25); display: flex; align-items: center; gap: 6px;">
            📜 Riwayat Pembelian ({{ $orders->count() }})
        </a>
    </div>

    @if($orders->isEmpty())
        <!-- Riwayat Pembelian Kosong -->
        <div style="text-align: center; padding: 60px 20px; background: #fff5f0; border-radius: 24px; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
            <div style="font-size: 80px; margin-bottom: 20px;">📜</div>
            <h3 style="color: #8d6e63; margin-bottom: 15px;">Belum Ada Riwayat</h3>
            <p style="color: #a1887f; margin-bottom: 25px;">Anda belum memiliki riwayat pembelian kue manis sebelumnya.</p>
            <a href="{{ route('menu') }}" class="btn-pesan" style="background: linear-gradient(135deg, #f06292, #ec407a); color: white; padding: 12px 30px; border-radius: 50px; text-decoration: none; font-weight: 800; display: inline-block;">Belanja Sekarang</a>
        </div>
    @else
        <!-- Daftar Riwayat Pembelian -->
        <div style="display: flex; flex-direction: column; gap: 20px;">
            @foreach($orders as $order)
                <div style="background: white; border-radius: 20px; padding: 25px; box-shadow: 0 8px 25px rgba(0,0,0,0.06); border: 1px solid #fce4ec;">
                    <div style="display: flex; justify-content: space-between; border-bottom: 1px solid #f5f5f5; padding-bottom: 15px; margin-bottom: 15px; flex-wrap: wrap; gap: 10px;">
                        <div>
                            <div style="font-size: 13px; color: #999; margin-bottom: 5px;">Tanggal Pesanan</div>
                            <div style="font-weight: 800; color: #6d4c41;">{{ $order->created_at->format('d M Y, H:i') }}</div>
                        </div>
                        <div style="text-align: center;">
                            <div style="font-size: 13px; color: #999; margin-bottom: 5px;">Status Pesanan</div>
                            @php
                                $statusColors = [
                                    'baru' => ['#e3f2fd', '#1565c0', 'Baru'],
                                    'disiapkan' => ['#fff3e0', '#e65100', 'Disiapkan'],
                                    'dikirim' => ['#f3e5f5', '#7b1fa2', 'Dikirim'],
                                    'selesai' => ['#e8f5e9', '#2e7d32', 'Selesai'],
                                    'dibatalkan' => ['#ffebee', '#c62828', 'Dibatalkan'],
                                ];
                                $st = $statusColors[$order->status] ?? ['#f5f5f5', '#757575', $order->status];
                            @endphp
                            <span style="background: {{ $st[0] }}; color: {{ $st[1] }}; padding: 5px 12px; border-radius: 20px; font-size: 13px; font-weight: 800;">{{ $st[2] }}</span>
                        </div>
                        <div style="text-align: right;">
                            <div style="font-size: 13px; color: #999; margin-bottom: 5px;">Status Pembayaran</div>
                            @if($order->payment_status == 'paid')
                                <span style="background: #e8f5e9; color: #2e7d32; padding: 5px 12px; border-radius: 20px; font-size: 13px; font-weight: 800;">Lunas</span>
                            @elseif($order->payment_status == 'failed' || $order->payment_status == 'expired')
                                <span style="background: #ffebee; color: #c62828; padding: 5px 12px; border-radius: 20px; font-size: 13px; font-weight: 800;">Gagal</span>
                            @else
                                <span style="background: #fff3e0; color: #e65100; padding: 5px 12px; border-radius: 20px; font-size: 13px; font-weight: 800;">Belum Dibayar</span>
                            @endif
                        </div>
                    </div>

                    <div style="margin-bottom: 20px;">
                        @foreach($order->items as $item)
                            <div style="display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 15px;">
                                <div style="color: #6d4c41;"><span style="font-weight: 800;">{{ $item->jumlah }}x</span> {{ $item->produk->nama_produk ?? 'Produk' }}</div>
                                <div style="color: #8d6e63;">Rp {{ number_format($item->harga_satuan * $item->jumlah, 0, ',', '.') }}</div>
                            </div>
                        @endforeach
                    </div>

                    <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #f5f5f5; padding-top: 20px; flex-wrap: wrap; gap: 15px;">
                        <div>
                            <div style="font-size: 13px; color: #999;">Total Pembayaran</div>
                            <div style="font-size: 22px; font-weight: 900; color: #f06292;">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</div>
                        </div>
                        
                        <div style="display: flex; gap: 10px;">
                            @if($order->payment_status == 'paid')
                                <a href="{{ route('user.order.nota', $order->id) }}" target="_blank" style="background: #6d4c41; color: white; padding: 10px 20px; border-radius: 50px; text-decoration: none; font-weight: 700; font-size: 14px; box-shadow: 0 4px 10px rgba(109,76,65,0.2);">
                                    📄 Lihat Nota
                                </a>
                            @endif
                        </div>
                    </div>

                    <!-- Bagian Input Ulasan (Hanya jika Selesai) -->
                    @if($order->status == 'selesai')
                        <div style="margin-top: 25px; padding-top: 20px; border-top: 1px dashed #ddd;">
                            @if($order->reviews->isEmpty())
                                <h4 style="color: #6d4c41; margin-bottom: 15px; font-weight: 800;">Bagikan Pengalaman Anda</h4>
                                <form action="{{ route('user.order.review', $order->id) }}" method="POST">
                                    @csrf
                                    <div style="margin-bottom: 15px;">
                                        <label style="display: block; font-size: 14px; color: #666; margin-bottom: 8px; font-weight: 600;">Rating:</label>
                                        <select name="rating" required style="width: 100%; padding: 10px; border-radius: 10px; border: 1px solid #ddd; background: white;">
                                            <option value="5">⭐⭐⭐⭐⭐ (Sangat Puas)</option>
                                            <option value="4">⭐⭐⭐⭐ (Puas)</option>
                                            <option value="3">⭐⭐⭐ (Cukup)</option>
                                            <option value="2">⭐⭐ (Kurang)</option>
                                            <option value="1">⭐ (Buruk)</option>
                                        </select>
                                    </div>
                                    <div style="margin-bottom: 15px;">
                                        <label style="display: block; font-size: 14px; color: #666; margin-bottom: 8px; font-weight: 600;">Ulasan (Opsional):</label>
                                        <textarea name="ulasan" rows="3" style="width: 100%; padding: 10px; border-radius: 10px; border: 1px solid #ddd;" placeholder="Ceritakan pendapat Anda tentang produk kami..."></textarea>
                                    </div>
                                    <button type="submit" style="background: #f06292; color: white; border: none; padding: 10px 20px; border-radius: 50px; font-weight: 700; cursor: pointer; box-shadow: 0 4px 10px rgba(240,98,146,0.2);">Kirim Ulasan</button>
                                </form>
                            @else
                                <div style="background: #fdf5f7; padding: 15px; border-radius: 15px; border: 1px solid rgba(240,98,146,0.1);">
                                    <div style="font-weight: 700; color: #6d4c41; margin-bottom: 5px;">Ulasan Anda:</div>
                                    <div style="color: #fbc02d; font-size: 14px; margin-bottom: 5px;">
                                        @for($i=0; $i<$order->reviews->first()->rating; $i++) ⭐ @endfor
                                    </div>
                                    <div style="font-style: italic; color: #8d6e63; font-size: 14px;">"{{ $order->reviews->first()->ulasan }}"</div>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
