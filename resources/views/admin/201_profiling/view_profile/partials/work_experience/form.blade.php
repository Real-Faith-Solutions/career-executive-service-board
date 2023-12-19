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
                Form Work experience
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="{{ route('work-experience.store', ['cesno' =>$cesno]) }}" method="POST" id="work_experience_form" onsubmit="return checkErrorsBeforeSubmit(work_experience_form)">
                @csrf

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="inclusive_date_from">Inclusive Dates (From)<sup>*</span></label>
                        <input type="date" id="inclusive_date_from" name="inclusive_date_from" oninput="validateDateInput(inclusive_date_from), validateDateFromTo(inclusive_date_from, inclusive_date_to)" required>
                        <p class="input_error text-red-600"></p>
                        @error('inclusive_date_from')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="inclusive_date_to">Inclusive Dates (To)<sup>*</span></label>
                        <input type="date" id="inclusive_date_to" name="inclusive_date_to" oninput="validateDateInput(inclusive_date_to), validateDateFromTo(inclusive_date_from, inclusive_date_to)" required>
                        <p class="input_error text-red-600"></p>
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
                        <input type="text" id="designation" name="designation" oninput="validateInput(designation, 4)" onkeypress="validateInput(designation, 4)" onblur="checkErrorMessage(designation)" required>
                        <p class="input_error text-red-600"></p>
                        @error('designation')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="department_or_agency">Department / Agency<sup>*</span></label>
                        <input id="department_or_agency" name="department_or_agency" type="text" oninput="validateInput(department_or_agency, 4)" onkeypress="validateInput(department_or_agency, 4)" onblur="checkErrorMessage(department_or_agency)" required>
                        <p class="input_error text-red-600"></p>
                        @error('department_or_agency')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="annually_salary">Annually Salary<sup>*</span></label>
                        <input id="annually_salary" name="annually_salary" type="text" oninput="validateInput(annually_salary, 4, 'numbersWithSpecial')" onkeypress="validateInput(annually_salary, 4, 'numbersWithSpecial')" onblur="checkErrorMessage(annually_salary)" required>
                        <p class="input_error text-red-600"></p>
                        @error('annually_salary')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="salary">Salary / Job / Pay Grade<sup>*</span></label>  
                        <input id="salary" name="salary" type="text" oninput="validateInput(salary, 4)" onkeypress="validateInput(salary, 4)" onblur="checkErrorMessage(salary)" required>
                        <p class="input_error text-red-600"></p>
                        @error('salary')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="status_of_appointment">Status of Appointment<sup>*</span></label>
                        <select id="status_of_appointment"  name="status_of_appointment" required>
                            <option disabled selected value="">Select Status of Appointment</option>
                            <option value="Permanent">Permanent</option>
                            <option value="Contractual">Contractual</option>
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
                            <option disabled selected value="">Select Government Service</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
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
                        <input id="remarks" name="remarks" type="text" required>
                        @error('remarks')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="btn btn-primary">
                        Add Work Experience
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
