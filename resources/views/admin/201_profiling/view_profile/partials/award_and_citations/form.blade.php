@extends('layouts.app')
@section('title', 'Award and Citation')
@section('sub', 'Award and Citation')
@section('content')
@include('admin.201_profiling.view_profile.header', ['cesno' => $cesno])

<div class="flex justify-end">
    <a href="{{ route('award-citation.index', ['cesno' => $cesno]) }}" class="btn btn-primary" >Go back</a>
</div>

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Form Award and Citation
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="{{ route('award-citation.store', ['cesno' =>$cesno]) }}" method="POST" id="award_and_citations_form" onsubmit="return checkErrorsBeforeSubmit(award_and_citations_form)">
                @csrf

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="awards">Title of Award<sup>*</sup></label>
                        <input type="text" id="awards" name="awards" oninput="validateInput(awards, 2, 'alphaNumeric')" onkeypress="validateInput(awards, 2, 'alphaNumeric')" onblur="checkErrorMessage(awards)" required>
                        <p class="input_error text-red-600"></p>
                        @error('awards')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="award_sponsor">Sponsor<sup>*</sup></label>
                        <input type="text" id="award_sponsor" name="sponsor" oninput="validateInput(award_sponsor, 2, 'alphaNumeric')" onkeypress="validateInput(award_sponsor, 2, 'alphaNumeric')" onblur="checkErrorMessage(award_sponsor)" required>
                        <p class="input_error text-red-600"></p>
                        @error('sponsor')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="award_date">Date<sup>*</sup></label>
                        <input type="date" id="award_date" name="date" oninput="validateDateInput(award_date)" required>
                        <p class="input_error text-red-600"></p>
                        @error('date')
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