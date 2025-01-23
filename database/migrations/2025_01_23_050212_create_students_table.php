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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('s_rfid');
            $table->string('s_studentID');
            $table->string('s_fname');
            $table->string('s_lname');
            $table->string('s_mname');
            $table->string('s_suffix');
            $table->string('s_program');
            $table->string('s_lvl');
            $table->string('s_set');
            $table->string('s_image');
            $table->string('s_status');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
