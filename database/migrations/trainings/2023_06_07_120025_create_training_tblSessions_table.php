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
            $table->dateTime('from_dt')->nullable();
            $table->dateTime('to_dt')->nullable();
            $table->foreignId('venueId')->constrained('traininglib_tblvenue', 'venueid');
            $table->string('status')->nullable();
            $table->longText('remarks')->nullable();
            $table->string('barrio')->nullable();
            $table->integer('no_hours')->nullable();
            $table->string('session_director')->nullable();
            $table->string('training_asst')->nullable();
            $table->foreignId('speakerid')->constrained('training_tblSpeakers', 'speakerID');
            $table->string('encoder')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
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
