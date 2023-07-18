{{-- father details --}}
<form action="{{ route('family-profile-father.store', ['cesno' => $mainProfile->cesno]) }}" method="POST" id="family_profile_father" onsubmit="return checkErrorsBeforeSubmit(family_profile_father)">

    @csrf

    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-2">

        <div class="mb-3">
            <label for="father_last_name">Last name<sup>*</sup></label>
            <input type="text" id="father_last_name" name="father_last_name" oninput="validateInput(father_last_name, 2)" onkeypress="validateInput(father_last_name, 2)" onblur="checkErrorMessage(father_last_name)" required>
            <p class="input_error text-red-600"></p>
            @error('father_last_name')
                <span class="invalid" role="alert">
                    <p>{{ $message }}</p>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="father_first_name">First name<sup>*</span></label>
            <input type="text" id="father_first_name" name="father_first_name" oninput="validateInput(father_first_name, 2)" onkeypress="validateInput(father_first_name, 2)" onblur="checkErrorMessage(father_first_name)" required>
            <p class="input_error text-red-600"></p>
            @error('father_first_name')
                <span class="invalid" role="alert">
                    <p>{{ $message }}</p>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="father_middle_name">Middle name</label>
            <input type="text" id="father_middle_name" name="father_middle_name" oninput="validateInput(father_middle_name, 0)" onkeypress="validateInput(father_middle_name, 0)" onblur="checkErrorMessage(father_middle_name)">
            <p class="input_error text-red-600"></p>
            @error('father_middle_name')
                <span class="invalid" role="alert">
                    <p>{{ $message }}</p>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="father_name_extension">Name Extension</label>
            <input id="father_name_extension" list="name_extension_choices" name="father_name_extension" type="search">
            <datalist id="name_extension_choices">
                @foreach ($nameExtensions as $data)
                    <option value="{{ $data->name }}">{{ $data->name }}</option>
                @endforeach
            </datalist>
        </div>

    </div>

    <div class="flex justify-end">
        <button type="submit" class="btn btn-primary">
            Save
        </button>
    </div>

</form>


