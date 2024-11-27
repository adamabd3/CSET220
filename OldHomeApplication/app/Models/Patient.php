<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model
{
    use HasFactory;
    protected $table = 'patients';
    protected $fillable = [
        "patient_id",
        "first_name",
        "last_name",
        "email",
        "phone",
        "password",
        "dob",
        "family_code",
        "emergency_contact",
        "relation_to_contact",
        "group_number",
        "admission_date",
        "approved"
    ];
    public $timestamps = false;

    protected $primaryKey = "patient_id";
}
