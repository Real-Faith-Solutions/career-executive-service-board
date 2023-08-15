@extends('layouts.app')
@section('title', 'Competency Contact Information')
@section('sub', 'Contact Information')
@section('content')
@include('admin.competency.view_profile.header', ['cesno'=>$cesno])
<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Contact Informations
            </h1>
        </div>

        <div class="bg-white px-6 py-3">

            <form action="{{ route('competency-contact-email.update', ['cesno'=>$cesno]) }}" method="POST" id="competency_email_contact_info_form" onsubmit="return checkErrorsBeforeSubmit(competency_email_contact_info_form)">
                @method('PUT')
                @csrf

                <div class="mb-3 flex justify-between">
                    <div class="sm:gid-cols-1 mb-3  grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                        <div class="mb-3">
                            <label for="email">Official Email<sup>*</sup></label>
                            <input id="email" type="email" name="email" type="text" value="{{ old('email') ?? ($email ?? '') }} " oninput="validateInputEmail(email)" onkeypress="validateInputEmail(email)" onblur="checkErrorMessage(email)">
                            <p class="input_error text-red-600"></p>
                            @error('email')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="button" class="btn btn-primary" id="competencyEmailUpdateContactsButton" onclick="openConfirmationDialog(this, 'Confirm Contacts', 'Are you sure you want to submit/update this info?')">
                            Save changes
                        </button>
                    </div>
                </div>
            </form>

            @if ($contacts)
                <form action="{{ route('competency-view-profile-contact-info.update', ['ctrlno'=>$contacts->ctrlno, 'cesno'=>$cesno]) }}" method="POST" id="competency_contact_info_form" onsubmit="return checkErrorsBeforeSubmit(competency_contact_info_form)">
            @else
                <form action="{{ route('competency-view-profile-contact-info.store', ['cesno'=>$cesno]) }}" method="POST" id="competency_contact_info_form" onsubmit="return checkErrorsBeforeSubmit(competency_contact_info_form)">
            @endif

                @csrf

                <div class="sm:gid-cols-1 mb-3  grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="official_mobile_number1">Official Mobile No. #1<sup>*</sup></label>
                        <input id="competency_official_mobile_number1" name="official_mobile_number1" type="text" value="{{ old('official_mobile_number1') ?? ($contacts->official_mobile_number1 ?? '') }}" oninput="validateInput(competency_official_mobile_number1, 10, 'all')" onkeypress="validateInput(competency_official_mobile_number1, 10, 'all')" onblur="checkErrorMessage(competency_official_mobile_number1)" required>
                        <p class="input_error text-red-600"></p>
                        @error('official_mobile_number1')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="official_mobile_number2">Official Mobile No. #2</label>
                        <input id="competency_official_mobile_number2" name="official_mobile_number2" type="text" value="{{ old('official_mobile_number2') ?? ($contacts->official_mobile_number2 ?? '') }}" oninput="validateInput(competency_official_mobile_number2, 0, 'all')" onkeypress="validateInput(competency_official_mobile_number2, 0, 'all')" onblur="checkErrorMessage(competency_official_mobile_number2)">
                        <p class="input_error text-red-600"></p>
                        @error('official_mobile_number2')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                    </div>
                </div>

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="personal_mobile_number1">Personal Mobile No. #1<sup>*</sup></label>
                        <input id="competency_personal_mobile_number1" name="personal_mobile_number1" type="text" value="{{ old('personal_mobile_number1') ?? ($contacts->personal_mobile_number1 ?? '') }}" oninput="validateInput(competency_personal_mobile_number1, 10, 'all')" onkeypress="validateInput(competency_personal_mobile_number1, 10, 'all')" onblur="checkErrorMessage(competency_personal_mobile_number1)" required>
                        <p class="input_error text-red-600"></p>
                        @error('personal_mobile_number1')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="personal_mobile_number2">Personal Mobile No. #2</label>
                        <input id="competency_personal_mobile_number2" name="personal_mobile_number2" type="text" value="{{ old('personal_mobile_number2') ?? ($contacts->personal_mobile_number2 ?? '') }}" oninput="validateInput(competency_personal_mobile_number2, 0, 'all')" onkeypress="validateInput(competency_personal_mobile_number2, 0, 'all')" onblur="checkErrorMessage(competency_personal_mobile_number2)">
                        <p class="input_error text-red-600"></p>
                        @error('personal_mobile_number2')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                    </div>
                </div>

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="office_telephone_number">Office Telephone No.<sup>*</sup></label>
                        <input id="competency_office_telephone_number" name="office_telephone_number" type="text" value="{{ old('office_telephone_number') ?? ($contacts->office_telephone_number ?? '') }}" oninput="validateInput(competency_office_telephone_number, 0, 'all')" onkeypress="validateInput(competency_office_telephone_number, 0, 'all')" onblur="checkErrorMessage(competency_office_telephone_number)">
                        <p class="input_error text-red-600"></p>
                        @error('office_telephone_number')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                    </div>
                    <div class="mb-3">
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="button" class="btn btn-primary" id="competencyUpdateContactsButton" onclick="openConfirmationDialog(this, 'Confirm Contacts', 'Are you sure you want to submit/update this info?')">
                        Save changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
