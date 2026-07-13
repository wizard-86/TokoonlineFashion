<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function welcome()
    {
        $products = Product::with('category')->latest()->take(8)->get();
        return view('auth.welcome', compact('products'));
    }

    public function home()
    {
        // HOME: Hanya memanggil 4 produk TERBARU (kategori bebas)
        $products = Product::with('category')->latest()->take(4)->get();

        $categories = Category::all();
        $c10 = Product::find(10);
        $c11 = Product::find(11);
        $c12 = Product::find(12);

        return view('auth.home', compact('products', 'categories', 'c10', 'c11', 'c12'));
    }

    public function collection()
    {
        // COLLECTION: Hanya memanggil 8 produk TERLARIS/bebas secara global
        $products = Product::with('category')->latest()->take(8)->get();

        $categories = Category::all();
        $c10 = Product::find(10);
        $c11 = Product::find(11);
        $c12 = Product::find(12);

        return view('auth.collection', compact('products', 'categories', 'c10', 'c11', 'c12'));
    }

    public function search(Request $request)
    {
        $categories = Category::all();
        $query = Product::with('category');

        // Logika pencarian jika user mengetik sesuatu di search2
        if ($request->has('q') && $request->q != '') {
            $query->where('name', 'like', '%' . $request->q . '%');
        }

        $products = $query->get();

        // Memastikan mengarah ke file resources/views/auth/search2.blade.php
        return view('auth.search2', compact('products', 'categories'));
    }

    public function productDetail(Request $request, int $id)
    {
        $product = Product::with('category')->findOrFail($id);
        $product->category_name = $product->category ? $product->category->name : 'STREETWEAR';

        if ($request->boolean('modal')) {
            return view('auth.product_detail_modal', compact('product'));
        }

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
