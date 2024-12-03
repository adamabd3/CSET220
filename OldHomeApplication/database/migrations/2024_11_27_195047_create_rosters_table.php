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
        Schema::create('rosters', function (Blueprint $table) {
            $table->id('roster_id');
            $table->date('date');
            $table->unsignedBigInteger('supervisor_id');
            $table->unsignedBigInteger('doctor_id');
            $table->unsignedBigInteger('caregiver1_id')->nullable();
            $table->unsignedBigInteger('caregiver2_id')->nullable();
            $table->unsignedBigInteger('caregiver3_id')->nullable();
            $table->unsignedBigInteger('caregiver4_id')->nullable();

        // Foreign Keys
            $table->foreign('supervisor_id')->references('employee_id')->on('employees')->onDelete('cascade');
            $table->foreign('doctor_id')->references('employee_id')->on('employees')->onDelete('cascade');
            $table->foreign('caregiver1_id')->references('employee_id')->on('employees')->onDelete('cascade');
            $table->foreign('caregiver2_id')->references('employee_id')->on('employees')->onDelete('cascade');
            $table->foreign('caregiver3_id')->references('employee_id')->on('employees')->onDelete('cascade');
            $table->foreign('caregiver4_id')->references('employee_id')->on('employees')->onDelete('cascade');
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rosters');
    }
};
