<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('auth.profile', compact('user'));
    }

    public function dikemas()
    {
        // Mengambil pesanan yang berstatus pending / sedang dikemas
        $orders = Order::with(['orderDetails.product', 'payment', 'shipping'])
            ->where('user_id', Auth::id())
            ->where('status', 'pending')
            ->latest()
            ->get();

        return view('profile.dikemas', compact('orders'));
    }

    public function dikirim()
    {
        // Mengambil pesanan yang sedang dalam proses kurir pengiriman
        $orders = Order::with(['orderDetails.product', 'shipping'])
            ->where('user_id', Auth::id())
            ->whereHas('shipping', function($query) {
                $query->where('status', 'shipping');
            })
            ->latest()
            ->get();

        return view('profile.dikirim', compact('orders'));
    }

    public function dinilai()
    {
        // Mengambil riwayat pesanan selesai yang siap diberikan ulasan
        $orders = Order::with(['orderDetails.product'])
            ->where('user_id', Auth::id())
            ->where('status', 'completed')
            ->latest()
            ->get();

        return view('profile.dinilai', compact('orders'));
    }
}
