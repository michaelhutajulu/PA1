<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Saran;

class SaranController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'pesan' => 'required|string|max:1000',
        ]);

        Saran::create([
            'nama' => $request->nama,
            'pesan' => $request->pesan,
        ]);

        return redirect()->back()->with('success', 'Terima kasih atas saran Anda!');
    }
}
