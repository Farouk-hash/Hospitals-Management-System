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
        Schema::create('converstaion', function (Blueprint $table) {
            $table->id();
            $table->integer('sender_id') ; 
            $table->string('sender_type');

            $table->string('receiver_id');
            $table->string('receiver_type');
            
            $table->boolean('last_seen_message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('converstaion');
    }
};
