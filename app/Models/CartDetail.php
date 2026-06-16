<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    protected $table = 'cart_detail'; // Sesuaikan dengan nama tabel database Anda

    protected $fillable = ['cart_id', 'product_id', 'quantity'];

    // Relasi ke produk agar bisa dipanggil di cart.blade.php
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
