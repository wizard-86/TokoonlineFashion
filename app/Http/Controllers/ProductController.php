<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * 1. Menampilkan Halaman Koleksi Produk / All Products
     * SOLUSI UTAMA: Menyelesaikan error Call to undefined method ProductController::index()
     */
    public function index()
    {
        // Mengambil semua produk dari database
        $products = Product::all();

        // Mengarahkan ke file view collection Anda (bisa berupa 'collection' atau 'auth.collection')
        $viewPath = view()->exists('auth.collection') ? 'auth.collection' : 'collection';

        return view($viewPath, compact('products'));
    }

    /**
     * 2. Menampilkan Detail Produk Tertentu
     */
    public function show($id)
    {
        // Mencari produk berdasarkan ID, jika tidak ada langsung muncul error 404
        $product = Product::findOrFail($id);

        $viewPath = view()->exists('auth.product-detail') ? 'auth.product-detail' : (view()->exists('auth.show') ? 'auth.show' : 'product.show');

        return view($viewPath, compact('product'));
    }

    /**
     * 3. Fitur Pencarian Produk / Search
     */
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Mencari produk yang namanya mirip dengan kata kunci yang diinput
        $products = Product::where('name', 'LIKE', "%{$query}%")->get();

        $viewPath = view()->exists('auth.search') ? 'auth.search' : 'search';

        return view($viewPath, compact('products', 'query'));
    }
}


