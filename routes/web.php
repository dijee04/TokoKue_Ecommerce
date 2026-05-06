<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\AuthController;

// Route untuk User / Frontend
Route::get('/', [HomeController::class, 'index'])->name('beranda');
Route::get('/menu', [HomeController::class, 'menu'])->name('menu');
Route::get('/our-story', [HomeController::class, 'ourStory'])->name('our_story');
Route::get('/katering', [HomeController::class, 'katering'])->name('katering');
Route::post('/checkout', [\App\Http\Controllers\User\CheckoutController::class, 'process'])->name('checkout.process');

// Route Auth
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('google.callback');
Route::get('/dashboard', function () {
    return "Halaman Dashboard Toko Kue";
})->middleware('auth');
Route::post('/logout', [AuthController::class, 'logout']);

// Route Keranjang
Route::middleware('auth')->prefix('keranjang')->group(function () {
    Route::get('/', [\App\Http\Controllers\KeranjangController::class, 'index']);
    Route::post('/', [\App\Http\Controllers\KeranjangController::class, 'store']);
    Route::put('/{id}', [\App\Http\Controllers\KeranjangController::class, 'update']);
    Route::delete('/{id}', [\App\Http\Controllers\KeranjangController::class, 'destroy']);
    Route::delete('/clear', [\App\Http\Controllers\KeranjangController::class, 'clear']);
});

// Route Admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
});