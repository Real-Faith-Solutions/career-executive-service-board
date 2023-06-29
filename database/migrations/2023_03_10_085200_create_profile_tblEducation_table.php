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
            $table->string('degree_code')->nullable();
            $table->string('major_code')->nullable();
            $table->string('school_code')->nullable();
            $table->string('degree_status')->nullable();
            $table->string('school_status')->nullable();
            $table->string('year_grad')->nullable();
            $table->date('honors')->nullable();
            $table->date('encoder')->nullable();
            $table->string('encdate')->nullable();
            $table->string('lastupd_enc')->nullable();
            $table->string('lastupd_dt')->nullable();
            // $table->string('last_updated_by')->nullable();
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
