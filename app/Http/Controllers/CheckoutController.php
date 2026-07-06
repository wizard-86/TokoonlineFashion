<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Coupon;
use App\Models\Bundle; // Pasikan model Bundle diimport dengan benar
use App\Models\User;   // Pastikan model User diimport dengan benar
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        // 1. Hitung Subtotal Harga Produk Asli Belum Diskon
        $subtotal = 0;
        foreach ($cartDetails as $detail) {
            if ($detail->product) {
                $subtotal += $detail->product->price * $detail->quantity;
            }
        }

        // 2. LOGIKA DISKON BUNDLE (OTOMATIS)
        // Jika isi keranjang mengandung produk yang masuk kualifikasi bundle paket, kita beri potongan otomatis
        $bundleDiscount = 0;
        $productIdsInCart = $cartDetails->pluck('product_id')->toArray();

        // Cari paket bundle yang semua itemnya ada di dalam keranjang belanja
        $bundles = Bundle::with('products')->get();
        foreach ($bundles as $bundle) {
            $bundleProductIds = $bundle->products->pluck('id')->toArray();
            // Cek apakah semua item bundle ada di keranjang
            if (count(array_intersect($bundleProductIds, $productIdsInCart)) == count($bundleProductIds)) {
                // Hitung harga asli total produk bundle tersebut jika dibeli satuan
                $normalPriceSum = $bundle->products->sum('price');
                // Selisihnya menjadi potongan diskon bundle paket
                $bundleDiscount += ($normalPriceSum - $bundle->bundle_price);
            }
        }

        $totalSetelahBundle = $subtotal - $bundleDiscount;

        // 3. LOGIKA VOUCHER / KUPON (KODE INPUTAN)
        $voucherDiscount = 0;
        $couponCode = $request->get('coupon_code');
        $coupon = null;

        if ($couponCode) {
            $coupon = Coupon::where('code', $couponCode)->where('quota', '>', 0)->first();
            if ($coupon) {
                if ($totalSetelahBundle >= $coupon->min_order) {
                    if ($coupon->type == 'percentage') {
                        $voucherDiscount = ($totalSetelahBundle * $coupon->value) / 100;
                    } else {
                        $voucherDiscount = $coupon->value;
                    }
                } else {
                    session()->now('error_voucher', 'Minimal belanja tidak terpenuhi untuk kode ini!');
                }
            } else {
                session()->now('error_voucher', 'Kode voucher tidak valid atau kuota habis!');
            }
        }

        $totalDiskonSistem = $bundleDiscount + $voucherDiscount;
        $totalSebelumKoin = $subtotal - $totalDiskonSistem;
        if ($totalSebelumKoin < 0) $totalSebelumKoin = 0;

        // 4. LOGIKA POTONGAN KOIN MEMBER
        $useCoins = $request->has('use_coins') ? true : false;
        $coinsUsed = 0;
        $coinReductionValue = 0;

        if ($useCoins && $user->coins > 0) {
            // 1 Koin = Rp 1.000 potongan harga
            $maxCoinValueNeed = $totalSebelumKoin / 1000;

            if ($user->coins >= $maxCoinValueNeed) {
                $coinsUsed = ceil($maxCoinValueNeed);
                $coinReductionValue = $totalSebelumKoin;
            } else {
                $coinsUsed = $user->coins;
                $coinReductionValue = $coinsUsed * 1000;
            }
        }

        // Total akhir bersih wajib bayar rupiah
        $totalSemua = $totalSebelumKoin - $coinReductionValue;
        if ($totalSemua < 0) $totalSemua = 0;

        // 5. HITUNG CALON POIN/KOIN BARU YANG AKAN DIDAPATKAN
        // Kelipatan Rp 10.000 dari total bersih setelah diskon = dapat 1 koin
        $coinsEarned = floor($totalSemua / 10000);

        return view('auth.checkout', compact(
            'cart', 'cartDetails', 'subtotal', 'bundleDiscount',
            'voucherDiscount', 'totalDiskonSistem', 'user',
            'useCoins', 'coinsUsed', 'coinReductionValue', 'totalSemua', 'coinsEarned', 'couponCode'
        ));
    }

    public function process(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'payment_method' => 'required|string'
        ]);

        $user = Auth::user();
        $cart = Cart::with('cartDetails.product')->where('user_id', $user->id)->first();

        if (!$cart || $cart->cartDetails->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Tidak ada item untuk di-checkout!');
        }

        DB::beginTransaction();
        try {
            // Hitung kalkulasi ulang di sisi server demi keamanan data dari injeksi HTML
            $subtotal = 0;
            $productIdsInCart = $cart->cartDetails->pluck('product_id')->toArray();

            foreach ($cart->cartDetails as $detail) {
                $subtotal += $detail->product->price * $detail->quantity;
            }

            // Hitung otomatis bundle diskon
            $bundleDiscount = 0;
            $bundles = Bundle::with('products')->get();
            foreach ($bundles as $bundle) {
                $bundleProductIds = $bundle->products->pluck('id')->toArray();
                if (count(array_intersect($bundleProductIds, $productIdsInCart)) == count($bundleProductIds)) {
                    $bundleDiscount += ($bundle->products->sum('price') - $bundle->bundle_price);
                }
            }

            // Hitung voucher diskon kembali
            $voucherDiscount = 0;
            if ($request->filled('coupon_code')) {
                $coupon = Coupon::where('code', $request->coupon_code)->where('quota', '>', 0)->first();
                if ($coupon && ($subtotal - $bundleDiscount) >= $coupon->min_order) {
                    if ($coupon->type == 'percentage') {
                        $voucherDiscount = (($subtotal - $bundleDiscount) * $coupon->value) / 100;
                    } else {
                        $voucherDiscount = $coupon->value;
                    }
                    $coupon->decrement('quota'); // Kurangi kuota kupon voucher
                }
            }

            $totalDiskonSistem = $bundleDiscount + $voucherDiscount;
            $totalSebelumKoin = $subtotal - $totalDiskonSistem;

            // Hitung potongan koin jika user memilih menggunakannya
            $coinsUsed = 0;
            $coinReductionValue = 0;
            if ($request->filled('use_coins_applied') && $request->use_coins_applied == '1' && $user->coins > 0) {
                $maxCoinValueNeed = $totalSebelumKoin / 1000;
                if ($user->coins >= $maxCoinValueNeed) {
                    $coinsUsed = ceil($maxCoinValueNeed);
                    $coinReductionValue = $totalSebelumKoin;
                } else {
                    $coinsUsed = $user->coins;
                    $coinReductionValue = $coinsUsed * 1000;
                }

                // 🌟 FIX: Ambil instance Model User dari DB secara pasti untuk melakukan decrement koin yang valid
                $userModel = User::find($user->id);
                if ($userModel) {
                    $userModel->decrement('coins', $coinsUsed);
                }
            }

            $totalFinalRupiah = $totalSebelumKoin - $coinReductionValue;
            if ($totalFinalRupiah < 0) $totalFinalRupiah = 0;

            // Klaim reward koin baru (Kelipatan Rp 10.000)
            $coinsEarned = floor($totalFinalRupiah / 10000);

            // 🌟 FIX: Ambil instance Model User dari DB secara pasti untuk melakukan increment koin yang baru didapat
            $userModel = User::find($user->id);
            if ($userModel && $coinsEarned > 0) {
                $userModel->increment('coins', $coinsEarned);
            }

            // 1. Buat data transaksi order utama
            $order = Order::create([
                'user_id' => $user->id,
                'invoice' => 'UV-' . strtoupper(uniqid()),
                'address' => $request->address,
                'phone' => $request->phone,
                'courier' => 'Reguler J&T (Gratis Ongkir Bawaan)',
                'payment_method' => $request->payment_method,
                'total_harga' => $totalFinalRupiah,
                'discount_amount' => $totalDiskonSistem,
                'coins_used' => $coinsUsed,
                'coins_earned' => $coinsEarned,
                'status' => 'pending'
            ]);

            // 2. Pindahkan item dari cart ke detail order
            foreach ($cart->cartDetails as $detail) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $detail->product_id,
                    'quantity' => $detail->quantity,
                    'price' => $detail->product->price
                ]);
            }

            // 3. Bersihkan keranjang belanja
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

        // Proteksi keamanan: Memastikan user tidak bisa mengintip nota orang lain
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        if (view()->exists('auth.success')) {
            return view('auth.success', compact('order'));
        }

        return view('success', compact('order'));
    }
}
