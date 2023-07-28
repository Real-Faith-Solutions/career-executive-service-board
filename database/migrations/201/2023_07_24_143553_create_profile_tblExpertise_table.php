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
            // $table->bigInteger('cesno');
            $table->unsignedBigInteger('personal_data_cesno');
            $table->foreign('personal_data_cesno')->references('cesno')->on('profile_tblMain')->onDelete('cascade');
            $table->unsignedBigInteger('specialization_code');
            $table->foreign('specialization_code')->references('SpeExp_Code')->on('profilelib_tblExpertiseSpec')->onDelete('cascade');
            // $table->string('expertise_specialization');
            $table->string('encoder')->nullable();
            $table->softDeletes();
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
