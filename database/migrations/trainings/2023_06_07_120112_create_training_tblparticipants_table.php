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
        //training_tblparticipants
        Schema::create('training_tblparticipants', function (Blueprint $table) {
            $table->id('pid');
            // $table->bigInteger('pid')->unique();
            $table->bigInteger('sessionid')->nullable();
            $table->bigInteger('cesno')->nullable();
            $table->integer('status')->nullable();
            $table->string('remarks')->nullable();
            $table->longText('no_hours')->nullable();
            $table->integer('payment')->nullable();
            $table->string('encoder')->nullable();
            $table->string('encoder_dt')->nullable();
            $table->string('lastupd_dt')->nullable();
            $table->string('lastupd_enc')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_tblparticipants');
    }
};
