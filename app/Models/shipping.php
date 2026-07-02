<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Shipping extends Model
{
    use HasFactory;

    // Didefinisikan karena nama tabel di SQL berbentuk singular ('shipping')
    protected $table = 'shipping';

    protected $fillable = [
        'order_id',
        'address',
        'city',
        'postal_code',
        'courier',
        'shipping_cost',
        'status'
    ];

    /**
     * Relasi balik ke model Order
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}
