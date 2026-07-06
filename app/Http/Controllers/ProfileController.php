<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $tab = $request->query('tab', 'dikemas');

        // 1. Hitung total pesanan selesai untuk syarat tier voucher
        $totalCompleted = Order::where('user_id', Auth::id())
            ->whereIn('status', ['completed', 'success', 'selesai'])
            ->count();

        // 2. Semua voucher didefinisikan di sini agar selalu muncul di profil
        $availableVouchers = [
            [
                'title' => 'GOLD MEMBER',
                'desc' => 'Diskon 25% Semua Produk',
                'code' => 'GOLD25',
                'percent' => '25%',
                'class' => 'border-warning',
                'is_locked' => $totalCompleted < 10,
                'requirement' => 'Minimal 10 pesanan selesai'
            ],
            [
                'title' => 'SILVER MEMBER',
                'desc' => 'Diskon 10% Semua Produk',
                'code' => 'SILVER10',
                'percent' => '10%',
                'class' => 'border-danger',
                'is_locked' => $totalCompleted < 5,
                'requirement' => 'Minimal 5 pesanan selesai'
            ],
            [
                'title' => 'MEMBER BARU',
                'desc' => 'Diskon 5% untuk Anda',
                'code' => 'WELCOME5',
                'percent' => '5%',
                'class' => 'border-success',
                'is_locked' => false,
                'requirement' => 'Tanpa minimal pesanan'
            ],
        ];

        // 3. Logika Tab Pesanan
        $query = Order::with(['orderDetails.product'])->where('user_id', Auth::id());

        if ($tab == 'dikemas') {
            $orders = $query->where('status', 'pending')->latest()->get();
        } elseif ($tab == 'dikirim') {
            $orders = $query->whereIn('status', ['shipping', 'dikirim'])->latest()->get();
        } elseif ($tab == 'dinilai') {
            $orders = $query->whereIn('status', ['completed', 'success', 'selesai'])->latest()->get();
        } else {
            $orders = collect();
        }

        // 4. Hitung jumlah order untuk badge info di sidebar
        $counts = [
            'dikemas' => Order::where('user_id', Auth::id())->where('status', 'pending')->count(),
            'dikirim' => Order::where('user_id', Auth::id())->whereIn('status', ['shipping', 'dikirim'])->count(),
            'dinilai' => Order::where('user_id', Auth::id())->whereIn('status', ['completed', 'success', 'selesai'])->count(),
        ];

        // 5. Kirim data ke view profile
        $viewPath = view()->exists('auth.profile') ? 'auth.profile' : 'profile';
        return view($viewPath, compact('user', 'tab', 'orders', 'counts', 'availableVouchers', 'totalCompleted'));
    }
}
