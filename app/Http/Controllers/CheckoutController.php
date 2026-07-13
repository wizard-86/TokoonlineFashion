<?php

namespace App\Http\Controllers;

use App\Models\Bundle;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderDetail;
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

        $couponCode = trim((string) $request->input('coupon_code', ''));
        $pricing = $this->calculatePricingSummary($cartDetails, $couponCode, (bool) ($request->input('use_coins_applied') === '1'), $user);

        $viewPath = view()->exists('auth.checkout') ? 'auth.checkout' : 'checkout';

        return view($viewPath, array_merge($pricing, [
            'cartDetails' => $cartDetails,
            'user' => $user,
            'couponCode' => $couponCode,
            'totalItems' => $pricing['totalItems'],
        ]));
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

        $couponCode = trim((string) $request->input('coupon_code', ''));
        $totalItems = $cart->cartDetails->sum('quantity');

        if ($couponCode === 'GOLD15' && $totalItems < 4) {
            return redirect()->back()->with('error', 'Minimal 4 barang untuk Voucher Gold!')->withInput();
        }

        if ($couponCode === 'SILVER10' && $totalItems < 2) {
            return redirect()->back()->with('error', 'Minimal 2 barang untuk Voucher Silver!')->withInput();
        }

        DB::beginTransaction();

        try {
            $pricing = $this->calculatePricingSummary($cart->cartDetails, $couponCode, (bool) ($request->input('use_coins_applied') === '1'), $user);

            $order = Order::create([
                'user_id' => $user->id,
                'invoice' => 'UV-' . strtoupper(Str::random(10)),
                'total_harga' => $pricing['totalFinalRupiah'],
                'total_price' => $pricing['totalFinalRupiah'],
                'address' => $request->address,
                'phone' => $request->phone,
                'courier' => $request->courier ?? 'J&T Express',
                'payment_method' => $request->payment_method,
                'discount_amount' => $pricing['totalDiskonSistem'],
                'coins_used' => $pricing['coinsUsed'],
                'coins_earned' => $pricing['coinsEarned'],
                'status' => 'pending',
            ]);

            foreach ($cart->cartDetails as $detail) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $detail->product_id,
                    'quantity' => $detail->quantity,
                    'price' => $detail->product->price,
                ]);
            }

            $userModel = User::find($user->id);
            $userModel->coins = max(0, ($userModel->coins - $pricing['coinsUsed']) + $pricing['coinsEarned']);
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

        return view(view()->exists('auth.success') ? 'auth.success' : 'success', compact('order'));
    }

    private function calculatePricingSummary($cartDetails, string $couponCode, bool $useCoins, User $user): array
    {
        $subtotal = 0;
        $totalItems = 0;
        $categoryCounts = [];

        foreach ($cartDetails as $detail) {
            if (!$detail->product) {
                continue;
            }

            $quantity = (int) $detail->quantity;
            $subtotal += (float) $detail->product->price * $quantity;
            $totalItems += $quantity;

            $categoryId = $detail->product->category_id ?? 'default';
            $categoryCounts[$categoryId] = ($categoryCounts[$categoryId] ?? 0) + $quantity;
        }

        $categoryDiscount = $this->calculateCategoryDiscount($subtotal, $totalItems, $categoryCounts);
        $bundleDiscount = $this->calculateBundleDiscount($cartDetails);
        $voucherDiscount = $this->calculateVoucherDiscount($couponCode, $subtotal, $totalItems);

        $totalDiscountBeforeCoins = $categoryDiscount + $bundleDiscount + $voucherDiscount;

        $maxRedeemableCoins = (int) floor(max($subtotal - $totalDiscountBeforeCoins, 0) / 1000);
        $coinsUsed = $useCoins ? min((int) $user->coins, $maxRedeemableCoins) : 0;
        $coinsUsedValue = $coinsUsed * 1000;

        $totalFinalRupiah = max(0, $subtotal - $totalDiscountBeforeCoins - $coinsUsedValue);
        $coinsEarned = (int) floor(max($subtotal - $totalDiscountBeforeCoins, 0) / 10000);

        $dbVouchers = Coupon::query()
            ->where('status', 'active')
            ->where('quota', '>', 0)
            ->where(function ($query) {
                $query->whereNull('expires_at')->orWhere('expires_at', '>=', now());
            })
            ->get();

        $vouchersForSelect = $dbVouchers->map(function ($coupon) use ($subtotal) {
            $label = $coupon->code . ' (' . (($coupon->type === 'percentage') ? $coupon->value . '% - ' : 'Rp ' . number_format($coupon->value, 0, ',', '.') . ' - ') . 'Min Order ' . number_format($coupon->min_order, 0, ',', '.') . ')';

            return [
                'code' => $coupon->code,
                'label' => $label,
                'available' => $subtotal >= $coupon->min_order,
            ];
        })->toArray();

        $vouchersForSelect = array_merge([
            ['code' => 'WELCOME5', 'label' => 'WELCOME5 (Diskon 5% - Pengguna Baru)', 'available' => true],
            ['code' => 'SILVER10', 'label' => 'SILVER10 (Diskon 10% - Min 2 Barang)', 'available' => $totalItems >= 2],
            ['code' => 'GOLD15', 'label' => 'GOLD15 (Diskon 15% - Min 4 Barang)', 'available' => $totalItems >= 4],
        ], $vouchersForSelect);

        return [
            'subtotal' => (float) $subtotal,
            'totalItems' => $totalItems,
            'categoryDiscount' => $categoryDiscount,
            'bundleDiscount' => $bundleDiscount,
            'voucherDiscount' => $voucherDiscount,
            'totalDiskonSistem' => $totalDiscountBeforeCoins,
            'coinsUsed' => $coinsUsed,
            'coinsUsedValue' => $coinsUsedValue,
            'useCoins' => $useCoins,
            'totalFinalRupiah' => $totalFinalRupiah,
            'coinsEarned' => $coinsEarned,
            'vouchersForSelect' => $vouchersForSelect,
        ];
    }

    private function calculateCategoryDiscount(float $subtotal, int $totalItems, array $categoryCounts): float
    {
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

        return $subtotal * $discountPercentage;
    }

    private function calculateBundleDiscount($cartDetails): float
    {
        $cartProductCounts = [];

        foreach ($cartDetails as $detail) {
            if (!$detail->product) {
                continue;
            }

            $cartProductCounts[$detail->product_id] = ($cartProductCounts[$detail->product_id] ?? 0) + (int) $detail->quantity;
        }

        $bundleDiscount = 0;
        $bundles = Bundle::with('products')->get();

        foreach ($bundles as $bundle) {
            $availableBundleCounts = [];
            $bundleContainsAllProducts = true;

            foreach ($bundle->products as $product) {
                $productCountInCart = $cartProductCounts[$product->id] ?? 0;
                if ($productCountInCart <= 0) {
                    $bundleContainsAllProducts = false;
                    break;
                }

                $availableBundleCounts[] = $productCountInCart;
            }

            if (!$bundleContainsAllProducts || $availableBundleCounts === []) {
                continue;
            }

            $bundleSets = min($availableBundleCounts);
            $bundleSubtotal = 0;

            foreach ($bundle->products as $product) {
                $bundleSubtotal += (float) $product->price * $bundleSets;
            }

            $bundleDiscount += max(0, $bundleSubtotal - ((float) $bundle->bundle_price * $bundleSets));
        }

        return $bundleDiscount;
    }

    private function calculateVoucherDiscount(string $couponCode, float $subtotal, int $totalItems): float
    {
        if ($couponCode === '') {
            return 0;
        }

        if ($couponCode === 'GOLD15') {
            return $totalItems >= 4 ? $subtotal * 0.15 : 0;
        }

        if ($couponCode === 'SILVER10') {
            return $totalItems >= 2 ? $subtotal * 0.10 : 0;
        }

        if ($couponCode === 'WELCOME5') {
            return $subtotal * 0.05;
        }

        $coupon = Coupon::query()
            ->where('code', $couponCode)
            ->where('status', 'active')
            ->where('min_order', '<=', $subtotal)
            ->where(function ($query) {
                $query->whereNull('expires_at')->orWhere('expires_at', '>=', now());
            })
            ->first();

        if (!$coupon) {
            return 0;
        }

        return $coupon->type === 'percentage'
            ? $subtotal * ($coupon->value / 100)
            : min((float) $coupon->value, $subtotal);
    }
}
