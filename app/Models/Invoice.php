<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'owner_id',
        'appointment_id',
        'invoice_number',
        'total_amount',
        'paid_amount',
        'status',
    ];

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}