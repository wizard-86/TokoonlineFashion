<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function welcome()
    {
        // Mengambil produk beserta relasi kategorinya untuk halaman depan sebelum login
        $products = Product::with('category')->latest()->take(8)->get();

        // Mengarahkan ke file resources/views/welcome.blade.php
        return view('welcome', compact('products'));
    }

    public function home()
    {
        // Mengambil semua produk dan kategori untuk loop etalase utama setelah login
        $products = Product::with('category')->latest()->get();
        $categories = Category::all();

        // Mengambil produk spesifik untuk variabel manual $c10, $c11, $c12 di home.blade.php
        $c10 = Product::find(10);
        $c11 = Product::find(11);
        $c12 = Product::find(12);

        return view('auth.home', compact('products', 'categories', 'c10', 'c11', 'c12'));
    }

    public function collection(Request $request)
    {
        $categories = Category::all();
        $query = Product::with('category');

        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        $products = $query->get();

        // Variabel manual untuk section fallback di dalam collection.blade.php
        $c10 = Product::find(10);
        $c11 = Product::find(11);
        $c12 = Product::find(12);

        return view('auth.collection', compact('products', 'categories', 'c10', 'c11', 'c12'));
    }

    public function productDetail(int $id)
    {
        // Mengambil produk berdasarkan ID, jika tidak ada langsung memicu halaman 404
        $product = Product::findOrFail($id);

        // Mengambil data string kategori untuk etalase detail produk
        $product->category_name = $product->category ? $product->category->name : 'STREETWEAR';

        return view('auth.product_detail', compact('product'));
    }

    public function about()
    {
        return view('auth.about');
    }

    public function contact()
    {
        return view('auth.contact');
    }
}
