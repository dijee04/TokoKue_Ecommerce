<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Menunggu - Dear Seana Kurir</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
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
            --green: #2e7d32;
            --green-light: #e8f5e9;
            --orange: #e65100;
            --orange-light: #fff3e0;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--background);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

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

        .btn-back {
            background: rgba(255,255,255,0.2);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 13px;
            cursor: pointer;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: all 0.3s;
        }

        .btn-back:hover {
            background: white;
            color: var(--primary-dark);
        }

        .container {
            max-width: 900px;
            margin: 30px auto;
            padding: 0 20px;
            flex: 1;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .page-title h2 {
            font-size: 26px;
            font-weight: 800;
            color: var(--secondary);
            margin-bottom: 4px;
        }

        .page-title p {
            font-size: 14px;
            color: var(--text-muted);
            font-weight: 500;
        }

        .badge-pending {
            background: linear-gradient(135deg, #ff7043, #e64a19);
            color: white;
            padding: 10px 20px;
            border-radius: 50px;
            font-weight: 800;
            font-size: 14px;
            box-shadow: 0 4px 12px rgba(230,74,25,0.3);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .badge-pending .dot {
            width: 8px;
            height: 8px;
            background: white;
            border-radius: 50%;
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(0.8); }
        }

        /* Alert */
        .alert {
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .alert-success { background: #e8f5e9; color: #2e7d32; border: 1px solid #c8e6c9; }
        .alert-danger  { background: #ffebee; color: #c62828; border: 1px solid #ffcdd2; }

        /* Order Cards */
        .order-grid {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .order-card {
            background: var(--card-bg);
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.05);
            border: 1px solid #fce4ec;
            transition: transform 0.3s, box-shadow 0.3s;
            position: relative;
            overflow: hidden;
        }

        .order-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0;
            width: 5px; height: 100%;
            background: linear-gradient(180deg, var(--primary), var(--primary-dark));
            border-radius: 20px 0 0 20px;
        }

        .order-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 14px 35px rgba(240,98,146,0.12);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1.5px solid #fce4ec;
            padding-bottom: 15px;
            margin-bottom: 18px;
        }

        .order-id {
            font-weight: 800;
            font-size: 16px;
            color: var(--secondary);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .order-time {
            font-size: 13px;
            color: var(--text-muted);
            font-weight: 600;
        }

        .card-body {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 20px;
        }

        @media (max-width: 600px) {
            .card-body { grid-template-columns: 1fr; }
        }

        .info-item { }

        .info-label {
            font-size: 12px;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .info-value {
            font-size: 15px;
            font-weight: 700;
            color: var(--text-main);
        }

        .info-value.highlight {
            font-size: 17px;
            color: var(--secondary);
            font-weight: 800;
        }

        .info-value.ongkir-value {
            color: var(--green);
            font-size: 16px;
        }

        .info-value.total-value {
            color: var(--primary-dark);
            font-size: 17px;
        }

        .card-footer {
            display: flex;
            justify-content: flex-end;
        }

        .btn-confirm {
            background: linear-gradient(135deg, #f06292, #ec407a);
            color: white;
            border: none;
            padding: 12px 28px;
            border-radius: 50px;
            font-weight: 800;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 15px rgba(236,64,122,0.35);
            transition: all 0.3s;
        }

        .btn-confirm:hover {
            box-shadow: 0 6px 20px rgba(236,64,122,0.5);
            filter: brightness(1.05);
            transform: translateY(-1px);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 70px 20px;
            background: white;
            border-radius: 24px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.05);
            border: 1px solid #fce4ec;
        }

        .empty-icon { font-size: 72px; margin-bottom: 20px; }

        .empty-state h3 {
            color: var(--secondary);
            font-weight: 800;
            margin-bottom: 10px;
            font-size: 22px;
        }

        .empty-state p {
            color: var(--text-muted);
            font-weight: 500;
            font-size: 15px;
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

    <header>
        <div class="header-container">
            <a href="{{ route('kurir.dashboard') }}" class="logo">
                <i class="fas fa-motorcycle"></i>
                <span>Dear Seana <span class="logo-small">Kurir</span></span>
            </a>
            <a href="{{ route('kurir.dashboard') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </header>

    <div class="container">

        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            </div>
        @endif

        <div class="page-header">
            <div class="page-title">
                <h2>📦 Pesanan Menunggu Konfirmasi</h2>
                <p>Pilih pesanan untuk melihat detail dan menerima pengantaran.</p>
            </div>
            @if($orders->count() > 0)
                <div class="badge-pending">
                    <span class="dot"></span>
                    {{ $orders->count() }} Pesanan Tersedia
                </div>
            @endif
        </div>

        <div class="order-grid">
            @if($orders->isEmpty())
                <div class="empty-state">
                    <div class="empty-icon">✅</div>
                    <h3>Tidak Ada Pesanan Baru</h3>
                    <p>Saat ini tidak ada pesanan yang menunggu kurir. Silakan cek kembali nanti.</p>
                </div>
            @else
                @foreach($orders as $order)
                    <div class="order-card">
                        <div class="card-header">
                            <span class="order-id">
                                <i class="fas fa-shopping-bag"></i> Pesanan #{{ $order->id }}
                            </span>
                            <span class="order-time">
                                <i class="fas fa-clock"></i> {{ $order->created_at->format('d M Y, H:i') }}
                            </span>
                        </div>

                        <div class="card-body">
                            <div class="info-item">
                                <div class="info-label"><i class="fas fa-user"></i> Pelanggan</div>
                                <div class="info-value highlight">{{ $order->nama_pelanggan }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label"><i class="fab fa-whatsapp"></i> No. WhatsApp</div>
                                <div class="info-value">{{ $order->no_wa }}</div>
                            </div>
                            <div class="info-item" style="grid-column: 1 / -1;">
                                <div class="info-label"><i class="fas fa-map-marker-alt"></i> Alamat Pengantaran</div>
                                <div class="info-value">{{ $order->alamat }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label"><i class="fas fa-truck"></i> Ongkos Kirim</div>
                                <div class="info-value ongkir-value">Rp {{ number_format($order->ongkir ?? 0, 0, ',', '.') }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label"><i class="fas fa-receipt"></i> Total Pembayaran</div>
                                <div class="info-value total-value">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <a href="{{ route('kurir.order.confirm', ['order' => $order->id]) }}" class="btn-confirm">
                                <i class="fas fa-clipboard-check"></i> Lihat Detail & Konfirmasi
                            </a>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

    </div>

    <footer>
        &copy; 2026 Dear Seana Kurir Panel. Keajaiban Rasa Dalam Setiap Sematan.
    </footer>

</body>
</html>
