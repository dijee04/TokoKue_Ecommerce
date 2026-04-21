<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\AuthController;

Route::get('/', [HomeController::class, 'index'])->name('beranda');
Route::get('/menu', [HomeController::class, 'menu'])->name('menu');
Route::get('/our-story', [HomeController::class, 'ourStory'])->name('our_story');
Route::get('/katering', [HomeController::class, 'katering'])->name('katering');
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/dashboard', function () {
    return "Halaman Dashboard Toko Kue";
})->middleware('auth');
Route::post('/logout', [AuthController::class, 'logout']);
// Admin Routes Group
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
});
