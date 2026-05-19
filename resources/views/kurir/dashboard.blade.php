<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kurir - Dear Seana</title>
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

        .welcome-section {
            background: linear-gradient(135deg, #fff5f5, #fdf0f4);
            padding: 20px;
            border-radius: 20px;
            margin-bottom: 30px;
            border: 1px solid rgba(240, 98, 146, 0.15);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .welcome-title h1 {
            margin: 0 0 5px 0;
            font-size: 24px;
            color: var(--secondary);
            font-weight: 800;
        }

        .welcome-title p {
            margin: 0;
            font-size: 14px;
            color: var(--text-muted);
            font-weight: 500;
        }

        .badge-count {
            background: var(--primary);
            color: white;
            padding: 8px 16px;
            border-radius: 50px;
            font-weight: 800;
            font-size: 14px;
            box-shadow: 0 4px 10px rgba(240, 98, 146, 0.2);
        }

        /* Task Cards */
        .task-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .task-card {
            background: var(--card-bg);
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
            border: 1px solid #fce4ec;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .task-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(240, 98, 146, 0.1);
        }

        .task-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1.5px solid #fce4ec;
            padding-bottom: 15px;
            margin-bottom: 15px;
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

        .task-body {
            margin-bottom: 20px;
        }

        .info-row {
            display: flex;
            margin-bottom: 10px;
            font-size: 15px;
        }

        .info-label {
            width: 150px;
            font-weight: 700;
            color: var(--text-muted);
        }

        .info-value {
            flex: 1;
            font-weight: 600;
            color: var(--text-main);
        }

        .info-value-name {
            font-size: 18px;
            font-weight: 800;
            color: var(--secondary);
        }

        .wa-link {
            color: #25D366;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-weight: 700;
        }

        .wa-link:hover {
            text-decoration: underline;
        }

        /* Upload Area */
        .upload-section {
            background: #fffbfa;
            border: 2px dashed #f8bbd0;
            border-radius: 16px;
            padding: 20px;
            text-align: center;
            position: relative;
            transition: all 0.3s;
        }

        .upload-section:hover {
            background: #fff5f7;
            border-color: var(--primary);
        }

        .upload-label {
            cursor: pointer;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            font-weight: 700;
            color: var(--primary);
        }

        .upload-icon {
            font-size: 32px;
            margin-bottom: 5px;
        }

        .upload-input {
            display: none;
        }

        .preview-container {
            display: none;
            margin-top: 15px;
            position: relative;
            display: inline-block;
        }

        .preview-img {
            max-width: 150px;
            max-height: 150px;
            object-fit: cover;
            border-radius: 12px;
            border: 3px solid white;
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        }

        .btn-remove-preview {
            position: absolute;
            top: -10px;
            right: -10px;
            background: #e57373;
            color: white;
            border: none;
            width: 26px;
            height: 26px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            transition: all 0.2s;
        }

        .btn-remove-preview:hover {
            background: #d32f2f;
            transform: scale(1.1);
        }

        /* Complete Button */
        .btn-submit {
            background: linear-gradient(135deg, #4caf50, #2e7d32);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 800;
            font-size: 15px;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(76,175,80,0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            margin-top: 15px;
            transition: all 0.3s;
        }

        .btn-submit:hover {
            box-shadow: 0 6px 20px rgba(76,175,80,0.4);
            filter: brightness(1.05);
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

        /* Alert styling */
        .alert {
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 25px;
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
            <a href="#" class="logo">
                <i class="fas fa-motorcycle"></i>
                <span>Dear Seana <span class="logo-small">Kurir</span></span>
            </a>
            <div class="user-menu">
                <span style="font-weight: 700; font-size: 14px;"><i class="fas fa-user-circle"></i> {{ Auth::user()->name }}</span>
                <form action="{{ route('kurir.logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="fas fa-sign-out-alt"></i> Keluar
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

        @if(session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            </div>
        @endif

        <!-- Welcome Banner -->
        <div class="welcome-section">
            <div class="welcome-title">
                <h1>Halo, {{ Auth::user()->name }}! 👋</h1>
                <p>Silakan antarkan pesanan kue lezat dan unggah bukti pengirimannya.</p>
            </div>
            <div class="badge-count">
                🛵 {{ $orders->count() }} Tugas Pengantaran
            </div>
        </div>

        <!-- Task List -->
        <div class="task-list">
            @if($orders->isEmpty())
                <div class="empty-state">
                    <div class="empty-icon">🎉</div>
                    <h3>Semua Tugas Selesai!</h3>
                    <p>Tidak ada pesanan aktif yang perlu dikirim saat ini.</p>
                </div>
            @else
                @foreach($orders as $order)
                    <div class="task-card">
                        <div class="task-header">
                            <span class="order-id"><i class="fas fa-shopping-bag"></i> Pesanan #{{ $order->id }}</span>
                            <span class="order-time">{{ $order->updated_at->format('d M Y, H:i') }}</span>
                        </div>

                        <div class="task-body">
                            <div class="info-row">
                                <div class="info-label"><i class="fas fa-user"></i> Pelanggan</div>
                                <div class="info-value info-value-name">{{ $order->nama_pelanggan }}</div>
                            </div>
                            <div class="info-row">
                                <div class="info-label"><i class="fas fa-map-marker-alt"></i> Alamat Kirim</div>
                                <div class="info-value">{{ $order->alamat }}</div>
                            </div>
                            <div class="info-row">
                                <div class="info-label"><i class="fab fa-whatsapp"></i> No. WhatsApp</div>
                                <div class="info-value">
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $order->no_wa) }}" target="_blank" class="wa-link">
                                        {{ $order->no_wa }} <i class="fas fa-external-link-alt" style="font-size: 11px;"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Form Completion -->
                        <form id="complete-form-{{ $order->id }}" action="{{ route('kurir.complete', $order->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="upload-section" id="upload-box-{{ $order->id }}">
                                <label for="bukti-{{ $order->id }}" class="upload-label" id="label-{{ $order->id }}">
                                    <div class="upload-icon">📸</div>
                                    <span>Klik untuk Ambil / Unggah Foto Bukti Sampai</span>
                                    <span style="font-size: 11px; font-weight: 500; opacity: 0.8;">Format: JPG, PNG, WEBP (Maks 2MB)</span>
                                </label>
                                <input type="file" name="bukti_pengiriman" id="bukti-{{ $order->id }}" class="upload-input" accept="image/*" required onchange="previewImage(this, '{{ $order->id }}')">
                                
                                <div class="preview-container" id="preview-container-{{ $order->id }}" style="display: none;">
                                    <img src="" id="preview-img-{{ $order->id }}" class="preview-img">
                                    <button type="button" class="btn-remove-preview" onclick="removePreview('{{ $order->id }}')">&times;</button>
                                </div>
                            </div>

                            <button type="submit" class="btn-submit">
                                <i class="fas fa-check-circle"></i> Selesaikan Pengantaran
                            </button>
                        </form>
                    </div>
                @endforeach
            @endif
        </div>

    </div>

    <!-- Footer -->
    <footer>
        &copy; 2026 Dear Seana Kurir Panel. Keajaiban Rasa Dalam Setiap Sematan.
    </footer>

    <!-- Interactive script for previews -->
    <script>
        function previewImage(input, orderId) {
            const previewContainer = document.getElementById('preview-container-' + orderId);
            const previewImg = document.getElementById('preview-img-' + orderId);
            const uploadLabel = document.getElementById('label-' + orderId);
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    previewContainer.style.display = 'inline-block';
                    uploadLabel.style.display = 'none';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function removePreview(orderId) {
            const input = document.getElementById('bukti-' + orderId);
            const previewContainer = document.getElementById('preview-container-' + orderId);
            const previewImg = document.getElementById('preview-img-' + orderId);
            const uploadLabel = document.getElementById('label-' + orderId);
            
            input.value = "";
            previewImg.src = "";
            previewContainer.style.display = 'none';
            uploadLabel.style.display = 'flex';
        }
    </script>
</body>
</html>
