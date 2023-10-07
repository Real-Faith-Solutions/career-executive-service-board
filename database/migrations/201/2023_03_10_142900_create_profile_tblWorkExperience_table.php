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
        //work_experiences
        Schema::create('profile_tblWorkExperience', function (Blueprint $table) {
            $table->id('ctrlno');
            $table->integer('cesno');
            // $table->foreignId('personal_data_cesno')->constrained('profile_tblMain', 'cesno');
            $table->string('from_dt')->nullable();
            $table->string('to_dt')->nullable();
            $table->string('designation')->nullable();
            $table->string('status')->nullable();
            $table->string('annually_salary')->nullable();
            $table->string('salary')->nullable(); // Salary/Job/Pay Grade (if applicable include step increment) * 
            $table->string('department')->nullable();
            $table->string('government_service')->nullable();
            $table->string('remarks')->nullable();
            $table->string('encoder')->nullable();
            $table->string('lastupd_enc')->nullable();
            $table->timestamp('encdate')->nullable()->useCurrent();
            $table->timestamp('lastupd_dt')->nullable()->useCurrent();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_tblWorkExperience');
    }
};
