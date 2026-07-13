<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartDetail extends Model
{
    use HasFactory;

    // Didefinisikan karena nama tabel di SQL berbentuk singular ('cart_detail')
    protected $table = 'cart_detail';

    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
        'size'
    ];

    /**
     * Relasi balik ke model Cart
     */
    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class, 'cart_id', 'id');
    }

    /**
     * Relasi ke model Product (Mengambil data produk yang ada di dalam keranjang)
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
