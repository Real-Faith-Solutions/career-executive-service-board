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
        Schema::create('training_tblparticipants', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pid')->unique();
            $table->bigInteger('sessionid')->nullable();
            $table->bigInteger('cesno')->nullable();
            $table->integer('cesstat_code')->nullable();
            $table->string('status')->nullable();
            $table->longText('remarks')->nullable();
            $table->integer('no_hours')->nullable();
            $table->string('payment')->nullable();
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
        Schema::dropIfExists('training_tblparticipants');
    }
};
