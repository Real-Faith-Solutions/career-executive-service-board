<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * PlantillaTblAgencyLocationAddr
     */
    public function up(): void
    {
        Schema::create('plantilla_tblAgencyLocation_Addr', function (Blueprint $table) {
            $table->id('officelocid');
            // $table->string('officelocid')->nullable();
            $table->string('floor_bldg')->nullable();
            $table->string('house_no_st')->nullable();
            $table->string('brgy_dist')->nullable();
            $table->string('city_code')->nullable();
            $table->string('isActive')->nullable();
            $table->date('encdate')->nullable();
            $table->date('lastupd_dt')->nullable();
            $table->string('encoder')->nullable();
            $table->timestamps();
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
