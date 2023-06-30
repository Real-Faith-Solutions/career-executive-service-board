<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * PlantillaTblPlanPos
     * this is newly created migration in order to make a counterpart table from DB of legacy system
     */
    public function up(): void
    {
        Schema::create('plantilla_tblPlanPos_temp', function (Blueprint $table) {
            $table->id('plantilla_id');
            $table->string('officeid')->nullable();
            $table->string('title')->nullable();
            $table->string('appointee_cesno')->nullable();
            $table->string('appointee')->nullable();
            $table->string('occupant_cesno')->nullable();
            $table->string('occupant')->nullable();
            $table->string('is_vacant')->nullable();
            $table->string('is_occupied')->nullable();
            $table->string('pos_level')->nullable();
            $table->string('sg_level')->nullable();
            $table->string('pos_type')->nullable();
            $table->string('dbm_title')->nullable();
            $table->string('func_title')->nullable();
            $table->string('itemno')->nullable();
            $table->string('pres_apptee')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plantilla_tblPlanPos_temp');
    }
};
