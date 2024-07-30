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
        Schema::create('patient_doctor_rel', function (Blueprint $table) {
            $table->bigIncrements('ID');
            $table->bigInteger('doctor_id')->unsigned();
            $table->bigInteger('patient_id')->unsigned();
            $table->integer('stage')->nullable();
            $table->string('diagnose')->nullable();
            $table->string('details')->nullable();
            $table->string('prescription')->nullable();

            // Define foreign key constraints.
            $table->foreign('doctor_id')->references('ID')->on('users');
            $table->foreign('patient_id')->references('ID')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_doctor_rel');
    }
};
