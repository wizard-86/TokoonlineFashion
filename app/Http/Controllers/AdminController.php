<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // 1. Tampilan Dashboard Utama Admin
    public function dashboard()
    {
        abort_if(Auth::user()->email !== 'vikyurbanvibe@gmail.com', 403, 'Akses Ditolak! Anda bukan admin.');

        $totalPendapatan = Order::where('status', 'completed')->sum('total_price');
        $totalPesanan = Order::count();
        $totalProduk = Product::count();
        $totalMember = User::count();

        return view('admin.dashboard', compact('totalPendapatan', 'totalPesanan', 'totalProduk', 'totalMember'));
    }

    // 2. Tampilan Manajemen Produk
    public function products()
    {
        abort_if(Auth::user()->email !== 'vikyurbanvibe@gmail.com', 403, 'Akses Ditolak! Anda bukan admin.');

        $products = Product::with('category')->get();
        return view('admin.products', compact('products'));
    }

    // 3. Tampilan Manajemen Pesanan (Orders)
    public function orders()
    {
        abort_if(Auth::user()->email !== 'vikyurbanvibe@gmail.com', 403, 'Akses Ditolak! Anda bukan admin.');

        $orders = Order::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.orders', compact('orders'));
    }

    // Fungsi untuk menampilkan halaman detail data diri pelanggan, barang & cetak resi
    public function show($id)
    {
        abort_if(Auth::user()->email !== 'vikyurbanvibe@gmail.com', 403, 'Akses Ditolak! Anda bukan admin.');

        // Mengambil data pesanan beserta detail barang, relasi produk, dan user pembeli
        $order = Order::with(['orderDetails.product', 'user'])->findOrFail($id);

        // Membuka file resources/views/admin/show.blade.php
        return view('admin.show', compact('order'));
    }

    // Berhasil Ditambahkan: Fungsi cetak resi otomatis menggunakan view detail
    public function print($id)
    {
        abort_if(Auth::user()->email !== 'vikyurbanvibe@gmail.com', 403, 'Akses Ditolak! Anda bukan admin.');

        $order = Order::with(['orderDetails.product', 'user'])->findOrFail($id);

        return view('admin.show', compact('order'))->with('autoPrint', true);
    }

    // 4. Proses Mengubah Status Pesanan (Pending -> Diproses -> Dikirim)
    public function updateOrderStatus(Request $request, $id)
    {
        abort_if(Auth::user()->email !== 'vikyurbanvibe@gmail.com', 403, 'Akses Ditolak! Anda bukan admin.');

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui!');
    }

    // 5. Proses Update Stok Cepat via AJAX (+/-)
    public function updateStock(Request $request, $id)
    {
        abort_if(Auth::user()->email !== 'vikyurbanvibe@gmail.com', 403, 'Akses Ditolak!');

        $product = Product::findOrFail($id);
        $product->stock = $request->stock;
        $product->save();

        return response()->json(['success' => true, 'new_stock' => $product->stock]);
    }

    // 6. Tampilan Halaman Edit Produk
    public function edit($id)
    {
        abort_if(Auth::user()->email !== 'vikyurbanvibe@gmail.com', 403, 'Akses Ditolak!');

        $product = Product::findOrFail($id);
        $categories = \App\Models\Category::all();

        return view('admin.edit_product', compact('product', 'categories'));
    }

    // 7. Proses Simpan Perubahan Edit Produk
    public function updateProduct(Request $request, $id)
    {
        abort_if(Auth::user()->email !== 'vikyurbanvibe@gmail.com', 403, 'Akses Ditolak!');

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->category_id = $request->category_id;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $folder = $request->input('folder_category', 'sepatu');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/' . $folder), $filename);
            $product->image = $folder . '/' . $filename;
        }

        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui!');
    }

    // 8. Tampilan Halaman Tambah Produk Baru
    public function create()
    {
        abort_if(Auth::user()->email !== 'vikyurbanvibe@gmail.com', 403, 'Akses Ditolak!');

        $categories = \App\Models\Category::all();
        return view('admin.create_product', compact('categories'));
    }

    // 9. Proses Simpan Produk Baru ke Database
    public function storeProduct(Request $request)
    {
        abort_if(Auth::user()->email !== 'vikyurbanvibe@gmail.com', 403, 'Akses Ditolak!');

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->category_id = $request->category_id;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $folder = $request->input('folder_category', 'sepatu');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/' . $folder), $filename);
            $product->image = $folder . '/' . $filename;
        }

        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Produk baru berhasil ditambahkan!');
    }

    // 10. Proses Hapus Produk dari Database
    public function destroyProduct($id)
    {
        abort_if(Auth::user()->email !== 'vikyurbanvibe@gmail.com', 403, 'Akses Ditolak!');

        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus!');
    }
}
