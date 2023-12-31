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
            $table->text('picture')->nullable();
            $table->string('emailadd')->nullable();
            $table->string('status')->nullable();
            $table->string('title')->nullable();
            $table->string('lastname')->nullable();
            $table->string('firstname')->nullable();
            $table->string('name_extension')->nullable();
            $table->string('middlename')->nullable();
            $table->string('middleinitial')->nullable();
            $table->string('nickname')->nullable();
            $table->datetime('birthdate')->nullable();
            $table->string('birthplace')->nullable();
            $table->string('gender')->nullable();
            $table->string('gender_by_choice')->nullable();
            $table->string('civilstatus')->nullable();
            $table->string('religion')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('member_of_indigenous_group')->nullable();
            $table->string('single_parent')->nullable();
            $table->string('citizenship')->nullable();
            $table->string('dual_citizenship')->nullable();
            $table->string('person_with_disability')->nullable();
            $table->integer('CESStat_code')->nullable();
            $table->string('encoder')->nullable();
            $table->integer('acno')->nullable();
            $table->text('remarks')->nullable();
            $table->string('lastupd_encoder')->nullable();
            $table->timestamp('e_date')->nullable();
            $table->timestamp('lastupd_dt')->nullable();
            $table->softDeletes();
            $table->string('mobileno')->nullable();
            $table->string('mobileno2')->nullable();
            $table->string('spouse_fname')->nullable();
            $table->string('spouse_lname')->nullable();
            $table->string('spouse_mname')->nullable();
            $table->string('telno')->nullable();
            $table->string('mailingaddr')->nullable();
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
