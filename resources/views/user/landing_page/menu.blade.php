@extends('user.layouts.app')

@section('content')
    <!-- Midtrans Snap JS -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Menu Header dengan gambar latar belakang -->
    <section class="menu-header" style="background: linear-gradient(135deg, rgba(252,228,236,0.85), rgba(248,187,208,0.85)), url('https://i.pinimg.com/1200x/61/43/a2/6143a2c8975f04a2ed426936e99fb025.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; padding: 60px 20px; text-align: center;">
        <div class="container">
            <h1 style="font-size: 48px; color: #6d4c41; margin-bottom: 10px; text-shadow: 2px 2px 4px rgba(255,255,255,0.5);">Daftar Menu Lengkap</h1>
            <p style="font-size: 18px; color: #8d6e63; text-shadow: 1px 1px 2px rgba(255,255,255,0.5);">Berbagai pilihan manis dan gurih untuk Anda</p>
        </div>
    </section>

    @php
        // ... kode selanjutnya tetap sama seperti sebelumnya ...
        // Inisialisasi koleksi produk dari database
        if(!isset($produks) || $produks->isEmpty()) {
            $produks = collect([
            (object) [
            'id' => 3,
            'nama_produk' => 'Brownis Almond',
            'deskripsi' => 'Brownis dengan taburan almond renyah.',
            'harga' => 35000,
            'gambar' => 'Kue/Brownis_3.png',
            'kategori' => (object) ['nama_kategori' => 'Cake'],
            'options' => [
                (object) ['type' => 'radio', 'label' => 'Varian', 'key' => 'variant', 'choices' => ['Original Almond', 'Dark Chocolate Almond', 'Caramel Almond']],
                (object) ['type' => 'radio', 'label' => 'Ukuran', 'key' => 'size', 'choices' => ['Regular (250g)', 'Jumbo (500g) +15k', 'Family (1kg) +35k']]
            ],
            'variant_images' => [
                'Original Almond' => 'Kue/Brownis_1.png',
                'Dark Chocolate Almond' => 'Kue/Brownis_2.png',
                'Caramel Almond' => 'Kue/Brownis_4.png'
            ]
        ],
        
        // Cheesecake Coklat
        (object) [
            'id' => 5,
            'nama_produk' => 'Cheesecake Coklat',
            'deskripsi' => 'Cheesecake lembut dengan lapisan coklat.',
            'harga' => 55000,
            'gambar' => 'Kue/Cheesecake_coklat.png',
            'kategori' => (object) ['nama_kategori' => 'Cake'],
            'options' => [
                (object) ['type' => 'radio', 'label' => 'Topping', 'key' => 'topping', 'choices' => ['Classic Coklat', 'Matcha Coklat', 'Berry Burst']],
                (object) ['type' => 'radio', 'label' => 'Porsi', 'key' => 'portion', 'choices' => ['Slice (1 potong)', 'Whole Cake (6-8 potong) +70k', 'Mini Set (3 pcs) +30k']]
            ],
             'variant_images' => [
                'cheesecake Almond' => 'Kue/almond_original.png',
                'Dark Chocolate ' => 'Kue/cheesecake_dark.png',
                'Caramel Almond' => 'Kue/cheesecake_caramel.png'
            ]
        ],
        
        
        // Cheesecake Lotus
        (object) [
            'id' => 6,
            'nama_produk' => 'Cheesecake Lotus',
            'deskripsi' => 'Cheesecake dengan biskuit lotus biscoff.',
            'harga' => 75000,
            'gambar' => 'Kue/Cheesecake_lotus.png',
            'kategori' => (object) ['nama_kategori' => 'Cake'],
            'options' => [
                (object) ['type' => 'radio', 'label' => 'Varian Lotus', 'key' => 'lotusVar', 'choices' => ['Lotus Biscoff Original', 'Lotus Caramel Swirl', 'Lotus White Choco']],
                (object) ['type' => 'radio', 'label' => 'Level Keju', 'key' => 'cheeseLevel', 'choices' => ['Regular Creamy', 'Extra Cheesy +12k', 'Super Premium +25k']]
            ]
        ],
        
        // Birthday Tart
        (object) [
            'id' => 7,
            'nama_produk' => 'Birthday Tart',
            'deskripsi' => 'Tart spesial dengan topping buah segar.',
            'harga' => 175000,
            'gambar' => 'Kue/birthday_tart.png',
            'kategori' => (object) ['nama_kategori' => 'Cake'],
            'options' => [
                (object) ['type' => 'radio', 'label' => 'Ukuran', 'key' => 'size', 'choices' => ['Regular (20cm)', 'Large (25cm) +50k', 'Jumbo (30cm) +100k']],
                (object) ['type' => 'radio', 'label' => 'Topping Tambahan', 'key' => 'extraTopping', 'choices' => ['Standar', 'Extra Fruit +15k', 'Extra Coklat +10k']]
            ]
        ],
        
        // Chocolate Cake (dengan gambar varian)
        (object) [
            'id' => 8,
            'nama_produk' => 'Chocolate Cake',
            'deskripsi' => 'Kue cokelat premium dengan ganache lembut.',
            'harga' => 150000,
            'gambar' => 'Kue/chocolate_cake.png',
            'kategori' => (object) ['nama_kategori' => 'Cake'],
            'options' => [
                (object) ['type' => 'radio', 'label' => 'Varian', 'key' => 'variant', 'choices' => ['Dark Chocolate', 'Milk Chocolate', 'White Chocolate']],
                (object) ['type' => 'radio', 'label' => 'Ukuran', 'key' => 'size', 'choices' => ['Small (250g)', 'Medium (500g) +30k', 'Large (1kg) +80k']]
            ],
            'variant_images' => [
                'Dark Chocolate' => 'Kue/chocolate_cake_dark.png',
                'Milk Chocolate' => 'Kue/chocolate_cake_milk.png',
                'White Chocolate' => 'Kue/chocolate_cake_white.png'
            ]
        ],
        
        // Vanilla Chocolate
        (object) [
            'id' => 9,
            'nama_produk' => 'Vanilla Chocolate',
            'deskripsi' => 'Kue spesial dengan topping buah segar.',
            'harga' => 175000,
            'gambar' => 'Kue/vanilla_chocolate_cupcake.png',
            'kategori' => (object) ['nama_kategori' => 'Cake'],
            'options' => [
                (object) ['type' => 'radio', 'label' => 'Topping', 'key' => 'topping', 'choices' => ['Sprinkles', 'Chocolate Chip +5k', 'Fruit +10k']]
            ]
        ],
        
        // Palm Cheese
        (object) [
            'id' => 11,
            'nama_produk' => 'Palm Cheese',
            'deskripsi' => 'Cookies dengan keju yang gurih.',
            'harga' => 45000,
            'gambar' => 'Cookies/Palm_cheese.png',
            'kategori' => (object) ['nama_kategori' => 'Kue Kering'],
            'options' => [
                (object) ['type' => 'radio', 'label' => 'Kemasan', 'key' => 'packaging', 'choices' => ['Toples Kecil (250g)', 'Toples Besar (500g) +15k', 'Paket Hemat (750g) +25k']]
            ]
        ],
        
        // Nuttela Cookies
        (object) [
            'id' => 13,
            'nama_produk' => 'Nuttela Cookies',
            'deskripsi' => 'Cookies dengan Nutella filling.',
            'harga' => 45000,
            'gambar' => 'Cookies/Nutella_Cookies.png',
            'kategori' => (object) ['nama_kategori' => 'Kue Kering'],
            'options' => [
                (object) ['type' => 'radio', 'label' => 'Kemasan', 'key' => 'packaging', 'choices' => ['Toples Kecil (250g)', 'Toples Besar (500g) +15k', 'Paket Hemat (750g) +25k']]
            ]
        ],
        
        
        // Puding Cake
        (object) [
            'id' => 14,
            'nama_produk' => 'Puding Cake',
            'deskripsi' => 'Perpaduan puding dan cake yang lezat.',
            'harga' => 25000,
            'gambar' => 'Kue/Pudingcake_1.png',
            'kategori' => (object) ['nama_kategori' => 'Cake'],
            'options' => [
                (object) ['type' => 'radio', 'label' => 'Rasa', 'key' => 'flavor', 'choices' => ['Coklat', 'Vanilla', 'Matcha +5k']]
            ]
        ],
        
        // Florentine Cookies
        (object) [
            'id' => 15,
            'nama_produk' => 'Florentine Cookies',
            'deskripsi' => 'Cookies aneka kacang.',
            'harga' => 25000,
            'gambar' => 'Cookies/Florentine_Cookies.png',
            'kategori' => (object) ['nama_kategori' => 'Kue Kering'],
            'options' => [
                (object) ['type' => 'radio', 'label' => 'Kemasan', 'key' => 'packaging', 'choices' => ['Toples Kecil (250g)', 'Toples Besar (500g) +15k']]
            ]
        ],
    ]);
}

        // Kategori:Cake
        $birthdayCakes = collect($produks)->filter(function ($produk) {
            $kategori = strtolower($produk->kategori->nama_kategori ?? '');
            $namaProduk = strtolower($produk->nama_produk ?? '');
            return str_contains($kategori, 'cake')
                || str_contains($namaProduk, 'tart')
                || str_contains($namaProduk, 'puding');
        });

        $cookies = collect($produks)->filter(function ($produk) {
            $kategori = strtolower($produk->kategori->nama_kategori ?? '');
            $namaProduk = strtolower($produk->nama_produk ?? '');
            return str_contains($kategori, 'kering')
                || str_contains($kategori, 'cookie')
                || str_contains($namaProduk, 'cookie')
                || str_contains($namaProduk, 'cookies');
        });

        $pastries = collect($produks)->filter(function ($produk) {
            $kategori = strtolower($produk->kategori->nama_kategori ?? '');
            $namaProduk = strtolower($produk->nama_produk ?? '');
            return str_contains($kategori, 'basah')
                || str_contains($kategori, 'pastry')
                || str_contains($namaProduk, 'brownis')
                || str_contains($namaProduk, 'cheesecake');
        });

        $assignedIds = $birthdayCakes->pluck('id')
            ->merge($cookies->pluck('id'))
            ->merge($pastries->pluck('id'))
            ->unique();

        $menuLain = collect($produks)->filter(function ($produk) use ($assignedIds) {
            return !$assignedIds->contains($produk->id);
        });

        $groupedMenus = [
            'Birthday Cake' => $birthdayCakes,
            'Cookies' => $cookies,
            'Menu Lain' => $menuLain,
        ];
    @endphp

    <!-- Category Tabs -->
    <section class="menu-container" style="max-width: 1400px; margin: 40px auto; padding: 0 20px;">
        <div class="category-tabs" style="display: flex; flex-wrap: wrap; justify-content: center; gap: 12px; margin-bottom: 40px;">
            @foreach(array_keys($groupedMenus) as $groupName)
                @if($groupedMenus[$groupName]->isNotEmpty())
                    <a href="#{{ \Illuminate\Support\Str::slug($groupName, '-') }}" class="category-tab" style="padding: 12px 22px; border-radius: 999px; background: #fde8f1; color: #6d4c41; font-weight: 700; text-decoration: none; box-shadow: 0 4px 12px rgba(0,0,0,0.06); transition: all 0.3s;">{{ $groupName }}</a>
                @endif
            @endforeach
        </div>

        @foreach($groupedMenus as $sectionTitle => $items)
            @if($items->isNotEmpty())
                <section id="{{ \Illuminate\Support\Str::slug($sectionTitle, '-') }}" style="margin-bottom: 50px; scroll-margin-top: 80px;">
                    <div style="display: flex; align-items: center; justify-content: space-between; gap: 12px; flex-wrap: wrap; margin-bottom: 20px;">
                        <div>
                            <h2 style="font-size: 32px; color: #6d4c41; margin-bottom: 8px;">{{ $sectionTitle }}</h2>
                            <p style="color: #8d6e63; margin: 0;">Lihat pilihan produk berdasarkan kategori {{ strtolower($sectionTitle) }}.</p>
                        </div>
                    </div>

                    <div class="menu-grid" style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 20px;">
                        @foreach($items as $produk)
                            @php
                                if($produk->gambar && !str_starts_with($produk->gambar, 'http')) {
                                    $imageUrl = asset('assets/img_produk/' . ltrim($produk->gambar, '/'));
                                } elseif($produk->gambar && str_starts_with($produk->gambar, 'http')) {
                                    $imageUrl = $produk->gambar;
                                } else {
                                    $imageUrl = 'https://picsum.photos/seed/' . $produk->id . '/300/200';
                                }
                                
                                // Siapkan data variant_images jika ada
                                $variantImages = isset($produk->variant_images) ? $produk->variant_images : [];
                                
                                $produkJson = json_encode([
                                    'id' => $produk->id,
                                    'nama_produk' => $produk->nama_produk,
                                    'deskripsi' => $produk->deskripsi,
                                    'harga' => $produk->harga,
                                    'options' => $produk->options ?? [],
                                    'gambar' => $imageUrl,
                                    'variant_images' => $variantImages
                                ]);
                            @endphp

                            <div class="menu-card" style="background: #fff; border-radius: 15px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); transition: transform 0.3s;">
                                <img src="{{ $imageUrl }}" alt="{{ $produk->nama_produk }}" style="width: 100%; height: 180px; object-fit: cover;" onerror="this.src='https://picsum.photos/300/200'">
                                <div class="menu-info" style="padding: 15px; text-align: center;">
                                    <h3 style="font-size: 16px; color: #6d4c41; margin-bottom: 8px; min-height: 40px;">{{ $produk->nama_produk }}</h3>
                                    <p style="font-size: 12px; color: #888; margin-bottom: 10px; min-height: 36px;">{{ $produk->deskripsi ?: 'Deskripsi produk belum tersedia.' }}</p>
                                    <span class="price" style="font-size: 14px; font-weight: bold; color: #f06292; margin-bottom: 10px; display: block;">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                                    <div style="display: flex; gap: 8px; justify-content: center;">
                                        {{-- TOMBOL MASUKKAN KERANJANG --}}
                                        <button class="btn-add-to-cart" data-produk='{{ $produkJson }}' style="background-color: #fce4ec; color: #f06292; padding: 8px 12px; border-radius: 20px; border: none; font-weight: 600; font-size: 12px; cursor: pointer; transition: all 0.3s; display: inline-flex; align-items: center; gap: 6px;">🛒 Masukkan Keranjang</button>
                                        
                                        {{-- TOMBOL PESAN SEKARANG --}}
                                        <button class="btn-order-now" data-produk='{{ $produkJson }}' style="background-color: #e0f2f1; color: #00897b; padding: 8px 20px; border-radius: 20px; border: none; font-weight: 600; font-size: 12px; cursor: pointer; transition: all 0.3s; display: inline-block;">💬 Pesan Sekarang</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif
        @endforeach
    </section>

    <!-- Modal Pilihan Pesanan dengan Metode Pembayaran untuk Pesan Sekarang -->
    <div id="orderModal" class="order-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.7); backdrop-filter: blur(5px); z-index: 1000; align-items: center; justify-content: center;">
        <div class="modal-content" style="background: #FFF8F0; border-radius: 25px; max-width: 550px; width: 90%; max-height: 85vh; overflow-y: auto;">
            <div class="modal-header" style="background: linear-gradient(135deg, #fce4ec, #f8bbd0); padding: 20px; border-radius: 25px 25px 0 0; position: sticky; top: 0;">
                <h3 id="modalTitle" style="color: #6d4c41; margin: 0; font-size: 22px;">Nama Produk</h3>
                <p id="modalDesc" style="color: #8d6e63; margin: 8px 0 0; font-size: 13px;">Deskripsi produk</p>
                <button class="modal-close" style="position: absolute; right: 20px; top: 20px; background: none; border: none; font-size: 28px; cursor: pointer; color: #6d4c41;">&times;</button>
            </div>
            <div class="modal-body" style="padding: 20px;" id="modalBody">
                <!-- Dynamic options will be inserted here -->
            </div>
            
            <!-- SECTION METODE PEMBAYARAN - DIHAPUS -->
            
            <div class="modal-footer" style="padding: 15px 20px 20px; border-top: 1px solid #f0e0d0; background: #FFF8F0; border-radius: 0 0 25px 25px;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                    <span style="font-weight: 600; color: #6d4c41;">Total Harga:</span>
                    <span id="modalTotalPrice" style="font-size: 24px; font-weight: bold; color: #f06292;">Rp 0</span>
                </div>
                <div style="display: flex; gap: 12px;">
                    <button id="cancelOrderBtn" style="flex: 1; padding: 12px; border-radius: 40px; border: 1px solid #f0c0d0; background: white; color: #f06292; font-weight: 600; cursor: pointer;">Batal</button>
                    <button id="confirmOrderBtn" style="flex: 1; padding: 12px; border-radius: 40px; border: none; background: linear-gradient(135deg, #25D366, #128C7E); color: white; font-weight: 600; cursor: pointer;">💳 Lanjut Pembayaran</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div id="toastNotification" style="position: fixed; bottom: 30px; left: 50%; transform: translateX(-50%) translateY(100px); background: #2c241e; color: #ffebcd; padding: 12px 24px; border-radius: 60px; font-weight: 500; z-index: 1100; transition: all 0.3s ease; opacity: 0; pointer-events: none; white-space: nowrap;">
        ✨ Pesanan ditambahkan
    </div>

    <!-- Floating Cart Button -->
    <div class="floating-cart" style="position: fixed; bottom: 30px; right: 30px; background: linear-gradient(135deg, #f06292, #ec407a); color: white; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 24px; cursor: pointer; box-shadow: 0 4px 15px rgba(0,0,0,0.2); z-index: 1000; transition: all 0.3s;">
        🛒 <span class="cart-badge" style="position: absolute; top: -5px; right: -5px; background: #ff5722; color: white; border-radius: 50%; width: 22px; height: 22px; font-size: 12px; display: none; align-items: center; justify-content: center; font-weight: bold;">0</span>
    </div>

    <style>
        @keyframes modalSlideIn {
            from { transform: translateY(-50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        .modal-content { animation: modalSlideIn 0.3s ease; }
        .menu-card:hover { transform: translateY(-5px); }
        .btn-order-now:hover { background-color: #00897b !important; color: white !important; }
        .btn-add-to-cart:hover { background-color: #f06292 !important; color: white !important; }
        .category-tab:hover { background-color: #f06292 !important; color: white !important; }
        .radio-option:hover { background: #fce4ec; }
        .floating-cart:hover { transform: scale(1.05); }
        .payment-option:hover { border-color: #f06292 !important; }
        
        /* Preview gambar varian */
        .variant-preview {
            text-align: center;
            margin-bottom: 20px;
            padding: 10px;
            background: #fff5f0;
            border-radius: 15px;
        }
        .variant-preview img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        .variant-preview p {
            margin-top: 8px;
            font-size: 12px;
            color: #888;
        }
        
        html { scroll-behavior: smooth; }
        
        @media (max-width: 1200px) { .menu-grid { grid-template-columns: repeat(4, 1fr) !important; } }
        @media (max-width: 992px) { .menu-grid { grid-template-columns: repeat(3, 1fr) !important; } }
        @media (max-width: 768px) { .menu-grid { grid-template-columns: repeat(2, 1fr) !important; } }
        @media (max-width: 480px) { .menu-grid { grid-template-columns: 1fr !important; } }
    </style>

    <script>
        // Nomor WhatsApp tujuan
        const WA_PHONE_NUMBER = '6281234567890';
        
        // Cart array to store items
        let cart = [];
        
        document.addEventListener('DOMContentLoaded', function() {
            // Active tab on scroll
            const sections = document.querySelectorAll('section[id]');
            const tabs = document.querySelectorAll('.category-tab');
            
            function updateActiveTab() {
                let current = '';
                const scrollPosition = window.scrollY + 100;
                
                sections.forEach(section => {
                    const sectionTop = section.offsetTop;
                    const sectionBottom = sectionTop + section.offsetHeight;
                    if (scrollPosition >= sectionTop && scrollPosition < sectionBottom) {
                        current = section.getAttribute('id');
                    }
                });
                
                tabs.forEach(tab => {
                    const tabHref = tab.getAttribute('href').substring(1);
                    if (tabHref === current) {
                        tab.style.backgroundColor = '#f06292';
                        tab.style.color = 'white';
                    } else {
                        tab.style.backgroundColor = '#fde8f1';
                        tab.style.color = '#6d4c41';
                    }
                });
            }
            
            window.addEventListener('scroll', updateActiveTab);
            updateActiveTab();
            
            // ========== CART FUNCTIONS ==========
            function addToCart(product, selections, quantity) {
                const cartItem = {
                    id: product.id,
                    name: product.nama_produk,
                    base_price: product.harga,
                    selections: { ...selections },
                    quantity: quantity,
                    total_price: calculateTotalPrice(product, selections, quantity)
                };
                
                const existingIndex = cart.findIndex(item => 
                    item.id === cartItem.id && 
                    JSON.stringify(item.selections) === JSON.stringify(cartItem.selections)
                );
                
                if (existingIndex !== -1) {
                    cart[existingIndex].quantity += quantity;
                    cart[existingIndex].total_price = calculateTotalPrice(product, cart[existingIndex].selections, cart[existingIndex].quantity);
                } else {
                    cart.push(cartItem);
                }
                
                localStorage.setItem('sweetSavoryCart', JSON.stringify(cart));
                showToastMessage('🛒 Ditambahkan ke keranjang!');
                updateCartBadge();
            }
            
            function calculateTotalPrice(product, selections, quantity) {
                let basePrice = product.harga;
                let extraPrice = 0;
                
                if (product.options && product.options.length > 0) {
                    for (let opt of product.options) {
                        const key = opt.key;
                        if (selections[key]) {
                            extraPrice += parsePriceModifierFromChoice(selections[key]);
                        }
                    }
                }
                
                return (basePrice + extraPrice) * quantity;
            }
            
            function parsePriceModifierFromChoice(choice) {
                let extra = 0;
                const matchPlusK = choice.match(/\+(\d+)k/i);
                const matchPlus = choice.match(/\+(\d+)(?!k)/i);
                if (matchPlusK) {
                    extra = parseInt(matchPlusK[1]) * 1000;
                } else if (matchPlus) {
                    extra = parseInt(matchPlus[1]);
                }
                return extra;
            }
            
            function updateCartBadge() {
                const floatingCart = document.querySelector('.floating-cart');
                const cartBadge = document.querySelector('.cart-badge');
                
                if (!floatingCart || !cartBadge) return;
                
                const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
                cartBadge.textContent = totalItems;
                
                if (totalItems > 0) {
                    cartBadge.style.display = 'flex';
                } else {
                    cartBadge.style.display = 'none';
                }
            }
            
            // Payment details functions removed as they are no longer needed for Midtrans integration.
            
            function showCartModal() {
                if (cart.length === 0) {
                    showToastMessage('Keranjang belanja masih kosong');
                    return;
                }
                
                let grandTotal = 0;
                let cartHtml = `
                    <div id="cartModal" class="order-modal" style="display: flex; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.7); backdrop-filter: blur(5px); z-index: 1001; align-items: center; justify-content: center;">
                        <div class="modal-content" style="background: #FFF8F0; border-radius: 25px; max-width: 650px; width: 90%; max-height: 85vh; overflow-y: auto;">
                            <div class="modal-header" style="background: linear-gradient(135deg, #fce4ec, #f8bbd0); padding: 20px; border-radius: 25px 25px 0 0; position: sticky; top: 0;">
                                <h3 style="color: #6d4c41; margin: 0; font-size: 22px;">🛒 Keranjang Belanja</h3>
                                <button class="cart-modal-close" style="position: absolute; right: 20px; top: 20px; background: none; border: none; font-size: 28px; cursor: pointer; color: #6d4c41;">&times;</button>
                            </div>
                            <div class="modal-body" style="padding: 20px;" id="cartModalBody">
                `;
                
                cart.forEach((item, index) => {
                    const itemTotal = item.total_price;
                    grandTotal += itemTotal;
                    let selectionsText = '';
                    for (const [key, value] of Object.entries(item.selections)) {
                        selectionsText += `<span style="display: inline-block; background: #fce4ec; padding: 2px 8px; border-radius: 20px; font-size: 11px; margin-right: 5px; margin-bottom: 5px;">${key}: ${value}</span>`;
                    }
                    cartHtml += `
                        <div style="display: flex; align-items: center; gap: 12px; padding: 12px; border-bottom: 1px solid #f0e0d0; margin-bottom: 10px;">
                            <div style="flex: 1;">
                                <div style="font-weight: 600; color: #6d4c41;">${item.name}</div>
                                <div style="font-size: 12px; color: #888; margin-top: 5px;">${selectionsText}</div>
                                <div style="font-size: 12px; color: #f06292; margin-top: 5px;">${formatRupiah(item.base_price)} x ${item.quantity} = ${formatRupiah(itemTotal)}</div>
                            </div>
                            <div style="display: flex; gap: 8px;">
                                <button class="cart-qty-minus" data-index="${index}" style="width: 28px; height: 28px; border-radius: 50%; border: 1px solid #f0c0d0; background: white; color: #f06292; cursor: pointer;">-</button>
                                <span style="min-width: 30px; text-align: center;">${item.quantity}</span>
                                <button class="cart-qty-plus" data-index="${index}" style="width: 28px; height: 28px; border-radius: 50%; border: 1px solid #f0c0d0; background: white; color: #f06292; cursor: pointer;">+</button>
                                <button class="cart-remove" data-index="${index}" style="background: none; border: none; color: #e57373; cursor: pointer; font-size: 18px;">🗑️</button>
                            </div>
                        </div>
                    `;
                });
                
                // Metod pembayaran manual dihapus untuk Midtrans
                cartHtml += `
                            </div>
                            <div class="modal-footer" style="padding: 15px 20px 20px; border-top: 1px solid #f0e0d0; background: #FFF8F0; border-radius: 0 0 25px 25px;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                                    <span style="font-weight: 600; color: #6d4c41;">Total Belanja:</span>
                                    <span style="font-size: 24px; font-weight: bold; color: #f06292;">${formatRupiah(grandTotal)}</span>
                                </div>
                                <div style="display: flex; gap: 12px;">
                                    <button id="clearCartBtn" style="flex: 1; padding: 12px; border-radius: 40px; border: 1px solid #f0c0d0; background: white; color: #e57373; font-weight: 600; cursor: pointer;">Kosongkan</button>
                                    <button id="checkoutCartBtn" style="flex: 1; padding: 12px; border-radius: 40px; border: none; background: linear-gradient(135deg, #25D366, #128C7E); color: white; font-weight: 600; cursor: pointer;">📱 Proses Pesanan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                
                const existingCartModal = document.getElementById('cartModal');
                if (existingCartModal) existingCartModal.remove();
                
                document.body.insertAdjacentHTML('beforeend', cartHtml);
                document.body.style.overflow = 'hidden';
                
                const cartModal = document.getElementById('cartModal');
                const closeBtn = cartModal.querySelector('.cart-modal-close');
                const clearBtn = document.getElementById('clearCartBtn');
                const checkoutBtn = document.getElementById('checkoutCartBtn');
                
                // Handlers untuk pilihan pembayaran lama dihapus
                
                closeBtn.addEventListener('click', () => {
                    cartModal.remove();
                    document.body.style.overflow = '';
                });
                
                clearBtn.addEventListener('click', () => {
                    cart = [];
                    localStorage.removeItem('sweetSavoryCart');
                    updateCartBadge();
                    cartModal.remove();
                    document.body.style.overflow = '';
                    showToastMessage('Keranjang telah dikosongkan');
                });
                
                checkoutBtn.addEventListener('click', () => {
                    sendCartToWhatsAppWithPayment();
                    cartModal.remove();
                    document.body.style.overflow = '';
                });
                
                document.querySelectorAll('.cart-qty-minus').forEach(btn => {
                    btn.addEventListener('click', (e) => {
                        const index = parseInt(btn.dataset.index);
                        if (cart[index].quantity > 1) {
                            cart[index].quantity--;
                            cart[index].total_price = calculateTotalPriceForCartItem(cart[index]);
                            localStorage.setItem('sweetSavoryCart', JSON.stringify(cart));
                            updateCartBadge();
                            showCartModal();
                        } else {
                            cart.splice(index, 1);
                            localStorage.setItem('sweetSavoryCart', JSON.stringify(cart));
                            updateCartBadge();
                            if (cart.length === 0) {
                                cartModal.remove();
                                document.body.style.overflow = '';
                                showToastMessage('Keranjang kosong');
                            } else {
                                showCartModal();
                            }
                        }
                    });
                });
                
                document.querySelectorAll('.cart-qty-plus').forEach(btn => {
                    btn.addEventListener('click', (e) => {
                        const index = parseInt(btn.dataset.index);
                        cart[index].quantity++;
                        cart[index].total_price = calculateTotalPriceForCartItem(cart[index]);
                        localStorage.setItem('sweetSavoryCart', JSON.stringify(cart));
                        updateCartBadge();
                        showCartModal();
                    });
                });
                
                document.querySelectorAll('.cart-remove').forEach(btn => {
                    btn.addEventListener('click', (e) => {
                        const index = parseInt(btn.dataset.index);
                        cart.splice(index, 1);
                        localStorage.setItem('sweetSavoryCart', JSON.stringify(cart));
                        updateCartBadge();
                        if (cart.length === 0) {
                            cartModal.remove();
                            document.body.style.overflow = '';
                            showToastMessage('Keranjang kosong');
                        } else {
                            showCartModal();
                        }
                    });
                });
                
                cartModal.addEventListener('click', (e) => {
                    if (e.target === cartModal) {
                        cartModal.remove();
                        document.body.style.overflow = '';
                    }
                });
            }
            
            function calculateTotalPriceForCartItem(item) {
                let basePrice = item.base_price;
                let extraPrice = 0;
                for (const [key, value] of Object.entries(item.selections)) {
                    extraPrice += parsePriceModifierFromChoice(value);
                }
                return (basePrice + extraPrice) * item.quantity;
            }
            
            // Fungsi pembantu pembayaran lama dihapus
            
            function checkoutMidtrans(items, total, messageWA) {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                showToastMessage('Sedang memproses pembayaran...');
                
                fetch('/checkout', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        items: items,
                        total: total
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.snapToken) {
                        window.snap.pay(data.snapToken, {
                            onSuccess: function(result) {
                                showToastMessage('Pembayaran berhasil!');
                                // Bersihkan keranjang
                                cart = [];
                                localStorage.removeItem('sweetSavoryCart');
                                updateCartBadge();
                                const cartModal = document.getElementById('cartModal');
                                if(cartModal) cartModal.remove();
                                
                                const waLink = `https://api.whatsapp.com/send/?phone=${WA_PHONE_NUMBER}&text=${messageWA}&type=phone_number&app_absent=0`;
                                window.open(waLink, '_blank');
                            },
                            onPending: function(result) {
                                showToastMessage('Menunggu pembayaran...');
                                const waLink = `https://api.whatsapp.com/send/?phone=${WA_PHONE_NUMBER}&text=${messageWA}&type=phone_number&app_absent=0`;
                                window.open(waLink, '_blank');
                            },
                            onError: function(result) {
                                showToastMessage('Pembayaran gagal.');
                            },
                            onClose: function() {
                                showToastMessage('Anda menutup popup pembayaran.');
                            }
                        });
                    } else {
                        showToastMessage('Gagal mendapatkan token pembayaran.');
                        console.error(data);
                    }
                })
                .catch(err => {
                    showToastMessage('Terjadi kesalahan koneksi.');
                    console.error(err);
                });
            }

            function sendCartToWhatsAppWithPayment() {
                if (cart.length === 0) {
                    showToastMessage('Keranjang kosong');
                    return;
                }
                
                let grandTotal = 0;
                let itemsList = [];
                let messageWA = 'Halo Dear Seana,%0A%0A*PESANAN BARU DARI KERANJANG*%0A%0A';
                
                cart.forEach((item, idx) => {
                    let selectionsText = '';
                    for (const [key, value] of Object.entries(item.selections)) {
                        selectionsText += `   • ${key}: ${value}\n`;
                    }
                    messageWA += `*${idx+1}. ${item.name}*%0A`;
                    messageWA += `   📦 Jumlah: ${item.quantity}%0A`;
                    if (selectionsText) {
                        messageWA += `   📋 Pilihan:%0A${selectionsText}`;
                    }
                    messageWA += `   💰 Subtotal: ${formatRupiah(item.total_price)}%0A%0A`;
                    grandTotal += item.total_price;
                    
                    itemsList.push({
                        id: item.id,
                        price: item.total_price / item.quantity,
                        quantity: item.quantity,
                        name: item.name
                    });
                });
                
                messageWA += `*TOTAL: ${formatRupiah(grandTotal)}*%0A%0A`;
                messageWA += `Terima kasih! 🙏`;
                
                checkoutMidtrans(itemsList, grandTotal, messageWA);
            }
            
            function formatRupiah(angka) {
                return 'Rp ' + new Intl.NumberFormat('id-ID').format(angka);
            }
            
            function loadCartFromStorage() {
                const savedCart = localStorage.getItem('sweetSavoryCart');
                if (savedCart) {
                    cart = JSON.parse(savedCart);
                    updateCartBadge();
                }
            }
            
            loadCartFromStorage();
            
            const floatingCart = document.querySelector('.floating-cart');
            if (floatingCart) {
                floatingCart.addEventListener('click', showCartModal);
            }
            
            // ========== MODAL ORDER SYSTEM ==========
            const modal = document.getElementById('orderModal');
            const modalTitle = document.getElementById('modalTitle');
            const modalDesc = document.getElementById('modalDesc');
            const modalBody = document.getElementById('modalBody');
            const modalTotalPrice = document.getElementById('modalTotalPrice');
            const cancelBtn = document.getElementById('cancelOrderBtn');
            const confirmBtn = document.getElementById('confirmOrderBtn');
            const closeModalBtn = document.querySelector('.modal-close');
            const paymentSection = document.getElementById('paymentSection');
            const toast = document.getElementById('toastNotification');
            
            let currentProduct = null;
            let currentSelections = {};
            let currentQuantity = 1;
            let currentAction = 'order';
            
            function showToastMessage(message) {
                toast.textContent = message;
                toast.style.opacity = '1';
                toast.style.transform = 'translateX(-50%) translateY(0)';
                setTimeout(() => {
                    toast.style.opacity = '0';
                    toast.style.transform = 'translateX(-50%) translateY(100px)';
                }, 2500);
            }
            
            function calculateTotal() {
                if (!currentProduct) return 0;
                let basePrice = currentProduct.harga;
                let extraPrice = 0;
                if (currentProduct.options && currentProduct.options.length > 0) {
                    for (let opt of currentProduct.options) {
                        const key = opt.key;
                        if (currentSelections[key]) {
                            extraPrice += parsePriceModifierFromChoice(currentSelections[key]);
                        }
                    }
                }
                return (basePrice + extraPrice) * currentQuantity;
            }
            
            function updateModalTotal() {
                modalTotalPrice.textContent = formatRupiah(calculateTotal());
            }
            
            function getVariantImage(variantName) {
                if (currentProduct && currentProduct.variant_images && currentProduct.variant_images[variantName]) {
                    let imagePath = currentProduct.variant_images[variantName];
                    if (!imagePath.startsWith('http') && !imagePath.startsWith('/')) {
                        return '{{ asset("assets/img_produk/") }}/' + imagePath;
                    }
                    return imagePath;
                }
                return currentProduct ? currentProduct.gambar : '';
            }
            
            function updateVariantPreview(variantName) {
                const previewContainer = document.getElementById('variantPreviewContainer');
                if (previewContainer && currentProduct && currentProduct.variant_images) {
                    const newImageUrl = getVariantImage(variantName);
                    const imgElement = previewContainer.querySelector('img');
                    const textElement = previewContainer.querySelector('p');
                    if (imgElement) {
                        imgElement.src = newImageUrl;
                        if (textElement) textElement.textContent = '🍫 ' + variantName;
                    }
                }
            }
            
            // Fungsi detail pembayaran order dihapus
            
            // Handlers pembayaran order dihapus
            
            function buildModalContent(product, actionType = 'order') {
                currentProduct = product;
                currentSelections = {};
                currentQuantity = 1;
                currentAction = actionType;
                
                modalTitle.textContent = product.nama_produk;
                modalDesc.textContent = product.deskripsi || 'Nikmati kelezatan produk ini';
                
                if (actionType === 'order') {
                    confirmBtn.innerHTML = '💳 Lanjut Pembayaran';
                } else {
                    confirmBtn.innerHTML = '🛒 Tambah ke Keranjang';
                }
                
                let html = '';
                
                if (product.variant_images && Object.keys(product.variant_images).length > 0) {
                    const defaultVariant = product.options && product.options[0] ? product.options[0].choices[0] : Object.keys(product.variant_images)[0];
                    const defaultImage = getVariantImage(defaultVariant);
                    html += `
                        <div class="variant-preview" id="variantPreviewContainer">
                            <img src="${defaultImage}" alt="Preview Varian" style="width: 120px; height: 120px; object-fit: cover; border-radius: 15px;">
                            <p>🍫 ${defaultVariant}</p>
                        </div>
                    `;
                }
                
                if (product.options && product.options.length > 0) {
                    for (let opt of product.options) {
                        if (opt.type === 'radio' && opt.choices && opt.choices.length > 0) {
                            currentSelections[opt.key] = opt.choices[0];
                            html += `
                                <div class="option-group" style="margin-bottom: 20px;">
                                    <label style="font-weight: 600; display: block; margin-bottom: 12px; color: #6d4c41; border-left: 4px solid #f06292; padding-left: 12px;">${opt.label}</label>
                                    <div class="radio-group" data-key="${opt.key}" style="display: flex; flex-direction: column; gap: 10px;">
                            `;
                            for (let choice of opt.choices) {
                                const isChecked = (currentSelections[opt.key] === choice);
                                let choiceImage = '';
                                if (opt.key === 'variant' && product.variant_images && product.variant_images[choice]) {
                                    choiceImage = getVariantImage(choice);
                                }
                                html += `
                                    <div class="radio-option" data-choice="${choice}" data-key="${opt.key}" style="display: flex; align-items: center; gap: 10px; padding: 8px 15px; background: ${isChecked ? '#fce4ec' : '#fff'}; border: 1px solid ${isChecked ? '#f06292' : '#f0d0d0'}; border-radius: 30px; cursor: pointer;">
                                        ${choiceImage ? `<img src="${choiceImage}" style="width: 30px; height: 30px; object-fit: cover; border-radius: 8px;">` : ''}
                                        <input type="radio" name="${opt.key}" value="${choice.replace(/"/g, '&quot;')}" id="${opt.key}_${choice.replace(/[^a-zA-Z0-9]/g, '_')}" ${isChecked ? 'checked' : ''} style="accent-color: #f06292; width: 18px; height: 18px;">
                                        <label for="${opt.key}_${choice.replace(/[^a-zA-Z0-9]/g, '_')}" style="flex: 1; cursor: pointer; color: #6d4c41;">${choice}</label>
                                    </div>
                                `;
                            }
                            html += `</div></div>`;
                        }
                    }
                } else {
                    html += `<p style="text-align: center; color: #8d6e63; padding: 20px;">Tidak ada pilihan tambahan untuk produk ini.</p>`;
                }
                
                html += `
                    <div class="option-group" style="margin-bottom: 20px;">
                        <label style="font-weight: 600; display: block; margin-bottom: 12px; color: #6d4c41; border-left: 4px solid #f06292; padding-left: 12px;">📦 Jumlah Pesanan</label>
                        <div style="display: flex; align-items: center; gap: 15px; background: #fff; padding: 10px 15px; border-radius: 40px; border: 1px solid #f0d0d0; width: fit-content;">
                            <button type="button" id="qtyMinus" style="width: 36px; height: 36px; border-radius: 50%; border: none; background: #fce4ec; color: #f06292; font-size: 20px; font-weight: bold; cursor: pointer;">−</button>
                            <span id="qtyValue" style="font-size: 20px; font-weight: 600; min-width: 50px; text-align: center; color: #6d4c41;">1</span>
                            <button type="button" id="qtyPlus" style="width: 36px; height: 36px; border-radius: 50%; border: none; background: #fce4ec; color: #f06292; font-size: 20px; font-weight: bold; cursor: pointer;">+</button>
                        </div>
                    </div>
                `;
                
                modalBody.innerHTML = html;
                
                if (product.options) {
                    for (let opt of product.options) {
                        if (opt.type === 'radio') {
                            const radioInputs = document.querySelectorAll(`input[name="${opt.key}"]`);
                            radioInputs.forEach(input => {
                                input.addEventListener('change', (e) => {
                                    if (input.checked) {
                                        currentSelections[opt.key] = input.value;
                                        const container = input.closest('.radio-group');
                                        if (container) {
                                            const allOptions = container.querySelectorAll('.radio-option');
                                            allOptions.forEach(optDiv => {
                                                const radioInside = optDiv.querySelector('input');
                                                if (radioInside && radioInside.checked) {
                                                    optDiv.style.background = '#fce4ec';
                                                    optDiv.style.borderColor = '#f06292';
                                                } else if (optDiv.querySelector('input')) {
                                                    optDiv.style.background = '#fff';
                                                    optDiv.style.borderColor = '#f0d0d0';
                                                }
                                            });
                                        }
                                        if (opt.key === 'variant' && product.variant_images) {
                                            updateVariantPreview(input.value);
                                        }
                                        updateModalTotal();
                                    }
                                });
                            });
                        }
                    }
                }
                
                const qtyMinus = document.getElementById('qtyMinus');
                const qtyPlus = document.getElementById('qtyPlus');
                const qtySpan = document.getElementById('qtyValue');
                
                if (qtyMinus && qtyPlus) {
                    const updateQty = (delta) => {
                        let newQty = currentQuantity + delta;
                        if (newQty < 1) newQty = 1;
                        if (newQty > 99) newQty = 99;
                        currentQuantity = newQty;
                        qtySpan.textContent = currentQuantity;
                        updateModalTotal();
                    };
                    qtyMinus.onclick = () => updateQty(-1);
                    qtyPlus.onclick = () => updateQty(1);
                }
                
                updateModalTotal();
            }
            
            function openModal(product, actionType = 'order') {
                buildModalContent(product, actionType);
                modal.style.display = 'flex';
                document.body.style.overflow = 'hidden';
                if (actionType === 'order') {
                    // initOrderPaymentHandlers removed
                }
            }
            
            function closeModal() {
                modal.style.display = 'none';
                document.body.style.overflow = '';
                currentProduct = null;
                currentSelections = {};
                currentQuantity = 1;
            }
            
            function sendToWhatsAppWithPayment() {
                if (!currentProduct) return;
                
                const total = calculateTotal();
                let productName = currentProduct.nama_produk;
                
                let selectionsText = '';
                if (Object.keys(currentSelections).length > 0) {
                    selectionsText = '\n📋 *Pilihan:*\n';
                    for (let [key, value] of Object.entries(currentSelections)) {
                        selectionsText += `   • ${key}: ${value}\n`;
                    }
                }
                
                let itemsList = [{
                    id: currentProduct.id,
                    price: total / currentQuantity,
                    quantity: currentQuantity,
                    name: productName
                }];
                
                const messageWA = `Halo Dear Seana,%0A%0A*PESANAN BARU*%0A%0A🍰 *${productName}*%0A📦 Jumlah: ${currentQuantity}%0A${selectionsText}%0A💰 *Total: ${formatRupiah(total)}*%0A%0ATerima kasih! 🙏`;
                
                checkoutMidtrans(itemsList, total, messageWA);
                closeModal();
            }
            
            // Tombol Masukkan Keranjang
            document.querySelectorAll('.btn-add-to-cart').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    const produkData = this.getAttribute('data-produk');
                    if (produkData) {
                        const product = JSON.parse(produkData);
                        openModal(product, 'cart');
                    }
                });
            });
            
            // Tombol Pesan Sekarang
            document.querySelectorAll('.btn-order-now').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    const produkData = this.getAttribute('data-produk');
                    if (produkData) {
                        const product = JSON.parse(produkData);
                        openModal(product, 'order');
                    }
                });
            });
            
            cancelBtn.addEventListener('click', closeModal);
            
            confirmBtn.addEventListener('click', () => {
                if (currentAction === 'cart') {
                    if (currentProduct) {
                        addToCart(currentProduct, currentSelections, currentQuantity);
                        closeModal();
                    }
                } else {
                    sendToWhatsAppWithPayment();
                }
            });
            
            closeModalBtn.addEventListener('click', closeModal);
            
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    closeModal();
                }
            });
            
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && modal.style.display === 'flex') {
                    closeModal();
                }
            });
        });
    </script>
@endsection