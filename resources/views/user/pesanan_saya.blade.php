@extends('user.layouts.app')

@section('content')
<style>
    @keyframes pulseGlowYellow {
        0% { box-shadow: 0 0 0 0 rgba(251, 192, 45, 0.7); }
        100% { box-shadow: 0 0 12px 6px rgba(251, 192, 45, 0.3); }
    }
    @keyframes pulseGlowPink {
        0% { box-shadow: 0 0 0 0 rgba(240, 98, 146, 0.7); }
        100% { box-shadow: 0 0 12px 6px rgba(240, 98, 146, 0.3); }
    }
    @keyframes pulseGlowBlue {
        0% { box-shadow: 0 0 0 0 rgba(33, 150, 243, 0.7); }
        100% { box-shadow: 0 0 12px 6px rgba(33, 150, 243, 0.3); }
    }
    @keyframes pulseGlowGreen {
        0% { box-shadow: 0 0 0 0 rgba(76, 175, 80, 0.7); }
        100% { box-shadow: 0 0 12px 6px rgba(76, 175, 80, 0.3); }
    }
    .star-item {
        font-size: 32px;
        color: #ffb300;
        cursor: pointer;
        transition: all 0.2s ease;
        display: inline-block;
        user-select: none;
    }
    .star-item:hover {
        transform: scale(1.2);
    }
</style>

