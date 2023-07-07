@extends('layouts.app')
@section('title', 'Family profile form')
@section('content')

<div class="mb-3 bg-blue-500 p-2 uppercase text-white">
    <h1>Spouse Details</h1>
</div>

<form action="{{ route('family-profile.store', ['cesno' => $cesno]) }}" method="POST">
    @csrf

    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

        <div class="mb-3">
            <label for="last_name">Last Name<sup>*</sup></label>
            <input type="text" id="last_name" name="last_name" required>

            @error('last_name')
                <span class="invalid" role="alert">
                    <p>{{ $message }}</p>
                </span>
            @enderror
        </div>

        {{-- <div></div> --}}

        <div class="mb-3">
            <label for="first_name">First Name<sup>*</span></label>
            <input type="text" name="first_name" id="first_name" required>

            @error('first_name')
                <span class="invalid" role="alert">
                    <p>{{ $message }}</p>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="middle_name">Middle Name<sup>*</span></label>
            <input type="text" name="middle_name" id="middle_name">

            @error('middle_name')
                <span class="invalid" role="alert">
                    <p>{{ $message }}</p>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="name_extension">Name Extension<sup>*</span></label>
            <input type="text" name="name_extension" id="name_extension">

            @error('name_extension')
                <span class="invalid" role="alert">
                    <p>{{ $message }}</p>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="occupation">Occupation</label>
            <input type="text" name="occupation" id="occupation">

            @error('occupation')
                <span class="invalid" role="alert">
                    <p>{{ $message }}</p>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="employer_bussiness_name">Employer/Bussiness Name</label>
            <input type="text" name="employer_bussiness_name" id="employer_bussiness_name">

            @error('employer_bussiness_name')
                <span class="invalid" role="alert">
                    <p>{{ $message }}</p>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="employer_bussiness_address">Employer/Bussiness Address</label>
            <input type="text" name="employer_bussiness_address" id="employer_bussiness_address">

            @error('employer_bussiness_address')
                <span class="invalid" >
                    <p>{{ $message }}</p>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="employer_bussiness_telephone">Employer/Bussiness Telephone No.</label>
            <input type="text" name="employer_bussiness_telephone" id="employer_bussiness_telephone">

            @error('employer_bussiness_telephone')
                <span class="invalid" role="alert">
                    <p>{{ $message }}</p>
                </span>
            @enderror
        </div>

    </div>

    <div><button type="submit" class="btn btn-primary">Submit</button></div>
</form>

<br>

<div class="mb-3 bg-blue-500 p-2 uppercase text-white">
    <h1>Children Details</h1>
</div>

<form action="{{ route('family-profile-children.store', ['cesno' => $cesno]) }}" method="POST">
    @csrf

    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

        <div class="mb-3">
            <label for="last_name">Last Name<sup>*</sup></label>
            <input type="text" id="last_name" name="last_name" required>

            @error('last_name')
                <span class="invalid" role="alert">
                    <p>{{ $message }}</p>
                </span>
            @enderror
        </div>

        {{-- <div></div> --}}

        <div class="mb-3">
            <label for="first_name">First Name<sup>*</span></label>
            <input type="text" name="first_name" id="first_name" required>

            @error('first_name')
                <span class="invalid" role="alert">
                    <p>{{ $message }}</p>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="middle_name">Middle Name</label>
            <input type="text" name="middle_name" id="middle_name">

            @error('middle_name')
                <span class="invalid" role="alert">
                    <p>{{ $message }}</p>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="name_extension">Name Extension</label>
            <input type="text" name="name_extension" id="name_extension">

            @error('name_extension')
                <span class="invalid" role="alert">
                    <p>{{ $message }}</p>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="birthdate">Birthday</label>
            <input type="date" name="birthdate" id="birthdate" required>

            @error('birthdate')
                <span class="invalid" role="alert">
                    <p>{{ $message }}</p>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="birth_place">Birthplace</label>
            <input type="text" name="birth_place" id="birth_place" required>

            @error('birth_place')
                <span class="invalid" role="alert">
                    <p>{{ $message }}</p>
                </span>
            @enderror
        </div>
    </div>

    <div><button type="submit" class="btn btn-primary">Submit</button></div>
</form>

<br>

<div class="mb-3 bg-blue-500 p-2 uppercase text-white">
    <h1>Family Details</h1>
</div>

<form action="{{ route('family-profile-father-mother.store', ['cesno' => $cesno]) }}" method="POST">
    @csrf

    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-2">

        <div class="mb-3">
            <label for="father_last_name"> FatherLast Name<sup>*</sup></label>
            <input type="text" id="father_last_name" name="father_last_name" required>

            @error('father_last_name')
                <span class="invalid" role="alert">
                    <p>{{ $message }}</p>
                </span>
            @enderror
        </div>

        {{-- <div></div> --}}

        <div class="mb-3">
            <label for="father_first_name">Father First Name<sup>*</span></label>
            <input type="text" name="father_first_name" id="father_first_name" required>

            @error('father_first_name')
                <span class="invalid" role="alert">
                    <p>{{ $message }}</p>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="father_middle_name">Father Middle Name</label>
            <input type="text" name="father_middle_name" id="father_middle_name">

            @error('father_middle_name')
                <span class="invalid" role="alert">
                    <p>{{ $message }}</p>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="father_name_extension">Father Name Extension</label>
            <input type="text" name="father_name_extension" id="father_name_extension">

            @error('father_name_extension')
                <span class="invalid" role="alert">
                    <p>{{ $message }}</p>
                </span>
            @enderror
        </div>

    </div>

    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

        <div class="mb-3">
            <label for="mother_last_name">Mother Last Name<sup>*</sup></label>
            <input type="text" id="mother_last_name" name="mother_last_name" required>

            @error('mother_last_name')
                <span class="invalid" role="alert">
                    <p>{{ $message }}</p>
                </span>
            @enderror
        </div>

        {{-- <div></div> --}}

        <div class="mb-3">
            <label for="mother_first_name">Mother First Name<sup>*</span></label>
            <input type="text" name="mother_first_name" id="mother_first_name" required>

            @error('mother_first_name')
                <span class="invalid" role="alert">
                    <p>{{ $message }}</p>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="mother_middle_name">Mother Middle Name</label>
            <input type="text" name="mother_middle_name" id="mother_middle_name">

            @error('mother_middle_name')
                <span class="invalid" role="alert">
                    <p>{{ $message }}</p>
                </span>
            @enderror
        </div>

    </div>

    <div><button type="submit" class="btn btn-primary">Submit</button></div>
</form>

@endsection
