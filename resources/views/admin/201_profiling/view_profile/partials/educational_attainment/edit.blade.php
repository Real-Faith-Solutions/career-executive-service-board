@extends('layouts.app')
@section('title', 'Educational Attainment')
@section('sub', 'Educational Attainment')
@section('content')
@include('admin.201_profiling.view_profile.header', ['cesno' => $cesno])

<div class="flex justify-end">
    <a href="{{ route('educational-attainment.index', ['cesno' => $cesno]) }}" class="btn btn-primary">Go Back</a>
</div>

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
               Update Form Educational Attainment
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="{{ route('educational-attainment.update', ['ctrlno'=>$educationalAttainment->ctrlno]) }}" method="POST" id="update_educational_attainment_form" onsubmit="return checkErrorsBeforeSubmit(update_educational_attainment_form)">
                @csrf
                @method('PUT')

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="level">Level<sup>*</sup></label>
                        <select id="level" name="level" required>
                            <option disabled selected>Select Level</option>
                            @if ($educationalAttainment->level == "Elementary")
                                <option value="Elementary" selected>Elementary</option>
                                <option value="Secondary">Secondary</option>
                                <option value="College">College</option>
                                <option value="Graduate Studies">Graduate Studies</option>
                                <option value="Vocation/Trade Course">Vocation/Trade Course</option>
                            @elseif ($educationalAttainment->level == "Secondary")
                                <option value="Elementary">Elementary</option>
                                <option value="Secondary" selected>Secondary</option>
                                <option value="College">College</option>
                                <option value="Graduate Studies">Graduate Studies</option>
                                <option value="Vocation/Trade Course">Vocation/Trade Course</option>
                            @elseif ($educationalAttainment->level == "College")
                                <option value="Elementary">Elementary</option>
                                <option value="Secondary">Secondary</option>
                                <option value="College" selected>College</option>
                                <option value="Graduate Studies">Graduate Studies</option>
                                <option value="Vocation/Trade Course">Vocation/Trade Course</option>
                            @elseif ($educationalAttainment->level == "Graduate Studies")
                                <option value="Elementary">Elementary</option>
                                <option value="Secondary">Secondary</option>
                                <option value="College">College</option>
                                <option value="Graduate Studies" selected>Graduate Studies</option>
                                <option value="Vocation/Trade Course">Vocation/Trade Course</option>
                            @elseif ($educationalAttainment->level == "Vocation/Trade Course")
                                <option value="Elementary">Elementary</option>
                                <option value="Secondary">Secondary</option>
                                <option value="College">College</option>
                                <option value="Graduate Studies">Graduate Studies</option>
                                <option value="Vocation/Trade Course" selected>Vocation/Trade Course</option>
                            @else
                                <option value="Elementary">Elementary</option>
                                <option value="Secondary">Secondary</option>
                                <option value="College">College</option>
                                <option value="Graduate Studies">Graduate Studies</option>
                                <option value="Vocation/Trade Course">Vocation/Trade Course</option>
                            @endif
                        </select>
                        @error('level')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="school_code">School</label>
                        <select id="school_code" name="school_code" required>
                            <option disabled selected>Select School</option>
                            @foreach($profileLibTblEducSchool as $profileLibTblEducSchools)
                                @if ($profileLibTblEducSchools->CODE == $educationalAttainment->school_code)
                                    <option value="{{ $profileLibTblEducSchools->CODE }}" selected>
                                        {{ $profileLibTblEducSchools->SCHOOL }}
                                    </option>
                                @else
                                    <option value="{{ $profileLibTblEducSchools->CODE }}">
                                        {{ $profileLibTblEducSchools->SCHOOL }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        @error('school_code')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="major_code">Specialization<sup>*</span></label>
                        <select id="major_code" name="major_code" required>
                            <option disabled selected>Select Specialization</option>
                            @foreach($profileLibTblEducMajor as $profileLibTblEducMajors)
                                @if ($profileLibTblEducMajors->CODE == $educationalAttainment->major_code)
                                    <option value="{{ $profileLibTblEducMajors->CODE }}" selected>
                                        {{ $profileLibTblEducMajors->COURSE }}
                                    </option>
                                @else
                                    <option value="{{ $profileLibTblEducMajors->CODE }}">
                                        {{ $profileLibTblEducMajors->COURSE }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        @error('major_code')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="degree_code">Degree<sup>*</span></label>
                        <select id="degree_code" name="degree_code" required>
                            <option disabled selected>Select Degree</option>
                            @foreach($profileLibTblEducDegree as $profileLibTblEducDegrees)
                                @if ($profileLibTblEducDegrees->CODE == $educationalAttainment->degree_code)
                                    <option value="{{ $profileLibTblEducDegrees->CODE }}" selected>
                                        {{ $profileLibTblEducDegrees->DEGREE }}
                                    </option>
                                @else
                                    <option value="{{ $profileLibTblEducDegrees->CODE }}">
                                        {{ $profileLibTblEducDegrees->DEGREE }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        @error('degree_code')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="school_type">School type<sup>*</span></label>
                        <select id="school_type" name="school_type" required>
                            <option disabled selected>Select School type</option>
                            @if ($educationalAttainment->school_status == "Local")
                                <option value="Local" selected>Local</option>
                                <option value="Foreign">Foreign</option>
                            @elseif ($educationalAttainment->school_status == "Foreign")
                                <option value="Local">Local</option>
                                <option value="Foreign" selected>Foreign</option>
                            @else
                                <option value="Local">Local</option>
                                <option value="Foreign">Foreign</option>
                            @endif
                        </select>
                        @error('school_type')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="period_of_attendance_from">Period of attendance (From)<sup>*</span></label>
                        <input id="period_of_attendance_from" name="period_of_attendance_from" required value="{{ $educationalAttainment->period_of_attendance_from }}" type="text" placeholder="mm/dd/yyyy"
                            oninput="validateDateInput(period_of_attendance_from), validateDateFromTo(period_of_attendance_from, period_of_attendance_to)"
                            onkeypress="validateDateInput(period_of_attendance_from), validateDateFromTo(period_of_attendance_from, period_of_attendance_to)">
                        @error('period_of_attendance_from')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="period_of_attendance_to">Period of attendance (To)<sup>*</span></label>
                        <input id="period_of_attendance_to" name="period_of_attendance_to" required value="{{ $educationalAttainment->year_grad }}" type="text" placeholder="mm/dd/yyyy"
                            oninput="validateDateInput(period_of_attendance_to), validateDateFromTo(period_of_attendance_from, period_of_attendance_to)"
                            onkeypress="validateDateInput(period_of_attendance_to), validateDateFromTo(period_of_attendance_from, period_of_attendance_to)">
                        @error('period_of_attendance_to')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="highest_level">Highest Level / Unit earned (if not graduated)</label>
                        <input id="highest_level" name="highest_level" value="{{ $educationalAttainment->degree_status }}" type="text">
                        @error('highest_level')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

                    <div class="mb-3">
                        <label for="academics_honor_received">Academic Honors Received</label>
                        <input id="academics_honor_received" name="academics_honor_received" value="{{ $educationalAttainment->honors }}" type="text">
                        @error('academics_honor_received')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="button" class="btn btn-primary" id="updateEducAttainmentButton" onclick="openConfirmationDialog(this, 'Confirm Changes', 'Are you sure you want to update this info?')">
                        Update Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
