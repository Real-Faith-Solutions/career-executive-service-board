<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * PlantillaTempTblPlantillaStatistics
     * this is newly created migration in order to make a counterpart table from DB of legacy system
     */
    public function up(): void
    {
        Schema::create('plantillatemp_tblPlantillaStatistics', function (Blueprint $table) {
            $table->id('sectorid');
            $table->string('sector')->nullable();
            $table->string('deptid')->nullable();
            $table->string('department')->nullable();
            $table->string('agencytype')->nullable();
            $table->string('total_positions')->nullable();
            $table->string('total_vacant')->nullable();
            $table->string('total_ceso')->nullable();
            $table->string('total_cese')->nullable();
            $table->string('total_csee')->nullable();
            $table->string('total_nonces')->nullable();
            $table->string('uploaded_dt')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plantillatemp_tblPlantillaStatistics');
    }
};
