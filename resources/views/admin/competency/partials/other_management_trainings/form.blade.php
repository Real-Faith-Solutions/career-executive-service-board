@extends('layouts.app')
@section('title', 'Competency Non-Ces Accredited Training')
@section('sub', 'Non-Ces Accredited Training')
@section('content')
@include('admin.competency.view_profile.header',  ['cesno'=>$cesno])

<div class="flex justify-end">
    <a href="{{ route('non-ces-training-management.index', ['cesno'=>$cesno]) }}" class="btn btn-primary" >Go back</a>
</div>

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Form Other Non-CES Accredited Training/s (formerly other trainings)
            </h1>
        </div>
        
        <div class="bg-white px-6 py-3">
            <form action="{{ route('non-ces-training-management.store', ['cesno'=>$cesno]) }}" method="POST" id="competency_other_trainings_form" onsubmit="return checkErrorsBeforeSubmit(competency_other_trainings_form)">
                @csrf
                
                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="training">Training Title<sup>*</sup></label>
                        <input type="text" id="competency_training" name="training" oninput="validateInput(competency_training, 2, 'letters')" onkeypress="validateInput(competency_training, 2, 'letters')" onblur="checkErrorMessage(competency_training)" required>
                        <p class="input_error text-red-600"></p>
                        @error('training')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="training_category">Training Category<sup>*</sup></label>
                        <input type="text" id="competency_training_category" name="training_category" oninput="validateInput(competency_training_category, 2, 'letters')" onkeypress="validateInput(competency_training_category, 2, 'letters')" onblur="checkErrorMessage(competency_training_category)" required>
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
                            <option disabled selected value="">Select Specialization</option>
                            @foreach ($profileLibTblExpertiseSpec as $profileLibTblExpertiseSpecs)
                                <option value="{{ $profileLibTblExpertiseSpecs->Title }}">{{ $profileLibTblExpertiseSpecs->Title }}</option>
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
                        <input type="date" id="competency_other_trainings_inclusive_date_from" name="inclusive_date_from" oninput="validateDateInput(competency_other_trainings_inclusive_date_from)" required>
                        <p class="input_error text-red-600"></p>
                        @error('inclusive_date_from')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="inclusive_date_to">Inclusive Dates (To)<sup>*</sup></label>
                        <input type="date" id="competency_other_trainings_inclusive_date_to" name="inclusive_date_to" oninput="validateDateInput(competency_other_trainings_inclusive_date_to)" required>
                        <p class="input_error text-red-600"></p>
                        @error('inclusive_date_to')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="sponsor_training_provider">Sponsor / Training Provider<sup>*</sup></label>
                        <select id="sponsor_training_provider" name="sponsor_training_provider" required>
                            <option disabled selected value="">Select Sponsor/Provider</option>
                            @foreach ($competencyTrainingProvider as $competencyTrainingProviders)
                                <option value="{{ $competencyTrainingProviders->provider }}">{{ $competencyTrainingProviders->provider }}</option>
                            @endforeach
                        </select>
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
                        <input type="text" id="competency_venue" name="venue" oninput="validateInput(competency_venue, 2)" onkeypress="validateInput(competency_venue, 2)" onblur="checkErrorMessage(competency_venue)" required>
                        <p class="input_error text-red-600"></p>
                        @error('venue')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="no_of_training_hours">No. of Training Hours<sup>*</sup></label>
                        <input type="text" id="competency_no_of_training_hours" name="no_of_training_hours" oninput="validateInput(competency_no_of_training_hours, 2, 'numbers')" onkeypress="validateInput(competency_no_of_training_hours, 2, 'numbers')" onblur="checkErrorMessage(competency_no_of_training_hours)" required>
                        <p class="input_error text-red-600"></p>
                        @error('no_of_training_hours')
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