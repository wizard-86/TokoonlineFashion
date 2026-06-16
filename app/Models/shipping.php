<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    // Tambahkan baris ini untuk mempertegas nama tabel di database
    protected $table = 'shipping';

    protected $fillable = [
        'order_id', 'courier', 'address', 'shipping_cost', 'status'
    ];
}
