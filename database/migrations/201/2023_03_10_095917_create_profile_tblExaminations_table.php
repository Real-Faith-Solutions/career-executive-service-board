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
            $table->bigInteger('cesno');
            $table->string('type');
            $table->string('rating')->nullable();
            $table->string('date_of_examination');
            $table->string('place_of_examination');
            $table->string('license_number')->nullable();
            $table->string('date_acquired')->nullable();
            $table->string('date_validity')->nullable();
            $table->string('encoder');
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
