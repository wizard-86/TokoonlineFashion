<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Ditambahkan untuk mengakses tabel users di database
use Illuminate\Support\Facades\Hash; // Ditambahkan untuk mengamankan/mengenkripsi password

class AuthController extends Controller
{
    // 1. Menampilkan halaman form login
    public function showLogin()
    {
        return view('auth.login');
    }

    // 2. Memproses data dari form login
    public function login(Request $request)
    {
        // Validasi input wajib diisi
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Menggunakan fitur Auth bawaan Laravel untuk cek email & password
        if (Auth::attempt($credentials)) {
            // Amankan session user
            $request->session()->regenerate();

            // Jika sukses login, arahkan ke halaman /home
            return redirect()->intended('/home');
        }

        // Jika salah, kembalikan ke halaman login dengan pesan error
        return back()->withErrors([
            'login_error' => 'Email atau password yang kamu masukkan salah.',
        ])->onlyInput('email');
    }

    // 3. Menampilkan halaman form register akun baru
    public function showRegister()
    {
        return view('auth.register');
    }

    // 4. Memproses data pendaftaran akun baru (Register)
    public function register(Request $request)
    {
        // Validasi input data register
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed', // 'confirmed' mewajibkan field password_confirmation
        ]);

        // Simpan data user baru ke database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Password wajib di-hash demi keamanan
        ]);

        // Otomatis buatkan session login setelah sukses mendaftar
        Auth::login($user);

        // Alihkan langsung ke dashboard utama belanja
        return redirect()->route('home')->with('success', 'Akun berhasil dibuat! Selamat datang.');
    }

    // 5. Memproses Logout (Keluar Sistem)
    public function logout(Request $request)
    {
        // Hapus status login
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Setelah logout, tendang balik ke landing page awal (/)
        return redirect('/');
    }
}
