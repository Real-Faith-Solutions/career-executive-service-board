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
        Schema::create('personal_data', function (Blueprint $table) {

            $table->id('cesno');
            // $table->bigInteger('cesno')->unique();
            $table->string('status')->nullable();
            $table->string('title')->nullable();
            $table->string('lastname')->nullable();
            $table->string('firstname')->nullable();
            $table->string('name_extension')->nullable();
            $table->string('middlename')->nullable();
            $table->string('mi')->nullable();
            $table->string('nickname')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('age')->nullable();
            $table->string('birth_place')->nullable();
            $table->string('gender')->nullable();
            $table->string('gender_by_choice')->nullable();
            $table->string('civil_status')->nullable();
            $table->string('religion')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('member_of_indigenous_group')->nullable();
            $table->string('single_parent')->nullable();
            $table->string('citizenship')->nullable();
            $table->string('dual_citizenship')->nullable();
            $table->string('person_with_disability')->nullable();
            $table->string('gsis')->nullable();
            $table->string('pagibig')->nullable();
            $table->string('philhealth')->nullable();
            $table->string('sss_no')->nullable();
            $table->string('tin')->nullable();
            $table->string('picture')->nullable();
            $table->bigInteger('cesstat_code')->nullable();
            //homeadd
            $table->string('fb_pa')->nullable();
            $table->string('ns_pa')->nullable();
            $table->string('bd_pa')->nullable();
            $table->string('cm_pa')->nullable();
            $table->string('zc_pa')->nullable();
            //mailingadd
            $table->string('fb_ma')->nullable();
            $table->string('ns_ma')->nullable();
            $table->string('bd_ma')->nullable();
            $table->string('cm_ma')->nullable();
            $table->string('zc_ma')->nullable();
            $table->string('oea_ma')->nullable();
            $table->string('mobileno1_ma')->nullable();
            $table->string('telno1_ma')->nullable();
            $table->string('mobileno2_ma')->nullable();
            $table->string('encoder')->nullable();
            $table->string('last_updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_data');
    }
};