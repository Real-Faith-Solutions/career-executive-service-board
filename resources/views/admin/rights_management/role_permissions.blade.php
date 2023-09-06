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


<div class="relative overflow-x-auto sm:rounded-lg shadow-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Permissions
                </th>
            </tr>
        </thead>
        <tbody>

            @foreach ($permissions as $permission)

                <tr class="border-b bg-white hover:bg-slate-400 hover:text-white uppercase">
                    <td class="px-6 py-3">
                        {{ $permission->permission_name }}
                    </td>
                </tr>
                
            @endforeach

        </tbody>
    </table>
</div>

@endsection
