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
        Schema::create('executive201_role_accesses', function (Blueprint $table) {
            $table->id();
            $table->string('role_name')->unique();
            $table->text('executive_201_page_access')->nullable();
            $table->text('personal_data_rights')->nullable();
            $table->text('family_background_profile_rights')->nullable();
            $table->text('educational_background_attainment_rights')->nullable();
            $table->text('examinations_taken_rights')->nullable();
            $table->text('language_dialects_rights')->nullable();
            $table->text('eligibility_and_rank_tracker_rights')->nullable();
            $table->text('record_of_cespes_ratings_rights')->nullable();
            $table->text('work_experience_rights')->nullable();
            $table->text('records_of_field_of_expertise_specialization_rights')->nullable();
            $table->text('ces_trainings_rights')->nullable();
            $table->text('other_non_ces_accredited_trainings_rights')->nullable();
            $table->text('research_and_studies_rights')->nullable();
            $table->text('scholarships_received_rights')->nullable();
            $table->text('major_civic_and_professional_affiliations_rights')->nullable();
            $table->text('awards_and_citations_received_rights')->nullable();
            $table->text('case_records_rights')->nullable();
            $table->text('health_record_rights')->nullable();
            $table->text('attached_pdf_files_rights')->nullable();
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
        Schema::dropIfExists('executive201_role_accesses');
    }
};
