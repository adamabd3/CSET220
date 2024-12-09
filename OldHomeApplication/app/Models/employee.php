<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class employee extends Authenticatable
{
    use Notifiable;
        
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
            "approved",
            "role",
            "created_at",
            "updated_at"
        ];
        public $timestamp = false;

        protected $primaryKey = 'employee_id';

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isSupervisor()
    {
        return $this->role === 'supervisor';
    }

    public function isDoctor()
    {
        return $this->role === 'doctor';
    }

    public function isCaregiver()
    {
        return $this->role === 'caregiver';
    }
}
