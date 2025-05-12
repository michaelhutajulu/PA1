<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class CatalogController extends Controller
{
    /**
     * Menampilkan semua kategori.
     * (Tidak diubah)
     */
    public function index()
    {
        $categories = Category::all();
        return view('catalog.index', compact('categories'));
    }

    /**
     * Menampilkan produk berdasarkan kategori dengan pagination.
     *
     * @param  int  $id ID Kategori
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Mengambil data kategori (tidak berubah)
        $category = Category::findOrFail($id);

        // --- PERUBAHAN DI SINI ---
        // Tentukan jumlah produk per halaman menjadi 20
        $productsPerPage = 20; // <--- Diubah dari 12 menjadi 20
        // -------------------------

        // Mengambil produk berdasarkan kategori ID, diurutkan terbaru, dan dipaginasi
        $products = Product::where('category_id', $id)
                           ->latest() // Opsional: Urutkan dari yang terbaru
                           ->paginate($productsPerPage); // Menggunakan nilai $productsPerPage (yaitu 20)

        // Mengirim data kategori dan produk (yang sudah dipaginasi) ke view (tidak berubah)
        return view('catalog.show', compact('category', 'products'));
    }
}