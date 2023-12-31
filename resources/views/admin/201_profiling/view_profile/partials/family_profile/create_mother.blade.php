<form action="{{ route('family-profile-mother.store', ['cesno' => $cesno]) }}" method="POST" id="family_profile_mother" onsubmit="return checkErrorsBeforeSubmit(family_profile_mother)">
    @csrf
    
    <p class="font-xsm text-grey-500">Note: Mother's maiden name</p>
    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
        <div class="mb-3">
            <label for="mother_last_name">Last name<sup>*</sup></label>
            <input type="text" id="mother_last_name" name="mother_last_name" oninput="validateInput(mother_last_name, 2, 'letters')" onkeypress="validateInput(mother_last_name, 2, 'letters')" onblur="checkErrorMessage(mother_last_name)" required>
            <p class="input_error text-red-600"></p>
            @error('mother_last_name')
                <span class="invalid" role="alert">
                    <p>{{ $message }}</p>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="mother_first_name">First name<sup>*</span></label>
            <input type="text" id="mother_first_name" name="mother_first_name" oninput="validateInput(mother_first_name, 2, 'letters')" onkeypress="validateInput(mother_first_name, 2, 'letters')" onblur="checkErrorMessage(mother_first_name)" required>
            <p class="input_error text-red-600"></p>
            @error('mother_first_name')
                <span class="invalid" role="alert">
                    <p>{{ $message }}</p>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="mother_middle_name">Middle name<sup>*</span></label>
            <input type="text" id="mother_middle_name" name="mother_middle_name" oninput="validateInput(mother_middle_name, 2, 'letters')" onkeypress="validateInput(mother_middle_name, 2, 'letters')" onblur="checkErrorMessage(mother_middle_name)" required>
            <p class="input_error text-red-600"></p>
            @error('mother_middle_name')
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

