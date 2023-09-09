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
            $table->foreignId('officeid')->constrained('plantilla_tblOffice', 'officeid');
            $table->foreignId('pos_code')->constrained('plantillalib_tblPositionMaster', 'pos_code');
            $table->string('pos_suffix')->nullable();
            $table->string('pos_func_name')->nullable();
            $table->string('pos_default')->nullable();
            $table->integer('corp_sg')->nullable();
            $table->integer('pos_sequence')->default(1);
            $table->boolean('is_ces_pos')->nullable();
            $table->boolean('is_vacant')->nullable();
            $table->boolean('is_occupied')->nullable();
            $table->string('encoder')->nullable();
            $table->string('updated_by')->nullable();
            $table->text('remarks')->nullable();
            $table->integer('cbasis_code')->nullable();
            $table->text('cbasis_remarks')->nullable();
            $table->string('item_no')->nullable();
            $table->boolean('pres_apptee')->nullable();
            $table->boolean('is_active')->nullable();
            $table->boolean('is_generic')->nullable();
            $table->boolean('is_head')->nullable();
            $table->timestamps();
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
