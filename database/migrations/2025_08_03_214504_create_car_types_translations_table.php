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
        Schema::create('car_types_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale');
            $table->string('name');// insurance-name ;
            $table->unique(['car_type_id','locale']);
            $table->foreignId('car_type_id')->references('id')
            ->on('car_types')
            ->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_types_translations');
    }
};
