@extends('admin.layouts.app')

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">Pengaturan Web</h1>
            <p style="color: var(--text-muted); margin-top: 5px;">Kelola informasi kontak dan metode pembayaran yang tampil di website.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <div class="card" style="max-width: 800px;">
        <form action="{{ route('admin.setting.update') }}" method="POST">
            @csrf
            @method('PUT')
            
            <h3 style="color: var(--primary-dark); border-bottom: 2px solid var(--border-color); padding-bottom: 10px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                <i class="fab fa-whatsapp" style="color: #25D366;"></i> Informasi Kontak
            </h3>
            <div class="form-group">
                <label class="form-label">Nomor WhatsApp Admin (awali dengan 62)</label>
                <div style="position: relative;">
                    <span style="position: absolute; left: 15px; top: 12px; color: var(--text-muted);"><i class="fas fa-phone-alt"></i></span>
                    <input type="text" name="wa_number" value="{{ $setting->wa_number }}" class="form-control" required style="padding-left: 40px;" placeholder="Contoh: 6281234567890">
                </div>
            </div>

            <h3 style="color: var(--primary-dark); border-bottom: 2px solid var(--border-color); padding-bottom: 10px; margin-top: 40px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                <i class="fas fa-university" style="color: var(--info);"></i> Transfer Bank
            </h3>
            <div class="grid-2">
                <div class="form-group">
                    <label class="form-label">Nama Bank</label>
                    <input type="text" name="bank_name" value="{{ $setting->bank_name }}" class="form-control" required placeholder="Contoh: BCA">
                </div>
                <div class="form-group">
                    <label class="form-label">No. Rekening</label>
                    <input type="text" name="bank_account" value="{{ $setting->bank_account }}" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Atas Nama (Bank)</label>
                <input type="text" name="bank_owner" value="{{ $setting->bank_owner }}" class="form-control" required>
            </div>

            <h3 style="color: var(--primary-dark); border-bottom: 2px solid var(--border-color); padding-bottom: 10px; margin-top: 40px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                <i class="fas fa-wallet" style="color: #008ee6;"></i> DANA
            </h3>
            <div class="grid-2">
                <div class="form-group">
                    <label class="form-label">Nomor DANA</label>
                    <input type="text" name="dana_number" value="{{ $setting->dana_number }}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Atas Nama (DANA)</label>
                    <input type="text" name="dana_owner" value="{{ $setting->dana_owner }}" class="form-control" required>
                </div>
            </div>

            <h3 style="color: var(--primary-dark); border-bottom: 2px solid var(--border-color); padding-bottom: 10px; margin-top: 40px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                <i class="fas fa-wallet" style="color: #00a5cf;"></i> GoPay
            </h3>
            <div class="grid-2">
                <div class="form-group">
                    <label class="form-label">Nomor GoPay</label>
                    <input type="text" name="gopay_number" value="{{ $setting->gopay_number }}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Atas Nama (GoPay)</label>
                    <input type="text" name="gopay_owner" value="{{ $setting->gopay_owner }}" class="form-control" required>
                </div>
            </div>

            <hr style="border: none; border-top: 1px solid var(--border-color); margin: 30px 0;">

            <button type="submit" class="btn btn-primary" style="padding: 12px 30px; font-size: 16px;">
                <i class="fas fa-save"></i> Simpan Pengaturan
            </button>
        </form>
    </div>
@endsection
