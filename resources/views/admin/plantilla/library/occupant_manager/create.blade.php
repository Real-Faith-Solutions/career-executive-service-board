<script>
    const sectorToggle = (val) => {
        const sectorDropdown = document.querySelector("#sector");
        const departmentDropdown = document.querySelector('#department');
        const agencyDropdown = document.querySelector('#agencyLocation');
        const officeDropdown = document.querySelector('#office');
        const positionDropdown = document.querySelector('#position');

        departmentDropdown.innerHTML = "";
        agencyDropdown.innerHTML = "";
        officeDropdown.innerHTML = "";
        positionDropdown.innerHTML = "";

        const defaultOption = document.createElement("option");
        defaultOption.text = "Select Department / Agency";
        defaultOption.disabled = true;
        defaultOption.selected = true;
        departmentDropdown.appendChild(defaultOption);

        // Populate the second dropdown based on the selected value of the first dropdown
        @foreach($department as $data)
        if ("{{ $data->sectorid }}" === val) {
            const option = document.createElement("option");
            option.value = "{{ $data->deptid }}";
            option.text = "{{ $data->title }} - {{ $data->motherDepartment->title ?? ''}}";
            departmentDropdown.appendChild(option);
        }
        @endforeach

    }

    const departmentToggle = (val) => {
        const sectorDropdown = document.querySelector("#sector");
        const departmentDropdown = document.querySelector('#department');
        const agencyDropdown = document.querySelector('#agencyLocation');
        const officeDropdown = document.querySelector('#office');
        const positionDropdown = document.querySelector('#position');

        agencyDropdown.innerHTML = "";
        officeDropdown.innerHTML = "";
        positionDropdown.innerHTML = "";

        const defaultOption = document.createElement("option");
        defaultOption.text = "Select Agency Location";
        defaultOption.disabled = true;
        defaultOption.selected = true;
        agencyDropdown.appendChild(defaultOption);

        @foreach($agencyLocation as $data)
        if ("{{ $data->officelocid }}" === val) {
            const option = document.createElement("option");
            option.value = "{{ $data->officelocid }}";
            option.text = "{{ $data->title }}";
            agencyDropdown.appendChild(option);
        }
        @endforeach

    }
    const agencyLocationToggle = (val) => {
        const sectorDropdown = document.querySelector("#sector");
        const departmentDropdown = document.querySelector('#department');
        const agencyDropdown = document.querySelector('#agencyLocation');
        const officeDropdown = document.querySelector('#office');
        const positionDropdown = document.querySelector('#position');

        officeDropdown.innerHTML = "";
        positionDropdown.innerHTML = "";

        const defaultOption = document.createElement("option");
        defaultOption.text = "Select Office";
        defaultOption.disabled = true;
        defaultOption.selected = true;
        officeDropdown.appendChild(defaultOption);

        @foreach($office as $data)
        if ("{{ $data->officeid }}" === val) {
            const option = document.createElement("option");
            option.value = "{{ $data->officeid }}";
            option.text = "{{ $data->title }}";
            officeDropdown.appendChild(option);
        }
        @endforeach

    }
    const officeToggle = (val) => {
        const sectorDropdown = document.querySelector("#sector");
        const departmentDropdown = document.querySelector('#department');
        const agencyDropdown = document.querySelector('#agencyLocation');
        const officeDropdown = document.querySelector('#office');
        const positionDropdown = document.querySelector('#position');

        positionDropdown.innerHTML = "";

        const defaultOption = document.createElement("option");
        defaultOption.text = "Select Position";
        defaultOption.disabled = true;
        defaultOption.selected = true;
        positionDropdown.appendChild(defaultOption);


        @foreach($planPositions as $data)
        if ("{{ $data->plantilla_id }}" === val) {
            const option = document.createElement("option");
            option.value = "{{ $data->plantilla_id }}";
            option.text = "{{ $data->positionMasterLibrary->dbm_title }} - SG {{ $data->positionMasterLibrary->sg }}";
            positionDropdown.appendChild(option);
        }
        @endforeach
    }

    const positionToggle = () => {
        const positionDropdown = document.querySelector('#position');
        const positionInput = document.querySelector('#plantilla_id');
        const basisInput = document.querySelector('#basis');
        
        positionInput.value = positionDropdown.value;
        const positionValue = positionDropdown.value;
        
        // Iterate through the PHP array to find the matching classBasis
        @foreach ($classBasis as $data)
            if ("{{ $data->cbasis_code }}" === positionValue) {
                basisInput.value = "{{ $data->basis }}"; // Set the title in the basisInput
            }
        @endforeach
    }

</script>

@extends('layouts.app')
@section('title', 'Appointee Occupant Manager - Create')
@section('content')

<div class="my-5 flex justify-between gap-4">
    <a href="#" class="text-blue-500 uppercase text-2xl">
        @yield('title')
    </a>
    <a class="btn btn-primary" href="{{ route('library-occupant-manager.index') }}">Go back</a>
