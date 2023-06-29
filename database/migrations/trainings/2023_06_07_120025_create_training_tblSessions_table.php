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
        //training_tbl_sessions
        Schema::create('training_tblSessions', function (Blueprint $table) {
            $table->id('sessionid');
            // $table->bigInteger('sessionid')->unique();
            $table->string('title')->nullable();
            $table->string('category')->nullable();
            $table->string('specialization')->nullable();
            $table->date('from_dt')->nullable();
            $table->date('to_dt')->nullable();
            $table->integer('venueid')->nullable();
            $table->string('status')->nullable();
            $table->longText('remarks')->nullable();
            $table->string('barrio')->nullable();
            $table->integer('no_hours')->nullable();
            $table->string('session_director')->nullable();
            $table->string('training_asst')->nullable();
            $table->integer('speakerid')->nullable();
            $table->string('encoder')->nullable();
            $table->string('encoder_dt')->nullable();
            $table->string('lastupd_enc')->nullable();
            $table->string('lastupd_dt')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_tblSessions');
    }
};
