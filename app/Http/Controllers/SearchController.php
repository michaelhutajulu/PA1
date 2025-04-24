<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

        if (!$query || trim($query) === '') {
            return redirect()->back()->with('error', 'Masukkan kata kunci untuk mencari produk.');
        }

        // Ambil produk berdasarkan pencarian
        $products = Product::where('name', 'like', '%' . $query . '%')->get();

        // Ambil kata kunci umum (hanya satu kata penting dari setiap produk)
        $keywords = Product::all()->pluck('name')->map(function ($name) {
            // Ambil kata pertama atau kategori umum, bisa dikembangkan
            return strtolower(explode(' ', $name)[0]);
        })->unique()->values()->toArray();

        $suggestion = null;

        // Jika tidak ada produk ditemukan, baru cari saran
        if ($products->isEmpty()) {
            $lowerQuery = strtolower($query);

            // Jika query sudah cocok dengan kata kunci umum, jangan beri saran
            if (!in_array($lowerQuery, $keywords)) {
                $closest = null;
                $shortest = -1;

                foreach ($keywords as $keyword) {
                    $lev = levenshtein($lowerQuery, $keyword);

                    if ($lev <= max(1, min(strlen($query), strlen($keyword)) / 2) && ($lev < $shortest || $shortest < 0)) {
                        $closest = ucfirst($keyword); // Kapitalisasi saran
                        $shortest = $lev;
                    }
                }

                $suggestion = $closest;
            }
        }

        return view('search.results', compact('products', 'query', 'suggestion'));
    }
}
