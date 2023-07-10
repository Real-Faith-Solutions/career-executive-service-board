@extends('layouts.app')
@section('title', 'Add profile')
@section('content')
<div class="mb-3 bg-blue-500 p-2 uppercase text-white">
    <h1>Personal data</h1>
</div>

<form id="personal_data" method="POST" enctype="multipart/form-data" action="{{ url('/add-profile-201') }}">

    @csrf

    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
        <div class="mb-3">
            <label for="cesno">CES Number</label>
            <input id="cesno" type="number" name="cesno" value="{{ $cesNumber }}" readonly>

        </div>

        <div></div>

        <div class="mb-3">
            {{-- <label for="picture">Upload 2x2 Photo (Min. of 300x300 px)</label> --}}
            {{-- <input class="mb-3 p-1" id="picture" name="picture" accept="image/png, image/jpeg" type="file" onclick="validateFileSize(`picture`, 2)" /> --}}
        </div>

    </div>

    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

        <div class="mb-3">

            <label for="title">Title<sup>*</sup></label>
            <select name="title" >
                <option disabled selected>Please Select</option>
                <option value="Dr.">Dr.</option>
                <option value="Atty.">Atty.</option>
                <option value="Mrs.">Mrs.</option>
                <option value="Ms.">Ms.</option>
                <option value="Mr.">Mr.</option>
            </select>

        </div>
        <div></div>

        <div class="mb-3">

            <label for="status">Record Status<sup>*</span></label>
            <select name="status" id="status" >
                <option disabled selected>Please Select</option>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
                <option value="Retired">Retired</option>
                <option value="Deceased">Deceased</option>
            </select>

        </div>

    </div>

    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

        <div class="mb-3">
            <label for="lastname">Lastname<sup>*</sup></label>
            <input type="text" id="lastname" name="lastname" value="{{ old('lastname') }}" class="border focus:outline-blue-600 transition-colors duration-300 ease-in-out">
            <p id="ErrorMessageLastName" class="personal_data_error text-red-600"></p>
        </div>

        <div class="mb-3">
            <label for="firstname">Firstname<sup>*</sup></label>
            <input type="text" id="firstname" name="firstname" value="{{ old('firstname') }}" class="border focus:outline-blue-600 transition-colors duration-300 ease-in-out">
            <p id="ErrorMessageFirstname" class="personal_data_error text-red-600"></p>
        </div>

        <div class="mb-3">

            <label for="name_extension">Name Extension</label>
            <select name="name_extension" id="name_extension" >
                <option disabled selected>Please Select</option>
                <option value="">N/A</option>
                <option value="Jr.">Jr.</option>
                <option value="Sr.">Sr.</option>
                <option value="I">I</option>
                <option value="II">II</option>
                <option value="III">III</option>
                <option value="IV">IV</option>
                <option value="V">V</option>
                <option value="VI">VI</option>
            </select>

        </div>

    </div>

    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

        <div class="mb-3">
            <label for="middlename">Middlename<sup>*</sup></label>
            <input type="text" id="middlename" name="middlename" onkeyup="generateMiddleInitial()" class="personal_data_error border focus:outline-blue-600 transition-colors duration-300 ease-in-out">
            <p id="ErrorMessageMiddlename" class="text-red-600"></p>
        </div>

        <div class="mb-3">

            <label for="mi">Middle initial<sup>*</sup></label>
            <input type="text" id="mi" name="mi" readonly>

        </div>

        <div class="mb-3">
            <label for="nickname">Nickname</label>
            <input type="text" id="nickname" name="nickname" value="{{ old('nickname') }}" class="border focus:outline-blue-600 transition-colors duration-300 ease-in-out">
            <p id="ErrorMessageNickname" class="text-red-600"></p>
        </div>
    </div>

    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

        <div class="mb-3">
            <label for="birthdate">Birthdate<sup>*</sup></label>
            <input type="date" id="birthdate" name="birthdate" onchange="computeAge()" required>

        </div>
        <div class="mb-3">

            <label for="age">Age<sup class="text-danger">*</sup></label>
            <input type="number" id="age" name="age" class="age form-control w-100 mb-3" readonly>

        </div>

        <div class="mb-3">
            <label for="birth_place">Birth Place<sup>*</sup></label>
            <input type="text" id="birth_place" name="birth_place" value="{{ old('birth_place') }}" class="border focus:outline-blue-600 transition-colors duration-300 ease-in-out">
        </div>

    </div>

    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
        <div class="mb-3">

            <label for="gender">Gender By Birth<sup>*</sup></label>
            <select id="gender" name="gender" >
                <option disabled selected>Please Select</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Prefer not to say">Prefer not to say</option>
            </select>

        </div>

        <div class="mb-3">

            <label for="gender_by_choice">Gender By Choice<sup>*</sup></label>
            <select id="gender_by_choice" name="gender_by_choice" >
                <option disabled selected>Please Select</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Transgender">Transgender</option>
                <option value="Gender neutral">Gender neutral</option>
                <option value="Non-binary">Non-binary</option>
                <option value="Agender">Agender</option>
                <option value="Pangender">Pangender</option>
                <option value="Genderqueer">Genderqueer</option>
                <option value="Two-spirit">Two-spirit</option>
                <option value="Third gender">Third gender</option>
                <option value="Prefer not to say">Prefer not to say</option>
            </select>
        </div>

        <div class="mb-3">
            {{-- <label for="civil_status">Civil Status<sup>*</sup></label>
            <input id="civil_status" name="civil_status" value="{{ old('civil_status') }}" readonly> --}}

            <label for="civil_status">Civil Status<sup>*</sup></label>
            <select id="civil_status" name="civil_status" aria-aria-controls='example' >
                <option disabled selected>Please Select</option>
                <option value="Married">Married</option>
                <option value="Single">Single</option>
                <option value="Divorced">Divorced</option>
                <option value="Widowed">Widowed</option>
                <option value="Separated">Separated</option>
                <option value="Other">Other</option>
            </select>
        </div>
    </div>

    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

        <div class="mb-3">
            <label for="religion">Religion<sup>*</sup></label>
            <input id="religion" name="religion" value="{{ old('religion') }}" class="border focus:outline-blue-600 transition-colors duration-300 ease-in-out">
        </div>

        <div class="mb-3">
            <label for="height">Height (in meters)<sup>*</sup></label>
            <input type="number" id="height" name="height" value="{{ old('height') }}" class="border focus:outline-blue-600 transition-colors duration-300 ease-in-out">
        </div>

        <div class="mb-3">
            <label for="weight">Weight (in kilograms)<sup>*</sup></label>
            <input type="number" id="weight" name="weight" value="{{ old('weight') }}" class="border focus:outline-blue-600 transition-colors duration-300 ease-in-out">
        </div>

    </div>

    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

        <div class="mb-3">
            <label for="single_parent">Solo Parent?<sup>*</sup></label>
            <select name="single_parent" id="single_parent" class="w-100 form-control mb-3" >
                <option disabled selected>Please Select</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>

        </div>

        <div class="mb-3">
            <label for="member_of_indigenous_group">Member of Indigenous Group?<sup>*</sup></label>
            <input type="search" list="member_of_indigenous_group_choices" name="member_of_indigenous_group" id="member_of_indigenous_group" name="member_of_indigenous_group">
                <datalist id="member_of_indigenous_group_choices">
                    <option value="Not a member">Not a member</option>
                    @foreach ($indigenousGroups as $indigenousGroup)
                        <option value="{{ $indigenousGroup->name }}">{{ $indigenousGroup->name }}</option>
                    @endforeach
                </datalist>
        </div>

        <div class="mb-3">
            <label for="person_with_disability">Is PWD?<sup>*</sup></label>
            <input type="search" list="person_with_disability_choices" name="person_with_disability" id="person_with_disability">
                <datalist id="person_with_disability_choices">
                    <option value="No">No</option>
                    <option value="Disability 1">Disability 1</option>
                    <option value="Disability 2">Disability 2</option>
                </datalist>
        </div>
    </div>

    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
        <div class="mb-3">
            <label for="citizenship">Citizenship<sup>*</sup></label>
            <select name="citizenship" id="citizenship" class="form-control w-100 citizenShip mb-3" onchange="toggleCitizenshipDependentField()" required>
                <option disabled selected>Please Select</option>
                <option value="Filipino">Filipino</option>
                <option value="Dual Citizenship">Dual Citizenship</option>
            </select>

        </div>

        <div class="mb-3">
            <div id="dependent-dual-citizenship-field" style="display: none;">
                <label for="dependent-dual-citizenship-input">If Holder has Dual Citizenship:</label>
                <input type="search" list="dependent-dual-citizenship-input_choices" id="dependent-dual-citizenship-input" name="dual_citizenship" placeholder="Please indicate the Country" class="border focus:outline-blue-600 transition-colors duration-300 ease-in-out">
                <datalist id="dependent-dual-citizenship-input_choices">
                    @foreach ($countries as $country)
                        <option value="{{ $country->name }}">{{ $country->name }}</option>
                    @endforeach
                </datalist>
            </div>
        </div>

    </div>

    {{-- identification cards --}}
    <section>
        <div class="mb-3 bg-blue-500 p-2 uppercase text-white">
            <h1>Identification cards</h1>
        </div>

        <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
            <div class="mb-3">
                <label for="gsis">GSIS ID No. <sup>*</sup></label>
                <input type="text" id="gsis" name="gsis" value="{{ old('gsis') }}" class="border focus:outline-blue-600 transition-colors duration-300 ease-in-out">
            </div>
            <div class="mb-3">
                <label for="pagibig">PAG-IBIG ID No.<sup>*</sup></label>
                <input type="text" id="pagibig" name="pagibig" value="{{ old('pagibig') }}" class="border focus:outline-blue-600 transition-colors duration-300 ease-in-out">
            </div>

            <div class="mb-3">
                <label for="philhealt">PHILHEALTH ID No.<sup>*</sup></label>
                <input type="text" id="philhealth" name="philhealth" value="{{ old('philhealth') }}" class="border focus:outline-blue-600 transition-colors duration-300 ease-in-out">
            </div>

        </div>

        <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
            <div class="col-md-4">
                <label for="sss_no">SSS ID No.</label>
                <input type="text" id="sss_no" name="sss_no" value="{{ old('sss_no') }}" class="border focus:outline-blue-600 transition-colors duration-300 ease-in-out">
            </div>
            <div class="col-md-4">
                <label for="tin">TIN ID No.</label>
                <input type="text" id="tin" name="tin" value="{{ old('tin') }}" class="border focus:outline-blue-600 transition-colors duration-300 ease-in-out">
            </div>
        </div>
    </section>

    </div>

    <input type="submit" id="personal_data_submit" value="submit" class="cursor-pointer text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">

</form>



@endsection
