<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    // Menentukan nama tabel secara eksplisit
    protected $table = 'categories';

    // Kolom yang dapat diisi massal
    protected $fillable = ['name'];

    /**
     * Relasi ke model Product (Satu kategori memiliki banyak produk)
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
