<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Produk;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        Produk::create([
            'nama_produk' => 'Dark Chocolate Bliss',
            'deskripsi' => 'Mahakarya cokelat berlapis ganda yang terlahir dari perpaduan dark chocolate Belgia murni dan krim ganache sutra yang luar biasa kaya. Teksturnya yang padat namun melumer manja di lidah siap membius pecinta cokelat sejati.',
            'harga' => 150000,
            'kategori_id' => 3,
            'gambar' => 'assets/img_produk/chocolate_cake.png'
        ]);

        Produk::create([
            'nama_produk' => 'Cupcake Vanilla Drizzle',
            'deskripsi' => 'Kue mungil yang menawan hati. Bolu spons vanilla Madagaskar panggang yang selembut kapas, dimahkotai dengan krim pekat dan pusaran lelehan dark chocolate elegan. Teman manis yang tepat untuk memanjakan diri senja ini.',
            'harga' => 25000,
            'kategori_id' => 2,
            'gambar' => 'assets/img_produk/vanilla_chocolate_cupcake.png'
        ]);

        Produk::create([
            'nama_produk' => 'Celebration Tart',
            'deskripsi' => 'Simbol perayaan yang sesungguhnya! Tart elegan ini merangkul kelezatan cokelat putih yang sangat creamy di atas lapisan dasar biskuit almond renyah. Mahkota manis untuk hari bersejarah Anda bersama orang terkasih.',
            'harga' => 250000,
            'kategori_id' => 4,
            'gambar' => 'assets/img_produk/birthday_tart.png'
        ]);

        Produk::create([
            'nama_produk' => 'Fudgy Melted Brownie',
            'deskripsi' => 'Persegi kecil dari surga! Kami mengunci kerak luar tipis yang begitu renyah (crusty) untuk menyembunyikan inti cokelat pekat basah (fudgy) yang sangat lumer di dalam. Sebuah godaan gurih manis yang tak bisa diabaikan.',
            'harga' => 65000,
            'kategori_id' => 1,
            'gambar' => 'assets/img_produk/melted_brownie.png'
        ]);
    }
}
