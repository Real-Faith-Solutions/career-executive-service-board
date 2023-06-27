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
        Schema::create('profilelib_tblregions', function (Blueprint $table) {
            $table->id();
            $table->string('reg_code')->unique();
            $table->string('name')->nullable();
            $table->string('acronym')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('regionSeq')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profilelib_tblregions');
    }
};
