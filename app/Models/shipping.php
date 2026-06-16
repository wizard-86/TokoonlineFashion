<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
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

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}