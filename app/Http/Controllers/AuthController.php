<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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
        // ✅ Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
        ]);
    
        // ✅ Ambil hanya email & password
        $credentials = $request->only('email', 'password');
    
        // ✅ Coba autentikasi
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->email === 'admin@bintangserasi.com') {
                return redirect()->intended('/dashboard');
            }
            return redirect()->intended('/');
        }
    
        // ❌ Jika gagal login
        return back()->with('error', 'Email atau password salah');
    }
    

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Berhasil logout.');
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
            'name' => 'required|string|max:100',
            'email' => [
                'required',
                'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/',
                'unique:users,email',
            ],
            'password' => [
                'required',
                'min:8',
                'regex:/^(?=.*[!@#$%^&*()_+\-=\[\]{};:"\\|,.<>\/?])[A-Z][A-Za-z0-9!@#$%^&*()_+\-=\[\]{};:"\\|,.<>\/?]{7,}$/',
                'confirmed',
            ],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.regex' => 'Email harus menggunakan domain @gmail.com.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.regex' => 'Password harus diawali huruf kapital dan mengandung karakter unik.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
        ]);
    
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    
        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
    
}
