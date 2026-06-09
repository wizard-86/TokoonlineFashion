<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/', [PageController::class, 'home']);

Route::get('/login', [PageController::class, 'login']);

Route::post('/login-process', [PageController::class, 'loginProcess']);

Route::get('/dashboard', [PageController::class, 'dashboard']);

Route::get('/cart', [PageController::class, 'cart']);

Route::get('/profile', [PageController::class, 'profile']);

Route::get('/video', [PageController::class, 'video']);

Route::get('/notification', [PageController::class, 'notification']);
