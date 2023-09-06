@extends('layouts.app')
@section('title', 'User Roles')
@section('sub', 'User Roles')
@section('content')

<nav class="bg-gray-200 border-gray-200 dark:bg-gray-800 mb-3">
    <div class="flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="#" class="flex items-center">
            <span class="self-center text-2xl font-semibold whitespace-nowrap uppercase text-blue-500">{{ $role_title }} - 201 Profiling Permissions</span>
        </a>

        <div class="flex justify-end">
            <a href="{{ route('permissions.show', ['role_name' => $role_name, 'role_title' => $role_title]) }}" class="btn btn-primary">Back</a>
        </div>
    </div>
</nav>


{{-- <div class="relative overflow-x-auto sm:rounded-lg shadow-lg">

    <form method="POST" action="#">
        @csrf
        
        <p>Personal Data</p>
            <input type="checkbox" name="permissions[]" value="personal_data_add"
            {{ $permissions->contains('permission_name', 'personal_data_add') ? 'checked' : '' }}>
            Add
        <button type="submit">Save Permissions</button>
    </form>

</div> --}}

<div class="grid lg:grid-cols-4 sm:grid-cols-1 gap-1">

    <div class="col-span-1">
        <div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
            <div class="w-full text-gray-500">
                <div class="bg-blue-500 uppercase text-gray-700 text-white flex justify-between">
                    <h1 class="px-6 py-3">
                        Personal Data
                    </h1>
                </div>
    
                <div class="border-b bg-white px-6 py-3">
    
                    <div class="sm:grid-cols-1 grid gap-2 md:grid-cols-1 lg:grid-cols-1">

                        <div class="flex items-center mb-4">
                            <input id="personal_data_add" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'personal_data_add') ? 'checked' : '' }} value="personal_data_add" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                            <label for="personal_data_add" class="ml-2 mt-2 text-sm font-medium text-gray-900">Add</label>
                        </div>
    
                        <div class="flex items-center mb-4">
                            <input id="personal_data_edit" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'personal_data_edit') ? 'checked' : '' }} value="personal_data_edit" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                            <label for="personal_data_edit" class="ml-2 mt-2 text-sm font-medium text-gray-900">Edit</label>
                        </div>

                        <div class="flex items-center mb-4">
                            <input id="personal_data_delete" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'personal_data_delete') ? 'checked' : '' }} value="personal_data_delete" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                            <label for="personal_data_delete" class="ml-2 mt-2 text-sm font-medium text-gray-900">Delete</label>
                        </div>

                        <div class="flex items-center mb-4">
                            <input id="personal_data_view" type="checkbox" name="permissions[]" {{ $permissions->contains('permission_name', 'personal_data_view') ? 'checked' : '' }} value="personal_data_view" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                            <label for="personal_data_view" class="ml-2 mt-2 text-sm font-medium text-gray-900">View</label>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

@endsection
