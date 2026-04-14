<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Anis Bakery</title>
    <!-- Anda bisa tambahkan AdminLTE, Bootstrap, atau Tailwind disini nantinya -->
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; background-color: #f4f6f9; color: #333; }
        .sidebar { width: 250px; background-color: #83513E; color: white; position: fixed; top: 0; bottom: 0; padding: 20px 0; }
        .sidebar h2 { text-align: center; margin-bottom: 30px; font-weight: normal; }
        .sidebar a { display: block; color: white; padding: 15px 20px; text-decoration: none; border-bottom: 1px solid #714635; }
        .sidebar a:hover { background-color: #714635; }
        .main-content { margin-left: 250px; padding: 20px; }
        .navbar { background-color: white; padding: 15px 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); margin-bottom: 20px; display: flex; justify-content: space-between; }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2>Admin Panel</h2>
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="#">Kelola Produk</a>
        <a href="#">Kategori</a>
        <a href="#">Pesanan</a>
        <a href="{{ url('/') }}">Kembali ke Web</a>
    </div>

    <div class="main-content">
        <div class="navbar">
            <div>Selamat Datang, Admin</div>
            <div>Logout</div>
        </div>

        @yield('content')
    </div>

</body>
</html>
