<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Plantillalib_TblClassBasis
     */
    public function up(): void
    {
        Schema::create('plantillalib_tblClassBasis', function (Blueprint $table) {
            $table->id('cbasis_code');
            // $table->string('cbasis_code')->nullable();
            $table->string('basis')->nullable();
            $table->string('title')->nullable();
            $table->string('classdate')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plantillalib_tblClassBasis');
    }
};
