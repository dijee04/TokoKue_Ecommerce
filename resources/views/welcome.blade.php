<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Dear Seana - Toko Kue</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <style>
            :root {
                --pink-light: #fce4ec;
                --pink-accent: #f06292;
                --brown-text: #6d4c41;
                --brown-button: #8d6e63;
            }

            .navbar {
                background-color: white;
                box-shadow: 0 2px 10px rgba(0,0,0,0.05);
                padding: 15px 30px;
                display: flex;
                justify-content: space-between;
                align-items: center;
                flex-wrap: wrap;
            }

            .logo {
                font-size: 24px;
                font-weight: bold;
                color: var(--brown-text);
            }

            .logo small {
                font-size: 12px;
                font-weight: normal;
                color: var(--pink-accent);
                display: block;
            }

            .nav-links {
                display: flex;
                gap: 25px;
                flex-wrap: wrap;
                align-items: center;
            }

            .nav-links a {
                text-decoration: none;
                color: var(--brown-text);
                font-weight: 500;
                transition: 0.3s;
            }

            .nav-links a:hover {
                color: var(--pink-accent);
            }

            .btn-pesan-nav {
                background-color: var(--pink-light);
                padding: 8px 20px;
                border-radius: 25px;
            }

            .social-icons {
                display: flex;
                gap: 15px;
            }

            .social-icons a {
                text-decoration: none;
                color: var(--brown-text);
                font-weight: bold;
                font-size: 18px;
            }

            .hero {
                background: linear-gradient(135deg, #fce4ec 0%, #f8bbd0 100%);
                padding: 60px 20px;
                text-align: center;
            }

            .hero h1 {
                font-size: 48px;
                color: var(--brown-text);
                margin-bottom: 10px;
            }

            .hero p {
                font-size: 18px;
                color: #8d6e63;
            }

            .menu-container {
                max-width: 1100px;
                margin: 40px auto;
                padding: 0 20px;
            }

            .header-menu {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 30px;
            }

            .header-menu h2 {
                font-size: 24px;
                font-weight: 700;
                color: var(--brown-text);
            }

            .btn-lihat {
                background-color: var(--brown-button);
                color: white !important;
                padding: 10px 20px;
                border-radius: 25px;
                text-decoration: none;
                font-size: 14px;
            }

            .menu-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 25px;
            }

            .menu-card {
                background: #fff;
                border-radius: 15px;
                overflow: hidden;
                box-shadow: 0 4px 15px rgba(0,0,0,0.05);
                transition: transform 0.3s;
            }

            .menu-card:hover {
                transform: translateY(-5px);
            }

            .menu-image {
                width: 100%;
                height: 200px;
                object-fit: cover;
            }

            .menu-info {
                padding: 20px;
                text-align: center;
            }

            .menu-info h3 {
                font-size: 18px;
                color: var(--brown-text);
                margin-bottom: 10px;
            }

            .menu-info p {
                font-size: 14px;
                color: #888;
                margin-bottom: 15px;
            }

            .price {
                font-weight: bold;
                color: var(--pink-accent);
                font-size: 16px;
                display: block;
                margin-bottom: 15px;
            }

            .btn-order {
                display: inline-block;
                background-color: var(--pink-light);
                color: var(--pink-accent) !important;
                padding: 8px 20px;
                border-radius: 20px;
                text-decoration: none;
                font-weight: 600;
                font-size: 13px;
            }

            .footer {
                background-color: white;
                padding: 30px;
                text-align: center;
                border-top: 1px solid #f1f1f1;
                margin-top: 40px;
            }

            .footer p {
                color: #888;
                font-size: 14px;
            }

            body {
                font-family: 'Figtree', sans-serif;
                margin: 0;
                background-color: #f3f4f6;
            }
        </style>
    </head>
    <body>
        <!-- Navbar -->
        <nav class="navbar">
            <div class="logo">
                Dear Seana
                <small>SWEET & SAVORY</small>
            </div>
            <div class="nav-links">
                <a href="{{ url('/') }}">Home</a>
                <a href="{{ url('/menu') }}">Menu</a>
                <a href="#">Our Story</a>
                <a href="#">Katering</a>
                <a href="#" class="btn-pesan-nav">Pesan Sekarang</a>
            </div>
            <div class="social-icons">
                <a href="#">f</a>
                <a href="#">in</a>
                <a href="#">p</a>
            </div>
        </nav>

        <!-- Hero -->
        <div class="hero">
            <h1>SWEET & SAVORY</h1>
            <p>Nikmati kelezatan kue dan makanan terbaik dari Dear Seana</p>
        </div>

        <!-- Menu Produk -->
        <div class="menu-container">
            <div class="header-menu">
                <h2>Koleksi Terlaris & Paling Diminati</h2>
                <a href="#" class="btn-lihat">LIHAT SEMUA</a>
            </div>

            <div class="menu-grid">
                <!-- Produk 1 - Chocolate Cake -->
                <div class="menu-card">
                    <img src="{{ asset('assets/img_produk/Whole Cakes/chocolate_cake.png') }}" alt="Chocolate Cake" class="menu-image">
                    <div class="menu-info">
                        <h3>Chocolate Cake</h3>
                        <p>Kue cokelat premium dengan lapisan ganache yang lembut.</p>
                        <span class="price">Rp 150.000</span>
                        <a href="#" class="btn-order">Pesan Sekarang</a>
                    </div>
                </div>

                <!-- Produk 2 - Birthday Tart -->
                <div class="menu-card">
                    <img src="{{ asset('assets/img_produk/Whole Cakes/birthday_tart.png') }}" alt="Birthday Tart" class="menu-image">
                    <div class="menu-info">
                        <h3>Birthday Tart</h3>
                        <p>Tart spesial untuk hari spesial Anda dengan topping buah segar.</p>
                        <span class="price">Rp 175.000</span>
                        <a href="#" class="btn-order">Pesan Sekarang</a>
                    </div>
                </div>

                <!-- Produk 3 - Melted Brownie -->
                <div class="menu-card">
                    <img src="{{ asset('assets/img_produk/Whole Cakes/melted_brownie.png') }}" alt="Melted Brownie" class="menu-image">
                    <div class="menu-info">
                        <h3>Melted Brownie</h3>
                        <p>Brownie lumer dengan cokelat cair di dalamnya.</p>
                        <span class="price">Rp 85.000</span>
                        <a href="#" class="btn-order">Pesan Sekarang</a>
                    </div>
                </div>

                <!-- Produk 4 - Vanilla Chocolate Cupcake -->
                <div class="menu-card">
                    <img src="{{ asset('assets/img_produk/Whole Cakes/vanilla_chocolate_cupcake.png') }}" alt="Vanilla Chocolate Cupcake" class="menu-image">
                    <div class="menu-info">
                        <h3>Vanilla Chocolate Cupcake</h3>
                        <p>Cupcake vanilla dengan topping cokelat yang manis.</p>
                        <span class="price">Rp 35.000</span>
                        <a href="#" class="btn-order">Pesan Sekarang</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="social-icons" style="justify-content: center; margin-bottom: 20px;">
                <a href="#">f</a>
                <a href="#">in</a>
                <a href="#">p</a>
            </div>
            <p>&copy; 2024 Dear Seana - Sweet & Savory. All rights reserved.</p>
        </div>
    </body>
</html>