# Evaluasi Modul E-Commerce (Kekurangan & Perbaikan)

Berdasarkan pengecekan struktur kode dan arsip proyek saat ini, proyek E-Commerce ini masih berada di tahap sangat awal (fondasi dasar). Ada beberapa modul utama yang **belum ada (kurang)** atau **belum sesuai** jika mengacu pada kebutuhan sistem aplikasi *e-commerce* standar. 

Berikut adalah rincian fungsionalitas dan modul yang kurang atau salah dari proyek saat ini:

### 1. Sistem Autentikasi (Register/Login) dan Peran (Role) Belum Ada
* **Yang Kurang:** Saat ini belum ada pengontrol (*Controller*) atau rute (*Route*) untuk fitur *Login* dan *Register* pelanggan. Foldernya (`app/Http/Controllers/Auth`) belum terbentuk atau *framework* autentikasi standar (seperti Laravel Breeze/UI) belum dipasang.
* **Yang Salah / Perlu Diperbaiki:** Pada tabel basis data `users` (di file migrasi `2014...create_users_table.php`), **tidak ada kolom untuk membedakan antara Pelanggan dan Admin** (misalnya kolom `role` atau boolean `is_admin`). Akibatnya, sistem nantinya tidak bisa membatasi apakah pengguna yang masuk itu boleh mengakses Dasbor Admin atau tidak.

### 2. Modul Manajemen Admin (CRUD) Kosong
* **Yang Kurang:** Di dalam folder kontrol admin (`app/Http/Controllers/Admin`), saat ini baru ada `DashboardController` saja. Belum ada modul untuk mengelola pangkalan data utama, yaitu:
  * `KategoriController` (Admin) untuk Tambah/Ubah/Hapus data Kategori.
  * `ProdukController` (Admin) untuk Tambah/Ubah/Hapus data Produk beserta unggah gambarnya.
* Pada berkas pengaturan rute `web.php`, fungsionalitas Produk dan Kategori juga belum dicantumkan di rute terlindungi (`/admin`).

### 3. Modul Pesanan (Order) dan Transaksi Sepenuhnya Belum Ada
* **Yang Kurang:** Seluruh tulang punggung aplikasi belanja (*E-Commerce*) belum dibuat sama sekali. Anda sama sama sekali belum memiliki Modul (Tabel, Model, Controller) untuk:
  * **Tabel `pesanans` (Orders):** Untuk mencatat nota pesanan, total harga, status pembuatan, serta alamat pengiriman pelanggan.
  * **Tabel `detail_pesanans` (Order Details):** Untuk menyimpan rincian barang apa saja yang tercatat dalam satu resi/nota pesanan tersebut.

### 4. Modul Keranjang Belanja (Cart) Belum Ada
* **Yang Kurang:** Tidak ada modul/fungsionalitas untuk audiens memasukkan produk ke keranjang belanja sebelum melakukan pelunasan (bisa menggunakan memori sementara browser/Sesi atau menggunakan tabel database aseli `keranjangs`).

### 5. Frontend (Katalog) Belum Spesifik
* **Yang Kurang:** Di lingkup sistem depan untuk pembeli (*Frontend*), rancangan baru terbatas pada `HomeController` (rute `/` halaman utama). Belum ada fitur khusus untuk **Rincian Produk** (*Product Detail Page*), yakni halaman tempat pelanggan masuk dari beranda, mengklik sebuah kue, dan melihat deskripsi ukuran, komposisi beserta ulasannya.

---

**Prioritas Perbaikan (Langkah Selanjutnya):**
Berdasarkan Sprint Planning, perbaikan pertama yang direkomendasikan adalah menyelesaikan **Tugas TG-102** pada sisi sistem yaitu: 
1. Menambahkan kolom `role` ke migrasi `users`.
2. Melakukan instalasi kerangka paket otentikasi (seperti *Laravel Breeze*) untuk menyediakan alur masuk & pendaftaran.
