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
            $table->integer('cesno');
            $table->integer('degree_code')->nullable();
            $table->integer('major_code')->nullable();
            $table->integer('school_code')->nullable();
            $table->string('level')->nullable();
            $table->string('school_status')->nullable();
            $table->string('degree_status')->nullable();
            $table->string('period_of_attendance_from')->nullable();
            $table->string('year_grad')->nullable();
            $table->string('honors')->nullable();
            $table->string('encoder')->nullable();
            $table->string('lastupd_enc')->nullable();
            $table->timestamp('encdate')->nullable()->useCurrent();
            $table->timestamp('lastupd_dt')->nullable()->useCurrent();
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
