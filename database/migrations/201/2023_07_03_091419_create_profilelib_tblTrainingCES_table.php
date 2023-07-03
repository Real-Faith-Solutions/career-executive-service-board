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
        Schema::create('profilelib_tblTrainingCES', function (Blueprint $table) {
            $table->id('ctrlno');
            $table->integer('TRNG_CODE');
            $table->string('TITLE');
            $table->integer('TYPECODE');
            $table->string('from_dt');
            $table->string('to_dt');
            $table->string('VENUE');
            $table->string('DIRECTOR');
            $table->string('ASSISTANT');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profilelib_tblTrainingCES');
    }
};
