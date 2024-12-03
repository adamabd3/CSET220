<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class employee extends Model
{
        use HasFactory;
        protected $table = "employees";
        protected $fillable = [
            "employee_id",
            "first_name",
            "last_name",
            "email",
            "phone",
            "password",
            "dob",
            "salary",
            "approved"
        ];
        public $timestamp = false;

        protected $primaryKey = 'employee_id';
}
