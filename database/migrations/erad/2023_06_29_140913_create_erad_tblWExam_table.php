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
        Schema::create('erad_tblWExam', function (Blueprint $table) {
            $table->id('acno');
            $table->string('we_date');
            $table->string('we_location');
            $table->string('we_rating');
            $table->string('we_remarks');
            $table->string('encoder');
            $table->string('encdate');
            $table->integer('ctrlno');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('erad_tblWExam');
    }
};
