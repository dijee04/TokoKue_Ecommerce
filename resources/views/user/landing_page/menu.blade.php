<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Menu - Dear Seana</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <style>
            :root {
                --pink-light: #fce4ec;
                --pink-accent: #f06292;
                --brown-text: #6d4c41;
                --brown-button: #8d6e63;
            }

            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: 'Figtree', sans-serif;
                background-color: #f3f4f6;
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

            .nav-links a.active {
                color: var(--pink-accent);
                border-bottom: 2px solid var(--pink-accent);
                padding-bottom: 5px;
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

            .menu-header {
                background: linear-gradient(135deg, #fce4ec 0%, #f8bbd0 100%);
                padding: 40px 20px;
                text-align: center;
            }

            .menu-header h1 {
                font-size: 36px;
                color: var(--brown-text);
            }

            .menu-header p {
                font-size: 16px;
                color: #8d6e63;
                margin-top: 10px;
            }

            .menu-container {
                max-width: 1100px;
                margin: 40px auto;
                padding: 0 20px;
            }

            .menu-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                gap: 30px;
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
                height: 220px;
                object-fit: cover;
            }

            .menu-info {
                padding: 20px;
                text-align: center;
            }

            .menu-info h3 {
                font-size: 20px;
                color: var(--brown-text);
                margin-bottom: 10px;
            }

            .menu-info p {
                font-size: 14px;
                color: #888;
                margin-bottom: 15px;
            }

            .price {
                font-size: 18px;
                font-weight: bold;
                color: var(--pink-accent);
                margin-bottom: 15px;
                display: block;
            }

            .btn-order {
                display: inline-block;
                background-color: var(--pink-light);
                color: var(--pink-accent);
                padding: 8px 20px;
                border-radius: 20px;
                text-decoration: none;
                font-weight: 600;
                font-size: 13px;
                transition: 0.3s;
            }

            .btn-order:hover {
                background-color: var(--pink-accent);
                color: white;
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
        </style>
    </head>
    <body>
        <nav class="navbar">
            <div class="logo">
                Dear Seana
                <small>SWEET & SAVORY</small>
            </div>
            <div class="nav-links">
                <a href="{{ url('/') }}">Home</a>
                <a href="{{ url('/menu') }}" class="active">Menu</a>
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

        <div class="menu-header">
            <h1>Daftar Menu Lengkap</h1>
            <p>Berbagai pilihan manis dan gurih untuk Anda</p>
        </div>

        <div class="menu-container">
            <div class="menu-grid">
                <!-- Chocolate Cake -->
                <div class="menu-card">
                    <img src="{{ asset('assets/img_produk/Kue/Brownies_1.png') }}" alt="Chocolate Cake" class="menu-image">
                    <div class="menu-info">
                        <h3>Chocolate Cake</h3>
                        <p>Kue cokelat premium dengan lapisan ganache yang lembut.</p>
                        <span class="price">Rp 150.000</span>
                        <a href="#" class="btn-order">Pesan Sekarang</a>
                    </div>
                </div>

                <!-- Birthday Tart -->
                <div class="menu-card">
                    <img src="https://picsum.photos/id/30/300/200" alt="Birthday Tart" class="menu-image">
                    <div class="menu-info">
                        <h3>Birthday Tart</h3>
                        <p>Tart spesial untuk hari spesial Anda dengan topping buah segar.</p>
                        <span class="price">Rp 175.000</span>
                        <a href="#" class="btn-order">Pesan Sekarang</a>
                    </div>
                </div>

                <!-- Melted Brownie -->
                <div class="menu-card">
                    <img src="https://picsum.photos/id/108/300/200" alt="Melted Brownie" class="menu-image">
                    <div class="menu-info">
                        <h3>Melted Brownie</h3>
                        <p>Brownie lumer dengan cokelat cair di dalamnya.</p>
                        <span class="price">Rp 85.000</span>
                        <a href="#" class="btn-order">Pesan Sekarang</a>
                    </div>
                </div>

                <!-- Vanilla Chocolate Cupcake -->
                <div class="menu-card">
                    <img src="https://picsum.photos/id/132/300/200" alt="Vanilla Chocolate Cupcake" class="menu-image">
                    <div class="menu-info">
                        <h3>Vanilla Chocolate Cupcake</h3>
                        <p>Cupcake vanilla dengan topping cokelat yang manis.</p>
                        <span class="price">Rp 35.000</span>
                        <a href="#" class="btn-order">Pesan Sekarang</a>
                    </div>
                </div>

                <!-- Kue Klasik -->
                <div class="menu-card">
                    <img src="https://picsum.photos/id/112/300/200" alt="Kue Klasik" class="menu-image">
                    <div class="menu-info">
                        <h3>Kue Klasik</h3>
                        <p>Kue tradisional dengan rasa yang autentik.</p>
                        <span class="price">Rp 100.000</span>
                        <a href="#" class="btn-order">Pesan Sekarang</a>
                    </div>
                </div>

                <!-- Homemade Cookies -->
                <div class="menu-card">
                    <img src="https://picsum.photos/id/113/300/200" alt="Homemade Cookies" class="menu-image">
                    <div class="menu-info">
                        <h3>Homemade Cookies</h3>
                        <p>Cookies homemade dengan berbagai varian rasa.</p>
                        <span class="price">Rp 50.000</span>
                        <a href="#" class="btn-order">Pesan Sekarang</a>
                    </div>
                </div>
            </div>
        </div>

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