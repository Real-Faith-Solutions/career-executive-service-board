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
        Schema::create('plantilla_tblAgencyLocation_Addr', function (Blueprint $table) {
            $table->id('officelocid');
            $table->string('floor_bldg')->nullable();
            $table->string('house_no_st')->nullable();
            $table->string('brgy_dist')->nullable();
            $table->integer('city_code'); // FK
            $table->boolean('isActive')->nullable()->default(true);
            $table->timestamp('encdate')->useCurrent();
            $table->timestamp('lastupd_dt')->useCurrent();
            $table->string('encoder')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plantilla_tblAgencyLocation_Addr');
    }
};
