@extends('admin.layouts.app')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Daftar Kategori</h1>
        <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Kategori
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
                        <th width="80">ID</th>
                        <th>Nama Kategori</th>
                        <th width="200" style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kategoris as $kategori)
                        <tr>
                            <td style="font-weight: 600; color: var(--text-muted);">#{{ $kategori->id }}</td>
                            <td style="font-weight: 600;">{{ $kategori->nama_kategori }}</td>
                            <td style="text-align: center;">
                                <a href="{{ route('admin.kategori.edit', $kategori->id) }}" class="btn btn-sm" style="background: #e0e0e0; color: #333;">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('admin.kategori.destroy', $kategori->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" style="text-align: center; padding: 30px; color: var(--text-muted);">
                                <i class="fas fa-folder-open" style="font-size: 32px; margin-bottom: 10px; opacity: 0.5; display: block;"></i>
                                Belum ada kategori
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
