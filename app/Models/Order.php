<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders'; // Menghubungkan ke tabel orders di Navicat

    protected $fillable = [
        'user_id',
        'invoice',
        'total_price',
        'status',
        'address',
        'courier',
        'shipping_cost'
    ];

    // Relasi ke detail order
    public function details()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }
}
