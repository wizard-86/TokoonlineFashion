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

        // 2. Definisi voucher baru sesuai permintaan
        $availableVouchers = [
            [
                'title' => 'GOLD MEMBER',
                'desc' => 'Diskon 15% minimal 4 barang',
                'code' => 'GOLD15',
                'percent' => '15%',
                'class' => 'border-warning',
                'is_locked' => $totalCompleted < 4,
                'requirement' => 'Minimal 4 barang di checkout'
            ],
            [
                'title' => 'SILVER MEMBER',
                'desc' => 'Diskon 10% minimal 2 barang',
                'code' => 'SILVER10',
                'percent' => '10%',
                'class' => 'border-danger',
                'is_locked' => $totalCompleted < 2,
                'requirement' => 'Minimal 2 barang di checkout'
            ],
            [
                'title' => 'MEMBER BARU',
                'desc' => 'Diskon 5% untuk Anda',
                'code' => 'WELCOME5',
                'percent' => '5%',
                'class' => 'border-success',
                'is_locked' => false,
                'requirement' => 'Bebas kategori'
            ],
        ];

        // 3. Logika Tab Pesanan (Mendukung status pending dan processing)
        $query = Order::with(['orderDetails.product'])->where('user_id', Auth::id());

        if ($tab == 'dikemas') {
            $orders = $query->whereIn('status', ['pending', 'processing'])->latest()->get();
        } elseif ($tab == 'dikirim') {
            $orders = $query->whereIn('status', ['shipping', 'dikirim'])->latest()->get();
        } elseif ($tab == 'dinilai') {
            $orders = $query->whereIn('status', ['completed', 'success', 'selesai'])->latest()->get();
        } else {
            $orders = collect();
        }

        // 4. Hitung jumlah order untuk badge info di sidebar
        $counts = [
            'dikemas' => Order::where('user_id', Auth::id())->whereIn('status', ['pending', 'processing'])->count(),
            'dikirim' => Order::where('user_id', Auth::id())->whereIn('status', ['shipping', 'dikirim'])->count(),
            'dinilai' => Order::where('user_id', Auth::id())->whereIn('status', ['completed', 'success', 'selesai'])->count(),
        ];

        // 5. Kirim data ke view profile
        $viewPath = view()->exists('auth.profile') ? 'auth.profile' : 'profile';
        return view($viewPath, compact('user', 'tab', 'orders', 'counts', 'availableVouchers', 'totalCompleted'));
    }
}
