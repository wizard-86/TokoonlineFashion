<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | FORM REGISTER
    |--------------------------------------------------------------------------
    */

    public function showRegister()
    {
        return view('register');
    }

    /*
    |--------------------------------------------------------------------------
    | PROSES REGISTER
    |--------------------------------------------------------------------------
    */

    public function register(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|email|unique:users,email',
        'phone' => 'required|max:20',
        'password' => 'required|min:6|confirmed',
    ]);

    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'phone' => $validated['phone'],
        'password' => Hash::make($validated['password']),
        'role' => 'customer',
    ]);

    // Login otomatis
    Auth::login($user);

    // Regenerate session
    $request->session()->regenerate();

    return redirect()->route('/')
        ->with('success', 'Akun berhasil dibuat.');
}

    /*
    |--------------------------------------------------------------------------
    | FORM LOGIN
    |--------------------------------------------------------------------------
    */

    public function showLogin()
    {
        return view('auth.login');
    }

    /*
    |--------------------------------------------------------------------------
    | PROSES LOGIN
    |--------------------------------------------------------------------------
    */

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (! Auth::attempt($credentials)) {
            return back()
                ->withErrors([
                    'login_error' => 'Email atau password salah.'
                ])
                ->withInput();
        }

        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('search2');
    }

    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('welcome');
    }
}