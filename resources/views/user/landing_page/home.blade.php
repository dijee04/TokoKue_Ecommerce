@extends('user.layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="hero">
        <div class="container hero-container">
            <div class="hero-text">
                <h2 class="hero-title">Nikmatnya Setiap Momen</h2>
                <p class="hero-subtitle">Hadirkan senyuman di momen berharga Anda bersama mahakarya rasa dari Anis Bakery.</p>
                
                <div class="hero-action">
                    <a href="#produk" class="hero-btn">Jelajahi Menu</a>
                    <div class="promo-badge-mini">
                        <span class="badge-text">Promo Khusus</span>
                        <strong class="badge-discount">DISKON 20%</strong>
                    </div>
                </div>
            </div>
            <div class="hero-images">
                <div class="main-image">
                    <img src="{{ asset('assets/img_produk/chocolate_cake.png') }}" alt="Kue Premium">
                </div>
                <div class="small-image float-1">
                    <img src="{{ asset('assets/img_produk/vanilla_chocolate_cupcake.png') }}" alt="Cupcake">
                </div>
                <div class="small-image float-2">
                    <img src="{{ asset('assets/img_produk/melted_brownie.png') }}" alt="Brownies">
                </div>
            </div>
        </div>
    </section>

    <!-- Menu Categories -->
    <section class="menu-kategori container">
        <div class="menu-kategori-left">
            <h2>Kategori Kami</h2>
            <p>Apa yang menjadi keinginan hati Anda hari ini?</p>
            <div class="menu-icons">
                <i class="fas fa-birthday-cake"></i>
                <i class="fas fa-cookie"></i>
                <i class="fas fa-gift"></i>
            </div>
        </div>
        <div class="menu-kategori-right">
            <div class="cat-card">
                <div class="cat-icon"><i class="fas fa-cake-candles"></i></div>
                <span>KLASIK</span>
            </div>
            <div class="cat-card">
                <div class="cat-icon"><i class="fas fa-crown"></i></div>
                <span>PREMIUM</span>
            </div>
            <div class="cat-card">
                <div class="cat-icon"><i class="fas fa-ice-cream"></i></div>
                <span>DESSERT</span>
            </div>
            <div class="cat-card">
                <div class="cat-icon"><i class="fas fa-cookie-bite"></i></div>
                <span>KUE KERING</span>
            </div>
        </div>
    </section>



    <!-- Our Promise -->
    <section class="promise-section container">
        <div class="promise-header">
            <h2>Komitmen Kami</h2>
            <p>Tidak ada mantra rahasia — hanya ketulusan & kualitas dalam setiap proses memanggang kami!</p>
        </div>
        <div class="promise-layout">
            <div class="promise-left">
                <div class="features-box">
                    <p class="features-title">Sekilas dedikasi nyata kami di dunia kuliner!</p>
                    <div class="features-grid">
                        <div class="feat">
                            <div class="feat-icon"><i class="fas fa-truck-fast"></i></div>
                            <span>PENGIRIMAN<br>TEPAT WAKTU</span>
                        </div>
                        <div class="feat">
                            <div class="feat-icon"><i class="fas fa-palette"></i></div>
                            <span>500+<br>PILIHAN DESAIN</span>
                        </div>
                        <div class="feat">
                            <div class="feat-icon"><i class="fas fa-box-open"></i></div>
                            <span>RIBUAN<br>PESANAN</span>
                        </div>
                        <div class="feat">
                            <div class="feat-icon"><i class="fas fa-blender"></i></div>
                            <span>DIPANGGANG<br>LANGSUNG PADA HARI H</span>
                        </div>
                    </div>
                </div>
                
                <div class="promo-ticket">
                    <div class="ticket-graph"><i class="fas fa-ticket"></i></div>
                    <div class="ticket-info">
                        <h4>TIKET KEAJAIBAN EMAS</h4>
                        <p>Tambahkan pengingat di akun Anda dan dapatkan kesempatan menangkan voucher spesial!</p>
                        <button class="btn-unlock">AMBIL TIKET</button>
                    </div>
                </div>
            </div>
            
            <!-- Gallery Grid with Cake Images -->
            <div class="promise-right gallery-grid">
                <div class="gal-item"><img src="{{ asset('assets/img_produk/birthday_tart.png') }}" alt="Gallery 1"></div>
                <div class="gal-item"><img src="{{ asset('assets/img_produk/chocolate_cake.png') }}" alt="Gallery 2"></div>
                <div class="gal-item"><img src="{{ asset('assets/img_produk/vanilla_chocolate_cupcake.png') }}" alt="Gallery 3"></div>
                <div class="gal-item"><img src="{{ asset('assets/img_produk/melted_brownie.png') }}" alt="Gallery 4"></div>
            </div>
        </div>
    </section>
@endsection


