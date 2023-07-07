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
        //field_expertises
        Schema::create('profile_tblExpertise', function (Blueprint $table) {
            $table->id('ctrlno');
            $table->bigInteger('cesno');
            $table->string('expertise_specialization');
            $table->string('encoder');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_tblExpertise');
    }
};
