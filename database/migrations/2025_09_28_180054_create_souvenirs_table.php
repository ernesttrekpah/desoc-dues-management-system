<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('souvenirs', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g. T-shirt, Pen, Hoodie
            $table->foreignId('level_id')->constrained()->cascadeOnDelete();
            $table->foreignId('academic_year_id')->constrained('academic_years')->cascadeOnDelete();
            $table->text('description')->nullable();
            $table->enum('status', ['available', 'unavailable'])->default('available');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('souvenirs');
    }
};
