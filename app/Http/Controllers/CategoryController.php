<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle file upload
        $imagePath = $request->file('image') ? $request->file('image')->store('categories', 'public') : null;

        // Create new category with user_id from logged-in admin
        Category::create([
            'name' => $request->name,
            'image' => $imagePath,
            'user_id' => auth()->id(), // Set the user_id to the logged-in user's ID
        ]);

        // ==========================================================
        // PERUBAHAN DI SINI
        // ==========================================================
        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048', // Sebaiknya 'nullable' jika gambar tidak wajib diupdate
        ]);

        // If the image has been updated, delete the old one and store the new one
        if ($request->hasFile('image')) {
            if ($category->image) { // Tambahkan pengecekan jika gambar lama ada sebelum dihapus
                Storage::disk('public')->delete($category->image);
            }
            $category->image = $request->file('image')->store('categories', 'public');
        }

        // Update the category with the new data
        $category->update([
            'name' => $request->name,
            'image' => $category->image,  // Updated image path
            // 'user_id' is not necessary to update because it should not change after the category is created
        ]);

        // ==========================================================
        // PERUBAHAN DI SINI
        // ==========================================================
        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Category $category)
    {
        // Delete the image from storage before deleting the category
        if ($category->image) { // Tambahkan pengecekan jika gambar ada sebelum dihapus
            Storage::disk('public')->delete($category->image);
        }
        $category->delete();

        // ==========================================================
        // PERUBAHAN DI SINI
        // ==========================================================
        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}