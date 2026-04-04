<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // 🔹 halaman utama
    public function index()
    {
        return view('welcome');
    }

    // 🔹 halaman login
    public function showLogin()
    {
        return view('auth.login');
    }

    // 🔹 proses login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect('/dashboard');
        }

        return back()->with('error', 'Email atau password salah');
    }

    // 🔹 halaman register
    public function showRegister()
    {
        return view('auth.register');
    }

    // 🔹 proses register
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect('/login')->with('success', 'Register berhasil!');
    }

    // 🔹 logout
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}