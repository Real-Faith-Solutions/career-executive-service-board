<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * PlantillaTempRptPoswithDeptAddr
     * this is newly created migration in order to make a counterpart table from DB of legacy system
     */
    public function up(): void
    {
        Schema::create('plantillatemp_rptPoswithDeptAddr', function (Blueprint $table) {
            $table->id('plantilla_id');
            $table->string('pos_code')->nullable();
            $table->string('pos_func_name')->nullable();
            $table->string('pos_suffix')->nullable();
            $table->string('is_ces_pos')->nullable();
            $table->string('item_no')->nullable();
            $table->string('pres_apptee')->nullable();
            $table->string('is_active')->nullable();
            $table->string('pos_default')->nullable();
            $table->string('is_vacant')->nullable();
            $table->string('is_occupied')->nullable();
            $table->string('dbm_title')->nullable();
            $table->string('poslevel_code')->nullable();
            $table->string('sg')->nullable();
            $table->string('seq')->nullable();
            $table->string('pos_title_level')->nullable();
            $table->string('sg_level')->nullable();
            $table->string('pl_func_name')->nullable();
            $table->string('acronym')->nullable();
            $table->string('corp_sg')->nullable();
            $table->string('remarks')->nullable();
            $table->string('class_basis')->nullable();
            $table->string('cbasis_remarks')->nullable();
            $table->string('posdef_suffix')->nullable();
            $table->string('is_generic')->nullable();
            $table->string('cbasis_code')->nullable();
            $table->string('deptid')->nullable();
            $table->string('department')->nullable();
            $table->string('officeid')->nullable();
            $table->string('officelocid')->nullable();
            $table->string('Office')->nullable();
            $table->string('floor_bldg')->nullable();
            $table->string('house_no_st')->nullable();
            $table->string('brgy_dist')->nullable();
            $table->string('city_code')->nullable();
            $table->string('contactno')->nullable();
            $table->string('emailadd')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('region')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plantillatemp_rptPoswithDeptAddr');
    }
};
