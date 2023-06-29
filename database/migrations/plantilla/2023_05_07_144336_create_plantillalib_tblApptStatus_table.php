<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * PlantillalibTblApptStatus
     */
    public function up(): void
    {
        Schema::create('plantillalib_tblApptStatus', function (Blueprint $table) {
            $table->id('appt_stat_code');
            // $table->string('appt_stat_code')->nullable();
            $table->string('title')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plantillalib_tblApptStatus');
    }
};
