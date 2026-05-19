@extends('user.layouts.app')

@section('content')
    <!-- Breadcrumb Navigation -->
    <div class="breadcrumb-container" style="background: #fff8f5; padding: 20px 25px; border-bottom: 1px solid #fce4ec; font-family: 'Outfit', sans-serif;">
        <div style="max-width: 1400px; margin: 0 auto; display: flex; align-items: center; gap: 8px; font-size: 14px; color: #8d6e63; font-weight: 600;">
            <a href="{{ route('beranda') }}" style="color: #6d4c41; text-decoration: none; transition: color 0.2s;">Home</a>
            <span>/</span>
            <a href="{{ route('menu') }}" style="color: #6d4c41; text-decoration: none; transition: color 0.2s;">Menu</a>
            <span>/</span>
            <span style="color: #f06292; font-weight: 800;">{{ $produk->nama_produk }}</span>
        </div>
    </div>

    @php
        // Gambar fallback yang premium
        if($produk->gambar && !str_starts_with($produk->gambar, 'http')) {
            if (str_starts_with($produk->gambar, 'Kue/') || str_starts_with($produk->gambar, 'Cookies/')) {
                $imageUrl = asset('assets/img_produk/' . ltrim($produk->gambar, '/'));
            } else {
                $imageUrl = asset('storage/' . $produk->gambar);
            }
        } elseif($produk->gambar && str_starts_with($produk->gambar, 'http')) {
            $imageUrl = $produk->gambar;
        } else {
            $imageUrl = 'https://picsum.photos/seed/' . $produk->id . '/600/400';
        }

        // Definisikan opsi tambahan dinamis berdasarkan kategori/nama produk
        $options = [];
        $isCake = false;
        $kategoriNama = strtolower($produk->kategori->nama_kategori ?? '');
        $produkNama = strtolower($produk->nama_produk ?? '');
        
        if (str_contains($kategoriNama, 'cake') || str_contains($kategoriNama, 'ulang tahun') || str_contains($produkNama, 'cake') || str_contains($produkNama, 'tart')) {
            $isCake = true;
        }

        if ($isCake) {
            $options = [
                [
                    'key' => 'ukuran',
                    'label' => 'Pilih Ukuran Kue',
                    'type' => 'radio',
                    'choices' => ['Personal Size 10cm (+0k)', 'Medium Size 16cm (+50k)', 'Family Size 22cm (+120k)']
                ],
                [
                    'key' => 'lilin_kartu',
                    'label' => 'Lilin & Kartu Ucapan',
                    'type' => 'radio',
                    'choices' => ['Tanpa Lilin & Kartu (+0k)', 'Lilin Batang & Kartu (+5k)', 'Lilin Angka & Kartu Ucapan (+10k)']
                ]
            ];
        } else {
            $options = [
                [
                    'key' => 'varian',
                    'label' => 'Pilih Varian Rasa',
                    'type' => 'radio',
                    'choices' => ['Original Sweet (+0k)', 'Double Choco Premium (+15k)', 'Matcha Velvet Cream (+20k)']
                ],
                [
                    'key' => 'kemasan',
                    'label' => 'Pilih Kemasan',
                    'type' => 'radio',
                    'choices' => ['Kemasan Box Premium (+0k)', 'Kemasan Hampers Keranjang (+45k)']
                ]
            ];
        }

        // Gambar Varian Mock untuk galeri visual premium
        $variantImages = [];
        if ($isCake) {
            $variantImages = [
                'Personal Size 10cm (+0k)' => $imageUrl,
                'Medium Size 16cm (+50k)' => 'https://images.unsplash.com/photo-1578985545062-69928b1d9587?auto=format&fit=crop&q=80&w=400',
                'Family Size 22cm (+120k)' => 'https://images.unsplash.com/photo-1535141192574-5d4897c13636?auto=format&fit=crop&q=80&w=400'
            ];
        } else {
            $variantImages = [
                'Original Sweet (+0k)' => $imageUrl,
                'Double Choco Premium (+15k)' => 'https://images.unsplash.com/photo-1558961363-fa8fdf82db35?auto=format&fit=crop&q=80&w=400',
                'Matcha Velvet Cream (+20k)' => 'https://images.unsplash.com/photo-1582278619435-75b79e25b118?auto=format&fit=crop&q=80&w=400'
            ];
        }

        // Siapkan ulasan untuk ditampilkan
        $displayReviews = $reviews;
        $actualReviewCount = $reviews->count();
        
        if ($displayReviews->isEmpty()) {
            // Mock reviews agar halaman terlihat sangat premium & lengkap pada fase development
            $displayReviews = collect([
                (object)[
                    'id' => 101,
                    'rating' => 5,
                    'ulasan' => 'Luar biasa enak! Coklatnya sangat pekat, manisnya pas dan tidak bikin enek. Tekstur kuenya sangat lembut layaknya kapas. Sangat direkomendasikan untuk acara ulang tahun maupun camilan keluarga. Pengiriman juga super cepat dan aman sampai tujuan. Terima kasih Dear Seana! 🎂✨',
                    'created_at' => now()->subDays(2),
                    'user' => (object)['name' => 'Aditya Wijaya'],
                    'selections' => $isCake ? ['ukuran' => 'Medium Size 16cm (+50k)', 'lilin_kartu' => 'Lilin Angka & Kartu Ucapan (+10k)'] : ['varian' => 'Double Choco Premium (+15k)']
                ],
                (object)[
                    'id' => 102,
                    'rating' => 5,
                    'ulasan' => 'Rasanya benar-benar premium, tidak kalah dengan toko kue bintang lima. Beli yang ukuran sedang untuk merayakan anniversary bersama suami, kami berdua sangat menyukainya. Kemasan boxnya tebal, mewah, dan kokoh. Sukses selalu, pasti langganan!',
                    'created_at' => now()->subDays(5),
                    'user' => (object)['name' => 'Siti Rahmawati'],
                    'selections' => $isCake ? ['ukuran' => 'Medium Size 16cm (+50k)'] : ['varian' => 'Original Sweet (+0k)', 'kemasan' => 'Kemasan Box Premium (+0k)']
                ],
                (object)[
                    'id' => 103,
                    'rating' => 4,
                    'ulasan' => 'Kualitas rasa bahan premiumnya terasa sekali. Tingkat manisnya pas sekali di lidah. Hanya kemarin kurirnya terlambat sekitar 10 menit karena hujan deras, tapi kue tetap sampai dengan bentuk sempurna karena packing super aman dengan wrap dobel.',
                    'created_at' => now()->subWeeks(1),
                    'user' => (object)['name' => 'Budi Santoso'],
                    'selections' => $isCake ? ['ukuran' => 'Personal Size 10cm (+0k)'] : ['varian' => 'Original Sweet (+0k)']
                ]
            ]);
            $averageRating = 4.7;
            $reviewCount = 3;
        }
    @endphp

    <!-- Main Detail Container -->
    <div style="max-width: 1400px; margin: 40px auto; padding: 0 25px; font-family: 'Outfit', sans-serif;">
        <div class="product-layout" style="display: grid; grid-template-columns: 1.1fr 1fr; gap: 50px; background: rgba(255, 255, 255, 0.95); border-radius: 40px; padding: 40px; box-shadow: 0 25px 60px rgba(0,0,0,0.05); border: 1px solid rgba(255,255,255,0.7);">
            
            <!-- Left Column: Product Gallery -->
            <div class="gallery-column">
                <div class="main-image-container" style="position: relative; overflow: hidden; border-radius: 30px; background: linear-gradient(135deg, #fce4ec, #f8bbd0); box-shadow: 0 15px 35px rgba(0,0,0,0.06); height: 480px; display: flex; align-items: center; justify-content: center; border: 1px solid rgba(0,0,0,0.05);">
                    <img id="mainProductImage" src="{{ $imageUrl }}" alt="{{ $produk->nama_produk }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;">
                    <div class="best-seller-badge" style="position: absolute; top: 25px; left: 25px; background: linear-gradient(135deg, #f06292, #ec407a); color: white; padding: 8px 18px; border-radius: 50px; font-size: 13px; font-weight: 800; box-shadow: 0 6px 15px rgba(240,98,146,0.3); z-index: 2; animation: bounce 2s infinite;">
                        ✨ Best Seller
                    </div>
                </div>
                
                <!-- Thumbnails Gallery -->
                <div class="thumbnails-container" style="display: flex; gap: 15px; margin-top: 25px; justify-content: flex-start; overflow-x: auto; padding-bottom: 10px;">
                    <div class="thumbnail active" data-src="{{ $imageUrl }}" style="width: 85px; height: 85px; border-radius: 18px; overflow: hidden; cursor: pointer; border: 3px solid #f06292; box-shadow: 0 5px 15px rgba(240,98,146,0.15); flex-shrink: 0; transition: all 0.3s;">
                        <img src="{{ $imageUrl }}" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    @foreach($variantImages as $varName => $varImgUrl)
                        @if($varImgUrl != $imageUrl)
                            <div class="thumbnail" data-src="{{ $varImgUrl }}" style="width: 85px; height: 85px; border-radius: 18px; overflow: hidden; cursor: pointer; border: 3px solid transparent; flex-shrink: 0; transition: all 0.3s; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
                                <img src="{{ $varImgUrl }}" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            
            <!-- Right Column: Product Info & Actions -->
            <div class="info-column" style="display: flex; flex-direction: column; justify-content: space-between;">
                <div>
                    <!-- Category Badge -->
                    <span style="display: inline-block; background: #ffebee; color: #e53935; padding: 6px 16px; border-radius: 50px; font-size: 13px; font-weight: 800; margin-bottom: 15px; text-transform: uppercase; letter-spacing: 0.5px; border: 1px solid rgba(229, 57, 53, 0.1);">
                        🍰 {{ $produk->kategori->nama_kategori ?? 'Kue Premium' }}
                    </span>
                    
                    <!-- Product Title -->
                    <h1 style="font-size: 40px; color: #6d4c41; font-weight: 900; margin-bottom: 12px; letter-spacing: -0.5px; line-height: 1.2;">
                        {{ $produk->nama_produk }}
                    </h1>
                    
                    <!-- Ratings, Reviews, and Sold Info (Shopee-Style) -->
                    <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 25px; font-size: 15px; flex-wrap: wrap;">
                        <div style="display: flex; align-items: center; gap: 5px; color: #ffb300; font-weight: 800; border-right: 1px solid #e0d0d0; padding-right: 15px;">
                            <span style="text-decoration: underline; font-size: 17px; color: #6d4c41;">{{ number_format($averageRating, 1) }}</span>
                            <span style="display: flex; gap: 2px;">
                                @for($i=1; $i<=5; $i++)
                                    <i class="fas fa-star" style="color: {{ $i <= round($averageRating) ? '#ffb300' : '#e0e0e0' }};"></i>
                                @endfor
                            </span>
                        </div>
                        <div style="border-right: 1px solid #e0d0d0; padding-right: 15px; color: #6d4c41;">
                            <span style="font-weight: 800; text-decoration: underline; font-size: 17px;">{{ $reviewCount }}</span> <span style="color: #8d6e63; font-weight: 600;">Penilaian</span>
                        </div>
                        <div style="color: #6d4c41;">
                            <span style="font-weight: 800; font-size: 17px;">100+</span> <span style="color: #8d6e63; font-weight: 600;">Terjual</span>
                        </div>
                    </div>
                    
                    <!-- Price Card -->
                    <div style="background: linear-gradient(135deg, #fff5f8, #fff0f5); border-radius: 24px; padding: 22px 28px; margin-bottom: 30px; border: 1px solid rgba(240,98,146,0.12); display: flex; align-items: center; gap: 15px;">
                        <span id="productBasePriceDisplay" style="font-size: 38px; font-weight: 900; color: #f06292;">
                            Rp {{ number_format($produk->harga, 0, ',', '.') }}
                        </span>
                        @if($produk->is_promo)
                            <span style="text-decoration: line-through; color: #bcaaa4; font-size: 18px; font-weight: 600;">
                                Rp {{ number_format($produk->harga * 1.25, 0, ',', '.') }}
                            </span>
                            <span style="background: #f06292; color: white; padding: 3px 10px; border-radius: 8px; font-size: 11px; font-weight: 800;">
                                20% OFF
                            </span>
                        @endif
                    </div>
                    
                    <!-- Variant Options Selector -->
                    <div class="options-container" id="productOptionsContainer">
                        @foreach($options as $opt)
                            <div class="option-group" style="margin-bottom: 25px;">
                                <label style="font-weight: 800; display: block; margin-bottom: 12px; color: #6d4c41; font-size: 15px; letter-spacing: 0.2px; text-transform: uppercase;">
                                    {{ $opt['label'] }}
                                </label>
                                <div class="choices-list" data-key="{{ $opt['key'] }}" style="display: flex; flex-wrap: wrap; gap: 12px;">
                                    @foreach($opt['choices'] as $idx => $choice)
                                        @php
                                            // Cek apakah pilihan pertama terpilih secara default
                                            $isChecked = $idx === 0;
                                        @endphp
                                        <div class="choice-pill {{ $isChecked ? 'active' : '' }}" data-value="{{ $choice }}" style="padding: 10px 22px; background: {{ $isChecked ? 'linear-gradient(135deg, #fce4ec, #f8bbd0)' : 'white' }}; border: 2px solid {{ $isChecked ? '#f06292' : '#e0d0d0' }}; border-radius: 50px; cursor: pointer; font-weight: 700; color: #6d4c41; font-size: 14px; transition: all 0.3s; box-shadow: 0 4px 10px rgba(0,0,0,0.02); display: flex; align-items: center; gap: 8px;">
                                            <input type="radio" name="{{ $opt['key'] }}" value="{{ $choice }}" {{ $isChecked ? 'checked' : '' }} style="display: none;">
                                            <span>{{ $choice }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- Quantity Counter Selector -->
                    <div style="margin-bottom: 35px;">
                        <label style="font-weight: 800; display: block; margin-bottom: 12px; color: #6d4c41; font-size: 15px; letter-spacing: 0.2px; text-transform: uppercase;">
                            Kuantitas
                        </label>
                        <div style="display: flex; align-items: center; gap: 15px;">
                            <div style="display: flex; align-items: center; gap: 18px; background: white; padding: 8px 18px; border-radius: 50px; border: 2px solid #e0d0d0; width: fit-content; box-shadow: 0 4px 10px rgba(0,0,0,0.01);">
                                <button type="button" id="detailQtyMinus" style="width: 34px; height: 34px; border-radius: 50%; border: none; background: linear-gradient(135deg, #fce4ec, #f8bbd0); color: #f06292; font-size: 20px; font-weight: bold; cursor: pointer; transition: all 0.2s; display: flex; align-items: center; justify-content: center;">−</button>
                                <span id="detailQtyValue" style="font-size: 20px; font-weight: 900; min-width: 40px; text-align: center; color: #6d4c41;">1</span>
                                <button type="button" id="detailQtyPlus" style="width: 34px; height: 34px; border-radius: 50%; border: none; background: linear-gradient(135deg, #fce4ec, #f8bbd0); color: #f06292; font-size: 20px; font-weight: bold; cursor: pointer; transition: all 0.2s; display: flex; align-items: center; justify-content: center;">+</button>
                            </div>
                            <span style="font-size: 14px; color: #8d6e63; font-weight: 600;">Stok tersedia: 15 porsi</span>
                        </div>
                    </div>
                </div>
                
                <!-- Call-To-Action (Buttons) -->
                <div>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; padding-top: 15px; border-top: 1px solid #f0e0d0;">
                        <span style="font-weight: 800; color: #6d4c41; font-size: 16px;">Subtotal:</span>
                        <span id="detailSubtotalDisplay" style="font-size: 30px; font-weight: 900; color: #f06292;">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                    </div>
                    <div style="display: flex; gap: 20px; flex-wrap: wrap;">
                        <button id="detailAddToCartBtn" style="flex: 1.1; padding: 18px 24px; border-radius: 50px; border: 2px solid #b2dfdb; background: #e0f2f1; color: #00695c; font-weight: 800; font-size: 15px; cursor: pointer; transition: all 0.3s; display: inline-flex; align-items: center; justify-content: center; gap: 10px; box-shadow: 0 6px 15px rgba(0,105,92,0.1);">
                            <i class="fas fa-cart-plus" style="font-size: 17px;"></i> Masukkan Keranjang
                        </button>
                        <button id="detailOrderNowBtn" style="flex: 1; padding: 18px 24px; border-radius: 50px; border: none; background: linear-gradient(135deg, #f06292, #ec407a); color: white; font-weight: 800; font-size: 15px; cursor: pointer; transition: all 0.3s; box-shadow: 0 6px 18px rgba(240,98,146,0.3); display: inline-flex; align-items: center; justify-content: center; gap: 8px;">
                            ⚡ Beli Sekarang
                        </button>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <!-- Tabs Information Section (Shopee-Style) -->
    <div style="max-width: 1400px; margin: 50px auto; padding: 0 25px; font-family: 'Outfit', sans-serif;">
        <div style="background: rgba(255, 255, 255, 0.95); border-radius: 40px; padding: 40px; box-shadow: 0 20px 50px rgba(0,0,0,0.04); border: 1px solid rgba(255,255,255,0.7);">
            
            <!-- Tab Headers -->
            <div class="tabs-header-container" style="display: flex; gap: 40px; border-bottom: 2px solid #f0e0d0; margin-bottom: 35px; padding-bottom: 5px;">
                <button class="tab-header active" data-tab="deskripsi" style="background: none; border: none; font-size: 20px; font-weight: 800; color: #f06292; padding-bottom: 15px; cursor: pointer; position: relative; transition: all 0.3s;">
                    Deskripsi Produk
                    <div class="tab-underline" style="position: absolute; bottom: -2px; left: 0; width: 100%; height: 3px; background: #f06292; border-radius: 10px; transition: all 0.3s;"></div>
                </button>
                <button class="tab-header" data-tab="ulasan" style="background: none; border: none; font-size: 20px; font-weight: 800; color: #8d6e63; padding-bottom: 15px; cursor: pointer; position: relative; transition: all 0.3s;">
                    Ulasan Pelanggan ({{ $reviewCount }})
                    <div class="tab-underline" style="position: absolute; bottom: -2px; left: 0; width: 0%; height: 3px; background: #f06292; border-radius: 10px; transition: all 0.3s;"></div>
                </button>
            </div>
            
            <!-- Tab Content: Deskripsi -->
            <div class="tab-body active" id="tab-deskripsi" style="display: block; animation: fadeIn 0.4s ease;">
                <div style="color: #6d4c41; font-size: 16.5px; line-height: 1.8; font-weight: 600;">
                    <p style="margin-bottom: 25px;">{{ $produk->deskripsi ?: 'Nikmati hidangan manis nan premium persembahan dari Dear Seana. Setiap produk diolah secara higienis menggunakan bahan-bahan impor berkualitas tinggi untuk memanjakan lidah Anda.' }}</p>
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; margin-top: 35px;">
                        <div style="background: #fff8f5; border-radius: 24px; padding: 25px; border: 1px solid #ffe8e0;">
                            <h3 style="font-size: 18px; color: #6d4c41; font-weight: 800; margin-bottom: 15px; display: flex; align-items: center; gap: 10px;">
                                <span>🌾</span> Keunggulan Bahan Kami
                            </h3>
                            <ul style="padding-left: 20px; display: flex; flex-direction: column; gap: 8px;">
                                <li>100% Menggunakan mentega impor Perancis (French Butter) premium</li>
                                <li>Tanpa pemanis buatan maupun zat pengawet kimia berbahaya</li>
                                <li>Telur organik pilihan bergradasi tinggi yang dijamin higienis</li>
                                <li>Cokelat murni Belgia (Belgian Pure Chocolate) dengan aroma memikat</li>
                            </ul>
                        </div>
                        <div style="background: #fff5f8; border-radius: 24px; padding: 25px; border: 1px solid #ffe8f0;">
                            <h3 style="font-size: 18px; color: #6d4c41; font-weight: 800; margin-bottom: 15px; display: flex; align-items: center; gap: 10px;">
                                <span>❄️</span> Petunjuk Penyimpanan & Penyajian
                            </h3>
                            <ul style="padding-left: 20px; display: flex; flex-direction: column; gap: 8px;">
                                <li>Sebaiknya disimpan di dalam lemari pendingin (chiller) suhu 2-4°C</li>
                                <li>Produk tahan hingga 3 hari di kulkas, dan 24 jam di suhu ruang</li>
                                <li>Keluarkan kue dari kulkas 15 menit sebelum dikonsumsi agar krim lebih lembut</li>
                                <li>Sangat nikmat disajikan bersama secangkir kopi hangat atau teh melati</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Tab Content: Ulasan -->
            <div class="tab-body" id="tab-ulasan" style="display: none; animation: fadeIn 0.4s ease;">
                
                <!-- Ratings Summary Dashboard -->
                <div class="reviews-dashboard" style="display: grid; grid-template-columns: 1fr 2.2fr; gap: 40px; background: #fffaf7; border-radius: 28px; padding: 30px; border: 1px solid #ffebee; margin-bottom: 40px; align-items: center;">
                    <!-- Left: Large Star Info -->
                    <div style="text-align: center; border-right: 2px dashed #f0d0d0; padding-right: 20px; display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100%;">
                        <span style="font-size: 58px; font-weight: 900; color: #6d4c41; line-height: 1;">{{ number_format($averageRating, 1) }}</span>
                        <span style="font-size: 15px; color: #8d6e63; font-weight: 800; margin-top: 5px; margin-bottom: 10px;">dari 5 bintang</span>
                        <div style="display: flex; gap: 4px; font-size: 24px; color: #ffb300; margin-bottom: 5px;">
                            @for($i=1; $i<=5; $i++)
                                <i class="fas fa-star" style="color: {{ $i <= round($averageRating) ? '#ffb300' : '#e0e0e0' }};"></i>
                            @endfor
                        </div>
                        <span style="font-size: 13.5px; color: #a1887f; font-weight: 600;">Total {{ $reviewCount }} Penilaian Aktif</span>
                    </div>
                    
                    <!-- Right: Ratings Filter Pills -->
                    <div>
                        <h4 style="font-size: 15px; color: #6d4c41; font-weight: 800; margin-bottom: 15px; margin-top: 0;">FILTER PENILAIAN</h4>
                        <div class="filter-pills-container" style="display: flex; flex-wrap: wrap; gap: 12px;">
                            <button class="filter-pill active" data-filter="all" style="padding: 10px 20px; border-radius: 50px; border: 2px solid #f06292; background: linear-gradient(135deg, #fce4ec, #f8bbd0); color: #f06292; font-weight: 800; font-size: 13.5px; cursor: pointer; transition: all 0.3s; box-shadow: 0 4px 10px rgba(240,98,146,0.1);">
                                Semua ({{ $reviewCount }})
                            </button>
                            <button class="filter-pill" data-filter="5" style="padding: 10px 20px; border-radius: 50px; border: 2px solid #e0d0d0; background: white; color: #6d4c41; font-weight: 800; font-size: 13.5px; cursor: pointer; transition: all 0.3s;">
                                ⭐ 5 Bintang ({{ $displayReviews->where('rating', 5)->count() }})
                            </button>
                            <button class="filter-pill" data-filter="4" style="padding: 10px 20px; border-radius: 50px; border: 2px solid #e0d0d0; background: white; color: #6d4c41; font-weight: 800; font-size: 13.5px; cursor: pointer; transition: all 0.3s;">
                                ⭐ 4 Bintang ({{ $displayReviews->where('rating', 4)->count() }})
                            </button>
                            <button class="filter-pill" data-filter="3" style="padding: 10px 20px; border-radius: 50px; border: 2px solid #e0d0d0; background: white; color: #6d4c41; font-weight: 800; font-size: 13.5px; cursor: pointer; transition: all 0.3s; pointer-events: none; opacity: 0.5;">
                                ⭐ 3 Bintang (0)
                            </button>
                            <button class="filter-pill" data-filter="2" style="padding: 10px 20px; border-radius: 50px; border: 2px solid #e0d0d0; background: white; color: #6d4c41; font-weight: 800; font-size: 13.5px; cursor: pointer; transition: all 0.3s; pointer-events: none; opacity: 0.5;">
                                ⭐ 2 Bintang (0)
                            </button>
                            <button class="filter-pill" data-filter="1" style="padding: 10px 20px; border-radius: 50px; border: 2px solid #e0d0d0; background: white; color: #6d4c41; font-weight: 800; font-size: 13.5px; cursor: pointer; transition: all 0.3s; pointer-events: none; opacity: 0.5;">
                                ⭐ 1 Bintang (0)
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Reviews List -->
                <div class="reviews-list-container" id="reviewsList">
                    @foreach($displayReviews as $rev)
                        <div class="review-item-card" data-rating="{{ $rev->rating }}" style="border-bottom: 1px solid #ffe0d0; padding: 25px 0; display: flex; gap: 20px; transition: all 0.3s;">
                            <!-- Avatar -->
                            @php
                                $initial = strtoupper(substr($rev->user->name ?? 'P', 0, 1));
                                $bgColors = ['#fce4ec', '#efebe9', '#e0f2f1', '#e8eaf6', '#fff3e0'];
                                $chosenBg = $bgColors[$rev->id % count($bgColors)];
                            @endphp
                            <div style="width: 50px; height: 50px; border-radius: 50%; background: {{ $chosenBg }}; color: #6d4c41; font-weight: 900; font-size: 18px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 4px 10px rgba(0,0,0,0.05); border: 1px solid rgba(0,0,0,0.04);">
                                {{ $initial }}
                            </div>
                            
                            <!-- Content -->
                            <div style="flex: 1;">
                                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 8px;">
                                    <div>
                                        <div style="font-weight: 800; color: #6d4c41; font-size: 15.5px; display: flex; align-items: center; gap: 8px;">
                                            {{ $rev->user->name ?? 'Pelanggan Setia' }}
                                            <span style="font-size: 11px; background: #e8f5e9; color: #2e7d32; padding: 2px 8px; border-radius: 50px; font-weight: 800; display: inline-flex; align-items: center; gap: 4px; border: 1px solid rgba(46, 125, 50, 0.1);">
                                                <i class="fas fa-check-circle"></i> Pembeli Terverifikasi
                                            </span>
                                        </div>
                                        <div style="display: flex; gap: 2px; color: #ffb300; font-size: 12.5px; margin-top: 4px;">
                                            @for($i=1; $i<=5; $i++)
                                                <i class="fas fa-star" style="color: {{ $i <= $rev->rating ? '#ffb300' : '#e0e0e0' }};"></i>
                                            @endfor
                                        </div>
                                    </div>
                                    <span style="font-size: 12.5px; color: #a1887f; font-weight: 600;">
                                        {{ \Carbon\Carbon::parse($rev->created_at)->diffForHumans() }}
                                    </span>
                                </div>
                                
                                <!-- Variant Info Selected by User (if any) -->
                                @if(isset($rev->selections) && !empty($rev->selections))
                                    <div style="margin-bottom: 12px; display: flex; gap: 8px; flex-wrap: wrap;">
                                        @foreach($rev->selections as $k => $v)
                                            <span style="font-size: 11.5px; background: #fbe9e7; color: #d84315; padding: 3px 10px; border-radius: 25px; font-weight: 700;">
                                                {{ ucfirst($k) }}: {{ $v }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif
                                
                                @if(!empty($rev->ulasan))
                                    <p style="font-size: 15px; color: #6d4c41; line-height: 1.6; font-weight: 600; margin-bottom: 15px;">
                                        "{{ $rev->ulasan }}"
                                    </p>
                                @else
                                    <p style="font-size: 13.5px; color: #8d6e63; line-height: 1.6; font-style: italic; margin-bottom: 15px; background: rgba(0,0,0,0.02); padding: 8px 12px; border-radius: 8px; display: inline-block;">
                                        ✨ (Pelanggan tidak menulis ulasan, hanya memberikan rating & foto kue)
                                    </p>
                                @endif
                                
                                @if(!empty($rev->foto))
                                    <div style="margin-top: 12px; margin-bottom: 15px;">
                                        <a href="{{ asset($rev->foto) }}" target="_blank">
                                            <img src="{{ asset($rev->foto) }}" style="width: 100px; height: 100px; object-fit: cover; border-radius: 12px; border: 2px solid #f8bbd0; box-shadow: 0 4px 10px rgba(0,0,0,0.05); transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                        </a>
                                    </div>
                                @endif
                                
                                <!-- Like review action button -->
                                <button class="review-like-btn" style="background: none; border: none; font-size: 12.5px; color: #a1887f; font-weight: 800; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; transition: color 0.2s;" onmouseover="this.style.color='#f06292'" onmouseout="this.style.color='#a1887f'">
                                    👍 Bermanfaat (<span class="like-count">3</span>)
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
                
            </div>
            
        </div>
    </div>

    <!-- Related Products Cross-Selling Section -->
    @if($relatedProduks->isNotEmpty())
        <div style="max-width: 1400px; margin: 60px auto 80px; padding: 0 25px; font-family: 'Outfit', sans-serif;">
            <div style="display: flex; align-items: baseline; justify-content: space-between; gap: 16px; flex-wrap: wrap; margin-bottom: 35px; padding-bottom: 20px; border-bottom: 3px solid rgba(240,98,146,0.3);">
                <div>
                    <h2 style="font-size: 32px; color: #6d4c41; margin-bottom: 10px; font-weight: 900; letter-spacing: -1px; background: linear-gradient(135deg, #6d4c41, #f06292); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Kue Lainnya yang Mungkin Anda Suka</h2>
                    <p style="color: #8d6e63; margin: 0; font-size: 15px;">✨ Cicipi kelezatan variasi kue premium pilihan kami lainnya</p>
                </div>
            </div>
            
            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 25px;">
                @foreach($relatedProduks as $relIdx => $relProd)
                    @php
                        if($relProd->gambar && !str_starts_with($relProd->gambar, 'http')) {
                            if (str_starts_with($relProd->gambar, 'Kue/') || str_starts_with($relProd->gambar, 'Cookies/')) {
                                $relImg = asset('assets/img_produk/' . ltrim($relProd->gambar, '/'));
                            } else {
                                $relImg = asset('storage/' . $relProd->gambar);
                            }
                        } elseif($relProd->gambar && str_starts_with($relProd->gambar, 'http')) {
                            $relImg = $relProd->gambar;
                        } else {
                            $relImg = 'https://picsum.photos/seed/' . $relProd->id . '/300/200';
                        }
                    @endphp
                    
                    <div class="menu-card" data-aos="fade-up" data-aos-delay="{{ $relIdx * 50 }}" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(5px); border-radius: 28px; overflow: hidden; box-shadow: 0 15px 35px rgba(0,0,0,0.06); transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1); border: 1px solid rgba(255,255,255,0.6); display: flex; flex-direction: column; height: 100%;">
                        <a href="{{ route('menu.show', $relProd->id) }}" style="text-decoration: none; color: inherit; display: block; overflow: hidden; border-radius: 28px 28px 0 0; position: relative; height: 190px; flex-shrink: 0; z-index: 2;">
                            <img src="{{ $relImg }}" alt="{{ $relProd->nama_produk }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);" onerror="this.src='https://picsum.photos/300/200'">
                        </a>
                        <div style="padding: 18px 15px 22px; text-align: center; display: flex; flex-direction: column; flex: 1; justify-content: space-between;">
                            <div>
                                <a href="{{ route('menu.show', $relProd->id) }}" style="text-decoration: none; color: inherit; display: block; margin-bottom: 8px;">
                                    <h3 style="font-size: 17px; color: #6d4c41; font-weight: 800; margin: 0;">{{ $relProd->nama_produk }}</h3>
                                </a>
                                <p style="font-size: 12.5px; color: #a1887f; line-height: 1.4; margin-bottom: 12px; min-height: 35px;">{{ Str::limit($relProd->deskripsi, 65, '...') }}</p>
                            </div>
                            <div>
                                <span style="font-size: 20px; font-weight: 900; color: #f06292; display: block; margin-bottom: 15px;">Rp {{ number_format($relProd->harga, 0, ',', '.') }}</span>
                                <a href="{{ route('menu.show', $relProd->id) }}" style="display: block; width: 100%; background: linear-gradient(135deg, #fce4ec, #f8bbd0); color: #f06292; padding: 10px 0; border-radius: 50px; font-weight: 800; font-size: 12px; text-decoration: none; transition: all 0.3s; box-shadow: 0 4px 10px rgba(240,98,146,0.08); text-align: center;" class="rel-btn">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Toast Notification Premium -->
    <div id="toastNotification" style="position: fixed; bottom: 40px; left: 50%; transform: translateX(-50%) translateY(100px); background: linear-gradient(135deg, #1a1a1a, #2d2d2d); color: #ffebcd; padding: 16px 32px; border-radius: 80px; font-weight: 700; z-index: 1100; transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55); opacity: 0; pointer-events: none; white-space: nowrap; box-shadow: 0 10px 30px rgba(0,0,0,0.25); font-size: 14px; backdrop-filter: blur(8px);">
        ✨ Pesanan ditambahkan
    </div>

    <!-- Floating Cart Button Premium -->
    <div class="floating-cart" style="position: fixed; bottom: 30px; right: 30px; background: linear-gradient(135deg, #f06292, #ec407a); color: white; width: 70px; height: 70px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 30px; cursor: pointer; box-shadow: 0 12px 30px rgba(240,98,146,0.5); z-index: 1000; transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);">
        🛒 <span class="cart-badge" style="position: absolute; top: -8px; right: -8px; background: #ff5722; color: white; border-radius: 50%; width: 26px; height: 26px; font-size: 12px; display: none; align-items: center; justify-content: center; font-weight: bold; box-shadow: 0 2px 8px rgba(0,0,0,0.2); border: 2px solid white;">0</span>
    </div>

    <!-- Cart Modal & Checkout Dialog completely mirrored from menu.blade.php for system consistency -->
    <!-- Custom styling & hover effects for this page specifically -->
    <style>
        .choice-pill {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .choice-pill:hover {
            transform: translateY(-2px);
            border-color: #f06292 !important;
            background: #fff5f8 !important;
        }
        .choice-pill.active {
            transform: translateY(0) scale(1.02);
            box-shadow: 0 6px 15px rgba(240,98,146,0.2) !important;
        }
        
        .tab-header:hover {
            color: #f06292 !important;
        }
        
        .filter-pill {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .filter-pill:hover {
            border-color: #f06292 !important;
            transform: translateY(-2px);
        }
        .filter-pill.active {
            border-color: #f06292 !important;
            background: linear-gradient(135deg, #fce4ec, #f8bbd0) !important;
            color: #f06292 !important;
            box-shadow: 0 4px 12px rgba(240,98,146,0.18) !important;
            transform: translateY(0);
        }
        
        .review-item-card:hover {
            background: #fffbfd;
        }
        
        .menu-card { 
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .menu-card:hover { 
            transform: translateY(-10px);
            box-shadow: 0 25px 45px rgba(240,98,146,0.2) !important;
        }
        .menu-card:hover img {
            transform: scale(1.08);
        }
        .rel-btn:hover {
            background: linear-gradient(135deg, #f06292, #ec407a) !important;
            color: white !important;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(240,98,146,0.3) !important;
        }
        
        /* Floating Cart Button hover */
        .floating-cart:hover {
            transform: scale(1.12) rotate(5deg);
            box-shadow: 0 15px 40px rgba(240,98,146,0.6);
        }
        
        /* Thumbnail Hover Effect */
        .thumbnail:hover {
            transform: translateY(-3px);
            border-color: #f8bbd0 !important;
        }
        .thumbnail.active {
            transform: scale(1.05);
        }

        /* Order dialog close hover */
        .modal-close:hover, .cart-modal-close:hover {
            background: #f06292 !important;
            color: white !important;
            transform: rotate(90deg);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }
    </style>
@endsection

@push('scripts')
    <script>
        // WhatsApp target and payment definitions mirrored from menu.blade.php
        const WA_PHONE_NUMBER = '{{ $global_setting->wa_number ?? "6281234567890" }}';
        
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

        // Main variables
        let cart = [];
        let selectedPaymentMethod = 'bank';
        let currentProduct = {
            id: {{ $produk->id }},
            nama_produk: {!! json_encode($produk->nama_produk) !!},
            deskripsi: {!! json_encode($produk->deskripsi ?: 'Nikmati hidangan manis premium') !!},
            harga: {{ $produk->harga }},
            options: {!! json_encode($options) !!},
            gambar: {!! json_encode($imageUrl) !!},
            variant_images: {!! json_encode($variantImages) !!}
        };

        let currentSelections = {};
        let currentQuantity = 1;

        // Initialize Selections with default checked values
        @foreach($options as $opt)
            currentSelections['{{ $opt['key'] }}'] = '{{ $opt['choices'][0] }}';
        @endforeach

        document.addEventListener('DOMContentLoaded', function() {
            const mainImg = document.getElementById('mainProductImage');
            
            // ========== THUMBNAIL GALLERY INTERACTIVE SWAP ==========
            document.querySelectorAll('.thumbnail').forEach(thumb => {
                thumb.addEventListener('click', function() {
                    document.querySelectorAll('.thumbnail').forEach(t => {
                        t.style.borderColor = 'transparent';
                        t.classList.remove('active');
                    });
                    this.style.borderColor = '#f06292';
                    this.classList.add('active');
                    mainImg.style.opacity = '0';
                    setTimeout(() => {
                        mainImg.src = this.dataset.src;
                        mainImg.style.opacity = '1';
                    }, 200);
                });
            });

            // ========== RATING LIKE/HELPFUL BUTTON INCREMENT ==========
            document.querySelectorAll('.review-like-btn').forEach(btn => {
                let liked = false;
                btn.addEventListener('click', function() {
                    const countSpan = this.querySelector('.like-count');
                    let currentCount = parseInt(countSpan.textContent);
                    if (!liked) {
                        currentCount++;
                        liked = true;
                        this.style.color = '#f06292';
                        this.innerHTML = `👍 Bermanfaat (<b>${currentCount}</b>)`;
                    } else {
                        currentCount--;
                        liked = false;
                        this.style.color = '#a1887f';
                        this.innerHTML = `👍 Bermanfaat (<span class="like-count">${currentCount}</span>)`;
                    }
                });
            });

            // ========== TAB SWITCHING WITH SMOOTH SLIDE UNDERLINE ==========
            document.querySelectorAll('.tab-header').forEach(header => {
                header.addEventListener('click', function() {
                    document.querySelectorAll('.tab-header').forEach(h => {
                        h.style.color = '#8d6e63';
                        h.querySelector('.tab-underline').style.width = '0%';
                        h.classList.remove('active');
                    });
                    this.style.color = '#f06292';
                    this.querySelector('.tab-underline').style.width = '100%';
                    this.classList.add('active');

                    const targetTab = this.dataset.tab;
                    document.querySelectorAll('.tab-body').forEach(body => {
                        body.style.display = 'none';
                    });
                    document.getElementById('tab-' + targetTab).style.display = 'block';
                });
            });

            // ========== SHOPEE RATING FILTER SYSTEM (CLIENT-SIDE) ==========
            document.querySelectorAll('.filter-pill').forEach(pill => {
                pill.addEventListener('click', function() {
                    document.querySelectorAll('.filter-pill').forEach(p => p.classList.remove('active'));
                    this.classList.add('active');

                    const filterValue = this.dataset.filter;
                    const reviewCards = document.querySelectorAll('.review-item-card');

                    reviewCards.forEach(card => {
                        if (filterValue === 'all') {
                            card.style.display = 'flex';
                        } else {
                            if (card.dataset.rating === filterValue) {
                                card.style.display = 'flex';
                            } else {
                                card.style.display = 'none';
                            }
                        }
                    });
                });
            });

            // ========== VARIANT OPTIONS CLICK EVENTS AND PRICE CALCULATOR ==========
            document.querySelectorAll('.choices-list .choice-pill').forEach(pill => {
                pill.addEventListener('click', function() {
                    const parentGroup = this.closest('.choices-list');
                    const key = parentGroup.dataset.key;
                    const val = this.dataset.value;

                    // Uncheck others in this group
                    parentGroup.querySelectorAll('.choice-pill').forEach(c => {
                        c.classList.remove('active');
                        c.style.background = 'white';
                        c.style.borderColor = '#e0d0d0';
                        c.querySelector('input').checked = false;
                    });

                    // Check this one
                    this.classList.add('active');
                    this.style.background = 'linear-gradient(135deg, #fce4ec, #f8bbd0)';
                    this.style.borderColor = '#f06292';
                    const radioInput = this.querySelector('input');
                    radioInput.checked = true;
                    
                    // Save selection
                    currentSelections[key] = val;

                    // Auto-swap thumbnail picture on variant image match
                    if (key === 'ukuran' || key === 'varian') {
                        if (currentProduct.variant_images && currentProduct.variant_images[val]) {
                            const newImgSrc = currentProduct.variant_images[val];
                            mainImg.style.transform = 'scale(0.95)';
                            setTimeout(() => {
                                mainImg.src = newImgSrc;
                                mainImg.style.transform = 'scale(1)';
                            }, 200);

                            // Sync thumbnail border
                            document.querySelectorAll('.thumbnail').forEach(t => {
                                if (t.dataset.src === newImgSrc) {
                                    t.style.borderColor = '#f06292';
                                    t.classList.add('active');
                                } else {
                                    t.style.borderColor = 'transparent';
                                    t.classList.remove('active');
                                }
                            });
                        }
                    }

                    updateTotalPrice();
                });
            });

            // ========== QUANTITY SELECTOR LISTENERS ==========
            const qtySpan = document.getElementById('detailQtyValue');
            document.getElementById('detailQtyMinus').addEventListener('click', function() {
                if (currentQuantity > 1) {
                    currentQuantity--;
                    qtySpan.textContent = currentQuantity;
                    updateTotalPrice();
                }
            });
            document.getElementById('detailQtyPlus').addEventListener('click', function() {
                if (currentQuantity < 99) {
                    currentQuantity++;
                    qtySpan.textContent = currentQuantity;
                    updateTotalPrice();
                }
            });

            // ========== CALCULATE DYNAMIC PRICING ==========
            function parsePriceModifier(choiceStr) {
                let extra = 0;
                const matchPlusK = choiceStr.match(/\+(\d+)k/i);
                const matchPlus = choiceStr.match(/\+(\d+)(?!k)/i);
                if (matchPlusK) {
                    extra = parseInt(matchPlusK[1]) * 1000;
                } else if (matchPlus) {
                    extra = parseInt(matchPlus[1]);
                }
                return extra;
            }

            function calculateCurrentSubtotal() {
                let base = currentProduct.harga;
                let extra = 0;
                for (let [k, val] of Object.entries(currentSelections)) {
                    extra += parsePriceModifier(val);
                }
                return (base + extra) * currentQuantity;
            }

            function updateTotalPrice() {
                const subtotal = calculateCurrentSubtotal();
                document.getElementById('detailSubtotalDisplay').textContent = formatRupiah(subtotal);
            }

            function formatRupiah(angka) {
                return 'Rp ' + new Intl.NumberFormat('id-ID').format(angka);
            }

            // ========== TOAST MESSAGE HELPER ==========
            const toast = document.getElementById('toastNotification');
            function showToastMessage(message) {
                toast.textContent = message;
                toast.style.opacity = '1';
                toast.style.transform = 'translateX(-50%) translateY(0)';
                setTimeout(() => {
                    toast.style.opacity = '0';
                    toast.style.transform = 'translateX(-50%) translateY(100px)';
                }, 2500);
            }

            // ========== LOCAL STORAGE CART UTILITIES ==========
            function loadCartFromStorage() {
                const savedCart = localStorage.getItem('sweetSavoryCart');
                if (savedCart) {
                    cart = JSON.parse(savedCart);
                    updateCartBadge();
                }
            }

            function updateCartBadge() {
                const cartBadge = document.querySelector('.cart-badge');
                if (!cartBadge) return;
                const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
                cartBadge.textContent = totalItems;
                if (totalItems > 0) {
                    cartBadge.style.display = 'flex';
                } else {
                    cartBadge.style.display = 'none';
                }
            }

            function animateCart() {
                const cartBtn = document.querySelector('.floating-cart');
                if (cartBtn) {
                    cartBtn.style.transform = 'scale(1.2)';
                    setTimeout(() => {
                        cartBtn.style.transform = 'scale(1)';
                    }, 200);
                }
            }

            function addToCart(product, selections, quantity) {
                const cartItem = {
                    id: product.id,
                    name: product.nama_produk,
                    base_price: product.harga,
                    selections: { ...selections },
                    quantity: quantity,
                    total_price: calculateCurrentSubtotal()
                };
                
                const existingIndex = cart.findIndex(item => 
                    item.id === cartItem.id && 
                    JSON.stringify(item.selections) === JSON.stringify(cartItem.selections)
                );
                
                if (existingIndex !== -1) {
                    cart[existingIndex].quantity += quantity;
                    cart[existingIndex].total_price = calculateTotalPriceForCartItem(cart[existingIndex]);
                } else {
                    cart.push(cartItem);
                }
                
                localStorage.setItem('sweetSavoryCart', JSON.stringify(cart));
                showToastMessage('🛒 Kue manis dimasukkan keranjang! ✨');
                updateCartBadge();
                animateCart();
            }

            function calculateTotalPriceForCartItem(item) {
                let basePrice = item.base_price;
                let extraPrice = 0;
                for (const [key, value] of Object.entries(item.selections)) {
                    extraPrice += parsePriceModifier(value);
                }
                return (basePrice + extraPrice) * item.quantity;
            }

            // ========== ATTACH PRIMARY BUTTONS CLICK HANDLERS ==========
            document.getElementById('detailAddToCartBtn').addEventListener('click', function() {
                addToCart(currentProduct, currentSelections, currentQuantity);
            });

            document.getElementById('detailOrderNowBtn').addEventListener('click', function() {
                // Instantly open snap checkout for this single item
                initiateInstantCheckout();
            });

            // ========== INSTANT DIRECT CHECKOUT (MIDTRANS) ==========
            let savedCustName = {!! json_encode(auth()->check() ? auth()->user()->name : '') !!};
            let savedCustPhone = {!! json_encode(auth()->check() ? auth()->user()->no_wa : '') !!};
            let savedCustAddress = {!! json_encode(auth()->check() ? auth()->user()->alamat : '') !!};

            async function initiateInstantCheckout() {
                const total = calculateCurrentSubtotal();
                
                // Buat item tunggal format keranjang
                const singleItem = [{
                    id: currentProduct.id,
                    name: currentProduct.nama_produk,
                    quantity: currentQuantity,
                    price: currentProduct.harga,
                    total_price: total,
                    selections: currentSelections
                }];

                const payload = {
                    nama_pelanggan: savedCustName || 'Pelanggan',
                    no_wa: savedCustPhone || '08000000000',
                    alamat: savedCustAddress || '-',
                    metode_pembayaran: 'Midtrans',
                    items: JSON.stringify(singleItem),
                    total_harga: total
                };
                
                try {
                    showToastMessage('⏳ Menghubungkan ke bank pembayaran...');
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

                    // Buka Snap Midtrans
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
                                sessionStorage.setItem('payment_success_confetti', 'true');
                                showToastMessage('✅ Pembayaran berhasil diproses!');
                                // Bersihkan cart
                                cart = [];
                                localStorage.removeItem('sweetSavoryCart');
                                updateCartBadge();
                                setTimeout(() => window.location.href = "{{ route('pesanan_saya') }}", 2000);
                            });
                        },
                        onPending: function(snapResult){
                            showToastMessage('⏳ Silakan selesaikan pembayaran Anda.');
                            setTimeout(() => window.location.href = "{{ route('pesanan_saya') }}", 2000);
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

            // ========== REUSE THE BEAUTIFUL CART MODAL POPUP FROM MENU.BLADE.PHP ==========
            function showCartModal() {
                if (cart.length === 0) {
                    showToastMessage('✨ Keranjang belanja masih kosong');
                    return;
                }
                
                const custNameInput = document.getElementById('custName');
                if (custNameInput) savedCustName = custNameInput.value;
                const custPhoneInput = document.getElementById('custPhone');
                if (custPhoneInput) savedCustPhone = custPhoneInput.value;
                const custAddressInput = document.getElementById('custAddress');
                if (custAddressInput) savedCustAddress = custAddressInput.value;
                
                let grandTotal = 0;
                let cartHtml = `
                    <div id="cartModal" class="order-modal" style="display: flex; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.85); backdrop-filter: blur(15px); z-index: 10001; align-items: center; justify-content: center; font-family: 'Outfit', sans-serif;">
                        <div class="modal-content" style="background: linear-gradient(145deg, #FFF8F0, #FFF5EE); border-radius: 48px; max-width: 680px; width: 90%; max-height: 85vh; overflow-y: auto; box-shadow: 0 35px 70px rgba(0,0,0,0.3); border: 1px solid rgba(255,255,255,0.7); animation: fadeIn 0.4s ease;">
                            <div class="modal-header" style="background: linear-gradient(135deg, #fce4ec, #f8bbd0); padding: 28px; border-radius: 48px 48px 0 0; position: relative;">
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
                        <div style="display: flex; align-items: center; gap: 16px; padding: 18px; border-bottom: 1px solid #ffe0d0; margin-bottom: 15px; background: white; border-radius: 28px; transition: all 0.3s; border: 1px solid rgba(0,0,0,0.03);">
                            <div style="flex: 1;">
                                <div style="font-weight: 900; color: #6d4c41; font-size: 17px;">${item.name}</div>
                                <div style="font-size: 12px; margin-top: 10px;">${selectionsText}</div>
                                <div style="font-size: 14px; color: #f06292; margin-top: 10px; font-weight: 800;">${formatRupiah(item.base_price)} × ${item.quantity} = ${formatRupiah(itemTotal)}</div>
                            </div>
                            <div style="display: flex; gap: 12px; align-items: center;">
                                <button class="cart-qty-minus" data-index="${index}" style="width: 36px; height: 36px; border-radius: 50%; border: 1px solid #f0c0d0; background: white; color: #f06292; cursor: pointer; font-weight: bold; transition: all 0.2s; display: flex; align-items: center; justify-content: center; font-size: 18px;">−</button>
                                <span style="min-width: 30px; text-align: center; font-weight: 800; color: #6d4c41; font-size: 16px;">${item.quantity}</span>
                                <button class="cart-qty-plus" data-index="${index}" style="width: 36px; height: 36px; border-radius: 50%; border: 1px solid #f0c0d0; background: white; color: #f06292; cursor: pointer; font-weight: bold; transition: all 0.2s; display: flex; align-items: center; justify-content: center; font-size: 18px;">+</button>
                                <button class="cart-remove" data-index="${index}" style="background: none; border: none; color: #e57373; cursor: pointer; font-size: 22px; transition: all 0.2s; margin-left: 8px;">🗑️</button>
                            </div>
                        </div>
                    `;
                });
                
                cartHtml += `
                            </div>
                            <div class="customer-details" style="margin: 0 28px 24px 28px; padding: 22px; background: white; border-radius: 32px; border: 1px solid #ffe0d0;">
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
                                    <button id="clearCartBtn" style="flex: 1; padding: 16px; border-radius: 60px; border: 2px solid #f0c0d0; background: white; color: #e57373; font-weight: 800; cursor: pointer; transition: all 0.3s; font-size: 14px;">Kosongkan</button>
                                    <button id="checkoutCartBtn" style="flex: 1; padding: 16px; border-radius: 60px; border: none; background: linear-gradient(135deg, #25D366, #128C7E); color: white; font-weight: 800; cursor: pointer; transition: all 0.3s; box-shadow: 0 6px 20px rgba(37,211,102,0.35); font-size: 14px;">📱 Proses Pesanan</button>
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
                    sendCartToMidtransWithPayment();
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

            async function sendCartToMidtransWithPayment() {
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
                    metode_pembayaran: 'Midtrans',
                    items: JSON.stringify(cart),
                    total_harga: grandTotal
                };
                
                try {
                    showToastMessage('⏳ Menghubungkan ke bank pembayaran...');
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

                    // Snap Midtrans checkout
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
                                sessionStorage.setItem('payment_success_confetti', 'true');
                                showToastMessage('✅ Pembayaran berhasil diproses!');
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
                            cart = [];
                            localStorage.removeItem('sweetSavoryCart');
                            savedCustName = '';
                            savedCustPhone = '';
                            savedCustAddress = '';
                            updateCartBadge();
                            setTimeout(() => window.location.href = "{{ route('pesanan_saya') }}", 2000);
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

            // Load initial cart and attach click trigger for floating cart
            loadCartFromStorage();
            const floatingCartBtn = document.querySelector('.floating-cart');
            if (floatingCartBtn) {
                floatingCartBtn.addEventListener('click', showCartModal);
            }
        });
    </script>
@endpush
