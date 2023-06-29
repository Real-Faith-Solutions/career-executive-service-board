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
        //examinations_takens
        Schema::create('profile_tblExaminations', function (Blueprint $table) {
            $table->id('ctrlno');
            $table->bigInteger('cesno')->nullable();
            $table->string('exam_code')->nullable();
            $table->string('exam_date')->nullable();
            $table->date('exam_place')->nullable();
            $table->string('rate')->nullable();
            $table->string('encoder')->nullable();
            $table->string('encdate')->nullable();
            $table->string('lastupd_enc')->nullable();
            $table->string('lastupd_dt')->nullable();
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
