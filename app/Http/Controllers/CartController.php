<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Pastikan kamu punya Model Product jika ingin validasi ke DB

class CartController extends Controller
{
    // 1. Fungsi untuk melihat isi keranjang (Halaman Cart)
    public function index()
    {
        // Mengambil data cart dari session, jika kosong default-nya array kosong []
        $cart = session()->get('cart', []);

        return view('cart.index', compact('cart'));
    }

    // 2. Fungsi untuk menambah produk ke keranjang (Aksi dari tombol + yang kita buat)
    public function add(Request $request, $id)
    {
        // Opsi: Ambil data produk dari DB jika ingin harganya selalu update dan valid
        // $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        // Jika produk sudah ada di keranjang, tambahkan jumlahnya (quantity)
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            // Jika produk belum ada, masukkan data baru ke dalam session cart
            // Catatan: Karena HTML kamu statis, kita bisa menembak nama placeholder dulu
            // atau mencocokkannya nanti dengan data real dari Database.
            $cart[$id] = [
                "id" => $id,
                "quantity" => 1,
                // Data di bawah ini idealnya diambil dari $product di Database:
                // "name" => $product->name,
                // "price" => $product->price,
                // "image" => $product->image
            ];
        }

        // Simpan kembali data cart yang baru ke dalam session
        session()->put('cart', $cart);

        // Redirect kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    // 3. Fungsi untuk menghapus salah satu item di keranjang
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart', []);
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            return redirect()->back()->with('success', 'Produk dihapus dari keranjang!');
        }
    }

    // 4. Fungsi untuk mengupdate jumlah (quantity) produk di halaman keranjang
    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart', []);
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Keranjang berhasil diperbarui!');
        }
    }
}
