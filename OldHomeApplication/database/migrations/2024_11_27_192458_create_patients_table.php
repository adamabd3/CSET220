<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('patients', function (Blueprint $table) {
        $table->id('patient_id');
        $table->string('first_name', 50);
        $table->string('last_name', 50);
        $table->string('email', 70)->unique();
        $table->string('phone', 30);
        $table->string('password', 255);
        $table->date('dob');
        $table->string('family_code', 50);
        $table->string('emergency_contact', 100);
        $table->string('relation_to_contact', 100);
        $table->string('group_number', 10)->nullable();
        $table->date('admission_date')->nullable();
        $table->boolean('approved')->default(false);
        $table->timestamps();
    });

}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
