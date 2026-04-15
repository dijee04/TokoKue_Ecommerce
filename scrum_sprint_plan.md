# Perencanaan Scrum & Backlog Produk: Sistem E-Commerce Toko Kue

## 1. Visi Produk
Membangun platform e-commerce toko kue yang memiliki tampilan elegan dan premium, memberikan kemudahan bagi pelanggan dalam memilih dan memesan kue, serta menyediakan dasbor manajemen yang komprehensif untuk pengelola toko.

## 2. Backlog Produk (Product Backlog)
Ini adalah daftar fitur utama yang harus dibangun, dipecah menjadi beberapa "Epik" (Epic) dan "Cerita Pengguna" (User Story).

### Epik 1: Tampilan Antarmuka (UI/UX) & Beranda
- **Cerita Pengguna 1.1:** Sebagai pengunjung, saya ingin melihat halaman utama dengan desain menawan (termasuk Hero Section dan bagian Keunggulan Toko), agar saya merasa yakin dengan kualitas premium toko ini.
- **Cerita Pengguna 1.2:** Sebagai pengunjung, saya ingin website merespons dengan baik saat dibuka di perangkat pita seluler atau komputer (responsif).

### Epik 2: Manajemen Pengguna & Pendaftaran
- **Cerita Pengguna 2.1:** Sebagai pelanggan, saya dapat mendaftar dan masuk ke dalam sistem, agar saya bisa melacak riwayat pesanan saya.
- **Cerita Pengguna 2.2:** Sebagai pengelola toko (Admin), saya bisa masuk secara khusus ke dalam portal Dasbor Admin untuk mengontrol keseluruhan toko.

### Epik 3: Katalog Produk
- **Cerita Pengguna 3.1:** Sebagai pengunjung, saya bisa melihat daftar seluruh produk dan menyaringnya berdasarkan Kategori (misal: Roti, Kue Kering, Kue Ulang Tahun).
- **Cerita Pengguna 3.2:** Sebagai Admin, saya bisa menambah, mengubah, atau menghapus data produk (termasuk foto produk, harga, stok, dan deskripsi).

### Epik 4: Pemesanan & Keranjang Belanja (Checkout)
- **Cerita Pengguna 4.1:** Sebagai pelanggan, saya bisa memasukkan produk ke dalam Keranjang Belanja dan menyesuaikan jumlah kuantitas pesanan.
- **Cerita Pengguna 4.2:** Sebagai pelanggan, saya bisa memproses pesanan (menuju halaman Checkout), mengisi alamat pengiriman, dan mengetahui rincian total pembayaran.

### Epik 5: Manajemen Pesanan
- **Cerita Pengguna 5.1:** Sebagai pelanggan, saya ingin bisa melihat riwayat pesanan dan status paket pesanan saya pada dasbor akun saya.
- **Cerita Pengguna 5.2:** Sebagai Admin, saya bisa merubah status pesanan pelanggan (contoh: 'Diproses', 'Dikirim', 'Selesai'), agar sistem pencatatan inventaris tetap selaras.

---

## 3. Perencanaan Sprint (Sprint Planning) 

Berikut adalah rincian tugas untuk 2 Sprint pertama (dengan asumsi setiap Sprint memiliki durasi 2 Minggu).

### Sprint 1
**Sasaran Sprint (Sprint Goal):** Menyelesaikan fondasi struktur awal, pangkalan data (database), UI bagian depan (Beranda), dan kerangka manajemen produk.

| ID Tugas | Target Cerita | Deskripsi Tugas & Kriteria Penerimaan | Evaluasi Upaya (Story Points) |
|---|---|---|:---:|
| **TG-101** | CP 1.1 | **Mendesain UI Beranda:** Menerapkan HTML/CSS modern (menggunakan Laravel Blade) untuk halaman utama beserta komponen Hero dan fitur 'Keunggulan Toko'. | 5 |
| **TG-102** | CP 2.1 & 2.2 | **Pengaturan Autentikasi:** Membuat rute pendaftaran pelanggan, rute login, dan menyetel lapisan perlindungan (Middleware) khusus Admin. | 3 |
| **TG-103** | CP 3.2 | **Basis Data Produk:** Membuat Model, Migration, dan Seeder untuk entitas `Kategori` dan `Produk`. | 3 |
| **TG-104** | CP 3.2 | **Dasbor Admin (Produk):** Menyiapkan antarmuka formulir (Admin) untuk proses Tambah, Ubah, Hapus (CRUD) pada katalog produk. | 8 |
| **TG-105** | CP 3.1 | **Menampilkan Katalog Depan:** Menghubungkan logika Controller dengan basis data untuk memunculkan daftar produk teratas pada halaman depan pelanggan. | 5 |

<br>

### Sprint 2
**Sasaran Sprint (Sprint Goal):** Menyelesaikan siklus proses pembelian oleh pengguna, mencakup keranjang belanja hingga konfirmasi pesanan (checkout).

| ID Tugas | Target Cerita | Deskripsi Tugas & Kriteria Penerimaan | Evaluasi Upaya (Story Points) |
|---|---|---|:---:|
| **TG-201** | CP 4.1 | **Fitur Keranjang Belanja:** Membangun antarmuka Keranjang dan menjalankan fungsi simpan pesanan sementara (menggunakan metode sesi/ session agar berjalan mulus). | 5 |
| **TG-202** | CP 4.2 | **Halaman Pembayaran (Checkout):** Menampilkan rincian pesanan dan total harga, serta membuat formulir data tujuan pelanggan. | 8 |
| **TG-203** | CP 4.2 | **Logika Transaksi (Backend):** Membuat logika untuk menyimpan data Transaksi secara permanen ke pangkalan data pesanan sesudah formulir checkout disahkan. | 5 |
| **TG-204** | CP 5.2 | **Dasbor Admin (Pesanan):** Membuat halaman tabel di dalam Dasbor Admin untuk melihat semua pesanan yang masuk dan mengganti status pesanan tersebut. | 5 |
| **TG-205** | CP 5.1 | **Riwayat Pelanggan:** Membuat antarmuka portal untuk Pelanggan (sisi klien) guna melacak riwayat pesanan dari masa lalu. | 3 |

***

### Saran Tambahan Pelaksanaan Scrum

Untuk memastikan metodologi ini berjalan lancar di tim pengembangan Anda, Anda dapat melakukan kegiatan berikut secara rutin:
1. **Scrum Harian (Daily Scrum):** Lakukan pertemuan singkat (maksimal 15 menit) setiap pagi untuk membahas: "Apa yang dikerjakan kemarin, apa masalahnya, dan apa yang dikerjakan hari ini."
2. **Ulasan Sprint (Sprint Review):** Di setiap akhir masa Sprint, adakan ulasan untuk menunjukkan demo fungsionalitas fitur kepada para pemangku kepentingan (stakeholders).
3. **Retrospektif Sprint (Sprint Retrospective):** Berdiskusi terkait proses alur kerja apa saja yang sudah berjalan bagus dan bagian mana yang perlu diperbaiki untuk melancarkan eksekusi pada Sprint berikutnya.
