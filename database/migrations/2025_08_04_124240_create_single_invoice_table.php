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
        Schema::create('single_invoice', function (Blueprint $table) {
            $table->id();
            $table->integer('doctor_id')->unsigned();
            $table->foreign('doctor_id')->references('id')->on('doctors')->cascadeOnUpdate();
            
            $table->foreignId('service_id')->references('id')->on('services')->cascadeOnUpdate();
            
            $table->integer('section_id')->unsigned();
            $table->foreign('section_id')->references('id')->on('sections')->cascadeOnUpdate();

            $table->string('patient_name');

            // Financial fields
            $table->decimal('service_price', 10, 2);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('subtotal', 10, 2);
            $table->decimal('tax_rate', 5, 2)->default(0); // e.g. 15.00 for 15%
            $table->decimal('tax_amount', 10, 2)->default(0);
            $table->decimal('total_price', 10, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('single_invoice');
    }
};
