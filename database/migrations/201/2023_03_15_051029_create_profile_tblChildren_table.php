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
        //children_records
        Schema::create('profile_tblChildren', function (Blueprint $table) {
            $table->id('ctrlno');
            // $table->bigInteger('cesno')->nullable();
            $table->unsignedBigInteger('cesno');
            $table->foreign('cesno')->references('cesno')->on('personal_data')->onDelete('cascade');
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('birthdate')->nullable();
            $table->string('gender')->nullable();
            $table->date('encoder')->nullable();
            // $table->string('encdate')->nullable();
            // $table->string('lastupd_enc')->nullable();
            // $table->string('lastupd_dt')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_tblChildren');
    }
};
