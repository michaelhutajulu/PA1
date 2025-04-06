<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'header_description',
        'header_image',
        'store_image',
        'main_description',
    ];
}
