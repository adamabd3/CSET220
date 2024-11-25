<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Med extends Model
{
    protected $fillable = [
        'med_id',
        'doctor_id',
        'patient_id',
        'date',
        'comment',
        'med_morning',
        'med_afternoon',
        'med_night'
    ];
    public $timestamp = false;

    protected $primaryKey = "med_id";
}
