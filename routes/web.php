<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| 1. KELOMPOK GUEST (PENGUNJUNG BELUM LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware(['guest'])->group(function () {
    // Halaman Landing / Welcome Awal
    Route::get('/', [PageController::class, 'home'])->name('landing');

    // Fitur Login
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

    // Fitur Register
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
});

/*
|--------------------------------------------------------------------------
| 2. KELOMPOK AUTH (WAJIB LOG IN TERLEBIH DAHULU)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Dashboard Utama setelah sukses login
    Route::get('/home', [PageController::class, 'dashboard'])->name('home');

    // Navigasi Menu Statis / Informasi Toko
    Route::get('/about', [PageController::class, 'about'])->name('about');
    Route::get('/contact', [PageController::class, 'contact'])->name('contact');

    // ====== FITUR KATALOG PRODUK & SEARCH ======
    // Menampilkan halaman semua koleksi pakaian distro
    Route::get('/collection', [ProductController::class, 'index'])->name('collection');
    // Fitur pencarian baju cepat
    Route::get('/search', [PageController::class, 'search'])->name('search');
    // Menampilkan detail item baju tertentu
    Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

    // ====== FITUR KERANJANG BELANJA (CART SYSTEM) ======
    // Menampilkan daftar belanjaan sementara
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    // Sinkronisasi alternatif jika rute memanggil name 'cart.index'
    Route::get('/cart-view', [CartController::class, 'index'])->name('cart.index');
    // Memproses penambahan baju baru ke keranjang
    Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
    // Memperbarui jumlah kuantitas baju (tambah/kurang)
    Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    // Menghapus baris baju tertentu dari daftar keranjang
    Route::delete('/cart/delete/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

    // ====== FITUR CHECKOUT (KASIR UTAMA) ======
    // Menampilkan form alamat & kurir bertema hitam premium
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    // SINKRONISASI UTAMA: Memproses checkout dengan nama route 'checkout.store' sesuai Form Blade
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.store');

    // ====== FITUR MANAJEMEN TRANSAKSI / ORDER ======
    // Menampilkan halaman instruksi pembayaran setelah checkout sukses
    Route::get('/order/{id}/payment', [OrderController::class, 'showPaymentPage'])->name('order.payment');

    // Riwayat daftar pesanan user
    Route::get('/profile/orders', [OrderController::class, 'history'])->name('profile.orders');

    // ====== MANAJEMEN DASBOR AKUN PROFIL ======
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/dikirim', [ProfileController::class, 'dikirim'])->name('profile.dikirim');
    Route::get('/profile/dinilai', [ProfileController::class, 'dinilai'])->name('profile.dinilai');
    Route::get('/profile/voucher', [ProfileController::class, 'voucher'])->name('profile.voucher');

    // Tombol Keluar Sistem
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
