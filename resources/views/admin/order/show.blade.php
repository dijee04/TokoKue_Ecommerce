@extends('admin.layouts.app')

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">Detail Pesanan #{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</h1>
            <p style="color: var(--text-muted); margin-top: 5px;">Tanggal: {{ $order->created_at->format('d M Y, H:i') }}</p>
        </div>
        <a href="{{ route('admin.order.index') }}" class="btn" style="background: #e0e0e0; color: #333;">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="grid-2">
        <div class="card" style="border-top: 4px solid var(--primary-color);">
            <h3 style="margin-bottom: 15px; display: flex; align-items: center; gap: 10px;">
                <i class="fas fa-user-circle" style="color: var(--primary-light);"></i> Informasi Pelanggan
            </h3>
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="padding: 8px 0; color: var(--text-muted); width: 100px;">Nama</td>
                    <td style="padding: 8px 0; font-weight: 600;">: {{ $order->nama_pelanggan }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; color: var(--text-muted);">WhatsApp</td>
                    <td style="padding: 8px 0; font-weight: 600;">
                        : <a href="https://wa.me/{{ $order->no_wa }}" target="_blank" style="color: #25D366;"><i class="fab fa-whatsapp"></i> {{ $order->no_wa }}</a>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; color: var(--text-muted); vertical-align: top;">Alamat</td>
                    <td style="padding: 8px 0; font-weight: 600; line-height: 1.5;">: {{ $order->alamat }}</td>
                </tr>
            </table>
        </div>

        <div class="card" style="border-top: 4px solid var(--info);">
            <h3 style="margin-bottom: 15px; display: flex; align-items: center; gap: 10px;">
                <i class="fas fa-credit-card" style="color: var(--info);"></i> Detail Pembayaran
            </h3>
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="padding: 8px 0; color: var(--text-muted); width: 100px;">Metode</td>
                    <td style="padding: 8px 0; font-weight: 600; text-transform: uppercase;">: {{ $order->metode_pembayaran }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; color: var(--text-muted);">Pembayaran</td>
                    <td style="padding: 8px 0;">
                        : 
                        @if($order->payment_status == 'paid')
                            <span class="badge badge-success">Lunas</span>
                        @elseif($order->payment_status == 'unpaid')
                            <span class="badge badge-warning">Belum Dibayar</span>
                        @elseif($order->payment_status == 'failed' || $order->payment_status == 'expired')
                            <span class="badge badge-danger">Gagal / Kedaluwarsa</span>
                        @else
                            <span class="badge badge-info">{{ ucfirst($order->payment_status) }}</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; color: var(--text-muted);">Status Pesanan</td>
                    <td style="padding: 8px 0;">
                        : 
                        @php
                            $badgeClass = '';
                            if($order->status == 'baru') $badgeClass = 'badge-info';
                            elseif($order->status == 'disiapkan') $badgeClass = 'badge-warning';
                            elseif($order->status == 'menunggu_kurir') $badgeClass = 'badge-primary';
                            elseif($order->status == 'dikirim') $badgeClass = 'badge-secondary';
                            elseif($order->status == 'selesai') $badgeClass = 'badge-success';
                            elseif($order->status == 'dibatalkan') $badgeClass = 'badge-danger';
                        @endphp
                        <span class="badge {{ $badgeClass }}">{{ ucfirst(str_replace('_', ' ', $order->status)) }}</span>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 15px 0 8px 0; color: var(--text-muted); font-size: 16px;">Total Tagihan</td>
                    <td style="padding: 15px 0 8px 0; font-weight: 800; font-size: 24px; color: var(--accent-color);">
                        Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                    </td>
                </tr>
            </table>
        </div>
    </div>

    {{-- Update Status Card --}}
    <div class="card" style="border-top: 4px solid var(--primary-color); margin-top: 0;">
        <h3 style="margin-bottom: 15px; display: flex; align-items: center; gap: 10px;">
            <i class="fas fa-edit" style="color: var(--primary-light);"></i> Ubah Status Pesanan
        </h3>
        <form action="{{ route('admin.order.update_status', $order->id) }}" method="POST" style="display: flex; gap: 12px; align-items: flex-end; flex-wrap: wrap;">
            @csrf
            @method('PATCH')
            <div>
                <label style="font-size:13px; font-weight:700; color:#777; display:block; margin-bottom:5px;">Status</label>
                <select name="status" id="statusSelect" onchange="toggleOngkirField(this.value)" class="form-control" style="max-width: 220px; height: 40px; border-radius: 8px; font-weight: 600;">
                    <option value="baru"           {{ $order->status == 'baru'           ? 'selected' : '' }}>Baru</option>
                    <option value="disiapkan"      {{ $order->status == 'disiapkan'      ? 'selected' : '' }}>Disiapkan</option>
                    <option value="menunggu_kurir" {{ $order->status == 'menunggu_kurir' ? 'selected' : '' }}>Menunggu Kurir</option>
                    <option value="dikirim"        {{ $order->status == 'dikirim'        ? 'selected' : '' }}>Dikirim</option>
                    <option value="selesai"        {{ $order->status == 'selesai'        ? 'selected' : '' }}>Selesai</option>
                    <option value="dibatalkan"     {{ $order->status == 'dibatalkan'     ? 'selected' : '' }}>Dibatalkan</option>
                </select>
            </div>

            {{-- Ongkir input: tampil hanya saat pilih "menunggu_kurir" --}}
            <div id="ongkirField" style="display: {{ $order->status == 'menunggu_kurir' ? 'block' : 'none' }};">
                <label style="font-size:13px; font-weight:700; color:#777; display:block; margin-bottom:5px;">
                    <i class="fas fa-motorcycle" style="color:#f06292;"></i> Ongkos Kirim (Rp)
                </label>
                <input type="number"
                       name="ongkir"
                       id="ongkirInput"
                       value="{{ old('ongkir', $order->ongkir ?? '') }}"
                       min="0"
                       step="500"
                       placeholder="cth: 10000"
                       class="form-control"
                       style="width: 180px; height: 40px; border-radius: 8px; font-weight: 600; border: 2px solid #f06292;">
            </div>

            <button type="submit" class="btn" style="background: var(--primary-color); color: white; height: 40px; padding: 0 20px; border-radius: 8px; font-weight: 700;">
                <i class="fas fa-save"></i> Simpan Status
            </button>
        </form>

        @if($order->ongkir)
        <div style="margin-top: 15px; padding: 12px 18px; background: #e8f5e9; border-radius: 10px; display: flex; align-items: center; gap: 10px; border: 1px solid #c8e6c9;">
            <i class="fas fa-truck" style="color: #2e7d32; font-size:18px;"></i>
            <span style="font-weight: 700; color: #2e7d32;">Ongkir aktif: <strong>Rp {{ number_format($order->ongkir, 0, ',', '.') }}</strong> — akan ditagih kurir ke pelanggan secara tunai.</span>
        </div>
        @endif

        @if($order->kurir)
        <div style="margin-top: 10px; padding: 12px 18px; background: #fff3e0; border-radius: 10px; display: flex; align-items: center; gap: 10px; border: 1px solid #ffe0b2;">
            <i class="fas fa-motorcycle" style="color: #e65100; font-size:18px;"></i>
            <span style="font-weight: 700; color: #e65100;">Kurir: <strong>{{ $order->kurir->name }}</strong></span>
        </div>
        @endif
    </div>

    <script>
        function toggleOngkirField(status) {
            const field = document.getElementById('ongkirField');
            const input = document.getElementById('ongkirInput');
            if (status === 'menunggu_kurir') {
                field.style.display = 'block';
                input.required = true;
            } else {
                field.style.display = 'none';
                input.required = false;
            }
        }
        // Run on page load
        toggleOngkirField(document.getElementById('statusSelect').value);
    </script>

    <div class="card">
        <h3 style="margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
            <i class="fas fa-shopping-basket" style="color: var(--accent-color);"></i> Daftar Produk yang Dipesan
        </h3>
        
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Kue</th>
                        <th style="text-align: center;">Harga Satuan</th>
                        <th style="text-align: center;">Jumlah</th>
                        <th style="text-align: right;">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr>
                        <td>
                            <div style="font-weight: 700; color: var(--primary-dark);">{{ $item->produk->nama_produk ?? 'Produk Dihapus' }}</div>
                        </td>
                        <td style="text-align: center; color: var(--text-muted);">Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                        <td style="text-align: center;">
                            <span style="background: #f0f0f0; padding: 4px 12px; border-radius: 12px; font-weight: 600;">{{ $item->jumlah }}x</span>
                        </td>
                        <td style="text-align: right; font-weight: 700;">Rp {{ number_format($item->harga_satuan * $item->jumlah, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr style="background: #fdfbf7;">
                        <td colspan="3" style="padding: 10px 16px; text-align: right; font-weight: 600; font-size: 15px; color: var(--text-muted);">Subtotal Barang</td>
                        <td style="padding: 10px 16px; text-align: right; font-weight: 700; font-size: 16px;">
                            Rp {{ number_format($order->total_harga - ($order->ongkir ?? 0), 0, ',', '.') }}
                        </td>
                    </tr>
                    <tr style="background: #fdfbf7;">
                        <td colspan="3" style="padding: 10px 16px; text-align: right; font-weight: 600; font-size: 15px; color: var(--text-muted);">Ongkos Kirim</td>
                        <td style="padding: 10px 16px; text-align: right; font-weight: 700; font-size: 16px;">
                            Rp {{ number_format($order->ongkir ?? 0, 0, ',', '.') }}
                        </td>
                    </tr>
                    <tr style="background: #fdfbf7; border-top: 2px solid #eee;">
                        <td colspan="3" style="padding: 20px 16px; text-align: right; font-weight: 700; font-size: 16px;">Grand Total</td>
                        <td style="padding: 20px 16px; text-align: right; font-weight: 800; font-size: 20px; color: var(--accent-color);">
                            Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    @if($order->reviews->isNotEmpty())
    <div class="card" style="border-top: 4px solid #ffb300; margin-top: 30px;">
        <h3 style="margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
            <i class="fas fa-star" style="color: #ffb300;"></i> Ulasan & Rating dari Pelanggan
        </h3>
        
        @foreach($order->reviews as $review)
        <div style="background: #fffdf9; border: 1px solid #ffe8d6; padding: 20px; border-radius: 16px; margin-bottom: 15px; display: flex; gap: 20px; flex-wrap: wrap;">
            <!-- Avatar / Inisial User -->
            <div style="width: 55px; height: 55px; border-radius: 50%; background: #ffe8d6; color: #a0522d; font-weight: 800; display: flex; align-items: center; justify-content: center; font-size: 20px; border: 1px solid rgba(0,0,0,0.05); flex-shrink: 0; box-shadow: 0 4px 10px rgba(0,0,0,0.02);">
                {{ strtoupper(substr($review->user->name ?? 'P', 0, 1)) }}
            </div>
            
            <div style="flex: 1; min-width: 250px;">
                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 10px; flex-wrap: wrap; gap: 10px;">
                    <div>
                        <strong style="color: #5c3a21; font-size: 16.5px;">{{ $review->user->name ?? 'Pelanggan Setia' }}</strong>
                        <div style="color: #ffb300; font-size: 14px; margin-top: 5px;">
                            @for($i=1; $i<=5; $i++)
                                <i class="fas fa-star" style="color: {{ $i <= $review->rating ? '#ffb300' : '#e0e0e0' }}; font-size: 15px;"></i>
                            @endfor
                            <span style="color: #666; font-size: 12.5px; font-weight: bold; margin-left: 5px;">({{ $review->rating }} / 5)</span>
                        </div>
                    </div>
                    <span style="font-size: 12.5px; color: #a1887f; font-weight: 600;">
                        {{ $review->created_at->format('d M Y, H:i') }}
                    </span>
                </div>
                
                <p style="font-style: italic; color: #5c3a21; font-size: 14.5px; line-height: 1.6; background: white; padding: 12px 18px; border-radius: 12px; border-left: 4px solid #ffb300; margin-bottom: 18px; box-shadow: inset 0 1px 3px rgba(0,0,0,0.01);">
                    "{{ $review->ulasan ?: 'Tidak memberikan komentar ulasan.' }}"
                </p>
                
                @if($review->foto)
                    <div>
                        <strong style="display: block; font-size: 13.5px; color: #6d4c41; margin-bottom: 8px;"><i class="fas fa-image"></i> Foto Kue dari Pelanggan:</strong>
                        <a href="{{ asset($review->foto) }}" target="_blank">
                            <img src="{{ asset($review->foto) }}" style="width: 140px; height: 140px; object-fit: cover; border-radius: 14px; border: 2px solid white; box-shadow: 0 4px 15px rgba(0,0,0,0.08); transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.03)'" onmouseout="this.style.transform='scale(1)'">
                        </a>
                    </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>
    @endif
@endsection

