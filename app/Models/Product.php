<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'category',
        'quantity',
        'reorder_level',
        'unit_price',
        'expiry_date',
    ];
}