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
        Schema::table('profilelib_tbl_educ_schools', function (Blueprint $table) {
            $table->string('encoder')->nullable();
            $table->string('lastupd_enc')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profilelib_tbl_educ_schools', function (Blueprint $table) {
            //
        });
    }
};
