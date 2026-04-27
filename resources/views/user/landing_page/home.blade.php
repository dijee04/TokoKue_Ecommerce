@extends('user.layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="hero" style="background: linear-gradient(135deg, #fff5f0 0%, #ffe8f0 100%); padding: 80px 0; overflow: hidden;">
        <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 40px;">
            <div class="hero-text" style="flex: 1; min-width: 280px;">
                <h2 style="font-size: 48px; color: #6d4c41; margin-bottom: 20px; font-weight: 800; line-height: 1.2;">Nikmatnya Setiap Momen</h2>
                <p style="font-size: 18px; color: #8d6e63; margin-bottom: 30px; line-height: 1.6;">Hadirkan senyuman di momen berharga Anda bersama mahakarya rasa dari Anis Bakery.</p>
                <div class="hero-action">
                    <a href="{{ url('/menu') }}" class="hero-btn" style="display: inline-block; padding: 14px 32px; background: linear-gradient(135deg, #f06292, #ec407a); color: white; text-decoration: none; border-radius: 50px; font-weight: 700; transition: all 0.3s; box-shadow: 0 4px 15px rgba(240,98,146,0.3);">Jelajahi Menu</a>
                </div>
            </div>
            <div class="hero-images" style="flex: 1; position: relative; min-width: 280px; min-height: 300px;">
                <div class="main-image" style="position: relative; z-index: 2;">
                    <img src="{{ asset('assets/img_produk/Kue/chocolate_cake.png') }}" alt="Kue Premium" style="width: 100%; max-width: 350px; border-radius: 30px; box-shadow: 0 20px 40px rgba(0,0,0,0.15);">
                </div>
                <div class="small-image float-1" style="position: absolute; top: -20px; right: 20px; z-index: 1; animation: float1 3s ease-in-out infinite;">
                    <img src="{{ asset('assets/img_produk/Kue/vanilla_chocolate_cupcake.png') }}" alt="Cupcake" style="width: 100px; height: 100px; border-radius: 20px; box-shadow: 0 10px 20px rgba(0,0,0,0.1); object-fit: cover;">
                </div>
                <div class="small-image float-2" style="position: absolute; bottom: -20px; left: 20px; z-index: 1; animation: float2 4s ease-in-out infinite;">
                    <img src="{{ asset('assets/img_produk/Kue/melted_brownie.png') }}" alt="Brownies" style="width: 100px; height: 100px; border-radius: 20px; box-shadow: 0 10px 20px rgba(0,0,0,0.1); object-fit: cover;">
                </div>
            </div>
        </div>
    </section>

    <!-- Menu Categories (Klasik & Kue Kering) - TAB INTERAKTIF -->
    <section class="menu-kategori container" style="max-width: 1200px; margin: 80px auto; padding: 0 20px;">
        <div style="display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 40px;">
            <!-- Kategori Kami - KIRI -->
            <div class="menu-kategori-left" style="flex: 1; min-width: 280px;">
                <h2 style="font-size: 36px; color: #6d4c41; margin-bottom: 15px; font-weight: 800;">Kategori Kami</h2>
                <p style="font-size: 18px; color: #8d6e63; margin-bottom: 20px;">Apa yang menjadi keinginan hati Anda hari ini?</p>
                <div class="menu-icons" style="display: flex; gap: 20px; font-size: 32px; color: #f06292; margin-bottom: 25px;">
                    <i class="fas fa-birthday-cake"></i>
                    <i class="fas fa-cookie"></i>
                    <i class="fas fa-gift"></i>
                </div>
                
                <!-- TAB KATEGORI - KLASIK & KUE KERING -->
                <div class="category-tabs-wrapper" style="display: flex; gap: 15px; margin-top: 10px;">
                    <button class="category-tab-btn active" data-category="klasik" style="padding: 12px 28px; background: linear-gradient(135deg, #f06292, #ec407a); color: white; border: none; border-radius: 50px; font-weight: 800; font-size: 16px; cursor: pointer; transition: all 0.3s; box-shadow: 0 4px 12px rgba(240,98,146,0.3);">
                        🍰 BIRTHDAY CAKE
                    </button>
                    <button class="category-tab-btn" data-category="kuekering" style="padding: 12px 28px; background: linear-gradient(135deg, #fff5f0, #ffe8f0); color: #6d4c41; border: 2px solid #fce4ec; border-radius: 50px; font-weight: 800; font-size: 16px; cursor: pointer; transition: all 0.3s;">
                        🍪 KUE KERING
                    </button>
                </div>
            </div>
            
            <!-- Preview Produk (akan berubah sesuai tab yang dipilih) -->
            <div class="menu-kategori-right" style="flex: 1; min-width: 280px;">
                <div id="previewProduk" style="background: linear-gradient(135deg, #fff5f0, #ffe8f0); border-radius: 30px; padding: 25px; text-align: center;">
                    <div id="previewContent">
                        <div style="font-size: 60px; margin-bottom: 15px;">🍰</div>
                        <h3 style="color: #6d4c41; font-size: 24px; margin-bottom: 10px; font-weight: 800;">BIRTHDAY CAKE</h3>
                        <p style="color: #8d6e63; margin-bottom: 20px;">Brownis, Cheesecake, Birthday Tart, dan berbagai pilihan kue klasik lainnya.</p>
                        <a href="{{ url('/menu') }}#birthday-cake" style="display: inline-block; padding: 10px 25px; background: linear-gradient(135deg, #f06292, #ec407a); color: white; text-decoration: none; border-radius: 50px; font-weight: 700; transition: all 0.3s;">Lihat Semua →</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Promise Section dengan Gallery yang Bisa Diklik -->
    <section class="promise-section container" style="max-width: 1200px; margin: 80px auto; padding: 0 20px;">
        <div class="promise-header" style="text-align: center; margin-bottom: 50px;">
            <h2 style="font-size: 36px; color: #6d4c41; margin-bottom: 15px; font-weight: 800;">Komitmen Kami</h2>
            <p style="font-size: 18px; color: #8d6e63;">Tidak ada mantra rahasia — hanya ketulusan & kualitas dalam setiap proses memanggang kami!</p>
        </div>
        <div class="promise-layout" style="display: flex; flex-wrap: wrap; gap: 40px;">
            <div class="promise-left" style="flex: 1; min-width: 280px;">
                <div class="features-box" style="background: linear-gradient(135deg, #fff5f0, #ffe8f0); border-radius: 30px; padding: 30px; margin-bottom: 30px;">
                    <p class="features-title" style="font-size: 20px; font-weight: 700; color: #6d4c41; margin-bottom: 20px;">Sekilas dedikasi nyata kami di dunia kuliner!</p>
                    <div class="features-grid" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 25px;">
                        <div class="feat" style="text-align: center;">
                            <div class="feat-icon" style="font-size: 32px; color: #f06292; margin-bottom: 10px;"><i class="fas fa-truck-fast"></i></div>
                            <span style="font-size: 12px; font-weight: 700; color: #6d4c41;">PENGIRIMAN<br>TEPAT WAKTU</span>
                        </div>
                        <div class="feat" style="text-align: center;">
                            <div class="feat-icon" style="font-size: 32px; color: #f06292; margin-bottom: 10px;"><i class="fas fa-palette"></i></div>
                            <span style="font-size: 12px; font-weight: 700; color: #6d4c41;">50+<br>PILIHAN DESAIN</span>
                        </div>
                        <div class="feat" style="text-align: center;">
                            <div class="feat-icon" style="font-size: 32px; color: #f06292; margin-bottom: 10px;"><i class="fas fa-box-open"></i></div>
                            <span style="font-size: 12px; font-weight: 700; color: #6d4c41;">RIBUAN<br>PESANAN</span>
                        </div>
                        <div class="feat" style="text-align: center;">
                            <div class="feat-icon" style="font-size: 32px; color: #f06292; margin-bottom: 10px;"><i class="fas fa-blender"></i></div>
                            <span style="font-size: 12px; font-weight: 700; color: #6d4c41;">DIPANGGANG<br>LANGSUNG PADA HARI H</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gallery Grid - 4 FOTO YANG BISA DIKLIK -->
            <div class="promise-right gallery-grid" style="flex: 1; display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px;">
                <div class="gal-item" data-product="Cheesecake Coklat" data-price="Rp 55.000" data-desc="Cheesecake lembut dengan lapisan coklat premium." data-img="{{ asset('assets/img_produk/Kue/Cheesecake_coklat.png') }}">
                    <img src="{{ asset('assets/img_produk/Kue/Cheesecake_coklat.png') }}" alt="Cheesecake Coklat" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s;">
                    <div class="overlay-info">
                        <span>🍰 Cheesecake Coklat</span>
                        <span>Rp 55.000</span>
                    </div>
                </div>
                <div class="gal-item" data-product="Brownis Almond" data-price="Rp 35.000" data-desc="Brownis dengan taburan almond renyah." data-img="{{ asset('assets/img_produk/Cookies/Brownis_3.png') }}">
                    <img src="{{ asset('assets/img_produk/Cookies/Brownis_3.png') }}" alt="Brownis Almond" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s;">
                    <div class="overlay-info">
                        <span>🍪 Brownis Almond</span>
                        <span>Rp 35.000</span>
                    </div>
                </div>
                <div class="gal-item" data-product="Birthday Tart" data-price="Rp 175.000" data-desc="Tart spesial dengan topping buah segar." data-img="{{ asset('assets/img_produk/Kue/birthday_tart.png') }}">
                    <img src="{{ asset('assets/img_produk/Kue/birthday_tart.png') }}" alt="Birthday Tart" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s;">
                    <div class="overlay-info">
                        <span>🎂 Birthday Tart</span>
                        <span>Rp 175.000</span>
                    </div>
                </div>
                <div class="gal-item" data-product="Mini BB Cheesecake" data-price="Rp 45.000" data-desc="Cheesecake mini dengan rasa berry bliss." data-img="{{ asset('assets/img_produk/Kue/Mini_BBCheesecake.png') }}">
                    <img src="{{ asset('assets/img_produk/Kue/Mini_BBCheesecake.png') }}" alt="Mini BB Cheesecake" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s;">
                    <div class="overlay-info">
                        <span>🧀 Mini BB Cheesecake</span>
                        <span>Rp 45.000</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal for Gallery Product Detail -->
    <div id="productModal" class="product-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.85); backdrop-filter: blur(10px); z-index: 2000; align-items: center; justify-content: center;">
        <div class="modal-product-container" style="background: linear-gradient(145deg, #FFF8F0, #FFF5EE); border-radius: 40px; max-width: 500px; width: 90%; overflow: hidden; animation: modalSlideIn 0.4s ease; position: relative;">
            <button class="modal-product-close" style="position: absolute; top: 15px; right: 15px; background: rgba(0,0,0,0.5); border: none; color: white; width: 35px; height: 35px; border-radius: 50%; font-size: 20px; cursor: pointer; z-index: 10; display: flex; align-items: center; justify-content: center;">&times;</button>
            <div style="background: linear-gradient(135deg, #fce4ec, #f8bbd0); padding: 20px; text-align: center;">
                <img id="modalProductImg" src="" alt="" style="width: 150px; height: 150px; object-fit: cover; border-radius: 25px; box-shadow: 0 10px 25px rgba(0,0,0,0.15);">
            </div>
            <div style="padding: 25px; text-align: center;">
                <h3 id="modalProductName" style="font-size: 24px; color: #6d4c41; margin-bottom: 10px; font-weight: 800;"></h3>
                <p id="modalProductDesc" style="font-size: 14px; color: #8d6e63; margin-bottom: 15px; line-height: 1.5;"></p>
                <div style="display: flex; justify-content: center; gap: 15px; margin-bottom: 20px;">
                    <span id="modalProductPrice" style="font-size: 28px; font-weight: 900; color: #f06292;"></span>
                </div>
                <div style="display: flex; gap: 12px; justify-content: center;">
                    <button id="modalAddToCart" style="background: linear-gradient(135deg, #e0f2f1, #b2dfdb); color: #00695c; padding: 12px 24px; border-radius: 50px; border: none; font-weight: 800; cursor: pointer;">🛒 Tambah ke Keranjang</button>
                    <button id="modalOrderNow" style="background: linear-gradient(135deg, #25D366, #128C7E); color: white; padding: 12px 24px; border-radius: 50px; border: none; font-weight: 800; cursor: pointer;">💬 Pesan Sekarang</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div id="toastNotification" style="position: fixed; bottom: 40px; left: 50%; transform: translateX(-50%) translateY(100px); background: linear-gradient(135deg, #1a1a1a, #2d2d2d); color: #ffebcd; padding: 14px 28px; border-radius: 80px; font-weight: 700; z-index: 2100; transition: all 0.4s; opacity: 0; pointer-events: none; white-space: nowrap; font-size: 14px;">
        ✨ Pesanan ditambahkan
    </div>

    <style>
        /* ========== ANIMATIONS ========== */
        @keyframes float1 { 
            0%,100% { transform: translateY(0) translateX(0); } 
            50% { transform: translateY(-12px) translateX(6px); } 
        }
        @keyframes float2 { 
            0%,100% { transform: translateY(0) translateX(0); } 
            50% { transform: translateY(12px) translateX(-6px); } 
        }
        @keyframes modalSlideIn {
            from { transform: translateY(-60px) scale(0.9); opacity: 0; }
            to { transform: translateY(0) scale(1); opacity: 1; }
        }
        
        /* Hero Section Enhancement */
        .hero {
            position: relative;
            isolation: isolate;
        }
        
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 20% 80%, rgba(240,98,146,0.05) 0%, transparent 50%);
            pointer-events: none;
            z-index: 0;
        }
        
        .hero-btn {
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        
        .hero-btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255,255,255,0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
            z-index: -1;
        }
        
        .hero-btn:hover::before {
            width: 300px;
            height: 300px;
        }
        
        /* Category Tab Enhancement */
        .category-tab-btn {
            transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }
        
        .category-tab-btn:hover {
            transform: translateY(-3px);
        }
        
        .category-tab-btn.active {
            background: linear-gradient(135deg, #f06292, #ec407a) !important;
            color: white !important;
            box-shadow: 0 6px 20px rgba(240,98,146,0.4);
        }
        
        #previewContent {
            transition: all 0.3s ease;
        }
        
        /* Feature Grid Enhancement */
        .features-box {
            position: relative;
            overflow: hidden;
        }
        
        .features-box::before {
            content: '✨';
            position: absolute;
            top: -20px;
            right: -20px;
            font-size: 80px;
            opacity: 0.1;
            pointer-events: none;
        }
        
        .feat {
            position: relative;
            padding: 15px;
            border-radius: 20px;
            transition: all 0.3s ease;
            background: rgba(255,255,255,0.5);
        }
        
        .feat:hover {
            background: white;
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(240,98,146,0.1);
        }
        
        .feat-icon {
            transition: all 0.3s ease;
        }
        
        .feat:hover .feat-icon {
            transform: scale(1.1);
        }
        
        /* Gallery Grid Enhancement */
        .gal-item {
            position: relative;
            overflow: hidden;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .gal-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(240,98,146,0.2);
        }
        
        .gal-item img {
            transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .gal-item:hover img {
            transform: scale(1.1);
        }
        
        /* Overlay info pada gallery */
        .overlay-info {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0,0,0,0.8));
            color: white;
            padding: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transform: translateY(100%);
            transition: transform 0.3s ease;
        }
        
        .gal-item:hover .overlay-info {
            transform: translateY(0);
        }
        
        .overlay-info span:first-child {
            font-size: 12px;
            font-weight: 600;
        }
        
        .overlay-info span:last-child {
            font-size: 12px;
            font-weight: 700;
            background: rgba(240,98,146,0.9);
            padding: 4px 10px;
            border-radius: 20px;
        }
        
        /* Menu Icons Enhancement */
        .menu-icons i {
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .menu-icons i:hover {
            transform: translateY(-5px) scale(1.1);
            color: #ec407a;
        }
        
        /* Images Enhancement */
        .small-image img {
            transition: all 0.3s ease;
            border: 3px solid white;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        
        .small-image img:hover {
            transform: scale(1.05);
            box-shadow: 0 15px 35px rgba(240,98,146,0.25);
        }
        
        .main-image img {
            transition: all 0.4s ease;
        }
        
        .main-image img:hover {
            transform: scale(1.02);
            box-shadow: 0 25px 50px rgba(240,98,146,0.2);
        }
        
        /* Typography Enhancement */
        .hero-text h2 {
            background: linear-gradient(135deg, #6d4c41, #f06292);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        /* Modal Close Button */
        .modal-product-close:hover {
            background: #f06292 !important;
            transform: rotate(90deg);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .features-grid {
                gap: 15px !important;
            }
            .feat {
                padding: 10px !important;
            }
            .feat-icon {
                font-size: 24px !important;
            }
            .menu-icons i {
                font-size: 24px !important;
            }
            .hero-text h2 {
                font-size: 36px !important;
            }
            .overlay-info span {
                font-size: 10px !important;
            }
            .category-tab-btn {
                padding: 8px 20px !important;
                font-size: 14px !important;
            }
        }
        
        @media (max-width: 480px) {
            .hero-text h2 {
                font-size: 28px !important;
            }
        }
        
        html {
            scroll-behavior: smooth;
        }
    </style>

    <script>
        // Data produk untuk gallery
        const galleryProducts = [
            {
                name: 'Cheesecake Coklat',
                price: 55000,
                priceFormatted: 'Rp 55.000',
                desc: 'Cheesecake lembut dengan lapisan coklat premium. Cocok untuk pencinta coklat!',
                img: '{{ asset("assets/img_produk/Kue/Cheesecake_coklat.png") }}'
            },
            {
                name: 'Brownis Almond',
                price: 35000,
                priceFormatted: 'Rp 35.000',
                desc: 'Brownis dengan taburan almond renyah di atasnya. Manis dan gurih!',
                img: '{{ asset("assets/img_produk/Cookies/Brownis_3.png") }}'
            },
            {
                name: 'Birthday Tart',
                price: 175000,
                priceFormatted: 'Rp 175.000',
                desc: 'Tart spesial dengan topping buah segar. Cocok untuk acara ulang tahun!',
                img: '{{ asset("assets/img_produk/Kue/birthday_tart.png") }}'
            },
            {
                name: 'Mini BB Cheesecake',
                price: 45000,
                priceFormatted: 'Rp 45.000',
                desc: 'Cheesecake mini dengan rasa berry bliss. Pas untuk camilan!',
                img: '{{ asset("assets/img_produk/Kue/Mini_BBCheesecake.png") }}'
            }
        ];
        
        let currentModalProduct = null;
        let cart = JSON.parse(localStorage.getItem('sweetSavoryCartGallery') || '[]');
        
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('productModal');
            const closeBtn = document.querySelector('.modal-product-close');
            const addToCartBtn = document.getElementById('modalAddToCart');
            const orderNowBtn = document.getElementById('modalOrderNow');
            const toast = document.getElementById('toastNotification');
            
            function showToast(message) {
                toast.textContent = message;
                toast.style.opacity = '1';
                toast.style.transform = 'translateX(-50%) translateY(0)';
                setTimeout(() => {
                    toast.style.opacity = '0';
                    toast.style.transform = 'translateX(-50%) translateY(100px)';
                }, 2500);
            }
            
            function formatRupiah(angka) {
                return 'Rp ' + new Intl.NumberFormat('id-ID').format(angka);
            }
            
            function openModal(product) {
                currentModalProduct = product;
                document.getElementById('modalProductName').textContent = product.name;
                document.getElementById('modalProductDesc').textContent = product.desc;
                document.getElementById('modalProductPrice').textContent = product.priceFormatted;
                document.getElementById('modalProductImg').src = product.img;
                modal.style.display = 'flex';
                document.body.style.overflow = 'hidden';
            }
            
            function closeModal() {
                modal.style.display = 'none';
                document.body.style.overflow = '';
                currentModalProduct = null;
            }
            
            function addToCart(product) {
                const existingIndex = cart.findIndex(item => item.name === product.name);
                if (existingIndex !== -1) {
                    cart[existingIndex].quantity += 1;
                } else {
                    cart.push({
                        id: Date.now(),
                        name: product.name,
                        price: product.price,
                        quantity: 1,
                        img: product.img
                    });
                }
                localStorage.setItem('sweetSavoryCartGallery', JSON.stringify(cart));
                showToast(`🛒 ${product.name} ditambahkan ke keranjang!`);
                closeModal();
            }
            
            function sendToWA(product) {
                const message = `Halo Dear Seana,%0A%0A*PESANAN BARU DARI GALERI*%0A%0A🍰 *${product.name}*%0A📦 Jumlah: 1%0A💰 *Total: ${product.priceFormatted}*%0A%0ATerima kasih! 🙏`;
                window.open(`https://api.whatsapp.com/send/?phone=6281234567890&text=${message}&type=phone_number&app_absent=0`, '_blank');
                closeModal();
            }
            
            // ========== TAB KATEGORI INTERAKTIF ==========
            const tabBtns = document.querySelectorAll('.category-tab-btn');
            const previewContent = document.getElementById('previewContent');
            
            const kontenPreview = {
                klasik: `
                    <div style="font-size: 60px; margin-bottom: 15px;">🍰</div>
                    <h3 style="color: #6d4c41; font-size: 24px; margin-bottom: 10px; font-weight: 800;">Kue Klasik</h3>
                    <p style="color: #8d6e63; margin-bottom: 20px;">Brownis, Cheesecake, Birthday Tart, dan berbagai pilihan kue klasik lainnya yang siap memanjakan lidah Anda.</p>
                    <a href="{{ url('/menu') }}#birthday-cake" style="display: inline-block; padding: 10px 25px; background: linear-gradient(135deg, #f06292, #ec407a); color: white; text-decoration: none; border-radius: 50px; font-weight: 700; transition: all 0.3s;">Lihat Semua →</a>
                `,
                kuekering: `
                    <div style="font-size: 60px; margin-bottom: 15px;">🍪</div>
                    <h3 style="color: #6d4c41; font-size: 24px; margin-bottom: 10px; font-weight: 800;">Kue Kering</h3>
                    <p style="color: #8d6e63; margin-bottom: 20px;">Palm Cheese, Nutella Cookies, Florentine Cookies, dan aneka kue kering renyah untuk teman ngopi Anda.</p>
                    <a href="{{ url('/menu') }}#cookies" style="display: inline-block; padding: 10px 25px; background: linear-gradient(135deg, #f06292, #ec407a); color: white; text-decoration: none; border-radius: 50px; font-weight: 700; transition: all 0.3s;">Lihat Semua →</a>
                `
            };
            
            if (tabBtns.length > 0 && previewContent) {
                tabBtns.forEach(btn => {
                    btn.addEventListener('click', () => {
                        // Hapus class active dari semua tab
                        tabBtns.forEach(b => b.classList.remove('active'));
                        // Tambah class active ke tab yang diklik
                        btn.classList.add('active');
                        
                        // Ubah style tab yang aktif
                        tabBtns.forEach(b => {
                            if (b.classList.contains('active')) {
                                b.style.background = 'linear-gradient(135deg, #f06292, #ec407a)';
                                b.style.color = 'white';
                                b.style.boxShadow = '0 4px 12px rgba(240,98,146,0.3)';
                            } else {
                                b.style.background = 'linear-gradient(135deg, #fff5f0, #ffe8f0)';
                                b.style.color = '#6d4c41';
                                b.style.boxShadow = 'none';
                            }
                        });
                        
                        // Ganti konten preview
                        const category = btn.dataset.category;
                        if (category === 'klasik') {
                            previewContent.innerHTML = kontenPreview.klasik;
                        } else if (category === 'kuekering') {
                            previewContent.innerHTML = kontenPreview.kuekering;
                        }
                        
                        // Animasi fade
                        previewContent.style.opacity = '0';
                        setTimeout(() => {
                            previewContent.style.opacity = '1';
                        }, 150);
                    });
                });
            }
            
            // Event listener untuk setiap gallery item
            document.querySelectorAll('.gal-item').forEach((item, index) => {
                item.addEventListener('click', () => {
                    openModal(galleryProducts[index]);
                });
            });
            
            closeBtn.addEventListener('click', closeModal);
            
            addToCartBtn.addEventListener('click', () => {
                if (currentModalProduct) addToCart(currentModalProduct);
            });
            
            orderNowBtn.addEventListener('click', () => {
                if (currentModalProduct) sendToWA(currentModalProduct);
            });
            
            modal.addEventListener('click', (e) => {
                if (e.target === modal) closeModal();
            });
            
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && modal.style.display === 'flex') closeModal();
            });
        });
    </script>
@endsection