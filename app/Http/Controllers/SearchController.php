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

    $products = Product::where('name', 'like', '%' . $query . '%')->get();

    // Daftar kata kunci populer yang bisa disesuaikan sendiri
    $keywords = ['sepeda', 'kulkas', 'tv', 'mesin cuci', 'laptop', 'handphone', 'kompor', 'kipas angin', 'kamera'];

    $suggestion = null;

    // Jika tidak ada produk ditemukan, cari saran dari daftar keyword
    if ($products->isEmpty()) {
        $closest = null;
        $shortest = -1;

        foreach ($keywords as $keyword) {
            $lev = levenshtein(strtolower($query), strtolower($keyword));

            if ($lev <= strlen($query) / 2 && ($lev < $shortest || $shortest < 0)) {
                $closest = $keyword;
                $shortest = $lev;
            }
        }

        if ($closest) {
            $suggestion = $closest;
        }
    }

    return view('search.results', compact('products', 'query', 'suggestion'));
}

}
