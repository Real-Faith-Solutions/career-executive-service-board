@extends('layouts.app')
@section('title', 'Create 201 profile')
@section('content')

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
               Update Form Major Civic and Professional Affiliations
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="{{ route('affiliation.update', ['ctrlno'=>$affiliation->ctrlno]) }}" method="POST" id="affiliation_edit" onsubmit="return checkErrorsBeforeSubmit(affiliation_edit)">
                @csrf
                @method('PUT')

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

                    <div class="mb-3">
                        <label for="organization_edit">Organization<sup>*</sup></label>
                        <input  type="text" id="organization_edit" name="organization" value="{{ $affiliation->organization }}" oninput="validateInput(organization_edit, 2, 'alphaNumeric')" onkeypress="validateInput(organization_edit, 2, 'alphaNumeric')" onblur="checkErrorMessage(organization_edit)" required>
                        <p class="input_error text-red-600"></p>
                        @error('organization')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="position_edit">Position<sup>*</sup></label>
                        <input type="text" id="position_edit" name="position" value="{{ $affiliation->position }}" oninput="validateInput(position_edit, 2, 'alphaNumeric')" onkeypress="validateInput(position_edit, 2, 'alphaNumeric')" onblur="checkErrorMessage(position_edit)" required>
                        <p class="input_error text-red-600"></p>
                        @error('position')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="affiliation_date_from_edit">Date from<sup>*</sup></label>
                        <input type="date" id="affiliation_date_from_edit" name="date_from" value="{{ $affiliation->from_dt }}" oninput="validateDateInput(affiliation_date_from_edit)" required>
                        <p class="input_error text-red-600"></p>
                        @error('date_from')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="affiliation_date_to_edit">Date to<sup>*</sup></label>
                        <input type="date" id="affiliation_date_to_edit" name="date_to" value="{{ $affiliation->to_dt }}" oninput="validateDateInput(affiliation_date_to_edit)" required>
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
                        Update Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection