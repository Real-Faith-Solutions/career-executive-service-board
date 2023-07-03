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
        Schema::create('profile_tblMain', function (Blueprint $table) {
            $table->id('cesno');
            $table->integer('acno');
            $table->string('title');
            $table->string('lastname');
            $table->string('firstname');
            $table->string('middlename');
            $table->string('middleinitial');
            $table->string('nickname');
            $table->string('picture');
            $table->integer('mobileno');
            $table->string('gender');
            $table->date('birthdate');
            $table->string('birthplace');
            $table->string('emailadd');
            $table->string('civilstatus');
            $table->string('religion');
            $table->string('height');
            $table->float('weight');
            $table->string('remarks');
            $table->string('encoder');
            $table->string('e_date');
            $table->string('lastupd_dt');
            $table->string('CESStat_code');
            $table->string('spouse_fname');
            $table->string('spouse_mname');
            $table->string('spouse_lname');
            $table->integer('telno');
            $table->string('mailingaddr');
            $table->string('status');
            $table->integer('mobileno2');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_tblMain');
    }
};
