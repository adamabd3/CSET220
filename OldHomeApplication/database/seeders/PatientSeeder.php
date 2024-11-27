<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\employee;

class EmployeeSeeder extends Seeder
{
    public function run()
    {
        employee::create([
            'first_name' => 'Alice',
            'last_name' => 'Smith',
            'email' => 'alice@example.com',
            'phone' => '987654321',
            'password' => bcrypt('password'),
            'dob' => '1985-05-12',
            'role' => 'Doctor',
            'salary' => 100000,
            'approved' => true,
        ]);
    }
}
