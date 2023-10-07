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
            $table->integer('deptid')->nullable(); // FK
            $table->integer('loctype_id')->nullable(); // FK
            $table->string('title')->nullable();
            $table->string('acronym')->nullable();
            $table->string('telno')->nullable();
            $table->string('emailaddr')->nullable();
            $table->string('region')->nullable();
            $table->string('encoder')->nullable();
            $table->string('lastupd_enc')->nullable();
            $table->timestamp('encdate')->nullable()->useCurrent();
            $table->timestamp('lastupd_dt')->nullable()->useCurrent();
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
