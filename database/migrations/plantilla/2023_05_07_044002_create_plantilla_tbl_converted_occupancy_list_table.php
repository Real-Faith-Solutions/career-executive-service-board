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
        Schema::create('plantilla_tbl_converted_occupancy_list', function (Blueprint $table) {
            $table->id();
            $table->string('posting_dt')->nullable();
            $table->string('ctrlno')->nullable();
            $table->string('plantilla_id')->nullable();
            $table->string('pos_code')->nullable();
            $table->string('deptid')->nullable();
            $table->string('department')->nullable();
            $table->string('MotherDeptID')->nullable();
            $table->string('MotherDept')->nullable();
            $table->string('agencytype')->nullable();
            $table->string('officelocid')->nullable();
            $table->string('AgencyLocation')->nullable();
            $table->string('RegionSeq')->nullable();
            $table->string('officeid')->nullable();
            $table->string('office')->nullable();
            $table->string('floor_bldg')->nullable();
            $table->string('house_no_st')->nullable();
            $table->string('brgy_dist')->nullable();
            $table->string('city_code')->nullable();
            $table->string('city')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('provine')->nullable();
            $table->string('region')->nullable();
            $table->string('contactno')->nullable();
            $table->string('emailadd')->nullable();
            $table->string('is_ces_pos')->nullable();
            $table->string('is_generic')->nullable();
            $table->string('pres_apptee')->nullable();
            $table->string('is_vacant')->nullable();
            $table->string('dbm_title')->nullable();
            $table->string('pos_default')->nullable();
            $table->string('pos_suffix')->nullable();
            $table->string('item_no')->nullable();
            $table->string('sg')->nullable();
            $table->string('remarks')->nullable();
            $table->string('occu_cesno')->nullable();
            $table->string('occu_title')->nullable();
            $table->string('occu_lastname')->nullable();
            $table->string('occu_firstname')->nullable();
            $table->string('occu_middlename')->nullable();
            $table->string('occu_mi')->nullable();
            $table->string('occu_fullname')->nullable();
            $table->string('occu_gender')->nullable();
            $table->string('occu_cesstatus')->nullable();
            $table->string('occu_appstatus')->nullable();
            $table->string('occu_specAssign')->nullable();
            $table->date('occu_appdate')->nullable();
            $table->string('occu_birthdate')->nullable();
            $table->string('sequence_no')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plantilla_tbl_converted_occupancy_list');
    }
};
