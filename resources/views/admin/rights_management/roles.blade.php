@extends('layouts.app')
@section('title', 'User Roles')
@section('sub', 'User Roles')
@section('content')

<nav class="bg-gray-200 border-gray-200 dark:bg-gray-800">
    <div class="flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="#" class="flex items-center">
            <span class="self-center text-2xl font-semibold whitespace-nowrap uppercase text-blue-500">User Roles</span>
        </a>
    </div>
</nav>

<div class="my-5 flex justify-end">
    <button class="btn btn-primary" id='add-edit-languages-btn'>Add New Role</button>
</div>

<div class="table-language-dialect relative overflow-x-auto sm:rounded-lg shadow-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Roles
                </th>

                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>
        <tbody>

            @foreach ($roles as $role)
                <tr class="border-b bg-white">
                    <td class="px-6 py-3">
                       {{  $role->role_name }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex justify-end">
                            {{-- <form action="{{ route('language.edit', ['ctrlno'=>$languages->ctrlno, 'cesno'=>$cesno]) }}" method="GET">
                                @csrf
                                <button class="mx-1 font-medium text-blue-600 hover:underline" type="submit">
                                    <lord-icon
                                        src="https://cdn.lordicon.com/bxxnzvfm.json"
                                        trigger="hover"
                                        colors="primary:#3a3347,secondary:#ffc738,tertiary:#f9c9c0,quaternary:#ebe6ef"
                                        style="width:30px;height:30px">
                                    </lord-icon>
                                </button>
                            </form>

                            <form action="{{ route('language.destroy', ['ctrlno'=>$languages->ctrlno]) }}" method="POST" id="delete_language_form{{$languages->ctrlno}}">
                                @csrf
                                @method('DELETE')
                                <button type="button" id="deleteLanguageButton{{$languages->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Deletion', 'Are you sure you want to delete this info?')">
                                    <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
                                    <lord-icon
                                        src="https://cdn.lordicon.com/jmkrnisz.json"
                                        trigger="hover"
                                        colors="primary:#880808"
                                        style="width:24px;height:24px">
                                    </lord-icon>
                                </button>
                            </form> --}}
                            <p>sample</p>
                        </div>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>

<!-- Modal for Adding Language Dialect -->
<div id="add-edit-languages-modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
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
</div>

@endsection
