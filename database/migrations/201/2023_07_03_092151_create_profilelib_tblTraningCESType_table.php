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
        Schema::create('profilelib_tblTraningCESType', function (Blueprint $table) {
            $table->id('TYPE_CODE');
            $table->string('TYPE');
            $table->string('ACRONYM');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profilelib_tblTraningCESType');
    }
};
