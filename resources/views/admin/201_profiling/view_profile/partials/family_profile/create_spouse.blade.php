<form action="{{ route('family-profile.store', ['cesno' => $cesno]) }}" method="POST" id="family_profile_spouse" onsubmit="return checkErrorsBeforeSubmit(family_profile_spouse)">

    @csrf

    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

        <div class="mb-3">
            <label for="last_name">Last Name<sup>*</sup></label>
            <input type="text" id="spouse_last_name" name="last_name" oninput="validateInput(spouse_last_name, 2, 'letters')" onkeypress="validateInput(spouse_last_name, 2, 'letters')" onblur="checkErrorMessage(spouse_last_name)" required>
            <p class="input_error text-red-600"></p>
            @error('last_name')
                <span class="invalid" role="alert">
                    <p>{{ $message }}</p>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="first_name">First Name<sup>*</span></label>
            <input type="text" id="spouse_first_name" name="first_name" oninput="validateInput(spouse_first_name, 2, 'letters')" onkeypress="validateInput(spouse_first_name, 2, 'letters')" onblur="checkErrorMessage(spouse_first_name)" required>
            <p class="input_error text-red-600"></p>
            @error('first_name')
                <span class="invalid" role="alert">
                    <p>{{ $message }}</p>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="middle_name">Middle Name<sup>*</span></label>
            <input type="text" id="spouse_middle_name" name="middle_name" oninput="validateInput(spouse_middle_name, 2, 'letters')" onkeypress="validateInput(spouse_middle_name, 2, 'letters')" onblur="checkErrorMessage(spouse_middle_name)" required>
            <p class="input_error text-red-600"></p>
            @error('middle_name')
                <span class="invalid" role="alert">
                    <p>{{ $message }}</p>
                </span>
            @enderror
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

        <div class="mb-3">
            <label for="occupation">Occupation</label>
            <input type="text" id="spouse_occupation" name="occupation" oninput="validateInput(spouse_occupation, 0, 'letters')" onkeypress="validateInput(spouse_occupation, 0, 'letters')" onblur="checkErrorMessage(spouse_occupation)">
            <p class="input_error text-red-600"></p>
            @error('occupation')
                <span class="invalid" role="alert">
                    <p>{{ $message }}</p>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="employer_bussiness_name">Employer/Bussiness Name</label>
            <input type="text" id="spouse_employer_bussiness_name" name="employer_bussiness_name" oninput="validateInput(spouse_employer_bussiness_name, 0, 'letters')" onkeypress="validateInput(spouse_employer_bussiness_name, 0, 'letters')" onblur="checkErrorMessage(spouse_employer_bussiness_name)">
            <p class="input_error text-red-600"></p>
            @error('employer_bussiness_name')
                <span class="invalid" role="alert">
                    <p>{{ $message }}</p>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="employer_bussiness_address">Employer/Bussiness Address</label>
            <input type="text" id="spouse_employer_bussiness_address" name="employer_bussiness_address" oninput="validateInput(spouse_employer_bussiness_address, 0)" onkeypress="validateInput(spouse_employer_bussiness_address, 0)" onblur="checkErrorMessage(spouse_employer_bussiness_address)">
            <p class="input_error text-red-600"></p>
            @error('employer_bussiness_address')
                <span class="invalid" >
                    <p>{{ $message }}</p>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="employer_bussiness_telephone">Employer/Bussiness Telephone No.</label>
            <input type="text" id="spouse_employer_bussiness_telephone" name="employer_bussiness_telephone" oninput="validateInput(spouse_employer_bussiness_telephone, 0, 'numbersWithSpecial')" onkeypress="validateInput(spouse_employer_bussiness_telephone, 0, 'numbersWithSpecial')" onblur="checkErrorMessage(spouse_employer_bussiness_telephone)">
            <p class="input_error text-red-600"></p>
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


