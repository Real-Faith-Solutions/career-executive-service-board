<script>
    document.addEventListener("DOMContentLoaded", function() {
        const sectorDropdown = document.querySelector("#sectorDropdown");
        const departmentDropdown = document.querySelector('#departmentDropdown');
        const agencyLocationDropdown = document.querySelector('#agencyLocationDropdown');
        const oldDepartmentValue = @json(old('departmentDropdown', $departmentDropdown)); // Get the old input value or the initial value
        const oldAgencyLocationValue = @json(old('officelocid', $agencyLocationDropdown)); // Get the old input value or the initial value

        departmentDropdown.innerHTML = "";
        agencyLocationDropdown.innerHTML = "";
        
        const defaultOption = document.createElement("option");
        defaultOption.text = "Select Department / Agency";
        defaultOption.disabled = false;
        defaultOption.selected = true;
        defaultOption.value = "";
        departmentDropdown.appendChild(defaultOption);

        const defaultOptionAgencyLocation = document.createElement("option");
        defaultOptionAgencyLocation.text = "Select Agency Location";
        defaultOptionAgencyLocation.disabled = false;
        defaultOptionAgencyLocation.selected = true;
        defaultOptionAgencyLocation.value = "";
        agencyLocationDropdown.appendChild(defaultOptionAgencyLocation);
        
        // Function to populate the department dropdown
        function populateDepartmentDropdown() {
        departmentDropdown.innerHTML = "";
        agencyLocationDropdown.innerHTML = "";
        departmentDropdown.appendChild(defaultOption);
        
        // Populate the second dropdown based on the selected value of the first dropdown
        @foreach($department as $data)
            if ("{{ $data->sectorid }}" == sectorDropdown.value) {
                const option = document.createElement("option");
                option.value = "{{ $data->deptid }}";
                option.text = "{{ $data->title }}";
                    if ("{{ $data->deptid }}" == oldDepartmentValue) {
                        option.selected = true; // Select the option if it matches the oldDepartmentValue
                    }
                departmentDropdown.appendChild(option);
            }
        @endforeach
        }

        
        
        function populateAgencyLocationDropdown() {
        agencyLocationDropdown.innerHTML = "";
        agencyLocationDropdown.appendChild(defaultOptionAgencyLocation);
        @foreach($agencyLocation as $data)
            if ("{{ $data->deptid }}" == departmentDropdown.value) {
                const option = document.createElement("option");
                option.value = "{{ $data->officelocid }}";
                option.text = "{{ $data->title }}";
                    if ("{{ $data->officelocid }}" == oldAgencyLocationValue) {
                        option.selected = true;
                    }
                agencyLocationDropdown.appendChild(option);
            }
        @endforeach
        }

        // Initial population of department dropdown
        populateDepartmentDropdown();
        populateAgencyLocationDropdown();

        // Add an event listener to sectorDropdown
        sectorDropdown.addEventListener("change", function() {
            // Reset and populate the department dropdown when sectorDropdown changes
            populateDepartmentDropdown();
        });
        departmentDropdown.addEventListener("change", function() {
            // Reset and populate the department dropdown when sectorDropdown changes
            populateAgencyLocationDropdown();
        });
    });
</script>

@extends('layouts.app')
@section('title', 'Office Manager - Create')
@section('content')

<div class="my-5 flex justify-between gap-4">
    <a href="#" class="text-blue-500 uppercase text-2xl">
        @yield('title')
    </a>
    <a class="btn btn-primary" href="{{ route('library-office-manager.index') }}">Go back</a>
</div>

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Office Manager
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="{{ route('library-office-manager.store') }}" method="POST">
                @csrf
                <fieldset class="border p-4 bg-gray-50 mb-3">
                    <legend>Select options</legend>
                    <div class="sm:gid-cols-4 mb-3 grid gap-4 md:grid-cols-3 lg:grid-cols-3">

                        <div class="mb-3">
                            <label for="sectorDropdown">Sector</label>
                            <select id="sectorDropdown" name="sectorDropdown" required>
                                <option value="">Select Sector</option>
                                @foreach ($sector as $data)
                                <option value="{{ $data->sectorid }}" {{ old('sectorDropdown')==$data->sectorid ?
                                    'selected' : ''}}>
                                    {{ $data->title }}
                                </option>
                                @endforeach
                                @error('sectorDropdown')
                                <span class="invalid" role="alert">
                                    <p>{{ $message }}</p>
                                </span>
                                @enderror
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="departmentDropdown">Department</label>
                            <select id="departmentDropdown" name="departmentDropdown" required>
                            </select>
                            @error('departmentDropdown')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="agencyLocationDropdown">Agency Location</label>
                            <select id="agencyLocationDropdown" name="officelocid" required>
                            </select>
                            @error('officelocid')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                    </div>
                </fieldset>
                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-2">

                    <div class="mb-3">
                        <label for="title">Office<sup>*</sup></label>
                        <input name="title" id="title" value="{{ old('title') }}">
                        @error('title')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="acronym">Office acronym<sup>*</sup></label>
                        <input name="acronym" id="acronym" value="{{ old('acronym') }}" minlength="2" maxlength="10">
                        @error('acronym')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="website">Office website<sup>*</sup></label>
                        <input name="website" id="website" value="{{ old('website') }}" type="url">
                        @error('website')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="contactno">Office Contact No.</label>
                        <input id="contactno" name="contactno" value="{{ old('contactno') }}" type="tel" />
                        @error('contactno')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="emailadd">Office E-mail Address</label>
                        <input id="emailadd" name="emailadd" value="{{ old('emailadd') }}" type="email" />
                        @error('emailadd')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>

                </div>
                <hr>
                <h1 class="font-semibold">Office Address</h1>
                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-2">


                    <div class="mb-3">
                        <label for="floor_bldg">Floor / Bldg.</label>
                        <input id="floor_bldg" name="floor_bldg" value="{{ old('floor_bldg') }}" />
                        @error('floor_bldg')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="house_no_st">No. / Street</label>
                        <input id="house_no_st" name="house_no_st" value="{{ old('house_no_st') }}" />
                        @error('house_no_st')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="brgy_dist">Brgy. / District</label>
                        <input id="brgy_dist" name="brgy_dist" value="{{ old('brgy_dist') }}" />
                        @error('brgy_dist')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="city_code">City Municipality<sup>*</sup></label>
                        <select id="city_code" name="city_code" required>
                            <option disabled selected value="">Select City Municipality</option>
                            @foreach ($cities as $data)
                            <option value="{{ $data->city_code }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                        @error('city_code')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                </div>

                {{-- <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-2">
                    <div class="mb-3">
                        <label for="isActive">Office Status<sup>*</sup></label>
                        <select id="isActive" name="isActive" required>
                            <option disabled selected>Select status</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                        @error('isActive')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                </div> --}}

                <div class="flex justify-end">
                    <button type="submit" class="btn btn-primary">
                        Save changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection