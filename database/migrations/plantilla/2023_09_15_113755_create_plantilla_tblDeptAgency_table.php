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

        // legacy migration
        Schema::create('plantilla_tblDeptAgency', function (Blueprint $table) {
            $table->id('deptid');
            $table->integer('sectorid')->nullable(); // FK
            $table->integer('agency_typeid')->nullable(); // FK
            $table->integer('mother_deptid')->nullable(); // FK
            $table->string('title')->nullable();
            $table->string('acronym')->nullable();
            $table->string('website')->nullable();
            $table->string('remarks')->nullable();
            $table->string('submitted_by')->nullable();
            $table->string('lastsubmit_dt')->nullable();
            $table->string('encoder')->nullable();
            $table->timestamp('encdate')->nullable()->useCurrent();
            $table->timestamp('lastupd_dt')->nullable()->useCurrent();
            $table->integer('is_national_government')->nullable(); // new 
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