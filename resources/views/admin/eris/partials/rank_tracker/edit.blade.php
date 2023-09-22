@extends('layouts.app')
@section('title', 'Rank Tracker')
@section('sub', 'Rank Tracker')
@section('content')
@include('admin.eris.header', ['acno'=>$acno])

<div class="flex justify-end">
    <a href="{{ route('eris-rank-tracker.index', ['acno'=>$acno]) }}" class="btn btn-primary" >Go back</a>
</div>

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Rank Tracker Update Form
            </h1>
        </div>
        
        <div class="bg-white px-6 py-3">
            <form action="{{ route('eris-rank-tracker.update', ['acno'=>$acno, 'ctrlno'=>$ctrlno]) }}" method="POST" id="update_rank_tracker_form" onsubmit="return checkErrorsBeforeSubmit(update_rank_tracker_form)">
                @method('PUT')
                @csrf

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-2">
                    <div class="mb-3">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" value="{{ $erisTblMainProfileData->lastname.', '.$erisTblMainProfileData->firstname.', '.$erisTblMainProfileData->middlename }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="acno">ACNO</label>
                        <input type="text" id="acno" name="acno" value="{{ $erisTblMainProfileData->acno }}" readonly>
                    </div>
                </div>

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-2">
                    <div class="mb-3">
                        <label for="submit_dt">Submit Date<sup>*</sup></label>
                        <input type="date" id="submit_dt" name="submit_dt" oninput="validateDateInput(submit_dt)" value="{{ $rankTracker->submit_dt }}" required>
                        <p class="input_error text-red-600"></p>
                        @error('submit_dt')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description">Description<sup>*</sup></label>
                        <select name="description" id="description">
                            <option disabled selected>Select Description</option>
                            @foreach ($libraryRankTracker as $libraryRankTrackers)
                                @if ($libraryRankTrackers->description == $rankTracker->description )
                                    <option value="{{ $libraryRankTrackers->description }}" selected>
                                        {{ $libraryRankTrackers->description }}
                                    </option>
                                @else
                                    <option value="{{ $libraryRankTrackers->description }}">
                                        {{ $libraryRankTrackers->description }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        @error('description')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="remarks">Remarks<sup>*</sup></label>
                    <textarea name="remarks" id="remarks" cols="10" rows="3" >{{ $rankTracker->remarks }}</textarea>
                </div>

                <div class="flex justify-end">
                    <button type="button" class="btn btn-primary" id="updateRankTrackerButton" onclick="openConfirmationDialog(this, 'Confirm Changes', 'Are you sure you want to update this info?')">
                        Update Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection