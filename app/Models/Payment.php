<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    // Didefinisikan karena nama tabel di SQL berbentuk singular ('payment')
    protected $table = 'payment';

    protected $fillable = [
        'order_id',
        'payment_method',
        'amount',
        'status',
        'payment_date'
    ];

    // Mengonversi kolom payment_date otomatis menjadi objek Carbon/Datetime
    protected $casts = [
        'payment_date' => 'datetime',
    ];

    /**
     * Relasi balik ke model Order
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}
