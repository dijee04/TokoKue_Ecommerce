<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        Kategori::create(['nama_kategori' => 'Kue Kering']);
        Kategori::create(['nama_kategori' => 'Kue Basah']);
        Kategori::create(['nama_kategori' => 'Dessert']);
        Kategori::create(['nama_kategori' => 'Kue Ulang Tahun']);
    }
}
