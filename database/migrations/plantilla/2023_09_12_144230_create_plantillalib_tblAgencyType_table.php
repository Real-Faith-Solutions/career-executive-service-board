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
        // migrate from legacy
        Schema::create('plantillalib_tblAgencyType', function (Blueprint $table) {
            $table->id('agency_typeid');
            $table->foreignId('sectorid')->constrained('plantilla_tblSector', 'sectorid');
            $table->string('title')->nullable();
            $table->string('encoder')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plantillalib_tblAgencyType');
    }
};