@extends('layouts.app')
@section('title', 'Board Interview')
@section('sub', 'Board Interview')
@section('content')
@include('admin.eris.header', ['acno'=>$acno])

<div class="flex justify-end">
    <a href="{{ route('eris-board-interview.index', ['acno'=>$acno]) }}" class="btn btn-primary" >Go back</a>
</div>

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Board Interview Form
            </h1>
        </div>
        
        <div class="bg-white px-6 py-3">
            <form action="{{ route('eris-board-interview.store', ['acno'=>$acno]) }}" method="POST" id="board_interview_form" onsubmit="return checkErrorsBeforeSubmit(board_interview_form)">
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
                        <label for="dteassign">Assigned Date<sup>*</sup></label>
                        <input type="date" id="dteassign" name="dteassign" oninput="validateDateInput(dteassign)" required>
                        <p class="input_error text-red-600"></p>
                        @error('dteassign')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="dtesubmit">Submittion Date<sup>*</sup></label>
                        <input type="date" id="dtesubmit" name="dtesubmit" oninput="validateDateInput(dtesubmit)">
                        <p class="input_error text-red-600"></p>
                        @error('dtesubmit')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="intrviewer">Interviewer<sup>*</sup></label>
                        <input type="text" name="intrviewer">
                        @error('intrviewer')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="dteiview">Date of Interview<sup>*</sup></label>
                        <input type="date" id="dteiview" name="dteiview" oninput="validateDateInput(dteiview)">
                        <p class="input_error text-red-600"></p>
                        @error('dteiview')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="recom">Recommendation<sup>*</sup></label>
                    <textarea name="recom" id="recom" cols="10" rows="3" ></textarea>
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