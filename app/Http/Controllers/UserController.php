<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * Menampilkan semua data user ke halaman indeks admin.
     */
    public function index()
    {
        $users = User::latest()->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     * Menampilkan form untuk menambah user baru (via admin panel).
     */
   /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mengarah ke file resources/views/auth/register.blade.php
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     * Menyimpan data user baru ke database (Register / Tambah Manual).
     */
    public function store(Request $request)
    {
        // Validasi input data sesuai kebutuhan tabel user Anda
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email',
            'phone'    => 'required|string|max:20',
            'role'     => 'required|in:admin,customer',
            'password' => 'required|string|min:6|confirmed', // Harus cocok dengan password_confirmation
        ]);

        // Menyimpan data ke database menggunakan Attribute Fillable
        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'role'     => $request->role,
            'password' => Hash::make($request->password), // Amankan password dengan enkripsi/hash
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     * Menampilkan detail dari satu user tertentu.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     * Menampilkan form edit data user.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     * Memperbarui data user di database.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        // Validasi data (Email unik diabaikan untuk user ini sendiri)
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone'    => 'required|string|max:20',
            'role'     => 'required|in:admin,customer',
            'password' => 'nullable|string|min:6|confirmed', // Kosongkan jika password tidak ingin diganti
        ]);

        // Buat data penampung untuk update
        $dataUpdate = [
            'name'  => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role'  => $request->role,
        ];

        // Jika password diisi, enkripsi lalu masukkan ke data update
        if ($request->filled('password')) {
            $dataUpdate['password'] = Hash::make($request->password);
        }

        $user->update($dataUpdate);

        return redirect()->route('users.index')->with('success', 'Data user berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     * Menghapus user dari database.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        // Jika ingin diarahkan ke halaman login setelah daftar
return redirect()->route('login')->with('success', 'Akun berhasil dibuat! Silakan masuk.');
    }
}
