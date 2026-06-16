<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * 1. Menampilkan Halaman Keranjang Belanja
     */
    public function index()
    {
        $cart = Cart::where('user_id', Auth::id())->first();

        // Otomatis mendeteksi apakah file blade Anda berada di folder auth atau views utama
        $viewPath = view()->exists('auth.cart') ? 'auth.cart' : 'cart';

        if (!$cart) {
            $cartDetails = collect([]);
        } else {
            $cartDetails = CartDetail::with('product')->where('cart_id', $cart->id)->get();
        }

        return view($viewPath, compact('cartDetails'));
    }

    /**
     * 2. Memproses Tambah Barang dari Halaman Toko/Koleksi
     */
    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $userId = Auth::id();

        $cart = Cart::where('user_id', $userId)->first();

        if (!$cart) {
            $cart = Cart::create([
                'user_id' => $userId
            ]);
        }

        $cartDetail = CartDetail::where('cart_id', $cart->id)
                                ->where('product_id', $product->id)
                                ->first();

        if ($cartDetail) {
            $cartDetail->update([
                'quantity' => $cartDetail->quantity + 1
            ]);
        } else {
            CartDetail::create([
                'cart_id'    => $cart->id,
                'product_id' => $product->id,
                'quantity'   => 1
            ]);
        }

        return redirect()->back()->with('success', 'Produk ' . $product->name . ' berhasil ditambahkan ke keranjang!');
    }

    /**
     * 3. Memperbarui Jumlah Kuantitas Barang (Tambah / Kurang)
     * Ditambahkan logika pintar: Jika kuantitas diubah menjadi 0 atau kurang, otomatis HAPUS barang.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer'
        ]);

        $cartDetail = CartDetail::findOrFail($id);

        // LOGIKA BARU: Jika pengguna mengurangi kuantitas hingga di bawah 1, hapus item dari keranjang
        if ($request->quantity < 1) {
            $cartDetail->delete();
            return redirect()->back()->with('success', 'Barang berhasil dihapus dari keranjang karena jumlah kurang dari 1!');
        }

        // Jika jumlah 1 atau lebih, lakukan pembaruan angka seperti biasa
        $cartDetail->update([
            'quantity' => $request->quantity
        ]);

        return redirect()->back()->with('success', 'Jumlah barang berhasil diperbarui!');
    }

    /**
     * 4. Menghapus Barang Secara Langsung Melalui Tombol Trash/Hapus
     */
    public function destroy($id)
    {
        $cartDetail = CartDetail::findOrFail($id);
        $cartDetail->delete();

        return redirect()->back()->with('success', 'Barang berhasil dihapus dari keranjang!');
    }
}
