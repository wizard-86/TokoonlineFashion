<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    use HasFactory;

    // Didefinisikan karena nama tabel di SQL berbentuk singular ('cart')
    protected $table = 'cart';

    protected $fillable = ['user_id'];

    /**
     * Relasi ke model User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Relasi ke model CartDetail (Satu keranjang memiliki banyak item/detail)
     */
    public function cartDetails(): HasMany
    {
        return $this->hasMany(CartDetail::class, 'cart_id', 'id');
    }
}
