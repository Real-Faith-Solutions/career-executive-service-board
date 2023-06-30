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
        //research_and_studies
        Schema::create('profile_tblResearch', function (Blueprint $table) {
            $table->id('ctrlno');
            $table->bigInteger('cesno')->nullable();
            $table->date('title')->nullable();
            $table->date('sponsor')->nullable();
            $table->string('from_dt')->nullable();
            $table->string('to_dt')->nullable();
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
        Schema::dropIfExists('profile_tblResearch');
    }
};
