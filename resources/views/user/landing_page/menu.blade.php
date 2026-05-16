@extends('user.layouts.app')

@section('content')
    <!-- Menu Header dengan efek partikel dan parallax 3D -->
    <section class="menu-header" style="background: linear-gradient(135deg, rgba(252,228,236,0.92), rgba(248,187,208,0.92)), url('https://i.pinimg.com/1200x/61/43/a2/6143a2c8975f04a2ed426936e99fb025.jpg'); background-size: cover; background-position: center; background-attachment: fixed; padding: 100px 20px; text-align: center; position: relative; overflow: hidden;">
        <!-- Efek partikel animasi -->
        <div class="particles" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; overflow: hidden; z-index: 1;">
            <div class="particle" style="position: absolute; width: 8px; height: 8px; background: rgba(255,255,255,0.6); border-radius: 50%; animation: particleFloat 15s infinite linear;"></div>
            <div class="particle" style="position: absolute; width: 12px; height: 12px; background: rgba(240,98,146,0.4); border-radius: 50%; animation: particleFloat 20s infinite linear; animation-delay: 2s;"></div>
            <div class="particle" style="position: absolute; width: 6px; height: 6px; background: rgba(255,215,0,0.5); border-radius: 50%; animation: particleFloat 12s infinite linear; animation-delay: 5s;"></div>
            <div class="particle" style="position: absolute; width: 10px; height: 10px; background: rgba(255,255,255,0.5); border-radius: 50%; animation: particleFloat 18s infinite linear; animation-delay: 8s;"></div>
            <div class="particle" style="position: absolute; width: 14px; height: 14px; background: rgba(240,98,146,0.3); border-radius: 50%; animation: particleFloat 25s infinite linear; animation-delay: 3s;"></div>
        </div>
        <div style="position: absolute; top: -50%; left: -50%; width: 200%; height: 200%; background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, transparent 70%); animation: rotateGlow 25s linear infinite; z-index: 1;"></div>
        <div class="container" style="position: relative; z-index: 3;">
            <div style="animation: bounceIn 1s cubic-bezier(0.68, -0.55, 0.265, 1.55);">
                <span style="display: inline-block; font-size: 80px; margin-bottom: 10px; filter: drop-shadow(0 8px 15px rgba(0,0,0,0.15));">🍰</span>
            </div>
            <h1 style="font-size: 64px; color: #6d4c41; margin-bottom: 15px; font-weight: 900; text-shadow: 4px 4px 8px rgba(255,255,255,0.7); letter-spacing: -1px; background: linear-gradient(135deg, #6d4c41, #8d6e63); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; animation: slideInLeft 0.8s ease;">Daftar Menu Lengkap</h1>
            <p style="font-size: 22px; color: #8d6e63; text-shadow: 2px 2px 6px rgba(255,255,255,0.6); animation: slideInRight 0.8s ease 0.2s both;">✨ Berbagai pilihan manis dan gurih untuk Anda ✨</p>
            <div style="margin-top: 30px; animation: fadeInUp 1s ease 0.4s both;">
                <a href="#menu" class="scroll-indicator" style="display: inline-flex; align-items: center; gap: 10px; padding: 12px 24px; background: rgba(255,255,255,0.3); backdrop-filter: blur(10px); border-radius: 50px; color: #6d4c41; text-decoration: none; font-weight: 600; transition: all 0.3s;">👇 Lihat Menu <span style="animation: bounce 1s infinite;">↓</span></a>
            </div>
        </div>
        <div style="position: absolute; bottom: -30px; left: 0; right: 0; height: 100px; background: linear-gradient(135deg, transparent 0%, transparent 50%, #fff8f0 50%, #fff8f0 100%); z-index: 2;"></div>
    </section>

    @php
        // Inisialisasi koleksi produk dari database
        // Tidak ada inisialisasi hardcode, menggunakan $produks dari controller

        // Kategori: Cake (Gabungan Birthday Cake dan Pastries)
        $cakes = collect($produks)->filter(function ($produk) {
            $kategori = strtolower($produk->kategori->nama_kategori ?? '');
            $namaProduk = strtolower($produk->nama_produk ?? '');
            return str_contains($kategori, 'cake')
                || str_contains($kategori, 'ulang tahun')
                || str_contains($kategori, 'basah')
                || str_contains($kategori, 'pastry')
                || str_contains($kategori, 'dessert')
                || str_contains($namaProduk, 'tart')
                || str_contains($namaProduk, 'cake')
                || str_contains($namaProduk, 'puding')
                || str_contains($namaProduk, 'brownis')
                || str_contains($namaProduk, 'cheesecake');
        });

        $cookies = collect($produks)->filter(function ($produk) {
            $kategori = strtolower($produk->kategori->nama_kategori ?? '');
            $namaProduk = strtolower($produk->nama_produk ?? '');
            return str_contains($kategori, 'cookies')
                || str_contains($kategori, 'kering')
                || str_contains($kategori, 'cookie')
                || str_contains($namaProduk, 'cookie')
                || str_contains($namaProduk, 'cookies');
        });

        $assignedIds = $cakes->pluck('id')
            ->merge($cookies->pluck('id'))
            ->unique();

        $menuLain = collect($produks)->filter(function ($produk) use ($assignedIds) {
            return !$assignedIds->contains($produk->id);
        });

        $groupedMenus = [
            'Cake' => $cakes,
            'Cookies' => $cookies,
            'Menu Lain' => $menuLain,
        ];
        
        // CEK APAKAH MENU KOSONG
        $isEmptyMenu = true;
        foreach($groupedMenus as $items) {
            if($items->isNotEmpty()) {
                $isEmptyMenu = false;
                break;
            }
        }
    @endphp

    <!-- Category Tabs dengan efek modern -->
    <section id="menu" class="menu-container" style="max-width: 1400px; margin: 50px auto; padding: 0 25px;">
        @if(!$isEmptyMenu)
            <div class="category-tabs" style="display: flex; flex-wrap: wrap; justify-content: center; gap: 18px; margin-bottom: 55px;">
                @foreach(array_keys($groupedMenus) as $groupName)
                    @if($groupedMenus[$groupName]->isNotEmpty())
                        <a href="#{{ \Illuminate\Support\Str::slug($groupName, '-') }}" class="category-tab" style="padding: 16px 32px; border-radius: 999px; background: rgba(255,245,240,0.9); backdrop-filter: blur(10px); color: #6d4c41; font-weight: 800; text-decoration: none; box-shadow: 0 8px 20px rgba(0,0,0,0.08); transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); border: 1px solid rgba(255,255,255,0.8);">
                            🍰 {{ $groupName }}
                        </a>
                    @endif
                @endforeach
            </div>

            @foreach($groupedMenus as $sectionTitle => $items)
                @if($items->isNotEmpty())
                    <section id="{{ \Illuminate\Support\Str::slug($sectionTitle, '-') }}" style="margin-bottom: 80px; scroll-margin-top: 100px;">
                        <div style="display: flex; align-items: baseline; justify-content: space-between; gap: 16px; flex-wrap: wrap; margin-bottom: 35px; padding-bottom: 20px; border-bottom: 3px solid rgba(240,98,146,0.3);">
                            <div>
                                <h2 style="font-size: 42px; color: #6d4c41; margin-bottom: 10px; font-weight: 900; letter-spacing: -1px; background: linear-gradient(135deg, #6d4c41, #f06292); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">{{ $sectionTitle }}</h2>
                                <p style="color: #8d6e63; margin: 0; font-size: 16px;">✨ Lihat pilihan produk berdasarkan kategori {{ strtolower($sectionTitle) }}</p>
                            </div>
                            <div style="background: linear-gradient(135deg, #fce4ec, #f8bbd0); padding: 10px 28px; border-radius: 999px; box-shadow: 0 4px 15px rgba(240,98,146,0.2);">
                                <span style="color: #6d4c41; font-weight: 800;">🍪 {{ $items->count() }} Produk</span>
                            </div>
                        </div>

                        <div class="menu-grid" style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 30px;">
                            @foreach($items as $index => $produk)
                                @php
                                    if($produk->gambar && !str_starts_with($produk->gambar, 'http')) {
                                        if (str_starts_with($produk->gambar, 'Kue/') || str_starts_with($produk->gambar, 'Cookies/')) {
                                            $imageUrl = asset('assets/img_produk/' . ltrim($produk->gambar, '/'));
                                        } else {
                                            $imageUrl = asset('storage/' . $produk->gambar);
                                        }
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

                                <div class="menu-card" data-aos="fade-up" data-aos-delay="{{ $index * 50 }}" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(5px); border-radius: 28px; overflow: hidden; box-shadow: 0 15px 35px rgba(0,0,0,0.08); transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1); position: relative; border: 1px solid rgba(255,255,255,0.6);">
                                    <!-- Efek glow saat hover -->
                                    <div class="card-glow" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: radial-gradient(circle at 50% 0%, rgba(240,98,146,0.15), transparent 70%); opacity: 0; transition: opacity 0.5s; pointer-events: none; z-index: 1;"></div>
                                    
                                    <div style="position: relative; overflow: hidden; height: 230px; background: linear-gradient(135deg, #fce4ec, #f8bbd0);">
                                        <img src="{{ $imageUrl }}" alt="{{ $produk->nama_produk }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);" onerror="this.src='https://picsum.photos/300/200'">
                                        <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(135deg, rgba(240,98,146,0.2), rgba(236,64,122,0.2)); opacity: 0; transition: opacity 0.5s;"></div>
                                        <div class="discount-badge" style="position: absolute; top: 15px; right: 15px; background: linear-gradient(135deg, #f06292, #ec407a); color: white; padding: 6px 14px; border-radius: 40px; font-size: 11px; font-weight: 800; box-shadow: 0 4px 10px rgba(0,0,0,0.1); z-index: 2;">
                                            🔥 Best Seller
                                        </div>
                                        <div class="quick-view" style="position: absolute; bottom: 15px; left: 50%; transform: translateX(-50%) translateY(50px); background: rgba(255,255,255,0.9); backdrop-filter: blur(8px); padding: 8px 16px; border-radius: 40px; font-size: 12px; font-weight: 600; color: #f06292; opacity: 0; transition: all 0.3s; cursor: pointer; z-index: 2;">👁️ Quick View</div>
                                    </div>
                                    <div class="menu-info" style="padding: 22px 20px 24px; text-align: center; position: relative; z-index: 2;">
                                        <h3 style="font-size: 19px; color: #6d4c41; margin-bottom: 10px; font-weight: 900;">{{ $produk->nama_produk }}</h3>
                                        <p style="font-size: 13px; color: #a1887f; margin-bottom: 16px; min-height: 42px; line-height: 1.5;">{{ $produk->deskripsi ?: '✨ Nikmati kelezatan produk ini' }}</p>
                                        <div style="display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">
                                            <span class="price" style="font-size: 24px; font-weight: 900; color: #f06292;">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                                        </div>
                                        <div style="display: flex; gap: 12px; justify-content: center;">
                                            <button class="btn-add-to-cart" data-produk='{{ $produkJson }}' style="background: linear-gradient(135deg, #e0f2f1, #b2dfdb); color: #00695c; padding: 12px 18px; border-radius: 50px; border: none; font-weight: 800; font-size: 12px; cursor: pointer; transition: all 0.3s; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 4px 12px rgba(0,105,92,0.15);">🛒 Tambah</button>
                                            <button class="btn-order-now" data-produk='{{ $produkJson }}' style="background: linear-gradient(135deg, #fce4ec, #f8bbd0); color: #f06292; padding: 12px 24px; border-radius: 50px; border: none; font-weight: 800; font-size: 12px; cursor: pointer; transition: all 0.3s; display: inline-block; box-shadow: 0 4px 12px rgba(240,98,146,0.15);">💬 Pesan</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>
                @endif
            @endforeach
            
            <!-- Section Promo Bawah -->
    
        @else
            <!-- Tampilan Kosong yang Premium -->
            <div class="empty-state" style="max-width: 600px; margin: 100px auto; padding: 70px 50px; text-align: center; background: linear-gradient(135deg, rgba(255,245,240,0.95), rgba(255,240,232,0.95)); backdrop-filter: blur(10px); border-radius: 60px; box-shadow: 0 30px 60px rgba(0,0,0,0.1); border: 1px solid rgba(255,255,255,0.6);">
                <div style="font-size: 100px; margin-bottom: 25px; animation: floatEmpty 3s ease-in-out infinite;">🍰</div>
                <h2 style="font-size: 32px; color: #6d4c41; margin-bottom: 15px; font-weight: 900;">Menu Sedang Disiapkan</h2>
                <p style="font-size: 18px; color: #8d6e63; margin-bottom: 15px; line-height: 1.6;">Maaf, saat ini belum ada menu yang tersedia.</p>
                <p style="font-size: 15px; color: #a1887f; margin-bottom: 35px;">Silakan cek kembali nanti untuk menikmati berbagai pilihan manis dan gurih dari Sweet & Savory! ✨</p>
                <div style="display: flex; gap: 18px; justify-content: center; flex-wrap: wrap;">
                    <a href="{{ url('/') }}" style="display: inline-flex; align-items: center; gap: 10px; padding: 14px 32px; background: linear-gradient(135deg, #f06292, #ec407a); color: white; text-decoration: none; border-radius: 50px; font-weight: 800; transition: all 0.3s; box-shadow: 0 6px 20px rgba(240,98,146,0.4);">🏠 Kembali ke Beranda</a>
                    <a href="https://wa.me/6281234567890?text=Halo%20Dear%20Seana,%20saya%20ingin%20menanyakan%20informasi%20menu" target="_blank" style="display: inline-flex; align-items: center; gap: 10px; padding: 14px 32px; background: linear-gradient(135deg, #25D366, #128C7E); color: white; text-decoration: none; border-radius: 50px; font-weight: 800; transition: all 0.3s; box-shadow: 0 6px 20px rgba(37,211,102,0.4);">💬 Hubungi Kami</a>
                </div>
            </div>
        @endif
    </section>

    <!-- Modal Pilihan Pesanan dengan Metode Pembayaran untuk Pesan Sekarang -->
    <div id="orderModal" class="order-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.85); backdrop-filter: blur(15px); z-index: 1000; align-items: center; justify-content: center;">
        <div class="modal-content" style="background: linear-gradient(145deg, #FFF8F0, #FFF5EE); border-radius: 48px; max-width: 580px; width: 90%; max-height: 85vh; overflow-y: auto; box-shadow: 0 35px 70px rgba(0,0,0,0.3);">
            <div class="modal-header" style="background: linear-gradient(135deg, #fce4ec, #f8bbd0); padding: 28px; border-radius: 48px 48px 0 0; position: sticky; top: 0; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
                <h3 id="modalTitle" style="color: #6d4c41; margin: 0; font-size: 26px; font-weight: 900;">Nama Produk</h3>
                <p id="modalDesc" style="color: #8d6e63; margin: 10px 0 0; font-size: 14px;">Deskripsi produk</p>
                <button class="modal-close" style="position: absolute; right: 28px; top: 24px; background: rgba(255,255,255,0.95); border: none; font-size: 28px; cursor: pointer; color: #6d4c41; width: 42px; height: 42px; border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: all 0.3s; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">&times;</button>
            </div>
            <div class="modal-body" style="padding: 28px;" id="modalBody">
                <!-- Dynamic options will be inserted here -->
            </div>
            
            <!-- SECTION METODE PEMBAYARAN TELAH DIHAPUS (DIGANTIKAN OLEH MIDTRANS) -->
            
            <div class="modal-footer" style="padding: 24px 28px 28px; border-top: 1px solid #f0e0d0; background: rgba(255,248,240,0.95); border-radius: 0 0 48px 48px;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <span style="font-weight: 800; color: #6d4c41; font-size: 18px;">Total Harga:</span>
                    <span id="modalTotalPrice" style="font-size: 32px; font-weight: 900; color: #f06292;">Rp 0</span>
                </div>
                <div style="display: flex; gap: 16px;">
                    <button id="cancelOrderBtn" style="flex: 1; padding: 16px; border-radius: 60px; border: 2px solid #f0c0d0; background: white; color: #f06292; font-weight: 800; cursor: pointer; transition: all 0.3s;">Batal</button>
                    <button id="confirmOrderBtn" style="flex: 1; padding: 16px; border-radius: 60px; border: none; background: linear-gradient(135deg, #25D366, #128C7E); color: white; font-weight: 800; cursor: pointer; transition: all 0.3s; box-shadow: 0 6px 20px rgba(37,211,102,0.35);">💬 Pesan Sekarang via WA</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Notification Premium -->
    <div id="toastNotification" style="position: fixed; bottom: 40px; left: 50%; transform: translateX(-50%) translateY(100px); background: linear-gradient(135deg, #1a1a1a, #2d2d2d); color: #ffebcd; padding: 16px 32px; border-radius: 80px; font-weight: 700; z-index: 1100; transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55); opacity: 0; pointer-events: none; white-space: nowrap; box-shadow: 0 10px 30px rgba(0,0,0,0.25); font-size: 14px; backdrop-filter: blur(8px);">
        ✨ Pesanan ditambahkan
    </div>

    <!-- Floating Cart Button Premium -->
    <div class="floating-cart" style="position: fixed; bottom: 30px; right: 30px; background: linear-gradient(135deg, #f06292, #ec407a); color: white; width: 70px; height: 70px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 30px; cursor: pointer; box-shadow: 0 12px 30px rgba(240,98,146,0.5); z-index: 1000; transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);">
        🛒 <span class="cart-badge" style="position: absolute; top: -8px; right: -8px; background: #ff5722; color: white; border-radius: 50%; width: 26px; height: 26px; font-size: 12px; display: none; align-items: center; justify-content: center; font-weight: bold; box-shadow: 0 2px 8px rgba(0,0,0,0.2); border: 2px solid white;">0</span>
    </div>

    <style>
        /* ========== ANIMATIONS ========== */
        @keyframes modalSlideIn {
            from { transform: translateY(-80px) scale(0.9); opacity: 0; }
            to { transform: translateY(0) scale(1); opacity: 1; }
        }
        
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-50px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(50px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-60px); }
            to { opacity: 1; transform: translateX(0); }
        }
        
        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(60px); }
            to { opacity: 1; transform: translateX(0); }
        }
        
        @keyframes bounceIn {
            0% { opacity: 0; transform: scale(0.3); }
            50% { opacity: 1; transform: scale(1.05); }
            70% { transform: scale(0.9); }
            100% { transform: scale(1); }
        }
        
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(5px); }
        }
        
        @keyframes rotateGlow {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        @keyframes particleFloat {
            0% { transform: translateY(100vh) translateX(-50px) rotate(0deg); opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { transform: translateY(-100px) translateX(50px) rotate(360deg); opacity: 0; }
        }
        
        @keyframes floatEmpty {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.12); }
        }
        
        @keyframes shimmer {
            0% { background-position: -1000px 0; }
            100% { background-position: 1000px 0; }
        }
        
        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Modal Animation */
        .modal-content { 
            animation: modalSlideIn 0.5s cubic-bezier(0.34, 1.2, 0.64, 1); 
        }
        
        /* Card Hover Effects */
        .menu-card { 
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: visible;
        }
        
        .menu-card:hover { 
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0 25px 50px rgba(240,98,146,0.25);
        }
        
        .menu-card:hover .card-glow {
            opacity: 1;
        }
        
        .menu-card:hover img {
            transform: scale(1.12);
        }
        
        .menu-card:hover > div:first-child > div:first-child {
            opacity: 1;
        }
        
        .menu-card:hover .quick-view {
            transform: translateX(-50%) translateY(0);
            opacity: 1;
        }
        
        /* Button Hover Effects */
        .btn-order-now:hover { 
            background: linear-gradient(135deg, #00897b, #00695c) !important; 
            color: white !important; 
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0,105,92,0.35) !important;
        }
        
        .btn-add-to-cart:hover { 
            background: linear-gradient(135deg, #f06292, #ec407a) !important; 
            color: white !important; 
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(240,98,146,0.35) !important;
        }
        
        /* Category Tab Hover */
        .category-tab:hover { 
            background: linear-gradient(135deg, #f06292, #ec407a) !important;
            color: white !important;
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(240,98,146,0.4);
        }
        
        /* Radio Option Hover */
        .radio-option:hover { 
            background: linear-gradient(135deg, #fce4ec, #f8bbd0);
            transform: translateX(8px);
            border-color: #f06292 !important;
        }
        
        /* Floating Cart Hover */
        .floating-cart:hover { 
            transform: scale(1.12) rotate(5deg);
            box-shadow: 0 15px 40px rgba(240,98,146,0.6);
        }
        
        .floating-cart:active {
            transform: scale(0.95);
        }
        
        /* Cart Badge Pulse */
        .cart-badge {
            animation: pulse 1.5s ease-in-out infinite;
        }
        
        /* Payment Option Hover */
        .payment-option:hover { 
            border-color: #f06292 !important;
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(240,98,146,0.2);
        }
        
        /* Modal Close Button Hover */
        .modal-close:hover {
            background: #f06292 !important;
            color: white !important;
            transform: rotate(90deg);
        }
        
        /* Cancel Button Hover */
        #cancelOrderBtn:hover {
            background: #f06292 !important;
            color: white !important;
            border-color: #f06292 !important;
            transform: translateY(-2px);
        }
        
        /* Confirm Button Hover */
        #confirmOrderBtn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(37,211,102,0.5);
        }
        
        /* Checkout Button Hover */
        #checkoutCartBtn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(37,211,102,0.5);
        }
        
        /* Scroll Indicator Hover */
        .scroll-indicator:hover {
            background: rgba(255,255,255,0.5);
            transform: translateY(5px);
        }
        
        /* Clear Cart Button Hover */
        #clearCartBtn:hover {
            background: #e57373 !important;
            color: white !important;
            border-color: #e57373 !important;
            transform: translateY(-2px);
        }
        
        /* Quantity Buttons Hover */
        .cart-qty-minus:hover, .cart-qty-plus:hover {
            background: #f06292 !important;
            color: white !important;
            transform: scale(1.1);
        }
        
        /* Remove Button Hover */
        .cart-remove:hover {
            transform: scale(1.2);
            color: #ff5722 !important;
        }
        
        /* Preview gambar varian */
        .variant-preview {
            text-align: center;
            margin-bottom: 28px;
            padding: 20px;
            background: linear-gradient(135deg, #fff5f0, #ffe8f0);
            border-radius: 32px;
            animation: floatEmpty 3s ease-in-out infinite;
        }
        
        .variant-preview img {
            width: 140px;
            height: 140px;
            object-fit: cover;
            border-radius: 25px;
            box-shadow: 0 12px 25px rgba(0,0,0,0.12);
            transition: all 0.4s ease;
        }
        
        .variant-preview img:hover {
            transform: scale(1.08);
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        }
        
        .variant-preview p {
            margin-top: 14px;
            font-size: 14px;
            color: #f06292;
            font-weight: 700;
        }
        
        /* Particle positions */
        .particle:nth-child(1) { left: 10%; top: -20px; animation-duration: 18s; width: 8px; height: 8px; }
        .particle:nth-child(2) { left: 25%; top: -30px; animation-duration: 22s; width: 12px; height: 12px; }
        .particle:nth-child(3) { left: 50%; top: -15px; animation-duration: 14s; width: 6px; height: 6px; }
        .particle:nth-child(4) { left: 75%; top: -25px; animation-duration: 20s; width: 10px; height: 10px; }
        .particle:nth-child(5) { left: 90%; top: -10px; animation-duration: 25s; width: 14px; height: 14px; }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }
        
        ::-webkit-scrollbar-track {
            background: linear-gradient(135deg, #fce4ec, #f8bbd0);
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #f06292, #ec407a);
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #ec407a, #d81b60);
        }
        
        /* Smooth Scroll */
        html { 
            scroll-behavior: smooth; 
        }
        
        /* Glassmorphism untuk card */
        .menu-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(8px);
        }
        
        /* Responsive Design */
        @media (max-width: 1200px) { 
            .menu-grid { grid-template-columns: repeat(4, 1fr) !important; gap: 24px !important; } 
            h1 { font-size: 52px !important; }
        }
        @media (max-width: 992px) { 
            .menu-grid { grid-template-columns: repeat(3, 1fr) !important; gap: 20px !important; } 
            h1 { font-size: 44px !important; }
            h2 { font-size: 34px !important; }
        }
        @media (max-width: 768px) { 
            .menu-grid { grid-template-columns: repeat(2, 1fr) !important; gap: 18px !important; }
            h1 { font-size: 36px !important; }
            h2 { font-size: 28px !important; }
            .category-tab { padding: 12px 24px !important; font-size: 14px !important; }
            .payment-option { min-width: 90px !important; padding: 10px !important; }
            .payment-icon { font-size: 24px !important; }
        }
        @media (max-width: 480px) { 
            .menu-grid { grid-template-columns: 1fr !important; }
            .menu-card { max-width: 350px; margin: 0 auto; }
            .floating-cart { width: 55px; height: 55px; font-size: 24px; bottom: 20px; right: 20px; }
            .modal-footer #modalTotalPrice { font-size: 24px !important; }
        }
        
        /* Loading shimmer effect untuk gambar */
        .menu-card img {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 1000px 100%;
            animation: shimmer 1.5s infinite;
        }
    </style>

    <script>
        // Nomor WhatsApp tujuan
        const WA_PHONE_NUMBER = '{{ $global_setting->wa_number ?? "6281234567890" }}';
        
        // Nomor rekening dan payment info
        const PAYMENT_INFO = {
            bank: {
                name: '{{ $global_setting->bank_name ?? "Bank BCA" }}',
                accountNumber: '{{ $global_setting->bank_account ?? "1234567890" }}',
                accountName: '{{ $global_setting->bank_owner ?? "Sweet & Savory Seana" }}'
            },
            dana: {
                number: '{{ $global_setting->dana_number ?? "081234567890" }}',
                name: '{{ $global_setting->dana_owner ?? "Sweet & Savory" }}'
            },
            gopay: {
                number: '{{ $global_setting->gopay_number ?? "081234567890" }}',
                name: '{{ $global_setting->gopay_owner ?? "Sweet & Savory" }}'
            }
        };
        
        // Cart array to store items
        let cart = [];
        let selectedPaymentMethod = 'bank';
        
        document.addEventListener('DOMContentLoaded', function() {
            // ========== ANCHOR NAVIGATION DARI HOME ==========
// Ambil anchor dari URL (misal #birthday-cake atau #cookies)
const hash = window.location.hash;
if (hash === '#birthday-cake' || hash === '#cookies') {
    setTimeout(function() {
        const targetSection = document.querySelector(hash);
        if (targetSection) {
            // Scroll ke section
            targetSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
            
            // Ubah tampilan tab yang aktif
            const tabs = document.querySelectorAll('.category-tab');
            tabs.forEach(tab => {
                if (tab.getAttribute('href') === hash) {
                    tab.style.background = 'linear-gradient(135deg, #f06292, #ec407a)';
                    tab.style.color = 'white';
                    tab.style.transform = 'scale(1.05)';
                    tab.style.boxShadow = '0 8px 25px rgba(240,98,146,0.4)';
                } else {
                    tab.style.background = 'rgba(255,245,240,0.9)';
                    tab.style.color = '#6d4c41';
                    tab.style.transform = 'scale(1)';
                    tab.style.boxShadow = '0 8px 20px rgba(0,0,0,0.08)';
                }
            });
        }
    }, 500);
}
            
            // Active tab on scroll dengan highlight efek
            const sections = document.querySelectorAll('section[id]');
            const tabs = document.querySelectorAll('.category-tab');
            
            function updateActiveTab() {
                let current = '';
                const scrollPosition = window.scrollY + 150;
                
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
                        tab.style.background = 'linear-gradient(135deg, #f06292, #ec407a)';
                        tab.style.color = 'white';
                        tab.style.boxShadow = '0 8px 25px rgba(240,98,146,0.4)';
                        tab.style.transform = 'scale(1.05)';
                    } else {
                        tab.style.background = 'rgba(255,245,240,0.9)';
                        tab.style.color = '#6d4c41';
                        tab.style.boxShadow = '0 8px 20px rgba(0,0,0,0.08)';
                        tab.style.transform = 'scale(1)';
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
                showToastMessage('🛒 Ditambahkan ke keranjang! ✨');
                updateCartBadge();
                animateCart();
            }
            
            function animateCart() {
                const cart = document.querySelector('.floating-cart');
                if (cart) {
                    cart.style.transform = 'scale(1.2)';
                    setTimeout(() => {
                        cart.style.transform = 'scale(1)';
                    }, 200);
                }
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
            
            let savedCustName = {!! json_encode(auth()->check() ? auth()->user()->name : '') !!};
            let savedCustPhone = {!! json_encode(auth()->check() ? auth()->user()->no_wa : '') !!};
            let savedCustAddress = {!! json_encode(auth()->check() ? auth()->user()->alamat : '') !!};

            function showCartModal() {
                if (cart.length === 0) {
                    showToastMessage('✨ Keranjang belanja masih kosong');
                    return;
                }
                
                // Preserve inputs if they exist
                const custNameInput = document.getElementById('custName');
                if (custNameInput) savedCustName = custNameInput.value;
                const custPhoneInput = document.getElementById('custPhone');
                if (custPhoneInput) savedCustPhone = custPhoneInput.value;
                const custAddressInput = document.getElementById('custAddress');
                if (custAddressInput) savedCustAddress = custAddressInput.value;
                
                let grandTotal = 0;
                let cartHtml = `
                    <div id="cartModal" class="order-modal" style="display: flex; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.85); backdrop-filter: blur(15px); z-index: 1001; align-items: center; justify-content: center;">
                        <div class="modal-content" style="background: linear-gradient(145deg, #FFF8F0, #FFF5EE); border-radius: 48px; max-width: 680px; width: 90%; max-height: 85vh; overflow-y: auto; box-shadow: 0 35px 70px rgba(0,0,0,0.3);">
                            <div class="modal-header" style="background: linear-gradient(135deg, #fce4ec, #f8bbd0); padding: 28px; border-radius: 48px 48px 0 0; position: sticky; top: 0;">
                                <h3 style="color: #6d4c41; margin: 0; font-size: 26px; font-weight: 900;">🛒 Keranjang Belanja</h3>
                                <button class="cart-modal-close" style="position: absolute; right: 28px; top: 24px; background: rgba(255,255,255,0.95); border: none; font-size: 28px; cursor: pointer; color: #6d4c41; width: 42px; height: 42px; border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: all 0.3s;">&times;</button>
                            </div>
                            <div class="modal-body" style="padding: 28px;" id="cartModalBody">
                `;
                
                cart.forEach((item, index) => {
                    const itemTotal = item.total_price;
                    grandTotal += itemTotal;
                    let selectionsText = '';
                    for (const [key, value] of Object.entries(item.selections)) {
                        selectionsText += `<span style="display: inline-block; background: #fce4ec; padding: 5px 14px; border-radius: 25px; font-size: 12px; margin-right: 8px; margin-bottom: 8px; color: #6d4c41; font-weight: 700;">${key}: ${value}</span>`;
                    }
                    cartHtml += `
                        <div style="display: flex; align-items: center; gap: 16px; padding: 18px; border-bottom: 1px solid #ffe0d0; margin-bottom: 15px; background: white; border-radius: 28px; transition: all 0.3s;">
                            <div style="flex: 1;">
                                <div style="font-weight: 900; color: #6d4c41; font-size: 17px;">${item.name}</div>
                                <div style="font-size: 12px; margin-top: 10px;">${selectionsText}</div>
                                <div style="font-size: 14px; color: #f06292; margin-top: 10px; font-weight: 800;">${formatRupiah(item.base_price)} × ${item.quantity} = ${formatRupiah(itemTotal)}</div>
                            </div>
                            <div style="display: flex; gap: 12px;">
                                <button class="cart-qty-minus" data-index="${index}" style="width: 36px; height: 36px; border-radius: 50%; border: 1px solid #f0c0d0; background: white; color: #f06292; cursor: pointer; font-weight: bold; transition: all 0.2s;">−</button>
                                <span style="min-width: 40px; text-align: center; font-weight: 800; color: #6d4c41; font-size: 16px;">${item.quantity}</span>
                                <button class="cart-qty-plus" data-index="${index}" style="width: 36px; height: 36px; border-radius: 50%; border: 1px solid #f0c0d0; background: white; color: #f06292; cursor: pointer; font-weight: bold; transition: all 0.2s;">+</button>
                                <button class="cart-remove" data-index="${index}" style="background: none; border: none; color: #e57373; cursor: pointer; font-size: 22px; transition: all 0.2s;">🗑️</button>
                            </div>
                        </div>
                    `;
                });
                
                cartHtml += `
                            </div>
                            <div class="customer-details" style="margin: 0 24px 24px 24px; padding: 22px; background: white; border-radius: 32px; border: 1px solid #ffe0d0;">
                                <div style="font-weight: 800; color: #6d4c41; margin-bottom: 16px; font-size: 16px; display: flex; align-items: center; gap: 10px;">
                                    <span>👤</span> Informasi Pengiriman
                                </div>
                                <div style="display: flex; flex-direction: column; gap: 12px;">
                                    <input type="text" id="custName" value="${savedCustName}" placeholder="Nama Lengkap" style="padding: 12px 16px; border-radius: 12px; border: 1px solid #f0d0d0; outline: none; font-family: inherit;">
                                    <input type="text" id="custPhone" value="${savedCustPhone}" placeholder="Nomor WhatsApp (Contoh: 0812...)" style="padding: 12px 16px; border-radius: 12px; border: 1px solid #f0d0d0; outline: none; font-family: inherit;">
                                    <textarea id="custAddress" placeholder="Alamat Pengiriman Lengkap" rows="3" style="padding: 12px 16px; border-radius: 12px; border: 1px solid #f0d0d0; outline: none; font-family: inherit; resize: none;">${savedCustAddress}</textarea>
                                </div>
                            </div>
                            <div class="modal-footer" style="padding: 24px 28px 28px; border-top: 1px solid #ffe0d0; background: rgba(255,248,240,0.95); border-radius: 0 0 48px 48px;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                                    <span style="font-weight: 800; color: #6d4c41; font-size: 18px;">Total Belanja:</span>
                                    <span style="font-size: 32px; font-weight: 900; color: #f06292;">${formatRupiah(grandTotal)}</span>
                                </div>
                                <div style="display: flex; gap: 16px;">
                                    <button id="clearCartBtn" style="flex: 1; padding: 16px; border-radius: 60px; border: 2px solid #f0c0d0; background: white; color: #e57373; font-weight: 800; cursor: pointer; transition: all 0.3s;">Kosongkan</button>
                                    <button id="checkoutCartBtn" style="flex: 1; padding: 16px; border-radius: 60px; border: none; background: linear-gradient(135deg, #25D366, #128C7E); color: white; font-weight: 800; cursor: pointer; transition: all 0.3s; box-shadow: 0 6px 20px rgba(37,211,102,0.35);">📱 Proses Pesanan</button>
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
                
                // Metode pembayaran manual telah dihapus, jadi tidak ada listener yang ditambahkan
                
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
                    showToastMessage('🗑️ Keranjang telah dikosongkan');
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
                                showToastMessage('✨ Keranjang kosong');
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
                            showToastMessage('✨ Keranjang kosong');
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
            
            function getPaymentMethodText(method) {
                switch(method) {
                    case 'bank': return '🏦 Transfer Bank';
                    case 'dana': return '💙 DANA';
                    case 'gopay': return '💚 GoPay';
                    default: return '🏦 Transfer Bank';
                }
            }
            
            function getPaymentDetailsText(method) {
                switch(method) {
                    case 'bank':
                        return `${PAYMENT_INFO.bank.name} - ${PAYMENT_INFO.bank.accountNumber} a.n. ${PAYMENT_INFO.bank.accountName}`;
                    case 'dana':
                        return `DANA - ${PAYMENT_INFO.dana.number} a.n. ${PAYMENT_INFO.dana.name}`;
                    case 'gopay':
                        return `GoPay - ${PAYMENT_INFO.gopay.number} a.n. ${PAYMENT_INFO.gopay.name}`;
                    default:
                        return `${PAYMENT_INFO.bank.name} - ${PAYMENT_INFO.bank.accountNumber} a.n. ${PAYMENT_INFO.bank.accountName}`;
                }
            }
            
            async function sendCartToWhatsAppWithPayment() {
                if (cart.length === 0) {
                    showToastMessage('Keranjang kosong');
                    return;
                }
                
                const custNameInput = document.getElementById('custName');
                const custPhoneInput = document.getElementById('custPhone');
                const custAddressInput = document.getElementById('custAddress');
                
                if (!custNameInput || !custNameInput.value.trim()) {
                    alert('Mohon isi Nama Lengkap Anda.');
                    return;
                }
                if (!custPhoneInput || !custPhoneInput.value.trim()) {
                    alert('Mohon isi Nomor WhatsApp Anda.');
                    return;
                }
                if (!custAddressInput || !custAddressInput.value.trim()) {
                    alert('Mohon isi Alamat Pengiriman Anda.');
                    return;
                }
                
                const namaPelanggan = custNameInput.value.trim();
                const noWaPelanggan = custPhoneInput.value.trim();
                const alamatPelanggan = custAddressInput.value.trim();
                
                let grandTotal = 0;
                cart.forEach((item) => grandTotal += item.total_price);
                
                const payload = {
                    nama_pelanggan: namaPelanggan,
                    no_wa: noWaPelanggan,
                    alamat: alamatPelanggan,
                    metode_pembayaran: selectedPaymentMethod,
                    items: JSON.stringify(cart),
                    total_harga: grandTotal
                };
                
                try {
                    const response = await fetch("{{ route('user.checkout') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify(payload)
                    });
                    
                    const result = await response.json();
                    if (!result.success) {
                        alert("Gagal memproses pesanan ke database: " + result.message);
                        return;
                    }

                    // Menjalankan Snap Midtrans
                    window.snap.pay(result.snap_token, {
                        onSuccess: function(snapResult){
                            fetch('{{ route("user.checkout.success_local") }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                },
                                body: JSON.stringify({ snap_token: result.snap_token })
                            }).then(() => {
                                showToastMessage('✅ Pembayaran berhasil diproses!');
                                // Kosongkan keranjang
                                cart = [];
                                localStorage.removeItem('sweetSavoryCart');
                                savedCustName = '';
                                savedCustPhone = '';
                                savedCustAddress = '';
                                updateCartBadge();
                                setTimeout(() => window.location.href = "{{ route('pesanan_saya') }}", 2000);
                            });
                        },
                        onPending: function(snapResult){
                            showToastMessage('⏳ Silakan selesaikan pembayaran Anda.');
                            // Kosongkan keranjang
                            cart = [];
                            localStorage.removeItem('sweetSavoryCart');
                            savedCustName = '';
                            savedCustPhone = '';
                            savedCustAddress = '';
                            updateCartBadge();
                        },
                        onError: function(snapResult){
                            alert("Pembayaran gagal! Silakan coba lagi.");
                        },
                        onClose: function(){
                            showToastMessage('⚠️ Anda menutup popup pembayaran.');
                        }
                    });
                    
                } catch(e) {
                    alert("Terjadi kesalahan jaringan saat menyimpan pesanan.");
                    return;
                }
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
            
            function updateOrderPaymentDetails(method) {
                const paymentDetailsDiv = document.getElementById('paymentDetails');
                if (!paymentDetailsDiv) return;
                
                if (method === 'bank') {
                    paymentDetailsDiv.innerHTML = `
                        <p>📋 Transfer ke rekening berikut:</p>
                        <p class="bank-account" style="font-family: monospace; font-size: 15px; font-weight: bold; color: #f06292;">🏦 ${PAYMENT_INFO.bank.name}</p>
                        <p class="bank-account" style="font-family: monospace; font-size: 15px; font-weight: bold; color: #f06292;">🔢 ${PAYMENT_INFO.bank.accountNumber}</p>
                        <p class="bank-account" style="font-family: monospace; font-size: 15px; font-weight: bold; color: #f06292;">👤 a.n. ${PAYMENT_INFO.bank.accountName}</p>
                        <p style="margin-top: 10px; font-size: 11px; color: #999;">⚠️ Konfirmasi pembayaran via WhatsApp setelah transfer</p>
                    `;
                } else if (method === 'dana') {
                    paymentDetailsDiv.innerHTML = `
                        <p>📱 Kirim ke nomor DANA:</p>
                        <p class="bank-account" style="font-family: monospace; font-size: 15px; font-weight: bold; color: #f06292;">💙 ${PAYMENT_INFO.dana.number}</p>
                        <p class="bank-account" style="font-family: monospace; font-size: 15px; font-weight: bold; color: #f06292;">👤 a.n. ${PAYMENT_INFO.dana.name}</p>
                        <p style="margin-top: 10px; font-size: 11px; color: #999;">⚠️ Konfirmasi pembayaran via WhatsApp setelah transfer</p>
                    `;
                } else if (method === 'gopay') {
                    paymentDetailsDiv.innerHTML = `
                        <p>📱 Kirim ke nomor GoPay:</p>
                        <p class="bank-account" style="font-family: monospace; font-size: 15px; font-weight: bold; color: #f06292;">💚 ${PAYMENT_INFO.gopay.number}</p>
                        <p class="bank-account" style="font-family: monospace; font-size: 15px; font-weight: bold; color: #f06292;">👤 a.n. ${PAYMENT_INFO.gopay.name}</p>
                        <p style="margin-top: 10px; font-size: 11px; color: #999;">⚠️ Konfirmasi pembayaran via WhatsApp setelah transfer</p>
                    `;
                }
            }
            
            function initOrderPaymentHandlers() {
                const paymentOptions = document.querySelectorAll('#paymentOptions .payment-option');
                paymentOptions.forEach(option => {
                    option.removeEventListener('click', () => {});
                    option.addEventListener('click', () => {
                        const paymentMethod = option.dataset.payment;
                        selectedPaymentMethod = paymentMethod;
                        paymentOptions.forEach(opt => {
                            opt.style.borderColor = '#f0d0d0';
                            opt.style.background = 'white';
                        });
                        option.style.borderColor = '#f06292';
                        option.style.background = '#fce4ec';
                        updateOrderPaymentDetails(paymentMethod);
                    });
                });
            }
            
            function buildModalContent(product, actionType = 'order') {
                currentProduct = product;
                currentSelections = {};
                currentQuantity = 1;
                currentAction = actionType;
                
                modalTitle.textContent = product.nama_produk;
                modalDesc.textContent = product.deskripsi || 'Nikmati kelezatan produk ini';
                
                if (actionType === 'order') {
                    confirmBtn.innerHTML = '💬 Pesan Sekarang via WA';
                } else {
                    confirmBtn.innerHTML = '🛒 Tambah ke Keranjang';
                }
                
                let html = '';
                
                if (product.variant_images && Object.keys(product.variant_images).length > 0) {
                    const defaultVariant = product.options && product.options[0] ? product.options[0].choices[0] : Object.keys(product.variant_images)[0];
                    const defaultImage = getVariantImage(defaultVariant);
                    html += `
                        <div class="variant-preview" id="variantPreviewContainer">
                            <img src="${defaultImage}" alt="Preview Varian" style="width: 140px; height: 140px; object-fit: cover; border-radius: 25px;">
                            <p>🍫 ${defaultVariant}</p>
                        </div>
                    `;
                }
                
                if (product.options && product.options.length > 0) {
                    for (let opt of product.options) {
                        if (opt.type === 'radio' && opt.choices && opt.choices.length > 0) {
                            currentSelections[opt.key] = opt.choices[0];
                            html += `
                                <div class="option-group" style="margin-bottom: 28px;">
                                    <label style="font-weight: 900; display: block; margin-bottom: 16px; color: #6d4c41; border-left: 5px solid #f06292; padding-left: 16px; font-size: 16px;">${opt.label}</label>
                                    <div class="radio-group" data-key="${opt.key}" style="display: flex; flex-direction: column; gap: 14px;">
                            `;
                            for (let choice of opt.choices) {
                                const isChecked = (currentSelections[opt.key] === choice);
                                let choiceImage = '';
                                if (opt.key === 'variant' && product.variant_images && product.variant_images[choice]) {
                                    choiceImage = getVariantImage(choice);
                                }
                                html += `
                                    <div class="radio-option" data-choice="${choice}" data-key="${opt.key}" style="display: flex; align-items: center; gap: 14px; padding: 14px 20px; background: ${isChecked ? 'linear-gradient(135deg, #fce4ec, #f8bbd0)' : '#fff'}; border: 2px solid ${isChecked ? '#f06292' : '#f0d0d0'}; border-radius: 50px; cursor: pointer; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);">
                                        ${choiceImage ? `<img src="${choiceImage}" style="width: 45px; height: 45px; object-fit: cover; border-radius: 15px;">` : ''}
                                        <input type="radio" name="${opt.key}" value="${choice.replace(/"/g, '&quot;')}" id="${opt.key}_${choice.replace(/[^a-zA-Z0-9]/g, '_')}" ${isChecked ? 'checked' : ''} style="accent-color: #f06292; width: 18px; height: 18px;">
                                        <label for="${opt.key}_${choice.replace(/[^a-zA-Z0-9]/g, '_')}" style="flex: 1; cursor: pointer; color: #6d4c41; font-weight: 700;">${choice}</label>
                                    </div>
                                `;
                            }
                            html += `</div></div>`;
                        }
                    }
                } else {
                    html += `<p style="text-align: center; color: #8d6e63; padding: 30px;">✨ Tidak ada pilihan tambahan untuk produk ini.</p>`;
                }
                
                html += `
                    <div class="option-group" style="margin-bottom: 28px;">
                        <label style="font-weight: 900; display: block; margin-bottom: 16px; color: #6d4c41; border-left: 5px solid #f06292; padding-left: 16px; font-size: 16px;">📦 Jumlah Pesanan</label>
                        <div style="display: flex; align-items: center; gap: 18px; background: #fff; padding: 12px 22px; border-radius: 60px; border: 2px solid #f0d0d0; width: fit-content;">
                            <button type="button" id="qtyMinus" style="width: 46px; height: 46px; border-radius: 50%; border: none; background: linear-gradient(135deg, #fce4ec, #f8bbd0); color: #f06292; font-size: 26px; font-weight: bold; cursor: pointer; transition: all 0.2s;">−</button>
                            <span id="qtyValue" style="font-size: 26px; font-weight: 900; min-width: 60px; text-align: center; color: #6d4c41;">1</span>
                            <button type="button" id="qtyPlus" style="width: 46px; height: 46px; border-radius: 50%; border: none; background: linear-gradient(135deg, #fce4ec, #f8bbd0); color: #f06292; font-size: 26px; font-weight: bold; cursor: pointer; transition: all 0.2s;">+</button>
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
                                                    optDiv.style.background = 'linear-gradient(135deg, #fce4ec, #f8bbd0)';
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
                    setTimeout(initOrderPaymentHandlers, 50);
                }
            }
            
            function closeModal() {
                modal.style.display = 'none';
                document.body.style.overflow = '';
                currentProduct = null;
                currentSelections = {};
                currentQuantity = 1;
            }
            
            async function sendToWhatsAppWithPayment() {
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
                
                // Pura-pura nama dan alamat karena modal Pesan Sekarang tidak minta input nama
                // Idealnya kita minta input nama di modal Pesan Sekarang juga, tapi untuk saat ini:
                const custNameInput = document.getElementById('custName') ? document.getElementById('custName').value : (savedCustName || 'Pelanggan');
                const custPhoneInput = document.getElementById('custPhone') ? document.getElementById('custPhone').value : (savedCustPhone || '080000000000');
                const custAddressInput = document.getElementById('custAddress') ? document.getElementById('custAddress').value : (savedCustAddress || '-');
                
                // Buat item format yang sesuai dengan cart
                const singleItem = [{
                    id: currentProduct.id,
                    name: currentProduct.nama_produk,
                    quantity: currentQuantity,
                    price: currentProduct.harga,
                    total_price: total,
                    selections: currentSelections
                }];

                const payload = {
                    nama_pelanggan: custNameInput || 'Pelanggan',
                    no_wa: custPhoneInput || '08000000000',
                    alamat: custAddressInput || '-',
                    metode_pembayaran: selectedPaymentMethod || 'bank',
                    items: JSON.stringify(singleItem),
                    total_harga: total
                };
                
                try {
                    const response = await fetch("{{ route('user.checkout') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify(payload)
                    });
                    
                    const result = await response.json();
                    if (!result.success) {
                        alert("Gagal memproses pesanan ke database: " + result.message);
                        return;
                    }

                    closeModal(); // tutup modal produk

                    // Menjalankan Snap Midtrans
                    window.snap.pay(result.snap_token, {
                        onSuccess: function(snapResult){
                            showToastMessage('✅ Pembayaran berhasil diproses!');
                        },
                        onPending: function(snapResult){
                            showToastMessage('⏳ Silakan selesaikan pembayaran Anda.');
                        },
                        onError: function(snapResult){
                            alert("Pembayaran gagal! Silakan coba lagi.");
                        },
                        onClose: function(){
                            showToastMessage('⚠️ Anda menutup popup pembayaran.');
                        }
                    });
                    
                } catch(e) {
                    alert("Terjadi kesalahan jaringan saat menyimpan pesanan.");
                    return;
                }
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