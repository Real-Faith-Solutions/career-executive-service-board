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
        Schema::create('training_tblProvider', function (Blueprint $table) {
            $table->id('providerID');
            $table->string('provider')->nullable();
            $table->string('house_bldg')->nullable();
            $table->string('st_road')->nullable();
            $table->string('brgy_vill')->nullable();
            $table->integer('city_code')->nullable();
            // $table->foreignId('city_code')->constrained('profilelib_tblcities', 'city_code');
            $table->string('contactno')->nullable();
            $table->string('emailadd')->nullable();
            $table->string('contactperson')->nullable();
            $table->string('encoder')->nullable();
            $table->string('lastupd_enc')->nullable();
            $table->timestamp('encdate')->nullable()->useCurrent()->nullable();
            $table->timestamp('lastupd_dt')->nullable()->useCurrent()->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_tblProvider');
    }
};
