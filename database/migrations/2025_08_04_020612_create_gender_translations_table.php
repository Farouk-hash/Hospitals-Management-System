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
        Schema::create('gender_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale');
            $table->string('name');
            $table->unique(['locale','gender_id','name']);
            $table->foreignId('gender_id')->references('id')->on('gender')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gender_translations');
    }
};
