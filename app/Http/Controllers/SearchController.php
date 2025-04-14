<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
    
        $products = Product::where('name', 'like', '%' . $query . '%')->get();
    
        return view('search.results', compact('products', 'query'));
    }
    
}

