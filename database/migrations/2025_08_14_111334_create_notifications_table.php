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
        Schema::create('notifications', function (Blueprint $table) {
             $table->id();
            $table->string('message');
            $table->boolean('reader_status')->default(false);
            
            $table->string('user_name');
            $table->integer('user_id'); // the one who triggered the action ; 
            $table->string('user_type') ; // [ADMIN , DOCTOR , RAY-EMPLOYEE , ... ] MODEL 

            $table->string('email');
            $table->json('route_params');
            $table->string('route_name'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
