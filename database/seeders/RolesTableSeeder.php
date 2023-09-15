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
        $admin = Role::create(['role_name' => 'admin', 'role_title' => 'Admin']);
        $power_user = Role::create(['role_name' => 'power_user', 'role_title' => 'Power User']);
        $rank_officer = Role::create(['role_name' => 'rank_officer', 'role_title' => 'Rank Officer']);
        $cesb_operator = Role::create(['role_name' => 'cesb_operator', 'role_title' => 'CESB Operator']);
        $training_officer = Role::create(['role_name' => 'training_officer', 'role_title' => 'Training Officer']);
        $cespes_operator = Role::create(['role_name' => 'cespes_operator', 'role_title' => 'CESPES Operator']);
        $agency_hr_operator = Role::create(['role_name' => 'agency_hr_operator', 'role_title' => 'Agency HR Operator']);
        $user = Role::create(['role_name' => 'user', 'role_title' => 'User']);

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
            'compentency_contacts_add', 'compentency_contacts_edit', 'compentency_contacts_delete', 'compentency_contacts_view',
            'compentency_non_ces_trainings_add', 'compentency_non_ces_trainings_edit', 'compentency_non_ces_trainings_delete', 'compentency_non_ces_trainings_view',
            'training_provider_manager_add', 'training_provider_manager_edit', 'training_provider_manager_delete', 'training_provider_manager_view',
            'training_venue_manager_add', 'training_venue_manager_edit', 'training_venue_manager_delete', 'training_venue_manager_view',
            'compentency_training_category_add', 'compentency_training_category_edit', 'compentency_training_category_delete', 'compentency_training_category_view',
            'compentency_training_secretariat_add', 'compentency_training_secretariat_edit', 'compentency_training_secretariat_delete', 'compentency_training_secretariat_view',
            'compentency_field_specialization_add', 'compentency_field_specialization_edit', 'compentency_field_specialization_delete', 'compentency_field_specialization_view',
            'compentency_resource_speaker_add', 'compentency_resource_speaker_edit', 'compentency_resource_speaker_delete', 'compentency_resource_speaker_view',
            'compentency_training_session_add', 'compentency_training_session_edit', 'compentency_training_session_delete', 'compentency_training_session_view',
            'compentency_ces_training_add', 'compentency_ces_training_edit', 'compentency_ces_training_delete', 'compentency_ces_training_view',
            'competency_management_sub_modules_report_add', 'competency_management_sub_modules_report_edit', 'competency_management_sub_modules_report_delete', 
            'competency_management_sub_modules_report_view',
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
            'compentency_contacts_view', 'compentency_non_ces_trainings_view', 'training_provider_manager_view',
            'training_venue_manager_view', 'compentency_training_category_view', 'compentency_training_secretariat_view',
            'compentency_field_specialization_view', 'compentency_resource_speaker_view', 'compentency_training_session_view',
            'compentency_ces_training_view', 'competency_management_sub_modules_report_view',
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
            'compentency_contacts_view', 'compentency_non_ces_trainings_view', 'training_provider_manager_view',
            'training_venue_manager_view', 'compentency_training_category_view', 'compentency_training_secretariat_view',
            'compentency_field_specialization_view', 'compentency_resource_speaker_view', 'compentency_training_session_view',
            'compentency_ces_training_view', 'competency_management_sub_modules_report_view',
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
            'compentency_contacts_add', 'compentency_contacts_edit', 'compentency_contacts_delete', 'compentency_contacts_view',
            'compentency_non_ces_trainings_add', 'compentency_non_ces_trainings_edit', 'compentency_non_ces_trainings_delete', 'compentency_non_ces_trainings_view',
            'training_provider_manager_add', 'training_provider_manager_edit', 'training_provider_manager_delete', 'training_provider_manager_view',
            'training_venue_manager_add', 'training_venue_manager_edit', 'training_venue_manager_delete', 'training_venue_manager_view',
            'compentency_training_category_add', 'compentency_training_category_edit', 'compentency_training_category_delete', 'compentency_training_category_view',
            'compentency_training_secretariat_add', 'compentency_training_secretariat_edit', 'compentency_training_secretariat_delete', 'compentency_training_secretariat_view',
            'compentency_field_specialization_add', 'compentency_field_specialization_edit', 'compentency_field_specialization_delete', 'compentency_field_specialization_view',
            'compentency_resource_speaker_add', 'compentency_resource_speaker_edit', 'compentency_resource_speaker_delete', 'compentency_resource_speaker_view',
            'compentency_training_session_add', 'compentency_training_session_edit', 'compentency_training_session_delete', 'compentency_training_session_view',
            'compentency_ces_training_add', 'compentency_ces_training_edit', 'compentency_ces_training_delete', 'compentency_ces_training_view',
            'competency_management_sub_modules_report_add', 'competency_management_sub_modules_report_edit', 'competency_management_sub_modules_report_delete', 
            'competency_management_sub_modules_report_view',
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

        $permissions_user = [
            'personal_data_edit', 'personal_data_delete', 'personal_data_view',
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
            'eligibility_rank_tracker_view', 'cespes_ratings_view', 'pdf_files_add', 'pdf_files_view',
        ];
        
        foreach ($permissions_user as $permission) {
            $user->assignPermission($permission);
        }
        
    }
}
