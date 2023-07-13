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
        //case_records
        Schema::create('profile_tblCaseRecord', function (Blueprint $table) {
            $table->id('ctrlno');
            // $table->bigInteger('cesno')->nullable();
            $table->unsignedBigInteger('personal_data_cesno');
            $table->foreign('personal_data_cesno')->references('cesno')->on('personal_data')->onDelete('cascade');
            $table->string('parties')->nullable();
            $table->string('offence')->nullable();
            $table->string('nature_code')->nullable();
            $table->string('case_no')->nullable();
            $table->string('case_title')->nullable();
            $table->date('filed_date')->nullable();
            $table->string('venue')->nullable();
            $table->string('status_code')->nullable();
            $table->date('finality')->nullable();
            $table->string('decision')->nullable();
            $table->string('remarks')->nullable();
            $table->string('encoder')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_tblCaseRecord');
    }
};
