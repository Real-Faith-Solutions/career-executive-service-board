{{-- children details --}}
<form action="{{ route('family-profile-children.store', ['cesno' => $cesno]) }}"  method="POST" id="family_profile_children" onsubmit="return checkErrorsBeforeSubmit(family_profile_children)">
    @csrf

    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

        <div class="mb-3">
            <label for="last_name">Last Name<sup>*</sup></label>
            <input type="text" id="children_last_name" name="last_name" oninput="validateInput(children_last_name, 2, 'letters')" onkeypress="validateInput(children_last_name, 2, 'letters')" onblur="checkErrorMessage(children_last_name)" required>
            <p class="input_error text-red-600"></p>
            @error('last_name')
                <span class="invalid" role="alert">
                    <p>{{ $message }}</p>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="first_name">First Name<sup>*</span></label>
            <input type="text" id="children_first_name" name="first_name" oninput="validateInput(children_first_name, 2, 'letters')" onkeypress="validateInput(children_first_name, 2, 'letters')" onblur="checkErrorMessage(children_first_name)" required>
            <p class="input_error text-red-600"></p>
            @error('first_name')
                <span class="invalid" role="alert">
                    <p>{{ $message }}</p>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="middle_name">Middle Name</label>
            <input type="text" id="children_middle_name" name="middle_name" oninput="validateInput(children_middle_name, 2, 'letters')" onkeypress="validateInput(children_middle_name, 2, 'letters')" onblur="checkErrorMessage(children_middle_name)" required>
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
            <label for="gender">Gender</label>
            <select id="gender" name="gender">
                @foreach ($genderLibrary as $data)
                    <option value="{{$data->name}}">{{$data->name}}</option>
                @endforeach
            </select>
            @error('gender')
                <span class="invalid" role="alert">
                    <p>{{ $message }}</p>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="birthdate">Birthday<sup>*</span></label>
            <input type="date" id="children_birthdate" name="birthdate" oninput="validateDateInput(children_birthdate)" required>
            <p class="input_error text-red-600"></p>
            @error('birthdate')
                <span class="invalid" role="alert">
                    <p>{{ $message }}</p>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="birth_place">Birthplace<sup>*</span></label>
            <input type="text" id="children_birth_place" name="birth_place" oninput="validateInput(children_birth_place, 2)" onkeypress="validateInput(children_birth_place, 2)" onblur="checkErrorMessage(children_birth_place)" required>
            <p class="input_error text-red-600"></p>
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


