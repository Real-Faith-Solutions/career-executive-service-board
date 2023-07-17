

<form action="{{ route('family-profile-children.store', ['cesno' => $mainProfile->cesno]) }}" id="family-profile-children" method="POST">
    @csrf

    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

        <div class="mb-3">
            <label for="last_name">Last Name<sup>*</sup></label>
            <input type="text" id="children_last_name" name="last_name" required>
            <p class="family_profile_children_error text-red-600" id="ErrorMessageChildrenLastName"></p>
            @error('last_name')
                <span class="invalid" role="alert">
                    <p>{{ $message }}</p>
                </span>
            @enderror
        </div>

        {{-- <div></div> --}}

        <div class="mb-3">
            <label for="first_name">First Name<sup>*</span></label>
            <input type="text" id="children_first_name" name="first_name" required>
            <p class="family_profile_children_error text-red-600" id="ErrorMessageChildrenFirstName"></p>
            @error('first_name')
                <span class="invalid" role="alert">
                    <p>{{ $message }}</p>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="middle_name">Middle Name</label>
            <input type="text" id="children_middle_name" name="middle_name">
            <p class="family_profile_children_error text-red-600" id="ErrorMessageChildrenMiddleName"></p>
            @error('middle_name')
                <span class="invalid" role="alert">
                    <p>{{ $message }}</p>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="name_extension">Name Extension</label>
            <input type="text" id="children_name_extension" name="name_extension">

            @error('name_extension')
                <span class="invalid" role="alert">
                    <p>{{ $message }}</p>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="birthdate">Birthday<sup>*</span></label>
            <input type="date" name="birthdate" id="birthdate" required>

            @error('birthdate')
                <span class="invalid" role="alert">
                    <p>{{ $message }}</p>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="birth_place">Birthplace<sup>*</span></label>
            <input type="text" name="birth_place" id="birth_place" required>

            @error('birth_place')
                <span class="invalid" role="alert">
                    <p>{{ $message }}</p>
                </span>
            @enderror
        </div>
    </div>

    <div>
        <div class="flex justify-end">
            <button type="submit" class="btn btn-primary">
                Save
            </button>
        </div>
    </div>
</form>


