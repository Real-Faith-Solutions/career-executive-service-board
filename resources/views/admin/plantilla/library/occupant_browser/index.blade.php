<script>
    document.addEventListener("DOMContentLoaded", function() {
        const sectorDropdown = document.querySelector("#sectorDropdown");
        const departmentDropdown = document.querySelector('#departmentDropdown');
        const agencyLocationDropdown = document.querySelector('#agencyLocationDropdown');
        const officeDropdown = document.querySelector('#officeDropdown');
        const oldDepartmentValue = @json(old('departmentDropdown', $departmentDropdown)); // Get the old input value or the initial value
        const oldAgencyLocationValue = @json(old('agencyLocationDropdown', $agencyLocationDropdown)); // Get the old input value or the initial value
        const oldOfficeValue = @json(old('officeDropdown', $officeDropdown)); // Get the old input value or the initial value

        departmentDropdown.innerHTML = "";
        agencyLocationDropdown.innerHTML = "";
        officeDropdown.innerHTML = "";
        
        const defaultOption = document.createElement("option");
        defaultOption.text = "Select Department / Agency";
        defaultOption.disabled = true;
        defaultOption.selected = true;
        departmentDropdown.appendChild(defaultOption);

        const defaultOptionAgencyLocation = document.createElement("option");
        defaultOptionAgencyLocation.text = "Select Agency Location";
        defaultOptionAgencyLocation.disabled = true;
        defaultOptionAgencyLocation.selected = true;
        agencyLocationDropdown.appendChild(defaultOptionAgencyLocation);

        const defaultOptionOffice = document.createElement("option");
        defaultOptionOffice.text = "Select Office";
        defaultOptionOffice.disabled = true;
        defaultOptionOffice.selected = true;
        officeDropdown.appendChild(defaultOptionOffice);
        
        // Function to populate the department dropdown
        function populateDepartmentDropdown() {
            departmentDropdown.innerHTML = "";
            agencyLocationDropdown.innerHTML = "";
            officeDropdown.innerHTML = "";
            departmentDropdown.appendChild(defaultOption);
        
            // Populate the second dropdown based on the selected value of the first dropdown
            @foreach($department as $data)
                if ("{{ $data->sectorid }}" === sectorDropdown.value) {
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
            officeDropdown.innerHTML = "";
            agencyLocationDropdown.appendChild(defaultOptionAgencyLocation);
            @foreach($agencyLocation as $data)
                if ("{{ $data->deptid }}" === departmentDropdown.value) {
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

        function populateOfficeDropdown() {
            officeDropdown.innerHTML = "";
            officeDropdown.appendChild(defaultOptionOffice);
            @foreach($office as $data)
                if ("{{ $data->officelocid }}" == agencyLocationDropdown.value) {
                    const option = document.createElement("option");
                    option.value = "{{ $data->officeid }}";
                    option.text = "{{ $data->title }}";
                    if ("{{ $data->officeid }}" == oldOfficeValue) {
                        option.selected = true;
                    }
                    officeDropdown.appendChild(option);
                }
            @endforeach
        }

        // Initial population of dropdowns
        populateDepartmentDropdown();
        populateAgencyLocationDropdown();
        populateOfficeDropdown();

        // Add event listeners
        sectorDropdown.addEventListener("change", function() {
            populateDepartmentDropdown();
        });

        departmentDropdown.addEventListener("change", function() {
            populateAgencyLocationDropdown();
        });

        agencyLocationDropdown.addEventListener("change", function() {
            populateOfficeDropdown();
        });
    });
</script>
@extends('layouts.app')
@section('title', 'Appointee Occupant Browser')
@section('content')

<form>
    <fieldset class="border p-4 bg-gray-50">
        <legend>View Filter</legend>
        <div class="sm:gid-cols-5 mb-3 grid gap-4 md:grid-cols-5 lg:grid-cols-5">

            <div class="mb-3">
                <label for="sectorDropdown">Sector</label>
                <select id="sectorDropdown" name="sectorDropdown">
                    <option value="">Select Sector</option>
                    @foreach ($sector as $data)
                    <option value="{{ $data->sectorid }}" {{ $data->sectorid == $sectorDropdown ? 'selected' : ''}}>
                        {{ $data->title }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="departmentDropdown">Department</label>
                <select id="departmentDropdown" name="departmentDropdown">
                </select>
            </div>
            <div class="mb-3">
                <label for="agencyLocationDropdown">Agency Location</label>
                <select id="agencyLocationDropdown" name="agencyLocationDropdown">
                </select>
            </div>
            <div class="mb-3">
                <label for="officeDropdown">Office</label>
                <select id="officeDropdown" name="officeDropdown">
                </select>
            </div>
            <div class=" flex items-center mt-3 gap-2">
                <button class="btn btn-primary" type="submit">Search</button>
                <a class="btn btn-secondary" href="{{ route('library-occupant-browser.index') }}">Reset</a>
            </div>
        </div>
    </fieldset>

    <div class="my-3">

        <div class="flex justify-between">
            <div>
                @include('admin.plantilla.library.search')
            </div>
            <a href="#" class="text-blue-500 uppercase text-2xl">
                @yield('title')
            </a>

            <div></div>
        </div>

    </div>
</form>

<div class="relative overflow-x-auto shadow-lg sm:rounded-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th class="px-6 py-3" scope="col">DBM Position Title</th>
                <th class="px-6 py-3" scope="col">Salary Grade</th>
                <th class="px-6 py-3" scope="col">DBM Item No</th>
                <th class="px-6 py-3" scope="col">Appointee</th>
                <th class="px-6 py-3" scope="col">Appointee Status</th>
                <th class="px-6 py-3" scope="col">Occupant</th>
                <th class="px-6 py-3" scope="col">Occupant Status</th>
                <th class="px-6 py-3" scope="col">Classification Basis</th>

                <th class="px-6 py-3" scope="col">
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>
        <tbody>

            @foreach ($datas as $data)
            <tr>
                <td class="whitespace-nowrap px-6 py-4 font-medium text-gray-900" scope="row">
                    {{ $data->planPosition->positionMasterLibrary->dbm_title ?? 'N/A'}}
                </td>
                <td class="px-6 py-3">
                    {{ $data->planPosition->corp_sg ?? ''}}
                </td>
                <td class="px-6 py-3">
                    {{ $data->planPosition->item_no ?? ''}}
                </td>
                <td class="px-6 py-3">
                    @if ($data->is_appointee == 1)
                    {{ $data->personalData->lastname ?? ''}}
                    {{ $data->personalData->firstname ?? ''}}
                    {{ $data->personalData->name_extension ?? ''}}
                    {{ $data->personalData->middlename ?? ''}}
                    @else
                    None
                    @endif
                </td>
                <td class="px-6 py-3">
                    {{ $data->is_appointee == 1 ? $data->apptStatus->title : 'None'}}
                </td>
                <td class="px-6 py-3">
                    @if ($data->is_appointee !== 1)
                    {{ $data->personalData->lastname ?? ''}}
                    {{ $data->personalData->firstname ?? ''}}
                    {{ $data->personalData->name_extension ?? ''}}
                    {{ $data->personalData->middlename ?? ''}}
                    @else
                    None
                    @endif
                </td>

                <td class="px-6 py-3">
                    {{ $data->is_appointee !== 1 ? $data->apptStatus->title : 'None'}}
                </td>
                <td class="px-6 py-3">
                    {{ $data->basis }}
                </td>

                <td class="text-right uppercase">
                    <div class="flex justify-end">

                        <a class="hover:bg-slate-100 rounded-full"
                            href="{{ route('library-occupant-browser.edit', $data->appointee_id) }}">
                            <lord-icon src="https://cdn.lordicon.com/hbvgknxo.json" trigger="hover"
                                colors="primary:#ebe6ef,secondary:#4bb3fd,tertiary:#3a3347"
                                style="width:24px;height:24px">
                            </lord-icon>
                        </a>

                        {{-- <form class="hover:bg-slate-100 rounded-full"
                            action="{{ route('library-occupant-manager.destroy', $data->appointee_id) }}" method="POST"
                            onsubmit="return window.confirm('Are you sure you want to delete this item?')">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="mx-1 font-medium text-red-600 hover:underline">
                                <lord-icon src="https://cdn.lordicon.com/jmkrnisz.json" trigger="hover"
                                    colors="primary:#DC3545" style="width:24px;height:24px">
                                </lord-icon>
                            </button>
                        </form> --}}
                    </div>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>

<div class="m-5">
    {{ $datas->links() }}
</div>

@endsection