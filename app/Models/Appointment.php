<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'owner_id',
        'pet_id',
        'vet_id',
        'scheduled_at',
        'reason',
        'status',
        'notes',
    ];

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    public function vet()
    {
        return $this->belongsTo(User::class, 'vet_id');
    }

    public function medicalRecord()
    {
        return $this->hasOne(MedicalRecord::class);
    }
    
}
