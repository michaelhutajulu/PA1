<?php

namespace App\Http\Controllers;

use App\Models\StoreProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Pastikan Storage di-import jika Anda menghapus gambar

class StoreProfileController extends Controller
{
    public function index()
    {
        $storeProfile = StoreProfile::latest()->first();
        return view('admin.store_profile.index', compact('storeProfile'));
    }

    public function create()
    {
        return view('admin.store_profile.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'header_description' => 'required|string',
            'header_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Menambahkan webp
            'store_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',  // Menambahkan webp
            'main_description' => 'required|string',
        ]);

        if ($request->hasFile('header_image')) {
            $data['header_image'] = $request->file('header_image')->store('store_profiles/headers', 'public'); // Path lebih spesifik
        }

        if ($request->hasFile('store_image')) {
            $data['store_image'] = $request->file('store_image')->store('store_profiles/stores', 'public'); // Path lebih spesifik
        }

        // Menambahkan user_id untuk menyimpan ID admin yang membuat profil toko
        $data['user_id'] = auth()->id(); // Menyimpan ID pengguna yang sedang login

        StoreProfile::create($data);

        // ==========================================================
        // PERUBAHAN DI SINI
        // ==========================================================
        return redirect()->route('admin.store_profile.index')->with('success', 'Profil toko berhasil ditambahkan.');
    }

    public function edit() // Umumnya, jika ada route edit, ia menerima ID atau model binding
    {
        $storeProfile = StoreProfile::latest()->first();
        // Jika tidak ada profil, mungkin redirect ke create atau tampilkan pesan
        if (!$storeProfile) {
            return redirect()->route('admin.store_profile.create')->with('info', 'Silakan buat profil toko terlebih dahulu.');
        }
        return view('admin.store_profile.edit', compact('storeProfile'));
    }

    public function update(Request $request) // Umumnya, jika ada route update, ia menerima ID atau model binding
    {
        $storeProfile = StoreProfile::latest()->first(); // ambil yang terakhir dibuat
        // Pastikan profil ada sebelum update
        if (!$storeProfile) {
            return redirect()->route('admin.store_profile.index')->with('error', 'Profil toko tidak ditemukan untuk diperbarui.');
        }

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'header_description' => 'required|string',
            'header_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Menambahkan webp
            'store_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',  // Menambahkan webp
            'main_description' => 'required|string',
        ]);

        if ($request->hasFile('header_image')) {
            // Hapus gambar lama jika ada
            if ($storeProfile->header_image) {
                Storage::disk('public')->delete($storeProfile->header_image);
            }
            $data['header_image'] = $request->file('header_image')->store('store_profiles/headers', 'public');
        } else {
            // Jika tidak ada file baru, dan Anda tidak ingin menghapus gambar lama jika field kosong
            // maka baris ini tidak diperlukan jika $storeProfile->header_image sudah benar
            // $data['header_image'] = $storeProfile->header_image; 
            // Cukup pastikan $data['header_image'] tidak di-set jika tidak ada file baru,
            // sehingga nilai lama dari database tidak tertimpa null.
            // Jika Anda ingin mengizinkan penghapusan gambar dengan tidak mengirim file,
            // maka perlu logika tambahan (misalnya checkbox "hapus gambar").
            // Untuk saat ini, kita asumsikan gambar lama dipertahankan jika tidak ada yang baru.
        }

        if ($request->hasFile('store_image')) {
            // Hapus gambar lama jika ada
            if ($storeProfile->store_image) {
                Storage::disk('public')->delete($storeProfile->store_image);
            }
            $data['store_image'] = $request->file('store_image')->store('store_profiles/stores', 'public');
        } else {
            // Sama seperti header_image
            // $data['store_image'] = $storeProfile->store_image;
        }

        // Hanya update field yang ada di $data, gambar lama akan tetap jika tidak ada file baru
        $storeProfile->update($data);

        // ==========================================================
        // PERUBAHAN DI SINI
        // ==========================================================
        return redirect()->route('admin.store_profile.index')->with('success', 'Profil toko berhasil diperbarui.');
    }

    public function destroy(StoreProfile $storeProfile) // Menggunakan Route Model Binding
    {
        // Hapus gambar terkait sebelum menghapus profil
        if ($storeProfile->header_image) {
            Storage::disk('public')->delete($storeProfile->header_image);
        }
        if ($storeProfile->store_image) {
            Storage::disk('public')->delete($storeProfile->store_image);
        }
        $storeProfile->delete();

        // ==========================================================
        // PERUBAHAN DI SINI
        // ==========================================================
        return redirect()->route('admin.store_profile.index')->with('success', 'Profil toko berhasil dihapus.');
    }

    // Method frontend tidak perlu diubah karena route-nya tidak terpengaruh oleh grup admin
    public function frontend()
    {
        $storeProfile = StoreProfile::latest()->first();
        return view('profil_toko.index', compact('storeProfile'));
    }
}