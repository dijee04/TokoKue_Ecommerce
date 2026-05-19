<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class KurirUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Kurir Toko',
            'email' => 'kurir@tokokue.com',
            'password' => Hash::make('password'),
            'role' => 'kurir',
            'no_wa' => '081234567890',
            'alamat' => 'Kantor Kurir Toko Kue',
        ]);
    }
}
