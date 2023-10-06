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
            $table->string('brgy')->nullable();
            $table->integer('city_code')->nullable();
            // $table->foreignId('city_code')->constrained('profilelib_tblcities', 'city_code');
            $table->string('contactno')->nullable();
            $table->string('emailadd')->nullable();
            $table->string('contactperson')->nullable();
            $table->string('encoder')->nullable();
            $table->string('lastupd_enc')->nullable();
            $table->timestamp('encoder_dt')->nullable()->useCurrent();
            $table->timestamp('lastupd_dt')->nullable()->useCurrent();
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
