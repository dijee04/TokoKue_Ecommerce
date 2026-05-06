# Perencanaan Scrum & Backlog Produk: E-Commerce Anis Bakery (Versi Terpadu)

Dokumen ini merupakan pembaruan dari perencanaan sebelumnya, dengan menggabungkan evaluasi **UI/UX terbaru** dan fitur canggih **SPK SAW (Personalisasi)** ke dalam alur kerja pengembangan yang komprehensif.

## 1. Visi Produk
Membangun platform e-commerce toko kue yang tidak hanya memiliki tampilan visual premium, tetapi juga ditopang oleh sistem *backend* yang tangguh (keranjang basis data, autentikasi) dan diperkaya dengan kecerdasan buatan (Sistem Pendukung Keputusan / SAW) untuk memberikan rekomendasi produk yang sangat personal bagi setiap pelanggan.

---

## 2. Backlog Produk (Product Backlog)

### Epik 1: Autentikasi & Hak Akses (Prioritas Utama)
- **Cerita Pengguna 1.1:** Sebagai pelanggan, saya bisa mendaftar akun dan *login* dengan aman agar data keranjang dan riwayat pesanan saya tidak hilang.
- **Cerita Pengguna 1.2:** Sebagai Admin, saya memiliki hak akses (*Role*) khusus untuk masuk ke Dasbor Admin yang dilindungi dari akses publik.

### Epik 2: Tampilan Antarmuka (UI/UX) & Optimalisasi
- **Cerita Pengguna 2.1:** Sebagai pengembang, saya memisahkan CSS/JS yang menumpuk di `home.blade.php` ke file aset terpisah agar halaman memuat lebih cepat (Optimalisasi UX).
- **Cerita Pengguna 2.2:** Sebagai pengunjung, saya bisa mengklik gambar kue dan masuk ke **Halaman Rincian Produk Khusus** (bukan hanya *pop-up modal*) untuk melihat deskripsi lengkap dan kemudahan berbagi tautan (SEO-friendly).

### Epik 3: Manajemen Katalog & Admin (CRUD)
- **Cerita Pengguna 3.1:** Sebagai Admin, saya bisa menambah, mengubah, dan menghapus data Kue beserta fotonya melalui Dasbor Admin.
- **Cerita Pengguna 3.2:** Sebagai Admin, saya bisa mengisi variabel kriteria tambahan untuk sistem SAW (Harga, Diskon/Promo, Rating) secara langsung saat menambahkan produk baru.

### Epik 4: Pemesanan & Transaksi Resmi
- **Cerita Pengguna 4.1:** Sebagai pelanggan yang sudah *login*, keranjang belanja saya akan tersimpan ke **Basis Data (Database)**, sehingga saya tidak kehilangan barang belanjaan ketika berpindah perangkat.
- **Cerita Pengguna 4.2:** Sebagai pelanggan, saya bisa memproses *Checkout*, mengisi alamat, dan data tersebut akan tersimpan ke tabel Pesanan di sisi Admin.

### Epik 5: Sistem Personalisasi Cerdas (SPK SAW)
- **Cerita Pengguna 5.1:** Sebagai pelanggan, saya bisa mengatur "Preferensi Rasa & Budget" di halaman profil saya (Skenario Input Eksplisit).
- **Cerita Pengguna 5.2:** Sebagai pengunjung, saya akan melihat seksi "Rekomendasi Spesial Untukmu" di Beranda yang isinya diurutkan secara unik untuk saya, dihitung secara seketika (*real-time*) oleh algoritma *Simple Additive Weighting* (SAW).

---

## 3. Perencanaan Sprint Terbaru (Sprint Planning) 

Berikut adalah rincian tugas terpadu yang memadukan penyelesaian masalah sistem dasar dan inovasi SPK SAW.

### 🏃‍♂️ Sprint 1: Fondasi Sistem & Keamanan (Fokus Backend)
**Sasaran Sprint:** Menyiapkan struktur keamanan pengguna dan kerangka basis data yang siap menampung fitur *E-Commerce* maupun variabel SPK SAW.

