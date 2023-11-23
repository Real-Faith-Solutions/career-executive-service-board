@extends('layouts.app')
@section('title', 'User Roles')
@section('sub', 'User Roles')
@section('content')

<nav class="bg-gray-200 border-gray-200 dark:bg-gray-800 mb-5">
    <div class="flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="#" class="flex items-center">
            <span class="self-center text-2xl font-semibold whitespace-nowrap uppercase text-blue-500 sm:whitespace-normal">{{ $role_title }} - 201 Profiling Permissions</span>
        </a>

        <div class="flex justify-end">
            <a href="{{ route('permissions.show', ['role_name' => $role_name, 'role_title' => $role_title]) }}" class="btn btn-primary">Back</a>
        </div>
    </div>
</nav>

<div id="personal_educational_permissions" class="">
    <nav>
        <div class="flex flex-col lg:flex-row lg:justify-end">
            <div class="lg:flex lg:space-x-2">
                <button class="p-2 rounded text-slate-500 bg-gray-200 block my-2">Personal & Educational Info</button>
                <button class="p-2 rounded text-white bg-blue-500 block my-2 hover:bg-blue-400" onclick="openExperienceTrainingsPermissions()">Experiences & Trainings</button>
                <button class="p-2 rounded text-white bg-blue-500 block my-2 hover:bg-blue-400" onclick="openOthersPermissions()">Others</button>
            </div>
        </div>
    </nav>
    
    <form method="POST" id="personal_educational_permissions_form" action="{{ route('personalEducationalPermissions.update', ['role_name' => $role_name, 'role_title' => $role_title]) }}">
        @csrf
    
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3">
    
            {{-- personal data permissions --}}
            <div class="col-span-1">
                <div class="relative my-2 overflow-x-auto shadow-lg sm:rounded-lg">
                    <div class="w-full text-gray-500">
    
                        <div class="bg-blue-500 uppercase text-gray-700 text-white flex justify-between">
                            <h1 class="px-6 py-3">
                                Personal Data
                            </h1>
                        </div>
            
                        <div class="border-b bg-white px-6 py-3">
            
                            <div class="flex items-center mb-4">
                                <input id="personal_data_add" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'personal_data_add') ? 'checked' : '' }} value="personal_data_add" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="personal_data_add" class="ml-2 mt-2 text-sm font-medium text-gray-900">Add</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="personal_data_edit" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'personal_data_edit') ? 'checked' : '' }} value="personal_data_edit" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="personal_data_edit" class="ml-2 mt-2 text-sm font-medium text-gray-900">Edit</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="personal_data_delete" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'personal_data_delete') ? 'checked' : '' }} value="personal_data_delete" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="personal_data_delete" class="ml-2 mt-2 text-sm font-medium text-gray-900">Delete</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="personal_data_view" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'personal_data_view') ? 'checked' : '' }} value="personal_data_view" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="personal_data_view" class="ml-2 mt-2 text-sm font-medium text-gray-900">View</label>
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
                                Family Profile
                            </h1>
                        </div>
            
                        <div class="border-b bg-white px-6 py-3">
            
                            <div class="flex items-center mb-4">
                                <input id="family_profile_add" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'family_profile_add') ? 'checked' : '' }} value="family_profile_add" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="family_profile_add" class="ml-2 mt-2 text-sm font-medium text-gray-900">Add</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="family_profile_edit" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'family_profile_edit') ? 'checked' : '' }} value="family_profile_edit" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="family_profile_edit" class="ml-2 mt-2 text-sm font-medium text-gray-900">Edit</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="family_profile_delete" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'family_profile_delete') ? 'checked' : '' }} value="family_profile_delete" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="family_profile_delete" class="ml-2 mt-2 text-sm font-medium text-gray-900">Delete</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="family_profile_view" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'family_profile_view') ? 'checked' : '' }} value="family_profile_view" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="family_profile_view" class="ml-2 mt-2 text-sm font-medium text-gray-900">View</label>
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
                                <input id="educational_attainment_add" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'educational_attainment_add') ? 'checked' : '' }} value="educational_attainment_add" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="educational_attainment_add" class="ml-2 mt-2 text-sm font-medium text-gray-900">Add</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="educational_attainment_edit" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'educational_attainment_edit') ? 'checked' : '' }} value="educational_attainment_edit" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="educational_attainment_edit" class="ml-2 mt-2 text-sm font-medium text-gray-900">Edit</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="educational_attainment_delete" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'educational_attainment_delete') ? 'checked' : '' }} value="educational_attainment_delete" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="educational_attainment_delete" class="ml-2 mt-2 text-sm font-medium text-gray-900">Delete</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="educational_attainment_view" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'educational_attainment_view') ? 'checked' : '' }} value="educational_attainment_view" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
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
                                <input id="examinations_taken_add" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'examinations_taken_add') ? 'checked' : '' }} value="examinations_taken_add" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="examinations_taken_add" class="ml-2 mt-2 text-sm font-medium text-gray-900">Add</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="examinations_taken_edit" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'examinations_taken_edit') ? 'checked' : '' }} value="examinations_taken_edit" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="examinations_taken_edit" class="ml-2 mt-2 text-sm font-medium text-gray-900">Edit</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="examinations_taken_delete" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'examinations_taken_delete') ? 'checked' : '' }} value="examinations_taken_delete" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="examinations_taken_delete" class="ml-2 mt-2 text-sm font-medium text-gray-900">Delete</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="examinations_taken_view" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'examinations_taken_view') ? 'checked' : '' }} value="examinations_taken_view" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
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
                                <input id="scholarships_taken_add" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'scholarships_taken_add') ? 'checked' : '' }} value="scholarships_taken_add" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="scholarships_taken_add" class="ml-2 mt-2 text-sm font-medium text-gray-900">Add</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="scholarships_taken_edit" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'scholarships_taken_edit') ? 'checked' : '' }} value="scholarships_taken_edit" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="scholarships_taken_edit" class="ml-2 mt-2 text-sm font-medium text-gray-900">Edit</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="scholarships_taken_delete" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'scholarships_taken_delete') ? 'checked' : '' }} value="scholarships_taken_delete" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="scholarships_taken_delete" class="ml-2 mt-2 text-sm font-medium text-gray-900">Delete</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="scholarships_taken_view" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'scholarships_taken_view') ? 'checked' : '' }} value="scholarships_taken_view" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
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
                                <input id="research_and_studies_add" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'research_and_studies_add') ? 'checked' : '' }} value="research_and_studies_add" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="research_and_studies_add" class="ml-2 mt-2 text-sm font-medium text-gray-900">Add</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="research_and_studies_edit" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'research_and_studies_edit') ? 'checked' : '' }} value="research_and_studies_edit" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="research_and_studies_edit" class="ml-2 mt-2 text-sm font-medium text-gray-900">Edit</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="research_and_studies_delete" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'research_and_studies_delete') ? 'checked' : '' }} value="research_and_studies_delete" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="research_and_studies_delete" class="ml-2 mt-2 text-sm font-medium text-gray-900">Delete</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="research_and_studies_view" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'research_and_studies_view') ? 'checked' : '' }} value="research_and_studies_view" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
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

