<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bundle extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'bundle_price'];

    // Relasi ke Produk
    public function products()
    {
        return $this->belongsToMany(Product::class, 'bundle_product');
    }
}
