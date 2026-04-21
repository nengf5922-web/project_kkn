<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Pastikan 'description' ada di sini!
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'price',
        'stock',
        'description', // <--- WAJIB ADA
        'image',
        'sizes' // atau 'ukuran'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}