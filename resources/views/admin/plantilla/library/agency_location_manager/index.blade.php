<script>
    document.addEventListener("DOMContentLoaded", function() {
        const sectorDropdown = document.querySelector("#sectorDropdown");
        const departmentDropdown = document.querySelector('#departmentDropdown');
        const oldDepartmentValue = @json(old('departmentDropdown', $departmentDropdown)); // Get the old input value or the initial value

        departmentDropdown.innerHTML = "";

        const defaultOption = document.createElement("option");
        defaultOption.text = "Select Department / Agency";
        defaultOption.disabled = true;
        defaultOption.selected = true;
        departmentDropdown.appendChild(defaultOption);

        // Function to populate the department dropdown
        function populateDepartmentDropdown() {
            departmentDropdown.innerHTML = "";
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

        // Initial population of department dropdown
        populateDepartmentDropdown();

        // Add an event listener to sectorDropdown
        sectorDropdown.addEventListener("change", function() {
            // Reset and populate the department dropdown when sectorDropdown changes
            populateDepartmentDropdown();
        });
    });
</script>


@extends('layouts.app')
@section('title', 'Agency Location Manager')
@section('content')

<fieldset class="border p-4 bg-gray-50">
    <legend>View Filter</legend>
    <form class="sm:gid-cols-3 mb-3 grid gap-4 md:grid-cols-3 lg:grid-cols-3">

        <div class="mb-3">
            <label for="sectorDropdown">Sector</label>
            <select id="sectorDropdown" name="sectorDropdown" onchange="sectorToggle(this.value)">
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

        <div class=" flex items-center mt-3 gap-2">
            <button class="btn btn-primary" type="submit">Search</button>
            <a class="btn btn-secondary" href="{{ route('library-agency-location-manager.index') }}">Reset</a>
        </div>
    </form>
</fieldset>

<div class="lg:flex lg:justify-between my-3">
    <div>
        @include('components.search')
    </div>
    <a href="#" class="text-blue-500 uppercase text-2xl">
        @yield('title')
    </a>
    <div class="flex items-center">
        <a href="{{ route('library-agency-location-manager.trash') }}">
            <lord-icon src="https://cdn.lordicon.com/jmkrnisz.json" trigger="hover" colors="primary:#DC3545"
                style="width:34px;height:34px">
            </lord-icon>
        </a>

        <a class="btn btn-primary" href="{{ route('library-agency-location-manager.create') }}">Add record</a>
    </div>
</div>


<div class="relative overflow-x-auto shadow-lg sm:rounded-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                {{-- <th class="px-6 py-3" scope="col">Department Agency</th> --}}
                <th class="px-6 py-3" scope="col">Location</th>
                <th class="px-6 py-3" scope="col">Location Acronym</th>
                <th class="px-6 py-3" scope="col">Location type</th>
                <th class="px-6 py-3" scope="col">Region</th>

                <th class="px-6 py-3" scope="col">
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>
        <tbody>

            @foreach ($agencyLocation as $data)
            <tr>
                <td class="whitespace-nowrap px-6 py-4 font-medium text-gray-900" scope="row">
                    {{ $data->title }}
                </td>
                <td class="px-6 py-3">
                    {{ $data->acronym ?? 'N/A' }}
                </td>
                <td class="px-6 py-3">
                    {{ $data->agencyLocationLibrary->title ?? 'N/A'}}
                </td>
                <td class="px-6 py-3">
                    {{ $data->region ?? 'N/A' }}
                </td>

                <td class="text-right uppercase">
                    <div class="flex justify-end">
                        <a class="hover:bg-slate-100 rounded-full"
                            href="{{ route('library-agency-location-manager.edit', $data->officelocid) }}">
                            <lord-icon src="https://cdn.lordicon.com/hbvgknxo.json" trigger="hover"
                                colors="primary:#ebe6ef,secondary:#4bb3fd,tertiary:#3a3347"
                                style="width:24px;height:24px">
                            </lord-icon>
                        </a>
                        <form class="hover:bg-slate-100 rounded-full"
                            action="{{ route('library-agency-location-manager.destroy', $data->officelocid) }}"
                            method="POST"
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
    {{ $agencyLocation->links() }}
</div>

@endsection