@extends('admin.layouts.app')

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">Ringkasan Toko</h1>
            <p style="color: var(--text-muted); margin-top: 5px;">Pantau performa penjualan dan produk Anda hari ini.</p>
        </div>
    </div>

    <div class="stats-grid">
        <div class="stat-card" style="border-left: 4px solid var(--accent-color);">
            <div class="stat-icon" style="background: rgba(240, 98, 146, 0.1); color: var(--accent-color);">
                <i class="fas fa-box-open"></i>
            </div>
            <div class="stat-info">
                <h3>Total Produk</h3>
                <div class="stat-value">{{ $totalProduk }}</div>
            </div>
        </div>

        <div class="stat-card" style="border-left: 4px solid var(--info);">
            <div class="stat-icon" style="background: var(--info-bg); color: var(--info);">
                <i class="fas fa-shopping-bag"></i>
            </div>
            <div class="stat-info">
                <h3>Pesanan Baru</h3>
                <div class="stat-value">{{ $pesananBaru }}</div>
            </div>
        </div>

        <div class="stat-card" style="border-left: 4px solid var(--success);">
            <div class="stat-icon" style="background: var(--success-bg); color: var(--success);">
                <i class="fas fa-wallet"></i>
            </div>
            <div class="stat-info">
                <h3>Total Pendapatan</h3>
                <div class="stat-value" style="font-size: 24px;">Rp {{ number_format($pendapatan, 0, ',', '.') }}</div>
            </div>
        </div>
    </div>

    <div class="card">
        <h3 style="margin-bottom: 15px; border-bottom: 1px solid var(--border-color); padding-bottom: 15px;">
            <i class="fas fa-lightbulb" style="color: var(--warning); margin-right: 8px;"></i> Pintasan Cepat
        </h3>
        <div class="grid-3">
            <a href="{{ route('admin.produk.create') }}" class="btn btn-primary" style="padding: 15px;">
                <i class="fas fa-plus"></i> Tambah Produk Baru
            </a>
            <a href="{{ route('admin.order.index') }}" class="btn btn-info" style="padding: 15px; background: var(--info); color: white;">
                <i class="fas fa-list"></i> Lihat Daftar Pesanan
            </a>
            <a href="{{ route('admin.setting.index') }}" class="btn" style="padding: 15px; background: #e0e0e0; color: #333;">
                <i class="fas fa-cog"></i> Pengaturan Toko
            </a>
        </div>
    </div>
@endsection
