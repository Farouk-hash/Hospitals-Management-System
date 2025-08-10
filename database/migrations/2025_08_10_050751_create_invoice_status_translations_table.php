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
        Schema::create('invoice_status_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale');
            $table->string('name') ; 
            $table->foreignId('invoice_status_id')->references('id')->on('invoice_status')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_status_translations');
    }
};
