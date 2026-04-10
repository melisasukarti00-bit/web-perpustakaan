<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
   // 🔹 LOGIN

public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {

        $user = Auth::user();

        // redirect sesuai role
        if ($user->role == 'anggota') {
            return redirect('/anggota/dashboard');
        }

        if ($user->role == 'petugas') {
            return redirect('/petugas/dashboard');
        }

        if ($user->role == 'kepala') {
            return redirect('/kepala/dashboard');
        }
    }

    return back()->with('error', 'Email atau password salah');
}

// 🔹 REGISTER
public function register(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'anggota'
    ]);

    Auth::login($user);

    return redirect()->route('anggota.dashboard');
}

public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login');
}
}