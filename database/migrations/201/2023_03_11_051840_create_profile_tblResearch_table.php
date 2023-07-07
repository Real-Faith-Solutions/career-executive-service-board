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
            $table->bigInteger('cesno');
            $table->string('title');
            $table->string('publisher');
            $table->string('inclusive_date_from');
            $table->string('inclusive_date_to');
            $table->string('encoder');
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
