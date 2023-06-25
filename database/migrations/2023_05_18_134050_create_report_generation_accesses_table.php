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
        Schema::create('report_generation_accesses', function (Blueprint $table) {
            $table->id();
            $table->string('role_name_report_generation')->unique();
            $table->longText('rep_gen_executive_201_profile_access')->nullable();
            $table->longText('rep_gen_competency_training_management_sub_module_access')->nullable();
            $table->longText('rep_gen_eligibility_and_rank_tracking_access')->nullable();
            $table->longText('rep_gen_plantilla_management_reports_access')->nullable();
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
        Schema::dropIfExists('report_generation_accesses');
    }
};
