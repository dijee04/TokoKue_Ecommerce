<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dear Seana - Keajaiban Rasa Dalam Setiap Sematan</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Titan+One&family=Dancing+Script:wght@700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/user/css/style.css') }}">
    <meta name="description" content="Dear Seana menyediakan berbagai macam kue coklat, puding, dan roti premium.">
</head>

<body>
    <!-- Topbar -->
    <div class="topbar container">
        <div class="logo-container">
            <div class="logo-sweet">SWEET & SAVORY</div>
            <a href="/" class="logo-group">
                <span class="logo-dear">
                    <span style="color: #D5BCCC;">D</span>
                    <span style="color: #C1D0AA;">e</span>
                    <span style="color: #EBE5B5;">a</span>
                    <span style="color: #E8BC85;">r</span>
                </span>
                <span class="logo-seana">Seana</span>
            </a>
        </div>
        <div class="topbar-right" style="gap: 2rem;">
            <ul class="nav-links">
                <li><a href="{{ route('beranda') }}">Home</a></li>
                <li><a href="{{ route('menu') }}">Menu</a></li>
                <li><a href="{{ route('our_story') }}">Our Story</a></li>
                <li><a href="{{ route('katering') }}">Katering</a></li>
            </ul>
            <a href="https://wa.me/6281234567890?text=Halo%20Dear%20Seana,%20saya%20tertarik%20dengan%20koleksi%20kue%20Anda."
                target="_blank" class="btn-pesan" style="display:flex; align-items:center; gap:8px;"><i
                    class="fab fa-whatsapp" style="font-size:1.1rem;"></i> Pesan Sekarang</a>
        </div>
    </div>

    <main>
        @yield('content')
    </main>

    <footer class="footer-crumbl">
        <div class="footer-socials">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-tiktok"></i></a>
            <a href="#"><i class="fab fa-x-twitter"></i></a>
            <a href="#"><i class="fab fa-youtube"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
            <a href="#"><i class="fab fa-pinterest-p"></i></a>
        </div>
        <div class="footer-bottom">
            <h1 class="giant-logo">Dear Seana</h1>
            <div class="footer-legal">
                <p>&copy; 2026 semua hak dilindungi undang-undang. | Data peta &copy; Kontributor OpenStreetMap</p>
                <div class="legal-links">
                    <a href="#">Kebijakan privasi</a> | 
                    <a href="#">Syarat dan Ketentuan</a> | 
                    <a href="#">Syarat dan Ketentuan Kartu Hadiah/Voucher</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    @stack('scripts')
</body>

</html>