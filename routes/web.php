<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\AuthController;

// Route Auth (Public)
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('google.callback');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Frontend Routes
Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('beranda');
    Route::get('/menu', [HomeController::class, 'menu'])->name('menu');
    Route::get('/menu/{id}', [HomeController::class, 'show'])->name('menu.show');
    Route::get('/our-story', [HomeController::class, 'ourStory'])->name('our_story');
    Route::get('/katering', [HomeController::class, 'katering'])->name('katering');
    
    // Route Keranjang
    Route::prefix('keranjang')->group(function () {
        Route::get('/', [\App\Http\Controllers\KeranjangController::class, 'index']);
        Route::post('/', [\App\Http\Controllers\KeranjangController::class, 'store']);
        Route::put('/{id}', [\App\Http\Controllers\KeranjangController::class, 'update']);
        Route::delete('/{id}', [\App\Http\Controllers\KeranjangController::class, 'destroy']);
        Route::delete('/clear', [\App\Http\Controllers\KeranjangController::class, 'clear']);
    });

    Route::post('/checkout', [\App\Http\Controllers\User\CheckoutController::class, 'store'])->name('user.checkout');
    Route::post('/checkout/success-local', [\App\Http\Controllers\User\CheckoutController::class, 'successLocal'])->name('user.checkout.success_local');
    Route::get('/pesanan-saya', [\App\Http\Controllers\User\UserOrderController::class, 'index'])->name('pesanan_saya');
    Route::get('/riwayat-pembelian', [\App\Http\Controllers\User\UserOrderController::class, 'riwayat'])->name('riwayat_pembelian');
    Route::get('/order-status-check', [\App\Http\Controllers\User\UserOrderController::class, 'checkStatus'])->name('order_status_check');
    Route::get('/notifikasi', [\App\Http\Controllers\User\UserOrderController::class, 'notifikasi'])->name('notifikasi');
    Route::get('/pesanan/{order}/nota', [\App\Http\Controllers\User\UserOrderController::class, 'nota'])->name('user.order.nota');
    Route::post('/pesanan/{order}/review', [\App\Http\Controllers\User\UserOrderController::class, 'storeReview'])->name('user.order.review');
    Route::post('/pesanan/{order}/complete', [\App\Http\Controllers\User\UserOrderController::class, 'completeOrder'])->name('user.order.complete');
    Route::post('/pesanan/{order}/cancel', [\App\Http\Controllers\User\UserOrderController::class, 'cancelOrder'])->name('user.order.cancel');
    
    Route::get('/profil', [\App\Http\Controllers\User\UserProfileController::class, 'index'])->name('profil.index');
    Route::post('/profil', [\App\Http\Controllers\User\UserProfileController::class, 'update'])->name('profil.update');
});

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
        Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->only(['index', 'destroy']);
        Route::resource('order', \App\Http\Controllers\Admin\OrderController::class)->only(['index', 'show']);
        Route::patch('order/{order}/status', [\App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('order.update_status');
        
        Route::get('/setting', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('setting.index');
    });
});

// Route Kurir Public
Route::get('/kurir/login', [\App\Http\Controllers\Kurir\AuthController::class, 'showLoginForm'])->name('kurir.login');
Route::post('/kurir/login', [\App\Http\Controllers\Kurir\AuthController::class, 'login'])->name('kurir.login.submit');

// Route Kurir Protected
Route::middleware(['auth', 'is_kurir'])->prefix('kurir')->name('kurir.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Kurir\DashboardController::class, 'index'])->name('dashboard');
    Route::post('/order/{order}/complete', [\App\Http\Controllers\Kurir\DashboardController::class, 'completeDelivery'])->name('complete');
    Route::post('/logout', [\App\Http\Controllers\Kurir\AuthController::class, 'logout'])->name('logout');
});