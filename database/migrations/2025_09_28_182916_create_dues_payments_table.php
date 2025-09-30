<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dues_payments', function (Blueprint $table) {
            $table->id();

            // Student making the payment
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();

            // Due definition (academic year + level + amount)
            $table->foreignId('due_id')->constrained('dues')->cascadeOnDelete();

            // Snapshot fields (redundant but useful for history)
            $table->foreignId('academic_year_id')->constrained('academic_years')->cascadeOnDelete();
            $table->foreignId('level_id')->constrained()->cascadeOnDelete();

            // Payment info
            $table->date('date_paid');
            $table->decimal('amount_paid', 10, 2);
            $table->string('receipt_number')->unique()->default('');

            // Status + Souvenir
            $table->boolean('souvenir_collected')->default(false);
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dues_payments');
    }
};
