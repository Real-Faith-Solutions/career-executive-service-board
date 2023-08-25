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
        Schema::create('training_tblSpeakers', function (Blueprint $table) {
            $table->id('speakerID');
            $table->unsignedBigInteger('personal_data_cesno')->nullable();
            $table->foreign('personal_data_cesno')->references('cesno')->on('profile_tblMain')->onDelete('cascade');
            $table->string('lastname');
            $table->string('firstname');
            $table->string('mi');
            $table->string('Position')->nullable();
            $table->string('Department')->nullable();
            $table->string('Office')->nullable();
            $table->string('Bldg')->nullable();
            $table->string('Street')->nullable();
            $table->string('Brgy');
            $table->string('City');
            $table->foreignId('zipcode')->constrained('profilelib_tblcities', 'city_code');
            $table->integer('contactno');
            $table->string('emailadd');
            $table->string('expertise')->nullable();
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
        Schema::dropIfExists('training_tblSpeakers');
    }
};
