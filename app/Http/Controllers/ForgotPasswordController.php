<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput(); // Mengembalikan input lama agar form terisi kembali
        }

        // Cek apakah kombinasi nama dan email ada di database
        $user = User::where('name', $request->name)
                    ->where('email', $request->email)
                    ->first();

        if ($user) {
            // Jika cocok, redirect ke halaman ubah password dengan email di route
            // Opsional: Simpan email di session untuk validasi tambahan di showResetForm jika diperlukan.
            // $request->session()->put('password_reset_email_for_verification', $user->email);

            return redirect()->route('password.reset.form', ['email' => $user->email]);
        } else {
            // Kembalikan dengan error spesifik untuk kombinasi nama/email
            return back()
                ->withErrors(['credentials' => 'Kombinasi nama pengguna dan email tidak ditemukan.'])
                ->withInput();
        }
    }

    // Menampilkan form untuk mengganti kata sandi
    public function showResetForm(Request $request, $email)
    {
        // Opsional: Validasi bahwa pengguna datang dari alur yang benar menggunakan session
        // $verifiedEmail = $request->session()->get('password_reset_email_for_verification');
        // if (!$verifiedEmail || $verifiedEmail !== $email) {
        //     $request->session()->forget('password_reset_email_for_verification'); // Hapus session jika tidak valid
        //     return redirect()->route('forgot.password')->with('error', 'Sesi reset tidak valid atau telah kedaluwarsa.');
        // }

        $user = User::where('email', $email)->first();

        if (!$user) {
            // Jika email tidak ditemukan (misalnya URL dimanipulasi)
            // $request->session()->forget('password_reset_email_for_verification'); // Hapus session jika pengguna tidak ditemukan
            return redirect()->route('forgot.password')
                             ->with('error', 'Permintaan reset kata sandi tidak valid atau email tidak ditemukan.');
        }

        return view('auth.reset-password', ['email' => $email]);
    }

    // Mengupdate kata sandi pengguna
    public function updatePassword(Request $request, $email)
    {
        // Validasi input password
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput(); // Mengembalikan input lama untuk field password (meskipun browser biasanya mengosongkannya)
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            // Jika email tidak ditemukan (misalnya URL dimanipulasi saat submit)
            return redirect()->route('forgot.password')
                             ->with('error', 'Gagal memperbarui kata sandi. Pengguna tidak ditemukan.');
        }

        // Update password
        $user->password = Hash::make($request->password);
        $user->save();

        // Hapus session verifikasi jika Anda menggunakannya
        // $request->session()->forget('password_reset_email_for_verification');

        // Redirect ke halaman home dengan pesan status spesifik untuk reset password
        // dan sinyal untuk membuka modal login
        return redirect()->route('home') // Pastikan Anda memiliki route bernama 'home'
                         ->with('status_from_password_reset', 'Kata sandi Anda telah berhasil diperbarui!') // Key baru untuk pesan
                         ->with('open_login_modal', true); // Sinyal untuk membuka modal
    }
}