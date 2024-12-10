<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Patient extends Authenticatable
{
    use Notifiable;
    protected $primaryKey = 'patient_id';
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
    public $timestamps = false;

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
