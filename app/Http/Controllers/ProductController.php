<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        $categories = Category::all();

        return view('search2', compact(
            'products',
            'categories'
        ));
    }

    public function show($id)
    {
        $product = Product::with('category')
            ->findOrFail($id);

        return view('product_detail', compact('product'));
    }
}