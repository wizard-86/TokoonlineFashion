<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // 🌟 DAFTARKAN SEMUA FIELD INI AGAR IJIN AKSES INSERT TRANSAKSI DIIZINKAN LARAVEL
    protected $fillable = [
    'user_id',
    'invoice',
    'total_harga',
    'total_price', // Tambahkan ini agar aman dari proteksi Laravel
    'address',
    'phone',
    'courier',
    'payment_method',
    'discount_amount',
    'coins_used',
    'coins_earned',
    'status'
];

    // Relasi ke Order Detail jika dibutuhkan oleh view success
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
