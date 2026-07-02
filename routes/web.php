<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// === GUEST ROUTES (Halaman Publik / Belum Login) ===
Route::middleware('guest')->group(function () {
    // Halaman Awal Aplikasi
    Route::get('/', [PageController::class, 'welcome'])->name('welcome');

    // Autentikasi (Login & Register)
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});


// === AUTH ROUTES (Halaman Proteksi / Harus Login Dahulu) ===
Route::middleware('auth')->group(function () {

    // Keluar Aplikasi
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Beranda & Eksplorasi Produk
    Route::get('/home', [PageController::class, 'home'])->name('home');
    Route::get('/collection', [PageController::class, 'collection'])->name('collection');
    Route::get('/product/{id}', [PageController::class, 'productDetail'])->name('product.detail');
    Route::get('/search', [PageController::class, 'search'])->name('search');
    Route::get('/search2', [PageController::class, 'search2'])->name('search2');

    // Halaman Informasi Statis
    Route::get('/about', [PageController::class, 'about'])->name('about');
    Route::get('/contact', [PageController::class, 'contact'])->name('contact');

    // --- MANAJEMEN KERANJANG BELANJA (Cart) ---
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::put('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

    // --- PROSES TRANSAKSI (Checkout) ---
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');

    // --- RIWAYAT PESANAN & PEMBAYARAN (Order) ---
    Route::get('/order/{id}/payment', [OrderController::class, 'showPayment'])->name('order.payment');
    Route::post('/order/{id}/payment', [OrderController::class, 'confirmPayment'])->name('order.payment.confirm');

    // --- PROFIL PENGGUNA & STATUS PESANAN (Profile) ---
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::put('/update', [UserController::class, 'updateProfile'])->name('update');

        // Status Pengiriman Paket (Sesuai folder views/profile/)
        Route::get('/dikemas', [ProfileController::class, 'dikemas'])->name('dikemas');
        Route::get('/dikirim', [ProfileController::class, 'dikirim'])->name('dikirim');
        Route::get('/dinilai', [ProfileController::class, 'dinilai'])->name('dinilai');
    });

});
