<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| PUBLIC / GUEST
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    // Login
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.submit');

    // Register
    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.submit');
});

/*
|--------------------------------------------------------------------------
| CUSTOMER
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Collection
    Route::get('/collection', [ProductController::class, 'index'])
        ->name('search2');

    // Detail Produk
    Route::get('/product/{id}', [ProductController::class, 'show'])
        ->name('product.show');

    // Cart
    Route::post('/cart/add/{id}', [CartController::class, 'add'])
        ->name('cart.add');

    Route::get('/cart', [CartController::class, 'index'])
        ->name('cart');

    // Checkout
    Route::get('/checkout', [CartController::class, 'checkout'])
        ->name('checkout');

    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('profile');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

    });