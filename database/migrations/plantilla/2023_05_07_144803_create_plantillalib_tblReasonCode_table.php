<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * PlantillalibTblReasonCode
     */
    public function up(): void
    {
        Schema::create('plantillalib_tblReasonCode', function (Blueprint $table) {
            $table->id('reason_code');
            // $table->string('reason_code')->nullable();
            $table->string('module')->nullable();
            $table->string('title')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plantillalib_tblReasonCode');
    }
};
