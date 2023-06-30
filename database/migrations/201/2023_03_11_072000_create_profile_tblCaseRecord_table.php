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
            $table->bigInteger('cesno')->nullable();
            $table->string('parties')->nullable();
            $table->string('offence')->nullable();
            $table->string('nature_code')->nullable();
            $table->string('case_no')->nullable();
            $table->date('case_title')->nullable();
            $table->string('filed_dt')->nullable();
            $table->string('venue')->nullable();
            $table->date('status_code')->nullable();
            $table->string('decision')->nullable();
            $table->longText('finality')->nullable();
            $table->string('remarks')->nullable();
            $table->string('encoder')->nullable();
            $table->string('encdate')->nullable();
            $table->string('lastupd_enc')->nullable();
            $table->string('lastupd_dt')->nullable();
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
