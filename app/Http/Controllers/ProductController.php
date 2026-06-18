<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Halaman koleksi produk
     */
    public function index()
    {
        $products = Product::with('category')->get();
        $categories = Category::all();

        return view('welcome', compact(
            'products',
            'categories'
        ));
    }

    /**
     * Detail produk
     */
    public function show($id)
    {
        $product = Product::with('category')
            ->findOrFail($id);

        return view('customer.products.show', compact(
            'product'
        ));
    }
}