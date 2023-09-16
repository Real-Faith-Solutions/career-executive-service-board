@extends('layouts.app')
@section('title', 'User Roles')
@section('sub', 'User Roles')
@section('content')

<nav class="bg-gray-200 border-gray-200 dark:bg-gray-800 mb-5">
    <div class="flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="#" class="flex items-center">
            <span class="self-center text-2xl font-semibold whitespace-nowrap uppercase text-blue-500 sm:whitespace-normal">{{ $role_title }} - Competency Permissions</span>
        </a>

        <div class="flex justify-end">
            <a href="{{ route('permissions.show', ['role_name' => $role_name, 'role_title' => $role_title]) }}" class="btn btn-primary">Back</a>
        </div>
    </div>
</nav>

<div id="personal_educational_permissions" class="">
    {{-- <nav>
        <div class="flex flex-col lg:flex-row lg:justify-end">
            <div class="lg:flex lg:space-x-2">
                <button class="p-2 rounded text-slate-500 bg-gray-200 block my-2">Personal & Educational Info</button>
                <button class="p-2 rounded text-white bg-blue-500 block my-2 hover:bg-blue-400" onclick="openExperienceTrainingsPermissions()">Experiences & Trainings</button>
                <button class="p-2 rounded text-white bg-blue-500 block my-2 hover:bg-blue-400" onclick="openOthersPermissions()">Others</button>
            </div>
        </div>
    </nav> --}}
    
    <form method="POST" id="personal_educational_permissions_form" action="{{ route('personalEducationalPermissions.update', ['role_name' => $role_name, 'role_title' => $role_title]) }}">
        @csrf
    
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3">
    
            {{-- Competency Contacts permissions --}}
            <div class="col-span-1">
                <div class="relative my-2 overflow-x-auto shadow-lg sm:rounded-lg">
                    <div class="w-full text-gray-500">
    
                        <div class="bg-blue-500 uppercase text-gray-700 text-white flex justify-between">
                            <h1 class="px-6 py-3">
                                Competency Contacts
                            </h1>
                        </div>
            
                        <div class="border-b bg-white px-6 py-3">
            
                            <div class="flex items-center mb-4">
                                <input id="compentency_contacts_add" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'compentency_contacts_add') ? 'checked' : '' }} value="compentency_contacts_add" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="compentency_contacts_add" class="ml-2 mt-2 text-sm font-medium text-gray-900">Add</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="compentency_contacts_edit" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'compentency_contacts_edit') ? 'checked' : '' }} value="compentency_contacts_edit" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="compentency_contacts_edit" class="ml-2 mt-2 text-sm font-medium text-gray-900">Edit</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="compentency_contacts_delete" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'compentency_contacts_delete') ? 'checked' : '' }} value="compentency_contacts_delete" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="compentency_contacts_delete" class="ml-2 mt-2 text-sm font-medium text-gray-900">Delete</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="compentency_contacts_view" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'compentency_contacts_view') ? 'checked' : '' }} value="compentency_contacts_view" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="compentency_contacts_view" class="ml-2 mt-2 text-sm font-medium text-gray-900">View</label>
                            </div>
    
                        </div>
                    </div>
                </div>
            </div>
    
            {{-- family permissions --}}
            <div class="col-span-1">
                <div class="relative my-2 overflow-x-auto shadow-lg sm:rounded-lg">
                    <div class="w-full text-gray-500">
                        
                        <div class="bg-blue-500 uppercase text-gray-700 text-white flex justify-between">
                            <h1 class="px-6 py-3">
                                Non-Ces Trainings
                            </h1>
                        </div>
            
                        <div class="border-b bg-white px-6 py-3">
            
                            <div class="flex items-center mb-4">
                                <input id="compentency_non_ces_trainings_add" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'compentency_non_ces_trainings_add') ? 'checked' : '' }} value="compentency_non_ces_trainings_add" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="compentency_non_ces_trainings_add" class="ml-2 mt-2 text-sm font-medium text-gray-900">Add</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="compentency_non_ces_trainings_edit" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'compentency_non_ces_trainings_edit') ? 'checked' : '' }} value="compentency_non_ces_trainings_edit" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="compentency_non_ces_trainings_edit" class="ml-2 mt-2 text-sm font-medium text-gray-900">Edit</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="compentency_non_ces_trainings_delete" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'compentency_non_ces_trainings_delete') ? 'checked' : '' }} value="compentency_non_ces_trainings_delete" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="compentency_non_ces_trainings_delete" class="ml-2 mt-2 text-sm font-medium text-gray-900">Delete</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="compentency_non_ces_trainings_view" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'compentency_non_ces_trainings_view') ? 'checked' : '' }} value="compentency_non_ces_trainings_view" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="compentency_non_ces_trainings_view" class="ml-2 mt-2 text-sm font-medium text-gray-900">View</label>
                            </div>
    
                        </div>
                    </div>
                </div>
            </div>
    
            {{-- educational attainment permissions --}}
            <div class="col-span-1">
                <div class="relative my-2 overflow-x-auto shadow-lg sm:rounded-lg">
                    <div class="w-full text-gray-500">
    
                        <div class="bg-blue-500 uppercase text-gray-700 text-white flex justify-between">
                            <h1 class="px-6 py-3 text-xm sm:text-sm sm:py-3.5">
                                Educational Attainment
                            </h1>
                        </div>
            
                        <div class="border-b bg-white px-6 py-3">
            
                            <div class="flex items-center mb-4">
                                <input id="educational_attainment_add" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'educational_attainment_add') ? 'checked' : '' }} value="educational_attainment_add" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="educational_attainment_add" class="ml-2 mt-2 text-sm font-medium text-gray-900">Add</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="educational_attainment_edit" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'educational_attainment_edit') ? 'checked' : '' }} value="educational_attainment_edit" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="educational_attainment_edit" class="ml-2 mt-2 text-sm font-medium text-gray-900">Edit</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="educational_attainment_delete" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'educational_attainment_delete') ? 'checked' : '' }} value="educational_attainment_delete" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="educational_attainment_delete" class="ml-2 mt-2 text-sm font-medium text-gray-900">Delete</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="educational_attainment_view" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'educational_attainment_view') ? 'checked' : '' }} value="educational_attainment_view" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="educational_attainment_view" class="ml-2 mt-2 text-sm font-medium text-gray-900">View</label>
                            </div>
    
                        </div>
                    </div>
                </div>
            </div>
    
            {{-- examinations taken permissions --}}
            <div class="col-span-1">
                <div class="relative my-2 overflow-x-auto shadow-lg sm:rounded-lg">
                    <div class="w-full text-gray-500">
    
                        <div class="bg-blue-500 uppercase text-gray-700 text-white flex justify-between">
                            <h1 class="px-6 py-3">
                                Examinations Taken
                            </h1>
                        </div>
            
                        <div class="border-b bg-white px-6 py-3">
            
                            <div class="flex items-center mb-4">
                                <input id="examinations_taken_add" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'examinations_taken_add') ? 'checked' : '' }} value="examinations_taken_add" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="examinations_taken_add" class="ml-2 mt-2 text-sm font-medium text-gray-900">Add</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="examinations_taken_edit" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'examinations_taken_edit') ? 'checked' : '' }} value="examinations_taken_edit" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="examinations_taken_edit" class="ml-2 mt-2 text-sm font-medium text-gray-900">Edit</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="examinations_taken_delete" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'examinations_taken_delete') ? 'checked' : '' }} value="examinations_taken_delete" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="examinations_taken_delete" class="ml-2 mt-2 text-sm font-medium text-gray-900">Delete</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="examinations_taken_view" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'examinations_taken_view') ? 'checked' : '' }} value="examinations_taken_view" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="examinations_taken_view" class="ml-2 mt-2 text-sm font-medium text-gray-900">View</label>
                            </div>
    
                        </div>
                    </div>
                </div>
            </div>
    
            {{-- scholarships taken permissions --}}
            <div class="col-span-1">
                <div class="relative my-2 overflow-x-auto shadow-lg sm:rounded-lg">
                    <div class="w-full text-gray-500">
    
                        <div class="bg-blue-500 uppercase text-gray-700 text-white flex justify-between">
                            <h1 class="px-6 py-3">
                                Scholarships Taken
                            </h1>
                        </div>
            
                        <div class="border-b bg-white px-6 py-3">
            
                            <div class="flex items-center mb-4">
                                <input id="scholarships_taken_add" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'scholarships_taken_add') ? 'checked' : '' }} value="scholarships_taken_add" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="scholarships_taken_add" class="ml-2 mt-2 text-sm font-medium text-gray-900">Add</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="scholarships_taken_edit" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'scholarships_taken_edit') ? 'checked' : '' }} value="scholarships_taken_edit" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="scholarships_taken_edit" class="ml-2 mt-2 text-sm font-medium text-gray-900">Edit</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="scholarships_taken_delete" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'scholarships_taken_delete') ? 'checked' : '' }} value="scholarships_taken_delete" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="scholarships_taken_delete" class="ml-2 mt-2 text-sm font-medium text-gray-900">Delete</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="scholarships_taken_view" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'scholarships_taken_view') ? 'checked' : '' }} value="scholarships_taken_view" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="scholarships_taken_view" class="ml-2 mt-2 text-sm font-medium text-gray-900">View</label>
                            </div>
    
                        </div>
                    </div>
                </div>
            </div>
    
            {{-- research and studies permissions --}}
            <div class="col-span-1">
                <div class="relative my-2 overflow-x-auto shadow-lg sm:rounded-lg">
                    <div class="w-full text-gray-500">
    
                        <div class="bg-blue-500 uppercase text-gray-700 text-white flex justify-between">
                            <h1 class="px-6 py-3">
                                Research & Studies
                            </h1>
                        </div>
            
                        <div class="border-b bg-white px-6 py-3">
            
                            <div class="flex items-center mb-4">
                                <input id="research_and_studies_add" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'research_and_studies_add') ? 'checked' : '' }} value="research_and_studies_add" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="research_and_studies_add" class="ml-2 mt-2 text-sm font-medium text-gray-900">Add</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="research_and_studies_edit" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'research_and_studies_edit') ? 'checked' : '' }} value="research_and_studies_edit" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="research_and_studies_edit" class="ml-2 mt-2 text-sm font-medium text-gray-900">Edit</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="research_and_studies_delete" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'research_and_studies_delete') ? 'checked' : '' }} value="research_and_studies_delete" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="research_and_studies_delete" class="ml-2 mt-2 text-sm font-medium text-gray-900">Delete</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="research_and_studies_view" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'research_and_studies_view') ? 'checked' : '' }} value="research_and_studies_view" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="research_and_studies_view" class="ml-2 mt-2 text-sm font-medium text-gray-900">View</label>
                            </div>
    
                        </div>
                    </div>
                </div>
            </div>
    
        </div>
    
        <div class="flex justify-center mt-3">
            <button type="button" class="btn btn-primary" id="personal_educational_permissions_btn" onclick="openConfirmationDialog(this, 'Confirm Permissions', 'Are you sure you want to submit/update this permissions?')">Save Permissions</button>
        </div>
    
    </form>
</div>

@endsection
