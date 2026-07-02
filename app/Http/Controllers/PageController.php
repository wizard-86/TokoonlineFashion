<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function welcome()
    {
        // Mengambil produk terbaru untuk halaman awal
        $products = Product::with('category')->latest()->take(8)->get();
        return view('auth.welcome', compact('products'));
    }

    public function home()
    {
        $products = Product::with('category')->latest()->get();
        $categories = Category::all();
        return view('auth.home', compact('products', 'categories'));
    }

    public function collection(Request $request)
    {
        $categories = Category::all();
        $query = Product::with('category');

        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }

        $products = $query->get();
        return view('auth.collection', compact('products', 'categories'));
    }

    public function productDetail(int $id)
    {
        $product = Product::with('category')->findOrFail($id);
        // Rekomendasi produk serupa
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $id)
            ->take(4)
            ->get();

        return view('auth.product_detail', compact('product', 'relatedProducts'));
    }

    public function search(Request $request)
    {
        $search = $request->input('query');
        $products = Product::where('name', 'LIKE', "%{$search}%")
            ->orWhere('description', 'LIKE', "%{$search}%")
            ->get();

        return view('auth.search', compact('products', 'search'));
    }

    public function search2(Request $request)
    {
        // Alternatif pencarian/filter tingkat lanjut jika digunakan
        return view('auth.search2');
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
