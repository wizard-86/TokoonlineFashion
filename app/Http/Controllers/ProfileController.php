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

        // Mengambil parameter ?tab=... dari URL, default-nya adalah 'dikemas'
        $tab = $request->query('tab', 'dikemas');

        // Ambil data pesanan milik user yang sedang login
        $query = Order::with(['orderDetails.product'])->where('user_id', Auth::id());

        // Filter data berdasarkan tab aktif
        if ($tab == 'dikemas') {
            $orders = $query->where('status', 'pending')->latest()->get();
        } elseif ($tab == 'dikirim') {
            $orders = $query->whereIn('status', ['shipping', 'dikirim'])->latest()->get();
        } elseif ($tab == 'dinilai') {
            $orders = $query->whereIn('status', ['completed', 'success', 'selesai'])->latest()->get();
        } else {
            $orders = collect(); // Kosong untuk tab voucher
        }

        // Hitung jumlah badge secara dinamis untuk ditaruh di sidebar
        $counts = [
            'dikemas' => Order::where('user_id', Auth::id())->where('status', 'pending')->count(),
            'dikirim' => Order::where('user_id', Auth::id())->whereIn('status', ['shipping', 'dikirim'])->count(),
            'dinilai' => Order::where('user_id', Auth::id())->whereIn('status', ['completed', 'success', 'selesai'])->count(),
        ];

        // Deteksi lokasi file view utama profilmu (bisa di 'profile' atau 'auth.profile')
        $viewPath = view()->exists('auth.profile') ? 'auth.profile' : 'profile';

        return view($viewPath, compact('user', 'tab', 'orders', 'counts'));
    }
}
