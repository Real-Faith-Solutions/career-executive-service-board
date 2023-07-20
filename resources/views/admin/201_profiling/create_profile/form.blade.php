@extends('layouts.app')
@section('title', 'Add profile')
@section('content')
    <div class="mb-3 bg-blue-500 p-2 uppercase text-white">
        <h1>Personal data</h1>
    </div>

    <form action="{{ route('add-profile-201') }}" enctype="multipart/form-data" id="personal_data" method="POST">

        @csrf

        <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
            <div class="mb-3">
                <label for="cesno">CES Number</label>
                <input id="cesno" name="cesno" readonly type="number" value="{{ $cesNumber }}">

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
                <select id="title" name="title" required>
                    <option disabled selected>Please Select Title</option>
                    @foreach ($title as $data)
                        <option value="{{ $data->name }}">{{ $data->name }}</option>
                    @endforeach
                </select>

            </div>

            <div class="mb-3">

                <label for="status">Record Status<sup>*</span></label>
                <select id="status" name="status" required>
                    <option disabled selected>Please Select Record Status</option>
                    @foreach ($recordStatus as $data)
                        <option value="{{ $data->name }}">{{ $data->name }}</option>
                    @endforeach
                </select>

            </div>

            <div class="mb-3">
                <label for="email">Email<sup>*</sup></label>
                <input id="email" name="email" type="text" value="{{ old('email') }}">
                <p class="text-red-600"></p>
            </div>

        </div>

        <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

            <div class="mb-3">
                <label for="lastname">Lastname<sup>*</sup></label>
                <input id="lastname" name="lastname" type="text" value="{{ old('lastname') }}">
                <p class="personal_data_error text-red-600" id="ErrorMessageLastName"></p>
            </div>

            <div class="mb-3">
                <label for="firstname">Firstname<sup>*</sup></label>
                <input id="firstname" name="firstname" type="text" value="{{ old('firstname') }}">
                <p class="personal_data_error text-red-600" id="ErrorMessageFirstname"></p>
            </div>

            <div class="mb-3">

                <label for="name_extension">Name Extension</label>
                <input id="name_extension" list="name_extension_choices" name="name_extension" type="search">
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
                <input class="personal_data_error" id="middlename" name="middlename" onkeyup="generateMiddleInitial()" type="text">
                <p class="text-red-600" id="ErrorMessageMiddlename"></p>
            </div>

            <div class="mb-3">

                <label for="mi">Middle initial<sup>*</sup></label>
                <input id="mi" name="middleinitial" readonly type="text">

            </div>

            <div class="mb-3">
                <label for="nickname">Nickname</label>
                <input id="nickname" name="nickname" type="text" value="{{ old('nickname') }}">
                <p class="text-red-600" id="ErrorMessageNickname"></p>
            </div>
        </div>

        <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

            <div class="mb-3">
                <label for="birthdate">Birthdate<sup>*</sup></label>
                <input id="birthdate" name="birthdate" onchange="computeAge()" required type="date">

            </div>
            <div class="mb-3">

                <label for="age">Age<sup class="text-danger">*</sup></label>
                <input class="age form-control w-100 mb-3" id="age" name="age" readonly type="number">

            </div>

            <div class="mb-3">
                <label for="birth_place">Birth Place<sup>*</sup></label>
                <input id="birth_place" name="birth_place" type="text" value="{{ old('birth_place') }}">
            </div>

        </div>

        <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
            <div class="mb-3">
                <label for="gender">Gender By Birth<sup>*</sup></label>
                <select id="gender" name="gender" required>
                    <option disabled selected>Please Select Gender by Birth</option>
                    @foreach ($genderByBirths as $data)
                        <option value="{{ $data->name }}">{{ $data->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="gender_by_choice">Gender By Choice<sup>*</sup></label>
                <input id="gender_by_choice" list="gender_by_choice_choices" name="gender_by_choice" required type="search">
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
                        <option value="{{ $data->name }}">{{ $data->name }}</option>
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
                <input id="height" name="height" type="number" value="{{ old('height') }}">
            </div>

            <div class="mb-3">
                <label for="weight">Weight (in kilograms)<sup>*</sup></label>
                <input id="weight" name="weight" type="number" value="{{ old('weight') }}">
            </div>

        </div>

        <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

            <div class="mb-3">
                <label for="single_parent">Solo Parent?<sup>*</sup></label>
                <select class="w-100 form-control mb-3" id="single_parent" name="single_parent">
                    <option disabled selected>Please Select</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>

            </div>

            <div class="mb-3">
                <label for="member_of_indigenous_group">Member of Indigenous Group?<sup>*</sup></label>
                <input id="member_of_indigenous_group" list="member_of_indigenous_group_choices" name="member_of_indigenous_group" name="member_of_indigenous_group" required type="search">
                <datalist id="member_of_indigenous_group_choices">
                    @foreach ($indigenousGroups as $data)
                        <option value="{{ $data->name }}">{{ $data->name }}</option>
                    @endforeach
                </datalist>
            </div>

            <div class="mb-3">
                <label for="person_with_disability">Is PWD?<sup>*</sup></label>
                <input id="person_with_disability" list="person_with_disability_choices" name="person_with_disability" required type="search">
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
                    <option value="Filipino">Filipino</option>
                    <option value="Dual Citizenship">Dual Citizenship</option>
                </select>

            </div>

            <div class="mb-3">
                <div id="dependent-dual-citizenship-field" style="display: none;">
                    <label for="dependent-dual-citizenship-input">If Holder has Dual Citizenship:</label>
                    <input id="dependent-dual-citizenship-input" list="dependent-dual-citizenship-input_choices" name="dual_citizenship" placeholder="Please indicate the Country" required type="search">
                    <datalist id="dependent-dual-citizenship-input_choices">
                        @foreach ($countries as $data)
                            <option value="{{ $data->name }}">{{ $data->name }}</option>
                        @endforeach
                    </datalist>
                </div>
            </div>

        </div>

        {{-- identification cards --}}
        {{-- <section>
            <div class="mb-3 bg-blue-500 p-2 uppercase text-white">
                <h1>Identification cards</h1>
            </div>

            <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                <div class="mb-3">
                    <label for="gsis">GSIS ID No. <sup>*</sup></label>
                    <input id="gsis" name="gsis" type="text" value="{{ old('gsis') }}">
                </div>
                <div class="mb-3">
                    <label for="pagibig">PAG-IBIG ID No.<sup>*</sup></label>
                    <input id="pagibig" name="pagibig" type="text" value="{{ old('pagibig') }}">
                </div>

                <div class="mb-3">
                    <label for="philhealt">PHILHEALTH ID No.<sup>*</sup></label>
                    <input id="philhealth" name="philhealth" type="text" value="{{ old('philhealth') }}">
                </div>

            </div>

            <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                <div class="col-md-4">
                    <label for="sss_no">SSS ID No.</label>
                    <input id="sss_no" name="sss_no" type="text" value="{{ old('sss_no') }}">
                </div>
                <div class="col-md-4">
                    <label for="tin">TIN ID No.</label>
                    <input id="tin" name="tin" type="text" value="{{ old('tin') }}">
                </div>
            </div>
        </section> --}}
        {{-- end identification cards --}}

        <div class="flex justify-end">
            <button class="btn btn-primary" id="personal_data_submit" type="submit">Submit</button>
        </div>
    </form>

@endsection
