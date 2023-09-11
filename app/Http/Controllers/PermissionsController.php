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

}
