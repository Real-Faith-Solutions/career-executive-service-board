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
            $table->string('title')->nullable();
            $table->string('lastname')->nullable();
            $table->string('firstname')->nullable();
            $table->string('middlename')->nullable();
            $table->string('middleinitial')->nullable();
            $table->string('nickname')->nullable();
            $table->string('picture')->nullable();

            $table->string('gender')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('birth_place')->nullable();
            $table->string('email')->nullable();
            $table->string('civil_status')->nullable();
            $table->string('religion')->nullable();
            $table->string('height')->nullable();
            $table->float('weight')->nullable();
            $table->string('remarks')->nullable();
            $table->string('encoder')->nullable();


            $table->string('CESStat_code')->nullable();

            $table->string('status')->nullable();
            $table->string('name_extension')->nullable();
            $table->string('member_of_indigenous_group')->nullable();
            $table->string('citizenship')->nullable();
            $table->string('dual_citizenship')->nullable();
            $table->string('person_with_disability')->nullable();
            $table->string('single_parent')->nullable();
            $table->string('gender_by_choice')->nullable();

            $table->softDeletes();
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
