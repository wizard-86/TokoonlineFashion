<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'cart'; // Sesuaikan dengan nama tabel database Anda

    protected $fillable = ['user_id'];
}
