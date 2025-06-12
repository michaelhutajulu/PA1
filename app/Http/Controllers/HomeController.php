<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $categoryIds = Category::whereHas('products')->take(5)->pluck('id');
        $productsByCategories = Product::whereIn('category_id', $categoryIds)
                                       ->with('category') 
                                       ->latest()
                                       ->get()
                                       ->groupBy('category.name'); 

        return view('home', compact('productsByCategories'));
    }
}