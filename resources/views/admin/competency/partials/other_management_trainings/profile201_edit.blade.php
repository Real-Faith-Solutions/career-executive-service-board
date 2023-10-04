@extends('layouts.app')
@section('title', 'Competency Non-Ces Accredited Training')
@section('sub', 'Competency Non-Ces Accredited Training')
@section('content')
@include('admin.competency.view_profile.header')

<div class="flex justify-end">
    <a href="{{ route('other-training.index', ['cesno'=>$cesno]) }}" class="btn btn-primary" >Go back</a>
</div>

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
               Update Form Other Non-CES Accredited Training/s (formerly other trainings)
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="{{ route('non-ces-training-management.updateNonCesTraining201', ['ctrlno'=>$nonCesTraining201->ctrlno, 'cesno'=>$cesno]) }}" method="POST" id="update_other_training_201_form" onsubmit="return checkErrorsBeforeSubmit(update_other_training_form)">
                @csrf
                @method('PUT')

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="training">Training Title<sup>*</sup></label>
                        <input type="text" id="training_201" name="training" value="{{ $nonCesTraining201->training }}" oninput="validateInput(training_201, 2, 'letters')" onkeypress="validateInput(training_201, 2, 'letters')" onblur="checkErrorMessage(training_201)" required>
                        <p class="input_error text-red-600"></p>
                        @error('training')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="training_category">Training Category<sup>*</sup></label>
                        <input type="text" id="training_category_201" name="training_category" value="{{ $nonCesTraining201->training_category }}" oninput="validateInput(training_category_201, 2, 'letters')" onkeypress="validateInput(training_category_201, 2, 'letters')" onblur="checkErrorMessage(training_category_201)" required>
                        <p class="input_error text-red-600"></p>
                        @error('training_category')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="expertise_field_of_specialization">Expertise / Field of Specialization<sup>*</sup></label>
                        <select id="expertise_field_of_specialization" name="expertise_field_of_specialization" required>
                            <option disabled selected>Select Specialization</option>
                            @foreach ($profileLibTblExpertiseSpec as $profileLibTblExpertiseSpecs)
                                @if ($profileLibTblExpertiseSpecs->SpeExp_Code == $nonCesTraining201->field_specialization )
                                    <option value="{{ $profileLibTblExpertiseSpecs->SpeExp_Code }}" selected>
                                        {{ $profileLibTblExpertiseSpecs->Title }}
                                    </option>
                                @else
                                    <option value="{{ $profileLibTblExpertiseSpecs->SpeExp_Code }}">
                                        {{ $profileLibTblExpertiseSpecs->Title }}
                                    </option>    
                                @endif
                                
                            @endforeach
                        </select>
                        @error('expertise_field_of_specialization')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="inclusive_date_from">Inclusive Dates (From)<sup>*</sup></label>
                        <input type="date" id="inclusive_date_from_201" name="inclusive_date_from" value="{{ $nonCesTraining201->from_dt }}" oninput="validateDateInput(inclusive_date_from_201), validateDateFromTo(inclusive_date_from_201, inclusive_date_to_201)" required>
                        <p class="input_error text-red-600"></p>
                        @error('inclusive_date_from')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="inclusive_date_to">Inclusive Dates (To)<sup>*</sup></label>
                        <input type="date" id="inclusive_date_to_201" name="inclusive_date_to" value="{{ $nonCesTraining201->to_dt }}" oninput="validateDateInput(inclusive_date_to_201), validateDateFromTo(inclusive_date_from_201, inclusive_date_to_201)" required>
                        <p class="input_error text-red-600"></p>
                        @error('inclusive_date_to')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="sponsor_training_provider">Sponsor / Training Provider<sup>*</sup></label>
                        <input type="text" id="sponsor_training_provider_201" name="sponsor_training_provider" value="{{ $nonCesTraining201->sponsor }}" oninput="validateInput(sponsor_training_provider_201, 2, 'letters')" onkeypress="validateInput(sponsor_training_provider_201, 2, 'letters')" onblur="checkErrorMessage(sponsor_training_provider_201)" required>
                        <p class="input_error text-red-600"></p>
                        @error('sponsor_training_provider')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="venue">Venue<sup>*</sup></label>
                        <input type="text" id="venue_201" name="venue" required value="{{ $nonCesTraining201->venue }}" oninput="validateInput(venue_201, 2)" onkeypress="validateInput(venue_201, 2)" onblur="checkErrorMessage(venue_201)" required>
                        <p class="input_error text-red-600"></p>
                        @error('venue')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="no_of_training_hours">No. of Training Hours<sup>*</sup></label>
                        <input type="number" id="no_of_training_hours_201" name="no_of_training_hours" value="{{ $nonCesTraining201->no_training_hours }}" oninput="validateInput(no_of_training_hours_201, 2, 'numbers')" onkeypress="validateInput(no_of_training_hours_201, 2, 'numbers')" onblur="checkErrorMessage(no_of_training_hours_201)" required>
                        <p class="input_error text-red-600"></p>
                        @error('no_of_training_hours')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="button" class="btn btn-primary" id="updateOtherTraining201Button" onclick="openConfirmationDialog(this, 'Confirm Changes', 'Are you sure you want to update this info?')">
                        Update Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection