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
        Schema::create('ambulance', function (Blueprint $table) {
            $table->id();
            $table->string('car_number') ;
            $table->string('car_model') ;
            $table->date('published_at') ;
            $table->string('phone_number');
            $table->string('licence_car_number');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ambulance');
    }
};
