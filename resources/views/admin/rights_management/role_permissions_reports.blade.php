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
    
            {{-- Agency Location Manager permissions --}}
            <div class="col-span-1">
                <div class="relative my-2 overflow-x-auto shadow-lg sm:rounded-lg">
                    <div class="w-full text-gray-500">

                        <div class="bg-blue-500 uppercase text-gray-700 text-white flex justify-between">
                            <h1 class="px-6 py-3 text-xm sm:text-sm sm:py-3.5">
                                Agency Location Manager
                            </h1>
                        </div>
    
                        <div class="border-b bg-white px-6 py-3">
            
                            <div class="flex items-center mb-4">
                                <input id="plantilla_agency_location_manager_add" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'plantilla_agency_location_manager_add') ? 'checked' : '' }} value="plantilla_agency_location_manager_add" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="plantilla_agency_location_manager_add" class="ml-2 mt-2 text-sm font-medium text-gray-900">Add</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="plantilla_agency_location_manager_edit" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'plantilla_agency_location_manager_edit') ? 'checked' : '' }} value="plantilla_agency_location_manager_edit" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="plantilla_agency_location_manager_edit" class="ml-2 mt-2 text-sm font-medium text-gray-900">Edit</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="plantilla_agency_location_manager_delete" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'plantilla_agency_location_manager_delete') ? 'checked' : '' }} value="plantilla_agency_location_manager_delete" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="plantilla_agency_location_manager_delete" class="ml-2 mt-2 text-sm font-medium text-gray-900">Delete</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="plantilla_agency_location_manager_view" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'plantilla_agency_location_manager_view') ? 'checked' : '' }} value="plantilla_agency_location_manager_view" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="plantilla_agency_location_manager_view" class="ml-2 mt-2 text-sm font-medium text-gray-900">View</label>
                            </div>
    
                        </div>
                    </div>
                </div>
            </div>
    
            {{-- Office Manager permissions --}}
            <div class="col-span-1">
                <div class="relative my-2 overflow-x-auto shadow-lg sm:rounded-lg">
                    <div class="w-full text-gray-500">
    
                        <div class="bg-blue-500 uppercase text-gray-700 text-white flex justify-between">
                            <h1 class="px-6 py-3">
                                Office Manager
                            </h1>
                        </div>
            
                        <div class="border-b bg-white px-6 py-3">
            
                            <div class="flex items-center mb-4">
                                <input id="plantilla_office_manager_add" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'plantilla_office_manager_add') ? 'checked' : '' }} value="plantilla_office_manager_add" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="plantilla_office_manager_add" class="ml-2 mt-2 text-sm font-medium text-gray-900">Add</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="plantilla_office_manager_edit" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'plantilla_office_manager_edit') ? 'checked' : '' }} value="plantilla_office_manager_edit" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="plantilla_office_manager_edit" class="ml-2 mt-2 text-sm font-medium text-gray-900">Edit</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="plantilla_office_manager_delete" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'plantilla_office_manager_delete') ? 'checked' : '' }} value="plantilla_office_manager_delete" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="plantilla_office_manager_delete" class="ml-2 mt-2 text-sm font-medium text-gray-900">Delete</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="plantilla_office_manager_view" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'plantilla_office_manager_view') ? 'checked' : '' }} value="plantilla_office_manager_view" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="plantilla_office_manager_view" class="ml-2 mt-2 text-sm font-medium text-gray-900">View</label>
                            </div>
    
                        </div>
                    </div>
                </div>
            </div>

            {{-- Position Manager permissions --}}
            <div class="col-span-1">
                <div class="relative my-2 overflow-x-auto shadow-lg sm:rounded-lg">
                    <div class="w-full text-gray-500">
    
                        <div class="bg-blue-500 uppercase text-gray-700 text-white flex justify-between">
                            <h1 class="px-6 py-3">
                                Position Manager
                            </h1>
                        </div>
            
                        <div class="border-b bg-white px-6 py-3">
            
                            <div class="flex items-center mb-4">
                                <input id="plantilla_position_manager_add" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'plantilla_position_manager_add') ? 'checked' : '' }} value="plantilla_position_manager_add" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="plantilla_position_manager_add" class="ml-2 mt-2 text-sm font-medium text-gray-900">Add</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="plantilla_position_manager_edit" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'plantilla_position_manager_edit') ? 'checked' : '' }} value="plantilla_position_manager_edit" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="plantilla_position_manager_edit" class="ml-2 mt-2 text-sm font-medium text-gray-900">Edit</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="plantilla_position_manager_delete" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'plantilla_position_manager_delete') ? 'checked' : '' }} value="plantilla_position_manager_delete" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="plantilla_position_manager_delete" class="ml-2 mt-2 text-sm font-medium text-gray-900">Delete</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="plantilla_position_manager_view" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'plantilla_position_manager_view') ? 'checked' : '' }} value="plantilla_position_manager_view" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="plantilla_position_manager_view" class="ml-2 mt-2 text-sm font-medium text-gray-900">View</label>
                            </div>
    
                        </div>
                    </div>
                </div>
            </div>
    
            {{-- Position Classification Manager permissions --}}
            <div class="col-span-1">
                <div class="relative my-2 overflow-x-auto shadow-lg sm:rounded-lg">
                    <div class="w-full text-gray-500">
    
                        <div class="bg-blue-500 uppercase text-gray-700 text-white flex justify-between">
                            <h1 class="px-6 py-3 text-xm sm:text-sm sm:py-3.5">
                                Position Classification Manager
                            </h1>
                        </div>
            
                        <div class="border-b bg-white px-6 py-3">
            
                            <div class="flex items-center mb-4">
                                <input id="plantilla_position_classification_manager_add" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'plantilla_position_classification_manager_add') ? 'checked' : '' }} value="plantilla_position_classification_manager_add" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="plantilla_position_classification_manager_add" class="ml-2 mt-2 text-sm font-medium text-gray-900">Add</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="plantilla_position_classification_manager_edit" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'plantilla_position_classification_manager_edit') ? 'checked' : '' }} value="plantilla_position_classification_manager_edit" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="plantilla_position_classification_manager_edit" class="ml-2 mt-2 text-sm font-medium text-gray-900">Edit</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="plantilla_position_classification_manager_delete" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'plantilla_position_classification_manager_delete') ? 'checked' : '' }} value="plantilla_position_classification_manager_delete" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="plantilla_position_classification_manager_delete" class="ml-2 mt-2 text-sm font-medium text-gray-900">Delete</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="plantilla_position_classification_manager_view" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'plantilla_position_classification_manager_view') ? 'checked' : '' }} value="plantilla_position_classification_manager_view" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="plantilla_position_classification_manager_view" class="ml-2 mt-2 text-sm font-medium text-gray-900">View</label>
                            </div>
    
                        </div>
                    </div>
                </div>
            </div>

            {{-- Appointee Occupant Manager permissions --}}
            <div class="col-span-1">
                <div class="relative my-2 overflow-x-auto shadow-lg sm:rounded-lg">
                    <div class="w-full text-gray-500">
    
                        <div class="bg-blue-500 uppercase text-gray-700 text-white flex justify-between">
                            <h1 class="px-6 py-3 text-xm sm:text-sm sm:py-3.5">
                                Appointee Occupant Manager
                            </h1>
                        </div>
            
                        <div class="border-b bg-white px-6 py-3">
            
                            <div class="flex items-center mb-4">
                                <input id="plantilla_appointee_occupant_manager_add" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'plantilla_appointee_occupant_manager_add') ? 'checked' : '' }} value="plantilla_appointee_occupant_manager_add" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="plantilla_appointee_occupant_manager_add" class="ml-2 mt-2 text-sm font-medium text-gray-900">Add</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="plantilla_appointee_occupant_manager_edit" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'plantilla_appointee_occupant_manager_edit') ? 'checked' : '' }} value="plantilla_appointee_occupant_manager_edit" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="plantilla_appointee_occupant_manager_edit" class="ml-2 mt-2 text-sm font-medium text-gray-900">Edit</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="plantilla_appointee_occupant_manager_delete" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'plantilla_appointee_occupant_manager_delete') ? 'checked' : '' }} value="plantilla_appointee_occupant_manager_delete" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="plantilla_appointee_occupant_manager_delete" class="ml-2 mt-2 text-sm font-medium text-gray-900">Delete</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="plantilla_appointee_occupant_manager_view" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'plantilla_appointee_occupant_manager_view') ? 'checked' : '' }} value="plantilla_appointee_occupant_manager_view" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="plantilla_appointee_occupant_manager_view" class="ml-2 mt-2 text-sm font-medium text-gray-900">View</label>
                            </div>
    
                        </div>
                    </div>
                </div>
            </div>

            {{-- Appointee Occupant Browser permissions --}}
            <div class="col-span-1">
                <div class="relative my-2 overflow-x-auto shadow-lg sm:rounded-lg">
                    <div class="w-full text-gray-500">
    
                        <div class="bg-blue-500 uppercase text-gray-700 text-white flex justify-between">
                            <h1 class="px-6 py-3 text-xm sm:text-sm sm:py-3.5">
                                Appointee Occupant Browser
                            </h1>
                        </div>
            
                        <div class="border-b bg-white px-6 py-3">
            
                            <div class="flex items-center mb-4">
                                <input id="plantilla_appointee_occupant_browser_add" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'plantilla_appointee_occupant_browser_add') ? 'checked' : '' }} value="plantilla_appointee_occupant_browser_add" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="plantilla_appointee_occupant_browser_add" class="ml-2 mt-2 text-sm font-medium text-gray-900">Add</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="plantilla_appointee_occupant_browser_edit" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'plantilla_appointee_occupant_browser_edit') ? 'checked' : '' }} value="plantilla_appointee_occupant_browser_edit" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="plantilla_appointee_occupant_browser_edit" class="ml-2 mt-2 text-sm font-medium text-gray-900">Edit</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="plantilla_appointee_occupant_browser_delete" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'plantilla_appointee_occupant_browser_delete') ? 'checked' : '' }} value="plantilla_appointee_occupant_browser_delete" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="plantilla_appointee_occupant_browser_delete" class="ml-2 mt-2 text-sm font-medium text-gray-900">Delete</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="plantilla_appointee_occupant_browser_view" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'plantilla_appointee_occupant_browser_view') ? 'checked' : '' }} value="plantilla_appointee_occupant_browser_view" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="plantilla_appointee_occupant_browser_view" class="ml-2 mt-2 text-sm font-medium text-gray-900">View</label>
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
