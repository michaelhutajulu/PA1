<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Menambahkan 'user_id' ke dalam properti $fillable agar bisa diisi saat create atau update
    protected $fillable = ['name', 'category_id', 'price', 'description', 'image', 'user_id'];

    // Relasi dengan Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi many-to-many dengan User (favorites)
    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }

    // Relasi dengan User (Admin yang membuat produk)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
