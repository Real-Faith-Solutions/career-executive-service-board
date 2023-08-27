@extends('layouts.app')
@section('title', 'Add profile')
@section('content')
    <div class="mb-3 bg-blue-500 p-2 uppercase text-white">
        <h1>Personal data</h1>
    </div>

    <form action="{{ route('add-profile-201', ['cesno'=>$cesNumber]) }}" enctype="multipart/form-data" id="personal_data" method="POST" onsubmit="return checkErrorsBeforeSubmit(personal_data)">

        @csrf

        <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

            <div class="mb-3">
                <label for="cesno">CES Number</label>
                <input id="cesno" name="cesno" readonly type="number" value="{{ $cesNumber }}">
            </div>

            <div></div>

            <div></div>

        </div>

        <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

            <div class="mb-3">

                <label for="title">Title<sup>*</sup></label>
                <select id="title" name="title" required>
                    <option disabled selected>Please Select Title</option>
                    @foreach ($title as $data)
                        <option value="{{ $data->name }}" {{ old('title') == $data->name ? 'selected' : '' }}>{{ $data->name }}</option>
                    @endforeach
                </select>

            </div>

            <div class="mb-3">

                <label for="status">Record Status<sup>*</span></label>
                <select id="status" name="status" required>
                    <option disabled selected>Please Select Record Status</option>
                    @foreach ($recordStatus as $data)
                        <option value="{{ $data->name }}" {{ old('status') == $data->name ? 'selected' : '' }}>{{ $data->name }}</option>
                    @endforeach
                </select>

            </div>

            <div class="mb-3">
                <label for="email">Email<sup>*</sup></label>
                <input id="personal_email" name="email" type="text" value="{{ old('email') }}" oninput="validateInputEmail(personal_email)" onkeypress="validateInputEmail(personal_email)" onblur="checkErrorMessage(personal_email)" required>
                <p class="input_error text-red-600"></p>
            </div>

        </div>

        <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

            <div class="mb-3">
                <label for="lastname">Lastname<sup>*</sup></label>
                <input id="lastname" name="lastname" type="text" value="{{ old('lastname') }}" oninput="validateInput(lastname, 2, 'letters')" onkeypress="validateInput(lastname, 2, 'letters')" onblur="checkErrorMessage(lastname)" required>
                <p class="input_error text-red-600"></p>
            </div>

            <div class="mb-3">
                <label for="firstname">Firstname<sup>*</sup></label>
                <input id="firstname" name="firstname" type="text" value="{{ old('firstname') }}" oninput="validateInput(firstname, 2, 'letters')" onkeypress="validateInput(firstname, 2, 'letters')" onblur="checkErrorMessage(firstname)" required>
                <p class="input_error text-red-600"></p>
            </div>

            <div class="mb-3">
                <label for="name_extension">Name Extension</label>
                <input id="name_extension" list="name_extension_choices" name="name_extension" type="search" value="{{ old('name_extension') }}">
                <datalist id="name_extension_choices">
                    @foreach ($nameExtensions as $data)
                        <option value="{{ $data->name }}">{{ $data->name }}</option>
                    @endforeach
                </datalist>
            </div>

        </div>

        <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

            <div class="mb-3">
                <label for="middlename">Middlename<sup>*</sup></label>
                <input id="middlename" name="middlename" type="text" value="{{ old('middlename') }}" onkeyup="generateMiddleInitial()" type="text" oninput="validateInput(middlename, 2, 'letters')" onkeypress="validateInput(middlename, 2, 'letters')" onblur="checkErrorMessage(middlename)">
                <p class="input_error text-red-600"></p>
            </div>

            <div class="mb-3">

                <label for="mi">Middle initial<sup>*</sup></label>
                <input id="mi" name="middleinitial" readonly type="text" value="{{ old('middleinitial') }}">

            </div>

            <div class="mb-3">
                <label for="nickname">Nickname</label>
                <input id="nickname" name="nickname" type="text" value="{{ old('nickname') }}" oninput="validateInput(nickname, 0, 'letters')" onkeypress="validateInput(nickname, 0, 'letters')" onblur="checkErrorMessage(nickname)">
                <p class="input_error text-red-600"></p>
            </div>
        </div>

        <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

            <div class="mb-3">
                <label for="birthdate">Birthdate<sup>*</sup></label>
                <input type="date" id="birthdate" name="birthdate" value="{{ old('birthdate') }}" onchange="computeAge()" oninput="validateDateInput(birthdate, 18)" required>
                <p class="input_error text-red-600"></p>
            </div>

            <div class="mb-3">
                <label for="age">Age<sup class="text-danger">*</sup></label>
                <input class="age form-control w-100 mb-3" id="age" name="age" value="{{ old('age') }}" readonly type="number">
            </div>

            <div class="mb-3">
                <label for="birth_place">Birth Place<sup>*</sup></label>
                <input id="birth_place" name="birth_place" type="text" value="{{ old('birth_place') }}" oninput="validateInput(birth_place, 2)" onkeypress="validateInput(birth_place, 2)" onblur="checkErrorMessage(birth_place)">
                <p class="input_error text-red-600"></p>
            </div>

        </div>

        <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
            <div class="mb-3">
                <label for="gender">Gender By Birth<sup>*</sup></label>
                <select id="gender" name="gender" required>
                    <option disabled selected>Please Select Gender by Birth</option>
                    @foreach ($genderByBirths as $data)
                        <option value="{{ $data->name }}" {{ old('gender') == $data->name ? 'selected' : '' }}>{{ $data->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="gender_by_choice">Gender By Choice<sup>*</sup></label>
                <input id="gender_by_choice" list="gender_by_choice_choices" name="gender_by_choice" value="{{ old('gender_by_choice') }}" required type="search">
                <datalist id="gender_by_choice_choices">
                    @foreach ($genderByChoices as $data)
                        <option value="{{ $data->name }}">{{ $data->name }}</option>
                    @endforeach
                </datalist>
            </div>

            <div class="mb-3">
                <label for="civil_status">Civil Status<sup>*</sup></label>
                <select id="civil_status" name="civil_status" required>
                    <option disabled selected>Please Select Civil Status</option>
                    @foreach ($civilStatus as $data)
                        <option value="{{ $data->name }}" {{ old('civil_status') == $data->name ? 'selected' : '' }}>{{ $data->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

            <div class="mb-3">
                <label for="religion">Religion<sup>*</sup></label>
                <input list="religion_choices" id="religion" name="religion" value="{{ old('religion') }}">
                <datalist id="religion_choices">
                    @foreach ($religion as $data)
                        <option value="{{ $data->name }}">{{ $data->name }}</option>
                    @endforeach
                </datalist>
            </div>

            <div class="mb-3">
                <label for="height">Height (in meters)<sup>*</sup></label>
                <input id="profile_height" name="height" type="text" value="{{ old('height') }}" oninput="validateInput(profile_height, 2, 'numbersWithSpecial')" onkeypress="validateInput(profile_height, 2, 'numbersWithSpecial')" onblur="checkErrorMessage(profile_height)">
                <p class="input_error text-red-600"></p>
            </div>

            <div class="mb-3">
                <label for="weight">Weight (in kilograms)<sup>*</sup></label>
                <input id="profile_weight" name="weight" type="text" value="{{ old('weight') }}" oninput="validateInput(profile_weight, 2, 'numbersWithSpecial')" onkeypress="validateInput(profile_weight, 2, 'numbersWithSpecial')" onblur="checkErrorMessage(profile_weight)">
                <p class="input_error text-red-600"></p>
            </div>

        </div>

        <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

            <div class="mb-3">
                <label for="single_parent">Solo Parent?<sup>*</sup></label>
                <select class="w-100 form-control mb-3" id="single_parent" name="single_parent">
                    <option disabled selected>Please Select</option>
                    <option value="Yes" {{ old('single_parent') == "Yes" ? 'selected' : '' }}>Yes</option>
                    <option value="No" {{ old('single_parent') == "No" ? 'selected' : '' }}>No</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="member_of_indigenous_group">Member of Indigenous Group?<sup>*</sup></label>
                <input id="member_of_indigenous_group" list="member_of_indigenous_group_choices" name="member_of_indigenous_group" value="{{ old('member_of_indigenous_group') }}" required type="search">
                <datalist id="member_of_indigenous_group_choices">
                    @foreach ($indigenousGroups as $data)
                        <option value="{{ $data->name }}">{{ $data->name }}</option>
                    @endforeach
                </datalist>
            </div>

            <div class="mb-3">
                <label for="person_with_disability">Is PWD?<sup>*</sup></label>
                <input id="person_with_disability" list="person_with_disability_choices" name="person_with_disability" value="{{ old('person_with_disability') }}" required type="search">
                <datalist id="person_with_disability_choices">
                    @foreach ($pwds as $data)
                        <option value="{{ $data->name }}">{{ $data->name }}</option>
                    @endforeach
                </datalist>
            </div>

        </div>

        <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

            <div class="mb-3">
                <label for="citizenship">Citizenship<sup>*</sup></label>
                <select class="form-control w-100 citizenShip mb-3" id="citizenship" name="citizenship" onchange="toggleCitizenshipDependentField()" required>
                    <option disabled selected>Please Select Citizenship</option>
                    <option value="Filipino" {{ old('citizenship') == "Filipino" ? 'selected' : '' }}>Filipino</option>
                    <option value="Dual-Citizenship" {{ old('citizenship') == "Dual-Citizenship" ? 'selected' : '' }}>Dual-Citizenship</option>
                </select>
            </div>

            <div class="mb-3">
                <div id="dependent-dual-citizenship-field" style="display: none;">
                    <label for="dependent-dual-citizenship-input">If has Dual Citizenship:</label>
                    <input id="dependent-dual-citizenship-input" list="dependent-dual-citizenship-input_choices" name="dual_citizenship" value="{{ old('dual_citizenship') }}" placeholder="Please indicate the Country" required type="search">
                    <datalist id="dependent-dual-citizenship-input_choices">
                        @foreach ($countries as $data)
                            <option value="{{ $data->name }}">{{ $data->name }}</option>
                        @endforeach
                    </datalist>
                </div>
            </div>

        </div>

        <div class="flex justify-end">
            <button class="btn btn-primary" id="personal_data_submit" type="submit">Submit</button>
        </div>
        
    </form>

@endsection
