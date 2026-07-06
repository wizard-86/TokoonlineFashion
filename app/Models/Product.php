<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'category_id',
        'name',
        'price',
        'image',
        'description'
    ];

    /**
     * Relasi ke model Category (Produk ini termasuk dalam sebuah kategori)
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * Relasi ke model CartDetail
     */
    public function cartDetails(): HasMany
    {
        return $this->hasMany(CartDetail::class, 'product_id', 'id');
    }

    /**
     * Relasi ke model OrderDetail
     */
    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDetail::class, 'product_id', 'id');
    }

    // Relasi Many-to-Many ke paket Bundle
    public function bundles()
    {
        return $this->belongsToMany(Bundle::class, 'bundle_product');
    }

}
