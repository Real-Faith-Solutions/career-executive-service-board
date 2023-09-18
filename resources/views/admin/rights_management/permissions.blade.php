@extends('layouts.app')
@section('title', 'User Roles')
@section('sub', 'User Roles')
@section('content')

<nav class="bg-gray-200 border-gray-200 dark:bg-gray-800 mb-3">
    <div class="flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="#" class="flex items-center">
            <span class="self-center text-2xl font-semibold whitespace-nowrap uppercase text-blue-500">{{ $role_title }} Permissions</span>
        </a>

        <div class="flex justify-end">
            <a href="{{ route('roles.index') }}" class="btn btn-primary">Back</a>
        </div>
    </div>
</nav>

<div class="table-language-dialect relative overflow-x-auto sm:rounded-lg shadow-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Permissions
                </th>

                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>
        <tbody>

            <tr class="border-b bg-white hover:bg-slate-400 hover:text-white uppercase">
                <td class="px-6 py-3">
                    201 Profiling
                </td>

                <td class="px-6 py-4 text-right uppercase">
                    <div class="flex justify-end">
                        <a href="{{ route('permissions.profiling', ['role_name' => $role_name, 'role_title' => $role_title]) }}" class="font-medium hover:text-blue-300">View</a>
                    </div>
                </td>
            </tr>

            <tr class="border-b bg-white hover:bg-slate-400 hover:text-white uppercase">
                <td class="px-6 py-3">
                    Competency
                </td>

                <td class="px-6 py-4 text-right uppercase">
                    <div class="flex justify-end">
                        <a href="{{ route('permissions.competency', ['role_name' => $role_name, 'role_title' => $role_title]) }}" class="font-medium hover:text-blue-300">View</a>
                    </div>
                </td>
            </tr>

            <tr class="border-b bg-white hover:bg-slate-400 hover:text-white uppercase">
                <td class="px-6 py-3">
                    Plantilla
                </td>

                <td class="px-6 py-4 text-right uppercase">
                    <div class="flex justify-end">
                        <a href="{{ route('permissions.plantilla', ['role_name' => $role_name, 'role_title' => $role_title]) }}" class="font-medium hover:text-blue-300">View</a>
                    </div>
                </td>
            </tr>

            <tr class="border-b bg-white hover:bg-slate-400 hover:text-white uppercase">
                <td class="px-6 py-3">
                    Reports
                </td>

                <td class="px-6 py-4 text-right uppercase">
                    <div class="flex justify-end">
                        <a href="{{ route('permissions.reports', ['role_name' => $role_name, 'role_title' => $role_title]) }}" class="font-medium hover:text-blue-300">View</a>
                    </div>
                </td>
            </tr>

        </tbody>
    </table>
</div>

@endsection
