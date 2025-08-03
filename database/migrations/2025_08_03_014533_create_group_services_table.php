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
        Schema::create('group_services', function (Blueprint $table) {
            $table->id();
            $table->decimal('price_before_discount',8,2);
            $table->decimal('discount',8,2);
            $table->decimal('taxes',8,2);
            $table->decimal('total_price',8,2);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_services');
    }
};
