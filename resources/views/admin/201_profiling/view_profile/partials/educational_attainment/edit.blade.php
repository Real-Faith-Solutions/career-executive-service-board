@extends('layouts.app')
@section('title', 'Create 201 profile')
@section('content')

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
               Update Form Educational Attainment
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="{{ route('educational-attainment.update', ['ctrlno'=>$educationalAttainment->ctrlno]) }}" method="POST">
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
                                <option value="Graduate Studies">Graduate Studies</option>
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
                        <label for="school">School</label>
                        <select id="school" name="school" required>
                            <option disabled selected>Select School</option>
                            @foreach($profileLibTblEducSchool as $profileLibTblEducSchools)
                                @if ($profileLibTblEducSchools->SCHOOL == $educationalAttainment->school)
                                    <option value="{{ $profileLibTblEducSchools->SCHOOL }}" selected>
                                        {{ $profileLibTblEducSchools->SCHOOL }}
                                    </option>    
                                @else
                                    <option value="{{ $profileLibTblEducSchools->SCHOOL }}">
                                        {{ $profileLibTblEducSchools->SCHOOL }}
                                    </option>    
                                @endif
                            @endforeach
                        </select>
                        @error('school')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="specialization">Specialization<sup>*</span></label>
                        <select id="specialization" name="specialization" required>
                            <option disabled selected>Select Specialization</option>
                            @foreach($profileLibTblEducMajor as $profileLibTblEducMajors)
                                @if ($profileLibTblEducMajors->COURSE == $educationalAttainment->specialization)
                                    <option value="{{ $profileLibTblEducMajors->COURSE }}" selected>
                                        {{ $profileLibTblEducMajors->COURSE }}
                                    </option>    
                                @else
                                    <option value="{{ $profileLibTblEducMajors->COURSE }}">
                                        {{ $profileLibTblEducMajors->COURSE }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        @error('degree')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="degree">Degree<sup>*</span></label>
                        <select id="degree" name="degree" required>
                            <option disabled selected>Select Degree</option>
                            @foreach($profileLibTblEducDegree as $profileLibTblEducDegrees)
                                @if ($profileLibTblEducDegrees->DEGREE == $educationalAttainment->degree)
                                    <option value="{{ $profileLibTblEducDegrees->DEGREE }}" selected>
                                        {{ $profileLibTblEducDegrees->DEGREE }}
                                    </option>    
                                @else
                                    <option value="{{ $profileLibTblEducDegrees->DEGREE }}">
                                        {{ $profileLibTblEducDegrees->DEGREE }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        @error('degree')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="school_type">School type<sup>*</span></label>
                        <select id="school_type" name="school_type" required>
                            <option disabled selected>Select School type</option>
                            @if ($educationalAttainment->school_type == "Local")
                                <option value="Local" selected>Local</option>
                                <option value="Foreign">Foreign</option>
                            @elseif ($educationalAttainment->school_type == "Foreign")
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
                        <input id="period_of_attendance_from" name="period_of_attendance_from" required value="{{ $educationalAttainment->period_of_attendance_from }}" type="month">
                        @error('period_of_attendance_from')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="period_of_attendance_to">Period of attendance (To)<sup>*</span></label>
                        <input id="period_of_attendance_to" name="period_of_attendance_to" required value="{{ $educationalAttainment->period_of_attendance_to }}" type="month">
                        @error('period_of_attendance_to')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="highest_level">Highest Level / Unit earned (if not graduated)</label>
                        <input id="highest_level" name="highest_level" value="{{ $educationalAttainment->highest_level }}" type="text">
                        @error('highest_level')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="year_graduate">Year Graduate<sup>*</span></label>
                        <input id="year_graduate" name="year_graduate" required value="{{ $educationalAttainment->year_graduate }}" type="year">
                        @error('year_graduate')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="academics_honor_received">Academic Honors Received</label>
                        <input id="academics_honor_received" name="academics_honor_received" value="{{ $educationalAttainment->academics_honor_received }}" type="text">
                        @error('academics_honor_received')
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
