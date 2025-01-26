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
        Schema::create('fines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attendance_id')->constrained('student_attendances');
            $table->integer('fines');
            $table->integer('morning_checkIn');
            $table->integer('morning_checkOut');
            $table->integer('afternoon_checkIn');
            $table->integer('afternoon_checkOut');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fines');
    }
};
