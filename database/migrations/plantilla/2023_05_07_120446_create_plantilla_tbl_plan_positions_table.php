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
        Schema::create('plantilla_tbl_plan_positions', function (Blueprint $table) {
            $table->id();
            $table->string('plantilla_id')->nullable();
            $table->string('officeid')->nullable();
            $table->string('pos_code')->nullable();
            $table->string('pos_suffix')->nullable();
            $table->string('pos_func_name')->nullable();
            $table->string('pos_default')->nullable();
            $table->string('corp_sg')->nullable();
            $table->string('pos_sequence')->nullable();
            $table->string('is_ces_pos')->nullable();
            $table->string('is_vacant')->nullable();
            $table->string('is_occupied')->nullable();
            $table->string('created_dt')->nullable();
            $table->string('created_user')->nullable();
            $table->string('lastupd_dt')->nullable();
            $table->string('lastupd_user')->nullable();
            $table->string('remarks')->nullable();
            $table->string('cbasis_code')->nullable();
            $table->string('cbasis_remarks')->nullable();
            $table->string('item_no')->nullable();
            $table->string('pres_apptee')->nullable();
            $table->string('is_active')->nullable();
            $table->string('is_generic')->nullable();
            $table->string('is_head')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plantilla_tbl_plan_positions');
    }
};
