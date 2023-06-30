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
        Schema::create('plantilla_temp_rpt_occupancies', function (Blueprint $table) {
            $table->id();
            $table->string('plantilla_id')->nullable();
            $table->string('pos_code')->nullable();
            $table->string('deptid')->nullable();
            $table->string('officelocid')->nullable();
            $table->string('officeid')->nullable();
            $table->string('is_active')->nullable();
            $table->string('is_ces_pos')->nullable();
            $table->string('is_generic')->nullable();
            $table->string('is_occupied')->nullable();
            $table->string('pos_func_name')->nullable();
            $table->string('pos_default')->nullable();
            $table->string('pos_suffix')->nullable();
            $table->string('item_no')->nullable();
            $table->string('pres_apptee')->nullable();
            $table->string('is_vacant')->nullable();
            $table->string('dbm_title')->nullable();
            $table->string('poslevel_code')->nullable();
            $table->string('sg')->nullable();
            $table->string('pos_title_level')->nullable();
            $table->string('remarks')->nullable();
            $table->string('Department')->nullable();
            $table->string('Dept_Acronym')->nullable();
            $table->string('AgencyType')->nullable();
            $table->string('MotherDept')->nullable();
            $table->string('mother_deptid')->nullable();
            $table->string('Location')->nullable();
            $table->string('LocationType')->nullable();
            $table->string('LocRegion_acronym')->nullable();
            $table->string('Office')->nullable();
            $table->string('OfcAcronym')->nullable();
            $table->string('OfcAddr_Bldg')->nullable();
            $table->string('OfcAddr_No_St')->nullable();
            $table->string('OfcAddr_City')->nullable();
            $table->string('OfcTelNo')->nullable();
            $table->string('OfcEmail')->nullable();
            $table->string('appointee_id')->nullable();
            $table->string('cesno')->nullable();
            $table->string('Appt_Status')->nullable();
            $table->string('app_date')->nullable();
            $table->string('assum_date')->nullable();
            $table->string('is_appointee')->nullable();
            $table->string('lastname')->nullable();
            $table->string('firstname')->nullable();
            $table->string('middlename')->nullable();
            $table->string('fullname')->nullable();
            $table->string('CESStatus')->nullable();
            $table->string('regionSeq')->nullable();
            $table->string('cbasis_code')->nullable();
            $table->string('classbasis')->nullable();
            $table->string('classremarks')->nullable();
            $table->string('classdate')->nullable();
            $table->string('gender')->nullable();
            $table->string('sg_level')->nullable();
            $table->string('is_head')->nullable();
            $table->string('website')->nullable();
            $table->string('lastsubmit_dt')->nullable();
            $table->string('submitted_by')->nullable();
            $table->string('lastPlantilla_DT')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plantilla_temp_rpt_occupancies');
    }
};
