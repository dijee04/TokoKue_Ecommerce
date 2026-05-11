<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;
use App\Models\Setting;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        try {
            $setting = Setting::first();
            View::share('global_setting', $setting);
        } catch (\Exception $e) {
            // Abaikan jika tabel settings belum ada saat proses instalasi awal
        }
    }
}
