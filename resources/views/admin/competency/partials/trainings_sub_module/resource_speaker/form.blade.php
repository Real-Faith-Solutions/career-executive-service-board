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
                Form Resource Speaker
            </h1>
        </div>
        
        <div class="bg-white px-6 py-3">
            <form action="{{ route('resource-speaker.store') }}" method="POST" id="resource_speaker_form" onsubmit="return checkErrorsBeforeSubmit(resource_speaker_form)">
                @csrf
                
                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <div class="mb-3">
                        <label for="lastName">Last Name<sup>*</sup></label>
                        <input type="text" id="lastName" name="lastName" oninput="validateInput(lastName, 2, 'letters')" onkeypress="validateInput(lastName, 2, 'letters')" onblur="checkErrorMessage(lastName)" required>
                        <p class="input_error text-red-600"></p>
                        @error('lastName')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="firstName">Firt Name<sup>*</sup></label>
                        <input type="text" id="firstName" name="firstName" oninput="validateInput(firstName, 2, 'letters')" onkeypress="validateInput(firstName, 2, 'letters')" onblur="checkErrorMessage(firstName)" >
                        <p class="input_error text-red-600"></p>
                        @error('firstName')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="middleName">Middle Name<sup>*</sup></label>
                        <input type="text" id="middleName" name="middleName" oninput="validateInput(middleName, 1, 'letters')" onkeypress="validateInput(middleName, 1, 'letters')" onblur="checkErrorMessage(middleName)" >
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
                        <input type="text" id="position" name="position" oninput="validateInput(position, 2, 'letters')" onkeypress="validateInput(position, 2, 'letters')" onblur="checkErrorMessage(position)" >
                        <p class="input_error text-red-600"></p>
                        @error('position')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="department">Department</label>
                        <input type="text" id="department" name="department" oninput="validateInput(department, 2, 'letters')" onkeypress="validateInput(department, 2, 'letters')" onblur="checkErrorMessage(department)">
                        <p class="input_error text-red-600"></p>
                        @error('department')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="contactNo">Contact No.<sup>*</sup></label>
                        <input type="text" id="contactNo" name="contactNo" oninput="validateInput(contactNo, 10, 'numbersWithSpecial')" onkeypress="validateInput(contactNo, 10, 'numbersWithSpecial')" onblur="checkErrorMessage(contactNo)" required>
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
                        <input type="text" id="office" name="office" oninput="validateInput(office, 2, 'letters')" onkeypress="validateInput(office, 2, 'letters')" onblur="checkErrorMessage(office)" required>
                        <p class="input_error text-red-600"></p>
                        @error('office')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="bldg">Address/Building<sup>*</sup></label>
                        <input type="text" id="bldg" name="bldg" oninput="validateInput(bldg, 2, 'all')" onkeypress="validateInput(bldg, 2, 'all')" onblur="checkErrorMessage(bldg)" >
                        <p class="input_error text-red-600"></p>
                        @error('bldg')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="street">No. Street<sup>*</sup></label>
                        <input type="text" id="street" name="street" oninput="validateInput(street, 2, 'all')" onkeypress="validateInput(street, 2, 'all')" onblur="checkErrorMessage(street)" >
                        <p class="input_error text-red-600"></p>
                        @error('street')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="brgy">Barangay<sup>*</sup></label>
                        <input type="text" id="brgy" name="brgy" oninput="validateInput(brgy, 2, 'alphaNumeric')" onkeypress="validateInput(brgy, 2, 'alphaNumeric')" onblur="checkErrorMessage(brgy)" >
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
                                <option value="{{ $profileLibCIty->name }}">{{ $profileLibCIty->name. ' :zipcode-> ' .$profileLibCIty->zipcode }}</option>                                
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
                        <input type="text" id="emailAdd" name="emailAdd" oninput="validateInputEmail(emailAdd)" onkeypress="validateInputEmail(emailAdd)" onblur="checkErrorMessage(emailAdd)" >
                        <p class="input_error text-red-600"></p>
                        @error('emailAdd')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="expertise">Expertise<sup>*</sup></label>
                        <input type="text" id="expertise" name="expertise" oninput="validateInput(expertise, 10, 'letters')" onkeypress="validateInput(expertise, 10, 'letters')" onblur="checkErrorMessage(expertise)" >
                        <p class="input_error text-red-600"></p>
                        @error('expertise')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
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