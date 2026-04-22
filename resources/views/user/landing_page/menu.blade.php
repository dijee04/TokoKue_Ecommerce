@extends('user.layouts.app')

@section('content')
    <!-- Menu Header -->
    <section class="menu-header" style="background: linear-gradient(135deg, #fce4ec 0%, #f8bbd0 100%); padding: 60px 20px; text-align: center;">
        <div class="container">
            <h1 style="font-size: 48px; color: #6d4c41; margin-bottom: 10px;">Daftar Menu Lengkap</h1>
            <p style="font-size: 18px; color: #8d6e63;">Berbagai pilihan manis dan gurih untuk Anda</p>
        </div>
    </section>

    @php
        // Inisialisasi koleksi produk dari database
        // Jika $produks belum ada dari controller, gunakan data manual sebagai fallback
        if(!isset($produks) || $produks->isEmpty()) {
            // Data manual fallback
            $produks = collect([
              
               
                (object) [
                    'id' => 3,
                    'nama_produk' => 'Brownis Almond',
                    'deskripsi' => 'Brownis dengan taburan almond renyah.',
                    'harga' => 95000,
                    'gambar' => 'Kue/Brownis_3.png',
                    'kategori' => (object) ['nama_kategori' => 'Kue Basah']
                ],
                
                (object) [
                    'id' => 5,
                    'nama_produk' => 'Cheesecake Coklat',
                    'deskripsi' => 'Cheesecake lembut dengan lapisan coklat.',
                    'harga' => 120000,
                    'gambar' => 'Kue/Cheesecake_coklat.png',
                    'kategori' => (object) ['nama_kategori' => 'Kue Basah']
                ],
                (object) [
                    'id' => 6,
                    'nama_produk' => 'Cheesecake Lotus',
                    'deskripsi' => 'Cheesecake dengan biskuit lotus biscoff.',
                    'harga' => 125000,
                    'gambar' => 'Kue/Cheesecake_lotus.png',
                    'kategori' => (object) ['nama_kategori' => 'Kue Basah']
                ],
                (object) [
                    'id' => 7,
                    'nama_produk' => 'Birthday Tart',
                    'deskripsi' => 'Tart spesial dengan topping buah segar.',
                    'harga' => 175000,
                    'gambar' => 'Kue/birthday_tart.png',
                    'kategori' => (object) ['nama_kategori' => 'Birthday Cake']
                ],
                (object) [
                    'id' => 8,
                    'nama_produk' => 'Chocolate Cake',
                    'deskripsi' => 'Kue cokelat premium dengan ganache lembut.',
                    'harga' => 150000,
                    'gambar' => 'Kue/chocolate_cake.png',
                    'kategori' => (object) ['nama_kategori' => 'Birthday Cake']
                ],
                (object) [
                    'id' => 7,
                    'nama_produk' => 'Vanilla Chocolate',
                    'deskripsi' => 'Kue spesial dengan topping buah segar.',
                    'harga' => 175000,
                    'gambar' => 'Kue/vanilla_chocolate_cupcake.png',
                    'kategori' => (object) ['nama_kategori' => 'Birthday Cake']
                ],
               
                (object) [
                    'id' => 11,
                    'nama_produk' => 'Palm Cheese',
                    'deskripsi' => 'Cookies dengan choco chip yang renyah.',
                    'harga' => 45000,
                    'gambar' => 'Cookies/Palm_cheese.png',
                    'kategori' => (object) ['nama_kategori' => 'Kue Kering']
                ],

             (object) [
                    'id' => 13,
                    'nama_produk' => 'Nuttela Cookies',
                    'deskripsi' => 'Cookies dengan choco chip yang renyah.',
                    'harga' => 45000,
                    'gambar' => 'Cookies/Nutella_Cookies.png',
                    'kategori' => (object) ['nama_kategori' => 'Kue Kering']
                ],
                (object) [
                    'id' => 12,
                    'nama_produk' => 'Puding Coklat',
                    'deskripsi' => 'Puding Coklat dengan rasa coklat yang kaya.',
                    'harga' => 25000,
                    'gambar' => 'Kue/puding_coklat.png',
                    'kategori' => (object) ['nama_kategori' => 'Pastry']
                ],
                (object) [
                    'id' => 14,
                    'nama_produk' => 'Puding Cake',
                    'deskripsi' => 'Puding Cake dengan rasa coklat yang kaya.',
                    'harga' => 25000,
                    'gambar' => 'Kue/Pudingcake_1.png',
                    'kategori' => (object) ['nama_kategori' => 'Birthday Cake']
                ],
                (object) [
                    'id' => 15,
                    'nama_produk' => 'Florentine Cookies',
                    'deskripsi' => 'cookies aneka kacang.',
                    'harga' => 25000,
                    'gambar' => 'Cookies/Florentine_Cookies.png',
                    'kategori' => (object) ['nama_kategori' => 'Kue Kering']
                ],
            ]);
        }

        // Kategori: Birthday Cake
        $birthdayCakes = collect($produks)->filter(function ($produk) {
            $kategori = strtolower($produk->kategori->nama_kategori ?? '');
            $namaProduk = strtolower($produk->nama_produk ?? '');
            return str_contains($kategori, 'ulang tahun')
                || str_contains($kategori, 'birthday')
                || str_contains($kategori, 'birthday cake')
                || str_contains($namaProduk, 'birthday')
                || str_contains($namaProduk, 'tart');
        });

        // Kategori: Cookies / Kue Kering
        $cookies = collect($produks)->filter(function ($produk) {
            $kategori = strtolower($produk->kategori->nama_kategori ?? '');
            $namaProduk = strtolower($produk->nama_produk ?? '');
            return str_contains($kategori, 'kering')
                || str_contains($kategori, 'cookie')
                || str_contains($kategori, 'cookies')
                || str_contains($namaProduk, 'cookie')
                || str_contains($namaProduk, 'cookies');
        });

        // Kategori: Pastry & Croissant
        $pastries = collect($produks)->filter(function ($produk) {
            $kategori = strtolower($produk->kategori->nama_kategori ?? '');
            $namaProduk = strtolower($produk->nama_produk ?? '');
            return str_contains($kategori, 'basah')
                || str_contains($kategori, 'pastry')
                || str_contains($kategori, 'croissant')
                || str_contains($kategori, 'cupcake')
                || str_contains($namaProduk, 'croissant')
                || str_contains($namaProduk, 'cupcake')
                || str_contains($namaProduk, 'brownis')
                || str_contains($namaProduk, 'cheesecake')
                || str_contains($namaProduk, 'brownie')
                || str_contains($namaProduk, 'melted');
        });

        // Menu Lain (yang tidak masuk ke kategori di atas)
        $assignedIds = $birthdayCakes->pluck('id')
            ->merge($cookies->pluck('id'))
            ->merge($pastries->pluck('id'))
            ->unique();

        $menuLain = collect($produks)->filter(function ($produk) use ($assignedIds) {
            return !$assignedIds->contains($produk->id);
        });

        // Kelompokkan menu
        $groupedMenus = [
            'Birthday Cake' => $birthdayCakes,
            'Cookies' => $cookies,
            'Pastry & Croissant' => $pastries,
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

        <!-- Konten per kategori -->
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
                                // Tentukan path gambar
                                if($produk->gambar && !str_starts_with($produk->gambar, 'http')) {
                                    $imageUrl = asset('assets/img_produk/' . ltrim($produk->gambar, '/'));
                                } elseif($produk->gambar && str_starts_with($produk->gambar, 'http')) {
                                    $imageUrl = $produk->gambar;
                                } else {
                                    $imageUrl = 'https://picsum.photos/seed/' . $produk->id . '/300/200';
                                }
                            @endphp

                            <div class="menu-card" style="background: #fff; border-radius: 15px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); transition: transform 0.3s;">
                                <img src="{{ $imageUrl }}" alt="{{ $produk->nama_produk }}" style="width: 100%; height: 180px; object-fit: cover;" onerror="this.src='https://picsum.photos/300/200'">
                                <div class="menu-info" style="padding: 15px; text-align: center;">
                                    <h3 style="font-size: 16px; color: #6d4c41; margin-bottom: 8px; min-height: 40px;">{{ $produk->nama_produk }}</h3>
                                    <p style="font-size: 12px; color: #888; margin-bottom: 10px; min-height: 36px;">{{ $produk->deskripsi ?: 'Deskripsi produk belum tersedia.' }}</p>
                                    <span class="price" style="font-size: 14px; font-weight: bold; color: #f06292; margin-bottom: 10px; display: block;">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                                    <a href="#" class="btn-order" style="display: inline-block; background-color: #fce4ec; color: #f06292; padding: 6px 15px; border-radius: 20px; text-decoration: none; font-weight: 600; font-size: 11px; transition: all 0.3s;">Pesan Sekarang</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif
        @endforeach
    </section>

    <!-- Responsive CSS -->
    <style>
        .menu-card:hover {
            transform: translateY(-5px);
            transition: transform 0.3s;
        }
        
        .btn-order:hover {
            background-color: #f06292 !important;
            color: white !important;
        }
        
        .category-tab:hover {
            background-color: #f06292 !important;
            color: white !important;
            transform: translateY(-2px);
        }
        
        /* Smooth scroll */
        html {
            scroll-behavior: smooth;
        }
        
        /* Responsive Breakpoints */
        @media (max-width: 1200px) {
            .menu-grid {
                grid-template-columns: repeat(4, 1fr) !important;
            }
        }
        
        @media (max-width: 992px) {
            .menu-grid {
                grid-template-columns: repeat(3, 1fr) !important;
            }
        }
        
        @media (max-width: 768px) {
            .menu-grid {
                grid-template-columns: repeat(2, 1fr) !important;
            }
        }
        
        @media (max-width: 480px) {
            .menu-grid {
                grid-template-columns: 1fr !important;
            }
        }
    </style>

    <!-- Optional: JavaScript untuk active tab saat scroll -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
                    tab.classList.remove('active');
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
        });
    </script>
@endsection