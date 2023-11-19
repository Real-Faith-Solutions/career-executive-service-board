@extends('layouts.app')
@section('title', 'User Roles')
@section('sub', 'User Roles')
@section('content')

<nav class="bg-gray-200 border-gray-200 dark:bg-gray-800 mb-5">
    <div class="flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="#" class="flex items-center">
            <span class="self-center text-2xl font-semibold whitespace-nowrap uppercase text-blue-500 sm:whitespace-normal">{{ $role_title }} - Reports Permissions</span>
        </a>

        <div class="flex justify-end">
            <a href="{{ route('permissions.show', ['role_name' => $role_name, 'role_title' => $role_title]) }}" class="btn btn-primary">Back</a>
        </div>
    </div>
</nav>

<div id="plantilla_permissions" class="">
    
    <form method="POST" id="plantilla_permissions_form" action="{{ route('plantillaPermissions.update', ['role_name' => $role_name, 'role_title' => $role_title]) }}">
        @csrf
    
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3">
    
            {{-- 201 Profiling permissions --}}
            <div class="col-span-1">
                <div class="relative my-2 overflow-x-auto shadow-lg sm:rounded-lg">
                    <div class="w-full text-gray-500">
    
                        <div class="bg-blue-500 uppercase text-gray-700 text-white flex justify-between">
                            <h1 class="px-6 py-3">
                                201 Profiling Reports
                            </h1>
                        </div>
            
                        <div class="border-b bg-white px-6 py-3">
            
                            <div class="flex items-center mb-4">
                                <input id="201_general_reports" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', '201_general_reports') ? 'checked' : '' }} value="201_general_reports" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="201_general_reports" class="ml-2 mt-2 text-sm font-medium text-gray-900">General Reports</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="201_statistical_reports" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', '201_statistical_reports') ? 'checked' : '' }} value="201_statistical_reports" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="201_statistical_reports" class="ml-2 mt-2 text-sm font-medium text-gray-900">Statistical Reports</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="201_placement_reports" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', '201_placement_reports') ? 'checked' : '' }} value="201_placement_reports" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="201_placement_reports" class="ml-2 mt-2 text-sm font-medium text-gray-900">Placement Reports</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="201_birthday_cards_reports" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', '201_birthday_cards_reports') ? 'checked' : '' }} value="201_birthday_cards_reports" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="201_birthday_cards_reports" class="ml-2 mt-2 text-sm font-medium text-gray-900">Birthday Cards</label>
                            </div>

                            <div class="flex items-center mb-4">
                                <input id="201_data_portability_reports" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', '201_data_portability_reports') ? 'checked' : '' }} value="201_data_portability_reports" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="201_data_portability_reports" class="ml-2 mt-2 text-sm font-medium text-gray-900">Data Portability Reports</label>
                            </div>
    
                        </div>
                    </div>
                </div>
            </div>
    
            {{-- Competency Reports permissions --}}
            <div class="col-span-1">
                <div class="relative my-2 overflow-x-auto shadow-lg sm:rounded-lg">
                    <div class="w-full text-gray-500">
                        
                        <div class="bg-blue-500 uppercase text-gray-700 text-white flex justify-between">
                            <h1 class="px-6 py-3">
                                Competency Reports
                            </h1>
                        </div>
            
                        <div class="border-b bg-white px-6 py-3">
            
                            <div class="flex items-center mb-4">
                                <input id="competency_general_reports" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'competency_general_reports') ? 'checked' : '' }} value="competency_general_reports" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="competency_general_reports" class="ml-2 mt-2 text-sm font-medium text-gray-900">General Reports</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="competency_training_venue_manager_reports" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'competency_training_venue_manager_reports') ? 'checked' : '' }} value="competency_training_venue_manager_reports" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="competency_training_venue_manager_reports" class="ml-2 mt-2 text-sm font-medium text-gray-900">Training Venue Manager</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="competency_training_provider_reports" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'competency_training_provider_reports') ? 'checked' : '' }} value="competency_training_provider_reports" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="competency_training_provider_reports" class="ml-2 mt-2 text-sm font-medium text-gray-900">Training Provider</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="competency_resource_speaker_manager_reports" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'competency_resource_speaker_manager_reports') ? 'checked' : '' }} value="competency_resource_speaker_manager_reports" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="competency_resource_speaker_manager_reports" class="ml-2 mt-2 text-sm font-medium text-gray-900">Resource Speaker Manager</label>
                            </div>
    
                        </div>
                    </div>
                </div>
            </div>
    
            {{-- Eligibility And Rank Tracking permissions --}}
            <div class="col-span-1">
                <div class="relative my-2 overflow-x-auto shadow-lg sm:rounded-lg">
                    <div class="w-full text-gray-500">
    
                        <div class="bg-blue-500 uppercase text-gray-700 text-white flex justify-between">
                            <h1 class="px-6 py-3 text-xm sm:text-sm sm:py-3.5">
                                Eligibility And Rank Tracking
                            </h1>
                        </div>
            
                        <div class="border-b bg-white px-6 py-3">
            
                            <div class="flex items-center mb-4">
                                <input id="eligibility_general_reports" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'eligibility_general_reports') ? 'checked' : '' }} value="eligibility_general_reports" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="eligibility_general_reports" class="ml-2 mt-2 text-sm font-medium text-gray-900">General Reports</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="eligibility_ceswe_reports" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'eligibility_ceswe_reports') ? 'checked' : '' }} value="eligibility_ceswe_reports" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="eligibility_ceswe_reports" class="ml-2 mt-2 text-sm font-medium text-gray-900">CES WE Reports</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="eligibility_assessment_center_reports" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'eligibility_assessment_center_reports') ? 'checked' : '' }} value="eligibility_assessment_center_reports" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="eligibility_assessment_center_reports" class="ml-2 mt-2 text-sm font-medium text-gray-900">Assessment Center Reports</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="eligibility_validation_reports" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'eligibility_validation_reports') ? 'checked' : '' }} value="eligibility_validation_reports" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="eligibility_validation_reports" class="ml-2 mt-2 text-sm font-medium text-gray-900">Validation Reports</label>
                            </div>

                            <div class="flex items-center mb-4">
                                <input id="eligibility_board_interview_reports" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'eligibility_board_interview_reports') ? 'checked' : '' }} value="eligibility_board_interview_reports" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="eligibility_board_interview_reports" class="ml-2 mt-2 text-sm font-medium text-gray-900">Board/Panel Interview Reports</label>
                            </div>
    
                        </div>
                    </div>
                </div>
            </div>
    
            {{-- Plantilla Management Reports permissions --}}
            <div class="col-span-1">
                <div class="relative my-2 overflow-x-auto shadow-lg sm:rounded-lg">
                    <div class="w-full text-gray-500">

                        <div class="bg-blue-500 uppercase text-gray-700 text-white flex justify-between">
                            <h1 class="px-6 py-3 text-xm sm:text-sm sm:py-3.5">
                                Plantilla Management Reports
                            </h1>
                        </div>
    
                        <div class="border-b bg-white px-6 py-3">
            
                            <div class="flex items-center mb-4">
                                <input id="plantilla_statistics_reports" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'plantilla_statistics_reports') ? 'checked' : '' }} value="plantilla_statistics_reports" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="plantilla_statistics_reports" class="ml-2 mt-2 text-sm font-medium text-gray-900">Statistics Reports</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="plantilla_occupancy_reports" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'plantilla_occupancy_reports') ? 'checked' : '' }} value="plantilla_occupancy_reports" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="plantilla_occupancy_reports" class="ml-2 mt-2 text-sm font-medium text-gray-900">Occupancy Reports</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="plantilla_position_list_reports" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'plantilla_position_list_reports') ? 'checked' : '' }} value="plantilla_position_list_reports" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="plantilla_position_list_reports" class="ml-2 mt-2 text-sm font-medium text-gray-900">Position List</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="plantilla_ces_bluebook_reports" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'plantilla_ces_bluebook_reports') ? 'checked' : '' }} value="plantilla_ces_bluebook_reports" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="plantilla_ces_bluebook_reports" class="ml-2 mt-2 text-sm font-medium text-gray-900">CES Bluebook</label>
                            </div>

                            <div class="flex items-center mb-4">
                                <input id="plantilla_department_agency_title_reports" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'plantilla_department_agency_title_reports') ? 'checked' : '' }} value="plantilla_department_agency_title_reports" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="plantilla_department_agency_title_reports" class="ml-2 mt-2 text-sm font-medium text-gray-900">Department/Agency Title</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="plantilla_list_of_appointed_reports" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'plantilla_list_of_appointed_reports') ? 'checked' : '' }} value="plantilla_list_of_appointed_reports" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="plantilla_list_of_appointed_reports" class="ml-2 mt-2 text-sm font-medium text-gray-900">Appointed on CES/Non-CES Positions</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="plantilla_vacant_ces_positions_reports" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'plantilla_vacant_ces_positions_reports') ? 'checked' : '' }} value="plantilla_vacant_ces_positions_reports" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="plantilla_vacant_ces_positions_reports" class="ml-2 mt-2 text-sm font-medium text-gray-900">Vacant CES Positions</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="plantilla_nonces_occupying_ces_pos_reports" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'plantilla_nonces_occupying_ces_pos_reports') ? 'checked' : '' }} value="plantilla_nonces_occupying_ces_pos_reports" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="plantilla_nonces_occupying_ces_pos_reports" class="ml-2 mt-2 text-sm font-medium text-gray-900">Non-CES Eligibles on CES Positions</label>
                            </div>

                            <div class="flex items-center mb-4">
                                <input id="plantilla_mailing_list_reports" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'plantilla_mailing_list_reports') ? 'checked' : '' }} value="plantilla_mailing_list_reports" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="plantilla_mailing_list_reports" class="ml-2 mt-2 text-sm font-medium text-gray-900">Mailing List</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="plantilla_list_of_officials_reports" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'plantilla_list_of_officials_reports') ? 'checked' : '' }} value="plantilla_list_of_officials_reports" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="plantilla_list_of_officials_reports" class="ml-2 mt-2 text-sm font-medium text-gray-900">List of Officials</label>
                            </div>
    
                        </div>
                    </div>
                </div>
            </div>
    
        </div>
    
        <div class="flex justify-center mt-3">
            <button type="button" class="btn btn-primary" id="plantilla_permissions_btn" onclick="openConfirmationDialog(this, 'Confirm Permissions', 'Are you sure you want to submit/update this permissions?')">Save Permissions</button>
        </div>
    
    </form>
</div>

@endsection
