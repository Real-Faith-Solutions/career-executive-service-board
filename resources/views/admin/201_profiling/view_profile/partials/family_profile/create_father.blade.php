

<form action="{{ route('family-profile-father.store', ['cesno' => $mainProfile->cesno]) }}" method="POST">

    @csrf

    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-2">

        <div class="mb-3">
            <label for="father_last_name">Last name<sup>*</sup></label>
            <input type="text" id="father_last_name" name="father_last_name" required>

            @error('father_last_name')
                <span class="invalid" role="alert">
                    <p>{{ $message }}</p>
                </span>
            @enderror
        </div>

        {{-- <div></div> --}}

        <div class="mb-3">
            <label for="father_first_name">First name<sup>*</span></label>
            <input type="text" name="father_first_name" id="father_first_name" required>

            @error('father_first_name')
                <span class="invalid" role="alert">
                    <p>{{ $message }}</p>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="father_middle_name">Middle name</label>
            <input type="text" name="father_middle_name" id="father_middle_name">

            @error('father_middle_name')
                <span class="invalid" role="alert">
                    <p>{{ $message }}</p>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="father_name_extension">Name Extension</label>
            <input type="text" name="father_name_extension" id="father_name_extension">

            @error('father_name_extension')
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


