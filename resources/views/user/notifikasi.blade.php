@extends('user.layouts.app')

@section('content')
<div class="container" style="max-width: 800px; margin: 40px auto; padding: 0 20px; min-height: 65vh;">
    <!-- Header Halaman -->
    <h2 style="color: #6d4c41; font-weight: 900; margin-bottom: 30px; font-size: 32px; border-bottom: 3px solid #fce4ec; padding-bottom: 12px; display: flex; align-items: center; gap: 12px;">
        🔔 Notifikasi Status Pesanan
    </h2>

    @if($latest_orders->isEmpty())
        <!-- Tampilan Kosong (Empty State) -->
        <div style="text-align: center; padding: 70px 30px; background: #fff5f0; border-radius: 28px; box-shadow: 0 10px 30px rgba(229,115,115,0.06); border: 1px solid rgba(229,115,115,0.1);">
            <div style="font-size: 90px; margin-bottom: 25px; animation: float 3s ease-in-out infinite;">🍰</div>
            <h3 style="color: #8d6e63; margin-bottom: 15px; font-weight: 800; font-size: 22px;">Belum Ada Notifikasi</h3>
            <p style="color: #a1887f; margin-bottom: 30px; font-size: 15px; font-weight: 500;">Anda belum memiliki riwayat status pesanan. Yuk, mulai pesan kue lezat Anda hari ini!</p>
            <a href="{{ route('menu') }}" class="btn-pesan" style="background: linear-gradient(135deg, #f06292, #ec407a); color: white; padding: 14px 35px; border-radius: 50px; text-decoration: none; font-weight: 800; display: inline-block; box-shadow: 0 6px 18px rgba(240,98,146,0.3); transition: all 0.3s;">
                Lihat Menu Kue
            </a>
        </div>
    @else
        <!-- Daftar Notifikasi -->
        <div style="display: flex; flex-direction: column; gap: 18px;">
            @foreach($latest_orders as $order)
                @php
                    $icon = '📦';
                    $statusTitle = 'Pesanan Dibuat';
                    $statusDesc = 'Pesanan Anda sedang diproses.';
                    $bg = '#fff8f6';
                    $border = 'rgba(229,115,115,0.1)';
                    
                    if ($order->status == 'baru') {
                        if ($order->payment_status == 'paid') {
                            $icon = '💳';
                            $statusTitle = 'Pembayaran Sukses';
                            $statusDesc = 'Pembayaran berhasil! Toko kami sedang memproses pesanan dan mengonfirmasi pesanan Anda.';
                            $bg = '#f1f8e9'; // soft green
                            $border = 'rgba(76,175,80,0.1)';
                        } else {
                            $icon = '⏳';
                            $statusTitle = 'Menunggu Pembayaran';
                            $statusDesc = 'Pesanan telah dibuat. Silakan selesaikan pembayaran di simulator agar kami bisa langsung membuat kue Anda.';
                            $bg = '#fffde7'; // soft yellow
                            $border = 'rgba(251,192,45,0.15)';
                        }
                    } elseif ($order->status == 'disiapkan') {
                        $icon = '🥣';
                        $statusTitle = 'Kue Sedang Dikemas & Dibuat';
                        $statusDesc = 'Kue manis Anda sedang disiapkan, dipanggang, dan dikemas secara higienis oleh chef terbaik kami dengan penuh cinta! 🎂';
                        $bg = '#fce4ec'; // soft pink
                        $border = 'rgba(240,98,146,0.15)';
                    } elseif ($order->status == 'dikirim') {
                        $icon = '🛵';
                        $statusTitle = 'Pesanan Sedang Dikirim';
                        $statusDesc = 'Pesanan kue Anda sedang dalam perjalanan ke alamat tujuan bersama kurir kami. Harap bersiap menerima kue manis Anda! 🚀';
                        $bg = '#e3f2fd'; // soft blue
                        $border = 'rgba(33,150,243,0.15)';
                    } elseif ($order->status == 'selesai') {
                        $icon = '✅';
                        $statusTitle = 'Pesanan Telah Selesai';
                        $statusDesc = 'Kue lezat Anda telah diterima dengan selamat! Terima kasih banyak telah mempercayakan momen manis Anda kepada kami. ❤️';
                        $bg = '#e8f5e9'; // soft green
                        $border = 'rgba(76,175,80,0.1)';
                    } elseif ($order->status == 'dibatalkan') {
                        $icon = '❌';
                        $statusTitle = 'Pesanan Dibatalkan';
                        $statusDesc = 'Pesanan Anda telah dibatalkan.';
                        $bg = '#ffebee'; // soft red
                        $border = 'rgba(244,67,54,0.1)';
                    }
                @endphp

                <!-- Kartu Notifikasi Premium -->
                <div class="notif-card" style="background: {{ $bg }}; border-radius: 24px; padding: 25px; box-shadow: 0 8px 25px rgba(0,0,0,0.03); border: 1px solid {{ $border }}; display: flex; gap: 20px; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); position: relative;">
                    <!-- Bagian Ikon Status -->
                    <div style="font-size: 38px; display: flex; align-items: center; justify-content: center; width: 60px; height: 60px; border-radius: 18px; background: rgba(255,255,255,0.7); box-shadow: 0 4px 12px rgba(0,0,0,0.02); flex-shrink: 0;">
                        {{ $icon }}
                    </div>

                    <!-- Bagian Konten/Teks -->
                    <div style="flex: 1;">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 6px; flex-wrap: wrap; gap: 8px;">
                            <h4 style="margin: 0; color: #6d4c41; font-weight: 800; font-size: 16px; display: flex; align-items: center; gap: 8px;">
                                {{ $statusTitle }}
                            </h4>
                            <span style="font-size: 11px; background: rgba(109,76,65,0.08); color: #6d4c41; padding: 3px 10px; border-radius: 8px; font-weight: 700; border: 1px solid rgba(109,76,65,0.05);">
                                No. Order: #{{ $order->id }}
                            </span>
                        </div>
                        
                        <p style="margin: 0 0 12px 0; color: #5d4037; font-size: 13.5px; line-height: 1.5; font-weight: 500;">
                            {{ $statusDesc }}
                        </p>

                        <!-- Detail Barang yang Dipesan -->
                        <div style="background: rgba(255,255,255,0.65); border-radius: 12px; padding: 10px 15px; margin-bottom: 15px; border: 1px solid rgba(0,0,0,0.02);">
                            <span style="font-size: 11px; color: #9e7d72; display: block; font-weight: 700; margin-bottom: 4px; text-transform: uppercase; letter-spacing: 0.5px;">📦 Detail Kue yang Dibeli:</span>
                            <span style="font-size: 13px; color: #6d4c41; font-weight: 600;">
                                @php
                                    $itemNames = [];
                                    foreach($order->items as $item) {
                                        $itemNames[] = $item->jumlah . 'x ' . ($item->produk->nama_produk ?? 'Kue');
                                    }
                                    echo implode(', ', $itemNames);
                                @endphp
                            </span>
                        </div>

                        <!-- Keterangan Waktu & Tombol Aksi -->
                        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
                            <span style="font-size: 11px; color: #a1887f; font-weight: bold; display: flex; align-items: center; gap: 5px;">
                                🕒 {{ $order->updated_at->diffForHumans() }}
                            </span>

                            <div style="display: flex; gap: 10px;">
                                @if($order->payment_status == 'unpaid' && $order->snap_token)
                                    <!-- Tombol Bayar Sekarang (Gaya Shopee) -->
                                    <button onclick="payNotifNow('{{ $order->snap_token }}')" style="background: linear-gradient(135deg, #25D366, #128C7E); color: white; border: none; padding: 8px 18px; border-radius: 50px; font-weight: 800; font-size: 12px; cursor: pointer; box-shadow: 0 4px 12px rgba(37,211,102,0.25); transition: all 0.3s; display: flex; align-items: center; gap: 6px;">
                                        💳 Bayar Sekarang
                                    </button>
                                @endif

                                @if($order->status == 'selesai')
                                    <!-- Tombol Lihat Nota -->
                                    <a href="{{ route('user.order.nota', $order->id) }}" target="_blank" style="background: #6d4c41; color: white; padding: 8px 18px; border-radius: 50px; text-decoration: none; font-weight: 700; font-size: 12px; box-shadow: 0 4px 10px rgba(109,76,65,0.15); transition: all 0.3s; display: flex; align-items: center; gap: 5px;">
                                        📄 Lihat Nota
                                    </a>
                                    <!-- Tombol Beri Ulasan -->
                                    <a href="{{ route('riwayat_pembelian') }}" style="background: #f06292; color: white; padding: 8px 18px; border-radius: 50px; text-decoration: none; font-weight: 700; font-size: 12px; box-shadow: 0 4px 10px rgba(240,98,146,0.15); transition: all 0.3s; display: flex; align-items: center; gap: 5px;">
                                        ⭐ Beri Ulasan
                                    </a>
                                @elseif($order->status == 'dikirim')
                                    <!-- Tombol Lacak Pesanan -->
                                    <a href="{{ route('pesanan_saya') }}" style="background: #f06292; color: white; padding: 8px 18px; border-radius: 50px; text-decoration: none; font-weight: 700; font-size: 12px; box-shadow: 0 4px 10px rgba(240,98,146,0.15); transition: all 0.3s; display: flex; align-items: center; gap: 5px;">
                                        🛵 Lacak Pesanan
                                    </a>
                                @elseif($order->status == 'disiapkan' || $order->status == 'baru')
                                    <!-- Tombol Lihat Detail -->
                                    <a href="{{ route('pesanan_saya') }}" style="background: #f06292; color: white; padding: 8px 18px; border-radius: 50px; text-decoration: none; font-weight: 700; font-size: 12px; box-shadow: 0 4px 10px rgba(240,98,146,0.15); transition: all 0.3s; display: flex; align-items: center; gap: 5px;">
                                        👁️ Lihat Detail
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<!-- Animasi Kustom Floating -->
<style>
    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
        100% { transform: translateY(0px); }
    }
    .notif-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(0,0,0,0.06) !important;
        filter: brightness(0.985);
    }
</style>
@endsection

@push('scripts')
<script>
    function payNotifNow(snapToken) {
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
                    alert("Pembayaran berhasil diproses!");
                    location.reload();
                });
            },
            onPending: function(result){
                alert("Menunggu pembayaran Anda diselesaikan!");
                location.reload();
            },
            onError: function(result){
                alert("Pembayaran gagal! Silakan coba lagi.");
                location.reload();
            },
            onClose: function(){
                // user menutup popup
            }
        });
    }
</script>
@endpush
