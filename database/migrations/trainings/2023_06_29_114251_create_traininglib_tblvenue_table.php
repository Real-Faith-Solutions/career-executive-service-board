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
            $table->string('name')->nullable();
            $table->string('no_street')->nullable();
            $table->integer('brgy')->nullable();
            $table->foreignId('city_code')->constrained('profilelib_tblcities', 'city_code');
            $table->integer('contactno')->nullable();
            $table->string('emailadd')->nullable();
            $table->string('contactperson')->nullable();
            $table->string('encoder')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
