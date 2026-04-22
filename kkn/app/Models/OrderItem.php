<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi ke Order Utama
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Relasi ke Produk (Untuk mengambil nama barang, gambar, dll)
    // PENTING: Nama fungsi ini harus 'product'
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}