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
        Schema::create('training_tbl_sessions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sessionid')->unique();
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
            $table->integer('speakerid')->nullable();
            $table->string('encoder')->nullable();
            $table->string('lastupd_enc')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_tbl_sessions');
    }
};
