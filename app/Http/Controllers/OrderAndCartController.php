<?php

// app/Http/Controllers/UserController.php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function updateProfile(Request $request)
    {
        $user = User::findOrFail(Auth::id());
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string',
        ]);

        $user->update($request->only('name', 'phone'));
        return redirect()->back()->with('success', 'Informasi akun berhasil diperbarui.');
    }
}
