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
        Schema::create('work_experiences', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cesno')->nullable();
            $table->date('date_from_work_experience')->nullable();
            $table->date('date_to_work_experience')->nullable();
            $table->string('destination_from_work_experience')->nullable();
            $table->string('status_from_work_experience')->nullable();
            $table->string('salary_from_work_experience')->nullable();
            $table->string('salary_job_pay_grade_work_experience')->nullable();
            $table->string('status_of_appointment_work_experience')->nullable();
            $table->string('government_service_work_experience')->nullable();
            $table->string('department_from_work_experience')->nullable();
            $table->longText('remarks_from_work_experience')->nullable();
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
        Schema::dropIfExists('work_experiences');
    }
};
