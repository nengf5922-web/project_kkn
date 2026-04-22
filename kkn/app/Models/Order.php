<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi ke User (Pembeli)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke OrderItem (Barang yang dibeli)
    // PENTING: Nama fungsi ini harus 'orderItems' sesuai yang dipanggil di Controller
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}