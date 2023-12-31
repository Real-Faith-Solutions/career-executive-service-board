@extends('layouts.app')
@section('title', 'Research and Studies')
@section('sub', 'Research and Studies')
@section('content')
@include('admin.201_profiling.view_profile.header', ['cesno' => $cesno])

<div class="flex justify-end">
    <a href="{{ route('research-studies.index', ['cesno' => $cesno]) }}" class="btn btn-primary" >Go back</a>
</div>

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Form Research and Studies
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="{{ route('research-studies.store', ['cesno' =>$cesno]) }}" method="POST" id="research_studies_form" onsubmit="return checkErrorsBeforeSubmit(research_studies_form)">
                @csrf

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="title">Research Title<sup>*</span></label>
                        <input type="text" id="research_title" name="title" oninput="validateInput(research_title, 8, 'letters')" onkeypress="validateInput(research_title, 8, 'letters')" onblur="checkErrorMessage(research_title)" required>
                        <p class="input_error text-red-600"></p>
                        @error('title')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="publisher">Publisher<sup>*</span></label>
                        <input type="text" id="publisher" name="publisher" oninput="validateInput(publisher, 8, 'letters')" onkeypress="validateInput(publisher, 8, 'letters')" onblur="checkErrorMessage(publisher)" required>
                        <p class="input_error text-red-600"></p>
                        @error('publisher')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="inclusive_date_from">Inclusive Dates (From)<sup>*</span></label>
                        <input type="date" id="inclusive_date_from" name="inclusive_date_from" required
                            oninput="validateDateInput(inclusive_date_from), validateDateFromTo(inclusive_date_from, inclusive_date_to)"
                            onkeypress="validateDateInput(inclusive_date_from), validateDateFromTo(inclusive_date_from, inclusive_date_to)">
                        <p class="input_error text-red-600"></p>
                        @error('inclusive_date_from')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="inclusive_date_to">Inclusive Dates (To)<sup>*</span></label>
                        <input type="date" id="inclusive_date_to" name="inclusive_date_to" required
                            oninput="validateDateInput(inclusive_date_to), validateDateFromTo(inclusive_date_from, inclusive_date_to)"
                            onkeypress="validateDateInput(inclusive_date_to), validateDateFromTo(inclusive_date_from, inclusive_date_to)">
                        <p class="input_error text-red-600"></p>
                        @error('inclusive_date_to')
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