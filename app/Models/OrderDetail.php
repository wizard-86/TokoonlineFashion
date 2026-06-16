<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'order_details'; // Menghubungkan ke tabel order_details di Navicat

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price'
    ];

    // Relasi balik ke produk agar bisa tahu nama produk yang dibeli
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
