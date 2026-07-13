<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// === ADMIN ROUTES (Diproteksi dengan auth standar) ===
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Manajemen Produk
    Route::get('/products', [AdminController::class, 'products'])->name('products.index');
    Route::get('/products/create', [AdminController::class, 'create'])->name('products.create');
    Route::post('/products/store', [AdminController::class, 'storeProduct'])->name('products.store');
    Route::get('/products/{id}/edit', [AdminController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}/update', [AdminController::class, 'updateProduct'])->name('products.update');
    Route::post('/products/{id}/update-stock', [AdminController::class, 'updateStock'])->name('products.updateStock');
    Route::delete('/products/{id}/delete', [AdminController::class, 'destroyProduct'])->name('products.destroy');

    // Manajemen Pesanan
    Route::get('/orders', [AdminController::class, 'orders'])->name('orders.index');
    Route::get('/orders/{id}', [AdminController::class, 'show'])->name('orders.show');
    Route::get('/orders/{id}/print', [AdminController::class, 'print'])->name('orders.print'); // Berhasil Ditambahkan
    Route::post('/orders/{id}/update-status', [AdminController::class, 'updateOrderStatus'])->name('orders.updateStatus');

    // Manajemen Voucher
    Route::get('/vouchers', [AdminController::class, 'vouchers'])->name('vouchers.index');
    Route::get('/vouchers/create', [AdminController::class, 'createVoucher'])->name('vouchers.create');
    Route::post('/vouchers/store', [AdminController::class, 'storeVoucher'])->name('vouchers.store');
    Route::get('/vouchers/{id}/edit', [AdminController::class, 'editVoucher'])->name('vouchers.edit');
    Route::put('/vouchers/{id}/update', [AdminController::class, 'updateVoucher'])->name('vouchers.update');
    Route::delete('/vouchers/{id}/delete', [AdminController::class, 'destroyVoucher'])->name('vouchers.destroy');
});

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
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/success/{id}', [CheckoutController::class, 'success'])->name('checkout.success');

    // Fitur Profil
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
});
