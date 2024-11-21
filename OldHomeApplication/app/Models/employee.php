<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class employee extends Model
{
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

        protected $primarykey = 'employee_id';
}
