@extends('layouts.app')
@section('title', 'Training Session')
@section('sub', 'Training Session')
@section('content')
@include('admin.competency.view_profile.header')

<div class="flex justify-end">
    <a href="{{ route('training-session.index') }}" class="btn btn-primary">Go back</a>
</div>

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Form Training Session
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="{{ route('training-session.store') }}" method="POST" id="training_session_form" onsubmit="return checkErrorsBeforeSubmit(training_session_form)">
                @csrf

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="title">Title<sup>*</sup></label>
                        <input type="text" id="training_session_title" name="title" oninput="validateInput(training_session_title, 6, 'alphaNumeric')" onkeypress="validateInput(training_session_title, 6, 'alphaNumeric')" onblur="checkErrorMessage(training_session_title)" required>
                        <p class="input_error text-red-600"></p>
                        @error('title')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="category">Category<sup>*</sup></label>
                        <select name="category" id="category">
                            <option disabled selected value="">Select Category</option>
                            @foreach ($trainingLibCategory as $trainingLibCategories)
                                <option value="{{ $trainingLibCategories->description }}">{{ $trainingLibCategories->description }}</option>
                            @endforeach
                        </select>
                        <p class="input_error text-red-600"></p>
                        @error('category')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="specialization">Specialization<sup>*</sup></label>
                        <select name="specialization" id="specialization">
                            <option disabled selected value="">Select Specialization</option>
                            @foreach ($profileLibTblExpertiseGen as $profileLibTblExpertiseGen)
                                <option value="{{ $profileLibTblExpertiseGen->Title }}">{{ $profileLibTblExpertiseGen->Title }}</option>
                            @endforeach
                        </select>
                        <p class="input_error text-red-600"></p>
                        @error('specialization')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="from_dt">Date From<sup>*</sup></label>
                        <input type="date" id="training_session_from_dt" name="from_dt" oninput="validateDateInput(training_session_from_dt), validateDateFromTo(training_session_from_dt, training_session_to_dt)" required>
                        <p class="input_error text-red-600"></p>
                        @error('from_dt')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="to_dt">Date To<sup>*</sup></label>
                        <input type="date" id="training_session_to_dt" name="to_dt" oninput="validateDateInput(training_session_to_dt), validateDateFromTo(training_session_from_dt, training_session_to_dt)" required>
                        <p class="input_error text-red-600"></p>
                        @error('to_dt')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="venue">Venue<sup>*</sup></label>
                        <select name="venue" id="venue">
                            <option disabled selected value="">Select Venue</option>
                            @foreach ($competencyTrainingVenueManager as $competencyTrainingVenueManagers)
                                <option value="{{ $competencyTrainingVenueManagers->venueid }}">{{ $competencyTrainingVenueManagers->name }}</option>
                            @endforeach
                        </select>
                        <p class="input_error text-red-600"></p>
                        @error('venue')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="no_hours">No of Hours<sup>*</sup></label>
                        <input type="text" id="training_session_no_hours" name="no_hours" oninput="validateInput(training_session_no_hours, 1, 'numbers')" onkeypress="validateInput(training_session_no_hours, 1, 'numbers')" onblur="checkErrorMessage(training_session_no_hours)" required>
                        <p class="input_error text-red-600"></p>
                        @error('no_hours')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="barrio">Barrio<sup>*</sup></label>
                        <input type="text" id="training_session_barrio" name="barrio" oninput="validateInput(training_session_barrio, 6, 'alphaNumeric')" onkeypress="validateInput(training_session_barrio, 6, 'alphaNumeric')" onblur="checkErrorMessage(training_session_barrio)" required>
                        <p class="input_error text-red-600"></p>
                        @error('barrio')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="resource_speaker">Resource Speaker<sup>*</sup></label>
                        <select name="resource_speaker" id="resource_speaker">
                            <option disabled selected value="">Select Speaker</option>
                            @foreach ($resourceSpeaker as $resourceSpeakers)
                                <option value="{{ $resourceSpeakers->speakerID }}">{{ $resourceSpeakers->lastname. ' '. $resourceSpeakers->firstname }}</option>
                            @endforeach
                        </select>
                        <p class="input_error text-red-600"></p>
                        @error('resource_speaker')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="session_director">Session Director<sup>*</sup></label>
                        <select name="session_director" id="session_director">
                            <option disabled selected value="">Select Director</option>
                            @foreach ($trainingSecretariat as $trainingSecretariats)
                                <option value="{{ $trainingSecretariats->description }}">{{ $trainingSecretariats->description }}</option>
                            @endforeach
                        </select>
                        <p class="input_error text-red-600"></p>
                        @error('session_director')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="status">Status<sup>*</sup></label>  
                        <select name="status" id="status">
                            <option disabled selected value="">Select Status</option>
                            <option value="Registration">Registration</option>
                            <option value="Completed">Completed</option>
                            <option value="Pending">Pending</option>
                            <option value="Cancelled">Cancelled</option>
                        </select>
                        <p class="input_error text-red-600"></p>
                        @error('status')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-1 lg:grid-cols-1">
                    <label for="remarks">Remarks<sup>*</sup></label>  
                    <textarea id="remarks" name="remarks" rows="3" class="mb-7"></textarea>
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