@extends('admin.layouts.app')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Edit Kategori</h1>
        <a href="{{ route('admin.kategori.index') }}" class="btn" style="background: #e0e0e0; color: #333;">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card" style="max-width: 600px;">
        <form action="{{ route('admin.kategori.update', $kategori->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label class="form-label">Nama Kategori</label>
                <input type="text" name="nama_kategori" class="form-control" value="{{ $kategori->nama_kategori }}" required>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Update Kategori
            </button>
        </form>
    </div>
@endsection
