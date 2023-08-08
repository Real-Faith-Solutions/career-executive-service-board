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
            // $table->bigInteger('cesno')->nullable();
            $table->unsignedBigInteger('personal_data_cesno');
            $table->foreign('personal_data_cesno')->references('cesno')->on('profile_tblMain')->onDelete('cascade');
            $table->string('level');
            $table->unsignedBigInteger('degree_code');
            // $table->foreign('degree_code')->references('CODE')->on('profilelib_tblEducDegree')->onDelete('cascade');
            $table->unsignedBigInteger('major_code');
            // $table->foreign('major_code')->references('CODE')->on('profilelib_tblEducMajor')->onDelete('cascade');
            $table->unsignedBigInteger('school_code');
            // $table->foreign('school_code')->references('CODE')->on('profilelib_tblEducSchools')->onDelete('cascade');
            // $table->string('specialization');
            // $table->string('school');
            // $table->string('degree')->nullable();
            $table->string('school_type');
            $table->string('period_of_attendance_from')->nullable();
            $table->string('period_of_attendance_to')->nullable();
            $table->string('highest_level')->nullable();
            $table->string('year_graduate');
            $table->string('academics_honor_received')->nullable();
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
        Schema::dropIfExists('profile_tblEducation');
    }
};