<div id="experience_trainings_permissions" class="hidden">
    <nav>
        <div class="flex flex-col lg:flex-row lg:justify-end">
            <div class="lg:flex lg:space-x-2">
                <button class="p-2 rounded text-white bg-blue-500 block my-2 hover:bg-blue-400" onclick="openPersonalEducationalPermissions()">Personal & Educational Info</button>
                <button class="p-2 rounded text-slate-500 bg-gray-200 block my-2">Experiences & Trainings</button>
                <button class="p-2 rounded text-white bg-blue-500 block my-2 hover:bg-blue-400" onclick="openOthersPermissions()">Others</button>
            </div>
        </div>
    </nav>
    
    <form method="POST" id="experience_trainings_permissions_form" action="{{ route('experienceTrainingsPermissions.update', ['role_name' => $role_name, 'role_title' => $role_title]) }}">
        @csrf
    
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3">
    
            {{-- Work Experience permissions --}}
            <div class="col-span-1">
                <div class="relative my-2 overflow-x-auto shadow-lg sm:rounded-lg">
                    <div class="w-full text-gray-500">
    
                        <div class="bg-blue-500 uppercase text-gray-700 text-white flex justify-between">
                            <h1 class="px-6 py-3">
                                Work Experience
                            </h1>
                        </div>
            
                        <div class="border-b bg-white px-6 py-3">
            
                            <div class="flex items-center mb-4">
                                <input id="work_experience_add" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'work_experience_add') ? 'checked' : '' }} value="work_experience_add" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="work_experience_add" class="ml-2 mt-2 text-sm font-medium text-gray-900">Add</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="work_experience_edit" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'work_experience_edit') ? 'checked' : '' }} value="work_experience_edit" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="work_experience_edit" class="ml-2 mt-2 text-sm font-medium text-gray-900">Edit</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="work_experience_delete" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'work_experience_delete') ? 'checked' : '' }} value="work_experience_delete" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="work_experience_delete" class="ml-2 mt-2 text-sm font-medium text-gray-900">Delete</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="work_experience_view" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'work_experience_view') ? 'checked' : '' }} value="work_experience_view" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="work_experience_view" class="ml-2 mt-2 text-sm font-medium text-gray-900">View</label>
                            </div>
    
                        </div>
                    </div>
                </div>
            </div>
    
            {{-- Field Expertise permissions --}}
            <div class="col-span-1">
                <div class="relative my-2 overflow-x-auto shadow-lg sm:rounded-lg">
                    <div class="w-full text-gray-500">
                        
                        <div class="bg-blue-500 uppercase text-gray-700 text-white flex justify-between">
                            <h1 class="px-6 py-3">
                                Field Expertise
                            </h1>
                        </div>
            
                        <div class="border-b bg-white px-6 py-3">
            
                            <div class="flex items-center mb-4">
                                <input id="field_expertise_add" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'field_expertise_add') ? 'checked' : '' }} value="field_expertise_add" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="field_expertise_add" class="ml-2 mt-2 text-sm font-medium text-gray-900">Add</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="field_expertise_edit" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'field_expertise_edit') ? 'checked' : '' }} value="field_expertise_edit" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="field_expertise_edit" class="ml-2 mt-2 text-sm font-medium text-gray-900">Edit</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="field_expertise_delete" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'field_expertise_delete') ? 'checked' : '' }} value="field_expertise_delete" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="field_expertise_delete" class="ml-2 mt-2 text-sm font-medium text-gray-900">Delete</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="field_expertise_view" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'field_expertise_view') ? 'checked' : '' }} value="field_expertise_view" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="field_expertise_view" class="ml-2 mt-2 text-sm font-medium text-gray-900">View</label>
                            </div>
    
                        </div>
                    </div>
                </div>
            </div>
    
            {{-- CES Trainings permissions --}}
            <div class="col-span-1">
                <div class="relative my-2 overflow-x-auto shadow-lg sm:rounded-lg">
                    <div class="w-full text-gray-500">
    
                        <div class="bg-blue-500 uppercase text-gray-700 text-white flex justify-between">
                            <h1 class="px-6 py-3">
                                CES Trainings
                            </h1>
                        </div>
            
                        <div class="border-b bg-white px-6 py-3">
            
                            <div class="flex items-center mb-4">
                                <input id="ces_trainings_add" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'ces_trainings_add') ? 'checked' : '' }} value="ces_trainings_add" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="ces_trainings_add" class="ml-2 mt-2 text-sm font-medium text-gray-900">Add</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="ces_trainings_edit" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'ces_trainings_edit') ? 'checked' : '' }} value="ces_trainings_edit" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="ces_trainings_edit" class="ml-2 mt-2 text-sm font-medium text-gray-900">Edit</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="ces_trainings_delete" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'ces_trainings_delete') ? 'checked' : '' }} value="ces_trainings_delete" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="ces_trainings_delete" class="ml-2 mt-2 text-sm font-medium text-gray-900">Delete</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="ces_trainings_view" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'ces_trainings_view') ? 'checked' : '' }} value="ces_trainings_view" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="ces_trainings_view" class="ml-2 mt-2 text-sm font-medium text-gray-900">View</label>
                            </div>
    
                        </div>
                    </div>
                </div>
            </div>
    
            {{-- Non-CES Training permissions --}}
            <div class="col-span-1">
                <div class="relative my-2 overflow-x-auto shadow-lg sm:rounded-lg">
                    <div class="w-full text-gray-500">
    
                        <div class="bg-blue-500 uppercase text-gray-700 text-white flex justify-between">
                            <h1 class="px-6 py-3">
                                Non-CES Training
                            </h1>
                        </div>
            
                        <div class="border-b bg-white px-6 py-3">
            
                            <div class="flex items-center mb-4">
                                <input id="non_ces_trainings_add" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'non_ces_trainings_add') ? 'checked' : '' }} value="non_ces_trainings_add" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="non_ces_trainings_add" class="ml-2 mt-2 text-sm font-medium text-gray-900">Add</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="non_ces_trainings_edit" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'non_ces_trainings_edit') ? 'checked' : '' }} value="non_ces_trainings_edit" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="non_ces_trainings_edit" class="ml-2 mt-2 text-sm font-medium text-gray-900">Edit</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="non_ces_trainings_delete" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'non_ces_trainings_delete') ? 'checked' : '' }} value="non_ces_trainings_delete" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="non_ces_trainings_delete" class="ml-2 mt-2 text-sm font-medium text-gray-900">Delete</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="non_ces_trainings_view" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'non_ces_trainings_view') ? 'checked' : '' }} value="non_ces_trainings_view" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="non_ces_trainings_view" class="ml-2 mt-2 text-sm font-medium text-gray-900">View</label>
                            </div>
    
                        </div>
                    </div>
                </div>
            </div>
    
        </div>
    
        <div class="flex justify-center mt-3">
            <button type="button" class="btn btn-primary" id="experience_trainings_permissions_btn" onclick="openConfirmationDialog(this, 'Confirm Permissions', 'Are you sure you want to submit/update this permissions?')">Save Permissions</button>
        </div>
    
    </form>
