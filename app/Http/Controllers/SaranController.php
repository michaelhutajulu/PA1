<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SaranController extends Controller
{
    public function kirim(Request $request)
    {
        $request->validate([
            'pesan' => 'required|string',
        ]);

        $data = [
            'nama' => auth()->user()->name,
            'email' => auth()->user()->email,
            'pesan' => $request->pesan,
        ];

        Mail::to('mchlhutajulu@gmail.com')->send(new \App\Mail\SaranMail($data));

        return back()->with('success', 'Terima kasih atas saran dan masukan Anda!');
    }
}
