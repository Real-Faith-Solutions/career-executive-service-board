@extends('layouts.app')
@section('title', 'Form Resource Speaker')
@section('sub', 'Form Resource Speaker')
@section('content')
@include('admin.competency.view_profile.header')

<div class="flex justify-end">
    <a href="{{ route('resource-speaker.index') }}" class="btn btn-primary" >Go back</a>
</div>

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
               Update Form Resource Speaker
            </h1>
        </div>
        
        <div class="bg-white px-6 py-3">
            <form action="{{ route('resource-speaker.update', ['ctrlno'=>$resourceSpeaker->speakerID]) }}" method="POST" id="update_resource_speakers_form" onsubmit="return checkErrorsBeforeSubmit(update_resource_speakers_form)">
                @csrf
                @method('PUT')
                
                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="lastName">Last Name<sup>*</sup></label>
                        <input type="text" id="update_lastName" name="lastName" oninput="validateInput(update_lastName, 2, 'letters')" onkeypress="validateInput(update_lastName, 2, 'letters')" onblur="checkErrorMessage(update_lastName)" value="{{ $resourceSpeaker->lastname }}" required>
                        <p class="input_error text-red-600"></p>
                        @error('lastName')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="firstName">Firt Name<sup>*</sup></label>
                        <input type="text" id="update_firstName" name="firstName" oninput="validateInput(update_firstName, 2, 'letters')" onkeypress="validateInput(update_firstName, 2, 'letters')" onblur="checkErrorMessage(update_firstName)" value="{{ $resourceSpeaker->firstname }}" required>
                        <p class="input_error text-red-600"></p>
                        @error('firstName')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="middleName">Middle Name<sup>*</sup></label>
                        <input type="text" id="update_middleName" name="middleName" oninput="validateInput(update_middleName, 1, 'letters')" onkeypress="validateInput(update_middleName, 1, 'letters')" onblur="checkErrorMessage(update_middleName)" value="{{ $resourceSpeaker->mi }}" >
                        <p class="input_error text-red-600"></p>
                        @error('middleName')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="position">Position<sup>*</sup></label>
                        <input type="text" id="update_position" name="position" oninput="validateInput(update_position, 2, 'letters')" onkeypress="validateInput(update_position, 2, 'letters')" onblur="checkErrorMessage(update_position)" value="{{ $resourceSpeaker->Position }}" >
                        <p class="input_error text-red-600"></p>
                        @error('position')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="department">Department</label>
                        <input type="text" id="update_department" name="department" oninput="validateInput(update_department, 2, 'letters')" onkeypress="validateInput(update_department, 2, 'letters')" onblur="checkErrorMessage(update_department)" value="{{ $resourceSpeaker->Department }}">
                        <p class="input_error text-red-600"></p>
                        @error('department')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="contactNo">Contact No.<sup>*</sup></label>
                        <input type="text" id="update_contactNo" name="contactNo" oninput="validateInput(update_contactNo, 10, 'numbersWithSpecial')" onkeypress="validateInput(update_contactNo, 10, 'numbersWithSpecial')" onblur="checkErrorMessage(update_contactNo)" value="{{ $resourceSpeaker->contactno }}" required>
                        <p class="input_error text-red-600"></p>
                        @error('contactNo')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="office">Office</label>
                        <input type="text" id="update_office" name="office" oninput="validateInput(update_office, 2, 'letters')" onkeypress="validateInput(update_office, 2, 'letters')" onblur="checkErrorMessage(update_office)" value="{{ $resourceSpeaker->Office }}" required>
                        <p class="input_error text-red-600"></p>
                        @error('office')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="bldg">Address/Building<sup>*</sup></label>
                        <input type="text" id="update_bldg" name="bldg" oninput="validateInput(update_bldg, 2, 'all')" onkeypress="validateInput(update_bldg, 2, 'all')" onblur="checkErrorMessage(update_bldg)" value="{{ $resourceSpeaker->Bldg }}" >
                        <p class="input_error text-red-600"></p>
                        @error('bldg')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="street">No. Street<sup>*</sup></label>
                        <input type="text" id="update_street" name="street" oninput="validateInput(update_street, 2, 'all')" onkeypress="validateInput(update_street, 2, 'all')" onblur="checkErrorMessage(update_street)" value="{{ $resourceSpeaker->Street }}" >
                        <p class="input_error text-red-600"></p>
                        @error('street')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="brgy">Barangay<sup>*</sup></label>
                        <input type="text" id="update_brgy" name="brgy" oninput="validateInput(update_brgy, 2, 'alphaNumeric')" onkeypress="validateInput(update_brgy, 2, 'alphaNumeric')" onblur="checkErrorMessage(update_brgy)" value="{{ $resourceSpeaker->Brgy }}" >
                        <p class="input_error text-red-600"></p>
                        @error('brgy')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="city">City/Province<sup>*</sup></label>
                        <select name="city" id="city">
                            <option value="">Select City</option>
                            @foreach ($profileLibCIties as $profileLibCIty)
                                @if ($profileLibCIty->zipcode == $resourceSpeaker->zipcode)
                                    <option value="{{ $profileLibCIty->name }}" selected>
                                        {{ $profileLibCIty->name. ' :zipcode-> ' .$profileLibCIty->zipcode }}
                                    <option>
                                @else
                                    <option value="{{ $profileLibCIty->name }}">
                                        {{ $profileLibCIty->name. ' :zipcode-> ' .$profileLibCIty->zipcode }}
                                    <option>
                                @endif                                
                            @endforeach
                        </select>
                        @error('city')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="emailAdd">Email Address<sup>*</sup></label>
                        <input type="text" id="update_emailAdd" name="emailAdd" oninput="validateInputEmail(update_emailAdd)" onkeypress="validateInputEmail(update_emailAdd)" onblur="checkErrorMessage(update_emailAdd)" value="{{ $resourceSpeaker->emailadd }}" required>
                        <p class="input_error text-red-600"></p>
                        @error('emailAdd')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="expertise">Expertise<sup>*</sup></label>
                        <input type="text" id="update_expertise" name="expertise" oninput="validateInput(update_expertise, 10, 'letters')" onkeypress="validateInput(update_expertise, 10, 'letters')" onblur="checkErrorMessage(update_expertise)" value="{{ $resourceSpeaker->expertise }}" >
                        <p class="input_error text-red-600"></p>
                        @error('expertise')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="button" class="btn btn-primary" id="updateResourceSpeakerButton" onclick="openConfirmationDialog(this, 'Confirm Changes', 'Are you sure you want to update this info?')">
                        Save changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection