@extends('layouts.app')
@section('title', 'Written Exam')
@section('sub', 'Written Exam Form')
@section('content')
@include('admin.eris.header', ['acno'=>$acno])

<div class="flex justify-end">
    <a href="{{ route('eris-written-exam.index', ['acno'=>$acno]) }}" class="btn btn-primary" >Go back</a>
</div>

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Written Exam Form
            </h1>
        </div>
        
        <div class="bg-white px-6 py-3">
            <form action="{{ route('eris-written-exam.store', ['acno'=>$acno]) }}" method="POST" id="written_exam_form" onsubmit="return checkErrorsBeforeSubmit(written_exam_form)">
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
                        <label for="we_date">Written Exam Date<sup>*</sup></label>
                        <input type="date" id="we_date" name="we_date" oninput="validateDateInput(we_date)" required>
                        <p class="input_error text-red-600"></p>
                        @error('we_date')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="we_location">Location<sup>*</sup></label>
                        <input type="text" name="we_location">
                        @error('we_location')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="we_rating">Rating<sup>*</sup></label>
                        <input type="text" id="we_rating" name="we_rating" oninput="validateInput(we_rating, 2, 'numbersWithSpecial')" onkeypress="validateInput(we_rating, 2, 'numbersWithSpecial')" onblur="checkErrorMessage(we_rating)" required>
                        <p class="input_error text-red-600"></p>
                        @error('we_rating')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="we_remarks">Remarks<sup>*</sup></label>
                    <textarea name="we_remarks" id="we_remarks" cols="10" rows="3" ></textarea>
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