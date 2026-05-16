@extends('admin.layouts.app')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Kelola Produk</h1>
        <a href="{{ route('admin.produk.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Produk
        </a>
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
                        <th width="100">Gambar</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th width="200" style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($produks as $produk)
                        <tr>
                            <td>
                                @if($produk->gambar)
                                    <img src="{{ asset('storage/' . $produk->gambar) }}" width="60" height="60" style="object-fit: cover; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                @else
                                    <div style="width: 60px; height: 60px; background: #eee; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #999;">
                                        <i class="fas fa-image"></i>
                                    </div>
                                @endif
                            </td>
                            <td style="font-weight: 600;">{{ $produk->nama_produk }}</td>
                            <td>
                                <span class="badge" style="background: #e0e0e0; color: #333;">
                                    {{ $produk->kategori->nama_kategori ?? '-' }}
                                </span>
                            </td>
                            <td style="font-weight: 700; color: var(--primary-dark);">Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                            <td style="text-align: center;">
                                <a href="{{ route('admin.produk.edit', $produk->id) }}" class="btn btn-sm" style="background: #e0e0e0; color: #333;">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('admin.produk.destroy', $produk->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 40px; color: var(--text-muted);">
                                <i class="fas fa-box-open" style="font-size: 48px; margin-bottom: 15px; opacity: 0.5; display: block;"></i>
                                Belum ada produk yang ditambahkan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
