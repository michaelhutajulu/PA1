<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreProfile extends Model
{
    use HasFactory;

    // Menambahkan 'user_id' ke dalam properti $fillable agar bisa diisi saat create atau update
    protected $fillable = [
        'title',
        'header_description',
        'header_image',
        'store_image',
        'main_description',
        'user_id', // Tambahkan 'user_id'
    ];

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
