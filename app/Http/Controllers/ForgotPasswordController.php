<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    // Menampilkan form untuk memasukkan nama dan email
    public function showVerifyForm()
    {
        return view('auth.forgot-password');
    }

    // Memeriksa nama dan email di database
    public function verifyUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        // Cek apakah kombinasi nama dan email ada di database
        $user = User::where('name', $request->name)
                    ->where('email', $request->email)
                    ->first();

        if ($user) {
            // Jika cocok, redirect ke halaman ubah password dengan email di route
            return redirect()->route('password.reset.form', ['email' => $user->email]);
        } else {
            return back()->withErrors(['email' => 'Nama atau email tidak cocok.']);
        }
    }

    // Menampilkan form untuk mengganti kata sandi
    public function showResetForm($email)
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('forgot.password')->withErrors(['email' => 'Email tidak ditemukan.']);
        }

        return view('auth.reset-password', ['email' => $email]);
    }

    // Mengupdate kata sandi pengguna
    public function updatePassword(Request $request, $email)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('forgot.password')->withErrors(['email' => 'Email tidak ditemukan.']);
        }

        // Update password
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login')->with('status', 'Kata sandi berhasil diperbarui. Silakan login dengan kata sandi baru.');
    }
}
