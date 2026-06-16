<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Shipping;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    /**
     * 1. Menampilkan Halaman Kasir Hitam Premium URBAN VIBE
     */
    public function index()
    {
        $cart = Cart::where('user_id', Auth::id())->first();

        // Jika keranjang induk belum ada, lempar kembali ke halaman cart dengan pesan peringatan
        if (!$cart) {
            return redirect()->route('cart')->with('error', 'Keranjang belanja Anda masih kosong.');
        }

        // Ambil data detail item di keranjang belanja beserta relasi produknya
        $cartDetails = CartDetail::with('product')->where('cart_id', $cart->id)->get();

        // Jika keranjang tidak ada isinya sama sekali
        if ($cartDetails->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Keranjang belanja Anda masih kosong.');
        }

        // Memastikan view mengarah ke folder auth/checkout.blade.php Anda
        return view('auth.checkout', compact('cartDetails'));
    }

    /**
     * 2. Memproses Perpindahan dari Data Keranjang menjadi Transaksi Tetap (Order)
     */
    public function process(Request $request)
    {
        // Validasi input data dari form checkout
        $request->validate([
            'address'        => 'required|string|min:5',
            'courier'        => 'required|string',
            'payment_method' => 'required|string',
        ]);

        $userId = Auth::id();
        $cart = Cart::where('user_id', $userId)->first();

        if (!$cart) {
            return redirect()->route('cart')->with('error', 'Akses transaksi ditolak karena keranjang kosong.');
        }

        $cartDetails = CartDetail::with('product')->where('cart_id', $cart->id)->get();

        if ($cartDetails->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Akses transaksi ditolak karena item kosong.');
        }

        // Memulai Database Transaction (Keamanan data berlapis)
        DB::beginTransaction();

        try {
            // Hitung grand total harga belanja seluruh barang
            $totalProductPrice = 0;
            foreach ($cartDetails as $item) {
                $totalProductPrice += $item->product->price * $item->quantity;
            }

            // Biaya flat kurir (misal gratis atau diatur tetap)
            $shippingCost = 0;
            $grandTotal = $totalProductPrice + $shippingCost;

            // A. Masukkan baris data utama ke tabel ORDERS sesuai skema database Anda
            $order = Order::create([
                'user_id'     => $userId,
                'total_price' => $grandTotal,
                'status'      => 'pending' // pending, paid, shipped, done
            ]);

            // B. Pindahkan semua barang dari tabel cart_details ke tabel order_details
            foreach ($cartDetails as $item) {
                OrderDetail::create([
                    'order_id'   => $order->id,
                    'product_id' => $item->product_id,
                    'quantity'   => $item->quantity,
                    'price'      => $item->product->price
                ]);
            }

            // C. Masukkan data pengiriman ke tabel SHIPPING
            Shipping::create([
                'order_id'      => $order->id,
                'courier'       => $request->courier,
                'address'       => $request->address,
                'shipping_cost' => $shippingCost,
                'status'        => 'pending'
            ]);

            // D. Masukkan data transaksi awal ke tabel PAYMENT
            Payment::create([
                'order_id'       => $order->id,
                'payment_method' => $request->payment_method,
                'amount'         => $grandTotal,
                'status'         => 'pending'
            ]);

            // E. Hapus/Bersihkan isi keranjang belanja karena sudah resmi dibeli
            CartDetail::where('cart_id', $cart->id)->delete();
            $cart->delete();

            // Simpan permanen ke database jika semua rangkaian proses di atas sukses tanpa kendala
            DB::commit();

            // Redirect pengguna menuju ke halaman pembayaran instruksi invoice
            return redirect()->route('order.payment', $order->id)->with('success', 'Pesanan berhasil dibuat! Silakan lakukan pembayaran untuk menyelesaikan orderan Anda.');

        } catch (\Exception $e) {
            // Gagalkan & batalkan semua perubahan input database jika ada satu baris kode di atas yang error
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan sistem internal: ' . $e->getMessage())->withInput();
        }
    }
}
