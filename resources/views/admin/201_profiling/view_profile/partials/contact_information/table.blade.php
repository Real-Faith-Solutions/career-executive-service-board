@extends('layouts.app')
@section('title', 'Create 201 profile')
@section('content')

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Contact Informations
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="{{ route('contact-info.store', ['cesno'=>$cesno]) }}" method="POST">
                @csrf

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="gsis">Official Email<sup>*</sup></label>
                        <input id="official_email" name="official_email" type="text" value="{{ old('official_email') ?? ($contacts->official_email ?? '') }}" oninput="validateInput(official_email, 9, 'all')" onkeypress="validateInput(official_email, 9, 'all')" onblur="checkErrorMessage(official_email)" required>
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
                    </div>
                    <div class="mb-3">
                        <label for="sss_no">Official Mobile No. #2</label>
                        <input id="official_mobile_number2" name="official_mobile_number2" type="text" value="{{ old('official_mobile_number2') ?? ($contacts->official_mobile_number2 ?? '') }}" oninput="validateInput(official_mobile_number2, 9, 'all')" onkeypress="validateInput(official_mobile_number2, 9, 'all')" onblur="checkErrorMessage(official_mobile_number2)">
                        <p class="input_error text-red-600"></p>
                    </div>
                    <div class="mb-3">
                    </div>
                </div>

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="sss_no">Personal Mobile No. #1<sup>*</sup></label>
                        <input id="personal_mobile_number1" name="personal_mobile_number1" type="text" value="{{ old('personal_mobile_number1') ?? ($contacts->personal_mobile_number1 ?? '') }}" oninput="validateInput(personal_mobile_number1, 9, 'all')" onkeypress="validateInput(personal_mobile_number1, 9, 'all')" onblur="checkErrorMessage(personal_mobile_number1)" required>
                        <p class="input_error text-red-600"></p>
                    </div>
                    <div class="mb-3">
                        <label for="sss_no">Personal Mobile No. #2</label>
                        <input id="personal_mobile_number2" name="personal_mobile_number2" type="text" value="{{ old('personal_mobile_number2') ?? ($contacts->personal_mobile_number2 ?? '') }}" oninput="validateInput(personal_mobile_number2, 9, 'all')" onkeypress="validateInput(personal_mobile_number2, 9, 'all')" onblur="checkErrorMessage(personal_mobile_number2)">
                        <p class="input_error text-red-600"></p>
                    </div>
                    <div class="mb-3">
                    </div>
                </div>

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="sss_no">Office Telephone No.<sup>*</sup></label>
                        <input id="office_telephone_number" name="office_telephone_number" type="text" value="{{ old('office_telephone_number') ?? ($contacts->office_telephone_number ?? '') }}" oninput="validateInput(office_telephone_number, 9, 'all')" onkeypress="validateInput(office_telephone_number, 9, 'all')" onblur="checkErrorMessage(office_telephone_number)">
                        <p class="input_error text-red-600"></p>
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