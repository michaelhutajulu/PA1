<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a paginated listing of the resource for admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // TIDAK ADA PERUBAHAN DI SINI (Ini untuk admin, sudah dengan pagination)
        $productsPerPage = 15;
        $products = Product::with('category')
                           ->latest()
                           ->paginate($productsPerPage);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource for admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // TIDAK ADA PERUBAHAN DI SINI (Ini untuk admin)
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage for admin.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // TIDAK ADA PERUBAHAN DI SINI (Ini untuk admin)
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048', // 'sometimes' jika gambar opsional
        ]);

        $imagePath = null; // Default jika tidak ada gambar
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $imagePath,
            'user_id' => auth()->id(), // Asumsi admin yang login adalah user_id nya
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
        // Menggunakan admin.products.index untuk konsistensi nama route admin
    }

    // ------------------------------------------------------------------------------------
    // PERUBAHAN & PENAMBAHAN METHOD SHOW
    // ------------------------------------------------------------------------------------

    /**
     * Display the specified product for public view.
     * (Method ini akan dipanggil oleh route 'produk.detail.publik')
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\View\View
     */
    public function showPublic(Product $product) // Menggunakan Route Model Binding
    {
        // Di sini Anda bisa memuat relasi lain jika perlu untuk tampilan publik
        // $product->load('category', 'reviews'); // contoh

        // Pastikan Anda memiliki view 'produk.show_detail_publik.blade.php'
        // atau sesuaikan nama view-nya.
        return view('produk.show_detail_publik', compact('product'));
    }

    /**
     * Display the specified resource for admin view.
     * (Method ini akan dipanggil oleh route 'admin.products.show' dari Route::resource)
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product) // Menggunakan Route Model Binding
    {
        // Tidak perlu Product::findOrFail($id); lagi karena sudah ada Route Model Binding.
        // Laravel akan otomatis melakukan findOrFail berdasarkan {product} di URL admin.
        // Pastikan view 'admin.products.show' sudah ada dan sesuai untuk admin.
        return view('admin.products.show', compact('product'));
    }
    // ------------------------------------------------------------------------------------

    /**
     * Show the form for editing the specified resource for admin.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        // TIDAK ADA PERUBAHAN DI SINI (Ini untuk admin)
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage for admin.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        // TIDAK ADA PERUBAHAN DI SINI (Ini untuk admin)
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePath = $product->image; // Pertahankan gambar lama jika tidak ada yang baru
        if ($request->hasFile('image')) {
            if ($product->image) { // Hapus gambar lama jika ada
                Storage::disk('public')->delete($product->image);
            }
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $product->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $imagePath, // Gunakan $imagePath yang sudah diupdate
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
        // Menggunakan admin.products.index untuk konsistensi nama route admin
    }

    /**
     * Remove the specified resource from storage for admin.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        // TIDAK ADA PERUBAHAN DI SINI (Ini untuk admin)
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
        // Menggunakan admin.products.index untuk konsistensi nama route admin
    }

    /**
     * Toggle favorite status for a product.
     * (Ini tampaknya tidak terkait langsung dengan CRUD Product admin, tapi lebih ke fitur user)
     *
     * @param  int  $id  // Jika route-nya adalah /favorite/{product}, maka seharusnya Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggleFavorite(Product $product) // Diubah $id menjadi Product $product agar konsisten jika route-nya /favorite/{product}
    {
        // TIDAK ADA PERUBAHAN LOGIKA UTAMA DI SINI
        $user = auth()->user();
        // Tidak perlu $product = Product::findOrFail($id); jika menggunakan Route Model Binding

        if ($user->favorites()->where('product_id', $product->id)->exists()) {
            $user->favorites()->detach($product->id);
            return response()->json(['status' => 'removed', 'message' => 'Dihapus dari favorit']);
        } else {
            $user->favorites()->attach($product->id);
            return response()->json(['status' => 'added', 'message' => 'Ditambahkan ke favorit']);
        }
    }

    /**
     * Display user's favorite products.
     * (Ini juga tampaknya tidak terkait langsung dengan CRUD Product admin)
     *
     * @return \Illuminate\Http\Response
     */
    public function favorit()
    {
        // TIDAK ADA PERUBAHAN LOGIKA UTAMA DI SINI
        $user = auth()->user();
        $favorites = $user->favorites()->with('category')->latest()->paginate(10); // Contoh pagination untuk favorit
        // Anda bisa tambahkan ->latest()->paginate(jumlah_item) jika mau

        return view('favorites.index', compact('favorites'));
    }

    /**
     * Search products in admin panel with pagination.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function searchAdmin(Request $request)
    {
        // TIDAK ADA PERUBAHAN LOGIKA UTAMA DI SINI (Ini untuk admin, sudah dengan pagination)
        $query = $request->input('query');

        if (!$query || trim($query) === '') {
            return redirect()->route('admin.products.index')->with('error', 'Masukkan kata kunci untuk mencari produk.');
            // Menggunakan admin.products.index untuk konsistensi nama route admin
        }

        $productsPerPage = 15;

        $products = Product::with('category')
            ->where(function ($q) use ($query) { // Menggunakan closure untuk multiple where
                $q->where('name', 'like', '%' . $query . '%')
                  ->orWhere('description', 'like', '%' . $query . '%') // Contoh pencarian di deskripsi juga
                  ->orWhereHas('category', function ($catQuery) use ($query) { // Contoh pencarian di nama kategori
                      $catQuery->where('name', 'like', '%' . $query . '%');
                  });
            })
            ->latest()
            ->paginate($productsPerPage);

        $products->appends(['query' => $query]);

        $suggestion = null; // Anda bisa menyempurnakan logika suggestion ini
        if ($products->isEmpty() && strlen($query) > 2) { // Hanya beri saran jika query cukup panjang
            $allProductNames = Product::pluck('name')->toArray();
            $closest = null;
            $shortest = -1;

            foreach ($allProductNames as $productName) {
                $lev = levenshtein(strtolower($query), strtolower($productName));
                // Logika Levenshtein bisa disesuaikan
                if ($lev <= strlen($query) / 2 && $lev < 3 && ($lev < $shortest || $shortest < 0)) {
                    $closest = $productName;
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