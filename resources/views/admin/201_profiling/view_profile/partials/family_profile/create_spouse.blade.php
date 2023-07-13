


<form action="{{ route('family-profile.store', ['cesno' => $mainProfile->cesno]) }}" method="POST">

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

    <div class="flex justify-end">
        <button type="submit" class="btn btn-primary">
            Save
        </button>
    </div>
</form>


