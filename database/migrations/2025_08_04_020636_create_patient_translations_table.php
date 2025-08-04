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
        Schema::create('patient_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale');
            $table->string('name'); // patient-name ;
            $table->string('notes');
            $table->unique(['locale','patient_id','name','gender_id'] , 'locale_fk');
            $table->foreignId('patient_id')->references('id')->on('patient')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('gender_id')->references('id')->on('gender')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_translations');
    }
};
