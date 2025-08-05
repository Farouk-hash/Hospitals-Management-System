<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::table('single_invoice', function (Blueprint $table) {
            $table->foreignId('patient_id')->references('id')->on('patient')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    
    public function down(): void
    {
        
        Schema::table('single_invoice', function (Blueprint $table) {
            $table->dropColumn(['patient_name']);   
        });
    }
};
