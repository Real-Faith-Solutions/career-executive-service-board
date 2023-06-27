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
        Schema::create('plantilla_tbl_agency_location', function (Blueprint $table) {
            $table->id();
            $table->string('officelocid')->nullable();
            $table->string('deptid')->nullable();
            $table->string('title')->nullable();
            $table->string('acronym')->nullable();
            $table->string('loctype_id')->nullable();
            $table->string('telno')->nullable();
            $table->string('emailaddr')->nullable();
            $table->string('region')->nullable();
            $table->date('encdate')->nullable();
            $table->date('lastupd_dt')->nullable();
            $table->string('encoder')->nullable();
            $table->date('lastupt_enc')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plantilla_tbl_agency_location');
    }
};
