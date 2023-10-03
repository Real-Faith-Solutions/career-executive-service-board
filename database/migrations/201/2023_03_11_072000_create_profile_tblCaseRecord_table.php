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
            $table->unsignedBigInteger('cesno');
            $table->foreign('cesno')->references('cesno')->on('profile_tblMain')->onDelete('cascade');
            $table->string('parties')->nullable();
            $table->string('offence')->nullable();
            $table->string('nature_code')->nullable();
            $table->string('case_no')->nullable();
            $table->string('case_title')->nullable();
            $table->date('filed_dt')->nullable();
            $table->string('venue')->nullable();
            $table->string('status_code')->nullable();
            $table->date('finality')->nullable();
            $table->string('decision')->nullable();
            $table->string('remarks')->nullable();
            $table->string('encoder')->nullable();
            $table->string('lastupd_enc')->nullable();
            $table->timestamp('encdate')->useCurrent(); 
            $table->timestamp('lastupd_dt')->useCurrent();
            $table->softDeletes();
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
