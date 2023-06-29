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
        Schema::create('erad_tblRankTracker201', function (Blueprint $table) {
            $table->id('ctrlno');
            $table->integer('cesno');
            $table->integer('r_catid');
            $table->integer('r_ctrlno');
            $table->string('description');
            $table->stringid('remarks');
            $table->string('submit_dt');
            $table->string('encdate');
            $table->string('encoder');
            $table->string('lastupd_dt'); 
            $table->string('lastupd_enc');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('erad_tblRankTracker201');
    }
};
