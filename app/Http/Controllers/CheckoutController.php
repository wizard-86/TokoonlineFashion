<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Cart::with('cartDetails.product')
            ->where('user_id', Auth::id())
            ->first();

        if (!$cart || $cart->cartDetails->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja Anda kosong.');
        }

        return view('auth.checkout', compact('cart'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'address' => 'required|string',
            'courier' => 'required|string',
            'payment_method' => 'required|string'
        ]);

        $cart = Cart::with('cartDetails.product')->where('user_id', Auth::id())->first();

        if (!$cart || $cart->cartDetails->isEmpty()) {
            return redirect()->route('home')->with('error', 'Transaksi tidak valid.');
        }

        DB::transaction(function () use ($request, $cart) {
            $totalPrice = 0;
            foreach ($cart->cartDetails as $detail) {
                $totalPrice += $detail->product->price * $detail->quantity;
            }

            // 1. Buat Data Order
            $order = Order::create([
                'user_id' => Auth::id(),
                'total_price' => $totalPrice,
                'status' => 'pending'
            ]);

            // 2. Pindahkan Detail Item
            foreach ($cart->cartDetails as $detail) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $detail->product_id,
                    'quantity' => $detail->quantity,
                    'price' => $detail->product->price
                ]);
            }

            // 3. Buat Data Pengiriman (Shipping)
            Shipping::create([
                'order_id' => $order->id,
                'address' => $request->address,
                'courier' => $request->courier,
                'shipping_cost' => 0, // Sesuai default value database Anda yaitu 0
                'status' => 'pending'
            ]);

            // 4. Buat Record Pembayaran (Payment)
            Payment::create([
                'order_id' => $order->id,
                'payment_method' => $request->payment_method,
                'amount' => $totalPrice,
                'status' => 'pending'
            ]);

            // 5. Kosongkan Keranjang Belanja Belanja
            $cart->cartDetails()->delete();
        });

        return redirect()->route('profile.dikemas')->with('success', 'Pesanan berhasil dibuat! Silakan lakukan pembayaran.');
    }
}
