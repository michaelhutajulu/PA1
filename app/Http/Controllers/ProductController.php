<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a paginated listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Tentukan jumlah produk per halaman
        $productsPerPage = 15; // Anda bisa ganti angka ini sesuai kebutuhan

        // Mengambil produk dengan kategori, diurutkan terbaru, dan dipaginasi
        $products = Product::with('category') // Tetap eager load category
                           ->latest() // Urutkan berdasarkan terbaru (opsional, tapi bagus)
                           ->paginate($productsPerPage); // GANTI ->get() menjadi ->paginate()

        // Kirim data produk yang sudah dipaginasi ke view
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // TIDAK ADA PERUBAHAN DI SINI
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // TIDAK ADA PERUBAHAN DI SINI
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePath = $request->file('image')->store('products', 'public');

        Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $imagePath,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        // TIDAK ADA PERUBAHAN DI SINI
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        // TIDAK ADA PERUBAHAN DI SINI
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
            'image' => $product->image,
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        // TIDAK ADA PERUBAHAN DI SINI
        Storage::disk('public')->delete($product->image);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }

    /**
     * Display the specified resource. (Detail Produk)
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // TIDAK ADA PERUBAHAN DI SINI (Ini untuk detail satu produk, bukan list)
        $product = Product::findOrFail($id);
        return view('admin.products.show', compact('product'));
        // Catatan: Jika view 'admin.products.show' ini adalah untuk user biasa,
        // maka tidak masalah. Jika ini diakses dari admin juga, tidak perlu paginasi
        // karena hanya menampilkan satu produk.
    }

    /**
     * Toggle favorite status for a product.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggleFavorite($id)
    {
        // TIDAK ADA PERUBAHAN DI SINI
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

    /**
     * Display user's favorite products.
     *
     * @return \Illuminate\Http\Response
     */
    public function favorit()
    {
        // TIDAK ADA PERUBAHAN DI SINI (Ini halaman favorit user, bukan daftar produk admin)
        $user = auth()->user();
        $favorites = $user->favorites()->with('category')->get();

        return view('favorites.index', compact('favorites'));
        // Note: Jika halaman favorit juga bisa sangat panjang, Anda bisa menerapkan
        // pagination di sini juga dengan cara yang sama:
        // $favorites = $user->favorites()->with('category')->paginate(10); // misalnya 10 favorit per halaman
        // dan tambahkan {{ $favorites->links() }} di view favorites.index.blade.php
    }

    /**
     * Search products in admin panel with pagination.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function searchAdmin(Request $request)
    {
        $query = $request->input('query');

        if (!$query || trim($query) === '') {
            return redirect()->route('products.index')->with('error', 'Masukkan kata kunci untuk mencari produk.');
        }

        // Tentukan jumlah produk per halaman untuk hasil pencarian
        $productsPerPage = 15; // Samakan dengan index atau sesuaikan

        $products = Product::with('category')
            ->where('name', 'like', '%' . $query . '%')
            ->paginate($productsPerPage); // GANTI ->get() menjadi ->paginate()

        // !! PENTING untuk search: tambahkan query string ke link pagination !!
        // Agar saat klik halaman 2, 3, dst. pada hasil pencarian,
        // parameter 'query' tetap ada di URL dan pencarian tidak hilang.
        $products->appends(['query' => $query]);

        // Logika suggestion tetap sama
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

        // Kirim data hasil pencarian yang sudah dipaginasi ke view yang sama
        return view('admin.products.index', [
            'products' => $products,
            'query' => $query,
            'suggestion' => $suggestion,
        ]);
    }
}