@extends('layouts.app')
@section('title', 'Competency Contact Information')
@section('sub', 'Contact Information')
@section('content')
@include('admin.competency.view_profile.header', ['cesno'=>$cesno])

@if(!is_null($addressProfileMailing))
    @php
        
        $regionMailingCompetency = $addressProfileMailing->region_code;
        $cityMailingCompetency = $addressProfileMailing->city_or_municipality_code;
        $brgyMailingCompetency = $addressProfileMailing->brgy_code;
        $zip_code_MailingCompetency = $addressProfileMailing->zip_code;
        $street_lot_bldg_floor_MailingCompetency = $addressProfileMailing->street_lot_bldg_floor;
    
    @endphp
@else
    @php 

        $regionMailingCompetency = '';
        $cityMailingCompetency = '';
        $brgyMailingCompetency = '';
        $zip_code_MailingCompetency = '';
        $street_lot_bldg_floor_MailingCompetency = '';

    @endphp
@endif

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
               Personal Email
            </h1>
        </div>
        
        <div class="bg-white px-6 py-3">
            <form action="{{ route('competency-contact-email.update', ['cesno'=>$cesno]) }}" method="POST" id="competency_email_contact_info_form" onsubmit="return checkErrorsBeforeSubmit(competency_email_contact_info_form)">
                @method('PUT')
                @csrf

                <div class="mb-3">
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

                    <div class="flex justify-end">
                        <button type="button" class="btn btn-primary" id="competencyEmailUpdateContactsButton" onclick="openConfirmationDialog(this, 'Confirm Email', 'Are you sure you want to submit/update this info?')">
                            Save changes
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Contact Informations
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            @if ($contacts)
                <form action="{{ route('competency-view-profile-contact-info.update', ['ctrlno'=>$contacts->ctrlno, 'cesno'=>$cesno]) }}" method="POST" id="competency_contact_info_form" onsubmit="return checkErrorsBeforeSubmit(competency_contact_info_form)">
            @else
                <form action="{{ route('competency-view-profile-contact-info.store', ['cesno'=>$cesno]) }}" method="POST" id="competency_contact_info_form" onsubmit="return checkErrorsBeforeSubmit(competency_contact_info_form)">
            @endif

                @csrf

                <div class="sm:gid-cols-1 mb-3  grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="official_mobile_number1">Official Mobile No. #1<sup>*</sup></label>
                        <input id="competency_official_mobile_number1" name="official_mobile_number1" type="text" value="{{ old('official_mobile_number1') ?? ($contacts->official_mobile_number1 ?? '') }}" oninput="validateInput(competency_official_mobile_number1, 10, 'numbersWithSpecial')" onkeypress="validateInput(competency_official_mobile_number1, 10, 'numbersWithSpecial')" onblur="checkErrorMessage(competency_official_mobile_number1)" required>
                        <p class="input_error text-red-600"></p>
                        @error('official_mobile_number1')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="official_mobile_number2">Official Mobile No. #2</label>
                        <input id="competency_official_mobile_number2" name="official_mobile_number2" type="text" value="{{ old('official_mobile_number2') ?? ($contacts->official_mobile_number2 ?? '') }}" oninput="validateInput(competency_official_mobile_number2, 10, 'numbersWithSpecial')" onkeypress="validateInput(competency_official_mobile_number2, 10, 'numbersWithSpecial')" onblur="checkErrorMessage(competency_official_mobile_number2)">
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
                        <input id="competency_personal_mobile_number1" name="personal_mobile_number1" type="text" value="{{ old('personal_mobile_number1') ?? ($contacts->personal_mobile_number1 ?? '') }}" oninput="validateInput(competency_personal_mobile_number1, 10, 'numbersWithSpecial')" onkeypress="validateInput(competency_personal_mobile_number1, 10, 'numbersWithSpecial')" onblur="checkErrorMessage(competency_personal_mobile_number1)" required>
                        <p class="input_error text-red-600"></p>
                        @error('personal_mobile_number1')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="personal_mobile_number2">Personal Mobile No. #2</label>
                        <input id="competency_personal_mobile_number2" name="personal_mobile_number2" type="text" value="{{ old('personal_mobile_number2') ?? ($contacts->personal_mobile_number2 ?? '') }}" oninput="validateInput(competency_personal_mobile_number2, 10, 'numbersWithSpecial')" onkeypress="validateInput(competency_personal_mobile_number2, 10, 'numbersWithSpecial')" onblur="checkErrorMessage(competency_personal_mobile_number2)">
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
                        <input id="competency_office_telephone_number" name="office_telephone_number" type="text" value="{{ old('office_telephone_number') ?? ($contacts->office_telephone_number ?? '') }}" oninput="validateInput(competency_office_telephone_number, 10, 'numbersWithSpecial')" onkeypress="validateInput(competency_office_telephone_number, 10, 'numbersWithSpecial')" onblur="checkErrorMessage(competency_office_telephone_number)">
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

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Mailing Address
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="{{ route('add-address-mailing-201', ['cesno'=>$cesno]) }}" enctype="multipart/form-data" id="address_mailingCompetency" onsubmit="return checkErrorsBeforeSubmit(address_mailingCompetency)" method="POST">
                @csrf
                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
            
                    <div class="mb-3">
                        <label for="regionsSelectMailingCompetency">Region<sup>*</span></label>
                        <select id="regionsSelectMailingCompetency" name="regionsSelectMailing" required>
                            @if ($regionMailingCompetency != '')
                                <option value="{{ $regionMailingCompetency }}" selected></option>
                            @else
                                <option disabled selected>Select Region</option>
                            @endif
                        </select>
                    </div>
            
                    <div class="mb-3">
                        <label for="citySelectMailingCompetency">City or Municipality<sup>*</span></label>
                        <select id="citySelectMailingCompetency" name="citySelectMailing" required>
                            @if ($cityMailingCompetency != '')
                                <option value="{{ $cityMailingCompetency }}" selected></option>
                            @else
                                <option disabled selected>Select City or Municipality</option>
                            @endif
                        </select>
                    </div>
            
                    <div class="mb-3">
                        <label for="brgySelectMailingCompetency">Barangay<sup>*</span></label>
                        <select id="brgySelectMailingCompetency" name="brgySelectMailing" required>
                            @if ($brgyMailingCompetency != '')
                                <option value="{{ $brgyMailingCompetency }}" selected></option>
                            @else
                                <option disabled selected>Select Barangay</option>
                            @endif
                        </select>
                    </div>
                </div>
            
                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="zip_code_MailingCompetency">Zip code<sup>*</span></label>
                        <input id="zip_code_MailingCompetency" name="zip_code_Mailing" type="text" value="{{ $zip_code_MailingCompetency }}" oninput="validateInput(zip_code_MailingCompetency, 4, 'numbers')" onkeypress="validateInput(zip_code_MailingCompetency, 4, 'numbers')" onblur="checkErrorMessage(zip_code_MailingCompetency)" required>
                        <p class="input_error text-red-600"></p>
                        @error('zip_code_MailingCompetency')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
            
                    <div class="mb-3 col-span-2">
                        <label for="street_lot_bldg_floor_MailingCompetency">Street/Lot no./Building/Floor no.</label>
                        <input id="street_lot_bldg_floor_MailingCompetency" name="street_lot_bldg_floor_Mailing" type="text" value="{{ $street_lot_bldg_floor_MailingCompetency }}" oninput="validateInput(street_lot_bldg_floor_MailingCompetency, 4)" onkeypress="validateInput(street_lot_bldg_floor_MailingCompetency, 4)" onblur="checkErrorMessage(street_lot_bldg_floor_MailingCompetency)" required>
                        <p class="input_error text-red-600"></p>
                        @error('street_lot_bldg_floor_MailingCompetency')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="button" class="btn btn-primary" id="updateMailingAddressButtonCompetency" onclick="openConfirmationDialog(this, 'Confirm Address', 'Are you sure you want to submit/update this info?')">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
