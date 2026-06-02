<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pengiriman - Dear Seana</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Titan+One&family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #f06292;
            --primary-dark: #ec407a;
            --secondary: #6d4c41;
            --background: #fffcfd;
            --card-bg: #ffffff;
            --text-main: #4e342e;
            --text-muted: #8d6e63;
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
            max-width: 900px;
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
            transition: background 0.3s;
        }

        .profile-link:hover {
            background: rgba(255, 255, 255, 0.2);
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
            max-width: 900px;
            margin: 30px auto;
            padding: 0 20px;
            flex: 1;
        }
        
        .page-header {
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .page-header h1 {
            color: var(--secondary);
            font-size: 26px;
            margin: 0;
        }

        .history-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .history-card {
            background: white;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            border-left: 5px solid #4caf50;
            display: flex;
            flex-direction: column;
            gap: 15px;
            transition: transform 0.2s;
        }

        .history-card:hover {
            transform: translateY(-2px);
        }

        .history-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #fce4ec;
            padding-bottom: 10px;
        }

        .order-id {
            font-weight: 800;
            color: var(--secondary);
        }

        .order-status {
            background: #e8f5e9;
            color: #2e7d32;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .history-body {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }
        
        @media (max-width: 600px) {
            .history-body {
                grid-template-columns: 1fr;
            }
        }

        .info-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .info-label {
            font-size: 12px;
            color: var(--text-muted);
            font-weight: 700;
            text-transform: uppercase;
        }

        .info-value {
            font-size: 15px;
            font-weight: 600;
            color: var(--text-main);
        }
        
        .proof-img {
            max-width: 100px;
            border-radius: 8px;
            cursor: pointer;
            border: 1px solid #ddd;
        }
        
        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 24px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
            border: 1px solid #fce4ec;
        }

        .empty-icon {
            font-size: 70px;
            margin-bottom: 20px;
            color: #ddd;
        }

        .empty-state h3 {
            color: var(--secondary);
            margin-bottom: 10px;
            font-weight: 800;
        }

        .empty-state p {
            color: var(--text-muted);
            margin: 0;
            font-weight: 600;
        }

        footer {
            text-align: center;
            padding: 20px;
            color: var(--text-muted);
            font-size: 13px;
            font-weight: 600;
            border-top: 1px solid #fce4ec;
            background: white;
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
                <a href="{{ route('kurir.history') }}" class="nav-link active"><i class="fas fa-history"></i> Riwayat</a>
            </div>
            
            <div class="user-menu">
                <a href="{{ route('kurir.profil.index') }}" class="profile-link">
                    <i class="fas fa-user-circle"></i> {{ Auth::guard('kurir')->user()->name }}
                </a>
                <form action="{{ route('kurir.logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- Main Container -->
    <div class="container">
        <div class="page-header">
            <h1><i class="fas fa-history"></i> Riwayat Pengiriman</h1>
            <a href="{{ route('kurir.dashboard') }}" class="btn-logout" style="background: var(--primary); color: white; text-decoration: none;">
                <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
            </a>
        </div>
        
        <div class="history-list">
            @if($orders->isEmpty())
                <div class="empty-state">
                    <div class="empty-icon"><i class="fas fa-box-open"></i></div>
                    <h3>Belum Ada Riwayat</h3>
                    <p>Anda belum menyelesaikan pengiriman apapun.</p>
                </div>
            @else
                @foreach($orders as $order)
                    <div class="history-card">
                        <div class="history-header">
                            <span class="order-id">Pesanan #{{ $order->id }}</span>
                            <span class="order-status"><i class="fas fa-check-circle"></i> Selesai</span>
                        </div>
                        <div class="history-body">
                            <div class="info-group">
                                <span class="info-label">Pelanggan</span>
                                <span class="info-value">{{ $order->nama_pelanggan }}</span>
                            </div>
                            <div class="info-group">
                                <span class="info-label">Alamat Kirim</span>
                                <span class="info-value">{{ $order->alamat }}</span>
                            </div>
                            <div class="info-group">
                                <span class="info-label">Waktu Selesai</span>
                                <span class="info-value">{{ $order->updated_at->format('d M Y, H:i') }}</span>
                            </div>
                            <div class="info-group">
                                <span class="info-label">Bukti Pengiriman</span>
                                @if($order->bukti_pengiriman)
                                    <a href="{{ asset($order->bukti_pengiriman) }}" target="_blank">
                                        <img src="{{ asset($order->bukti_pengiriman) }}" class="proof-img" alt="Bukti">
                                    </a>
                                @else
                                    <span class="info-value" style="color: red;">Tidak ada foto</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <!-- Footer -->
    <footer>
        &copy; 2026 Dear Seana Kurir Panel. Keajaiban Rasa Dalam Setiap Sematan.
    </footer>
</body>
</html>
