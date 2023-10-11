<script>
    document.addEventListener("DOMContentLoaded", function() {
        const sectorDropdown = document.querySelector("#sectorDropdown");
        const departmentDropdown = document.querySelector('#departmentDropdown');
        const agencyLocationDropdown = document.querySelector('#agencyLocationDropdown');
        const oldDepartmentValue = @json(old('departmentDropdown', $departmentDropdown)); // Get the old input value or the initial value
        const oldAgencyLocationValue = @json(old('agencyLocationDropdown', $agencyLocationDropdown)); // Get the old input value or the initial value

        departmentDropdown.innerHTML = "";
        agencyLocationDropdown.innerHTML = "";
        
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
        
        // Function to populate the department dropdown
        function populateDepartmentDropdown() {
        departmentDropdown.innerHTML = "";
        agencyLocationDropdown.innerHTML = "";
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
@section('title', 'Office Manager')
@section('content')

<form>
    <fieldset class="border p-4 bg-gray-50">
        <legend>View Filter</legend>
        <div class="sm:gid-cols-4 mb-3 grid gap-4 md:grid-cols-4 lg:grid-cols-4">

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

            <div class=" flex items-center mt-3 gap-2">
                <button class="btn btn-primary" type="submit">Search</button>
                <a class="btn btn-secondary" href="{{ route('library-office-manager.index') }}">Reset</a>
            </div>
        </div>
    </fieldset>

    <div class="lg:flex lg:justify-between my-3">
        <div>
            @include('admin.plantilla.library.search')
        </div>
        <a href="#" class="text-blue-500 uppercase text-2xl">
            @yield('title')
        </a>
        <div class="flex items-center">
            <a href="{{ route('library-office-manager.trash') }}">
                <lord-icon src="https://cdn.lordicon.com/jmkrnisz.json" trigger="hover" colors="primary:#DC3545"
                    style="width:34px;height:34px">
                </lord-icon>
            </a>

            <a class="btn btn-primary" href="{{ route('library-office-manager.create') }}">Add record</a>
        </div>
    </div>
</form>

<div class="relative overflow-x-auto shadow-lg sm:rounded-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th class="px-6 py-3" scope="col">Office ID</th>
                <th class="px-6 py-3" scope="col">Office</th>
                <th class="px-6 py-3" scope="col">Office Acronym</th>
                <th class="px-6 py-3" scope="col">Office Website</th>
                <th class="px-6 py-3" scope="col">Office Contact no.</th>
                <th class="px-6 py-3" scope="col">Office Email address</th>
                <th class="px-6 py-3" scope="col">Status</th>

                <th class="px-6 py-3" scope="col">
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>
        <tbody>

            @foreach ($datas as $data)
            <tr>
                <td class="whitespace-nowrap px-6 py-4 font-medium text-gray-900" scope="row">
                    {{-- {{ $data->agencyLocation->title }} --}}
                    {{ $data->officeid }}
                </td>
                <td class="px-6 py-3">
                    {{ $data->title }}
                </td>
                <td class="px-6 py-3">
                    {{ $data->acronym }}
                </td>
                <td class="px-6 py-3">
                    <a href="{{ $data->website ?? 'N/A' }}" target="_blank" class="hover:text-blue-500">
                        {{ $data->website ?? 'N/A' }}
                    </a>
                </td>
                <td class="px-6 py-3">
                    <a href="tel:{{ $data->officeAddress->contactno ?? 'N/A' }}" target="_blank"
                        class="hover:text-blue-500">
                        {{ $data->officeAddress->contactno ?? 'N/A' }}
                    </a>
                </td>

                <td class="px-6 py-3">
                    <a href="Mailto:{{ $data->officeAddress->emailadd ?? 'N/A' }}" target="_blank"
                        class="hover:text-blue-500">
                        {{ $data->officeAddress->emailadd ?? 'N/A' }}
                    </a>
                </td>

                <td class="px-6 py-3">
                    <span class="{{ $data->is_active == 1 ? 'success' : 'danger'}}">
                        {{ $data->is_active == 1 ? 'ACTIVE' : 'INACTIVE'}}
                    </span>
                </td>


                <td class="px-6 py-4 text-right uppercase">
                    <div class="flex justify-end">
                        <a class="hover:bg-slate-100 rounded-full"
                            href="{{ route('library-office-manager.edit', $data->officeid) }}">
                            <lord-icon src="https://cdn.lordicon.com/hbvgknxo.json" trigger="hover"
                                colors="primary:#ebe6ef,secondary:#4bb3fd,tertiary:#3a3347"
                                style="width:24px;height:24px">
                            </lord-icon>
                        </a>
                        <form class="hover:bg-slate-100 rounded-full"
                            action="{{ route('library-office-manager.destroy', $data->officeid) }}" method="POST"
                            onsubmit="return window.confirm('Are you sure you want to delete this item?')">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="mx-1 font-medium text-red-600 hover:underline">
                                <lord-icon src="https://cdn.lordicon.com/jmkrnisz.json" trigger="hover"
                                    colors="primary:#DC3545" style="width:24px;height:24px">
                                </lord-icon>
                            </button>
                        </form>
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