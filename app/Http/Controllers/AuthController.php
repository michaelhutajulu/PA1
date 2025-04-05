<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
    
        // Coba autentikasi user
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
    
            // Cek apakah emailnya adalah admin
            if ($user->email === 'admin@bintangserasi.com') {
                return redirect()->intended('/dashboard');
            }
    
            // Kalau bukan admin, arahkan ke home (beranda user)
            return redirect()->intended('/');
        }
    
        // Kalau login gagal
        return redirect()->back()->with('error', 'Akun tidak ditemukan atau password salah.');
    }
    

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Anda telah logout.');
    }

    // Menampilkan halaman register
    public function showRegister()
    {
        return view('auth.register');
    }

    // Proses register
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}
