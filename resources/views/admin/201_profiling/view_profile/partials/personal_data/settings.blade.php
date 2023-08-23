@extends('layouts.app')
@section('title', 'Profile Settings')
@section('sub', 'Profile Settings')
@section('content')
@include('admin.201_profiling.view_profile.header', ['cesno' => $mainProfile->cesno])

<div class="grid-rows-7 grid lg:grid-cols-3 sm:grid-cols-1 gap-1">
    <form class="col-span-3" action="{{ route('edit-profile-201', ['cesno'=>$mainProfile->cesno]) }}" enctype="multipart/form-data" id="edit_personal_data" method="POST" onsubmit="return checkErrorsBeforeSubmit(edit_personal_data)">
        @csrf
        <div class="col-span-3">
            <div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
                <div class="w-full text-left text-gray-500">
                    <div class="bg-blue-500 uppercase text-gray-700 text-white flex justify-between">
                        <h1 class="px-6 py-3 text-left">
                            Change Password
                        </h1>
                    </div>

                    <div class="border-b bg-white px-6 py-3">

                        <div class="mb-3 flex items-center">
                            <label for="email" class="w-1/4">Email<sup>*</sup></label>
                            <input id="email" name="email" readonly value="{{ $mainProfile->email }}" class="w-3/4 px-3 py-2 border rounded">
                        </div>

                        <div class="mb-3 flex items-center">
                            <label for="currentPassword" class="w-1/4">Current Password<sup>*</sup></label>
                            <div class="relative w-3/4">
                                <input id="currentPassword" name="currentPassword" type="password" oninput="validateInput(currentPassword, 8, 'all'), checkPasswordMatch()" onkeypress="validateInput(currentPassword, 8, 'all'), checkPasswordMatch()" onblur="checkErrorMessage(currentPassword), checkPasswordMatch()" required class="w-full px-3 py-2 border rounded pr-10">
                                <i class="far fa-eye absolute top-1/2 right-3 transform -translate-y-1/2 cursor-pointer toggle-password"></i>
                            </div>
                        </div>
                        <p id="currentPasswordError" class="input_error text-red-600"></p>

                        <div class="mb-3 flex items-center">
                            <label for="password" class="w-1/4">New Password<sup>*</sup></label>
                            <div class="relative w-3/4">
                                <input id="password" name="password" type="password" oninput="validateInput(password, 8, 'all'), checkPasswordMatch()" onkeypress="validateInput(password, 8, 'all'), checkPasswordMatch()" onblur="checkErrorMessage(password), checkPasswordMatch()" required class="w-full px-3 py-2 border rounded pr-10">
                                <i class="far fa-eye absolute top-1/2 right-3 transform -translate-y-1/2 cursor-pointer toggle-password"></i>
                            </div>
                        </div>
                        <p id="passwordError" class="input_error text-red-600"></p>
                        
                        <div class="mb-3 flex items-center">
                            <label for="confirmPassword" class="w-1/4">Confirm Password<sup>*</sup></label>
                            <div class="relative w-3/4">
                                <input id="confirmPassword" name="confirmPassword" type="password" oninput="validateInput(confirmPassword, 8, 'all'), checkPasswordMatch()" onkeypress="validateInput(confirmPassword, 8, 'all'), checkPasswordMatch()" onblur="checkErrorMessage(confirmPassword), checkPasswordMatch()" required class="w-full px-3 py-2 border rounded pr-10">
                                <i class="far fa-eye absolute top-1/2 right-3 transform -translate-y-1/2 cursor-pointer toggle-confirm-password"></i>
                            </div>
                        </div>
                        <p id="confirmPasswordError" class="input_error text-red-600"></p>

                        <div class="flex justify-center mt-4">
                            <button class="btn btn-primary w-full md:w-auto" id="personal_data_save" type="submit">Save</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>
</div>


@endsection
