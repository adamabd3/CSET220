<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
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
    public $timestamp = false;

    protected $primaryKey = "patient_id";
}
