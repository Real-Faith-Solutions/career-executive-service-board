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
        Schema::create('plantillalib_tblPositionMaster', function (Blueprint $table) {
            $table->id('pos_code');

            $table->string('dbm_title')->nullable();
            $table->foreignId('poslevel_code')->constrained('plantillalib_tblPositionLevel', 'poslevel_code');
            $table->integer('sg')->nullable();
            $table->string('func_title')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plantillalib_tblPositionMaster');
    }
};
