<?php

namespace App\Http\Controllers\Kurir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Tampilkan halaman profil kurir.
     */
    public function index()
    {
        $user = auth()->guard('kurir')->user();
        return view('kurir.profil', compact('user'));
    }

    /**
     * Update profil kurir.
     */
    public function update(Request $request)
    {
        $user = auth()->guard('kurir')->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'no_hp' => 'required|string|max:15',
            'kendaraan' => 'nullable|string|max:255',
            'plat_nomor' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        
        // Update data jika kolom ada di tabel users
        if (\Schema::hasColumn('users', 'no_wa')) {
            $user->no_wa = $request->no_hp;
        }
        if (\Schema::hasColumn('users', 'kendaraan')) {
            $user->kendaraan = $request->kendaraan;
        }
        if (\Schema::hasColumn('users', 'plat_nomor')) {
            $user->plat_nomor = $request->plat_nomor;
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('kurir.profil.index')->with('success', 'Profil berhasil diperbarui!');
    }
}
