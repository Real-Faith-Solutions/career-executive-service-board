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
            $table->integer('cesno')->nullable();
            $table->string('lastname')->nullable();
            $table->string('firstname')->nullable();
            $table->string('mi')->nullable();
            $table->string('Position')->nullable();
            $table->string('Department')->nullable();
            $table->string('Office')->nullable();
            $table->string('Bldg')->nullable();
            $table->string('Street')->nullable();
            $table->string('Brgy')->nullable();
            $table->string('City')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('contactno')->nullable();
            $table->string('emailadd')->nullable();
            $table->string('expertise')->nullable();
            $table->string('encoder')->nullable();
            $table->string('lastupd_enc')->nullable(); 
            $table->timestamp('encdate')->useCurrent(); 
            $table->timestamp('lastupd_dt')->useCurrent(); 
            $table->softDeletes();
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
