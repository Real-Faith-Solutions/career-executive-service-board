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
        Schema::create('plantilla_tblOtherAssignment', function (Blueprint $table) {
            $table->id('detailed_code');
            $table->foreignId('cesno')->constrained('profile_tblMain', 'cesno');
            $table->foreignId('appt_status_code')->constrained('plantillalib_tblApptStatus', 'appt_stat_code');
            $table->string('position')->nullable();
            $table->string('office')->nullable();
            $table->string('from_dt')->nullable();
            $table->string('to_dt')->nullable();
            $table->string('remarks')->nullable();
            $table->string('house_bldg')->nullable();
            $table->string('st_road')->nullable();
            $table->string('brgy_vill')->nullable();
            $table->foreignId('city_code')->constrained('profilelib_tblcities', 'city_code');
            $table->string('contactno')->nullable();
            $table->string('email_addr')->nullable();
            $table->string('encoder')->nullable();
            $table->string('lastupd_enc')->nullable();
            $table->timestamp('encdate')->useCurrent();
            $table->timestamp('lastupd_dt')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plantilla_tblOtherAssignment');
    }
};
