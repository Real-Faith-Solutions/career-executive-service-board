@extends('layouts.app')
@section('title', 'Eris Add New Profile')
@section('content')

<div class="flex justify-between">
    <div class="flex items-center">
        <form action="{{ route('eris.create') }}" method="GET">
            <div class="flex gap-4">
                <input type="text" name="search" id="search" list="searchResults" placeholder="Search..." value="{{ $search }}">
                <datalist id="searchResults">
                    @foreach($personalData as $personalDatas)
                        <option value="{{ $personalDatas->cesno }}">{{ $personalDatas->lastname }} {{ $personalDatas->firstname }} {{ $personalDatas->middlename }}<option>
                    @endforeach
                </datalist>
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </form>
    </div>

    <div class="flex justify-center items-center">
        <a href="{{ route('eris-index') }}" class="btn btn-primary" >Go back</a>
    </div>
</div>

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                ERAD Monitoring System Add Module
            </h1>
        </div>
        
        <div class="bg-white px-6 py-3">
            <form action="{{ route('eris.store') }}" method="POST" id="add_new_profile_form" onsubmit="return checkErrorsBeforeSubmit(add_new_profile_form)">
                @csrf
                    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                        <div class="mb-3">
                            <label for="cesno">CESNO<sup>*</sup></label>
                            <input type="text" id="cesno" name="cesno" value="{{ $personalDataSearchResult->cesno ?? '' }}" readonly>
                            @error('cesno')
                                <span class="invalid" role="alert">
                                    <p>{{ $message }}</p>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="name">Batch No<sup>*</sup></label>
                            <input type="text" id="name" name="name" value="{{ $acbatchno }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="acno">ACNO<sup>*</sup></label>
                            <input type="text" id="acno" name="acno" value="{{ $acno }}" readonly>
                        </div>
                    </div>

                    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                        <div class="mb-3">
                            <label for="lastname">Last Name<sup>*</sup></label>
                            <input type="text" id="lastname" name="lastname" value="{{ $personalDataSearchResult->lastname ?? '' }}" required readonly>
                        </div>

                        <div class="mb-3">
                            <label for="firstname">First Name<sup>*</sup></label>
                            <input type="text" id="firstname" name="firstname" value="{{ $personalDataSearchResult->firstname ?? '' }}" required readonly>
                        </div>

                        <div class="mb-3">
                            <label for="middlename">Middle Name</label>
                            <input type="text" id="middlename" name="middlename" value="{{ $personalDataSearchResult->middlename ?? '' }}" readonly>
                        </div>
                    </div>

                    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                        <div class="mb-3">
                            <label for="birthdate">Birth Date<sup>*</sup></label>
                            <input type="date" id="birthdate" name="birthdate" value="{{ old('birthdate') }}" onchange="computeAge()" oninput="validateDateInput(birthdate, 18)" required>
                        <p class="input_error text-red-600"></p>
                        </div>

                        {{-- age auto compute --}}
                            <div class="mb-3">
                                <label for="age">Age<sup>*</sup></label>
                                <input type="number" id="age" name="age" value="{{ old('age') }}" readonly>
                            </div>
                        {{-- age auto compute --}}
                
                        <div class="mb-3">
                            <label for="gender">Gender</label>
                            <select name="gender" id="gender">
                                <option disabled selected>Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>

                    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-4">
                        <div class="mb-3">
                            <label for="emailadd">Email<sup>*</sup></label>
                            <input type="text" id="emailadd" name="emailadd" oninput="validateInputEmail(emailadd)" onkeypress="validateInputEmail(emailadd)" onblur="checkErrorMessage(emailadd)">
                            <p class="input_error text-red-600"></p>
                            @error('emailadd')
                                <span class="invalid" role="alert">
                                    <p>{{ $message }}</p>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="contactno">Telephone No<sup>*</sup></label>
                            <input type="tel" id="contactno" name="contactno" >
                            @error('contactno')
                                <span class="invalid" role="alert">
                                    <p>{{ $message }}</p>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="mobileno">Mobile No</label>
                            <input type="text" id="mobileno" name="mobileno" oninput="validateInput(mobileno, 10, 'numbersWithSpecial')" onkeypress="validateInput(mobileno, 10, 'numbersWithSpecial')" onblur="checkErrorMessage(mobileno)">
                            <p class="input_error text-red-600"></p>
                            @error('mobileno')
                                <span class="invalid" role="alert">
                                    <p>{{ $message }}</p>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="faxno">Fax No</label>
                            <input type="text" id="faxno" name="faxno" >
                            @error('faxno')
                                <span class="invalid" role="alert">
                                    <p>{{ $message }}</p>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-4">
                        <div class="mb-3">
                            <label for="position">Position<sup>*</sup></label>
                            <input type="text" id="position" name="position" >
                        </div>

                        <div class="mb-3">
                            <label for="position_remarks">Position Remarks<sup>*</sup></label>
                            <input type="text" id="position_remarks" name="position_remarks" >
                        </div>

                        <div class="mb-3">
                            <label for="office">Bureau Office</label>
                            <input type="text" id="office" name="office" >
                        </div>

                        <div class="mb-3">
                            <label for="department">Department/Agency<sup>*</sup></label>
                            <input type="text" id="department" name="department" >
                        </div>
                    </div>

                    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                        <div class="mb-3">
                            <label for="c_status">Conferment Status<sup>*</sup></label>
                            <input type="text" id="c_status" name="c_status" >
                        </div>

                        <div class="mb-3">
                            <label for="c_resno">Resolution No <sup>*</sup></label>
                            <input type="text" id="c_resno" name="c_resno" >
                        </div>

                        <div class="mb-3">
                            <label for="c_date">Date Conferred</label>
                            <input type="date" id="c_date" name="c_date" oninput="validateDateInput(c_date)">
                            <p class="input_error text-red-600"></p>
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