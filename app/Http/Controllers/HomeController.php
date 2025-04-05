<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::latest()->take(8)->get(); // ambil 8 produk terbaru
        return view('home', compact('products'));
    }
}
