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

<div id="libraries_permissions" class="">
    
    <form method="POST" id="libraries_permissions_form" action="{{ route('reportsPermissions.update', ['role_name' => $role_name, 'role_title' => $role_title]) }}">
        @csrf
    
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3">
    
            {{-- 201 Profiling Libraries permissions --}}
            <div class="col-span-1">
                <div class="relative my-2 overflow-x-auto shadow-lg sm:rounded-lg">
                    <div class="w-full text-gray-500">
    
                        <div class="bg-blue-500 uppercase text-gray-700 text-white flex justify-between">
                            <h1 class="px-6 py-3">
                                201 Profiling Libraries
                            </h1>
                        </div>
            
                        <div class="border-b bg-white px-6 py-3">
            
                            <div class="flex items-center mb-4">
                                <input id="201_add_library" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', '201_add_library') ? 'checked' : '' }} value="201_add_library" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="201_add_library" class="ml-2 mt-2 text-sm font-medium text-gray-900">Add</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="201_edit_library" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', '201_edit_library') ? 'checked' : '' }} value="201_edit_library" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="201_edit_library" class="ml-2 mt-2 text-sm font-medium text-gray-900">Edit</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="201_delete_library" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', '201_delete_library') ? 'checked' : '' }} value="201_delete_library" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="201_delete_library" class="ml-2 mt-2 text-sm font-medium text-gray-900">Delete</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="201_view_library" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', '201_view_library') ? 'checked' : '' }} value="201_view_library" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="201_view_library" class="ml-2 mt-2 text-sm font-medium text-gray-900">View</label>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
    
            {{-- ERIS Libraries permissions --}}
            <div class="col-span-1">
                <div class="relative my-2 overflow-x-auto shadow-lg sm:rounded-lg">
                    <div class="w-full text-gray-500">
                        
                        <div class="bg-blue-500 uppercase text-gray-700 text-white flex justify-between">
                            <h1 class="px-6 py-3">
                                ERIS Libraries
                            </h1>
                        </div>
            
                        <div class="border-b bg-white px-6 py-3">
            
                            <div class="flex items-center mb-4">
                                <input id="eris_add_library" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'eris_add_library') ? 'checked' : '' }} value="eris_add_library" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="eris_add_library" class="ml-2 mt-2 text-sm font-medium text-gray-900">Add</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="eris_edit_library" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'eris_edit_library') ? 'checked' : '' }} value="eris_edit_library" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="eris_edit_library" class="ml-2 mt-2 text-sm font-medium text-gray-900">Edit</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="eris_delete_library" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'eris_delete_library') ? 'checked' : '' }} value="eris_delete_library" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="eris_delete_library" class="ml-2 mt-2 text-sm font-medium text-gray-900">Delete</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="eris_view_library" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'eris_view_library') ? 'checked' : '' }} value="eris_view_library" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="eris_view_library" class="ml-2 mt-2 text-sm font-medium text-gray-900">View</label>
                            </div>
    
                        </div>
                    </div>
                </div>
            </div>
    
            {{-- Plantilla Libraries permissions --}}
            <div class="col-span-1">
                <div class="relative my-2 overflow-x-auto shadow-lg sm:rounded-lg">
                    <div class="w-full text-gray-500">
    
                        <div class="bg-blue-500 uppercase text-gray-700 text-white flex justify-between">
                            <h1 class="px-6 py-3 text-xm sm:text-sm sm:py-3.5">
                                Plantilla Libraries
                            </h1>
                        </div>
            
                        <div class="border-b bg-white px-6 py-3">
            
                            <div class="flex items-center mb-4">
                                <input id="plantilla_add_library" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'plantilla_add_library') ? 'checked' : '' }} value="plantilla_add_library" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="plantilla_add_library" class="ml-2 mt-2 text-sm font-medium text-gray-900">Add</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="plantilla_edit_library" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'plantilla_edit_library') ? 'checked' : '' }} value="plantilla_edit_library" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="plantilla_edit_library" class="ml-2 mt-2 text-sm font-medium text-gray-900">Edit</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="plantilla_delete_library" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'plantilla_delete_library') ? 'checked' : '' }} value="plantilla_delete_library" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="plantilla_delete_library" class="ml-2 mt-2 text-sm font-medium text-gray-900">Delete</label>
                            </div>
    
                            <div class="flex items-center mb-4">
                                <input id="plantilla_view_library" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'plantilla_view_library') ? 'checked' : '' }} value="plantilla_view_library" class="w-4 h-4 text-blue-600 accent-green-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="plantilla_view_library" class="ml-2 mt-2 text-sm font-medium text-gray-900">View</label>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
    
        </div>
    
        <div class="flex justify-center mt-3">
            <button type="button" class="btn btn-primary" id="libraries_permissions_btn" onclick="openConfirmationDialog(this, 'Confirm Permissions', 'Are you sure you want to submit/update this permissions?')">Save Permissions</button>
        </div>
    
    </form>
</div>

@endsection
