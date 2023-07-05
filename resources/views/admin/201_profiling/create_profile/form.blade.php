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
            {{-- <label for="title">Title<sup>*</sup></label>
            <input id="title" name="title" value="{{ old('title') }}" readonly> --}}

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
            {{-- <label for="status">Record Status<sup>*</span></label>
            <input name="status" id="status" value="{{ old('status') }}" readonly> --}}

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
            <input type="text" id="lastname" name="lastname" value="{{ old('lastname') }}">
        </div>

        <div class="mb-3">
            <label for="firstname">Firstname<sup>*</sup></label>
            <input type="text" id="firstname" name="firstname" value="{{ old('firstname') }}">
        </div>

        <div class="mb-3">
            {{-- <label for="ne">Name Extension</label>
            <input name="ne" id="ne" value="{{ old('ne') }}" readonly> --}}

            <label for="name_extension">Name Extension</label>
            <select name="name_extension" id="name_extension" >
                <option disabled selected>Please Select</option>
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
            {{-- <label for="middlename">Middlename<sup>*</sup></label>
            <input type="text" id="middlename" name="middlename" value="{{ old('middlename') }}" readonly> --}}

            <label for="middlename">Middlename<sup>*</sup></label>
            <input type="text" id="middlename" name="middlename" onkeyup="generateMiddleInitial()">

        </div>

        <div class="mb-3">
            {{-- <label for="mi">Middle initial<sup>*</sup></label>
            <input type="text" id="mi" name="mi" value="{{ old('mi') }}" readonly> --}}

            <label for="mi">Middle initial<sup>*</sup></label>
            <input type="text" id="mi" name="mi" readonly>

        </div>

        <div class="mb-3">
            <label for="nickname">Nickname</label>
            <input type="text" id="nickname" name="nickname" value="{{ old('nickname') }}">
        </div>
    </div>

    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

        <div class="mb-3">
            {{-- <label for="birthdate">Birthdate<sup>*</sup></label>
            <input type="date" id="birthdate" name="birthdate" value="{{ old('birthday') }}" readonly> --}}

            <label for="birthdate">Birthdate<sup>*</sup></label>
            <input type="date" id="birthdate" name="birthdate" onchange="computeAge()" required>

        </div>
        <div class="mb-3">
            {{-- <label for="age">Age<sup class="text-danger">*</sup></label>
            <input type="number" id="age" name="age" value="{{ old('age') }}" readonly> --}}

            <label for="age">Age<sup class="text-danger">*</sup></label>
            <input type="number" id="age" name="age" class="age form-control w-100 mb-3" readonly>

        </div>

        <div class="mb-3">
            <label for="birth_place">Birth Place<sup>*</sup></label>
            <input type="text" id="birth_place" name="birth_place" value="{{ old('birth_place') }}">
        </div>

    </div>

    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
        <div class="mb-3">
            {{-- <label for="gender">Gender By Birth<sup>*</sup></label>
            <input id="gender" name="gender" value="{{ old('gender') }}" readonly> --}}

            <label for="gender">Gender By Birth<sup>*</sup></label>
            <select id="gender" name="gender" >
                <option disabled selected>Please Select</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Prefer not to say">Prefer not to say</option>
            </select>

        </div>

        <div class="mb-3">
            {{-- <label for="gender_by_choice">Gender By Choice<sup>*</sup></label>
            <input id="gender_by_choice" name="gender_by_choice" value="{{ old('gender_by_choice') }}" readonly> --}}
            
            <label for="gender_by_choice">Gender By Choice<sup>*</sup></label>
            <select id="gender_by_choice" name="gender_by_choice" >
                <option disabled selected>Please Select</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Female">Transgender</option>
                <option value="Female">Gender neutral</option>
                <option value="Female">Non-binary</option>
                <option value="Female">Agender</option>
                <option value="Female">Pangender</option>
                <option value="Female">Genderqueer</option>
                <option value="Female">Two-spirit</option>
                <option value="Female">Third gender</option>
                <option value="Female">Others</option>
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
            <input id="religion" name="religion" value="{{ old('religion') }}">
        </div>

        <div class="mb-3">
            <label for="height">Height (in meters)<sup>*</sup></label>
            <input type="text" id="height" name="height" value="{{ old('height') }}">
        </div>
        <div class="mb-3">
            <label for="weight">Weight (in kilograms)<sup>*</sup></label>
            <input type="text" id="weight" name="weight" value="{{ old('weight') }}">
        </div>

    </div>

    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

        <div class="mb-3">
            {{-- <label for="sppd_ip_TxtB">Solo Parent?<sup>*</sup></label>
            <input name="sp" id="sppd_ip_TxtB" value="{{ old('sppd_ip_TxtB') }}" readonly> --}}

            <label for="single_parent">Solo Parent?<sup>*</sup></label>
            <select name="single_parent" id="single_parent" class="w-100 form-control mb-3" >
            <option disabled selected>Please Select</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
            </select>

        </div>

        <div class="mb-3">
            {{-- <label for="moig">Member of Indigenous Group?<sup>*</sup></label>
            <input name="moig" id="moig" value="{{ old('moig') }}"readonly> --}}

            <label for="member_of_indigenous_group">Member of Indigenous Group?<sup>*</sup></label>
            <select name="member_of_indigenous_group" id="member_of_indigenous_group" name="member_of_indigenous_group" onchange="toggleIndigenousDependentField()">
                <option disabled selected>Please Select</option>
                <option value="Not a member">Not a member</option>
                <option value="Igorot">Igorot</option>
                <option value="Lumad">Lumad</option>
                <option value="Mangyan">Mangyan</option>
                <option value="B'laan">B'laan</option>
                <option value="Tagbanua">Tagbanua</option>
                <option value="Others">Others</option>
                <option value="Prefer not to say">Prefer not to say</option>
            </select>

        </div>

        <div class="mb-3">
            {{-- <label for="moig_others">If others, please specify</label>
            <input type="text" id="moig_others" name="moig_others" readonly disabled> --}}

            <div id="dependent-indigenous-field" style="display: none;">
                <label for="dependent-indigenous-input">If others, please specify:</label>
                <input type="text" id="dependent-indigenous-input" name="moig_others">
                <br>
            </div>

        </div>

    </div>

    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
        <div class="mb-3">
            {{-- <label for="citizenship">Citizenship<sup>*</sup></label>
            <input name="citizenship" id="citizenship" value="{{ old('citizenship') }}" readonly> --}}

            <label for="citizenship">Citizenship<sup>*</sup></label>
            <select name="citizenship" id="citizenship" class="form-control w-100 citizenShip mb-3" onchange="toggleCitizenshipDependentField()" required>
            <option disabled selected>Please Select</option>
            <option value="Filipino">Filipino</option>
            <option value="Dual Citizenship">Dual Citizenship</option>
            </select>

        </div>

        <div class="mb-3">
            {{-- <label for="inputcitizenShip">If Holder Dual Citizenship By Birth, By Naturalization</label>
            <input type="text" name="d_citizenship" id="inputcitizenShip" value="{{ old('d_citizenship') }}" readonly> --}}

            <div id="dependent-dual-citizenship-field" style="display: none;">
                <label for="dependent-dual-citizenship-input">If Holder has Dual Citizenship:</label>
                <input type="text" id="dependent-dual-citizenship-input" name="dual_citizenship" placeholder="Please indicate the Country">
                <br>
            </div>

        </div>

        <div class="mb-3">
        </div>

    </div>

    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

        <div class="mb-3">
            {{-- <label for="pwd_CheckB" class="ml-2 text-sm font-medium text-gray-900">is PWD?</label>
            <input name="pwd" id="pwd_TxtB" value="{{ old('pwd_CheckB') }}" readonly> --}}

            <label for="person_with_disability">Is PWD?<sup>*</sup></label>
            <select name="person_with_disability" id="person_with_disability" class="form-control w-100 mb-3" onchange="toggleDisabilityDependentField()">
            <option disabled selected>Please Select</option>
            <option value="No">No</option>
            <option value="Yes">Yes</option>
            </select>

        </div>

        <div class="mb-3">
            <div id="dependent-pwd-field" style="display: none;">
                <label for="dependent_pwd_input">Disability:</label>
                <input type="text" id="dependent_pwd_input" name="dependent_pwd_input" placeholder="Please indicate the disability">
                <br>
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
                <input type="text" id="gsis" name="gsis" value="{{ old('gsis') }}">
            </div>
            <div class="mb-3">
                <label for="pagibig">PAG-IBIG ID No.<sup>*</sup></label>
                <input type="text" id="pagibig" name="pagibig" value="{{ old('pagibig') }}">
            </div>

            <div class="mb-3">
                <label for="philhealt">PHILHEALTH ID No.<sup>*</sup></label>
                <input type="text" id="philhealt" name="philhealth" value="{{ old('philhealt') }}">
            </div>

        </div>

        <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
            <div class="col-md-4">
                <label for="sss_no">SSS ID No.</label>
                <input type="text" id="sss_no" name="sss_no" value="{{ old('sss_no') }}">
            </div>
            <div class="col-md-4">
                <label for="tin">TIN ID No.</label>
                <input type="text" id="tin" name="tin" value="{{ old('tin') }}">
            </div>
        </div>
    </section>

    </div>

    <input type="submit" value="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">

