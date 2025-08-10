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
        Schema::create('payment_account', function (Blueprint $table) {
            $table->id();
            $table->decimal('credit' , 8 , 2);
            $table->foreignId('patient_id')->references('id')->on('patient')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('notes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_account');
    }
};
