<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dues_payment_souvenir', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dues_payment_id')->constrained('dues_payments')->cascadeOnDelete();
            $table->foreignId('souvenir_id')->constrained('souvenirs')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dues_payment_souvenir');
    }
};
