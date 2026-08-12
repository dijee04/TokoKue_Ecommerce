# 🍰 Digitalisasi Sistem Pemasaran & Penjualan UMKM Dear Seana

<p center>
  <img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" />
  <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" />
  <img src="https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white" />
  <img src="https://img.shields.io/badge/Bootstrap-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white" />
  <img src="https://img.shields.io/badge/Midtrans-002855?style=for-the-badge&logo=cashapp&logoColor=white" />
</p>

---

> **🎓 Capstone Project Proyek Sistem Informasi (Semester 6 - 2026)**  
> **Program Studi Sistem Informasi | Fakultas Teknik dan Informatika**  
> **Universitas Bina Sarana Informatika**

---

## 📌 Ringkasan Proyek

**Dear Seana** adalah UMKM kuliner spesialis kue, pastry, dan makanan ringan premium yang berdiri sejak tahun 2017. Proyek ini hadir untuk mentransformasi alur pemasaran & penjualan konvensional (berbasis chat manual) menjadi platform **e-commerce terintegrasi berbasis web**.

### 🌟 Keunggulan Platform:
- 🎯 **Sistem Rekomendasi SPK (Simple Additive Weighting - SAW):** Memberikan saran menu kue yang paling relevan secara personal berdasarkan anggaran dan preferensi rasa pelanggan.
- 💳 **Gerbang Pembayaran Otomatis (Midtrans Sandbox):** Verifikasi transaksi dan konfirmasi pembayaran secara real-time.
- 👥 **Portal Operasional Multi-Role:** Akses khusus & terdedikasi untuk **Pelanggan**, **Admin**, dan **Kurir Internal**.

---

## 🚀 Fitur Utama

<table>
  <tr>
    <td width="33%" valign="top">
      <h3>🛒 Pelanggan</h3>
      <ul>
        <li><b>Autentikasi & Profil:</b> Registrasi, Login (support Google OAuth), & set preferensi SAW.</li>
        <li><b>Rekomendasi Cerdas:</b> Perhitungan kecocokan produk real-time berbasis kriteria pengguna.</li>
        <li><b>E-Commerce Flow:</b> Katalog interaktif, detail varian, keranjang belanja dinamis, & kalkulasi ongkir.</li>
        <li><b>Checkout & Tracking:</b> Integrasi Midtrans Snap API & lacak status pesanan.</li>
        <li><b>Ulasan & Rating:</b> Penilaian bintang & unggah foto ulasan produk.</li>
      </ul>
    </td>
    <td width="33%" valign="top">
      <h3>🛡️ Admin / Toko</h3>
      <ul>
        <li><b>Dashboard Analitik:</b> Insight total pendapatan, jumlah pesanan baru, & grafik harian/bulanan.</li>
        <li><b>Kelola Katalog (CRUD):</b> Manajemen varian kue, harga, stok real-time, & unggah media.</li>
        <li><b>Atur Bobot SAW:</b> Konfigurasi kriteria SPK rekomendasi.</li>
        <li><b>Manajemen Pesanan:</b> Verifikasi pembayaran, update status, & penugasan kurir.</li>
        <li><b>Laporan Keuangan:</b> Ekspor laporan transaksi otomatis.</li>
      </ul>
    </td>
    <td width="33%" valign="top">
      <h3>🛵 Kurir Logistik</h3>
      <ul>
        <li><b>Dashboard Tugas:</b> List antrean pesanan yang siap dikirim.</li>
        <li><b>Navigasi Alamat:</b> Integrasi peta interaktif & detail rute pengantaran.</li>
        <li><b>Bukti Pengantaran:</b> Konfirmasi selesai & unggah foto bukti serah terima.</li>
        <li><b>Riwayat Tugas:</b> Tracking riwayat pengiriman yang diselesaikan.</li>
      </ul>
    </td>
  </tr>
</table>

---

## 🛠️ Teknologi & Tools

```text
  Backend Framework  : Laravel (PHP 8.x)
  Database           : MySQL / MariaDB (12 Tabel Strukturnya)
  Frontend Stack     : HTML5, CSS3, JavaScript, Bootstrap, Blade
  Payment Gateway    : Midtrans Snap API (Sandbox Mode)
  Maps & Navigation  : Leaflet JS / OpenStreetMap / Google Maps API
  Methodology        : Agile Scrum Framework (6 Sprints)
  Project Tools      : Jira, GitHub, WhatsApp
```

---

## 🏗️ Metodologi Pengembangan (Agile Scrum)

Proyek ini dikembangkan melalui siklus **6 Sprint** yang terstruktur secara bertahap:

```text
 ┌─────────────────┐     ┌──────────────────┐     ┌──────────────────┐
 │ 📌 Inception    │ ──> │ 🔑 Sprint 1      │ ──> │ 🛒 Sprint 2      │
 │    & Backlog    │     │    Auth & DB     │     │    Katalog & Cart│
 └─────────────────┘     └──────────────────┘     └──────────────────┘
                                                           │
 ┌─────────────────┐     ┌──────────────────┐              │
 │ 🚀 Sprint 6     │ <── │ 🎯 Sprint 5      │ <────────────┘
 │    QA & Release │     │    Algoritma SAW │
 └─────────────────┘     └──────────────────┘
         ▲                        │
         │                        ▼
 ┌──────────────────────────────────────────┐
 │ 💳 Sprint 3 & 4: Panel Admin, Midtrans,  │
 │    & Portal Kurir Logistik               │
 └──────────────────────────────────────────┘
```

---

## 📐 Arsitektur & Database

Platform ini menggunakan arsitektur Client-Server berbasis pola **MVC (Model-View-Controller)** Laravel dengan **12 Tabel Basis Data Utama**:
- 👤 `users` (Role: Admin, Customer, Kurir)
- 🎂 `kategoris` & `produks`
- 🛒 `keranjangs`, `orders`, & `order_items`
- ⭐ `reviews`
- 🚚 `kurir`
- ⚙️ `settings` & `saw_criterias`

---

## ⚡ Panduan Instalasi Lokal

```bash
# 1. Clone Repositori
git clone https://github.com/username/dearseana-ecommerce.git
cd dearseana-ecommerce

# 2. Install Dependensi PHP & Frontend
composer install
npm install && npm run dev

# 3. Konfigurasi Environment (.env)
cp .env.example .env
php artisan key:generate

# 4. Migrasi Database & Seeder
php artisan migrate --seed
php artisan storage:link

# 5. Jalankan Local Development Server
php artisan serve
```

---

## 👥 Tim Pengembang (Kelompok 3)

| NIM | Nama Member | Peran | Focus Area |
| :---: | :--- | :--- | :--- |
| **19231351** | **Alya Dijayanti** | **Scrum Master / Lead** | UI/UX Design, Project Coordinator & Docs |
| **19232110** | **Rangga Hapsendy Simarmata** | Tim Pengembang | Backend Developer |
| **19232151** | **Ahmad Bayu Saputra** | Tim Pengembang | Backend Developer |
| **19231498** | **Fathia Kaila Azizah** | Tim Pengembang | Frontend Developer |
| **19231760** | **Faiz Purnomo Adi** | Tim Pengembang | Quality Assurance & Testing |

* **Dosen Pengampu:** Ahmad Al Kaafi, M.Kom.
* **Mitra Usaha:** UMKM Dear Seana (Owner: Annisa Rahmawati)

---

## 📜 Pengesahan
Dikembangkan dan disahkan sebagai bagian dari **Capstone Project Mata Kuliah Proyek Sistem Informasi**, Program Studi Sistem Informasi, Universitas Bina Sarana Informatika (2026).
