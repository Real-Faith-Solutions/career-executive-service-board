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
        Schema::create('spouse_records', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cesno')->nullable();
            $table->string('lastname_sn_fp')->nullable();
            $table->string('first_sn_fp')->nullable();
            $table->string('middlename_sn_fp')->nullable();
            $table->string('ne_sn_fp')->nullable();
            $table->string('occu_sn_fp')->nullable();
            $table->string('ebn_sn_fp')->nullable();
            $table->string('eba_sn_fp')->nullable();
            $table->string('etn_sn_fp')->nullable();
            $table->string('civil_status_sn_fp')->nullable();
            $table->string('gender_sn_fp')->nullable();
            $table->date('birthdate_sn_fp')->nullable();
            $table->string('age_sn_fp')->nullable();
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
        Schema::dropIfExists('spouse_records');
    }
};
