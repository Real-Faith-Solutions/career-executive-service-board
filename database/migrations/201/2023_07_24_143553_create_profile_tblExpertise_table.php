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
        Schema::create('profile_tblExpertise', function (Blueprint $table) {
            $table->id('ctrlno');
            $table->foreignId('personal_data_cesno')->constrained('profile_tblMain', 'cesno');
            $table->foreignId('specialization_code')->constrained('profilelib_tblExpertiseSpec', 'SpeExp_Code');
            $table->string('encoder')->nullable();
            $table->string('updated_by')->nullable();
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
