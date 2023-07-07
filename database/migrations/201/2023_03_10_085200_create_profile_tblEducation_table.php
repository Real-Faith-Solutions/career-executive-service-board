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
            $table->bigInteger('cesno')->nullable();
            $table->string('level');
            $table->string('school');
            $table->string('degree')->nullable();
            $table->string('school_type');
            $table->string('period_of_attendance_from');
            $table->string('period_of_attendance_to');
            $table->string('highest_level');
            $table->string('year_graduate');
            $table->string('academics_honor_received');
            $table->string('encoder')->nullable();
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
