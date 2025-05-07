<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator; // PASTIKAN INI DI-IMPORT

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
        // Validasi input (minimal password di login juga bisa disesuaikan jika ingin sama)
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:6',
        ], [
            'email.required' => 'Alamat email wajib diisi.',
            'email.string'   => 'Alamat email harus berupa teks.',
            'email.email'    => 'Format alamat email tidak valid. Contoh: pengguna@domain.com.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.string'   => 'Kata sandi harus berupa teks.',
            'password.min'      => 'Kata sandi minimal harus :min karakter.',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if ($request->filled('redirect_after_login')) {
                $redirectUrl = $request->input('redirect_after_login');
                if (filter_var($redirectUrl, FILTER_VALIDATE_URL) && strpos($redirectUrl, url('/')) === 0) {
                    return redirect($redirectUrl);
                }
            }

            $user = Auth::user();
            if ($user->email === 'admin@bintangserasi.com') {
                return redirect('/dashboard');
            }

            return redirect()->intended('/');
        }

        return back()
            ->with('error', 'Kombinasi email dan kata sandi tidak cocok. Silakan periksa kembali.')
            ->withInput($request->except('password'));
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    // Menampilkan halaman register
    public function showRegister()
    {
        return view('auth.register');
    }

    // Proses register (INI BAGIAN YANG DIMODIFIKASI)
    public function register(Request $request)
    {
        // Validasi input menggunakan Validator::make() untuk kontrol error bag
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => [
                'required',
                'string',
                'email',
                'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/i',
                'unique:users,email',
            ],
            'password' => [
                'required',
                'string',
                'min:6',
                'confirmed', // Memastikan ada field 'password_confirmation' di form
            ],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.string'   => 'Email harus berupa teks.',
            'email.email'    => 'Format email tidak valid.',
            'email.regex'    => 'Email harus menggunakan domain @gmail.com.',
            'email.unique'   => 'Email sudah terdaftar.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.string'   => 'Kata sandi harus berupa teks.',
            'password.min'      => 'Kata sandi minimal :min karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak sesuai.',
        ]);

        // Jika validasi gagal, kembali dengan error dan flag untuk modal registrasi
        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator, 'register') // Mengarahkan error ke bag 'register'
                ->withInput() // Mengembalikan input lama
                ->with('open_register_modal_on_error', true); // Flag untuk JS agar membuka modal registrasi
        }

        // Jika validasi lolos, baru lanjutkan ke pembuatan user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Jika registrasi berhasil, redirect dengan flag untuk modal login
        return Redirect::back()
            ->with('show_login_modal', true) // Flag untuk JavaScript agar membuka modal login
            ->with('login_success_message', 'Registrasi berhasil! Silakan Masuk.'); // Pesan untuk modal login
    }
}