<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dear Seana - Keajaiban Rasa Dalam Setiap Sematan</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Titan+One&family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/user/css/style.css') }}">
    <meta name="description" content="Dear Seana menyediakan berbagai macam kue coklat, puding, dan roti premium.">
</head>
<body>
    <!-- Topbar -->
    <div class="topbar container">
        <div class="logo-container" style="display:flex; flex-direction:column; align-items:center; position:relative;">
            <div class="logo-sweet" style="font-size: 0.75rem; font-weight: 700; letter-spacing: 5px; color: #B99D8B; margin-bottom: 2px; margin-left: 20px;">SWEET & SAVORY</div>
            
            <div style="position: absolute; right: 2px; top: 15px; font-size: 1.2rem; display:flex;">
                <span style="color:#E2B35B; margin-right: -4px; transform: rotate(-15deg);">✿</span>
                <span style="color:#E3C9DE; font-size: 1.5rem; transform: rotate(15deg);">✿</span>
            </div>
            
            <a href="/" class="logo-group" style="display:flex; align-items:flex-end; gap: 6px; text-decoration:none; position:relative; top:-5px;">
                <span class="logo-dear" style="font-family: 'Titan One', sans-serif; font-size: 2.8rem; color: #E5AD3A; text-shadow: 2px 4px 0px #C08A27; letter-spacing: 2px; line-height: 1;">DEAR</span>
                <span class="logo-seana" style="font-family: 'Playfair Display', serif; font-style: italic; font-size: 3.2rem; color: #E5AD3A; font-weight: 700; text-shadow: 2px 3px 0px #C08A27; margin-left: 0px; line-height: 0.8; position:relative; z-index:2; text-transform: capitalize;">Seana</span>
            </a>
        </div>
        <div class="topbar-right" style="gap: 2rem;">
            <ul class="nav-links" style="display: flex; gap: 2rem; margin: 0; padding: 0;">
                <li><a href="{{ route('beranda') }}" style="color:var(--text); font-weight:500;">Home</a></li>
                <li><a href="{{ route('menu') }}" style="color:var(--text); font-weight:500;">Menu</a></li>
                <li><a href="{{ route('our_story') }}" style="color:var(--text); font-weight:500;">Our Story</a></li>
                <li><a href="{{ route('katering') }}" style="color:var(--text); font-weight:500;">Katering</a></li>
            </ul>
            <a href="https://wa.me/6281234567890?text=Halo%20Dear%20Seana,%20saya%20tertarik%20dengan%20koleksi%20kue%20Anda." target="_blank" class="btn-pesan" style="display:flex; align-items:center; gap:8px;"><i class="fab fa-whatsapp" style="font-size:1.1rem;"></i> Pesan Sekarang</a>
        </div>
    </div>

    <main>
        @yield('content')
    </main>

    <footer class="footer">
        <div class="footer-banner">
            <div class="container">
                <h2>Dear Seana – Pilihan Terpercaya untuk Setiap Perayaan Anda</h2>
            </div>
        </div>
        <div class="container footer-main">
            <div class="footer-col">
                <h3 class="footer-logo logo-group" style="display:flex; align-items:flex-end; gap: 6px; margin-bottom: 1rem;">
                    <span class="logo-dear" style="font-family: 'Titan One', sans-serif; font-size: 2.4rem; color: #83513E; letter-spacing: 2px; line-height: 1;">DEAR</span>
                    <span class="logo-seana" style="font-family: 'Playfair Display', serif; font-style: italic; font-size: 2.8rem; color: #83513E; font-weight: 700; margin-left: 0px; line-height: 0.8; position:relative; z-index:2; text-transform: capitalize;">Seana</span>
                </h3>
                <ul>
                    <li><a href="#">Cerita Kami</a></li>
                    <li><a href="#">Hubungi Kami</a></li>
                    <li><a href="#">Lokasi Toko</a></li>
                    <li><a href="#">Peluang Karir</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h3>Pusat Bantuan</h3>
                <ul>
                    <li><a href="#">Pertanyaan Umum (FAQ)</a></li>
                    <li><a href="#">Kebijakan Pembatalan</a></li>
                    <li><a href="#">Kebijakan Privasi</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h3>Informasi Promo</h3>
                <ul>
                    <li><a href="#">Syarat & Ketentuan</a></li>
                    <li><a href="#">Penawaran Spesial</a></li>
                    <li><a href="#">Unduh Aplikasi Ponsel</a></li>
                </ul>
            </div>
            <div class="footer-col newsletter">
                <h3>Dapatkan Kabar Terbaru</h3>
                <div class="subscribe-box">
                    <input type="email" placeholder="Alamat Email Anda">
                    <button>LANGGANAN</button>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
