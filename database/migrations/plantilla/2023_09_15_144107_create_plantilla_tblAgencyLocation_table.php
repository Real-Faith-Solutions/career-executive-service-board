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

        Schema::create('plantilla_tblAgencyLocation', function (Blueprint $table) {
            $table->id('officelocid');
            $table->foreignId('deptid')->constrained('plantilla_tblDeptAgency', 'deptid');
            $table->foreignId('agencyloc_Id')->constrained('plantillalib_tblAgencyLocation', 'agencyloc_Id');
            $table->string('title')->nullable();
            $table->string('acronym')->nullable();
            $table->string('telno')->nullable();
            $table->string('email')->nullable();
            $table->string('region')->nullable();
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
        Schema::dropIfExists('plantilla_tblAgencyLocation');
    }
};