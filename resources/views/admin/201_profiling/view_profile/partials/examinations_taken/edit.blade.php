@extends('layouts.app')
@section('title', 'Examination Taken')
@section('sub', 'Examination Taken')
@section('content')
@include('admin.201_profiling.view_profile.header', ['cesno' => $cesno])

<div class="flex justify-end">
    <a href="{{ route('examination-taken.index', ['cesno' => $cesno]) }}" class="btn btn-primary">Go back</a>
</div>

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Update Form Examination Attainment
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form
                action="{{ route('examination-taken.update', ['ctrlno'=>$examinationTaken->ctrlno, 'cesno'=>$cesno]) }}"
                method="POST" id="update_examination_taken_form"
                onsubmit="return checkErrorsBeforeSubmit(update_examination_taken_form)">
                @csrf
                @method('PUT')

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="exam_code">Type of Examination<sup>*</sup></label>
                        <select id="type" name="exam_code" required>
                            <option disabled selected>Select Type of Examination</option>
                            @foreach ($profileLibTblExamRef as $profileLibTblExamRefs)
                            @if ($profileLibTblExamRefs->CODE == $examinationTaken->exam_code)
                            <option value="{{ $profileLibTblExamRefs->CODE }}" selected>{{ $profileLibTblExamRefs->TITLE
                                }}</option>
                            @else
                            <option value="{{ $profileLibTblExamRefs->CODE }}">{{ $profileLibTblExamRefs->TITLE }}
                            </option>s
                            @endif
                            @endforeach
                        </select>
                        @error('exam_code')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="rating">Rating (if applicable)</label>
                        <input id="rating" name="rating" type="text" value="{{ $examinationTaken->rate }}">
                        @error('rating')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="date_of_examination">Date of Examination<sup>*</span></label>
                        <input id="date_of_examination" name="date_of_examination"
                            value="{{ $examinationTaken->exam_date }}" required type="text"
                            oninput="validateDateInput(date_of_examination), validateDateFromTo(date_of_examination, date_acquired)"
                            onkeypress="validateDateInput(date_of_examination), validateDateFromTo(date_of_examination, date_acquired)">
                        @error('date_of_examination')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="place_of_examination">Place of Examination<sup>*</span></label>
                        <select name="place_of_examination" id="place_of_examination">
                            <option disabled>Select Examination Place</option>
                            @foreach ($profileLibCities as $data)
                            <option value="{{ $data->city_code }}" {{ $data->city_code ==
                                $examinationTaken->exam_place ? 'selected' : ''}}>
                                {{ $data->name ?? ''}}
                            </option>
                            @endforeach
                        </select>
                        <p class="input_error text-red-600"></p>
                        @error('place_of_examination')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="license_number">License details (if applicable)</label>
                        <input id="license_number" name="license_number" value="{{ $examinationTaken->license_number }}"
                            type="text">
                        @error('license_number')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="date_acquired">Date Acquired</label>
                        <input id="date_acquired" name="date_acquired" value="{{ $examinationTaken->date_acquired }}" type="text"
                            oninput="validateDateInput(date_acquired), validateDateFromTo(date_of_examination, date_acquired)"
                            onkeypress="validateDateInput(date_acquired), validateDateFromTo(date_of_examination, date_acquired)">
                        @error('date_acquired')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="date_validity">Date Validity</label>
                        <input id="date_validity" name="date_validity" value="{{ $examinationTaken->date_validity }}"
                            type="text">
                        @error('date_validity')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="flex justify-end">
                    <button type="button" class="btn btn-primary" id="updateExamTakenButton"
                        onclick="openConfirmationDialog(this, 'Confirm Changes', 'Are you sure you want to update this info?')">
                        Update Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection