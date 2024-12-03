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
        Schema::create('payments', function (Blueprint $table) {
            $table->id('payment_id');
        $table->unsignedBigInteger('patient_id');
        $table->decimal('total_due', 10, 2);
        $table->date('last_update');

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
        Schema::dropIfExists('payments');
    }
};
