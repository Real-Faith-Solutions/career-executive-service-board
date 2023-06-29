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
        Schema::create('training_tblSpeakers', function (Blueprint $table) {
            $table->id('speakerID');
            $table->bigInteger('cesno');
            $table->string('lastname');
            $table->string('firstname');
            $table->string('mi');
            $table->string('Position');
            $table->string('Department');
            $table->string('Office');
            $table->string('Bldg');
            $table->string('Street');
            $table->string('Brgy');
            $table->string('City');
            $table->string('zipcode');
            $table->integer('contactno');
            $table->string('emailadd');
            $table->string('expertise');
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
        Schema::dropIfExists('training_tblSpeakers');
    }
};
