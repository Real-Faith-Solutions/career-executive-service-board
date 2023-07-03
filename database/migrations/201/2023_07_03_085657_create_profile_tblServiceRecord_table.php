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
        Schema::create('profile_tblServiceRecord', function (Blueprint $table) {
            $table->id('ctrlno');
            $table->integer('appointee_id');
            $table->integer('plantilla_id');
            $table->integer('cesno');
            $table->string('appt_status');
            $table->string('position');
            $table->string('sg');
            $table->string('department');
            $table->string('location');
            $table->string('office');
            $table->string('from_dt');
            $table->string('to_dt');
            $table->string('pres_apptee');
            $table->string('is_ces_pos');
            $table->string('remarks');
            $table->string('encdate');
            $table->string('encoder');
            $table->string('lastupd_dt');
            $table->string('lastupd_enc');
            $table->string('is_Historical');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_tblServiceRecord');
    }
};
