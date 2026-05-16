<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        Setting::create([
            'wa_number' => '6281234567890',
            'bank_name' => 'BCA',
            'bank_account' => '1234567890',
            'bank_owner' => 'ANIS BAKERY',
            'dana_number' => '081234567890',
            'dana_owner' => 'ANIS BAKERY',
            'gopay_number' => '081234567890',
            'gopay_owner' => 'ANIS BAKERY',
        ]);
    }
}
