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
        Schema::create('plantilla_tbl_dept_agencies', function (Blueprint $table) {
            $table->id();
            $table->string('deptid')->nullable();
            $table->string('title')->nullable();
            $table->string('acronym')->nullable();
            $table->string('agency_typeid')->nullable();
            $table->string('mother_deptid')->nullable();
            $table->string('sectorid')->nullable();
            $table->string('website')->nullable();
            $table->string('lastsubmit_dt')->nullable();
            $table->string('submitted_by')->nullable();
            $table->string('remakrs')->nullable();
            $table->string('endcdate')->nullable();
            $table->string('lastupd_dt')->nullable();
            $table->string('encoder')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plantilla_tbl_dept_agencies');
    }
};
