<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        Kategori::create(['nama_kategori' => 'Cake']);
        Kategori::create(['nama_kategori' => 'Cookies']);
    }
}
