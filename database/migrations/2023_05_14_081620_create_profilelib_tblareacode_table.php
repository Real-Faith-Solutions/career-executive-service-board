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
        Schema::create('profilelib_tblareacode', function (Blueprint $table) {
            $table->id('CODE');
            // $table->string('CODE')->unique();
            $table->string('NAME')->nullable();
            $table->string('ZIPCODE')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profilelib_tblareacode');
    }
};