| ID Tugas | Deskripsi Tugas & Kriteria Penerimaan | Evaluasi Upaya |
|---|---|:---:|
| **TG-101** | **Instalasi Autentikasi:** Memasang Laravel Breeze/UI untuk menyediakan fitur Login, Register, dan Profil Pengguna. | 5 |
| **TG-102** | **Hak Akses Admin:** Menambahkan kolom `role` di tabel `users` dan membuat *Middleware* khusus Admin. | 3 |
| **TG-103** | **Struktur Data SPK & Produk:** Mengubah tabel `produks` agar memiliki kolom untuk SAW (`rating_avg`, `terjual`, `is_promo`). Serta membuat tabel `user_preferences`. | 5 |

<br>

### 🏃‍♂️ Sprint 2: UI/UX & Manajemen Katalog 
**Sasaran Sprint:** Memperbaiki pengalaman pengguna di sisi visual serta melengkapi fasilitas Admin untuk mengelola jualan.

| ID Tugas | Deskripsi Tugas & Kriteria Penerimaan | Evaluasi Upaya |
|---|---|:---:|
| **TG-201** | **Refactoring CSS/JS:** Memindahkan skrip keranjang *LocalStorage* dan animasi CSS di Beranda ke dalam struktur yang lebih bersih (`app.js` & `app.css`). | 3 |
| **TG-202** | **Halaman Rincian Produk:** Membuat tampilan spesifik untuk URL `/produk/{id}` agar kue bisa dieksplorasi secara mendalam. | 5 |
| **TG-203** | **Dasbor Produk Admin (CRUD):** Membangun form bagi Admin untuk mengelola (Tambah/Ubah/Hapus) produk secara dinamis. Menghubungkan Beranda dengan data asli ini. | 8 |

<br>

### 🏃‍♂️ Sprint 3: Mesin Keranjang & Transaksi Resmi
**Sasaran Sprint:** Mengganti sistem keranjang *dummy* dengan sistem transaksi *e-commerce* sungguhan.

| ID Tugas | Deskripsi Tugas & Kriteria Penerimaan | Evaluasi Upaya |
|---|---|:---:|
| **TG-301** | **Keranjang Basis Data:** Membuat sistem `Cart` yang mengikat data pesanan ke `user_id` yang sedang *login*. | 8 |
| **TG-302** | **Logika Transaksi (Checkout):** Membuat tabel `pesanans` dan `detail_pesanans`, serta logika konfirmasi dari Keranjang ke Nota Pesanan. | 8 |
| **TG-303** | **Manajemen Pesanan Admin:** Membuat tabel di Dasbor Admin untuk melihat daftar orang yang sudah *checkout* dan mengubah status pengiriman. | 5 |

<br>

### 🏃‍♂️ Sprint 4: Mesin Kecerdasan Personalisasi (SPK SAW)
**Sasaran Sprint:** Membuat situs web menjadi "pintar" dengan mengimplementasikan algoritma pengambilan keputusan.

| ID Tugas | Deskripsi Tugas & Kriteria Penerimaan | Evaluasi Upaya |
|---|---|:---:|
| **TG-401** | **Form Preferensi Pengguna:** Membuat UI di halaman Profil Pelanggan untuk menyetel bobot preferensi (Misal: Kualitas vs Harga). | 3 |
| **TG-402** | **Backend Logic SAW (`SawService.php`):** Menulis rumus matematika SAW (Matriks Keputusan, Normalisasi, Perkalian Bobot) yang memproses seluruh produk. | 13 |
| **TG-403** | **Integrasi Visual SAW:** Me-render hasil `SawService.php` ke seksi "Rekomendasi Spesial Untukmu" di `home.blade.php` | 5 |

<br>

### 🏃‍♂️ Sprint 5: Validasi & Sentuhan Akhir
**Sasaran Sprint:** Uji coba (*Quality Assurance*) untuk menjamin semua fungsi berjalan bebas kutu (*bug-free*) dan nilai perhitungannya akurat.

| ID Tugas | Deskripsi Tugas & Kriteria Penerimaan | Evaluasi Upaya |
|---|---|:---:|
| **TG-501** | **Uji Perhitungan Manual:** Validasi perhitungan SAW Laravel dengan simulasi di Microsoft Excel. | 3 |
| **TG-502** | **Riwayat Pesanan Pelanggan:** Menampilkan portal riwayat belanja bagi pembeli (*User Dashboard*). | 3 |

***

### Langkah Pertama yang Disarankan:
Fokuslah pada **Sprint 1 (TG-101 & TG-102)**. Kita wajib mengamankan akun dan pembeda antara pelanggan/admin sebelum fitur transaksi dan SAW bisa dijalankan secara logis.
