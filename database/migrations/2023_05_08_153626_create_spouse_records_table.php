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
            $table->id('ctrlno');
            // $table->bigInteger('cesno')->nullable();
            $table->unsignedBigInteger('personal_data_cesno');
            $table->foreign('personal_data_cesno')->references('cesno')->on('personal_data')->onDelete('cascade');
            $table->string('last_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('name_extension')->nullable();
            $table->string('occupation')->nullable();
            $table->string('employer_business_name')->nullable();
            $table->string('employer_business_address')->nullable();
            $table->string('employer_business_telephone')->nullable();
            // $table->string('civil_status_sn_fp')->nullable();
            // $table->string('gender_sn_fp')->nullable();
            // $table->date('birthdate_sn_fp')->nullable();
            // $table->string('age_sn_fp')->nullable();
            $table->string('encoder')->nullable();
            // $table->string('last_updated_by')->nullable();
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
