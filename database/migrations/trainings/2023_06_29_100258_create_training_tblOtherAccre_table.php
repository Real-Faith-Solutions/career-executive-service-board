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
        Schema::create('training_tblOtherAccre', function (Blueprint $table) {
            $table->id('ctrlno');
            $table->bigInteger('cesno');
            $table->string('training');
            $table->string('no_hours');
            $table->string('sponsor');
            $table->string('venue');
            $table->string('from_dt');
            $table->string('to_dt');
            $table->string('specialization');
            $table->string('encoder');
            $table->string('encdate');
            $table->string('lastupd_enc');
            $table->string('lastupd_dt');
            $table->string('providerID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_tblOtherAccre');
    }
};
