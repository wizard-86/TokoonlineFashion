<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function showPayment(int $id)
    {
        $order = Order::with(['payment', 'orderDetails.product'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        // Diubah dari 'order.payment' menjadi 'auth.profile' karena form bayar kamu menyatu di frame profil
        // Atau jika kamu punya file auth/payment.blade.php ganti menjadi 'auth.payment'
        return view('auth.profile', compact('order'));
    }

    public function confirmPayment(Request $request, int $id)
    {
        $order = Order::where('user_id', Auth::id())->findOrFail($id);

        $payment = Payment::where('order_id', $order->id)->first();
        if ($payment) {
            $payment->update([
                'status' => 'success',
                'payment_date' => now()
            ]);
        }

        return redirect()->route('profile.dikemas')->with('success', 'Konfirmasi pembayaran berhasil diproses.');
    }
}
