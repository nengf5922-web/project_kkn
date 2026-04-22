<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    // ... (di dalam class Category)

// Relasi: Satu kategori memiliki banyak produk
public function products()
{
    return $this->hasMany(Product::class);
}

    // Tambahkan baris ini
    protected $fillable = ['name', 'slug'];
}