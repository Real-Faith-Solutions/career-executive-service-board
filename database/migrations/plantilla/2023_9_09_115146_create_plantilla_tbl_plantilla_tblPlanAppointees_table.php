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
        Schema::create('plantilla_tblPlanAppointees', function (Blueprint $table) {
            $table->id('appointee_id');
            $table->integer('plantilla_id'); // FK
            $table->integer('cesno'); // FK
            $table->integer('appt_stat_code'); // FK
            $table->string('appt_date')->nullable();
            $table->string('assum_date')->nullable();
            $table->boolean('is_appointee')->nullable();
            $table->string('ofc_stat_code')->nullable();
            $table->string('basis')->nullable();
            $table->string('created_user')->nullable();
            $table->string('lastupd_user')->nullable();
            $table->timestamp('created_dt')->useCurrent();
            $table->timestamp('lastupd_dt')->useCurrent();
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
