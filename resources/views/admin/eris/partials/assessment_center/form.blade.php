@extends('layouts.app')
@section('title', 'Assessment Center')
@section('sub', 'Assessment Center')
@section('content')
@include('admin.eris.header', ['acno'=>$acno])

<div class="flex justify-end">
    <a href="{{ route('eris-assessment-center.index', ['acno'=>$acno]) }}" class="btn btn-primary" >Go back</a>
</div>

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Assessment Center Form
            </h1>
        </div>
        
        <div class="bg-white px-6 py-3">
            <form action="{{ route('eris-assessment-center.store', ['acno'=>$acno]) }}" method="POST" id="assessment_center_form" onsubmit="return checkErrorsBeforeSubmit(assessment_center_form)">
                @csrf

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" value="{{ $erisTblMainProfileData->lastname.', '.$erisTblMainProfileData->firstname.', '.$erisTblMainProfileData->middlename }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="acno">ACNO</label>
                        <input type="text" id="acno" name="acno" value="{{ $erisTblMainProfileData->acno }}" readonly>
                    </div>
                    
                    <div class="mb-3">
                        <label for="acdate">Assessment Center Date<sup>*</sup></label>
                        <input type="date" id="acdate" name="acdate" oninput="validateDateInput(acdate)" required>
                        <p class="input_error text-red-600"></p>
                        @error('acdate')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="numtakes">No. of Takes<sup>*</sup></label>
                        <input type="text" id="numtakes" name="numtakes" oninput="validateInput(numtakes, 1, 'numbers')" onkeypress="validateInput(numtakes, 1, 'numbers')" onblur="checkErrorMessage(numtakes)">
                        <p class="input_error text-red-600"></p>
                        @error('numtakes')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="docdate">Submittion of Document<sup>*</sup></label>
                        <input type="date" id="docdate" name="docdate" oninput="validateDateInput(docdate)" >
                        <p class="input_error text-red-600"></p>
                        @error('docdate')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="docdate">Competencies for D.O<sup>*</sup></label>
                        <input type="text" id="competencies_d_o" name="competencies_d_o">
                        <p class="input_error text-red-600"></p>
                        @error('competencies_d_o')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="remarks">Remarks<sup>*</sup></label>
                        <input type="text" name="remarks">
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