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
        //educational_attainments
        Schema::create('profile_tblEducation', function (Blueprint $table) {
            $table->id('ctrlno');
            $table->foreignId('personal_data_cesno')->constrained('profile_tblMain', 'cesno');
            $table->foreignId('degree_code')->constrained('profilelib_tblEducDegree', 'CODE');
            $table->foreignId('major_code')->constrained('profilelib_tblEducMajor', 'CODE');
            $table->foreignId('school_code')->constrained('profilelib_tblEducSchools', 'CODE');
            $table->string('level')->nullable();
            $table->string('school_type')->nullable();
            $table->string('period_of_attendance_from')->nullable();
            $table->string('period_of_attendance_to')->nullable();
            $table->string('highest_level')->nullable();
            $table->string('academics_honor_received')->nullable();
            $table->string('encoder')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_tblEducation');
    }
};
