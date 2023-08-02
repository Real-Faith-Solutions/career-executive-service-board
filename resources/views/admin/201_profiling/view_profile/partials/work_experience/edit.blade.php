@extends('layouts.app')
@section('title', 'Work Experience')
@section('sub', 'Work Experience')
@section('content')
@include('admin.201_profiling.view_profile.header', ['cesno' => $cesno])

<div class="flex justify-end">
    <a href="{{ route('work-experience.index', ['cesno'=>$cesno]) }}" class="btn btn-primary">Go back</a>
</div>

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
               Update Form Work experience
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="{{ route('work-experience.update', ['ctrlno'=>$workExperience->ctrlno, 'cesno'=>$cesno]) }}"  method="POST">
                @csrf
                @method('PUT')

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="inclusive_date_from">Inclusive Dates (From)<sup>*</span></label>
                        <input id="inclusive_date_from" name="inclusive_date_from" value="{{ $workExperience->from_dt }}" type="date" required>
                        @error('inclusive_date_from')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="inclusive_date_to">Inclusive Dates (To)<sup>*</span></label>
                        <input id="inclusive_date_to" name="inclusive_date_to" value="{{ $workExperience->to_dt }}" type="date" required>
                        @error('inclusive_date_to')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="designation">Position Title / Designation<sup>*</span></label>
                        <input id="designation" name="designation" value="{{ $workExperience->designation }}" type="text" required>
                        @error('designation')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="department_or_agency">Department / Agency<sup>*</span></label>
                        <input id="department_or_agency" name="department_or_agency" value="{{ $workExperience->department }}" type="text" required>
                        @error('department_or_agency')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="monthly_salary">Monthly Salary<sup>*</span></label>
                        <input id="monthly_salary" name="monthly_salary" value="{{ $workExperience->monthly_salary }}" type="text" required>
                        @error('monthly_salary')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="salary">Salary / Job / Pay Grade<sup>*</span></label>  
                        <input id="salary" name="salary" value="{{ $workExperience->salary }}" type="text" required>
                        @error('salary')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="status_of_appointment">Status of Appointment<sup>*</span></label>
                        <select id="status_of_appointment"  name="status_of_appointment" required>
                            <option disabled selected>Select Status of Appointment</option>
                            @if ($workExperience->status == "Permanent")
                                <option value="Permanent" selected>Permanent</option>
                                <option value="Contractual">Contractual</option>
                            @elseif ($workExperience->status == "Contractual")
                                <option value="Permanent">Permanent</option>
                                <option value="Contractual" selected>Contractual</option>
                            @else
                                <option value="Permanent">Permanent</option>
                                <option value="Contractual">Contractual</option>
                            @endif
                        </select>
                        @error('status_of_appointment')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="government_service">Government Service<sup>*</span></label>
                        <select id="government_service" name="government_service" required>
                            <option disabled selected>Select Government Service</option>
                            @if ($workExperience->government_service == "Yes")
                                <option value="Yes" selected>Yes</option>
                                <option value="No">No</option>
                            @elseif ($workExperience->government_service == "No")
                                <option value="Yes">Yes</option>
                                <option value="No" selected>No</option>
                            @else
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            @endif
                        </select>
                        @error('government_service')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="remarks">Remarks<sup>*</span></label>
                        <input id="remarks" name="remarks" value="{{ $workExperience->remarks }}" type="text" required>
                        @error('remarks')
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