</form>    

<script>

    function computeAge() {
        var birthDate = document.getElementById('birthdate').value;
        var today = new Date();
        var age = today.getFullYear() - new Date(birthDate).getFullYear();
        var monthDiff = today.getMonth() - new Date(birthDate).getMonth();
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < new Date(birthDate).getDate())) {
            age--;
        }
        document.getElementById('age').value = age;
    }

    function generateMiddleInitial() {
        var middleName = document.getElementById('middlename').value;
        var middleInitial = '';
        if (middleName.trim() !== '') {
            middleInitial = middleName.trim().charAt(0).toUpperCase() + '.';
        }
        document.getElementById('mi').value = middleInitial;
    }

    function toggleIndigenousDependentField() {
        var selectElement = document.getElementById('member_of_indigenous_group');
        var dependentField = document.getElementById('dependent-indigenous-field');
        var dependentInput = document.getElementById('dependent-indigenous-input');
    
        if (selectElement.value === 'Others') {
            dependentField.style.display = 'block';
            dependentInput.required = true;
        } else {
            dependentField.style.display = 'none';
            dependentInput.required = false;
        }
    }

    function toggleCitizenshipDependentField() {
        var selectElement = document.getElementById('citizenship');
        var dependentField = document.getElementById('dependent-dual-citizenship-field');
        var dependentInput = document.getElementById('dependent-dual-citizenship-input');
    
        if (selectElement.value === 'Dual Citizenship') {
            dependentField.style.display = 'block';
            dependentInput.required = true;
        } else {
            dependentField.style.display = 'none';
            dependentInput.required = false;
        }
    }

    function toggleDisabilityDependentField() {
        var selectElement = document.getElementById('person_with_disability');
        var dependentField = document.getElementById('dependent-pwd-field');
        var dependentInput = document.getElementById('dependent_pwd_input');
    
        if (selectElement.value === 'Yes') {
            dependentField.style.display = 'block';
            dependentInput.required = true;
        } else {
            dependentField.style.display = 'none';
            dependentInput.required = false;
        }
    }

</script>

@endsection
