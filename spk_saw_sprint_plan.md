# Rencana Sprint: Implementasi SPK SAW Anis Bakery

Dokumen ini menjabarkan tahapan kerja (Sprint) untuk membangun fitur Personalisasi Rekomendasi Toko Kue menggunakan metode *Simple Additive Weighting* (SAW). Setiap sprint dirancang secara berurutan karena hasil dari satu sprint akan menjadi fondasi untuk sprint berikutnya.

---

## 🏃‍♂️ Sprint 1: Fondasi Database & Struktur Data
**Tujuan Utama:** Menyiapkan tempat penyimpanan untuk semua variabel angka yang dibutuhkan oleh perhitungan SAW. Metode matematis tidak bisa berjalan tanpa tabel dan kolom data yang tepat.

**Daftar Pekerjaan (Backlog):**
1. **Modifikasi Tabel `produks`:** Menambahkan kolom `rating_avg` (rata-rata rating), `terjual` (jumlah terjual), dan `is_promo` (status diskon) untuk Kriteria C2, C4, dan C5.
2. **Pembuatan Tabel `user_preferences`:** Membuat tabel baru untuk menyimpan prioritas dari masing-masing pelanggan (Skenario Personalisasi A).
3. **Penyempurnaan Relasi Riwayat Belanja:** Memastikan tabel `transactions` atau `order_items` berelasi dengan baik ke produk dan kategori, sehingga sistem bisa melacak kategori apa yang sering dibeli pengguna (Kriteria C3).

**Logika Keterkaitan:** 
Kita tidak bisa membuat rumus algoritma (Sprint 2) jika wadah datanya belum ada di *database*. Oleh karena itu, pengaturan *database* (Migration & Model Laravel) wajib diselesaikan paling pertama.

---

## 🏃‍♂️ Sprint 2: Membangun "Otak" Sistem (Backend Algoritma SAW)
**Tujuan Utama:** Membuat kode *logic* (Service/Controller di Laravel) yang bertugas mengambil data dari *database*, lalu menghitung skor kecocokan produk untuk masing-masing pelanggan yang sedang *login*.

**Daftar Pekerjaan (Backlog):**
1. **Pembuatan `SawService.php`:** Membuat *file* khusus yang akan memproses langkah-langkah matematika SAW.
2. **Pembuatan Matriks Keputusan (X):** Menarik data produk dan mengubah nilainya menjadi tabel angka.
3. **Normalisasi Matriks (R):** Membuat rumus untuk membagi angka berdasarkan sifat Kriteria (*Cost* untuk Harga, *Benefit* untuk Rating/Diskon).
4. **Perhitungan Bobot Personalisasi (W):** Mengalikan hasil matriks dengan "Bobot Preferensi" dari akun pelanggan yang sedang *login*.

**Logika Keterkaitan:**
Otak perhitungan (Sprint 2) membutuhkan data riil dari *database* (Sprint 1). Setelah otak ini selesai dibuat, dia belum bisa dilihat oleh siapa-siapa, karena tampilannya baru akan dibuat di Sprint 3 dan Sprint 4.

---

## 🏃‍♂️ Sprint 3: Antarmuka Admin (Admin Panel)
**Tujuan Utama:** Memberikan fasilitas kepada pemilik toko (Admin) untuk memasukkan dan mengontrol data produk beserta nilai kriteria awalnya.

**Daftar Pekerjaan (Backlog):**
1. **Pembaruan Form Tambah/Edit Produk:** Menambahkan *input* untuk promo, harga, dan kategori produk di halaman Admin.
2. **Dasbor Simulasi SPK (Opsional namun disarankan):** Membuat tabel di halaman Admin untuk melihat *Global Ranking* (ranking produk secara umum tanpa preferensi pengguna khusus).

**Logika Keterkaitan:**
Agar algoritma SAW di *Frontend* nanti bisa bekerja dengan optimal, Admin harus bisa memasukkan data produk dengan mudah melalui panel Admin.

---

## 🏃‍♂️ Sprint 4: Antarmuka Pengguna (Customer Frontend)
**Tujuan Utama:** Mengimplementasikan hasil perhitungan ke halaman utama situs web, sehingga pelanggan (pelanggan) bisa melihat rekomendasi produk yang khusus dibuat untuk mereka.

**Daftar Pekerjaan (Backlog):**
1. **Halaman "Atur Preferensi Anda":** Membuat form interaktif (misal dengan *slider* atau pilihan ganda) di halaman profil pelanggan untuk mengatur bobot kriteria mereka (Skenario A).
2. **Seksi "Rekomendasi Spesial Untukmu":** Merancang bagian khusus di Beranda (*Landing Page*) yang akan memanggil perhitungan dari `SawService.php` dan menampilkan produk dengan skor tertinggi.

**Logika Keterkaitan:**
Ini adalah tahap visualisasi. Tampilan "Rekomendasi Spesial" di Beranda baru bisa dibuat jika *backend* algoritma (Sprint 2) sudah berhasil mengembalikan urutan produk dengan benar.

---

## 🏃‍♂️ Sprint 5: Validasi & Pengujian Manual (Quality Assurance)
**Tujuan Utama:** Membuktikan bahwa kode Laravel yang dibuat tidak salah hitung. Sangat krusial jika ini merupakan proyek skripsi/tugas akhir.

**Daftar Pekerjaan (Backlog):**
1. **Perhitungan Manual Excel:** Mengambil 5 sampel produk dan 1 sampel *user*, lalu menghitung manual dengan rumus matematika SAW di Microsoft Excel.
2. **Pencocokan Data:** Membandingkan urutan dan nilai akhir (V) di Excel dengan nilai yang dikeluarkan oleh aplikasi Laravel. Keduanya harus identik.

**Logika Keterkaitan:**
Tahap akhir untuk memastikan seluruh sistem dari Sprint 1 hingga Sprint 4 berjalan dengan akurasi 100% tanpa ada kesalahan logika matematika (bug).