<div class="container" style="max-width: 900px; margin: 40px auto; padding: 0 20px; min-height: 60vh;">
    <h2 style="color: #6d4c41; font-weight: 900; margin-bottom: 20px; font-size: 32px; border-bottom: 3px solid #fce4ec; padding-bottom: 10px;">🛒 Pesanan Saya</h2>

    <!-- Tabs UI Navigasi (Instant Unified Switcher) -->
    <div style="display: flex; gap: 15px; margin-bottom: 30px; border-bottom: 2px solid #fce4ec; padding-bottom: 10px; flex-wrap: wrap;">
        <a href="#" id="tabAktifBtn" style="text-decoration: none; padding: 10px 22px; border-radius: 50px; font-weight: 800; font-size: 14px; background: linear-gradient(135deg, #f06292, #ec407a); color: white; box-shadow: 0 4px 15px rgba(240,98,146,0.25); display: flex; align-items: center; gap: 6px; transition: all 0.3s;">
            📦 Pesanan Aktif (<span id="activeCount">{{ $active_orders->count() }}</span>)
        </a>
        <a href="#" id="tabRiwayatBtn" style="text-decoration: none; padding: 10px 22px; border-radius: 50px; font-weight: 800; font-size: 14px; background: #fff5f5; color: #f06292; border: 1px solid rgba(240,98,146,0.2); transition: all 0.3s; display: flex; align-items: center; gap: 6px;" onmouseover="this.style.background='#fce4ec'" onmouseout="if(document.getElementById('contentRiwayat').style.display !== 'block') this.style.background='#fff5f5'">
            📜 Riwayat Pembelian (<span id="riwayatCount">{{ $completed_orders->count() }}</span>)
        </a>
    </div>

    <!-- TAB 1: PESANAN AKTIF (TERMASUK YANG BARU DISELESAIKAN TAPI BELUM DIULAS) -->
    <div id="contentAktif" style="display: block;">
        @if($active_orders->isEmpty())
            <div style="text-align: center; padding: 60px 20px; background: #fff5f0; border-radius: 24px; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
                <div style="font-size: 80px; margin-bottom: 20px;">🛍️</div>
                <h3 style="color: #8d6e63; margin-bottom: 15px;">Belum Ada Pesanan Aktif</h3>
                <p style="color: #a1887f; margin-bottom: 25px;">Anda tidak memiliki pesanan yang sedang berjalan. Yuk, lihat menu lezat kami!</p>
                <a href="{{ route('menu') }}" class="btn-pesan" style="background: linear-gradient(135deg, #f06292, #ec407a); color: white; padding: 12px 30px; border-radius: 50px; text-decoration: none; font-weight: 800; display: inline-block;">Lihat Menu</a>
            </div>
        @else
            <div style="display: flex; flex-direction: column; gap: 20px;">
                @foreach($active_orders as $order)
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

                        <!-- Timeline Pelacakan Pesanan Visual -->
                        <div style="margin: 25px 0; background: #fffcfd; padding: 20px; border-radius: 16px; border: 1px dashed rgba(240,98,146,0.25);">
                            <div style="display: flex; justify-content: space-between; align-items: center; position: relative;">
                                
                                <!-- Garis Background Penghubung -->
                                <div style="position: absolute; top: 20px; left: 10%; right: 10%; height: 4px; background: #e0e0e0; z-index: 1;">
                                    <!-- Garis Aktif Pink Gradasi -->
                                    @php
                                        $lineWidth = '0%';
                                        if ($order->status == 'disiapkan') $lineWidth = '33.3%';
                                        if ($order->status == 'dikirim') $lineWidth = '66.6%';
                                        if ($order->status == 'selesai') $lineWidth = '100%';
                                    @endphp
                                    <div style="height: 100%; width: {{ $lineWidth }}; background: linear-gradient(90deg, #f06292, #ec407a); transition: width 0.8s ease-in-out; border-radius: 20px; box-shadow: 0 0 8px rgba(240,98,146,0.6);"></div>
                                </div>
                                
                                <!-- Milestone 1: Baru -->
                                @php
                                    $m1_bg = '#e0e0e0'; $m1_color = '#9e9e9e'; $m1_pulse = '';
                                    if ($order->status == 'baru') {
                                        $m1_bg = 'linear-gradient(135deg, #fbc02d, #f57f17)'; $m1_color = '#fbc02d'; $m1_pulse = 'animation: pulseGlowYellow 1.5s infinite alternate;';
                                    } else {
                                        $m1_bg = 'linear-gradient(135deg, #f06292, #ec407a)'; $m1_color = '#f06292';
                                    }
                                @endphp
                                <div style="text-align: center; width: 23%; z-index: 2; display: flex; flex-direction: column; align-items: center;">
                                    <div style="width: 40px; height: 40px; border-radius: 50%; background: {{ $m1_bg }}; color: white; display: flex; align-items: center; justify-content: center; font-size: 18px; box-shadow: 0 4px 10px rgba(0,0,0,0.15); {{ $m1_pulse }}">
                                        @if($order->status != 'baru') ✔ @else 📝 @endif
                                    </div>
                                    <div style="margin-top: 8px; font-size: 12.5px; font-weight: 800; color: {{ $m1_color }};">Pesanan Diterima</div>
                                </div>

                                <!-- Milestone 2: Disiapkan -->
                                @php
                                    $m2_bg = '#e0e0e0'; $m2_color = '#9e9e9e'; $m2_pulse = '';
                                    if ($order->status == 'disiapkan') {
                                        $m2_bg = 'linear-gradient(135deg, #f06292, #ec407a)'; $m2_color = '#f06292'; $m2_pulse = 'animation: pulseGlowPink 1.5s infinite alternate;';
                                    } elseif ($order->status == 'dikirim' || $order->status == 'selesai') {
                                        $m2_bg = 'linear-gradient(135deg, #f06292, #ec407a)'; $m2_color = '#f06292';
                                    }
                                @endphp
                                <div style="text-align: center; width: 23%; z-index: 2; display: flex; flex-direction: column; align-items: center;">
                                    <div style="width: 40px; height: 40px; border-radius: 50%; background: {{ $m2_bg }}; color: white; display: flex; align-items: center; justify-content: center; font-size: 18px; box-shadow: 0 4px 10px rgba(0,0,0,0.15); {{ $m2_pulse }}">
                                        @if($order->status == 'dikirim' || $order->status == 'selesai') ✔ @else 🥣 @endif
                                    </div>
                                    <div style="margin-top: 8px; font-size: 12.5px; font-weight: 800; color: {{ $m2_color }};">Kue Sedang Dibuat</div>
                                </div>

                                <!-- Milestone 3: Dikirim -->
                                @php
                                    $m3_bg = '#e0e0e0'; $m3_color = '#9e9e9e'; $m3_pulse = '';
                                    if ($order->status == 'dikirim') {
                                        $m3_bg = 'linear-gradient(135deg, #2196f3, #1976d2)'; $m3_color = '#2196f3'; $m3_pulse = 'animation: pulseGlowBlue 1.5s infinite alternate;';
                                    } elseif ($order->status == 'selesai') {
                                        $m3_bg = 'linear-gradient(135deg, #f06292, #ec407a)'; $m3_color = '#f06292';
                                    }
                                @endphp
                                <div style="text-align: center; width: 23%; z-index: 2; display: flex; flex-direction: column; align-items: center;">
                                    <div style="width: 40px; height: 40px; border-radius: 50%; background: {{ $m3_bg }}; color: white; display: flex; align-items: center; justify-content: center; font-size: 18px; box-shadow: 0 4px 10px rgba(0,0,0,0.15); {{ $m3_pulse }}">
                                        @if($order->status == 'selesai') ✔ @else 🛵 @endif
                                    </div>
                                    <div style="margin-top: 8px; font-size: 12.5px; font-weight: 800; color: {{ $m3_color }};">Pesanan Dikirim</div>
                                </div>

                                <!-- Milestone 4: Selesai -->
                                @php
                                    $m4_bg = '#e0e0e0'; $m4_color = '#9e9e9e'; $m4_pulse = '';
                                    if ($order->status == 'selesai') {
                                        $m4_bg = 'linear-gradient(135deg, #4caf50, #2e7d32)'; $m4_color = '#4caf50'; $m4_pulse = 'animation: pulseGlowGreen 1.5s infinite alternate;';
                                    }
                                @endphp
                                <div style="text-align: center; width: 23%; z-index: 2; display: flex; flex-direction: column; align-items: center;">
                                    <div style="width: 40px; height: 40px; border-radius: 50%; background: {{ $m4_bg }}; color: white; display: flex; align-items: center; justify-content: center; font-size: 18px; box-shadow: 0 4px 10px rgba(0,0,0,0.15); {{ $m4_pulse }}">
                                        @if($order->status == 'selesai') ✔ @else 🎁 @endif
                                    </div>
                                    <div style="margin-top: 8px; font-size: 12.5px; font-weight: 800; color: {{ $m4_color }};">Pesanan Selesai</div>
                                </div>

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
                            
                            <div style="display: flex; gap: 10px; align-items: center;">
                                @if($order->payment_status == 'paid')
                                    <a href="{{ route('user.order.nota', $order->id) }}" target="_blank" style="background: #6d4c41; color: white; padding: 10px 20px; border-radius: 50px; text-decoration: none; font-weight: 700; font-size: 14px; box-shadow: 0 4px 10px rgba(109,76,65,0.2);">
                                        📄 Lihat Nota
                                    </a>
                                @endif

                                @if($order->payment_status == 'unpaid' && $order->snap_token)
                                    <button onclick="payNow('{{ $order->snap_token }}')" style="background: linear-gradient(135deg, #25D366, #128C7E); color: white; border: none; padding: 12px 25px; border-radius: 50px; font-weight: 800; cursor: pointer; box-shadow: 0 4px 15px rgba(37,211,102,0.3); transition: all 0.3s;">
                                        💳 Bayar Sekarang
                                    </button>
                                @endif

                                <!-- Tombol Selesaikan Pesanan (Khas Shopee) -->
                                @if($order->status == 'dikirim')
                                    <form id="completeForm-{{ $order->id }}" action="{{ route('user.order.complete', $order->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="button" onclick="confirmCompletion('{{ $order->id }}')" style="background: linear-gradient(135deg, #ff4081, #f50057); color: white; border: none; padding: 12px 25px; border-radius: 50px; font-weight: 800; font-size: 14px; cursor: pointer; box-shadow: 0 4px 15px rgba(245,0,87,0.35); display: flex; align-items: center; gap: 6px; transition: all 0.3s; border: none;">
                                            🎁 Selesaikan Pesanan
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>

                        <!-- Bagian Input Ulasan (DIPINDAHKAN KE SINI! Hanya jika status = selesai dan belum diulas) -->
                        @if($order->status == 'selesai')
                            <div style="margin-top: 25px; padding-top: 20px; border-top: 1px dashed #ddd;">
                                @if($order->reviews->isEmpty())
                                    <h4 style="color: #6d4c41; margin-bottom: 15px; font-weight: 800;">Bagikan Pengalaman Anda</h4>
                                    <form action="{{ route('user.order.review', $order->id) }}" method="POST" onsubmit="sessionStorage.setItem('payment_success_confetti', 'true');">
                                        @csrf
                                        <div style="margin-bottom: 15px;">
                                            <label style="display: block; font-size: 14.5px; color: #6d4c41; margin-bottom: 8px; font-weight: 800;">Berikan Rating Anda:</label>
                                            <div class="star-rating-selector" data-order-id="{{ $order->id }}" style="display: flex; gap: 10px; font-size: 32px; cursor: pointer; margin-bottom: 12px; user-select: none;">
                                                <span class="star-item" data-value="1">★</span>
                                                <span class="star-item" data-value="2">★</span>
                                                <span class="star-item" data-value="3">★</span>
                                                <span class="star-item" data-value="4">★</span>
                                                <span class="star-item" data-value="5">★</span>
                                            </div>
                                            <input type="hidden" name="rating" id="ratingInput-{{ $order->id }}" value="5" required>
                                            <div id="ratingText-{{ $order->id }}" style="font-size: 13.5px; font-weight: 800; color: #ff8f00; margin-top: -5px; margin-bottom: 15px;">⭐⭐⭐⭐⭐ (Sangat Puas)</div>
                                        </div>
                                        <div style="margin-bottom: 15px;">
                                            <label style="display: block; font-size: 14px; color: #666; margin-bottom: 8px; font-weight: 600;">Ulasan (Opsional):</label>
                                            <textarea name="ulasan" rows="3" style="width: 100%; padding: 12px; border-radius: 12px; border: 1px solid #ddd; outline: none; transition: border-color 0.3s;" placeholder="Ceritakan pendapat Anda tentang kue kami..." onfocus="this.style.borderColor='#f06292'" onblur="this.style.borderColor='#ddd'"></textarea>
                                        </div>
                                        <button type="submit" style="background: #f06292; color: white; border: none; padding: 10px 22px; border-radius: 50px; font-weight: 800; cursor: pointer; box-shadow: 0 4px 10px rgba(240,98,146,0.2); transition: all 0.3s;">Kirim Ulasan</button>
                                    </form>
                                @endif
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- TAB 2: RIWAYAT PEMBELIAN (COMPLETED & CANCELLED YANG SUDAH DIULAS) -->
    <div id="contentRiwayat" style="display: none;">
        @if($completed_orders->isEmpty())
            <div style="text-align: center; padding: 60px 20px; background: #fff5f0; border-radius: 24px; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
                <div style="font-size: 80px; margin-bottom: 20px;">📜</div>
                <h3 style="color: #8d6e63; margin-bottom: 15px;">Belum Ada Riwayat</h3>
                <p style="color: #a1887f; margin-bottom: 25px;">Anda belum memiliki riwayat pembelian kue manis sebelumnya.</p>
                <a href="{{ route('menu') }}" class="btn-pesan" style="background: linear-gradient(135deg, #f06292, #ec407a); color: white; padding: 12px 30px; border-radius: 50px; text-decoration: none; font-weight: 800; display: inline-block;">Belanja Sekarang</a>
            </div>
        @else
            <div style="display: flex; flex-direction: column; gap: 20px;">
                @foreach($completed_orders as $order)
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

                        <!-- Ulasan Read-Only yang Sudah Dibuat -->
                        @if($order->status == 'selesai' && !$order->reviews->isEmpty())
                            <div style="margin-top: 25px; padding-top: 20px; border-top: 1px dashed #ddd;">
                                <div style="background: #fdf5f7; padding: 15px; border-radius: 15px; border: 1px solid rgba(240,98,146,0.1);">
                                    <div style="font-weight: 700; color: #6d4c41; margin-bottom: 5px;">Ulasan Anda:</div>
                                    <div style="color: #fbc02d; font-size: 16px; margin-bottom: 8px;">
                                        @for($i=0; $i<$order->reviews->first()->rating; $i++) ⭐ @endfor
                                    </div>
                                    <div style="font-style: italic; color: #8d6e63; font-size: 14px; background: white; padding: 10px; border-radius: 8px; border-left: 4px solid #f06292;">"{{ $order->reviews->first()->ulasan }}"</div>
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // SweetAlert2 custom confirmation modal for Shopee-like complete order
    function confirmCompletion(orderId) {
        Swal.fire({
            title: 'Selesaikan Pesanan? 🎁',
            text: 'Apakah Anda yakin kue lezat Dear Seana telah Anda terima dengan baik?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#f06292', // Theme Pink
            cancelButtonColor: '#6d4c41', // Theme Brown
            confirmButtonText: 'Ya, Sudah Diterima! ❤️',
            cancelButtonText: 'Belum',
            background: '#fff',
            borderRadius: '24px',
            customClass: {
                popup: 'premium-swal-popup'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Set confetti celebration trigger
                sessionStorage.setItem('payment_success_confetti', 'true');
                // Submit the specific form
                document.getElementById('completeForm-' + orderId).submit();
            }
        });
    }

    // Tab switcher logic
    const tabAktifBtn = document.getElementById('tabAktifBtn');
    const tabRiwayatBtn = document.getElementById('tabRiwayatBtn');
    const contentAktif = document.getElementById('contentAktif');
    const contentRiwayat = document.getElementById('contentRiwayat');

    function activateTab(tabName) {
        if (tabName === 'riwayat') {
            // Highlight Riwayat tab
            tabRiwayatBtn.style.background = 'linear-gradient(135deg, #f06292, #ec407a)';
            tabRiwayatBtn.style.color = 'white';
            tabRiwayatBtn.style.boxShadow = '0 4px 15px rgba(240,98,146,0.25)';
            tabRiwayatBtn.style.border = 'none';
            
            // Unhighlight Aktif tab
            tabAktifBtn.style.background = '#fff5f5';
            tabAktifBtn.style.color = '#f06292';
            tabAktifBtn.style.boxShadow = 'none';
            tabAktifBtn.style.border = '1px solid rgba(240,98,146,0.2)';
            
            // Show/Hide content
            contentRiwayat.style.display = 'block';
            contentAktif.style.display = 'none';
            
            // Update URL parameter without reload
            const newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?tab=riwayat';
            window.history.pushState({ path: newUrl }, '', newUrl);
        } else {
            // Highlight Aktif tab
            tabAktifBtn.style.background = 'linear-gradient(135deg, #f06292, #ec407a)';
            tabAktifBtn.style.color = 'white';
            tabAktifBtn.style.boxShadow = '0 4px 15px rgba(240,98,146,0.25)';
            tabAktifBtn.style.border = 'none';
            
            // Unhighlight Riwayat tab
            tabRiwayatBtn.style.background = '#fff5f5';
            tabRiwayatBtn.style.color = '#f06292';
            tabRiwayatBtn.style.boxShadow = 'none';
            tabRiwayatBtn.style.border = '1px solid rgba(240,98,146,0.2)';
            
            // Show/Hide content
            contentAktif.style.display = 'block';
            contentRiwayat.style.display = 'none';
            
            // Update URL parameter without reload
            const newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
            window.history.pushState({ path: newUrl }, '', newUrl);
        }
    }

    tabAktifBtn.addEventListener('click', (e) => {
        e.preventDefault();
        activateTab('aktif');
    });

    tabRiwayatBtn.addEventListener('click', (e) => {
        e.preventDefault();
        activateTab('riwayat');
    });

    // Check if redirect has tab=riwayat
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('tab') === 'riwayat') {
        activateTab('riwayat');
    } else {
        activateTab('aktif');
    }

    // Star rating selector interactive scripts
    document.querySelectorAll('.star-rating-selector').forEach(selector => {
        const orderId = selector.getAttribute('data-order-id');
        const stars = selector.querySelectorAll('.star-item');
        const input = document.getElementById('ratingInput-' + orderId);
        const textLabel = document.getElementById('ratingText-' + orderId);
        
        const ratingLabels = {
            1: '⭐ (Buruk)',
            2: '⭐⭐ (Kurang)',
            3: '⭐⭐⭐ (Cukup)',
            4: '⭐⭐⭐⭐ (Puas)',
            5: '⭐⭐⭐⭐⭐ (Sangat Puas)'
        };
        
        stars.forEach(star => {
            star.addEventListener('click', function() {
                const val = this.getAttribute('data-value');
                input.value = val;
                textLabel.textContent = ratingLabels[val];
                
                stars.forEach(s => {
                    if (parseInt(s.getAttribute('data-value')) <= val) {
                        s.style.color = '#ffb300';
                        s.style.transform = 'scale(1.2)';
                    } else {
                        s.style.color = '#ccc';
                        s.style.transform = 'scale(1)';
                    }
                });
            });
            
            star.addEventListener('mouseover', function() {
                const val = this.getAttribute('data-value');
                stars.forEach(s => {
                    if (parseInt(s.getAttribute('data-value')) <= val) {
                        s.style.color = '#ffe082';
                    } else {
                        s.style.color = '#ccc';
                    }
                });
            });
            
            star.addEventListener('mouseout', function() {
                const currentVal = input.value;
                stars.forEach(s => {
                    if (parseInt(s.getAttribute('data-value')) <= currentVal) {
                        s.style.color = '#ffb300';
                    } else {
                        s.style.color = '#ccc';
                    }
                });
            });
        });
    });

    // Snap Midtrans payNow integration
    function payNow(snapToken) {
        if(!snapToken) {
            alert('Token pembayaran tidak valid!');
            return;
        }

        window.snap.pay(snapToken, {
            onSuccess: function(result){
                fetch('{{ route("user.checkout.success_local") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ snap_token: snapToken })
                }).then(() => {
                    sessionStorage.setItem('payment_success_confetti', 'true');
                    alert("Pembayaran berhasil!");
                    location.reload();
                });
            },
            onPending: function(result){
                alert("Menunggu pembayaran Anda!");
                location.reload();
            },
            onError: function(result){
                alert("Pembayaran gagal!");
                location.reload();
            },
            onClose: function(){
                // Tidak perlu alert jika menutup popup
            }
        });
    }
</script>
@endpush
