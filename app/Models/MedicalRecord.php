<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    protected $fillable = [
        'pet_id',
        'appointment_id',
        'vet_id',
        'symptoms',
        'diagnosis',
        'treatment',
        'notes',
    ];

    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function vet()
    {
        return $this->belongsTo(User::class, 'vet_id');
    }


}