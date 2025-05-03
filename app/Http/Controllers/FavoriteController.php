<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    // Menambah atau menghapus produk dari daftar favorit pengguna
    public function toggle($productId)
    {
        $user = auth()->user();
    
        if ($user->favorites()->where('product_id', $productId)->exists()) {
            $user->favorites()->detach($productId);
            return response()->json(['status' => 'removed']);
        } else {
            $user->favorites()->attach($productId);
            return response()->json(['status' => 'added']);
        }
    }

    // Menampilkan daftar produk favorit pengguna
    public function index()
    {
        $favorites = auth()->user()
            ->favorites() // relasi belongsToMany
            ->with('category') // jika ingin akses kategori di view (opsional)
            ->get();
    
        return view('favorites.index', compact('favorites'));
    }
    
}
