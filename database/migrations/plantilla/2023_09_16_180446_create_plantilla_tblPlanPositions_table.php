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
        Schema::create('plantilla_tblPlanPositions', function (Blueprint $table) {
            $table->id('plantilla_id');
            $table->integer('officeid')->nullable(); // FK
            $table->integer('pos_code')->nullable(); // FK
            $table->string('pos_suffix')->nullable();
            $table->string('pos_func_name')->nullable();
            $table->string('pos_default')->nullable();
            $table->integer('corp_sg')->nullable();
            $table->integer('pos_sequence')->default(1);
            $table->boolean('is_ces_pos')->nullable();
            $table->boolean('is_vacant')->default(true)->nullable();
            $table->boolean('is_occupied')->nullable();
            $table->text('remarks')->nullable();
            $table->integer('cbasis_code')->nullable(); // FK
            $table->text('cbasis_remarks')->nullable();
            $table->string('item_no')->nullable();
            $table->boolean('pres_apptee')->nullable();
            $table->boolean('is_active')->default(true)->nullable();
            $table->boolean('is_generic')->nullable();
            $table->boolean('is_head')->nullable();
            $table->string('created_user')->nullable();
            $table->string('lastupd_user')->nullable();
            $table->timestamp('created_dt')->nullable()->useCurrent();
            $table->timestamp('lastupd_dt')->nullable()->useCurrent();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plantilla_tblPlanPositions');
    }
};
