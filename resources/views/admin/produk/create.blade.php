@extends('admin.layouts.app')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Tambah Produk Baru</h1>
        <a href="{{ route('admin.produk.index') }}" class="btn" style="background: #e0e0e0; color: #333;">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card" style="max-width: 800px;">
        <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label class="form-label">Nama Produk</label>
                <input type="text" name="nama_produk" class="form-control" required placeholder="Contoh: Choco Lava Cake">
            </div>

            <div class="grid-2">
                <div class="form-group">
                    <label class="form-label">Kategori</label>
                    <select name="kategori_id" class="form-control" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Harga (Rp)</label>
                    <input type="number" name="harga" class="form-control" required placeholder="Contoh: 50000">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Deskripsi Produk</label>
                <textarea name="deskripsi" class="form-control" placeholder="Tuliskan deskripsi lengkap mengenai kue ini..."></textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Foto Produk (Opsional)</label>
                <input type="file" name="gambar" class="form-control" style="padding: 9px 16px;">
                <small style="color: var(--text-muted); margin-top: 5px; display: block;">*Format yang didukung: JPG, PNG, JPEG. Maks: 2MB.</small>
            </div>

            <hr style="border: none; border-top: 1px solid var(--border-color); margin: 30px 0;">

            <button type="submit" class="btn btn-primary" style="padding: 12px 30px; font-size: 16px;">
                <i class="fas fa-save"></i> Simpan Produk
            </button>
        </form>
    </div>
@endsection
