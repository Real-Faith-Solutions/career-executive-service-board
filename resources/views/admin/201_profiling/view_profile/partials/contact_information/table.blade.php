@extends('layouts.app')
@section('title', 'Contact Information')
@section('sub', 'Contact Information')
@section('content')
@include('admin.201_profiling.view_profile.header', ['cesno' => $cesno])
<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Contact Informations
            </h1>
        </div>

        <div class="bg-white px-6 py-3">

            @if ($contacts)
                <form action="{{ route('contact-info.update', ['ctrlno'=>$contacts->ctrlno, 'cesno'=>$cesno]) }}" method="POST" id="contact_info_form" onsubmit="return checkErrorsBeforeSubmit(contact_info_form)">
            @else
                <form action="{{ route('contact-info.store', ['cesno'=>$cesno]) }}" method="POST" id="contact_info_form" onsubmit="return checkErrorsBeforeSubmit(contact_info_form)">
            @endif
                @csrf

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="gsis">Official Email<sup>*</sup></label>
                        <input id="official_email" name="official_email" type="text" value="{{ old('official_email') ?? ($email ?? '') }}" readonly>
                        <p class="input_error text-red-600"></p>
                    </div>
                    <div class="mb-3">
                    </div>
                    <div class="mb-3">
                    </div>
                </div>

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="sss_no">Official Mobile No. #1<sup>*</sup></label>
                        <input id="official_mobile_number1" name="official_mobile_number1" type="text" value="{{ old('official_mobile_number1') ?? ($contacts->official_mobile_number1 ?? '') }}" oninput="validateInput(official_mobile_number1, 9, 'all')" onkeypress="validateInput(official_mobile_number1, 9, 'all')" onblur="checkErrorMessage(official_mobile_number1)" required>
                        <p class="input_error text-red-600"></p>
                        @error('official_mobile_number1')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="sss_no">Official Mobile No. #2</label>
                        <input id="official_mobile_number2" name="official_mobile_number2" type="text" value="{{ old('official_mobile_number2') ?? ($contacts->official_mobile_number2 ?? '') }}" oninput="validateInput(official_mobile_number2, 9, 'all')" onkeypress="validateInput(official_mobile_number2, 9, 'all')" onblur="checkErrorMessage(official_mobile_number2)">
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
                        <label for="sss_no">Personal Mobile No. #1<sup>*</sup></label>
                        <input id="personal_mobile_number1" name="personal_mobile_number1" type="text" value="{{ old('personal_mobile_number1') ?? ($contacts->personal_mobile_number1 ?? '') }}" oninput="validateInput(personal_mobile_number1, 9, 'all')" onkeypress="validateInput(personal_mobile_number1, 9, 'all')" onblur="checkErrorMessage(personal_mobile_number1)" required>
                        <p class="input_error text-red-600"></p>
                        @error('personal_mobile_number1')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="sss_no">Personal Mobile No. #2</label>
                        <input id="personal_mobile_number2" name="personal_mobile_number2" type="text" value="{{ old('personal_mobile_number2') ?? ($contacts->personal_mobile_number2 ?? '') }}" oninput="validateInput(personal_mobile_number2, 9, 'all')" onkeypress="validateInput(personal_mobile_number2, 9, 'all')" onblur="checkErrorMessage(personal_mobile_number2)">
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
                        <label for="sss_no">Office Telephone No.<sup>*</sup></label>
                        <input id="office_telephone_number" name="office_telephone_number" type="text" value="{{ old('office_telephone_number') ?? ($contacts->office_telephone_number ?? '') }}" oninput="validateInput(office_telephone_number, 9, 'all')" onkeypress="validateInput(office_telephone_number, 9, 'all')" onblur="checkErrorMessage(office_telephone_number)">
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
                    <button type="submit" class="btn btn-primary">
                        Save changes
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
