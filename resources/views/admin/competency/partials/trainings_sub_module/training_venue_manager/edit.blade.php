@extends('layouts.app')
@section('title', 'Update Form Training Venue Manager')
@section('sub', 'Form Training Venue Manager')
@section('content')
@include('admin.competency.view_profile.header',  ['cesno'=>$cesno])

<div class="flex justify-end">
    <a href="{{ route('training-venue-manager.index', ['cesno'=>$cesno]) }}" class="btn btn-primary" >Go back</a>
</div>

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Update Form Training Venue Manager
            </h1>
        </div>
        
        <div class="bg-white px-6 py-3">
            <form action="{{ route('training-venue-manager.update', ['ctrlno'=>$trainingVenueManager->venueid ,'cesno'=>$cesno]) }}" method="POST" id="update_training_venue_manager_form" onsubmit="return checkErrorsBeforeSubmit(update_training_venue_manager_form)">
                @csrf
                @method('PUT')
                
                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="name">Venue Name<sup>*</sup></label>
                        <input type="text" id="update_venue_name" name="name" oninput="validateInput(update_venue_name, 2, 'letters')" onkeypress="validateInput(update_venue_name, 2, 'letters')" onblur="checkErrorMessage(update_venue_name)" value="{{ $trainingVenueManager->name }}" required>
                        <p class="input_error text-red-600"></p>
                        @error('name')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="brgy">Barangay<sup>*</sup></label>
                        <input type="text" id="update_brgy" name="brgy" oninput="validateInput(update_brgy, 2, 'alphaNumeric')" onkeypress="validateInput(update_brgy, 2, 'alphaNumeric')" onblur="checkErrorMessage(update_brgy)" value="{{ $trainingVenueManager->brgy }}" >
                        <p class="input_error text-red-600"></p>
                        @error('brgy')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="city_code">City/Municipality<sup>*</sup></label>
                        <select id="city_code" name="city_code" required>
                            <option disabled selected>Select Specialization</option>
                            @foreach($profileLibTblCities as $profileLibTblCity)
                                @if ($profileLibTblCity->city_code == $trainingVenueManager->city_code)
                                    <option value="{{ $profileLibTblCity->city_code }}" selected>
                                        {{ $profileLibTblCity->name }}
                                    </option>    
                                @else
                                    <option value="{{ $profileLibTblCity->city_code }}">
                                        {{ $profileLibTblCity->name }}
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
                        <label for="no_street">Address: Bldg/No/Street<sup>*</sup></label>
                        <input type="text" id="update_no_street" name="no_street" oninput="validateInput(update_no_street, 2, 'alphaNumeric')" onkeypress="validateInput(update_no_street, 2, 'alphaNumeric')" onblur="checkErrorMessage(update_no_street)" value="{{ $trainingVenueManager->no_street }}" >
                        <p class="input_error text-red-600"></p>
                        @error('no_street')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="email">Email<sup>*</sup></label>
                        <input type="text" id="update_email" name="email" oninput="validateInputEmail(update_email)" onkeypress="validateInputEmail(update_email)" onblur="checkErrorMessage(update_email)" value="{{ $trainingVenueManager->emailadd }}" required>
                        <p class="input_error text-red-600"></p>
                        @error('email')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="contact_no">Contact No.<sup>*</sup></label>
                        <input type="text" id="update_contact_no" name="contact_no" oninput="validateInput(update_contact_no, 2, 'numbersWithSpecial')" onkeypress="validateInput(update_contact_no, 2, 'numbersWithSpecial')" onblur="checkErrorMessage(update_contact_no)" value="{{ $trainingVenueManager->contactno }}" required>
                        <p class="input_error text-red-600"></p>
                        @error('contact_no')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="contact_person">Contact Person<sup>*</sup></label>
                        <input type="text" id="venue_contact_person" name="contact_person" oninput="validateInput(venue_contact_person, 2, 'letters')" onkeypress="validateInput(venue_contact_person, 2, 'letters')" onblur="checkErrorMessage(venue_contact_person)" value="{{ $trainingVenueManager->contactperson }}" required>
                        <p class="input_error text-red-600"></p>
                        @error('contact_person')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end">
                    <button class="btn btn-primary" type="button" class="btn btn-primary" id="updateTrainingVenueManagerButton" onclick="openConfirmationDialog(this, 'Confirm Changes', 'Are you sure you want to update this info?')">
                        Update Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection