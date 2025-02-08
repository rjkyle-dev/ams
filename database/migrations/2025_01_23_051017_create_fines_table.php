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
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade');
            $table->boolean('morning_checkin')->default(false);
            $table->boolean('morning_checkout')->default(false);
            $table->boolean('afternoon_checkin')->default(false);
            $table->boolean('afternoon_checkout')->default(false);
            $table->decimal('fine_amount', 8, 2)->default(25.00);
            $table->integer('absences')->default(0);
            $table->decimal('total_fines', 10, 2)->default(0.00);
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
