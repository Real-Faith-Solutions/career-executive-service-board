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
               Update Form Training Session
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="{{ route('training-session.update', ['ctrlno'=>$trainingSession->sessionid]) }}" method="POST" id="update_training_session_form" onsubmit="return checkErrorsBeforeSubmit(update_training_session_form)">
                @csrf
                @method('PUT')

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="title">Title<sup>*</sup></label>
                        <input type="text" id="update_training_session_title" name="title" oninput="validateInput(update_training_session_title, 6, 'alphaNumeric')" onkeypress="validateInput(update_training_session_title, 6, 'alphaNumeric')" onblur="checkErrorMessage(update_training_session_title)" value="{{ $trainingSession->title }}" required>
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
                            <option disabled selected>Select Category</option>
                            @foreach ($trainingLibCategory as $trainingLibCategories)
                                @if ($trainingLibCategories->description == $trainingSession->category )
                                    <option value="{{ $trainingLibCategories->description }}" selected>{{ $trainingLibCategories->description }}</option>
                                @else
                                    <option value="{{ $trainingLibCategories->description }}">{{ $trainingLibCategories->description }}</option>
                                @endif
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
                            <option disabled selected>Select Specialization</option>
                            @foreach ($profileLibTblExpertiseGen as $profileLibTblExpertiseGen)
                                @if ($profileLibTblExpertiseGen->Title == $trainingSession->specialization)
                                    <option value="{{ $profileLibTblExpertiseGen->Title }}" selected>{{ $profileLibTblExpertiseGen->Title }}</option>
                                @else
                                    <option value="{{ $profileLibTblExpertiseGen->Title }}">{{ $profileLibTblExpertiseGen->Title }}</option>
                                @endif
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
                        <input type="date" id="training_session_from_dt" name="from_dt" oninput="validateDateInput(training_session_from_dt), validateDateFromTo(training_session_from_dt, training_session_to_dt)" value="{{ $trainingSession->from_dt }}" required>
                        <p class="input_error text-red-600"></p>
                        @error('from_dt')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="to_dt">Date To<sup>*</sup></label>
                        <input type="date" id="training_session_to_dt" name="to_dt" oninput="validateDateInput(training_session_to_dt), validateDateFromTo(training_session_from_dt, training_session_to_dt)" value="{{ $trainingSession->to_dt }}" required>
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
                            <option disabled selected>Select Venue</option>
                            @foreach ($competencyTrainingVenueManager as $competencyTrainingVenueManagers)
                                @if ($competencyTrainingVenueManagers->venueid == $trainingSession->venueId)
                                    <option value="{{ $competencyTrainingVenueManagers->venueid }}" selected>{{ $competencyTrainingVenueManagers->name }}</option>
                                @else
                                    <option value="{{ $competencyTrainingVenueManagers->venueid }}">{{ $competencyTrainingVenueManagers->name }}</option>
                                @endif
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
                        <input type="text" id="training_session_no_hours" name="no_hours" oninput="validateInput(training_session_no_hours, 1, 'numbers')" onkeypress="validateInput(training_session_no_hours, 1, 'numbers')" onblur="checkErrorMessage(training_session_no_hours)" value="{{ $trainingSession->no_hours }}" required>
                        <p class="input_error text-red-600"></p>
                        @error('no_hours')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="barrio">Barrio</label>
                        <input type="text" id="training_session_barrio" name="barrio" oninput="validateInput(training_session_barrio, 3, 'alphaNumeric')" onkeypress="validateInput(training_session_barrio, 3, 'alphaNumeric')" onblur="checkErrorMessage(training_session_barrio)" value="{{ $trainingSession->barrio }}" >
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
                            <option disabled selected>Select Speaker</option>
                            @foreach ($resourceSpeaker as $resourceSpeakers)
                                @if ($resourceSpeakers->speakerID == $trainingSession->speakerid )
                                    <option value="{{ $resourceSpeakers->speakerID }}" selected>{{ $resourceSpeakers->lastname. ' '. $resourceSpeakers->firstname }}</option>
                                @else
                                    <option value="{{ $resourceSpeakers->speakerID }}">{{ $resourceSpeakers->lastname. ' '. $resourceSpeakers->firstname }}</option>
                                @endif
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
                            <option disabled selected>Select Director</option>
                            @foreach ($trainingSecretariat as $trainingSecretariats)
                                @if ($trainingSecretariats->description == $trainingSession->session_director)
                                    <option value="{{ $trainingSecretariats->description }}" selected>{{ $trainingSecretariats->description }}</option>
                                @else
                                    <option value="{{ $trainingSecretariats->description }}">{{ $trainingSecretariats->description }}</option>
                                @endif
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
                            <option disabled selected>Select Status</option>
                            <option value="Registration" {{ $trainingSession->status == 'Registration' ? 'selected' : '' }}>Registration</option>
                            <option value="Completed" {{ $trainingSession->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                            <option value="Pending" {{ $trainingSession->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Cancelled" {{ $trainingSession->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
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
                    <textarea id="remarks" name="remarks" rows="3" class="mb-7" >{{ $trainingSession->remarks }}</textarea>
                </div>

                <div class="flex justify-end">
                    <button type="button" class="btn btn-primary" id="updateTrainingSessionButton" onclick="openConfirmationDialog(this, 'Confirm Changes', 'Are you sure you want to update this info?')">
                        Update changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection