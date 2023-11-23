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

<div id="competency_permissions" class="">
    
    <form method="POST" id="competency_permissions_form" action="{{ route('competencyPermissions.update', ['role_name' => $role_name, 'role_title' => $role_title]) }}">
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
                                <input id="compentency_contacts_add" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'compentency_contacts_add') ? 'checked' : '' }} value="compentency_contacts_add" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="compentency_contacts_add" class="ml-2 mt-2 text-sm font-medium text-gray-900">Add</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="compentency_contacts_edit" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'compentency_contacts_edit') ? 'checked' : '' }} value="compentency_contacts_edit" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="compentency_contacts_edit" class="ml-2 mt-2 text-sm font-medium text-gray-900">Edit</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="compentency_contacts_delete" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'compentency_contacts_delete') ? 'checked' : '' }} value="compentency_contacts_delete" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="compentency_contacts_delete" class="ml-2 mt-2 text-sm font-medium text-gray-900">Delete</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="compentency_contacts_view" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'compentency_contacts_view') ? 'checked' : '' }} value="compentency_contacts_view" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="compentency_contacts_view" class="ml-2 mt-2 text-sm font-medium text-gray-900">View</label>
                            </div>
    
                        </div>
                    </div>
                </div>
            </div>
    
            {{-- Non-Ces Trainings permissions --}}
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
                                <input id="compentency_non_ces_trainings_add" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'compentency_non_ces_trainings_add') ? 'checked' : '' }} value="compentency_non_ces_trainings_add" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="compentency_non_ces_trainings_add" class="ml-2 mt-2 text-sm font-medium text-gray-900">Add</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="compentency_non_ces_trainings_edit" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'compentency_non_ces_trainings_edit') ? 'checked' : '' }} value="compentency_non_ces_trainings_edit" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="compentency_non_ces_trainings_edit" class="ml-2 mt-2 text-sm font-medium text-gray-900">Edit</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="compentency_non_ces_trainings_delete" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'compentency_non_ces_trainings_delete') ? 'checked' : '' }} value="compentency_non_ces_trainings_delete" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="compentency_non_ces_trainings_delete" class="ml-2 mt-2 text-sm font-medium text-gray-900">Delete</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="compentency_non_ces_trainings_view" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'compentency_non_ces_trainings_view') ? 'checked' : '' }} value="compentency_non_ces_trainings_view" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="compentency_non_ces_trainings_view" class="ml-2 mt-2 text-sm font-medium text-gray-900">View</label>
                            </div>
    
                        </div>
                    </div>
                </div>
            </div>
    
            {{-- Training Provider Manager permissions --}}
            <div class="col-span-1">
                <div class="relative my-2 overflow-x-auto shadow-lg sm:rounded-lg">
                    <div class="w-full text-gray-500">
    
                        <div class="bg-blue-500 uppercase text-gray-700 text-white flex justify-between">
                            <h1 class="px-6 py-3 text-xm sm:text-sm sm:py-3.5">
                                Training Provider Manager
                            </h1>
                        </div>
            
                        <div class="border-b bg-white px-6 py-3">
            
                            <div class="flex items-center mb-4">
                                <input id="training_provider_manager_add" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'training_provider_manager_add') ? 'checked' : '' }} value="training_provider_manager_add" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="training_provider_manager_add" class="ml-2 mt-2 text-sm font-medium text-gray-900">Add</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="training_provider_manager_edit" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'training_provider_manager_edit') ? 'checked' : '' }} value="training_provider_manager_edit" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="training_provider_manager_edit" class="ml-2 mt-2 text-sm font-medium text-gray-900">Edit</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="training_provider_manager_delete" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'training_provider_manager_delete') ? 'checked' : '' }} value="training_provider_manager_delete" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="training_provider_manager_delete" class="ml-2 mt-2 text-sm font-medium text-gray-900">Delete</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="training_provider_manager_view" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'training_provider_manager_view') ? 'checked' : '' }} value="training_provider_manager_view" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="training_provider_manager_view" class="ml-2 mt-2 text-sm font-medium text-gray-900">View</label>
                            </div>
    
                        </div>
                    </div>
                </div>
            </div>
    
            {{-- Training Venue Manager permissions --}}
            <div class="col-span-1">
                <div class="relative my-2 overflow-x-auto shadow-lg sm:rounded-lg">
                    <div class="w-full text-gray-500">

                        <div class="bg-blue-500 uppercase text-gray-700 text-white flex justify-between">
                            <h1 class="px-6 py-3 text-xm sm:text-sm sm:py-3.5">
                                Training Venue Manager
                            </h1>
                        </div>
    
                        <div class="border-b bg-white px-6 py-3">
            
                            <div class="flex items-center mb-4">
                                <input id="training_venue_manager_add" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'training_venue_manager_add') ? 'checked' : '' }} value="training_venue_manager_add" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="training_venue_manager_add" class="ml-2 mt-2 text-sm font-medium text-gray-900">Add</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="training_venue_manager_edit" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'training_venue_manager_edit') ? 'checked' : '' }} value="training_venue_manager_edit" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="training_venue_manager_edit" class="ml-2 mt-2 text-sm font-medium text-gray-900">Edit</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="training_venue_manager_delete" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'training_venue_manager_delete') ? 'checked' : '' }} value="training_venue_manager_delete" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="training_venue_manager_delete" class="ml-2 mt-2 text-sm font-medium text-gray-900">Delete</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="training_venue_manager_view" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'training_venue_manager_view') ? 'checked' : '' }} value="training_venue_manager_view" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="training_venue_manager_view" class="ml-2 mt-2 text-sm font-medium text-gray-900">View</label>
                            </div>
    
                        </div>
                    </div>
                </div>
            </div>
    
            {{-- Training Category permissions --}}
            <div class="col-span-1">
                <div class="relative my-2 overflow-x-auto shadow-lg sm:rounded-lg">
                    <div class="w-full text-gray-500">
    
                        <div class="bg-blue-500 uppercase text-gray-700 text-white flex justify-between">
                            <h1 class="px-6 py-3">
                                Training Category
                            </h1>
                        </div>
            
                        <div class="border-b bg-white px-6 py-3">
            
                            <div class="flex items-center mb-4">
                                <input id="compentency_training_category_add" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'compentency_training_category_add') ? 'checked' : '' }} value="compentency_training_category_add" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="compentency_training_category_add" class="ml-2 mt-2 text-sm font-medium text-gray-900">Add</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="compentency_training_category_edit" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'compentency_training_category_edit') ? 'checked' : '' }} value="compentency_training_category_edit" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="compentency_training_category_edit" class="ml-2 mt-2 text-sm font-medium text-gray-900">Edit</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="compentency_training_category_delete" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'compentency_training_category_delete') ? 'checked' : '' }} value="compentency_training_category_delete" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="compentency_training_category_delete" class="ml-2 mt-2 text-sm font-medium text-gray-900">Delete</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="compentency_training_category_view" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'compentency_training_category_view') ? 'checked' : '' }} value="compentency_training_category_view" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="compentency_training_category_view" class="ml-2 mt-2 text-sm font-medium text-gray-900">View</label>
                            </div>
    
                        </div>
                    </div>
                </div>
            </div>

            {{-- Training Secretariat permissions --}}
            <div class="col-span-1">
                <div class="relative my-2 overflow-x-auto shadow-lg sm:rounded-lg">
                    <div class="w-full text-gray-500">
    
                        <div class="bg-blue-500 uppercase text-gray-700 text-white flex justify-between">
                            <h1 class="px-6 py-3">
                                Training Secretariat
                            </h1>
                        </div>
            
                        <div class="border-b bg-white px-6 py-3">
            
                            <div class="flex items-center mb-4">
                                <input id="compentency_training_secretariat_add" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'compentency_training_secretariat_add') ? 'checked' : '' }} value="compentency_training_secretariat_add" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="compentency_training_secretariat_add" class="ml-2 mt-2 text-sm font-medium text-gray-900">Add</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="compentency_training_secretariat_edit" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'compentency_training_secretariat_edit') ? 'checked' : '' }} value="compentency_training_secretariat_edit" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="compentency_training_secretariat_edit" class="ml-2 mt-2 text-sm font-medium text-gray-900">Edit</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="compentency_training_secretariat_delete" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'compentency_training_secretariat_delete') ? 'checked' : '' }} value="compentency_training_secretariat_delete" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="compentency_training_secretariat_delete" class="ml-2 mt-2 text-sm font-medium text-gray-900">Delete</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="compentency_training_secretariat_view" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'compentency_training_secretariat_view') ? 'checked' : '' }} value="compentency_training_secretariat_view" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="compentency_training_secretariat_view" class="ml-2 mt-2 text-sm font-medium text-gray-900">View</label>
                            </div>
    
                        </div>
                    </div>
                </div>
            </div>
    
            {{-- Field Specialization permissions --}}
            <div class="col-span-1">
                <div class="relative my-2 overflow-x-auto shadow-lg sm:rounded-lg">
                    <div class="w-full text-gray-500">
    
                        <div class="bg-blue-500 uppercase text-gray-700 text-white flex justify-between">
                            <h1 class="px-6 py-3">
                                Field Specialization
                            </h1>
                        </div>
            
                        <div class="border-b bg-white px-6 py-3">
            
                            <div class="flex items-center mb-4">
                                <input id="compentency_field_specialization_add" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'compentency_field_specialization_add') ? 'checked' : '' }} value="compentency_field_specialization_add" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="compentency_field_specialization_add" class="ml-2 mt-2 text-sm font-medium text-gray-900">Add</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="compentency_field_specialization_edit" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'compentency_field_specialization_edit') ? 'checked' : '' }} value="compentency_field_specialization_edit" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="compentency_field_specialization_edit" class="ml-2 mt-2 text-sm font-medium text-gray-900">Edit</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="compentency_field_specialization_delete" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'compentency_field_specialization_delete') ? 'checked' : '' }} value="compentency_field_specialization_delete" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="compentency_field_specialization_delete" class="ml-2 mt-2 text-sm font-medium text-gray-900">Delete</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="compentency_field_specialization_view" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'compentency_field_specialization_view') ? 'checked' : '' }} value="compentency_field_specialization_view" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="compentency_field_specialization_view" class="ml-2 mt-2 text-sm font-medium text-gray-900">View</label>
                            </div>
    
                        </div>
                    </div>
                </div>
            </div>

            {{-- Resource Speaker permissions --}}
            <div class="col-span-1">
                <div class="relative my-2 overflow-x-auto shadow-lg sm:rounded-lg">
                    <div class="w-full text-gray-500">
    
                        <div class="bg-blue-500 uppercase text-gray-700 text-white flex justify-between">
                            <h1 class="px-6 py-3">
                                Resource Speaker
                            </h1>
                        </div>
            
                        <div class="border-b bg-white px-6 py-3">
            
                            <div class="flex items-center mb-4">
                                <input id="compentency_resource_speaker_add" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'compentency_resource_speaker_add') ? 'checked' : '' }} value="compentency_resource_speaker_add" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="compentency_resource_speaker_add" class="ml-2 mt-2 text-sm font-medium text-gray-900">Add</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="compentency_resource_speaker_edit" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'compentency_resource_speaker_edit') ? 'checked' : '' }} value="compentency_resource_speaker_edit" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="compentency_resource_speaker_edit" class="ml-2 mt-2 text-sm font-medium text-gray-900">Edit</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="compentency_resource_speaker_delete" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'compentency_resource_speaker_delete') ? 'checked' : '' }} value="compentency_resource_speaker_delete" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="compentency_resource_speaker_delete" class="ml-2 mt-2 text-sm font-medium text-gray-900">Delete</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="compentency_resource_speaker_view" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'compentency_resource_speaker_view') ? 'checked' : '' }} value="compentency_resource_speaker_view" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="compentency_resource_speaker_view" class="ml-2 mt-2 text-sm font-medium text-gray-900">View</label>
                            </div>
    
                        </div>
                    </div>
                </div>
            </div>

            {{-- Training Session permissions --}}
            <div class="col-span-1">
                <div class="relative my-2 overflow-x-auto shadow-lg sm:rounded-lg">
                    <div class="w-full text-gray-500">
    
                        <div class="bg-blue-500 uppercase text-gray-700 text-white flex justify-between">
                            <h1 class="px-6 py-3">
                                Training Session
                            </h1>
                        </div>
            
                        <div class="border-b bg-white px-6 py-3">
            
                            <div class="flex items-center mb-4">
                                <input id="compentency_training_session_add" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'compentency_training_session_add') ? 'checked' : '' }} value="compentency_training_session_add" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="compentency_training_session_add" class="ml-2 mt-2 text-sm font-medium text-gray-900">Add</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="compentency_training_session_edit" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'compentency_training_session_edit') ? 'checked' : '' }} value="compentency_training_session_edit" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="compentency_training_session_edit" class="ml-2 mt-2 text-sm font-medium text-gray-900">Edit</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="compentency_training_session_delete" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'compentency_training_session_delete') ? 'checked' : '' }} value="compentency_training_session_delete" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="compentency_training_session_delete" class="ml-2 mt-2 text-sm font-medium text-gray-900">Delete</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="compentency_training_session_view" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'compentency_training_session_view') ? 'checked' : '' }} value="compentency_training_session_view" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="compentency_training_session_view" class="ml-2 mt-2 text-sm font-medium text-gray-900">View</label>
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
                                <input id="compentency_ces_training_add" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'compentency_ces_training_add') ? 'checked' : '' }} value="compentency_ces_training_add" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="compentency_ces_training_add" class="ml-2 mt-2 text-sm font-medium text-gray-900">Add</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="compentency_ces_training_edit" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'compentency_ces_training_edit') ? 'checked' : '' }} value="compentency_ces_training_edit" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="compentency_ces_training_edit" class="ml-2 mt-2 text-sm font-medium text-gray-900">Edit</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="compentency_ces_training_delete" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'compentency_ces_training_delete') ? 'checked' : '' }} value="compentency_ces_training_delete" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="compentency_ces_training_delete" class="ml-2 mt-2 text-sm font-medium text-gray-900">Delete</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="compentency_ces_training_view" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'compentency_ces_training_view') ? 'checked' : '' }} value="compentency_ces_training_view" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="compentency_ces_training_view" class="ml-2 mt-2 text-sm font-medium text-gray-900">View</label>
                            </div>
    
                        </div>
                    </div>
                </div>
            </div>

        </div>
    
        <div class="flex justify-center mt-3">
            <button type="button" class="btn btn-primary" id="competency_permissions_btn" onclick="openConfirmationDialog(this, 'Confirm Permissions', 'Are you sure you want to submit/update this permissions?')">Save Permissions</button>
        </div>
    
    </form>
</div>

@endsection
