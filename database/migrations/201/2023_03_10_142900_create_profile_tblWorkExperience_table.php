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
            // $table->bigInteger('cesno')->nullable();
            $table->unsignedBigInteger('personal_data_cesno');
            $table->foreign('personal_data_cesno')->references('cesno')->on('profile_tblMain')->onDelete('cascade');
            $table->date('from_dt');
            $table->date('to_dt');
            $table->string('designation')->nullable();
            $table->string('status')->nullable();
            $table->string('monthly_salary')->nullable();
            $table->string('salary')->nullable();
            $table->string('department')->nullable();
            $table->string('government_service')->nullable();
            $table->string('remarks')->nullable();
            $table->string('encoder');
            // $table->string('last_updated_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
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
