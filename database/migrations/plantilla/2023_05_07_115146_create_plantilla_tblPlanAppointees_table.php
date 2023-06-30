<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * PlantillaTblPlanAppointees
     */
    public function up(): void
    {
        Schema::create('plantilla_tblPlanAppointees', function (Blueprint $table) {
            $table->id('appointee_id');
            // $table->string('appointee_id')->nullable();
            $table->string('plantilla_id')->nullable();
            $table->string('cesno')->nullable();
            $table->string('appt_stat_code')->nullable();
            $table->string('appt_date')->nullable();
            $table->string('assum_date')->nullable();
            $table->string('is_appointee')->nullable();
            $table->string('ofc_stat_code')->nullable();
            $table->string('basis')->nullable();
            $table->string('created_dt')->nullable();
            $table->string('created_user')->nullable();
            $table->string('lastupd_dt')->nullable();
            $table->string('lastupd_user')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plantilla_tblPlanAppointees');
    }
};
