<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('index_number')->unique();
            $table->string('name');
            $table->string('email')->nullable()->unique();
            $table->string('phone')->nullable();

            // Relation to levels
            $table->foreignId('level_id')->constrained()->cascadeOnDelete();

            // Relation to academic years
            $table->foreignId('academic_year_id')->constrained('academic_years')->cascadeOnDelete();

            $table->text('address')->nullable();
            $table->enum('status', ['active', 'inactive', 'graduated'])->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
