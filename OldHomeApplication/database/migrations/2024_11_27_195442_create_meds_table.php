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
        Schema::create('meds', function (Blueprint $table) {
            $table->id('med_id');
            $table->unsignedBigInteger('doctor_id');
            $table->unsignedBigInteger('patient_id');
            $table->date('date');
            $table->text('comment');
            $table->boolean('med_morning')->default(false);
            $table->boolean('med_afternoon')->default(false);
            $table->boolean('med_night')->default(false);
    
            // Foreign Keys
            $table->foreign('doctor_id')->references('employee_id')->on('employees')->onDelete('cascade');
            $table->foreign('patient_id')->references('patient_id')->on('patients')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meds');
    }
};
