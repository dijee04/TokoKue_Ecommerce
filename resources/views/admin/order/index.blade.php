@extends('admin.layouts.app')

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">Daftar Pesanan</h1>
            <p style="color: var(--text-muted); margin-top: 5px;">Kelola pesanan masuk dari pelanggan Anda.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th width="80">Order ID</th>
                        <th>Pelanggan</th>
                        <th>Kontak & Alamat</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th width="220" style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td style="font-weight: 700; color: var(--text-muted);">#{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</td>
                            <td style="font-weight: 600;">{{ $order->nama_pelanggan }}</td>
                            <td>
                                <div style="display: flex; flex-direction: column; gap: 4px; font-size: 13px;">
                                    <span><i class="fab fa-whatsapp" style="color: #25D366; width: 16px;"></i> {{ $order->no_wa }}</span>
                                    <span style="color: var(--text-muted);" title="{{ $order->alamat }}"><i class="fas fa-map-marker-alt" style="color: #e53935; width: 16px;"></i> {{ Str::limit($order->alamat, 40) }}</span>
                                </div>
                            </td>
                            <td style="font-weight: 700; color: var(--primary-dark);">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                            <td>
                                @php
                                    $badgeClass = '';
                                    if($order->status == 'baru') $badgeClass = 'badge-info';
                                    elseif($order->status == 'diproses') $badgeClass = 'badge-warning';
                                    elseif($order->status == 'selesai') $badgeClass = 'badge-success';
                                    elseif($order->status == 'dibatalkan') $badgeClass = 'badge-danger';
                                @endphp
                                <span class="badge {{ $badgeClass }}">{{ ucfirst($order->status) }}</span>
                            </td>
                            <td style="text-align: center;">
                                <div style="display: flex; gap: 8px; justify-content: center; align-items: center;">
                                    <a href="{{ route('admin.order.show', $order->id) }}" class="btn btn-sm btn-info" style="background: var(--info); color: white;">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                    <form action="{{ route('admin.order.update_status', $order->id) }}" method="POST" style="margin: 0;">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" onchange="this.form.submit()" class="form-control" style="padding: 4px 8px; border-radius: 4px; font-size: 13px; width: auto; height: 32px; min-width: 100px;">
                                            <option value="baru" {{ $order->status == 'baru' ? 'selected' : '' }}>Baru</option>
                                            <option value="diproses" {{ $order->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                            <option value="selesai" {{ $order->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                            <option value="dibatalkan" {{ $order->status == 'dibatalkan' ? 'selected' : '' }}>Batal</option>
                                        </select>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 40px; color: var(--text-muted);">
                                <i class="fas fa-clipboard-list" style="font-size: 48px; margin-bottom: 15px; opacity: 0.5; display: block;"></i>
                                Belum ada pesanan masuk
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