</div>

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Appointee Occupant Manager
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-2">
                <fieldset class="border p-4">
                    <legend>Occupant information</legend>
                    <form>
                        <div class="mb-3">
                            <label for="cesnoSearch">CESNO<sup>*</sup></label>
                            <div class="flex">
                                <input id="cesnoSearch" list="cesnoList" name="cesnoSearch" type="search"
                                    value="{{ $cesno }}" required />

                                <datalist id="cesnoList">
                                    @foreach ($personalDataList as $data)
                                    <option value="{{ $data->cesno }}">
                                        {{ $data->lastname }} {{ $data->firstname }} {{ $data->name_extension }}
                                        {{ $data->middlename }}
                                    </option>
                                    @endforeach
                                </datalist>

                                <button type="submit" id="checkCesno" class="btn btn-primary">Search</button>
                            </div>

                        </div>
                    </form>

                    <form action="{{ route('library-occupant-manager.store') }}" method="POST">
                        @csrf
                        {{-- @method('put') --}}
                        <input type="hidden" name="cesno" value="{{ $cesno }}">
                        <input type="hidden" name="plantilla_id" id="plantilla_id">
                        <label for="appt_stat_code">Personnel Movement<sup>*</sup></label>
                        <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-2">
                            <div class="mb-3">
                                <select id="appt_stat_code" name="appt_stat_code" required>
                                    <option disabled selected value="">Select Personnel Movement</option>
                                    @foreach ($apptStatus as $data)
                                    <option value="{{ $data->appt_stat_code }}">{{ $data->title }}</option>
                                    @endforeach
                                </select>
                                @error('appt_stat_code')
                                <span class="invalid" role="alert">
                                    <p>{{ $message }}</p>
                                </span>
                                @enderror
                            </div>

                            <div class="mb-3 flex">
                                <div class="flex">
                                    <div class="flex items-center mr-4">
                                        <input id="is_appointee" name="is_appointee" type="radio" value="1" required>
                                        <label class="ml-2 text-sm font-medium text-gray-900"
                                            for="is_appointee">Appointee</label>
                                    </div>

                                    <div class="flex items-center mr-4">
                                        <input id="is_occupant" name="is_appointee" type="radio" value="0" required>
                                        <label class="ml-2 text-sm font-medium text-gray-900"
                                            for="is_occupant">Occupant</label>
                                    </div>
                                </div>
                                @error('is_appointee')
                                <span class="invalid" role="alert">
                                    <p>{{ $message }}</p>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-1 lg:grid-cols-1">
                            <div class="mb-3">
                                <label for="lastname">Name of Official</label>
                                <input id="lastname"
                                    value="{{ $personalData->lastname ?? ''}} {{ $personalData->firstname ?? ''}} {{ $personalData->name_extension ?? ''}} {{ $personalData->middlename ?? ''}}"
                                    readonly required />
                                @error('cesno')
                                <span class="invalid" role="alert">
                                    <p>{{ $message }}</p>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-2">
                            <div class="mb-3">
                                <label for="cesStatus">CES Status</label>
                                <input id="cesStatus" value="{{ $personalData->cesStatus->description ?? '' }}"
                                    readonly />
                            </div>

                            <div class="mb-3">
                                <label for="assum_date">Assumption Date<sup>*</sup></label>
                                <input id="assum_date" name="assum_date" type="date" value="{{ old('assum_date') }}"
                                    required />
                                @error('assum_date')
                                <span class="invalid" role="alert">
                                    <p>{{ $message }}</p>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-2">
                            <div class="mb-3">
                                <label for="gender">Gender</label>
                                <input id="gender" value="{{ $personalData->gender ?? ''}}" readonly />
                            </div>

                            <div class="mb-3">
                                <label for="appt_date">Appointment Date<sup>*</sup></label>
                                <input id="appt_date" name="appt_date" type="date" value="{{ old('appt_date') }}"
                                    required />
                                @error('appt_date')
                                <span class="invalid" role="alert">
                                    <p>{{ $message }}</p>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-2">
                            <div class="mb-3">
                                <label for="basis">Basis</label>
                                <textarea name="basis" id="basis" cols="30" rows="10" readonly></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="remarks">Remarks</label>
                                <textarea name="remarks" id="remarks" cols="30" rows="10"
                                    readonly>{{ $personalData->remarks ?? ''}}</textarea>
                            </div>
                        </div>

                        {{-- <div class="mb-3">
                            <label for="special_assignment">Special Assignment</label>
                            <textarea name="special_assignment" id="special_assignment" cols="30" rows="10"
                                readonly></textarea>
                        </div> --}}
                        <div class="flex justify-end">
                            <button class="btn btn-primary" type="submit">
                                Submit
                            </button>
                        </div>
                    </form>
                </fieldset>

                <fieldset class="border p-4">
                    <legend>View Filters</legend>
                    <div class="mb-3">
                        <label for="sector">Sector</label>
                        <select id="sector" name="sector" required onchange="sectorToggle(this.value)">
                            <option disabled selected>Select Sector</option>
                            @foreach ($sector as $data)
                            <option value="{{ $data->sectorid }}">{{ $data->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="department">Department/Agency</label>
                        <select id="department" name="department" required onchange="departmentToggle(this.value)">
                        </select>
                        <span class="text-slate-400 text-sm italic">Note: after agency is mother agency</span>
                    </div>
                    <div class="mb-3">
                        <label for="agencyLocation">Agency Location</label>
                        <select id="agencyLocation" name="agencyLocation" required
                            onchange="agencyLocationToggle(this.value)">
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="office">Office</label>
                        <select id="office" name="office" required onchange="officeToggle(this.value)">
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="position">Position</label>
                        <select id="position" name="position" required onchange="positionToggle(this.value)">
                        </select>
                        @error('plantilla_id')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                </fieldset>
            </div>

        </div>
    </div>
</div>

@endsection