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
        Schema::create('profile_tblTrainingCES', function (Blueprint $table) {
            $table->id('ctrlno');
            $table->integer('cesno');
            $table->integer('trng_code');
            $table->string('encoder');
            $table->string('encdate');
            $table->string('lastupd_enc');
            $table->string('lastupd_dt');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_tblTrainingCES');
    }
};
