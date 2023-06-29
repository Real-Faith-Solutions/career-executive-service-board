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
        Schema::create('traininglib_tblvenue', function (Blueprint $table) {
            $table->id('venueid');
            $table->string('name');
            $table->string('no_street');
            $table->integer('brgy');
            $table->string('city_code');
            $table->integer('contactno');
            $table->string('emailadd');
            $table->string('contactperson');
            $table->string('encoder');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('traininglib_tblvenue');
    }
};
