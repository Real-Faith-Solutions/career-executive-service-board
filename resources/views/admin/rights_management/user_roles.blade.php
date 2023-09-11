@extends('layouts.app')
@section('title', 'User Roles')
@section('sub', 'User Roles')
@section('content')

<nav class="bg-gray-200 border-gray-200 mb-3">
    <div class="flex flex-wrap items-center justify-between mx-auto p-4">
        {{-- role title --}}
        <a href="#" class="flex items-center">
            <span class="self-center text-2xl font-semibold whitespace-nowrap uppercase text-blue-500">{{ $role_title }}</span>
        </a>

        {{-- search bar --}}
        <div class="flex items-center">
            <form>
                <div class="w-100">
                    <label for="default-search" class="sr-only mb-2 text-sm font-medium text-gray-900">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <button type="submit">
                                <svg aria-hidden="true" class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </button>
                        </div>
                        <input type="search" id="default-search"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-4 pl-10 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Search here..." name="search"
                            @if (!empty($search)) value="{{ $search }}" @endif autofocus autocomplete="search">
                    </div>
                </div>
            </form>
        </div>

        {{-- back button --}}
        <div class="flex justify-end">
            <a href="{{ route('roles.index') }}" class="btn btn-primary">Back</a>
        </div>
    </div>
</nav>

<div class="table-language-dialect relative overflow-x-auto sm:rounded-lg shadow-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    <a href="{{ route('roles.show', ['role_name' => $role_name, 'role_title' => $role_title, 'sort_by' => 'cesno', 'sort_order' => $sortOrder === 'asc' ? 'desc' : 'asc', 'search' => $search]) }}" class="flex items-center space-x-1">
                        Ces No.
                        @if ($sortBy === 'cesno')
                            @if ($sortOrder === 'asc')
                                <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                                </svg>
                            @else
                                <svg class="w-4 h-4 text-white transform rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                                </svg>
                            @endif
                        @endif
                    </a>
                </th>

                <th scope="col" class="px-6 py-3">
                    <a href="{{ route('roles.show', ['role_name' => $role_name, 'role_title' => $role_title, 'sort_by' => 'lastname', 'sort_order' => $sortOrder === 'asc' ? 'desc' : 'asc', 'search' => $search]) }}" class="flex items-center space-x-1">
                        Name
                        @if ($sortBy === 'lastname')
                            @if ($sortOrder === 'asc')
                                <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                                </svg>
                            @else
                                <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                                </svg>
                            @endif
                        @endif
                    </a>
                </th>

                <th scope="col" class="px-6 py-3">
                    Email
                </th>

                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>
        <tbody>

            @foreach ($usersOnThisRole as $user)
                <tr class="border-b bg-white hover:bg-slate-400 hover:text-white">
                    <td class="px-6 py-3">
                        {{  $user->cesno }}
                     </td>

                    <td class="px-6 py-3">
                       {{  $user->lastname.' '.$user->firstname }}
                    </td>

                    <td class="px-6 py-3">
                        {{  $user->email }}
                     </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex justify-end">
                            {{-- <a href="{{ route('roles.change', ['cesno' => $user->cesno]) }}" class="font-medium">Change Role</a> --}}
                            <button  title="Change Role" id="changeRoleBtn" class="font-medium" onclick="showModalChangeRole('{{ $user->lastname.' '.$user->firstname }}', '{{ $user->email }}', '{{ $user->cesno }}')">
                                {{-- Change Role --}}
                                <lord-icon
                                    src="https://cdn.lordicon.com/uiakkykh.json"
                                    trigger="hover"
                                    colors="primary:#000000"
                                    style="width:34px;height:34px">
                                </lord-icon>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
    <div class="m-5">
        {{ $usersOnThisRole->links() }}
    </div>
</div>

<!-- Modal for Change Role -->
<div id="change_role_modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
    <div class="modal-content bg-white p-6 rounded-lg shadow-lg">
        <form action="{{ route('roles.change') }}" method="POST" class="flex flex-col items-center" id="change_role_form" onsubmit="return checkErrorsBeforeSubmit(change_role_form)">
            @csrf

            <span class="close-md absolute top-2 right-2 text-gray-600 cursor-pointer">&times;</span>
            <h2 class="text-2xl font-bold mb-4 text-center">Change Role</h2>

            <div class="sm:gid-cols-1 mb-2 grid gap-4 md:grid-cols-2 lg:grid-cols-1">

                <div class="flex flex-col items-center">

                    <label for="change_role_name">Name<sup>*</sup></label>
                    <input id="change_role_name" name="change_role_name" type="text" class="mb-2" readonly required>

                    <label for="change_role_email">Email<sup>*</sup></label>
                    <input id="change_role_email" name="change_role_email" type="text" class="mb-2" readonly required>

                    <label for="new_role">Role<sup>*</sup></label>
                    <select id="new_role" name="new_role" required>
                        <option disabled selected>Select Role</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->role_name }}">
                                {{ $role->role_title }}
                            </option>
                        @endforeach
                    </select>
                    @error('new_role')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                    @enderror

                    <input type="number" id="change_role_cesno" name="change_role_cesno" value="none" class="invisible">
                </div>

            </div>

            <button type="submit" id="changeRoleSubmitBtn" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Change</button>
        </form>
    </div>
</div>

@endsection