</div>

<div id="personal_others_permissions" class="hidden">
    <nav>
        <div class="flex flex-col lg:flex-row lg:justify-end">
            <div class="lg:flex lg:space-x-2">
                <button class="p-2 rounded text-white bg-blue-500 block my-2 hover:bg-blue-400" onclick="openPersonalEducationalPermissions()">Personal & Educational Info</button>
                <button class="p-2 rounded text-white bg-blue-500 block my-2 hover:bg-blue-400" onclick="openExperienceTrainingsPermissions()">Experiences & Trainings</button>
                <button class="p-2 rounded text-slate-500 bg-gray-200 block my-2">Others</button>
            </div>
        </div>
    </nav>
    
    <form method="POST" id="personal_others_permissions_form" action="{{ route('personalOthersPermissions.update', ['role_name' => $role_name, 'role_title' => $role_title]) }}">
        @csrf
    
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3">
    
            {{-- health records permissions --}}
            <div class="col-span-1">
                <div class="relative my-2 overflow-x-auto shadow-lg sm:rounded-lg">
                    <div class="w-full text-gray-500">
    
                        <div class="bg-blue-500 uppercase text-gray-700 text-white flex justify-between">
                            <h1 class="px-6 py-3">
                                Health Records
                            </h1>
                        </div>
            
                        <div class="border-b bg-white px-6 py-3">
            
                            <div class="flex items-center mb-4">
                                <input id="health_records_add" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'health_records_add') ? 'checked' : '' }} value="health_records_add" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="health_records_add" class="ml-2 mt-2 text-sm font-medium text-gray-900">Add</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="health_records_edit" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'health_records_edit') ? 'checked' : '' }} value="health_records_edit" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="health_records_edit" class="ml-2 mt-2 text-sm font-medium text-gray-900">Edit</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="health_records_delete" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'health_records_delete') ? 'checked' : '' }} value="health_records_delete" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="health_records_delete" class="ml-2 mt-2 text-sm font-medium text-gray-900">Delete</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="health_records_view" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'health_records_view') ? 'checked' : '' }} value="health_records_view" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="health_records_view" class="ml-2 mt-2 text-sm font-medium text-gray-900">View</label>
                            </div>
    
                        </div>
                    </div>
                </div>
            </div>
    
            {{-- award and citations permissions --}}
            <div class="col-span-1">
                <div class="relative my-2 overflow-x-auto shadow-lg sm:rounded-lg">
                    <div class="w-full text-gray-500">
                        
                        <div class="bg-blue-500 uppercase text-gray-700 text-white flex justify-between">
                            <h1 class="px-6 py-3">
                                Award and Citations
                            </h1>
                        </div>
            
                        <div class="border-b bg-white px-6 py-3">
            
                            <div class="flex items-center mb-4">
                                <input id="awards_and_citations_add" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'awards_and_citations_add') ? 'checked' : '' }} value="awards_and_citations_add" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="awards_and_citations_add" class="ml-2 mt-2 text-sm font-medium text-gray-900">Add</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="awards_and_citations_edit" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'awards_and_citations_edit') ? 'checked' : '' }} value="awards_and_citations_edit" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="awards_and_citations_edit" class="ml-2 mt-2 text-sm font-medium text-gray-900">Edit</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="awards_and_citations_delete" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'awards_and_citations_delete') ? 'checked' : '' }} value="awards_and_citations_delete" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="awards_and_citations_delete" class="ml-2 mt-2 text-sm font-medium text-gray-900">Delete</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="awards_and_citations_view" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'awards_and_citations_view') ? 'checked' : '' }} value="awards_and_citations_view" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="awards_and_citations_view" class="ml-2 mt-2 text-sm font-medium text-gray-900">View</label>
                            </div>
    
                        </div>
                    </div>
                </div>
            </div>
    
            {{-- affiliations permissions --}}
            <div class="col-span-1">
                <div class="relative my-2 overflow-x-auto shadow-lg sm:rounded-lg">
                    <div class="w-full text-gray-500">
    
                        <div class="bg-blue-500 uppercase text-gray-700 text-white flex justify-between">
                            <h1 class="px-6 py-3">
                                Affiliations
                            </h1>
                        </div>
            
                        <div class="border-b bg-white px-6 py-3">
            
                            <div class="flex items-center mb-4">
                                <input id="affiliations_add" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'affiliations_add') ? 'checked' : '' }} value="affiliations_add" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="affiliations_add" class="ml-2 mt-2 text-sm font-medium text-gray-900">Add</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="affiliations_edit" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'affiliations_edit') ? 'checked' : '' }} value="affiliations_edit" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="affiliations_edit" class="ml-2 mt-2 text-sm font-medium text-gray-900">Edit</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="affiliations_delete" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'affiliations_delete') ? 'checked' : '' }} value="affiliations_delete" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="affiliations_delete" class="ml-2 mt-2 text-sm font-medium text-gray-900">Delete</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="affiliations_view" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'affiliations_view') ? 'checked' : '' }} value="affiliations_view" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="affiliations_view" class="ml-2 mt-2 text-sm font-medium text-gray-900">View</label>
                            </div>
    
                        </div>
                    </div>
                </div>
            </div>
    
            {{-- case records permissions --}}
            <div class="col-span-1">
                <div class="relative my-2 overflow-x-auto shadow-lg sm:rounded-lg">
                    <div class="w-full text-gray-500">
    
                        <div class="bg-blue-500 uppercase text-gray-700 text-white flex justify-between">
                            <h1 class="px-6 py-3">
                                Case Records
                            </h1>
                        </div>
            
                        <div class="border-b bg-white px-6 py-3">
            
                            <div class="flex items-center mb-4">
                                <input id="case_records_add" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'case_records_add') ? 'checked' : '' }} value="case_records_add" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="case_records_add" class="ml-2 mt-2 text-sm font-medium text-gray-900">Add</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="case_records_edit" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'case_records_edit') ? 'checked' : '' }} value="case_records_edit" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="case_records_edit" class="ml-2 mt-2 text-sm font-medium text-gray-900">Edit</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="case_records_delete" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'case_records_delete') ? 'checked' : '' }} value="case_records_delete" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="case_records_delete" class="ml-2 mt-2 text-sm font-medium text-gray-900">Delete</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="case_records_view" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'case_records_view') ? 'checked' : '' }} value="case_records_view" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="case_records_view" class="ml-2 mt-2 text-sm font-medium text-gray-900">View</label>
                            </div>
    
                        </div>
                    </div>
                </div>
            </div>
    
            {{-- languages & dialects permissions --}}
            <div class="col-span-1">
                <div class="relative my-2 overflow-x-auto shadow-lg sm:rounded-lg">
                    <div class="w-full text-gray-500">
    
                        <div class="bg-blue-500 uppercase text-gray-700 text-white flex justify-between">
                            <h1 class="px-6 py-3">
                                Languages & Dialects
                            </h1>
                        </div>
            
                        <div class="border-b bg-white px-6 py-3">
            
                            <div class="flex items-center mb-4">
                                <input id="language_dialects_add" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'language_dialects_add') ? 'checked' : '' }} value="language_dialects_add" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="language_dialects_add" class="ml-2 mt-2 text-sm font-medium text-gray-900">Add</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="language_dialects_edit" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'language_dialects_edit') ? 'checked' : '' }} value="language_dialects_edit" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="language_dialects_edit" class="ml-2 mt-2 text-sm font-medium text-gray-900">Edit</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="language_dialects_delete" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'language_dialects_delete') ? 'checked' : '' }} value="language_dialects_delete" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="language_dialects_delete" class="ml-2 mt-2 text-sm font-medium text-gray-900">Delete</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="language_dialects_view" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'language_dialects_view') ? 'checked' : '' }} value="language_dialects_view" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="language_dialects_view" class="ml-2 mt-2 text-sm font-medium text-gray-900">View</label>
                            </div>
    
                        </div>
                    </div>
                </div>
            </div>
    
            {{-- rank tracker permissions --}}
            <div class="col-span-1">
                <div class="relative my-2 overflow-x-auto shadow-lg sm:rounded-lg">
                    <div class="w-full text-gray-500">
    
                        <div class="bg-blue-500 uppercase text-gray-700 text-white flex justify-between">
                            <h1 class="px-6 py-3">
                                Rank Tracker
                            </h1>
                        </div>
            
                        <div class="border-b bg-white px-6 py-3">
            
                            <div class="flex items-center mb-4">
                                <input id="eligibility_rank_tracker_add" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'eligibility_rank_tracker_add') ? 'checked' : '' }} value="eligibility_rank_tracker_add" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="eligibility_rank_tracker_add" class="ml-2 mt-2 text-sm font-medium text-gray-900">Add</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="eligibility_rank_tracker_edit" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'eligibility_rank_tracker_edit') ? 'checked' : '' }} value="eligibility_rank_tracker_edit" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="eligibility_rank_tracker_edit" class="ml-2 mt-2 text-sm font-medium text-gray-900">Edit</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="eligibility_rank_tracker_delete" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'eligibility_rank_tracker_delete') ? 'checked' : '' }} value="eligibility_rank_tracker_delete" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="eligibility_rank_tracker_delete" class="ml-2 mt-2 text-sm font-medium text-gray-900">Delete</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="eligibility_rank_tracker_view" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'eligibility_rank_tracker_view') ? 'checked' : '' }} value="eligibility_rank_tracker_view" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="eligibility_rank_tracker_view" class="ml-2 mt-2 text-sm font-medium text-gray-900">View</label>
                            </div>
    
                        </div>
                    </div>
                </div>
            </div>

            {{-- cespes ratings permissions --}}
            <div class="col-span-1">
                <div class="relative my-2 overflow-x-auto shadow-lg sm:rounded-lg">
                    <div class="w-full text-gray-500">
    
                        <div class="bg-blue-500 uppercase text-gray-700 text-white flex justify-between">
                            <h1 class="px-6 py-3">
                                CESPES Ratings
                            </h1>
                        </div>
            
                        <div class="border-b bg-white px-6 py-3">
            
                            <div class="flex items-center mb-4">
                                <input id="cespes_ratings_add" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'cespes_ratings_add') ? 'checked' : '' }} value="cespes_ratings_add" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="cespes_ratings_add" class="ml-2 mt-2 text-sm font-medium text-gray-900">Add</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="cespes_ratings_edit" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'cespes_ratings_edit') ? 'checked' : '' }} value="cespes_ratings_edit" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="cespes_ratings_edit" class="ml-2 mt-2 text-sm font-medium text-gray-900">Edit</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="cespes_ratings_delete" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'cespes_ratings_delete') ? 'checked' : '' }} value="cespes_ratings_delete" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="cespes_ratings_delete" class="ml-2 mt-2 text-sm font-medium text-gray-900">Delete</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="cespes_ratings_view" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'cespes_ratings_view') ? 'checked' : '' }} value="cespes_ratings_view" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="cespes_ratings_view" class="ml-2 mt-2 text-sm font-medium text-gray-900">View</label>
                            </div>
    
                        </div>
                    </div>
                </div>
            </div>

            {{-- pdf files permissions --}}
            <div class="col-span-1">
                <div class="relative my-2 overflow-x-auto shadow-lg sm:rounded-lg">
                    <div class="w-full text-gray-500">
    
                        <div class="bg-blue-500 uppercase text-gray-700 text-white flex justify-between">
                            <h1 class="px-6 py-3">
                                PDF Files
                            </h1>
                        </div>
            
                        <div class="border-b bg-white px-6 py-3">
            
                            <div class="flex items-center mb-4">
                                <input id="pdf_files_add" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'pdf_files_add') ? 'checked' : '' }} value="pdf_files_add" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="pdf_files_add" class="ml-2 mt-2 text-sm font-medium text-gray-900">Add</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="pdf_files_edit" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'pdf_files_edit') ? 'checked' : '' }} value="pdf_files_edit" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="pdf_files_edit" class="ml-2 mt-2 text-sm font-medium text-gray-900">Edit</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="pdf_files_delete" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'pdf_files_delete') ? 'checked' : '' }} value="pdf_files_delete" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="pdf_files_delete" class="ml-2 mt-2 text-sm font-medium text-gray-900">Delete</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="pdf_files_view" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'pdf_files_view') ? 'checked' : '' }} value="pdf_files_view" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="pdf_files_view" class="ml-2 mt-2 text-sm font-medium text-gray-900">View</label>
                            </div>
    
                        </div>
                    </div>
                </div>
            </div>
    
        </div>
    
        <div class="flex justify-center mt-3">
            <button type="button" class="btn btn-primary" id="personal_others_permissions_btn" onclick="openConfirmationDialog(this, 'Confirm Permissions', 'Are you sure you want to submit/update this permissions?')">Save Permissions</button>
        </div>
    
    </form>
</div>

@endsection
