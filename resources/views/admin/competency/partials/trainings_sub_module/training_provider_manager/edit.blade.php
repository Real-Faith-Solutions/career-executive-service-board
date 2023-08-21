@extends('layouts.app')
@section('title', 'Form Training Provider Manager')
@section('sub', 'Form Training Provider Manager')
@section('content')
@include('admin.competency.view_profile.header')

<div class="flex justify-end">
    <a href="{{ route('training-provider-manager.index') }}" class="btn btn-primary" >Go back</a>
</div>

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Update Form Training Provider Manager
            </h1>
        </div>
        
        <div class="bg-white px-6 py-3">
            <form action="{{ route('training-provider-manager.update', ['ctrlno'=>$trainingProvider->providerID]) }}" method="POST" id="training_provider_manager_edit_form" onsubmit="return checkErrorsBeforeSubmit(training_provider_manager_edit_form)">
                @csrf
                @method('PUT')
                
                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="provider">Training Provider<sup>*</sup></label>
                        <input type="text" id="edit_provider" name="provider" oninput="validateInput(edit_provider, 2, 'letters')" onkeypress="validateInput(edit_provider, 2, 'letters')" onblur="checkErrorMessage(edit_provider)" value="{{ $trainingProvider->provider }}" required>
                        <p class="input_error text-red-600"></p>
                        @error('provider')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="house_building">Address Building<sup>*</sup></label>
                        <input type="text" id="edit_house_building" name="house_building" oninput="validateInput(edit_house_building, 2, 'alphaNumeric')" onkeypress="validateInput(edit_house_building, 2, 'alphaNumeric')" onblur="checkErrorMessage(edit_house_building)" value="{{ $trainingProvider->house_bldg }}" >
                        <p class="input_error text-red-600"></p>
                        @error('house_building')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="st_road">No. Street<sup>*</sup></label>
                        <input type="text" id="edit_st_road" name="st_road" oninput="validateInput(edit_st_road, 2, 'alphaNumeric')" onkeypress="validateInput(edit_st_road, 2, 'alphaNumeric')" onblur="checkErrorMessage(edit_st_road)" value="{{ $trainingProvider->st_road }}">
                        <p class="input_error text-red-600"></p>
                        @error('st_road')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="brgy_vill">Barangay<sup>*</sup></label>
                        <input type="text" id="edit_brgy_vill" name="brgy_vill" oninput="validateInput(edit_brgy_vill, 2, 'alphaNumeric')" onkeypress="validateInput(edit_brgy_vill, 2, 'alphaNumeric')" onblur="checkErrorMessage(edit_brgy_vill)" value="{{ $trainingProvider->brgy_vill }}">
                        <p class="input_error text-red-600"></p>
                        @error('brgy_vill')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="city_code">City/Province<sup>*</sup></label>
                        <select id="city_code" name="city_code" required>
                            <option disabled selected>Select Specialization</option>
                            @foreach($profileLibTblCities as $profileLibTblCity)
                                @if ($profileLibTblCity->city_code == $trainingProvider->city_code)
                                    <option value="{{ $profileLibTblCity->city_code }}" selected>
                                        {{ $profileLibTblCity->name. " - zipcode: " .$profileLibTblCity->zipcode }}
                                    </option>
                                @else
                                    <option value="{{ $profileLibTblCity->city_code }}">
                                        {{ $profileLibTblCity->name. " - zipcode: " .$profileLibTblCity->zipcode }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        <p class="input_error text-red-600"></p>
                        @error('city_code')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="contact_no">Contact No.<sup>*</sup></label>
                        <input type="text" id="edit_competency_contact_no" name="contact_no" oninput="validateInput(edit_competency_contact_no, 2, 'numbersWithSpecial')" onkeypress="validateInput(edit_competency_contact_no, 2, 'numbersWithSpecial')" onblur="checkErrorMessage(edit_competency_contact_no)"  
                        value="{{ $trainingProvider->contactno }}" required>
                        <p class="input_error text-red-600"></p>
                        @error('contact_no')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="email">Email<sup>*</sup></label>
                        <input type="text" id="edit_competency_email" name="email" oninput="validateInputEmail(edit_competency_email)" onkeypress="validateInputEmail(edit_competency_email)" onblur="checkErrorMessage(edit_competency_email)" value="{{ $trainingProvider->emailadd }}" required>
                        <p class="input_error text-red-600"></p>
                        @error('email')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="contact_person">Contact Person<sup>*</sup></label>
                        <input type="text" id="edit_contact_person" name="contact_person" oninput="validateInput(edit_contact_person, 2, 'letters')" onkeypress="validateInput(edit_contact_person, 2, 'letters')" onblur="checkErrorMessage(edit_contact_person)" value="{{ $trainingProvider->contactperson }}" required>
                        <p class="input_error text-red-600"></p>
                        @error('contact_person')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="button" class="btn btn-primary" id="updateTrainingProviderManagerButton" onclick="openConfirmationDialog(this, 'Confirm Changes', 'Are you sure you want to update this info?')">
                        Update changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection