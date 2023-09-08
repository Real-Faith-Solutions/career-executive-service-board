<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    // public function updatePersonalEducationalPermissions(Request $request, $role_name, $role_title)
    // {
    //     $role = Role::where('role_name', $role_name)->first();
    //     $permissions = $role->permissions;

    //     $permissionsInThisForm = [
    //         'personal_data_add', 'personal_data_edit', 'personal_data_delete', 'personal_data_view',
    //         'family_profile_add', 'family_profile_edit', 'family_profile_delete', 'family_profile_view',
    //         'educational_attainment_add', 'educational_attainment_edit', 'educational_attainment_delete', 'educational_attainment_view',
    //         'examinations_taken_add', 'examinations_taken_edit', 'examinations_taken_delete', 'examinations_taken_view',
    //         'scholarships_taken_add', 'scholarships_taken_edit', 'scholarships_taken_delete', 'scholarships_taken_view',
    //         'research_and_studies_add', 'research_and_studies_edit', 'research_and_studies_delete', 'research_and_studies_view',
    //     ];

    //     $submittedPermissions = $request->input('permissions');

    //     return redirect()->route('permissions.profiling', compact('role_name', 'role_title'))->with('info', 'Permissions Updated!');
    // }

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
    
        // Delete common permissions between $permissionsArray and $permissionsInThisForm
        $permissions = array_diff($permissions, $permissionsInThisForm);

        // Add common permissions between $permissionsInThisForm and $submittedPermissions
        $permissions = $permissions->merge(array_intersect($permissionsInThisForm, $submittedPermissions));

        // Update the role's permissions
        $role->permissions = $permissions;

        $role->save();

    
        return redirect()->route('permissions.profiling', compact('role_name', 'role_title'))->with('info', 'Permissions Updated!');
    }

}
