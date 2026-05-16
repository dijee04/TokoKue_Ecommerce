@extends('admin.layouts.app')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Kelola User / Pelanggan</h1>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Kontak & Alamat</th>
                        <th>Role</th>
                        <th>Tanggal Terdaftar</th>
                        <th width="100" style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td style="font-weight: 600;">{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <div style="display: flex; flex-direction: column; gap: 4px; font-size: 13px;">
                                    <span>
                                        @if($user->no_wa)
                                            <i class="fab fa-whatsapp" style="color: #25D366; width: 16px;"></i> {{ $user->no_wa }}
                                        @else
                                            <span style="color: #ccc; font-style: italic;">Belum diisi</span>
                                        @endif
                                    </span>
                                    <span style="color: var(--text-muted);" title="{{ $user->alamat }}">
                                        @if($user->alamat)
                                            <i class="fas fa-map-marker-alt" style="color: #e53935; width: 16px;"></i> {{ Str::limit($user->alamat, 30) }}
                                        @else
                                            <span style="color: #ccc; font-style: italic;">Belum diisi</span>
                                        @endif
                                    </span>
                                </div>
                            </td>
                            <td>
                                <span class="badge" style="background: {{ $user->role === 'admin' ? '#ffebee' : '#e3f2fd' }}; color: {{ $user->role === 'admin' ? '#c62828' : '#1565c0' }};">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td>{{ $user->created_at->format('d M Y, H:i') }}</td>
                            <td style="text-align: center;">
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus user ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 40px; color: var(--text-muted);">
                                <i class="fas fa-users-slash" style="font-size: 48px; margin-bottom: 15px; opacity: 0.5; display: block;"></i>
                                Belum ada user yang terdaftar
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
