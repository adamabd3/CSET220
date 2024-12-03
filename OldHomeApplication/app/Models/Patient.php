<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Patient extends Authenticatable
{
    use Notifiable;
    
    protected $primaryKey = 'patient_id';
    protected $table = "patients";

    protected $fillable = [
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
        'approved',
    ];
    public $timestamp = false;
}
