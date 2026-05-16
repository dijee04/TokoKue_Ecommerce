<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        if (!$setting) {
            $setting = Setting::create([
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
        return view('admin.setting.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'wa_number' => 'required|string',
            'bank_name' => 'required|string',
            'bank_account' => 'required|string',
            'bank_owner' => 'required|string',
            'dana_number' => 'required|string',
            'dana_owner' => 'required|string',
            'gopay_number' => 'required|string',
            'gopay_owner' => 'required|string',
        ]);

        $setting = Setting::first();
        $setting->update($request->all());

        return back()->with('success', 'Pengaturan berhasil diperbarui!');
    }
}
