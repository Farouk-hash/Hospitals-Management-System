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
        // PROMISSORY-BOND 
        Schema::create('reciept_account', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->references('id')->on('patient')->cascadeOnDelete()->cascadeOnUpdate();
            $table->decimal('debit',8,2);
            $table->string('notes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reciept_account');
    }
};
