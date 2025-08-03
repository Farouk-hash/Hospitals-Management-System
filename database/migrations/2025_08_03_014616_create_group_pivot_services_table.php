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
        Schema::create('group_pivot_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_services_id')->references('id')->on('group_services')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('services_id')->references('id')->on('services')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_pivot_services');
    }
};
