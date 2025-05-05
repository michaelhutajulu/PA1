<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePath = $request->file('image')->store('products', 'public');

        // Menambahkan user_id untuk menyimpan admin yang membuat produk
        Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $imagePath,
            'user_id' => auth()->id(), // Menyimpan user_id admin yang sedang login
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($product->image);
            $product->image = $request->file('image')->store('products', 'public');
        }

        $product->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $product->image,  // Update image path jika ada
            // 'user_id' tidak perlu diupdate karena sudah ditetapkan saat pembuatan produk
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        Storage::disk('public')->delete($product->image);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id); // cari produk berdasarkan ID
        return view('admin.products.show', compact('product'));
    }

    public function toggleFavorite($id)
    {
        $user = auth()->user();
        $product = Product::findOrFail($id);

        if ($user->favorites()->where('product_id', $id)->exists()) {
            $user->favorites()->detach($id);
            return response()->json(['status' => 'removed']);
        } else {
            $user->favorites()->attach($id);
            return response()->json(['status' => 'added']);
        }
    }

    public function favorit()
    {
        $user = auth()->user();
        $favorites = $user->favorites()->with('category')->get();

        return view('favorites.index', compact('favorites'));
    }

    public function searchAdmin(Request $request)
    {
        $query = $request->input('query');

        if (!$query || trim($query) === '') {
            return redirect()->route('products.index')->with('error', 'Masukkan kata kunci untuk mencari produk.');
        }

        $products = Product::with('category')
            ->where('name', 'like', '%' . $query . '%')
            ->get();

        $keywords = ['sepeda', 'kulkas', 'tv', 'mesin cuci', 'laptop', 'handphone', 'kompor', 'kipas angin', 'kamera'];

        $suggestion = null;

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

        return view('admin.products.index', [
            'products' => $products,
            'query' => $query,
            'suggestion' => $suggestion,
        ]);
    }
}
