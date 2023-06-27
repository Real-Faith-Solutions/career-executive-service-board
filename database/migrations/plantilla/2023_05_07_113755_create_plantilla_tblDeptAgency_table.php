<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * PlantillaTblDeptAgency
     */
    public function up(): void
    {
        Schema::create('plantilla_tblDeptAgency', function (Blueprint $table) {
            $table->id('deptid');
            // $table->string('deptid')->nullable();
            $table->string('title')->nullable();
            $table->string('acronym')->nullable();
            $table->string('agency_typeid')->nullable();
            $table->string('mother_deptid')->nullable();
            $table->string('sectorid')->nullable();
            $table->string('website')->nullable();
            $table->string('lastsubmit_dt')->nullable();
            $table->string('submitted_by')->nullable();
            $table->string('remarks')->nullable();
            $table->string('encdate')->nullable();
            $table->string('lastupd_dt')->nullable();
            $table->string('encoder')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plantilla_tblDeptAgency');
    }
};
