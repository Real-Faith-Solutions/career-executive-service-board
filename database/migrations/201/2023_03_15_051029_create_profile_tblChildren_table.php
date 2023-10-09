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
            $table->integer('cesno')->nullable();
            // $table->unsignedBigInteger('personal_data_cesno');
            // $table->foreign('personal_data_cesno')->references('cesno')->on('profile_tblMain')->onDelete('cascade');
            $table->string('lname')->nullable();
            $table->string('fname')->nullable();
            $table->string('mname')->nullable();
            $table->string('name_extension')->nullable();
            $table->string('gender')->nullable();
            $table->date('bdate')->nullable();
            $table->string('birth_place')->nullable();
            $table->string('encoder')->nullable();
            $table->string('lastupd_enc')->nullable();
            $table->timestamp('encdate')->useCurrent()->nullable();
            $table->timestamp('lastupd_dt')->useCurrent()->nullable();
            $table->softDeletes();
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
