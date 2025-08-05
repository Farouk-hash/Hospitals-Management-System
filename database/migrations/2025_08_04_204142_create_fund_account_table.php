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
        // FOR PAYMENT-TYPE == 1 [CASH];
        Schema::create('fund_account', function (Blueprint $table) {
            $table->id();
            $table->foreignId('single_invoice_id')->nullable()->references('id')->on('single_invoice')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('reciept_id')->nullable()->references('id')->on('reciept_account')->cascadeOnDelete()->cascadeOnUpdate();
            $table->decimal('debit',8,2);
            $table->decimal('credit',8,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fund_account');
    }
};
