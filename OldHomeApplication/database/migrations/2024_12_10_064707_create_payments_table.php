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
        Schema::create('payments', function (Blueprint $table) {
            $table->bigInteger('payment_id');
            $table->bigInteger('patient_id');
            $table->decimal('total_due', 10, 2);
            $table->date('last_update');

            $table->primary('payment_id');
            $table->foreign('patient_id')
                  ->references('patient_id')
                  ->on('patients')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
