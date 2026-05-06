# Evaluasi UX & Fitur Proyek E-Commerce Anis Bakery

Berdasarkan analisis pada *source code* (khususnya tampilan depan seperti `home.blade.php`) dan dokumen perencanaan proyek yang ada, berikut adalah evaluasi mendalam untuk menjadikan situs web ini memiliki **User Experience (UX)** yang luar biasa dan daftar fitur yang wajib segera dikerjakan.

---

## 🎨 1. Evaluasi User Experience (UX) & Tampilan (UI)

### ✅ Yang Sudah Sangat Bagus (Pertahankan!)
*   **Desain Visual Premium:** Penggunaan warna gradien (*gradient*), elemen melayang (*floating elements*), dan animasi mikro (*micro-animations*) di Beranda membuat situs web terasa hidup, modern, dan sangat premium.
*   **Aksesibilitas Aksi:** Adanya tombol interaktif seperti "Tambah ke Keranjang" dan "Pesan Sekarang (WhatsApp)" langsung dari *Modal Preview* sangat memudahkan pelanggan (*seamless experience*).

### 🚧 Yang Perlu Ditingkatkan (Area Perbaikan UX)
1.  **Pemisahan CSS dan JavaScript:** Saat ini, file `home.blade.php` memiliki banyak sekali CSS *inline* dan JavaScript di dalam tag `<style>` dan `<script>`. 
    *   *Solusi:* Pindahkan *styling* ini ke file `public/css/app.css` atau *Tailwind config* agar halaman memuat lebih cepat (kinerja web memengaruhi kenyamanan pengguna).
2.  **Keterbatasan Keranjang Belanja (Sistem *LocalStorage*):** Skrip keranjang saat ini masih menggunakan `localStorage` peramban (*browser*).
    *   *Masalah UX:* Jika pelanggan berpindah dari HP ke Laptop, keranjang belanja mereka akan kosong. 
    *   *Solusi:* Segera buat fitur Keranjang berbasis Basis Data (Tabel Database) yang terikat dengan akun pengguna setelah *login*.
3.  **Halaman Rincian Produk Khusus (SEO & UX):** Mengandalkan *Pop-up Modal* untuk melihat detail produk memang cepat, tetapi kurang baik untuk *SEO* dan berbagi tautan (*Share Link*).
    *   *Solusi:* Buat halaman khusus (misalnya: `/produk/cheesecake-coklat`) yang memiliki URL unik, menampilkan ulasan pelanggan, galeri foto lengkap, dan detail komposisi kue.

---

## ⚙️ 2. Daftar Fitur Kritis yang Harus Segera Dikerjakan (Backend)

Secara visual situs web ini sudah terlihat seperti *e-commerce*, namun "mesin" di belakangnya masih belum ada. Berikut prioritas fitur yang perlu dikembangkan:

### Prioritas 1: Sistem Autentikasi & Hak Akses (Wajib Ada Pertama)
Anda belum memiliki sistem *Login* dan *Register*.
*   **Tugas:** Instalasi Laravel Breeze atau UI.
*   **Tugas:** Tambahkan kolom `role` atau `is_admin` di tabel `users` untuk memisahkan halaman yang boleh dilihat Pelanggan dan Dasbor khusus Pemilik Toko.

### Prioritas 2: Manajemen Katalog Asli (Admin Panel)
Data produk di halaman Beranda saat ini masih ditulis manual (*hardcoded* di HTML dan Javascript).
*   **Tugas:** Buat antarmuka Dasbor Admin untuk Menambah, Mengubah, dan Menghapus data Kue (CRUD Produk) beserta unggah fotonya ke basis data.
*   **Tugas:** Hubungkan tabel `produks` tersebut ke halaman Beranda agar daftar kue muncul secara dinamis.

### Prioritas 3: Mesin Keranjang & Transaksi Pembayaran
Keranjang belanja belum bisa melakukan *Checkout* (pembayaran) yang tercatat.
*   **Tugas:** Buat tabel `pesanans` dan `detail_pesanans`.
*   **Tugas:** Buat halaman *Checkout* resmi di mana pengguna memasukkan alamat pengiriman.
*   **Tugas:** (Opsional tapi disarankan) Integrasi *Payment Gateway* seperti Midtrans agar pembeli bisa transfer bank/e-wallet langsung.

### Prioritas 4: Fitur Personalisasi SPK SAW
Sesuai dengan *roadmap* sebelumnya, fitur cerdas untuk merekomendasikan kue berdasarkan preferensi pengguna.
*   **Tugas:** Integrasikan algoritma SAW agar urutan produk di Beranda (*Landing Page*) berubah-ubah secara cerdas untuk setiap pengguna yang berbeda.

---

## 💡 Rekomendasi Langkah Selanjutnya

Jika Anda setuju dengan evaluasi di atas, saya menyarankan kita mulai melakukan proses *Coding* dari **Prioritas 1 (Sistem Autentikasi & Hak Akses Admin)**. Sistem keranjang, transaksi, dan algoritma SPK tidak akan berjalan sempurna tanpa adanya sistem *Login* pengguna. 

Apakah Anda ingin saya mulai membuatkan migrasi untuk *Role Admin* dan mengarahkan instalasi autentikasinya sekarang?
