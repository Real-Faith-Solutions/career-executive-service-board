@extends('layouts.app')
@section('title', 'Edit Family Profile')
@section('sub', 'Edit Family Profile')
@section('content')
@include('admin.201_profiling.view_profile.header', ['cesno' => $cesno])
<div class="my-5 flex justify-end">
    <a class="btn btn-primary" href="{{ route('family-profile.show', ['cesno' => $cesno]) }}">Go back</a>
</div>
<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Update Form Mother Record
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="{{ route('family-profile-mother.updateMotherRecord', ['ctrlno'=>$mother->ctrlno]) }}" method="POST" id="update_mother_form" onsubmit="return checkErrorsBeforeSubmit(update_mother_form)">
                @csrf
                @method('PUT')
                
                <p class="font-xsm text-grey-500">Note: Mother's maiden name</p>
                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="mother_last_name">Last name<sup>*</sup></label>
                        <input type="text" id="mother_last_name" name="mother_last_name" value="{{ $mother->mother_last_name }}" oninput="validateInput(mother_last_name, 2, 'letters')" onkeypress="validateInput(mother_last_name, 2, 'letters')" onblur="checkErrorMessage(mother_last_name)" required>
                        <p class="input_error text-red-600"></p>
                        @error('mother_last_name')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
            
                    <div class="mb-3">
                        <label for="mother_first_name">First name<sup>*</span></label>
                        <input type="text" id="mother_first_name" name="mother_first_name" value="{{ $mother->mother_first_name }}" oninput="validateInput(mother_first_name, 2, 'letters')" onkeypress="validateInput(mother_first_name, 2, 'letters')" onblur="checkErrorMessage(mother_first_name)" required>
                        <p class="input_error text-red-600"></p>
                        @error('mother_first_name')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
            
                    <div class="mb-3">
                        <label for="mother_middle_name">Middle name<sup>*</span></label>
                        <input type="text" id="mother_middle_name" name="mother_middle_name" value="{{ $mother->mother_middle_name }}" oninput="validateInput(mother_middle_name, 2, 'letters')" onkeypress="validateInput(mother_middle_name, 2, 'letters')" onblur="checkErrorMessage(mother_middle_name)" required>
                        <p class="input_error text-red-600"></p>
                        @error('mother_middle_name')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
            
                </div>

                <div>
                    <div class="flex justify-end">
                        <button type="button" class="btn btn-primary" id="updateMotherButton" onclick="openConfirmationDialog(this, 'Confirm Changes', 'Are you sure you want to update this info?')">
                            Update Changes
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection