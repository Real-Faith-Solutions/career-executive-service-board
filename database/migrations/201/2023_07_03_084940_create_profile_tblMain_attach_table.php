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
        Schema::create('profile_tblMain_attach', function (Blueprint $table) {
            $table->id('cesno');
            $table->string('cv_chk');
            $table->string('cv_text');
            $table->string('pdf_chk');
            $table->string('pdf_text');
            $table->string('certi_chk');
            $table->string('certi_text');
            $table->string('apptmt_chk');
            $table->string('apptmt_text');
            $table->string('pes_chk');
            $table->string('pes_text');
            $table->string('sr_chk');
            $table->string('sr_text');
            $table->string('queries_chk');
            $table->string('queries_text');
            $table->string('other_chk');
            $table->string('other_text');
            $table->string('rating_chk');
            $table->string('rating_text');
            $table->string('AC_chk');
            $table->string('AC_text');
            $table->string('Val_chk');
            $table->string('Val_text');
            $table->string('Orient_chk');
            $table->string('Orient_text');
            $table->string('final_chk');
            $table->string('final_text');
            $table->string('CESE_chk');
            $table->string('CESE_text');
            $table->string('rank_chk');
            $table->string('rank_text');
            $table->string('remarks');
            $table->string('encoder');
            $table->string('e_date');
            $table->string('lastupd_encoder');
            $table->string('lastupd_dt');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_tblMain_attach');
    }
};
