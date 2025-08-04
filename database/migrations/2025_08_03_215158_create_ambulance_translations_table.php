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
        Schema::create('ambulance_translations', function (Blueprint $table) {
          
            $table->string('locale');
            $table->string('driver_name');// insurance-name ;
            $table->string('notes');
            $table->foreignId('car_type_id')->references('id')->on('car_types')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unique(['driver_name','ambulance_id','locale','car_type_id'], 'amb_trans_driver_locale_unique');
            $table->foreignId('ambulance_id')->references('id')->on('ambulance')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ambulance_translations');
    }
};
