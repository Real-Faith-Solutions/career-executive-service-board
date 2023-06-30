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
        Schema::create('plantillalib_tbl_agency_locations', function (Blueprint $table) {
            $table->id();
            $table->string('agencyloc_id')->nullable();
            $table->string('title')->nullable();
            $table->string('encdate')->nullable();
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
        Schema::dropIfExists('plantillalib_tbl_agency_locations');
    }
};
