@extends('admin.layouts.app')

@section('content')
    <div style="background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
        <h1 style="margin-top: 0; color: #83513E;">Ringkasan Toko</h1>
        <p>Selamat datang di panel kontrol admin. Dari sini Anda bisa mengelola produk, melihat pesanan baru, dan mengatur konten website.</p>
        
        <div style="display: flex; gap: 20px; margin-top: 30px;">
            <div style="flex: 1; background: #FFF4F2; padding: 20px; border-radius: 8px; border-left: 5px solid #F28AA1;">
                <h3>Total Produk</h3>
                <h2 style="font-size: 2rem; margin: 10px 0;">24</h2>
            </div>
            <div style="flex: 1; background: #F5F9FF; padding: 20px; border-radius: 8px; border-left: 5px solid #4A90E2;">
                <h3>Pesanan Baru</h3>
                <h2 style="font-size: 2rem; margin: 10px 0;">5</h2>
            </div>
            <div style="flex: 1; background: #F9F7F5; padding: 20px; border-radius: 8px; border-left: 5px solid #83513E;">
                <h3>Pendapatan</h3>
                <h2 style="font-size: 2rem; margin: 10px 0;">Rp 4.5M</h2>
            </div>
        </div>
    </div>
@endsection
