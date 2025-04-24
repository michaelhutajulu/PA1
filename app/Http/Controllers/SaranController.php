<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SaranController extends Controller
{
    /**
     * Menangani pengiriman saran
     */
    public function kirim(Request $request)
    {
        // Validasi request
        $request->validate([
            'pesan' => 'required|string',
        ]);

        // Cek status login
        if (!Auth::check()) {
            // Simpan pesan saran ke session untuk diambil setelah login
            Session::put('draft_saran', $request->pesan);
            
            // Redirect ke halaman login
            return redirect()->route('login')->with('info', 'Silakan login terlebih dahulu untuk mengirim saran.');
        }

        // Jika sudah login, kirim email
        $data = [
            'nama' => auth()->user()->name,
            'email' => auth()->user()->email,
            'pesan' => $request->pesan,
        ];

        Mail::to('siagianrizal02@gmail.com')->send(new \App\Mail\SaranMail($data));

        // Hapus draft dari session jika ada
        Session::forget('draft_saran');

        return back()->with('success', 'Terima kasih atas saran dan masukan Anda!');
    }

    /**
     * Mengambil draft saran dari session (digunakan oleh ajax jika diperlukan)
     */
    public function getDraftSaran()
    {
        return response()->json([
            'draft' => Session::get('draft_saran', '')
        ]);
    }
}