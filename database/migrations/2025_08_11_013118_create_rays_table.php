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
        Schema::create('rays', function (Blueprint $table) {
            $table->id();
            $table->longText('notes');
            $table->foreignId('diagnostic_id')->references('id')->on('diagnostic')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('rays_status_id')->references('id')->on('invoice_status')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('employee_id')->nullable()->references('id')->on('x_ray_emolyee')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rays');
    }
};
