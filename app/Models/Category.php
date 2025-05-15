<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// Pastikan model Product di-import jika belum
use App\Models\Product;
// Pastikan model User di-import jika belum (meskipun sudah ada di relasi user())
use App\Models\User;


class Category extends Model
{
    use HasFactory;

    // Menambahkan 'user_id' ke dalam properti $fillable agar bisa diisi saat create atau update
    protected $fillable = ['name', 'image', 'user_id']; // Tambahkan 'user_id' (Kode Asli Anda)

    // Relasi dengan model User (Kode Asli Anda)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // --- 👇 PENAMBAHAN RELASI KE MODEL PRODUCT 👇 ---
    /**
     * Mendefinisikan relasi "one-to-many" ke model Product.
     * Satu kategori bisa memiliki banyak produk.
     */
    public function products()
    {
        // Asumsi default Laravel:
        // - Model Product ada di App\Models\Product
        // - Tabel 'products' memiliki foreign key 'category_id'
        return $this->hasMany(Product::class);

        // Jika foreign key di tabel 'products' bukan 'category_id',
        // atau primary key di tabel 'categories' bukan 'id', Anda bisa menentukannya:
        // return $this->hasMany(Product::class, 'custom_foreign_key_on_products_table', 'custom_local_key_on_categories_table');
        // Contoh: return $this->hasMany(Product::class, 'kategori_id', 'id');
    }
    // --- 👆 AKHIR PENAMBAHAN RELASI 👆 ---
}