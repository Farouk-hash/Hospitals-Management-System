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
        Schema::create('group_services_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('locale')->index();
            $table->string('name');
            $table->unique(['group_services_id','locale']);
            $table->foreignId('group_services_id')->references('id')->on('group_services')
            ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_services_translations');
    }
};
