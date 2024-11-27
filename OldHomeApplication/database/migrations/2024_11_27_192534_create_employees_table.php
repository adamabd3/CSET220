<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
                $table->id('employee_id');
                $table->string('first_name', 50);
                $table->string('last_name', 50);
                $table->string('email', 70)->unique();
                $table->string('phone', 30);
                $table->string('password', 50);
                $table->date('dob');
                $table->enum('role', ['Admin', 'Supervisor', 'Doctor', 'Caregiver']);
                $table->integer('salary')->nullable();
                $table->boolean('approved')->default(false);
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
