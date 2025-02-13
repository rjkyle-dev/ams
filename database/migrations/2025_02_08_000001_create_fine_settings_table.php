<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fine_settings', function (Blueprint $table) {
            $table->id();
            $table->decimal('fine_amount', 8, 2)->default(25.00);
            $table->boolean('morning_checkin')->default(true);
            $table->boolean('morning_checkout')->default(true);
            $table->boolean('afternoon_checkin')->default(true);
            $table->boolean('afternoon_checkout')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fine_settings');
    }
};
