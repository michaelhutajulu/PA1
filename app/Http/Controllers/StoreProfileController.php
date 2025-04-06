<?php

namespace App\Http\Controllers;

use App\Models\StoreProfile;
use Illuminate\Http\Request;

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

        StoreProfile::create($data);
        return redirect()->route('store_profile.index')->with('success', 'Profil toko berhasil ditambahkan.');
    }

    public function edit(StoreProfile $storeProfile)
    {
        return view('admin.store_profile.edit', compact('storeProfile'));
    }

    public function update(Request $request, StoreProfile $storeProfile)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'header_description' => 'required|string',
            'header_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'store_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'main_description' => 'required|string',
        ]);

        if ($request->hasFile('header_image')) {
            $data['header_image'] = $request->file('header_image')->store('headers', 'public');
        }

        if ($request->hasFile('store_image')) {
            $data['store_image'] = $request->file('store_image')->store('stores', 'public');
        }

        $storeProfile->update($data);
        return redirect()->route('store-profiles.index')->with('success', 'Profil toko berhasil diperbarui.');
    }

    public function destroy(StoreProfile $storeProfile)
    {
        $storeProfile->delete();
        return redirect()->route('store-profiles.index')->with('success', 'Profil toko berhasil dihapus.');
    }

    public function frontend()
{
    $storeProfile = StoreProfile::latest()->first(); // atau find(1) kalau datanya cuma satu
    return view('profil_toko.index', compact('storeProfile'));
}

}
