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

        return view('search.results', compact('products', 'query'));
    }
}
