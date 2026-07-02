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
        $cart = Cart::with('cartDetails.product')
            ->where('user_id', Auth::id())
            ->first();

        return view('auth.cart', compact('cart'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

        $cartDetail = CartDetail::where('cart_id', $cart->id)
            ->where('product_id', $request->product_id)
            ->first();

        if ($cartDetail) {
            $cartDetail->update([
                'quantity' => $cartDetail->quantity + $request->quantity
            ]);
        } else {
            CartDetail::create([
                'cart_id' => $cart->id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity
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
