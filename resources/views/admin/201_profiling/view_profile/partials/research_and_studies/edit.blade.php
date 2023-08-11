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
                Update Form Research and Studies
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="{{ route('research-studies.update', ['ctrlno'=>$researchAndStudies->ctrlno, 'cesno'=>$cesno]) }}" method="POST" id="update_research_studies_form" onsubmit="return checkErrorsBeforeSubmit(update_research_studies_form)">
                @csrf
                @method('PUT')

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="title">Research Title</label>
                        <input id="title" name="title" value="{{ $researchAndStudies->title }}" type="text" required>
                        @error('title')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="publisher">Publisher<sup>*</span></label>
                        <input id="publisher" name="publisher" value="{{ $researchAndStudies->publisher }}" required type="text">
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
                        <input id="inclusive_date_from" name="inclusive_date_from" value="{{ $researchAndStudies->inclusive_date_from }}" type="date" required>
                        @error('inclusive_date_from')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="inclusive_date_to">Inclusive Dates (To)<sup>*</span></label>
                        <input id="inclusive_date_to" name="inclusive_date_to" value="{{ $researchAndStudies->inclusive_date_to }}" type="date" required>
                        @error('inclusive_date_to')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="flex justify-end">
                    <button type="button" class="btn btn-primary" id="updateResearchStudiesButton" onclick="openConfirmationDialog(this, 'Confirm Changes', 'Are you sure you want to update this info?')">
                        Update Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection