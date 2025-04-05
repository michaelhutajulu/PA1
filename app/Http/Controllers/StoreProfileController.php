<?php

namespace App\Http\Controllers;

use App\Models\StoreProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StoreProfileController extends Controller
{
    public function index()
    {
        $storeProfile = StoreProfile::first();
        return view('admin.store_profile.index', compact('storeProfile'));
    }

    public function create()
    {
        return view('admin.store_profile.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required', // Sesuai dengan kolom di database
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $storeProfile = new StoreProfile();

        if ($request->hasFile('image')) {
            $storeProfile->image = $request->file('image')->store('store_profile', 'public');
        }

        $storeProfile->title = $request->title;
        $storeProfile->description = $request->description; // Sesuai dengan database
        $storeProfile->save();

        return redirect()->route('store_profile.index')->with('success', 'Profil toko berhasil ditambahkan.');
    }

    public function edit()
    {
        $storeProfile = StoreProfile::first();
        return view('admin.store_profile.edit', compact('storeProfile'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required', // Sesuai dengan database
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $storeProfile = StoreProfile::first() ?? new StoreProfile();

        if ($request->hasFile('image')) {
            if ($storeProfile->image) {
                Storage::disk('public')->delete($storeProfile->image);
            }
            $storeProfile->image = $request->file('image')->store('store_profile', 'public');
        }

        $storeProfile->title = $request->title;
        $storeProfile->description = $request->description; // Sesuai dengan database
        $storeProfile->save();

        return redirect()->route('store_profile.index')->with('success', 'Profil Toko berhasil diperbarui.');
    }
}
