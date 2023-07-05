@extends('layouts.app')
@section('title', 'Add profile')
@section('content')
<div class="mb-3 bg-blue-500 p-2 uppercase text-white">
    <h1>Personal data</h1>
</div>

<div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
    <div class="mb-3">
        <label for="cesno">CES Number</label>
        <input id="cesno" type="number" name="cesno" value="{{ old('cesno') }}" readonly>

    </div>

    <div></div>

    <div class="mb-3">
        <label for="picture">Upload 2x2 Photo (Min. of 300x300 px)</label>
        <input class="mb-3 p-1" id="picture" name="picture" accept="image/png, image/jpeg" type="file" onclick="validateFileSize(`picture`, 2)" />
    </div>

</div>

<div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

    <div class="mb-3">
        <label for="title">Title<sup>*</sup></label>
        <input id="title" name="title" value="{{ old('title') }}" readonly>

    </div>
    <div></div>

    <div class="mb-3">
        <label for="status">Record Status<sup>*</span></label>
        <input name="status" id="status" value="{{ old('status') }}" readonly>

    </div>

</div>

<div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

    <div class="mb-3">
        <label for="lastname">Lastname<sup>*</sup></label>
        <input type="text" id="lastname" name="lastname" value="{{ old('lastname') }}" readonly>
    </div>

    <div class="mb-3">
        <label for="firstname">Firstname<sup>*</sup></label>
        <input type="text" id="firstname" name="firstname" value="{{ old('firstname') }}" readonly>
    </div>

    <div class="mb-3">
        <label for="ne">Name Extension</label>
        <input name="ne" id="ne" value="{{ old('ne') }}" readonly>
    </div>

</div>

<div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

    <div class="mb-3">
        <label for="middlename">Middlename<sup>*</sup></label>
        <input type="text" id="middlename" name="middlename" value="{{ old('middlename') }}" readonly>
    </div>

    <div class="mb-3">
        <label for="mi">Middle initial<sup>*</sup></label>
        <input type="text" id="mi" name="mi" value="{{ old('mi') }}" readonly>
    </div>

    <div class="mb-3">
        <label for="nickname">Nickname</label>
        <input type="text" id="nickname" name="nickname" value="{{ old('nickname') }}" readonly>
    </div>
</div>

<div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

    <div class="mb-3">
        <label for="birthdate">Birthdate<sup>*</sup></label>
        <input type="date" id="birthdate" name="birthdate" value="{{ old('birthday') }}" readonly>
    </div>
    <div class="mb-3">
        <label for="age">Age<sup class="text-danger">*</sup></label>
        <input type="number" id="age" name="age" value="{{ old('age') }}" readonly>
    </div>

    <div class="mb-3">
        <label for="birth_place">Birth Place<sup>*</sup></label>
        <input type="text" id="birth_place" name="birth_place" value="{{ old('birth_place') }}" readonly>
    </div>

</div>

<div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
    <div class="mb-3">
        <label for="gender">Gender By Birth<sup>*</sup></label>
        <input id="gender" name="gender" value="{{ old('gender') }}" readonly>
    </div>

    <div class="mb-3">
        <label for="gender_by_choice">Gender By Choice<sup>*</sup></label>
        <input id="gender_by_choice" name="gender_by_choice" value="{{ old('gender_by_choice') }}" readonly>
    </div>

    <div class="mb-3">
        <label for="civil_status">Civil Status<sup>*</sup></label>
        <input id="civil_status" name="civil_status" value="{{ old('civil_status') }}" readonly>
    </div>

</div>

<div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

    <div class="mb-3">
        <label for="religion">Religion<sup>*</sup></label>
        <input id="religion" name="religion" value="{{ old('religion') }}" readonly>
    </div>

    <div class="mb-3">
        <label for="height">Height (in meters)<sup>*</sup></label>
        <input type="text" id="height" name="height" value="{{ old('height') }}" readonly>
    </div>
    <div class="mb-3">
        <label for="weight">Weight (in kilograms)<sup>*</sup></label>
        <input type="text" id="weight" name="weight" value="{{ old('weight') }}" readonly>
    </div>

</div>

<div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

    <div class="mb-3">
        <label for="moig">Member of Indigenous Group?<sup>*</sup></label>
        <input name="moig" id="moig" value="{{ old('moig') }}"readonly>
    </div>

    <div class="mb-3">
        <label for="moig_others">If others, please specify</label>
        <input type="text" id="moig_others" name="moig_others" readonly disabled>
    </div>

    <div class="mb-3">
        <label for="sppd_ip_TxtB">Solo Parent?<sup>*</sup></label>
        <input name="sp" id="sppd_ip_TxtB" value="{{ old('sppd_ip_TxtB') }}" readonly>
    </div>

</div>

<div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
    <div class="mb-3">
        <label for="citizenship">Citizenship<sup>*</sup></label>
        <input name="citizenship" id="citizenship" value="{{ old('citizenship') }}" readonly>
    </div>

    <div class="mb-3">
        <label for="inputcitizenShip">If Holder Dual Citizenship By Birth, By Naturalization</label>
        <input type="text" name="d_citizenship" id="inputcitizenShip" value="{{ old('d_citizenship') }}" readonly>
    </div>

    <div class="mb-3">
        <label for="pwd_CheckB" class="ml-2 text-sm font-medium text-gray-900">is PWD?</label>
        <input name="pwd" id="pwd_TxtB" value="{{ old('pwd_CheckB') }}" readonly>
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
            <input type="text" id="gsis" name="gsis" value="{{ old('gsis') }}" readonly>
        </div>
        <div class="mb-3">
            <label for="pagibig">PAG-IBIG ID No.<sup>*</sup></label>
            <input type="text" id="pagibig" name="pagibig" value="{{ old('pagibig') }}" readonly>
        </div>

        <div class="mb-3">
            <label for="philhealt">PHILHEALTH ID No.<sup>*</sup></label>
            <input type="text" id="philhealt" name="philhealt" value="{{ old('philhealt') }}" readonly>
        </div>

    </div>

    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
        <div class="col-md-4">
            <label for="sss_no">SSS ID No.</label>
            <input type="text" id="sss_no" name="sss_no" value="{{ old('sss_no') }}" readonly>
        </div>
        <div class="col-md-4">
            <label for="tin">TIN ID No.</label>
            <input type="text" id="tin" name="tin" value="{{ old('tin') }}" readonly>
        </div>
    </div>
</section>

</div>


@endsection
