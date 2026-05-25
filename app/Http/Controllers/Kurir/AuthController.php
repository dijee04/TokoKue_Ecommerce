<?php

namespace App\Http\Controllers\Kurir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        // If already logged in as courier, go straight to dashboard
        if (Auth::guard('kurir')->check() && Auth::guard('kurir')->user()->role === 'kurir') {
            return redirect()->route('kurir.dashboard');
        }
        return view('kurir.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::guard('kurir')->attempt($credentials)) {
            if (Auth::guard('kurir')->user()->role === 'kurir') {
                $request->session()->regenerate();
                return redirect()->route('kurir.dashboard');
            }

            // Not a courier: log out immediately and show error
            Auth::guard('kurir')->logout();
            return back()->withErrors([
                'email' => 'Anda bukan kurir.',
            ])->withInput($request->only('email'));
        }

        return back()->withErrors([
            'email' => 'Kredensial tidak cocok dengan data kami.',
        ])->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::guard('kurir')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('kurir.login');
    }
}
