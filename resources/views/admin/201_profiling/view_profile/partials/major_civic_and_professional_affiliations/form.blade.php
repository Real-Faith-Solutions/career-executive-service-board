@extends('layouts.app')
@section('title', 'Affiliation')
@section('sub', 'Affiliation')
@section('content')
@include('admin.201_profiling.view_profile.header', ['cesno' => $cesno])

<div class="flex justify-end">
    <a href="{{ route('affiliation.index', ['cesno'=>$cesno]) }}" class="btn btn-primary" >Go back</a>
</div>

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Form Major Civic and Professional Affiliations
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="{{ route('affiliation.store', ['cesno'=>$cesno]) }}" method="POST" id="affiliation_form" onsubmit="return checkErrorsBeforeSubmit(affiliation_form)">
                @csrf

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="organization">Organization<sup>*</sup></label>
                        <input type="text" id="organization" name="organization" oninput="validateInput(organization, 2, 'alphaNumeric')" onkeypress="validateInput(organization, 2, 'alphaNumeric')" onblur="checkErrorMessage(organization)" required>
                        <p class="input_error text-red-600"></p>
                        @error('organization')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="position">Position<sup>*</sup></label>
                        <input type="text" id="position" name="position" oninput="validateInput(position, 2, 'alphaNumeric')" onkeypress="validateInput(position, 2, 'alphaNumeric')" onblur="checkErrorMessage(position)" required>
                        <p class="input_error text-red-600"></p>
                        @error('position')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="affiliation_date_from">Date from<sup>*</sup></label>
                        <input type="date" id="affiliation_date_from" name="date_from" oninput="validateDateInput(affiliation_date_from)" required>
                        <p class="input_error text-red-600"></p>
                        @error('date_from')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="affiliation_date_to">Date to<sup>*</sup></label>
                        <input type="date" id="affiliation_date_to" name="date_to" oninput="validateDateInput(affiliation_date_to)" required>
                        <p class="input_error text-red-600"></p>
                        @error('date_to')
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