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
        //award_and_citations
        Schema::create('profile_tblAwards', function (Blueprint $table) {
            $table->id('ctrlno');
            $table->bigInteger('cesno')->nullable();
            $table->date('awards')->nullable();
            $table->string('sponsor')->nullable();
            $table->string('award_dt')->nullable();
            $table->string('aw_dt')->nullable();
            $table->string('encoder')->nullable();
            $table->string('encdate')->nullable();
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
        Schema::dropIfExists('profile_tblAwards');
    }
};
