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
        Schema::create('profile_tblExaminations', function (Blueprint $table) {
            $table->id('ctrlno');
            $table->foreignId('personal_data_cesno')->constrained('profile_tblMain', 'cesno');
            $table->foreignId('exam_code')->constrained('profilelib_tblExamRef', 'CODE');
            $table->string('rating')->nullable();
            $table->string('date_of_examination')->nullable();
            $table->string('place_of_examination')->nullable();
            $table->string('license_number')->nullable();
            $table->string('date_acquired')->nullable();
            $table->string('date_validity')->nullable();
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
        Schema::dropIfExists('profile_tblExaminations');
    }
};
