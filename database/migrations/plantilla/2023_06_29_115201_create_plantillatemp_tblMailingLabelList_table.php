<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * PlantillaTempTblMailingLabelList
     * this is newly created migration in order to make a counterpart table from DB of legacy system
     */
    public function up(): void
    {
        Schema::create('plantillatemp_tblMailingLabelList', function (Blueprint $table) {
            $table->id('fullname');
            $table->string('department')->nullable();
            $table->string('position')->nullable();
            $table->string('addressA')->nullable();
            $table->string('addressB')->nullable();
            $table->string('addressC')->nullable();
            $table->string('contactno')->nullable();
            $table->string('emailadd')->nullable();
            $table->string('birthdate')->nullable();
            $table->string('fullname1')->nullable();
            $table->string('department1')->nullable();
            $table->string('position1')->nullable();
            $table->string('addressA1')->nullable();
            $table->string('addressB1')->nullable();
            $table->string('addressC1')->nullable();
            $table->string('contactno1')->nullable();
            $table->string('emailadd1')->nullable();
            $table->string('birthdate1')->nullable();
            $table->string('fullname2')->nullable();
            $table->string('department2')->nullable();
            $table->string('position2')->nullable();
            $table->string('addressA2')->nullable();
            $table->string('addressB2')->nullable();
            $table->string('addressC2')->nullable();
            $table->string('contactno2')->nullable();
            $table->string('emailadd2')->nullable();
            $table->string('birthdate2')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plantillatemp_tblMailingLabelList');
    }
};
