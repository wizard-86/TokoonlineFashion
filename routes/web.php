<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// === PUBLIC ROUTES (Bisa diakses siapa saja tanpa login) ===
Route::get('/', [PageController::class, 'welcome'])->name('welcome');
Route::get('/product/{id}', [PageController::class, 'productDetail'])->name('product.detail');

// === GUEST ROUTES (Hanya untuk yang BELUM login) ===
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
});

// === AUTH ROUTES (Hanya untuk yang SUDAH login) ===
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/home', [PageController::class, 'home'])->name('home');
    Route::get('/collection', [PageController::class, 'collection'])->name('collection');
    Route::get('/about', [PageController::class, 'about'])->name('about');
    Route::get('/contact', [PageController::class, 'contact'])->name('contact');

    // Keranjang
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product_id}', [CartController::class, 'store'])->name('cart.add');
    Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/delete/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

    // Checkout & Order
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.store');
    Route::get('/order/{id}/payment', [OrderController::class, 'showPayment'])->name('order.payment');
    Route::post('/order/{id}/payment', [OrderController::class, 'confirmPayment'])->name('order.payment.confirm');

    // Profil
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::get('/dikemas', [ProfileController::class, 'dikemas'])->name('dikemas');
        Route::get('/dikirim', [ProfileController::class, 'dikirim'])->name('dikirim');
    });
});
