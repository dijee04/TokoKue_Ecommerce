@extends('frontend.layouts.app')

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

    <!-- Journey Section -->
    <div class="journey-wrapper">
        <!-- Part 1 -->
        <section class="journey-section fade-in-on-scroll">
            <div class="container journey-grid">
                <div class="journey-img-box">
                </div>
                <div class="journey-text">
                    <h2>Tentang Kami</h2>
                    <p>Sejak 2017, Dear Seana hadir dengan berbagai hidangan manis dan gurih yang memanjakan lidah. Kami menggunakan bahan berkualitas dan resep istimewa untuk memberikan pengalaman kuliner yang memuaskan. Setiap sajian kami dibuat dengan penuh cinta, untuk Anda yang mencari kenikmatan dalam setiap gigitan. Terima kasih telah menjadi bagian dari perjalanan kami!</p>
                </div>
            </div>
        </section>

        <!-- Part 2 -->
        <section class="journey-section bg-lite fade-in-on-scroll">
            <div class="container journey-grid">
                <div class="journey-text">
                    <h2>Visi</h2>
                    <p style="font-style: italic; font-size: 1.3rem;">“ Menjadi toko kue dan roti terdepan yang membawa kebahagiaan dan kelezatan ke setiap rumah, menyempurnakan setiap momen dengan cita rasa terbaik. ”</p>
                </div>
                <div class="journey-img-box">
                </div>
            </div>
        </section>

        <!-- Part 3 -->
        <section class="journey-section fade-in-on-scroll">
            <div class="container journey-grid">
                <div class="journey-img-box">
                </div>
                <div class="journey-text">
                    <h2>Misi</h2>
                    <p>• Menghadirkan produk berkualitas tinggi dengan bahan-bahan alami dan tanpa pengawet.</p>
                    <p>• Memberikan pengalaman pelanggan yang hangat dan personal, seperti keluarga.</p>
                </div>
            </div>
        </section>
        <!-- Part 4 -->
        <section class="journey-section bg-lite fade-in-on-scroll">
            <div class="container journey-grid">
                <div class="journey-text">
                    <h2>Keunggulan</h2>
                    <p>Kami berkomitmen untuk menyajikan produk kue dan roti yang terbaik dengan mengutamakan kualitas di setiap proses pembuatannya. Berikut adalah beberapa keunggulan yang membedakan produk kami:</p>
                    
                    <ul class="keunggulan-list">
                        <li>
                            <div class="icon-wrap"><i class="fas fa-leaf"></i></div>
                            <span>Menggunakan bahan-bahan alami terbaik, tanpa tambahan pengawet, untuk menjamin rasa dan kesehatan dalam setiap gigitan.</span>
                        </li>
                        <li>
                            <div class="icon-wrap"><i class="fas fa-star"></i></div>
                            <span>Setiap produk dibuat dari resep-resep khusus yang merupakan kombinasi rasa tradisional dan modern, menciptakan cita rasa yang otentik dan tak terlupakan.</span>
                        </li>
                        <li>
                            <div class="icon-wrap"><i class="fas fa-fire-burner"></i></div>
                            <span>Kami memanggang setiap hari untuk memastikan produk yang disajikan selalu segar dan lezat ketika sampai di tangan Anda.</span>
                        </li>
                    </ul>
                </div>
                <div class="journey-img-box">
                </div>
            </div>
        </section>
    </div>



    <!-- Bestseller Section -->
    <section id="produk" class="bestsellers container">
        <div class="section-title-wrap">
            <h2>Koleksi Terlaris & Paling Diminati</h2>
            <a href="#produk" class="view-all-btn">LIHAT SEMUA</a>
        </div>
        
        <div class="swiper produk-swiper">
            <div class="swiper-wrapper">
                @foreach($produks as $produk)
                    <div class="swiper-slide best-card">
                        <i class="fas fa-heart wishlist-icon"></i>
                        <div class="best-img">
                            <img src="{{ asset($produk->gambar) }}" alt="{{ $produk->nama_produk }}">
                        </div>
                        <div class="best-info">
                            <h3>{{ $produk->nama_produk }}</h3>
                            <div class="price-row">
                                <span class="price">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                                <span class="rating">
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                                    <small>(500+ Ulasan)</small>
                                </span>
                            </div>
                            <a href="https://wa.me/6281234567890?text=Halo%20Anis%20Bakery,%20saya%20pesan%20{{ urlencode($produk->nama_produk) }}" target="_blank" class="cart-btn"><i class="fas fa-shopping-cart"></i></a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
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

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const swiper = new Swiper('.produk-swiper', {
            slidesPerView: 1,
            spaceBetween: 20,
            grabCursor: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                500: { slidesPerView: 2, spaceBetween: 20 },
                800: { slidesPerView: 3, spaceBetween: 20 },
                1100: { slidesPerView: 4, spaceBetween: 30 },
            }
        });

        // Scroll Animation Observer
        const faders = document.querySelectorAll('.fade-in-on-scroll');
        const appearOptions = {
            threshold: 0.15,
            rootMargin: "0px 0px -50px 0px"
        };
        const appearOnScroll = new IntersectionObserver(function(entries, observer) {
            entries.forEach(entry => {
                if (!entry.isIntersecting) return;
                entry.target.classList.add('appear');
                observer.unobserve(entry.target);
            });
        }, appearOptions);

        faders.forEach(fader => {
            appearOnScroll.observe(fader);
        });
    });
</script>
@endpush
