<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // Halaman Utama Profil (Menampilkan Barang Dikemas)
    public function index()
    {
        return view('profile.dikemas');
    }

    // Halaman Barang Dikirim
    public function dikirim()
    {
        return view('profile.dikirim');
    }

    // Halaman Barang Dinilai
    public function dinilai()
    {
        return view('profile.dinilai');
    }

    // Halaman Diskon & Voucher
    public function voucher()
    {
        return view('profile.voucher');
    }
}
