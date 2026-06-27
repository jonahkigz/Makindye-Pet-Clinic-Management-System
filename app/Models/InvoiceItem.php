<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    protected $fillable = [
        'invoice_id',
        'product_id',
        'service_id',
        'item_name',
        'quantity',
        'unit_price',
        'subtotal',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}