@extends('layouts.app')
@section('title', 'Edit Profile')
@section('sub', 'Edit Profile')
@section('content')
@include('admin.eris.header', ['acno'=>$acno])
    <div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
        <div class="w-full text-left text-gray-500">
            <div class="bg-blue-500 uppercase text-gray-700 text-white">
                <h1 class="px-6 py-3">
                    Edit Profile
                </h1>
            </div>
            
            <div class="bg-white px-6 py-3">
                <form action="{{ route('eris.update', ['acno' => $acno]) }}" method="POST" id="update_add_new_profile_form" onsubmit="return checkErrorsBeforeSubmit(update_add_new_profile_form)">
                    @method('PUT')
                    @csrf                   
                        <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                            <div class="mb-3">
                                <label for="lastname">Last Name<sup>*</sup></label>
                                <input type="text" id="lastname" name="lastname" value="{{ $erisTblMainPersonalData->lastname ?? '' }}" required readonly>
                            </div>

                            <div class="mb-3">
                                <label for="firstname">First Name<sup>*</sup></label>
                                <input type="text" id="firstname" name="firstname" value="{{ $erisTblMainPersonalData->firstname ?? '' }}" required readonly>
                            </div>

                            <div class="mb-3">
                                <label for="middlename">Middle Name</label>
                                <input type="text" id="middlename" name="middlename" value="{{ $erisTblMainPersonalData->middlename ?? '' }}" readonly>
                            </div>
                        </div>

                        <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                            <div class="mb-3">
                                <label for="birthdate">Birth Date<sup>*</sup></label>
                                <input type="date" id="birthdate" name="birthdate" value="{{ $birthDate ?? ''  }}" value="{{ old('birthdate') }}" onchange="computeAge()" oninput="validateDateInput(birthdate, 18)" required>
                            <p class="input_error text-red-600"></p>
                            </div>

                            {{-- age auto compute --}}
                                <div class="mb-3">
                                    <label for="age">Age<sup>*</sup></label>
                                    <input type="number" id="age" name="age" value="{{ $age }}" value="{{ old('age') }}" readonly>
                                </div>
                            {{-- age auto compute --}}
                    
                            <div class="mb-3">
                                <label for="gender">Gender</label>
                                <select name="gender" id="gender">
                                    <option disabled selected>Select Gender</option>
                                    @if ($erisTblMainPersonalData->gender == "Male")
                                        <option value="Male" selected>Male</option>
                                        <option value="Female">Female</option>    
                                    @elseif ($erisTblMainPersonalData->gender == "Female")
                                        <option value="Male">Male</option>
                                        <option value="Female" selected>Female</option>
                                    @else
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-4">
                            <div class="mb-3">
                                <label for="emailadd">Email<sup>*</sup></label>
                                <input type="text" id="emailadd" name="emailadd" value="{{ $erisTblMainPersonalData->emailadd ?? ''  }}" oninput="validateInputEmail(emailadd)" onkeypress="validateInputEmail(emailadd)" onblur="checkErrorMessage(emailadd)">
                                <p class="input_error text-red-600"></p>
                            </div>

                            <div class="mb-3">
                                <label for="contactno">Telephone No<sup>*</sup></label>
                                <input type="tel" id="contactno" name="contactno" value="{{ $erisTblMainPersonalData->contactno ?? ''  }}" >
                            </div>

                            <div class="mb-3">
                                <label for="mobileno">Mobile No</label>
                                <input type="text" id="mobileno" name="mobileno" value="{{ $erisTblMainPersonalData->mobileno ?? ''  }}" oninput="validateInput(mobileno, 10, 'numbersWithSpecial')" onkeypress="validateInput(mobileno, 10, 'numbersWithSpecial')" onblur="checkErrorMessage(mobileno)">
                                <p class="input_error text-red-600"></p>
                            </div>

                            <div class="mb-3">
                                <label for="faxno">Fax No</label>
                                <input type="text" id="faxno" name="faxno" value="{{ $erisTblMainPersonalData->faxno ?? ''  }}">
                            </div>
                        </div>

                        <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-4">
                            <div class="mb-3">
                                <label for="position">Position<sup>*</sup></label>
                                <input type="text" id="position" name="position" value="{{ $erisTblMainPersonalData->position ?? ''  }}">
                            </div>

                            <div class="mb-3">
                                <label for="position_remarks">Position Remarks<sup>*</sup></label>
                                <input type="text" id="position_remarks" name="position_remarks" value="{{ $erisTblMainPersonalData->position_remarks ?? ''  }}">
                            </div>

                            <div class="mb-3">
                                <label for="office">Bureau Office</label>
                                <input type="text" id="office" name="office" value="{{ $erisTblMainPersonalData->office ?? ''  }}">
                            </div>

                            <div class="mb-3">
                                <label for="department">Department/Agency<sup>*</sup></label>
                                <input type="text" id="department" name="department" value="{{ $erisTblMainPersonalData->department ?? ''  }}">
                            </div>
                        </div>

                        <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                            <div class="mb-3">
                                <label for="c_status">Conferment Status<sup>*</sup></label>
                                <input type="text" id="c_status" name="c_status" value="{{ $erisTblMainPersonalData->c_status ?? ''  }}">
                            </div>

                            <div class="mb-3">
                                <label for="c_resno">Resolution No <sup>*</sup></label>
                                <input type="text" id="c_resno" name="c_resno" value="{{ $erisTblMainPersonalData->c_resno ?? ''  }}">
                            </div>

                            <div class="mb-3">
                                <label for="c_date">Date Conferred</label>
                                <input type="date" id="c_date" name="c_date" value="{{ $erisTblMainPersonalData->c_date ?? ''  }}" oninput="validateDateInput(c_date)">
                                <p class="input_error text-red-600"></p>
                            </div>
                        </div>

                    <div class="flex justify-end">
                        <button type="button" class="btn btn-primary" id="updateErisProfileDataButton" onclick="openConfirmationDialog(this, 'Confirm Changes', 'Are you sure you want to update this info?')">
                            Update Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection