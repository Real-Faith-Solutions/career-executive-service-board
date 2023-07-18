@extends('layouts.app')
@section('title', 'Create 201 profile')
@section('content')

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
               Update Form Other Non-CES Accredited Training/s (formerly other trainings)
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="{{ route('other-training.update', ['ctrlno'=>$otherManagementTraining->ctrlno]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="training_title">Training Title<sup>*</sup></label>
                        <input id="training_title" name="training_title" value="{{ $otherManagementTraining->training }}" required type="text">
                        @error('training_title')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="training_category">Training Category<sup>*</sup></label>
                        <input id="training_category" name="training_category" value="{{ $otherManagementTraining->training_category }}" required type="text">
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
                                @if ($profileLibTblExpertiseSpecs->Title == $otherManagementTraining->field_specialization )
                                    <option value="{{ $profileLibTblExpertiseSpecs->Title }}" selected>
                                        {{ $profileLibTblExpertiseSpecs->Title }}
                                    </option>
                                @else
                                    <option value="{{ $profileLibTblExpertiseSpecs->Title }}">
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
                        <input id="inclusive_date_from" name="inclusive_date_from" value="{{ $otherManagementTraining->from_date }}" required type="date">
                        @error('inclusive_date_from')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="inclusive_date_to">Inclusive Dates (To)<sup>*</sup></label>
                        <input id="inclusive_date_to" name="inclusive_date_to" value="{{ $otherManagementTraining->to_date }}" required type="date">
                        @error('inclusive_date_to')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="sponsor_training_provider">Sponsor / Training Provider<sup>*</sup></label>
                        <input id="sponsor_training_provider" name="sponsor_training_provider" value="{{ $otherManagementTraining->sponsor }}" required type="text">
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
                        <input id="venue" name="venue" required value="{{ $otherManagementTraining->venue }}" type="text">
                        @error('venue')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="no_of_training_hours">No. of Training Hours<sup>*</sup></label>
                        <input id="no_of_training_hours" name="no_of_training_hours" value="{{ $otherManagementTraining->no_training_hours }}" required type="number">
                        @error('no_of_training_hours')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="btn btn-primary">
                        Update Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection