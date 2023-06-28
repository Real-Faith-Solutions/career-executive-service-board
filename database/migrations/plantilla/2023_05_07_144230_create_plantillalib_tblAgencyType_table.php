<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * PlantillalibTblAgencyType
     */
    public function up(): void
    {
        Schema::create('plantillalib_tblAgencyType', function (Blueprint $table) {
            $table->id('agency_typeid');
            // $table->string('agency_typeid')->nullable();
            $table->string('sectorid')->nullable();
            $table->string('title')->nullable();
            $table->string('encdate')->nullable();
            $table->string('lastupd_dt')->nullable();
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
        Schema::dropIfExists('plantillalib_tblAgencyType');
    }
};
