<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// === PUBLIC ROUTES ===
Route::get('/', [PageController::class, 'welcome'])->name('welcome');
Route::get('/product/{id}', [PageController::class, 'productDetail'])->name('product.detail');
Route::get('/welcome', [PageController::class, 'welcome'])->name('landing');

// === GUEST ROUTES ===
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
});

// === AUTH ROUTES ===
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Halaman Utama Navigasi
    Route::get('/home', [PageController::class, 'home'])->name('home');
    Route::get('/collection', [PageController::class, 'collection'])->name('collection');
    Route::get('/search', [PageController::class, 'search'])->name('search');
    Route::get('/about', [PageController::class, 'about'])->name('about');
    Route::get('/contact', [PageController::class, 'contact'])->name('contact');

    // Fitur Keranjang Belanja
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product_id}', [CartController::class, 'store'])->name('cart.add');
    Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/delete/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

    // Fitur Checkout & Pembayaran Berhasil
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.store');
    Route::get('/checkout/success/{id}', [CheckoutController::class, 'success'])->name('checkout.success');

    // Fitur Profil & Status Transaksi (SUDAH DISINKRONKAN)
    // Fitur Profil & Status Transaksi
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::get('/dikemas', [ProfileController::class, 'dikemas'])->name('dikemas');
        Route::get('/dikirim', [ProfileController::class, 'dikirim'])->name('dikirim');
        Route::get('/dinilai', [ProfileController::class, 'dinilai'])->name('dinilai');
        Route::get('/voucher', [ProfileController::class, 'voucher'])->name('voucher');
    });
});
