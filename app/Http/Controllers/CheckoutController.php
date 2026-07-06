<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Coupon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $cart = Cart::with('cartDetails.product')->where('user_id', $user->id)->first();
        $cartDetails = $cart ? $cart->cartDetails : collect();

        if ($cartDetails->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja Anda kosong!');
        }

        // 1. Hitung Subtotal Harga Produk Asli
        $subtotal = 0;
        $totalItems = 0;
        $categoryCounts = [];

        foreach ($cartDetails as $detail) {
            if ($detail->product) {
                $subtotal += $detail->product->price * $detail->quantity;
                $totalItems += $detail->quantity;

                $categoryId = $detail->product->category_id ?? 'default';
                if (!isset($categoryCounts[$categoryId])) {
                    $categoryCounts[$categoryId] = 0;
                }
                $categoryCounts[$categoryId] += $detail->quantity;
            }
        }

        // 2. LOGIKA DISKON GROSIR KATEGORI BARU
        $categoryDiscount = 0;
        $discountPercentage = 0;
        $jumlahKategoriUnik = count($categoryCounts);

        if ($totalItems >= 4 && $jumlahKategoriUnik >= 4) {
            $discountPercentage = 0.20; // 4 barang kategori berbeda = 20%
        } else {
            foreach ($categoryCounts as $count) {
                if ($count >= 2) {
                    $discountPercentage = 0.05; // 2 barang kategori sama = 5%
                    break;
                }
            }
        }
        $categoryDiscount = $subtotal * $discountPercentage;

        // 3. LOGIKA DISKON VOUCHER KUPON
        $voucherDiscount = 0;
        $couponCode = $request->input('coupon_code', '');
        if ($request->filled('coupon_code')) {
            $coupon = Coupon::where('code', $couponCode)
                            ->where('status', 'active')
                            ->where('min_order', '<=', $subtotal)
                            ->first();
            if ($coupon) {
                if ($coupon->type == 'percentage') {
                    $voucherDiscount = $subtotal * ($coupon->value / 100);
                } else {
                    $voucherDiscount = $coupon->value;
                }
            }
        }

        // Gabungkan seluruh diskon sistem
        $totalDiskonSistem = $categoryDiscount + $voucherDiscount;

        // 4. HITUNG KOIN (1 Koin = Rp 1)
        $coinsUsed = 0;
        $useCoins = false;
        if ($request->input('use_coins_applied') == '1') {
            $useCoins = true;
            $coinsUsed = $user->coins; // Menggunakan seluruh koin yang dimiliki
        }

        // Perhitungan Akhir Rupiah
        $totalFinalRupiah = $subtotal - $totalDiskonSistem - $coinsUsed;
        if ($totalFinalRupiah < 0) {
            $totalFinalRupiah = 0;
        }

        // Kelipatan Rp 10.000 dapat reward 1 koin
        $coinsEarned = floor($totalFinalRupiah / 10000);

        // Cari view yang valid (di folder auth atau bukan)
        $viewPath = view()->exists('auth.checkout') ? 'auth.checkout' : 'checkout';

        return view($viewPath, compact(
            'cartDetails',
            'subtotal',
            'categoryDiscount',
            'voucherDiscount',
            'totalDiskonSistem',
            'coinsUsed',
            'useCoins',
            'totalFinalRupiah',
            'coinsEarned',
            'user',
            'couponCode'
        ));
    }

    // 🌟 MENGGUNAKAN METHOD PROCESS AGAR MATCH DENGAN ROUTING KAMU
    public function process(Request $request)
    {
        $request->validate([
            'address' => 'required',
            'phone' => 'required',
            'payment_method' => 'required',
        ]);

        $user = Auth::user();
        $cart = Cart::with('cartDetails.product')->where('user_id', $user->id)->first();

        if (!$cart || $cart->cartDetails->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong!');
        }

        DB::beginTransaction();
        try {
            $subtotal = 0;
            $totalItems = 0;
            $categoryCounts = [];

            foreach ($cart->cartDetails as $detail) {
                if ($detail->product) {
                    $subtotal += $detail->product->price * $detail->quantity;
                    $totalItems += $detail->quantity;

                    $categoryId = $detail->product->category_id ?? 'default';
                    if (!isset($categoryCounts[$categoryId])) {
                        $categoryCounts[$categoryId] = 0;
                    }
                    $categoryCounts[$categoryId] += $detail->quantity;
                }
            }

            $discountPercentage = 0;
            $jumlahKategoriUnik = count($categoryCounts);
            if ($totalItems >= 4 && $jumlahKategoriUnik >= 4) {
                $discountPercentage = 0.20;
            } else {
                foreach ($categoryCounts as $count) {
                    if ($count >= 2) {
                        $discountPercentage = 0.05;
                        break;
                    }
                }
            }
            $categoryDiscount = $subtotal * $discountPercentage;

            $voucherDiscount = 0;
            if ($request->filled('coupon_code')) {
                $coupon = Coupon::where('code', $request->coupon_code)
                                ->where('status', 'active')
                                ->where('min_order', '<=', $subtotal)
                                ->first();
                if ($coupon) {
                    if ($coupon->type == 'percentage') {
                        $voucherDiscount = $subtotal * ($coupon->value / 100);
                    } else {
                        $voucherDiscount = $coupon->value;
                    }
                }
            }

            $totalDiskonSistem = $categoryDiscount + $voucherDiscount;

            $coinsUsed = 0;
            if ($request->input('use_coins_applied') == '1') {
                $coinsUsed = $user->coins;
            }

            $totalFinalRupiah = $subtotal - $totalDiskonSistem - $coinsUsed;
            if ($totalFinalRupiah < 0) {
                $totalFinalRupiah = 0;
            }

            $coinsEarned = floor($totalFinalRupiah / 10000);

            // Simpan Data ke database orders (mengisi total_harga dan total_price agar aman)
            $order = Order::create([
                'user_id' => $user->id,
                'invoice' => 'UV-' . strtoupper(Str::random(10)),
                'total_harga' => $totalFinalRupiah,
                'total_price' => $totalFinalRupiah,
                'address' => $request->address,
                'phone' => $request->phone,
                'courier' => $request->courier ?? 'J&T Express',
                'payment_method' => $request->payment_method,
                'discount_amount' => $totalDiskonSistem,
                'coins_used' => $coinsUsed,
                'coins_earned' => $coinsEarned,
                'status' => 'pending'
            ]);

            foreach ($cart->cartDetails as $detail) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $detail->product_id,
                    'quantity' => $detail->quantity,
                    'price' => $detail->product->price
                ]);
            }

            $userModel = User::find($user->id);
            $userModel->coins = ($userModel->coins - $coinsUsed) + $coinsEarned;
            $userModel->save();

            $cart->cartDetails()->delete();

            DB::commit();
            return redirect()->route('checkout.success', ['id' => $order->id]);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal memproses transaksi: ' . $e->getMessage());
        }
    }

    public function success($id)
    {
        $order = Order::with('orderDetails.product')->findOrFail($id);

        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        if (view()->exists('auth.success')) {
            return view('auth.success', compact('order'));
        }

        return view('success', compact('order'));
    }
}
