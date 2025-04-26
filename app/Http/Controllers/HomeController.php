<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil semua kategori
        $categories = Category::all();

        // --- Baris Pertama: "Mau cari apa hari ini?" ---
        $featuredProducts = [];
        $selectedCategories = $categories->take(4); // Ambil 4 kategori pertama

        foreach ($selectedCategories as $category) {
            $product = Product::where('category_id', $category->id)->latest()->first();
            if ($product) {
                $featuredProducts[] = $product;
            }
        }

        // --- Baris Kedua: "Produk per kategori (semua kategori tampil 1 produk)" ---
        $productsPerCategory = [];

        foreach ($categories as $category) {
            $product = Product::where('category_id', $category->id)->latest()->first();
            if ($product) {
                $productsPerCategory[] = $product;
            }
        }

        // Kirim ke view
        return view('home', compact('featuredProducts', 'productsPerCategory'));
    }
}