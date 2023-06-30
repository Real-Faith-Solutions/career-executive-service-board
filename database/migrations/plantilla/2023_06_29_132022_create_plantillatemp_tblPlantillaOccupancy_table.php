<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * PlantillaTempTblPlantillaOccupancy
     * this is newly created migration in order to make a counterpart table from DB of legacy system
     */
    public function up(): void
    {
        Schema::create('plantillatemp_tblPlantillaOccupancy', function (Blueprint $table) {
            $table->id('ctrlno');
            $table->string('plantilla_id')->nullable();
            $table->string('pos_code')->nullable();
            $table->string('deptid')->nullable();
            $table->string('department')->nullable();
            $table->string('agencytype')->nullable();
            $table->string('officelocid')->nullable();
            $table->string('AgencyLocation')->nullable();
            $table->string('RegionSeq')->nullable();
            $table->string('officeid')->nullable();
            $table->string('office')->nullable();
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
            $table->string('apptee_cesno')->nullable();
            $table->string('apptee_fullname')->nullable();
            $table->string('apptee_cesstatus')->nullable();
            $table->string('apptee_appstatus')->nullable();
            $table->string('apptee_apptdate')->nullable();
            $table->string('apptee_assumdate')->nullable();
            $table->string('apptee_specAssign')->nullable();
            $table->string('occu_cesno')->nullable();
            $table->string('occu_fullname')->nullable();
            $table->string('occu_cesstatus')->nullable();
            $table->string('occu_appstatus')->nullable();
            $table->string('occu_specAssign')->nullable();
            $table->string('cbasis_code')->nullable();
            $table->string('classbasis')->nullable();
            $table->string('classremarks')->nullable();
            $table->string('classdate')->nullable();
            $table->string('pos_count')->nullable();
            $table->string('occu_apptdate')->nullable();
            $table->string('lastupd_dt')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plantillatemp_tblPlantillaOccupancy');
    }
};
