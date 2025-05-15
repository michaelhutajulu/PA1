<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        // --- Logika $featuredProducts TIDAK DIPERLUKAN LAGI untuk bagian "Mau Cari Apa" ---
        // $categories = Category::all();
        // $featuredProducts = [];
        // ... logika $featuredProducts sebelumnya ...

        // --- KODE ASLI ANDA UNTUK $productsPerCategory - TETAP DIPERTAHANKAN ---
        $categories = Category::all(); // Tetap dibutuhkan untuk $productsPerCategory
        $productsPerCategory = [];
        foreach ($categories as $category) {
            $product = Product::where('category_id', $category->id)->latest()->first();
            if ($product) {
                $productsPerCategory[] = $product;
            }
        }
        // --- AKHIR KODE ASLI $productsPerCategory ---

        // Kirim ke view. $featuredProducts tidak lagi dikirim untuk tujuan ini.
        return view('home', compact(
            'productsPerCategory'
            // 'featuredProducts' tidak lagi dikirim untuk "Mau Cari Apa"
        ));
    }

    // Metode getRandomProduct() tetap ada jika masih digunakan di tempat lain, atau bisa dihapus jika tidak.
    // Untuk kasus ini, kita akan membuat yang baru untuk 4 produk.
    private function getRandomProduct() // Ini bisa jadi helper internal
    {
        $randomCategory = Category::whereHas('products')->inRandomOrder()->first();
        if ($randomCategory) {
            return $randomCategory->products()->inRandomOrder()->first();
        }
        return Product::inRandomOrder()->first();
    }

    // --- 👇 METODE BARU: Mengambil 4 Produk Acak Unik dari Kategori Acak 👇 ---
    public function getFourRandomProductsAjax()
    {
        $products = [];
        $productIds = []; // Untuk memastikan keunikan produk
        $attempts = 0; // Untuk mencegah infinite loop jika produk sangat sedikit

        // Ambil kategori yang memiliki produk
        $categoriesWithProducts = Category::whereHas('products')->get()->shuffle();

        if ($categoriesWithProducts->isEmpty()) {
            // Fallback jika tidak ada kategori dengan produk, ambil 4 produk acak dari semua produk
            $fallbackProducts = Product::inRandomOrder()->take(4)->get();
             foreach ($fallbackProducts as $product) {
                $products[] = $this->formatProductData($product);
            }
            return response()->json(['success' => !empty($products), 'data' => $products]);
        }

        // Usahakan mengambil 4 produk unik dari kategori berbeda (atau sama jika perlu)
        while (count($products) < 4 && $attempts < 20) {
            // Ambil kategori acak dari yang sudah di-shuffle
            $randomCategory = $categoriesWithProducts->pop(); // Ambil dan hapus dari koleksi
            if (!$randomCategory) { // Jika semua kategori sudah terpakai
                // Ambil produk acak dari semua produk yang belum terpilih
                $product = Product::whereNotIn('id', $productIds)->inRandomOrder()->first();
            } else {
                // Ambil produk acak dari kategori ini yang belum terpilih
                $product = $randomCategory->products()->whereNotIn('id', $productIds)->inRandomOrder()->first();
            }

            if ($product) {
                $products[] = $this->formatProductData($product);
                $productIds[] = $product->id;
            }

            // Jika kategori habis dan produk masih kurang, isi dari produk acak global
            if ($categoriesWithProducts->isEmpty() && count($products) < 4 && $product == null) {
                 $neededMore = 4 - count($products);
                 $additionalProducts = Product::whereNotIn('id', $productIds)->inRandomOrder()->take($neededMore)->get();
                 foreach($additionalProducts as $p) {
                     if(count($products) < 4) {
                        $products[] = $this->formatProductData($p);
                        $productIds[] = $p->id;
                     }
                 }
                 break; // Keluar dari loop utama
            }
            $attempts++;
        }

        return response()->json(['success' => !empty($products), 'data' => $products]);
    }

    // Helper untuk format data produk
    private function formatProductData(Product $product)
    {
        return [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'formatted_price' => 'Rp ' . number_format($product->price, 0, ',', '.'),
            'image_url' => asset('storage/' . $product->image),
            'detail_url' => route('produk.detail.publik', $product->id),
        ];
    }
    // --- 👆 AKHIR METODE BARU 👆 ---

    // getRandomProductAjax() tunggal bisa tetap ada jika Anda punya keperluan lain untuk itu
    // public function getRandomProductAjax() { ... }
}