<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('user.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'no_wa' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
        ]);

        $user = auth()->user();
        $user->update([
            'name' => $request->name,
            'no_wa' => $request->no_wa,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('profil.index')->with('success', 'Profil berhasil diperbarui!');
    }
}
