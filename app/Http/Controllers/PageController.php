<?php

namespace App\Http\Controllers;
use App\Models\Products;  // Memanggil Model Produk
use App\Models\Categories;

use Illuminate\Http\Request;

class PageController extends Controller
{
    // 1. Menampilkan Landing Page awal untuk TAMU (Belum Login)
    // File berada di: resources/views/welcome.blade.php
   // Menampilkan halaman Welcome (Tamu - tanpa fitur checkout)
public function home() {
    return view('auth.welcome');
}

// Menampilkan halaman Home setelah Login (User - fitur belanja aktif)
public function dashboard() {
    return view('auth.home');
}
    // 3. Menampilkan Halaman Koleksi Produk
    // File berada di: resources/views/auth/collection.blade.php
    public function collection()
    {
        return view('auth.collection');
    }

    // 4. Menampilkan Halaman Tentang Kami
    // File berada di: resources/views/auth/about.blade.php
    public function about()
    {
        return view('auth.about');
    }

    // 5. Menampilkan Halaman Kontak
    // File berada di: resources/views/auth/contact.blade.php
    public function contact()
    {
        return view('auth.contact');
    }

    // 6. Menampilkan Halaman Pencarian
    // File berada di: resources/views/auth/search.blade.php
    public function search()
    {
        $products = Products::all();
        $categories = Categories::all();
        return view('auth.search2',compact('products','categories'));
        // return view('auth.search');
    }

    // 7. Menampilkan Halaman Keranjang Belanja
    // File berada di: resources/views/auth/cart.blade.php
    public function cart()
    {
        return view('auth.cart');
    }
}
