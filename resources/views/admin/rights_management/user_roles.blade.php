@extends('layouts.app')
@section('title', 'User Roles')
@section('sub', 'User Roles')
@section('content')

<nav class="bg-gray-200 border-gray-200 dark:bg-gray-800 mb-3">
    <div class="flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="#" class="flex items-center">
            <span class="self-center text-2xl font-semibold whitespace-nowrap uppercase text-blue-500">{{ $role_title }}</span>
        </a>

        <div class="flex justify-end">
            <a href="{{ URL::previous() }}" class="btn btn-primary">Back</a>
        </div>
    </div>
</nav>

<div class="table-language-dialect relative overflow-x-auto sm:rounded-lg shadow-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Name
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
                       {{  $user->lastname.' '.$user->firstname }}
                    </td>

                    <td class="px-6 py-3">
                        {{  $user->email }}
                     </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex justify-end">
                            <a href="{{ route('roles.change', ['cesno' => $user->cesno]) }}" class="font-medium">Change Role</a>
                        </div>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>

<!-- Modal for Change Role -->
<div id="change_role_modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
    <div class="modal-content bg-white p-6 rounded-lg shadow-lg">
        <form action="#" method="POST" class="flex flex-col items-center" id="change_role_form" onsubmit="return checkErrorsBeforeSubmit(change_role_form)">
            @csrf

            <span class="close-md absolute top-2 right-2 text-gray-600 cursor-pointer">&times;</span>
            <h2 class="text-2xl font-bold mb-4 text-center">Change Role</h2>

            <div class="sm:gid-cols-1 mb-2 grid gap-4 md:grid-cols-2 lg:grid-cols-1">

                <div class="flex flex-col items-center">
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
                </div>

            </div>
            <button type="submit" id="changeRoleBtn" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Change</button>
        </form>
    </div>
</div>

@endsection
