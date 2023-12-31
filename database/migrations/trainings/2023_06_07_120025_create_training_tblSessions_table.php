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
            $table->string('title')->nullable();
            $table->string('category')->nullable();
            $table->string('specialization')->nullable();
            $table->string('from_dt')->nullable();
            $table->string('to_dt')->nullable();
            $table->integer('venueId')->nullable();
            // $table->foreignId('venueId')->constrained('traininglib_tblvenue', 'venueid');
            $table->string('status')->nullable();
            $table->string('remarks')->nullable();
            $table->string('barrio')->nullable();
            $table->integer('no_hours')->nullable();
            $table->string('session_director')->nullable();
            $table->string('training_asst')->nullable();
            $table->integer('speakerid')->nullable();
            // $table->foreignId('speakerid')->constrained('training_tblSpeakers', 'speakerID');
            $table->string('encoder')->nullable();
            $table->string('lastupd_enc')->nullable();
            $table->timestamp('encoder_dt')->nullable()->useCurrent();
            $table->timestamp('lastupd_dt')->nullable()->useCurrent();
            $table->softDeletes();
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
