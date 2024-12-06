<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class roster extends Model
{
    protected $table = 'rosters';
    protected $fillable = [
        'roster_id',
        'date',
        'supervisor_id',
        'doctor_id',
        'caregiver1_id',
        'caregiver2_id',
        'caregiver3_id',
        'caregiver4_id',
    ];
    public $timestamps = false;
    protected $primaryKey = 'roster_id';

    public function doctor()
    {
        return $this->belongsTo(employee::class, 'doctor_id', 'employee_id');
    }

    public function caregiver1()
    {
        return $this->belongsTo(employee::class, 'caregiver1_id', 'employee_id');
    }

    public function caregiver2()
    {
        return $this->belongsTo(employee::class, 'caregiver2_id', 'employee_id');
    }

    public function caregiver3()
    {
        return $this->belongsTo(employee::class, 'caregiver3_id', 'employee_id');
    }

    public function caregiver4()
    {
        return $this->belongsTo(employee::class, 'caregiver4_id', 'employee_id');
    }

    public function supervisor()
    {
        return $this->belongsTo(employee::class, 'supervisor_id', 'employee_id');
    }
}