<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{

    public function updatePersonalEducationalPermissions(Request $request, $role_name, $role_title)
    {
        // Get the role and its current permissions
        $role = Role::where('role_name', $role_name)->first();
        $permissions = $role->permissions->pluck('permission_name')->toArray();
    
        // Define the permissions in this form
        $permissionsInThisForm = [
            'personal_data_add', 'personal_data_edit', 'personal_data_delete', 'personal_data_view',
            'family_profile_add', 'family_profile_edit', 'family_profile_delete', 'family_profile_view',
            'educational_attainment_add', 'educational_attainment_edit', 'educational_attainment_delete', 'educational_attainment_view',
            'examinations_taken_add', 'examinations_taken_edit', 'examinations_taken_delete', 'examinations_taken_view',
            'scholarships_taken_add', 'scholarships_taken_edit', 'scholarships_taken_delete', 'scholarships_taken_view',
            'research_and_studies_add', 'research_and_studies_edit', 'research_and_studies_delete', 'research_and_studies_view',
        ];

        // Get the submitted permissions
        $submittedPermissions = $request->input('permissions');
    
        // Remove permissions that are no longer needed
        $permissionsToRemove = array_diff($permissionsInThisForm, $submittedPermissions);
        foreach ($permissionsToRemove as $permissionName) {
            $permissionName = Permission::where('permission_name', $permissionName)->firstOrFail();
            $role->permissions()->detach($permissionName);
        }

        // Add newly selected permissions
        $permissionsToAdd = array_intersect($permissionsInThisForm, $submittedPermissions);
        foreach ($permissionsToAdd as $permissionName) {
            $permissionName = Permission::where('permission_name', $permissionName)->firstOrFail();
            $role->permissions()->syncWithoutDetaching($permissionName);
        }

        return redirect()->route('permissions.profiling', compact('role_name', 'role_title'))->with('info', 'Permissions Updated!');
    }

    public function updateExperienceTrainingsPermissions(Request $request, $role_name, $role_title)
    {
        // Get the role and its current permissions
        $role = Role::where('role_name', $role_name)->first();
        $permissions = $role->permissions->pluck('permission_name')->toArray();
    
        // Define the permissions in this form
        $permissionsInThisForm = [
            'work_experience_add', 'work_experience_edit', 'work_experience_delete', 'work_experience_view',
            'field_expertise_add', 'field_expertise_edit', 'field_expertise_delete', 'field_expertise_view',
            'ces_trainings_add', 'ces_trainings_edit', 'ces_trainings_delete', 'ces_trainings_view',
            'non_ces_trainings_add', 'non_ces_trainings_edit', 'non_ces_trainings_delete', 'non_ces_trainings_view',
        ];

        // Get the submitted permissions
        $submittedPermissions = $request->input('permissions');
    
        // Remove permissions that are no longer needed
        $permissionsToRemove = array_diff($permissionsInThisForm, $submittedPermissions);
        foreach ($permissionsToRemove as $permissionName) {
            $permissionName = Permission::where('permission_name', $permissionName)->firstOrFail();
            $role->permissions()->detach($permissionName);
        }

        // Add newly selected permissions
        $permissionsToAdd = array_intersect($permissionsInThisForm, $submittedPermissions);
        foreach ($permissionsToAdd as $permissionName) {
            $permissionName = Permission::where('permission_name', $permissionName)->firstOrFail();
            $role->permissions()->syncWithoutDetaching($permissionName);
        }

        return redirect()->route('permissions.profiling', compact('role_name', 'role_title'))->with('info', 'Permissions Updated!');
    }

    public function updatePersonalOthersPermissions(Request $request, $role_name, $role_title)
    {
        // Get the role and its current permissions
        $role = Role::where('role_name', $role_name)->first();
        $permissions = $role->permissions->pluck('permission_name')->toArray();
    
        // Define the permissions in this form
        $permissionsInThisForm = [
            'health_records_add', 'health_records_edit', 'health_records_delete', 'health_records_view',
            'awards_and_citations_add', 'awards_and_citations_edit', 'awards_and_citations_delete', 'awards_and_citations_view',
            'affiliations_add', 'affiliations_edit', 'affiliations_delete', 'affiliations_view',
            'case_records_add', 'case_records_edit', 'case_records_delete', 'case_records_view',
            'language_dialects_add', 'language_dialects_edit', 'language_dialects_delete', 'language_dialects_view',
            'eligibility_rank_tracker_add', 'eligibility_rank_tracker_edit', 'eligibility_rank_tracker_delete', 'eligibility_rank_tracker_view',
            'cespes_ratings_add', 'cespes_ratings_edit', 'cespes_ratings_delete', 'cespes_ratings_view',
            'pdf_files_add', 'pdf_files_edit', 'pdf_files_delete', 'pdf_files_view',
        ];

        // Get the submitted permissions
        $submittedPermissions = $request->input('permissions');
    
        // Remove permissions that are no longer needed
        $permissionsToRemove = array_diff($permissionsInThisForm, $submittedPermissions);
        foreach ($permissionsToRemove as $permissionName) {
            $permissionName = Permission::where('permission_name', $permissionName)->firstOrFail();
            $role->permissions()->detach($permissionName);
        }

        // Add newly selected permissions
        $permissionsToAdd = array_intersect($permissionsInThisForm, $submittedPermissions);
        foreach ($permissionsToAdd as $permissionName) {
            $permissionName = Permission::where('permission_name', $permissionName)->firstOrFail();
            $role->permissions()->syncWithoutDetaching($permissionName);
        }

        return redirect()->route('permissions.profiling', compact('role_name', 'role_title'))->with('info', 'Permissions Updated!');
    }

    public function updateCompetencyPermissions(Request $request, $role_name, $role_title)
    {
        // Get the role and its current permissions
        $role = Role::where('role_name', $role_name)->first();
        $permissions = $role->permissions->pluck('permission_name')->toArray();
    
        // Define the permissions in this form
        $permissionsInThisForm = [
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

        // Get the submitted permissions
        $submittedPermissions = $request->input('permissions');
    
        // Remove permissions that are no longer needed
        $permissionsToRemove = array_diff($permissionsInThisForm, $submittedPermissions);
        foreach ($permissionsToRemove as $permissionName) {
            $permissionName = Permission::where('permission_name', $permissionName)->firstOrFail();
            $role->permissions()->detach($permissionName);
        }

        // Add newly selected permissions
        $permissionsToAdd = array_intersect($permissionsInThisForm, $submittedPermissions);
        foreach ($permissionsToAdd as $permissionName) {
            $permissionName = Permission::where('permission_name', $permissionName)->firstOrFail();
            $role->permissions()->syncWithoutDetaching($permissionName);
        }

        return redirect()->route('permissions.competency', compact('role_name', 'role_title'))->with('info', 'Permissions Updated!');
    }

    public function updatePlantillaPermissions(Request $request, $role_name, $role_title)
    {
        // Get the role and its current permissions
        $role = Role::where('role_name', $role_name)->first();
        $permissions = $role->permissions->pluck('permission_name')->toArray();
    
        // Define the permissions in this form
        $permissionsInThisForm = [
            'plantilla_management_add',
            'plantilla_management_edit',
            'plantilla_management_delete',
            'plantilla_management_view',
            'plantilla_sector_manager_add',
            'plantilla_sector_manager_edit',
            'plantilla_sector_manager_delete',
            'plantilla_sector_manager_view',
            'plantilla_department_manager_add',
            'plantilla_department_manager_edit',
            'plantilla_department_manager_delete',
            'plantilla_department_manager_view',
            'plantilla_agency_location_manager_add',
            'plantilla_agency_location_manager_edit',
            'plantilla_agency_location_manager_delete',
            'plantilla_agency_location_manager_view',
            'plantilla_office_manager_edit',
            'plantilla_office_manager_add',
            'plantilla_office_manager_delete',
            'plantilla_office_manager_view',
            'plantilla_position_manager_add',
            'plantilla_position_manager_edit',
            'plantilla_position_manager_delete',
            'plantilla_position_manager_view',
            'plantilla_position_classification_manager_add',
            'plantilla_position_classification_manager_edit',
            'plantilla_position_classification_manager_delete',
            'plantilla_position_classification_manager_view',
            'plantilla_appointee_occupant_manager_add',
            'plantilla_appointee_occupant_manager_edit',
            'plantilla_appointee_occupant_manager_delete',
            'plantilla_appointee_occupant_manager_view',
            'plantilla_appointee_occupant_browser_add',
            'plantilla_appointee_occupant_browser_edit',
            'plantilla_appointee_occupant_browser_delete',
            'plantilla_appointee_occupant_browser_view',
        ];

        // Get the submitted permissions
        $submittedPermissions = $request->input('permissions');
    
        // Remove permissions that are no longer needed
        $permissionsToRemove = array_diff($permissionsInThisForm, $submittedPermissions);
        foreach ($permissionsToRemove as $permissionName) {
            $permissionName = Permission::where('permission_name', $permissionName)->firstOrFail();
            $role->permissions()->detach($permissionName);
        }

        // Add newly selected permissions
        $permissionsToAdd = array_intersect($permissionsInThisForm, $submittedPermissions);
        foreach ($permissionsToAdd as $permissionName) {
            $permissionName = Permission::where('permission_name', $permissionName)->firstOrFail();
            $role->permissions()->syncWithoutDetaching($permissionName);
        }

        return redirect()->route('permissions.plantilla', compact('role_name', 'role_title'))->with('info', 'Permissions Updated!');
    }

    public function updateReportsPermissions(Request $request, $role_name, $role_title)
    {
        // Get the role and its current permissions
        $role = Role::where('role_name', $role_name)->first();
        $permissions = $role->permissions->pluck('permission_name')->toArray();
    
        // Define the permissions in this form
        $permissionsInThisForm = [
            '201_general_reports',
            '201_statistical_reports',
            '201_placement_reports',
            '201_birthday_cards_reports',
            '201_data_portability_reports',
            'competency_general_reports',
            'competency_training_venue_manager_reports',
            'competency_training_provider_reports',
            'competency_resource_speaker_manager_reports',
            'eligibility_general_reports',
            'eligibility_ceswe_reports',
            'eligibility_assessment_center_reports',
            'eligibility_validation_reports',
            'eligibility_board_interview_reports',
            'plantilla_statistics_reports',
            'plantilla_occupancy_reports',
            'plantilla_position_list_reports',
            'plantilla_ces_bluebook_reports',
            'plantilla_department_agency_title_reports',
            'plantilla_list_of_appointed_reports',
            'plantilla_vacant_ces_positions_reports',
            'plantilla_nonces_occupying_ces_pos_reports',
            'plantilla_mailing_list_reports',
            'plantilla_list_of_officials_reports',
        ];

        // Get the submitted permissions
        $submittedPermissions = $request->input('permissions');
    
        // Remove permissions that are no longer needed
        $permissionsToRemove = array_diff($permissionsInThisForm, $submittedPermissions);
        foreach ($permissionsToRemove as $permissionName) {
            $permissionName = Permission::where('permission_name', $permissionName)->firstOrFail();
            $role->permissions()->detach($permissionName);
        }

        // Add newly selected permissions
        $permissionsToAdd = array_intersect($permissionsInThisForm, $submittedPermissions);
        foreach ($permissionsToAdd as $permissionName) {
            $permissionName = Permission::where('permission_name', $permissionName)->firstOrFail();
            $role->permissions()->syncWithoutDetaching($permissionName);
        }

        return redirect()->route('permissions.reports', compact('role_name', 'role_title'))->with('info', 'Permissions Updated!');
    }

    public function updateLibrariesPermissions(Request $request, $role_name, $role_title)
    {
        // Get the role and its current permissions
        $role = Role::where('role_name', $role_name)->first();
        $permissions = $role->permissions->pluck('permission_name')->toArray();
    
        // Define the permissions in this form
        $permissionsInThisForm = [
            '201_view_library',
            '201_add_library',
            '201_edit_library',
            '201_delete_library',
            'eris_view_library',
            'eris_add_library',
            'eris_edit_library',
            'eris_delete_library',
            'plantilla_view_library',
            'plantilla_add_library',
            'plantilla_edit_library',
            'plantilla_delete_library',
        ];

        // Get the submitted permissions
        $submittedPermissions = $request->input('permissions');
    
        // Remove permissions that are no longer needed
        $permissionsToRemove = array_diff($permissionsInThisForm, $submittedPermissions);
        foreach ($permissionsToRemove as $permissionName) {
            $permissionName = Permission::where('permission_name', $permissionName)->firstOrFail();
            $role->permissions()->detach($permissionName);
        }

        // Add newly selected permissions
        $permissionsToAdd = array_intersect($permissionsInThisForm, $submittedPermissions);
        foreach ($permissionsToAdd as $permissionName) {
            $permissionName = Permission::where('permission_name', $permissionName)->firstOrFail();
            $role->permissions()->syncWithoutDetaching($permissionName);
        }

        return redirect()->route('permissions.libraries', compact('role_name', 'role_title'))->with('info', 'Permissions Updated!');
    }

}
