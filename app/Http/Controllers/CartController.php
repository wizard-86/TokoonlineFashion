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
        $productId = $product_id ?? $request->input('product_id');
        $quantity = max(1, (int) $request->input('quantity', 1));

        $request->merge([
            'product_id' => $productId,
            'quantity' => $quantity,
        ]);

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($productId);
        $availableStock = (int) ($product->stock ?? 0);

        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
        $cartDetail = CartDetail::where('cart_id', $cart->id)
            ->where('product_id', $productId)
            ->first();

        $currentCartQuantity = $cartDetail ? (int) $cartDetail->quantity : 0;
        $newQuantity = $currentCartQuantity + $quantity;

        if ($availableStock <= 0 || $newQuantity > $availableStock) {
            $message = 'Stok produk tidak mencukupi. Tersedia ' . $availableStock . ' pcs.';

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => $message,
                ], 422);
            }

            return redirect()->back()->with('error', $message);
        }

        if ($cartDetail) {
            $cartDetail->update([
                'quantity' => $newQuantity,
            ]);
        } else {
            CartDetail::create([
                'cart_id' => $cart->id,
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
        }

        $cartCount = (int) $cart->cartDetails()->sum('quantity');

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil ditambahkan ke keranjang!',
                'cart_count' => $cartCount,
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
