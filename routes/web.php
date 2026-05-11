<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;

// Route untuk User / Frontend
Route::get('/', [HomeController::class, 'index'])->name('beranda');
Route::get('/menu', [HomeController::class, 'menu'])->name('menu');
Route::get('/our-story', [HomeController::class, 'ourStory'])->name('our_story');
Route::get('/katering', [HomeController::class, 'katering'])->name('katering');

Route::post('/checkout', [\App\Http\Controllers\User\CheckoutController::class, 'store'])->name('user.checkout');

// Route Admin
Route::prefix('admin')->name('admin.')->group(function () {
    // Auth Routes
    Route::get('/login', [\App\Http\Controllers\Admin\AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [\App\Http\Controllers\Admin\AuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [\App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');

    // Protected Routes
    Route::middleware(['auth', 'is_admin'])->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        Route::resource('kategori', \App\Http\Controllers\Admin\KategoriController::class);
        Route::resource('produk', \App\Http\Controllers\Admin\ProdukController::class);
        Route::resource('order', \App\Http\Controllers\Admin\OrderController::class)->only(['index', 'show']);
        Route::patch('order/{order}/status', [\App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('order.update_status');
        
        Route::get('/setting', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('setting.index');
        Route::put('/setting', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('setting.update');
    });
});