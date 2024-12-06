<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class patient extends Model
{
    protected $table = 'patients';
    protected $fillable = [
        'patient_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'password',
        'dob',
        'family_code',
        'emergency_contact',
        'relation_to_contact',
        'group_number',
        'admission_date',
        'approved'
    ];
    public $timestamp = false;

    public function appointments()
{
    return $this->hasMany(Appointment::class);
}

public function meds()
{
    return $this->hasMany(Med::class);
}

public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
