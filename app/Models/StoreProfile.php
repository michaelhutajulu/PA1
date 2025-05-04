<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'header_description',
        'header_image',
        'store_image',
        'main_description',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
