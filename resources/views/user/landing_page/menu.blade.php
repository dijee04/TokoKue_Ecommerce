@extends('user.layouts.app')

@section('content')
    <!-- Bestseller Section -->
    <section id="produk" class="bestsellers container" style="margin-top: 5rem; padding-bottom: 5rem;">
        <div class="section-title-wrap">
            <h2>Koleksi Terlaris & Paling Diminati</h2>
            <a href="#" class="view-all-btn">LIHAT SEMUA</a>
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
    });
</script>
@endpush
