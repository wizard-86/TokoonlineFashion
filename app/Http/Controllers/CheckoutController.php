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

        // 1. Hitung Subtotal Harga Produk dan Total Item
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

        $couponCode = $request->input('coupon_code', '');

        // 2. LOGIKA DISKON GROSIR KATEGORI
        $categoryDiscount = 0;
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

        // 3. LOGIKA DISKON VOUCHER KUPON (Disesuaikan dengan Voucher Baru)
        $voucherDiscount = 0;
        if ($request->filled('coupon_code')) {
            if ($couponCode == 'GOLD15') {
                if ($totalItems < 4) {
                    return redirect()->route('checkout.index')->with('error', 'Minimal 4 barang untuk Voucher Gold!');
                }
                $voucherDiscount = $subtotal * 0.15;
            } elseif ($couponCode == 'SILVER10') {
                if ($totalItems < 2) {
                    return redirect()->route('checkout.index')->with('error', 'Minimal 2 barang untuk Voucher Silver!');
                }
                $voucherDiscount = $subtotal * 0.10;
            } elseif ($couponCode == 'WELCOME5') {
                $voucherDiscount = $subtotal * 0.05;
            } else {
                $coupon = Coupon::where('code', $couponCode)
                    ->where('status', 'active')
                    ->where('min_order', '<=', $subtotal)
                    ->where(function ($query) {
                        $query->whereNull('expires_at')->orWhere('expires_at', '>=', now());
                    })
                    ->first();

                if ($coupon) {
                    $voucherDiscount = ($coupon->type == 'percentage') ? $subtotal * ($coupon->value / 100) : $coupon->value;
                }
            }
        }

        $totalDiskonSistem = $categoryDiscount + $voucherDiscount;

        // 4. HITUNG KOIN
        $coinsUsed = 0;
        $useCoins = false;
        if ($request->input('use_coins_applied') == '1') {
            $useCoins = true;
            $coinsUsed = $user->coins;
        }

        $totalFinalRupiah = max(0, $subtotal - $totalDiskonSistem - $coinsUsed);
        $coinsEarned = floor($totalFinalRupiah / 10000);

        // Siapkan daftar voucher yang valid untuk ditampilkan di dropdown checkout
        $dbVouchers = Coupon::where('status', 'active')
            ->where(function ($query) {
                $query->whereNull('expires_at')->orWhere('expires_at', '>=', now());
            })
            ->get();

        $vouchersForSelect = $dbVouchers->map(function ($coupon) use ($subtotal) {
            $label = $coupon->code . ' (' . (($coupon->type === 'percentage') ? $coupon->value . '% - ' : 'Rp ' . number_format($coupon->value, 0, ',', '.') . ' - ') . 'Min Order ' . number_format($coupon->min_order, 0, ',', '.') . ')';
            return ['code' => $coupon->code, 'label' => $label, 'available' => $subtotal >= $coupon->min_order];
        })->toArray();

        $vouchersForSelect = array_merge([
            ['code' => 'WELCOME5', 'label' => 'WELCOME5 (Diskon 5% - Pengguna Baru)', 'available' => true],
            ['code' => 'SILVER10', 'label' => 'SILVER10 (Diskon 10% - Min 2 Barang)', 'available' => $totalItems >= 2],
            ['code' => 'GOLD15', 'label' => 'GOLD15 (Diskon 15% - Min 4 Barang)', 'available' => $totalItems >= 4],
        ], $vouchersForSelect);

        $viewPath = view()->exists('auth.checkout') ? 'auth.checkout' : 'checkout';

        return view($viewPath, compact(
            'cartDetails', 'subtotal', 'categoryDiscount', 'voucherDiscount',
            'totalDiskonSistem', 'coinsUsed', 'useCoins', 'totalFinalRupiah',
            'coinsEarned', 'user', 'couponCode', 'vouchersForSelect', 'totalItems'
        ));
    }

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

        $totalItems = $cart->cartDetails->sum('quantity');

        // Validasi Keamanan Sebelum Transaksi
        if ($request->filled('coupon_code')) {
            if ($request->coupon_code == 'GOLD15' && $totalItems < 4) {
                return redirect()->back()->with('error', 'Minimal 4 barang untuk Voucher Gold!')->withInput();
            }
            if ($request->coupon_code == 'SILVER10' && $totalItems < 2) {
                return redirect()->back()->with('error', 'Minimal 2 barang untuk Voucher Silver!')->withInput();
            }
        }

        DB::beginTransaction();
        try {
            $subtotal = 0;
            $categoryCounts = [];

            foreach ($cart->cartDetails as $detail) {
                if ($detail->product) {
                    $subtotal += $detail->product->price * $detail->quantity;
                    $categoryId = $detail->product->category_id ?? 'default';
                    if (!isset($categoryCounts[$categoryId])) $categoryCounts[$categoryId] = 0;
                    $categoryCounts[$categoryId] += $detail->quantity;
                }
            }

            $discountPercentage = 0;
            $jumlahKategoriUnik = count($categoryCounts);
            if ($totalItems >= 4 && $jumlahKategoriUnik >= 4) {
                $discountPercentage = 0.20;
            } else {
                foreach ($categoryCounts as $count) {
                    if ($count >= 2) { $discountPercentage = 0.05; break; }
                }
            }
            $categoryDiscount = $subtotal * $discountPercentage;

            $voucherDiscount = 0;
            if ($request->filled('coupon_code')) {
                if ($request->coupon_code == 'GOLD15') {
                    $voucherDiscount = $subtotal * 0.15;
                } elseif ($request->coupon_code == 'SILVER10') {
                    $voucherDiscount = $subtotal * 0.10;
                } elseif ($request->coupon_code == 'WELCOME5') {
                    $voucherDiscount = $subtotal * 0.05;
                } else {
                    $coupon = Coupon::where('code', $request->coupon_code)
                        ->where('status', 'active')
                        ->where(function ($query) {
                            $query->whereNull('expires_at')->orWhere('expires_at', '>=', now());
                        })
                        ->first();

                    if ($coupon) {
                        $voucherDiscount = ($coupon->type == 'percentage') ? $subtotal * ($coupon->value / 100) : $coupon->value;
                    }
                }
            }

            $totalDiskonSistem = $categoryDiscount + $voucherDiscount;
            $coinsUsed = ($request->input('use_coins_applied') == '1') ? $user->coins : 0;
            $totalFinalRupiah = max(0, $subtotal - $totalDiskonSistem - $coinsUsed);
            $coinsEarned = floor($totalFinalRupiah / 10000);

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
            $userModel->coins = max(0, ($userModel->coins - $coinsUsed) + $coinsEarned);
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
        if ($order->user_id !== Auth::id()) abort(403);
        return view(view()->exists('auth.success') ? 'auth.success' : 'success', compact('order'));
    }
}
