@extends('layouts.app')
@section('title', 'User Roles')
@section('sub', 'User Roles')
@section('content')

<nav class="bg-gray-200 border-gray-200 mb-3">
    <div class="flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="#" class="flex items-center">
            <span class="self-center text-2xl font-semibold whitespace-nowrap uppercase text-blue-500">Roles List</span>
        </a>
    </div>
</nav>

{{-- <div class="my-5 flex justify-end">
    <button class="btn btn-primary" id='add-edit-languages-btn'>Add New Role</button>
</div> --}}

<div class="table-language-dialect relative overflow-x-auto sm:rounded-lg shadow-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Roles
                </th>

                {{-- <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Permissions</span>
                </th> --}}

                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Assignees</span>
                </th>
            </tr>
        </thead>
        <tbody>

            @foreach ($roles as $role)
                <tr class="border-b bg-white hover:bg-slate-400 hover:text-white uppercase">
                    <td class="px-6 py-3">
                       {{  $role->role_title }}
                    </td>

                    {{-- <td class="px-6 py-4 text-right uppercase">
                        <div class="flex justify-end">
                            <a href="{{ route('roles.show', ['role_name' => $role->role_name, 'role_title' => $role->role_title]) }}" class="font-medium">Permissions</a>
                        </div>
                    </td> --}}

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex justify-end">
                            <a href="{{ route('permissions.show', ['role_name' => $role->role_name, 'role_title' => $role->role_title]) }}" class="font-medium mr-5 hover:text-blue-300" title="Permissions">
                                <lord-icon
                                    src="https://cdn.lordicon.com/dnmvmpfk.json"
                                    trigger="hover"
                                    colors="primary:#000000"
                                    style="width:34px;height:34px">
                                </lord-icon>
                            </a>

                            <a href="{{ route('roles.show', ['role_name' => $role->role_name, 'role_title' => $role->role_title]) }}" class="font-medium hover:text-blue-300" title="Assignees">
                                <lord-icon
                                    src="https://cdn.lordicon.com/bhfjfgqz.json"
                                    trigger="hover"
                                    colors="primary:#000000"
                                    style="width:34px;height:34px">
                                </lord-icon>
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>

<!-- Modal for Adding Language Dialect -->
{{-- <div id="add-edit-languages-modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
    <div class="modal-content bg-white p-6 rounded-lg shadow-lg">
        <form action="#" method="POST" class="flex flex-col items-center" id="new_role_form" onsubmit="return checkErrorsBeforeSubmit(new_role_form)">
            @csrf

            <span class="close-md absolute top-2 right-2 text-gray-600 cursor-pointer">&times;</span>
            <h2 class="text-2xl font-bold mb-4 text-center">Add New Role</h2>

            <div class="sm:gid-cols-1 mb-2 grid gap-4 md:grid-cols-2 lg:grid-cols-1">

                <div class="flex flex-col items-center">
                    <label for="new_role">New Role<sup>*</sup></label>
                    <input id="new_role" name="new_role" type="text" value="{{ old('new_role') }}" oninput="validateInput(new_role, 2, 'letters')" onkeypress="validateInput(new_role, 2, 'letters')" onblur="checkErrorMessage(new_role)" required>
                    <p class="input_error text-red-600"></p>
                    @error('new_role')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                    @enderror
                </div>

            </div>
            <button type="submit" id="addLanguagesBtn" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">ADD</button>
        </form>
    </div>
</div> --}}

@endsection
