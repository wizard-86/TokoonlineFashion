<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        // 1. Ambil data keranjang utama milik user yang login beserta relasi produknya
        $cart = Cart::with('cartDetails.product')
            ->where('user_id', Auth::id())
            ->first();

        // 2. Pecah isi detailnya ke variabel $cartDetails agar dibaca oleh View
        $cartDetails = $cart ? $cart->cartDetails : collect();

        // 3. FIX ERROR: Hitung total semua harga barang di dalam keranjang
        $totalSemua = 0;
        foreach ($cartDetails as $detail) {
            if ($detail->product) {
                $totalSemua += $detail->product->price * $detail->quantity;
            }
        }

        // 4. Kirim variabel $cart, $cartDetails, dan $totalSemua ke file view
        return view('auth.cart', compact('cart', 'cartDetails', 'totalSemua'));
    }

    public function store(Request $request, $product_id = null)
    {
        // Ambil product_id dari parameter URL (tombol +), jika tidak ada baru dari request body
        $productId = $product_id ?? $request->product_id;

        // Ambil kuantitas dari form, jika lewat tombol "+" langsung otomatis beri nilai 1
        $quantity = $request->input('quantity', 1);

        $request->merge([
            'product_id' => $productId,
            'quantity' => $quantity
        ]);

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

        $cartDetail = CartDetail::where('cart_id', $cart->id)
            ->where('product_id', $productId)
            ->first();

        if ($cartDetail) {
            $cartDetail->update([
                'quantity' => $cartDetail->quantity + $quantity
            ]);
        } else {
            CartDetail::create([
                'cart_id' => $cart->id,
                'product_id' => $productId,
                'quantity' => $quantity
            ]);
        }

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'quantity' => 'required|integer'
        ]);

        $cartDetail = CartDetail::findOrFail($id);

        if ($request->quantity <= 0) {
            $cartDetail->delete();
            return redirect()->back()->with('success', 'Item dihapus dari keranjang.');
        }

        $cartDetail->update(['quantity' => $request->quantity]);
        return redirect()->back()->with('success', 'Kuantitas keranjang berhasil diperbarui.');
    }

    public function destroy(int $id)
    {
        $cartDetail = CartDetail::findOrFail($id);
        $cartDetail->delete();

        return redirect()->back()->with('success', 'Produk dihapus dari keranjang.');
    }
}
