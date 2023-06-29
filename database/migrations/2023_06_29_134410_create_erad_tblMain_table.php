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
        Schema::create('erad_tblMain', function (Blueprint $table) {
            $table->id('acbatchno');
            $table->string('acno');
            $table->string('lastname');
            $table->string('firstname');
            $table->string('middlename');
            $table->string('position');
            $table->string('position_remarks');
            $table->string('department');
            $table->string('office');
            $table->string('c_status');
            $table->string('c_date');
            $table->string('c_resno');
            $table->string('we_date');
            $table->string('wlocation');
            $table->string('werating');
            $table->string('we_remarks');
            $table->string('encoder');
            $table->string('e_date');
            $table->string('picture');
            $table->integer('contactno');
            $table->integer('faxno');
            $table->integer('mobileno');
            $table->string('gender');
            $table->string('birthdate');
            $table->string('emailadd');
            $table->integer('cesno');
            $table->string('maddress');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('erad_tblMain');
    }
};
