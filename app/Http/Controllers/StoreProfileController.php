<?php

namespace App\Http\Controllers;

use App\Models\StoreProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreProfileController extends Controller
{
    // Menampilkan profil toko (data terbaru) untuk admin
    public function index()
    {
        $storeProfile = StoreProfile::latest()->first();
        return view('admin.store_profile.index', compact('storeProfile'));
    }

    // Menampilkan form untuk membuat profil toko baru
    public function create()
    {
        return view('admin.store_profile.create');
    }

    // Menyimpan profil toko baru ke database
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'header_description' => 'required|string',
            'header_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'store_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'main_description' => 'required|string',
        ]);

        if ($request->hasFile('header_image')) {
            $data['header_image'] = $request->file('header_image')->store('headers', 'public');
        }

        if ($request->hasFile('store_image')) {
            $data['store_image'] = $request->file('store_image')->store('stores', 'public');
        }

        $data['user_id'] = Auth::id();

        StoreProfile::create($data);
        return redirect()->route('store_profile.index')->with('success', 'Profil toko berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit profil toko (data terbaru)
    public function edit()
    {
        $storeProfile = StoreProfile::latest()->first();
        return view('admin.store_profile.edit', compact('storeProfile'));
    }
    
    // Mengupdate profil toko (data terbaru) di database
    public function update(Request $request)
    {
        $storeProfile = StoreProfile::latest()->first(); // ambil yang terakhir dibuat
    
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'header_description' => 'required|string',
            'header_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'store_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'main_description' => 'required|string',
        ]);
    
        if ($request->hasFile('header_image')) {
            $data['header_image'] = $request->file('header_image')->store('headers', 'public');
        } else {
            $data['header_image'] = $storeProfile->header_image;
        }
    
        if ($request->hasFile('store_image')) {
            $data['store_image'] = $request->file('store_image')->store('stores', 'public');
        } else {
            $data['store_image'] = $storeProfile->store_image;
        }
    
        $storeProfile->update($data);
    
        return redirect()->route('store_profile.index')->with('success', 'Profil toko berhasil diperbarui.');
    }
    
    // Menghapus profil toko (data terbaru) dari database
    public function destroy(StoreProfile $storeProfile)
    {
        $storeProfile->delete();
        return redirect()->route('store_profile.index')->with('success', 'Profil toko berhasil dihapus.');
    }

    // Menampilkan profil toko (data terbaru) untuk frontend
    public function frontend()
    {
        $storeProfile = StoreProfile::latest()->first(); // atau find(1)
        return view('profil_toko.index', compact('storeProfile'));
    }
}
