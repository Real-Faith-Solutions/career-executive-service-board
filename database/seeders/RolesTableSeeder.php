<?php

namespace Database\Seeders;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run(): void
    {
        // roles
        $admin = Role::create(['role_name' => 'admin']);
        $power_user = Role::create(['role_name' => 'power_user']);
        $rank_officer = Role::create(['role_name' => 'rank_officer']);
        $cesb_operator = Role::create(['role_name' => 'cesb_operator']);
        $training_officer = Role::create(['role_name' => 'training_officer']);
        $cespes_operator = Role::create(['role_name' => 'cespes_operator']);
        $agency_hr_operator = Role::create(['role_name' => 'agency_hr_operator']);
        $user = Role::create(['role_name' => 'user']);

        // permissions
        $permissions_admin = [
            'personal_data_add', 'personal_data_edit', 'personal_data_delete', 'personal_data_view',
            'family_profile_add', 'family_profile_edit', 'family_profile_delete', 'family_profile_view',
            'educational_attainment_add', 'educational_attainment_edit', 'educational_attainment_delete', 'educational_attainment_view',
            'examinations_taken_add', 'examinations_taken_edit', 'examinations_taken_delete', 'examinations_taken_view',
            'scholarships_taken_add', 'scholarships_taken_edit', 'scholarships_taken_delete', 'scholarships_taken_view',
            'research_and_studies_add', 'research_and_studies_edit', 'research_and_studies_delete', 'research_and_studies_view',
            'work_experience_add', 'work_experience_edit', 'work_experience_delete', 'work_experience_view',
            'field_expertise_add', 'field_expertise_edit', 'field_expertise_delete', 'field_expertise_view',
            'ces_trainings_add', 'ces_trainings_edit', 'ces_trainings_delete', 'ces_trainings_view',
            'non_ces_trainings_add', 'non_ces_trainings_edit', 'non_ces_trainings_delete', 'non_ces_trainings_view',
            'health_records_add', 'health_records_edit', 'health_records_delete', 'health_records_view',
            'awards_and_citations_add', 'awards_and_citations_edit', 'awards_and_citations_delete', 'awards_and_citations_view',
            'affiliations_add', 'affiliations_edit', 'affiliations_delete', 'affiliations_view',
            'case_records_add', 'case_records_edit', 'case_records_delete', 'case_records_view',
            'language_dialects_add', 'language_dialects_edit', 'language_dialects_delete', 'language_dialects_view',
            'eligibility_rank_tracker_add', 'eligibility_rank_tracker_edit', 'eligibility_rank_tracker_delete', 'eligibility_rank_tracker_view',
            'cespes_ratings_add', 'cespes_ratings_edit', 'cespes_ratings_delete', 'cespes_ratings_view',
            'pdf_files_add', 'pdf_files_edit', 'pdf_files_delete', 'pdf_files_view',
        ];

        foreach ($permissions_admin as $permission) {
            $admin->assignPermission($permission);
        }

        $permissions_power_user = [
            'personal_data_add', 'personal_data_edit', 'personal_data_delete', 'personal_data_view',
            'family_profile_add', 'family_profile_edit', 'family_profile_delete', 'family_profile_view',
            'educational_attainment_add', 'educational_attainment_edit', 'educational_attainment_delete', 'educational_attainment_view',
            'examinations_taken_add', 'examinations_taken_edit', 'examinations_taken_delete', 'examinations_taken_view',
            'scholarships_taken_add', 'scholarships_taken_edit', 'scholarships_taken_delete', 'scholarships_taken_view',
            'research_and_studies_add', 'research_and_studies_edit', 'research_and_studies_delete', 'research_and_studies_view',
            'work_experience_add', 'work_experience_edit', 'work_experience_delete', 'work_experience_view',
            'field_expertise_add', 'field_expertise_edit', 'field_expertise_delete', 'field_expertise_view', 'ces_trainings_view',
            'non_ces_trainings_add', 'non_ces_trainings_edit', 'non_ces_trainings_delete', 'non_ces_trainings_view',
            'health_records_add', 'health_records_edit', 'health_records_delete', 'health_records_view',
            'awards_and_citations_add', 'awards_and_citations_edit', 'awards_and_citations_delete', 'awards_and_citations_view',
            'affiliations_add', 'affiliations_edit', 'affiliations_delete', 'affiliations_view',
            'case_records_add', 'case_records_edit', 'case_records_delete', 'case_records_view',
            'language_dialects_add', 'language_dialects_edit', 'language_dialects_delete', 'language_dialects_view',
            'eligibility_rank_tracker_view', 'cespes_ratings_view', 'pdf_files_add', 'pdf_files_edit', 'pdf_files_delete', 'pdf_files_view',
        ];

        foreach ($permissions_power_user as $permission) {
            $power_user->assignPermission($permission);
        }

        $permissions_rank_officer = [
            'personal_data_view', 'family_profile_view', 'educational_attainment_view', 'examinations_taken_view',
            'scholarships_taken_view', 'research_and_studies_view', 'work_experience_view', 'field_expertise_view',
            'ces_trainings_view', 'non_ces_trainings_view', 'health_records_view', 'awards_and_citations_view',
            'affiliations_view', 'case_records_view', 'language_dialects_view', 'eligibility_rank_tracker_add', 
            'eligibility_rank_tracker_edit', 'eligibility_rank_tracker_delete', 'eligibility_rank_tracker_view',
            'cespes_ratings_view', 'pdf_files_view',
        ];
        
        foreach ($permissions_rank_officer as $permission) {
            $rank_officer->assignPermission($permission);
        }

        $permissions_cesb_operator = [
            'personal_data_view', 'family_profile_view', 'educational_attainment_view', 'examinations_taken_view',
            'scholarships_taken_view', 'research_and_studies_view', 'work_experience_view', 'field_expertise_view',
            'ces_trainings_view', 'non_ces_trainings_view', 'health_records_view', 'awards_and_citations_view',
            'affiliations_view', 'case_records_view', 'language_dialects_view', 'eligibility_rank_tracker_view',
            'cespes_ratings_view', 'pdf_files_view',
        ];

        foreach ($permissions_cesb_operator as $permission) {
            $cesb_operator->assignPermission($permission);
        }
        
        $permissions_training_officer = [
            'personal_data_view', 'family_profile_view', 'educational_attainment_view', 'examinations_taken_view',
            'scholarships_taken_view', 'research_and_studies_view', 'work_experience_view', 'field_expertise_view',
            'ces_trainings_add', 'ces_trainings_edit', 'ces_trainings_delete', 'ces_trainings_view',
            'health_records_view', 'awards_and_citations_view', 'affiliations_view', 'case_records_view',
            'language_dialects_view', 'eligibility_rank_tracker_view', 'cespes_ratings_view', 'pdf_files_view',
        ];
        
        foreach ($permissions_training_officer as $permission) {
            $training_officer->assignPermission($permission);
        }

        $permissions_cespes_operator = [
            'personal_data_view', 'family_profile_view', 'educational_attainment_view', 'examinations_taken_view',
            'scholarships_taken_view', 'research_and_studies_view', 'work_experience_view', 'field_expertise_view',
            'ces_trainings_view', 'non_ces_trainings_view', 'health_records_view', 'awards_and_citations_view',
            'affiliations_view', 'case_records_view', 'language_dialects_view', 'eligibility_rank_tracker_view',
            'cespes_ratings_add', 'cespes_ratings_edit', 'cespes_ratings_delete', 'cespes_ratings_view', 'pdf_files_view',
        ];
        
        foreach ($permissions_cespes_operator as $permission) {
            $cespes_operator->assignPermission($permission);
        }

        $permissions_agency_hr_operator = [
            'personal_data_edit', 'personal_data_view',
            'family_profile_add', 'family_profile_edit', 'family_profile_view',
            'educational_attainment_add', 'educational_attainment_edit', 'educational_attainment_view',
            'examinations_taken_add', 'examinations_taken_edit', 'examinations_taken_view',
            'scholarships_taken_add', 'scholarships_taken_edit', 'scholarships_taken_view',
            'research_and_studies_add', 'research_and_studies_edit', 'research_and_studies_view',
            'work_experience_add', 'work_experience_edit', 'work_experience_view',
            'field_expertise_add', 'field_expertise_edit', 'field_expertise_view',
            'ces_trainings_view', 'non_ces_trainings_add', 'non_ces_trainings_edit', 'non_ces_trainings_view',
            'health_records_add', 'health_records_edit', 'health_records_view',
            'awards_and_citations_add', 'awards_and_citations_edit', 'awards_and_citations_view',
            'affiliations_add', 'affiliations_edit', 'affiliations_view',
            'case_records_add', 'case_records_edit', 'case_records_view',
            'language_dialects_add', 'language_dialects_edit', 'language_dialects_view',
            'eligibility_rank_tracker_view', 'cespes_ratings_view', 'pdf_files_add', 'pdf_files_view',
        ];
        
        foreach ($permissions_agency_hr_operator as $permission) {
            $agency_hr_operator->assignPermission($permission);
        }

        
        
    }
}
