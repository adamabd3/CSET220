<?php

namespace App\Models;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model
{
    use HasFactory;

    protected $table = 'appointments';

    protected $primaryKey = 'appointment_id';

    protected $fillable = [
        'date',
        'doctor_id',
        'patient_id',
    ];

    public function doctor()
    {
        return $this->belongsTo(employee::class, 'doctor_id', 'employee_id');
    }


    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'patient_id');
    }
}
