@extends('layouts.app')
@section('title', 'Award and Citation')
@section('sub', 'Award and Citation')
@section('content')
@include('admin.201_profiling.view_profile.header', ['cesno' => $cesno])

<div class="flex justify-end mb-7">
    <a href="{{ route('award-citation.index', ['cesno' => $cesno]) }}" class="btn btn-primary" >Go back</a>
</div>

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
               Update Form Award and Citation
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="{{ route('award-citation.update', ['ctrlno'=>$awardAndCitation->ctrlno, 'cesno'=>$cesno]) }}" method="POST" id="award_and_citations_edit" onsubmit="return checkErrorsBeforeSubmit(award_and_citations_edit)">
                @csrf
                @method('PUT')
                
                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="title_of_award_edit">Title of Award<sup>*</sup></label>
                        <input type="text" id="title_of_award_edit" name="awards" value="{{ $awardAndCitation->awards }}" oninput="validateInput(title_of_award_edit, 2, 'alphaNumeric')" onkeypress="validateInput(title_of_award_edit, 2, 'alphaNumeric')" onblur="checkErrorMessage(title_of_award_edit)" required>
                        <p class="input_error text-red-600"></p>
                        @error('awards')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="award_sponsor_edit">Sponsor<sup>*</sup></label>
                        <input type="text" id="award_sponsor_edit" name="sponsor" value="{{ $awardAndCitation->sponsor }}" oninput="validateInput(award_sponsor_edit, 2, 'alphaNumeric')" onkeypress="validateInput(award_sponsor_edit, 2, 'alphaNumeric')" onblur="checkErrorMessage(award_sponsor_edit)" required>
                        <p class="input_error text-red-600"></p>
                        @error('sponsor')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="award_edit_date">Date<sup>*</sup></label>
                        <input type="date" id="award_edit_date" name="date" value="{{ $awardAndCitation->date }}" oninput="validateDateInput(award_edit_date)" required>
                        <p class="input_error text-red-600"></p>
                        @error('date')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="button" class="btn btn-primary" id="updateAwardAndCitationButton" onclick="openConfirmationDialog(this, 'Confirm Changes', 'Are you sure you want to update this info?')">
                        Update Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection