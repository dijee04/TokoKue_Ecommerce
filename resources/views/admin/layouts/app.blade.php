<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Anis Bakery</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Outfit:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Admin Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}">
</head>
<body>

    <!-- Sidebar -->
    <aside class="admin-sidebar">
        <div class="sidebar-brand">
            <i class="fas fa-cake-candles"></i>
            <span>AdminPanel</span>
        </div>
        
        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-chart-pie"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('admin.produk.index') }}" class="{{ request()->routeIs('admin.produk.*') ? 'active' : '' }}">
                    <i class="fas fa-box-open"></i> Kelola Produk
                </a>
            </li>
            <li>
                <a href="{{ route('admin.kategori.index') }}" class="{{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}">
                    <i class="fas fa-tags"></i> Kategori
                </a>
            </li>
            <li>
                <a href="{{ route('admin.order.index') }}" class="{{ request()->routeIs('admin.order.*') ? 'active' : '' }}">
                    <i class="fas fa-shopping-cart"></i> Pesanan
                </a>
            </li>
            <li>
                <a href="{{ route('admin.setting.index') }}" class="{{ request()->routeIs('admin.setting.*') ? 'active' : '' }}">
                    <i class="fas fa-cog"></i> Pengaturan Web
                </a>
            </li>
            <li style="margin-top: 30px; padding-top: 15px; border-top: 1px solid rgba(255,255,255,0.1);">
                <a href="{{ url('/') }}" target="_blank">
                    <i class="fas fa-external-link-alt"></i> Lihat Website
                </a>
            </li>
        </ul>
    </aside>

    <!-- Main Content -->
    <main class="admin-main">
        <!-- Navbar -->
        <nav class="admin-navbar">
            <div class="navbar-title">
                <h2 style="margin: 0; font-size: 18px; color: var(--text-muted);">Sweet & Savory Seana</h2>
            </div>
            <div class="navbar-user">
                <span><i class="fas fa-user-circle"></i> Halo, Admin</span>
                <form action="{{ route('admin.logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="fas fa-sign-out-alt"></i> Keluar
                    </button>
                </form>
            </div>
        </nav>

        <!-- Content Area -->
        <div class="content-wrapper">
            @yield('content')
        </div>
    </main>

</body>
</html>
