@extends('layouts.app')
@section('title', 'Scholarship Taken')
@section('sub', 'Scholarship Taken')
@section('content')
@include('admin.201_profiling.view_profile.header', ['cesno' => $cesno])

<div class="flex justify-end mb-7">
    <a href="{{ route('scholarship.index', ['cesno'=>$cesno]) }}" class="btn btn-primary">Go back</a>
</div>

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Form Scholarships
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="{{ route('scholarship.update', ['ctrlno'=>$scholarship->ctrlno, 'cesno'=>$cesno]) }}" method="POST" id="update_scholarship_taken_form" onsubmit="return checkErrorsBeforeSubmit(update_scholarship_taken_form)">
                @csrf
                @method('PUT')

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="type">Scholarship Type<sup>*</sup></label>
                        <select id="type" name="type" required>
                            <option disabled selected>Select Type of Scholarship</option>
                                @if ($scholarship->type == "Local")
                                    <option value="Local" selected>Local</option>
                                    <option value="Foreign">Foreign</option>
                                @elseif ($scholarship->type == "Foreign")
                                    <option value="Local">Local</option>
                                    <option value="Foreign" selected>Foreign</option>
                                @else
                                    <option value="Local">Local</option>
                                    <option value="Foreign">Foreign</option>
                                @endif
                        </select>
                        @error('type')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="title">Title</label>
                        <input id="title" name="title" value="{{ $scholarship->title }}" type="text">
                        @error('title')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="sponsor">Sponsor<sup>*</span></label>
                        <input id="sponsor" name="sponsor" value="{{ $scholarship->sponsor }}" required type="text">
                        @error('sponsor')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="inclusive_date_from">Inclusive Dates (From)</label>
                        <input id="inclusive_date_from" name="inclusive_date_from" value="{{ $scholarship->from_dt }}" type="date" required
                            oninput="validateDateInput(inclusive_date_from), validateDateFromTo(inclusive_date_from, inclusive_date_to)"
                            onkeypress="validateDateInput(inclusive_date_from), validateDateFromTo(inclusive_date_from, inclusive_date_to)">
                        @error('inclusive_date_from')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="inclusive_date_to">Inclusive Dates (To)</label>
                        <input id="inclusive_date_to" name="inclusive_date_to" value="{{ $scholarship->to_dt }}" type="date" required
                            oninput="validateDateInput(inclusive_date_to, 0, true), validateDateFromTo(inclusive_date_from, inclusive_date_to)"
                            onkeypress="validateDateInput(inclusive_date_to, 0, true), validateDateFromTo(inclusive_date_from, inclusive_date_to)">
                        @error('inclusive_date_to')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="button" class="btn btn-primary" id="updateScholarshipButton" onclick="openConfirmationDialog(this, 'Confirm Changes', 'Are you sure you want to update this info?')">
                        Update Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
