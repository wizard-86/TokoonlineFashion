<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Memproses Checkout dari Cart menjadi Order
     */
    public function checkout(Request $request)
    {
        $userId = Auth::id(); // Mengambil ID user yang sedang login

        // 1. Ambil data keranjang milik user beserta produknya
        $cart = Cart::with('details.product')->where('user_id', $userId)->first();

        if (!$cart || $cart->details->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang belanja Anda kosong.');
        }

        // Gunakan Database Transaction agar jika salah satu proses error, database dibatalkan (aman)
        DB::beginTransaction();

        try {
            // 2. Hitung total harga belanjaan
            $totalAmount = 0;
            foreach ($cart->details as $detail) {
                $totalAmount += $detail->quantity * $detail->product->price;
            }

            // 3. Simpan data ke tabel 'orders'
            $order = Order::create([
                'user_id'      => $userId,
                'total_amount' => $totalAmount,
                'status'       => 'pending'
            ]);

            // 4. Pindahkan semua isi keranjang ke tabel 'order_details'
            foreach ($cart->details as $detail) {
                OrderDetail::create([
                    'order_id'   => $order->id,
                    'product_id' => $detail->product_id,
                    'quantity'   => $detail->quantity,
                    'price'      => $detail->product->price // Mengunci harga saat dibeli
                ]);
            }

            // 5. Buat data record di tabel 'payment' dan 'shipping'
            Payment::create([
                'order_id'       => $order->id,
                'payment_method' => $request->payment_method ?? 'Belum Memilih',
                'amount'         => $totalAmount,
                'status'         => 'pending'
            ]);

            Shipping::create([
                'order_id'      => $order->id,
                'courier'       => $request->courier ?? 'Belum Memilih', // Menangkap input kurir (JNE, dll)
                'address'       => $request->address ?? 'Alamat belum diisi', // Menangkap input alamat lengkap
                'shipping_cost' => 0,
                'status'        => 'pending'
            ]);

            // 6. KOSONGKAN KERANJANG BELANJA (Hapus detail keranjang)
            $cart->details()->delete();

            DB::commit(); // Simpan permanen perubahan di database

            // Alihkan user ke halaman pembayaran dengan membawa ID Order baru
            return redirect()->route('order.payment', $order->id)->with('success', 'Pesanan berhasil dibuat!');

        } catch (\Exception $e) {
            DB::rollBack(); // Batalkan semua jika ada error
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * MENAMPILKAN HALAMAN PEMBAYARAN (Fungsi Baru yang Mengatasi Eror)
     */
   /**
     * MENAMPILKAN HALAMAN PEMBAYARAN (Sudah disesuaikan dengan Model Order)
     */
    public function showPaymentPage($id)
    {
        // Memanggil relasi 'details.product' sesuai dengan nama fungsi di model Order Anda
        $order = Order::with('details.product')->findOrFail($id);

        // Memastikan order ini memang milik user yang sedang login
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        // Mengarahkan ke file view payment Anda
        return view('order.payment', compact('order'));
    }

    /**
     * Menampilkan riwayat pesanan di halaman profil user
     */
    public function history()
    {
        $orders = Order::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('profile.orders', compact('orders'));
    }
}
