@extends('layouts.app')
@section('title', 'Field Specialization Form')
@section('sub', 'Field Specialization')
@section('content')
@include('admin.competency.view_profile.header')

<div class="flex justify-end">
    <a href="{{ route('field-specialization.index') }}" class="btn btn-primary">Go back</a>
</div>

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Form Field Specialization
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="{{ route('field-specialization.store') }}" method="POST" id="competency_field_specialization_form" onsubmit="return checkErrorsBeforeSubmit(competency_field_specialization_form)">
                @csrf

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="Title">Training Specialization<sup>*</sup></label>
                        <input type="text" id="training_specialzation_title" name="Title" oninput="validateInput(training_specialzation_title, 6, 'letters')" onkeypress="validateInput(training_specialzation_title, 6, 'letters')" onblur="checkErrorMessage(training_specialzation_title)" required>
                        <p class="input_error text-red-600"></p>
                        @error('Title')
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