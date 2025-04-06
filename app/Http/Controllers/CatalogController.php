<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class CatalogController extends Controller
{
    // Tampilkan semua kategori
    public function index()
    {
        $categories = Category::all();
        return view('catalog.index', compact('categories'));
    }

    // Tampilkan produk berdasarkan kategori
    public function show($id)
    {
        $category = Category::findOrFail($id);
        $products = Product::where('category_id', $id)->get();

        return view('catalog.show', compact('category', 'products'));
    }
}
