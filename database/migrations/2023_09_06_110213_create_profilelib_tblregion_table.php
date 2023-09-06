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
        Schema::create('profilelib_tblregion', function (Blueprint $table) {
            $table->id('reg_code');
            $table->string('name');
            $table->string('acronym');
            $table->integer('zipcode')->nullable();
            $table->integer('regionSeq')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profilelib_tblregion');
    }
};
