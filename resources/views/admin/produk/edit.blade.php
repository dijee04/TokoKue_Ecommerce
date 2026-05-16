@extends('admin.layouts.app')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Edit Produk</h1>
        <a href="{{ route('admin.produk.index') }}" class="btn" style="background: #e0e0e0; color: #333;">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card" style="max-width: 800px;">
        <form action="{{ route('admin.produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label class="form-label">Nama Produk</label>
                <input type="text" name="nama_produk" class="form-control" value="{{ $produk->nama_produk }}" required>
            </div>

            <div class="grid-2">
                <div class="form-group">
                    <label class="form-label">Kategori</label>
                    <select name="kategori_id" class="form-control" required>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ $produk->kategori_id == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Harga (Rp)</label>
                    <input type="number" name="harga" class="form-control" value="{{ $produk->harga }}" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Deskripsi Produk</label>
                <textarea name="deskripsi" class="form-control">{{ $produk->deskripsi }}</textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Foto Produk Baru (Biarkan kosong jika tidak ingin mengubah)</label>
                @if($produk->gambar)
                    <div style="margin-bottom: 10px;">
                        <img src="{{ asset('storage/' . $produk->gambar) }}" width="100" style="border-radius: 8px; border: 2px solid var(--border-color);">
                    </div>
                @endif
                <input type="file" name="gambar" class="form-control" style="padding: 9px 16px;">
            </div>

            <hr style="border: none; border-top: 1px solid var(--border-color); margin: 30px 0;">

            <button type="submit" class="btn btn-primary" style="padding: 12px 30px; font-size: 16px;">
                <i class="fas fa-save"></i> Update Produk
            </button>
        </form>
    </div>
@endsection
