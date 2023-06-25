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
        Schema::create('case_records', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cesno')->nullable();
            $table->string('parties_case_records')->nullable();
            $table->string('offence_case_records')->nullable();
            $table->string('nature_case_records')->nullable();
            $table->string('case_no_case_records')->nullable();
            $table->date('date_field_case_records')->nullable();
            $table->string('vanue_case_records')->nullable();
            $table->string('status_case_records')->nullable();
            $table->date('dof_case_records')->nullable();
            $table->string('decision_case_records')->nullable();
            $table->longText('remarks_case_records')->nullable();
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
        Schema::dropIfExists('case_records');
    }
};
