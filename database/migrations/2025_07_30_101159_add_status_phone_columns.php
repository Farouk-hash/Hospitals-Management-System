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
        Schema::table('doctors', function (Blueprint $table) {
            Schema::table('doctors', function (Blueprint $table) {
            $table->boolean('status')->default(true);
            $table->string('phone')->nullable();
            $table->string('phone_verified_at')->nullable();
        });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('doctors', function (Blueprint $table) {
            // $table->dropColumn(['phone','phone_verified_at','status']);

        });
    }
};
