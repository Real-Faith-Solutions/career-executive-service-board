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
                Form Training Provider Manager
            </h1>
        </div>
        
        <div class="bg-white px-6 py-3">
            <form action="{{ route('training-provider-manager.store') }}" method="POST" id="training_provider_manager_form" onsubmit="return checkErrorsBeforeSubmit(training_provider_manager_form)">
                @csrf
                
                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="provider">Training Provider<sup>*</sup></label>
                        <input type="text" id="provider" name="provider" oninput="validateInput(provider, 2, 'letters')" onkeypress="validateInput(provider, 2, 'letters')" onblur="checkErrorMessage(provider)" required>
                        <p class="input_error text-red-600"></p>
                        @error('provider')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="house_building">Address Building<sup>*</sup></label>
                        <input type="text" id="house_building" name="house_building" oninput="validateInput(house_building, 2, 'alphaNumeric')" onkeypress="validateInput(house_building, 2, 'alphaNumeric')" onblur="checkErrorMessage(house_building)" >
                        <p class="input_error text-red-600"></p>
                        @error('house_building')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="st_road">No. Street<sup>*</sup></label>
                        <input type="text" id="st_road" name="st_road" oninput="validateInput(st_road, 2, 'alphaNumeric')" onkeypress="validateInput(st_road, 2, 'alphaNumeric')" onblur="checkErrorMessage(st_road)" >
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
                        <input type="text" id="brgy_vill" name="brgy_vill" oninput="validateInput(brgy_vill, 2, 'alphaNumeric')" onkeypress="validateInput(brgy_vill, 2, 'alphaNumeric')" onblur="checkErrorMessage(brgy_vill)" >
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
                                <option value="{{ $profileLibTblCity->city_code }}">
                                    {{ $profileLibTblCity->name. " - zipcode: " .$profileLibTblCity->zipcode }}
                                </option>
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
                        <input type="text" id="competency_contact_no" name="contact_no" oninput="validateInput(competency_contact_no, 2, 'numbersWithSpecial')" onkeypress="validateInput(competency_contact_no, 2, 'numbersWithSpecial')" onblur="checkErrorMessage(competency_contact_no)" required>
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
                        <input type="text" id="competency_email" name="email" oninput="validateInputEmail(competency_email)" onkeypress="validateInputEmail(competency_email)" onblur="checkErrorMessage(competency_email)" required>
                        <p class="input_error text-red-600"></p>
                        @error('email')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="contact_person">Contact Person<sup>*</sup></label>
                        <input type="text" id="contact_person" name="contact_person" oninput="validateInput(contact_person, 2, 'letters')" onkeypress="validateInput(contact_person, 2, 'letters')" onblur="checkErrorMessage(contact_person)" required>
                        <p class="input_error text-red-600"></p>
                        @error('contact_person')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
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