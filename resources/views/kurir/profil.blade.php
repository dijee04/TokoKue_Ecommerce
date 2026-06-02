<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Kurir - Dear Seana</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #f06292;
            --primary-dark: #ec407a;
            --secondary: #6d4c41;
            --background: #f4f6f9;
            --card-bg: #ffffff;
            --text-main: #333333;
            --text-muted: #777777;
            --border-color: #eaeaea;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--background);
            color: var(--text-main);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Header */
        header {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            padding: 15px 20px;
            box-shadow: 0 4px 15px rgba(240, 98, 146, 0.25);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-container {
            max-width: 1100px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 22px;
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: white;
        }

        .logo-small {
            font-family: 'Dancing Script', cursive;
            font-size: 24px;
            color: #fff5f5;
        }

        .nav-menu {
            display: flex;
            gap: 15px;
            align-items: center;
        }
        
        .nav-link {
            color: white;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            padding: 8px 12px;
            border-radius: 8px;
            transition: background 0.3s;
        }
        
        .nav-link:hover, .nav-link.active {
            background: rgba(255, 255, 255, 0.2);
        }

        .profile-link {
            color: white;
            text-decoration: none;
            font-weight: 700;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 8px 12px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.2); /* Active state styling since we are on profile */
            transition: background 0.3s;
        }

        .profile-link:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .btn-logout {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .btn-logout:hover {
            background: white;
            color: var(--primary-dark);
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        /* Main Container */
        .container {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 20px;
            flex: 1;
            width: 100%;
            box-sizing: border-box;
        }
        
        .page-header {
            margin-bottom: 30px;
        }
        
        .page-header h1 {
            color: var(--secondary);
            font-size: 28px;
            margin: 0 0 5px 0;
            font-weight: 800;
        }
        
        .page-header p {
            margin: 0;
            color: var(--text-muted);
            font-size: 15px;
        }

        /* Desktop Profile Layout */
        .profile-layout {
            display: grid;
            grid-template-columns: 350px 1fr;
            gap: 30px;
            align-items: start;
        }
        
        @media (max-width: 850px) {
            .profile-layout {
                grid-template-columns: 1fr;
            }
        }

        /* Left Card */
        .profile-card-left {
            background: var(--card-bg);
            border-radius: 20px;
            padding: 40px 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            border: 1px solid var(--border-color);
            text-align: center;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, #fce4ec, #f8bbd0);
            color: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 50px;
            margin: 0 auto 20px auto;
            box-shadow: 0 8px 25px rgba(240, 98, 146, 0.2);
            border: 4px solid white;
        }

        .profile-card-left h2 {
            margin: 0 0 5px 0;
            font-size: 22px;
            color: var(--secondary);
            font-weight: 800;
        }

        .profile-card-left p {
            margin: 0 0 20px 0;
            color: var(--text-muted);
            font-size: 14px;
        }
        
        .profile-stats {
            display: flex;
            justify-content: space-around;
            border-top: 1px solid var(--border-color);
            padding-top: 20px;
            margin-top: 20px;
        }
        
        .stat-item {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        
        .stat-value {
            font-size: 20px;
            font-weight: 800;
            color: var(--primary);
        }
        
        .stat-label {
            font-size: 12px;
            color: var(--text-muted);
            font-weight: 600;
            text-transform: uppercase;
        }

        /* Right Form Card */
        .profile-card-right {
            background: var(--card-bg);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            border: 1px solid var(--border-color);
        }
        
        .form-section-title {
            font-size: 18px;
            color: var(--secondary);
            font-weight: 700;
            margin: 0 0 20px 0;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--border-color);
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        
        @media (max-width: 600px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
        }

        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group.full-width {
            grid-column: 1 / -1;
        }
        
        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--text-main);
            font-size: 13px;
        }
        
        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #dcdcdc;
            background: #fafafa;
            border-radius: 10px;
            font-family: 'Outfit', sans-serif;
            font-size: 14px;
            color: var(--text-main);
            transition: all 0.3s;
            box-sizing: border-box;
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            background: white;
            box-shadow: 0 0 0 3px rgba(240, 98, 146, 0.1);
        }

        .btn-submit {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            border: none;
            padding: 12px 35px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 15px;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(240, 98, 146, 0.3);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.3s;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(240, 98, 146, 0.4);
        }
        
        .form-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 10px;
            padding-top: 20px;
            border-top: 1px solid var(--border-color);
        }
        
        /* Alert styling */
        .alert {
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 30px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success {
            background: #e8f5e9;
            color: #2e7d32;
            border: 1px solid #c8e6c9;
        }

        .alert-danger {
            background: #ffebee;
            color: #c62828;
            border: 1px solid #ffcdd2;
        }

        footer {
            text-align: center;
            padding: 20px;
            color: var(--text-muted);
            font-size: 13px;
            font-weight: 600;
            background: white;
            border-top: 1px solid var(--border-color);
            margin-top: auto;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header>
        <div class="header-container">
            <a href="{{ route('kurir.dashboard') }}" class="logo">
                <i class="fas fa-motorcycle"></i>
                <span>Dear Seana <span class="logo-small">Kurir</span></span>
            </a>
            
            <div class="nav-menu">
                <a href="{{ route('kurir.dashboard') }}" class="nav-link"><i class="fas fa-home"></i> Beranda</a>
                <a href="{{ route('kurir.history') }}" class="nav-link"><i class="fas fa-history"></i> Riwayat</a>
            </div>
            
            <div class="user-menu">
                <a href="{{ route('kurir.profil.index') }}" class="profile-link">
                    <i class="fas fa-user-circle"></i> {{ Auth::guard('kurir')->user()->name }}
                </a>
                <form action="{{ route('kurir.logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-logout" title="Keluar">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- Main Container -->
    <div class="container">
        
        <!-- Alerts -->
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                <div style="margin-left: 10px;">
                    <ul style="margin: 0; padding-left: 15px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <div class="page-header">
            <h1>Profil Akun</h1>
            <p>Kelola informasi pribadi dan data kendaraan Anda.</p>
        </div>
        
        <div class="profile-layout">
            <!-- Left Side: Profile Card -->
            <div class="profile-card-left">
                <div class="profile-avatar">
                    <i class="fas fa-user-tie"></i>
                </div>
                <h2>{{ $user->name }}</h2>
                <p>{{ $user->email }}</p>
                
                <div style="margin-top: 15px; display: inline-flex; align-items: center; gap: 8px; background: #e3f2fd; color: #1565c0; padding: 6px 15px; border-radius: 50px; font-size: 13px; font-weight: 700;">
                    <i class="fas fa-motorcycle"></i> Kurir Toko
                </div>
                
                <div class="profile-stats">
                    <div class="stat-item">
                        @php $selesaiCount = \App\Models\Order::where('kurir_id', $user->id)->where('status', 'selesai')->count(); @endphp
                        <span class="stat-value">{{ $selesaiCount }}</span>
                        <span class="stat-label">Terkirim</span>
                    </div>
                </div>
            </div>

            <!-- Right Side: Edit Form -->
            <div class="profile-card-right">
                <form action="{{ route('kurir.profil.update') }}" method="POST">
                    @csrf
                    
                    <h3 class="form-section-title">Informasi Pribadi</h3>
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">No. WhatsApp / HP</label>
                            <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $user->no_wa ?? '') }}" placeholder="Contoh: 081234567890">
                        </div>
                    </div>

                    <h3 class="form-section-title" style="margin-top: 20px;">Data Kendaraan</h3>
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Jenis Kendaraan</label>
                            <input type="text" name="kendaraan" class="form-control" value="{{ old('kendaraan', $user->kendaraan ?? '') }}" placeholder="Contoh: Honda Beat Hitam">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Plat Nomor Kendaraan</label>
                            <input type="text" name="plat_nomor" class="form-control" value="{{ old('plat_nomor', $user->plat_nomor ?? '') }}" placeholder="Contoh: B 1234 ABC">
                        </div>
                    </div>

                    <h3 class="form-section-title" style="margin-top: 20px;">Keamanan</h3>
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Password Baru (Opsional)</label>
                            <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak diubah">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Ketik ulang password baru">
                        </div>
                    </div>
                    
                    <div class="form-actions">
                        <button type="submit" class="btn-submit">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        &copy; 2026 Dear Seana Kurir Panel. Keajaiban Rasa Dalam Setiap Sematan.
    </footer>
</body>
</html>
