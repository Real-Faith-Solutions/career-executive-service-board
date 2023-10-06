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
        Schema::create('plantilla_tblOffice_Addr', function (Blueprint $table) {
            // $table->foreignId('officeid')->primary()->constrained('plantilla_tblOffice', 'officeid');
            $table->foreignId('officeid')->primary();
            $table->string('floor_bldg')->nullable();
            $table->string('house_no_st')->nullable();
            $table->string('brgy_dist')->nullable();
            $table->integer('city_code'); // FK
            $table->string('contactno')->nullable();
            $table->string('emailadd')->nullable();
            $table->boolean('isActive')->default(true)->nullable();

            $table->integer('ofcaddrid')->nullable(); // need to get in migration still pending what tables

            // required in every table
            $table->string('updated_by')->nullable();
            $table->string('encoder')->nullable();
            $table->softDeletes();
            $table->timestamp('encdate')->useCurrent();
            $table->timestamp('lastupd_dt')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plantilla_tblOffice_Addr');
    }
};
