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
        Schema::create('meals', function (Blueprint $table) {
            $table->id('meal_id');
        $table->unsignedBigInteger('patient_id');
        $table->boolean('breakfast')->default(false);
        $table->boolean('lunch')->default(false);
        $table->boolean('dinner')->default(false);
        $table->date('date');
        
        // Foreign Key
        $table->foreign('patient_id')->references('patient_id')->on('patients')->onDelete('cascade');
        
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meals');
    }
};
