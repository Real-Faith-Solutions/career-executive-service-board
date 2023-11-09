<script>
    // Get the input element and the collection from PHP
    

    // Function to check if an item number exists
    const itemno = (val) => {

        const item_no_label = document.querySelector("#item_no_label");
        const allPlanPosition = @json($allPlanPosition);

        // Check if the value exists in the collection
        const exists = allPlanPosition.some(data => data.item_no == val);

        // Update the label accordingly
        if (exists) {
            item_no_label.textContent = val + " is already taken";
        } else {
            item_no_label.textContent = ""; // Clear the label
        }
    }
</script>
<script>
    const classificationBasis = (val) => {
        const titleAndDateTextArea = document.querySelector('#titleAndDate');

        @foreach ($classBasis as $data)
        if ("{{ $data->cbasis_code }}" === val) {
            titleAndDateTextArea.value = `{!! $data->title !!}, dated {{ \Carbon\Carbon::parse($data->classdate)->format('m/d/Y') }}`;

        }
        @endforeach
    }
</script>
<script>
    const posCode = (val) => {
        // Get the second dropdown element
        const positionTitleDropdown = document.querySelector("#pos_code");
        const posDefaultInput = document.querySelector('#pos_default');
        
        // Clear existing options in the second dropdown
        positionTitleDropdown.innerHTML = "";
        posDefaultInput.value = "";
        
        // Add a default "Select Position Title" option
        const defaultOption = document.createElement("option");
        defaultOption.text = "Select Position Title";
        defaultOption.disabled = true;
        defaultOption.selected = true;
        positionTitleDropdown.appendChild(defaultOption);
        
        // Populate the second dropdown based on the selected value of the first dropdown
        @foreach ($positionMasterLibrary as $data)
        if ("{{ $data->poslevel_code }}" == val) {
            const option = document.createElement("option");
            option.value = "{{ $data->pos_code }}";
            // option.text = "{{ $data->dbm_title }} ,SG {{ $data->sg }}";
            option.text = "{{ $data->dbm_title }}";
            positionTitleDropdown.appendChild(option);
        }
        @endforeach
    
    }
</script>

<script>
    const sectorToggle = (val) => {
        const sectorDropdown = document.querySelector("#sector");
        const departmentDropdown = document.querySelector('#department');
        const agencyDropdown = document.querySelector('#agency');
        const officeDropdown = document.querySelector('#officeid');

        departmentDropdown.innerHTML = "";
        agencyDropdown.innerHTML = "";
        officeDropdown.innerHTML = "";

        const defaultOption = document.createElement("option");
        defaultOption.text = "Select Department / Agency";
        defaultOption.disabled = true;
        defaultOption.selected = true;
        defaultOption.value = "";
        departmentDropdown.appendChild(defaultOption);
        
        // Populate the second dropdown based on the selected value of the first dropdown
        @foreach ($department as $data)
            if ("{{ $data->sectorid }}" == val) {
                const option = document.createElement("option");
                option.value = "{{ $data->deptid }}";
                option.text = "{{ $data->title }}";
                departmentDropdown.appendChild(option);
            }
        @endforeach
    
    }

</script>
<script>
    const departmentToggle = (val) => {
        const departmentDropdown = document.querySelector("#department");
        const agencyDropdown = document.querySelector('#agency');
        const officeDropdown = document.querySelector('#officeid');

        agencyDropdown.innerHTML = "";
        officeDropdown.innerHTML = "";
        const defaultOption = document.createElement("option");
        defaultOption.text = "Select Agency Location";
        defaultOption.disabled = true;
        defaultOption.selected = true;
        defaultOption.value = "";
        agencyDropdown.appendChild(defaultOption);
        
        @foreach ($agencyLocation as $data)
        if ("{{ $data->deptid }}" == val) {
            const option = document.createElement("option");
            option.value = "{{ $data->officelocid }}";
            option.text = "{{ $data->title }}";
            agencyDropdown.appendChild(option);
        }
        @endforeach
    
    }
</script>
<script>
    const agencyToggle = (val) => {
        const departmentDropdown = document.querySelector("#department");
        const agencyDropdown = document.querySelector('#agency');
        const officeDropdown = document.querySelector('#officeid');

        officeDropdown.innerHTML = "";
        const defaultOption = document.createElement("option");
        defaultOption.text = "Select Office";
        defaultOption.disabled = true;
        defaultOption.selected = true;
        defaultOption.value = "";
        officeDropdown.appendChild(defaultOption);
        
        @foreach ($office as $data)
        if ("{{ $data->officelocid }}" == val) {
            const option = document.createElement("option");
            option.value = "{{ $data->officeid }}";
            option.text = "{{ $data->title }}";
            officeDropdown.appendChild(option);
        }
        @endforeach
    
    }

</script>
<script>
    const posTitle = () => {
        const positionTitleDropdown = document.querySelector("#pos_code");
        const posDefaultInput = document.querySelector('#pos_default');

        const selectedOption = positionTitleDropdown.options[positionTitleDropdown.selectedIndex];
        posDefaultInput.value = selectedOption.textContent;
    }

    
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const checkBox = document.getElementById("use_func_title");
        const input = document.getElementById("pos_func_name");
        const posDefaultInput = document.getElementById("pos_default");
        
        checkBox.addEventListener("change", function () {
            if (checkBox.checked) {
                input.removeAttribute("readonly");
                
                posDefaultInput.setAttribute("disabled", "true");
                // posDefaultInput.value = "";
            } else {
                input.setAttribute("readonly", "true");
                input.value = "";
                posDefaultInput.removeAttribute("disabled");
            
            }
        });
    });
    
    const cesPosAndPresAppointee = () => {
        const is_ces_pos = document.querySelector("#is_ces_pos");
        const pres_apptee = document.querySelector("#pres_apptee");
        
        if (is_ces_pos.checked) {
            const confirmation = window.confirm("Would you like to check Presidential Appointee?");
            
            if (confirmation){
                pres_apptee.checked = true;
            }
        }
    }
</script>
@extends('layouts.app')
@section('title', 'Position Manager - Create')
@section('content')

<div class="my-5 flex justify-between gap-4">
    <a href="#" class="text-blue-500 uppercase text-2xl">
        @yield('title')
    </a>
    <a class="btn btn-primary" href="{{ route('library-position-manager.index') }}">Go back</a>
</div>

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Position Manager
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="{{ route('library-position-manager.store') }}" method="POST">
                @csrf
                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-2">
                    <fieldset class="border p-4">
                        <legend>Position Details</legend>

                        <div class="sm:gid-cols-3 mb-3 grid gap-4 md:grid-cols-3 lg:grid-cols-3">

                            <div class="mb-3">
                                <label for="sector">Sector</label>
                                <select id="sector" name="sector" required onchange="sectorToggle(this.value)">
                                    <option disabled selected>Select Sector</option>
                                    @foreach ($sector as $data)
                                    <option value="{{ $data->sectorid }}">
                                        {{ $data->title }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="department">Department / Agency</label>
                                <select id="department" name="department" required
                                    onchange="departmentToggle(this.value)">
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="agency">Agency Location</label>
                                <select id="agency" name="agency" required onchange="agencyToggle(this.value)">
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="officeid">Office<sup>*</sup></label>
                            <select id="officeid" name="officeid" required>
                            </select>
                            @error('officeid')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="pos_suffix">Position Suffix<sup>*</sup></label>
                            <input id="pos_suffix" name="pos_suffix" required />
                            @error('pos_suffix')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="ces_equivalent">CES Equivalent<sup>*</sup></label>
                            <select id="ces_equivalent" name="ces_equivalent" required onchange="posCode(this.value)">
                                <option disabled selected>Select Position Level</option>
                                @foreach ($planPositionLibrary as $data)
                                <option value="{{ $data->poslevel_code }}">
                                    {{ $data->title }}, SG {{ $data->sg }}
                                </option>
                                @endforeach
                            </select>
                            @error('ces_equivalent')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="pos_code">Position Title<sup>*</sup></label>
                            <select id="pos_code" name="pos_code" required onchange="posTitle()">
                                <option disabled selected>Select Position Title</option>
                            </select>
                            @error('pos_code')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="pos_func_name">Functional Title<sup>*</sup></label>
                            <input id="pos_func_name" name="pos_func_name" required readonly />
                            @error('pos_func_name')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>

                        <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                            <div class="flex items-center">
                                <input
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"
                                    id="is_ces_pos" name="is_ces_pos" type="checkbox" value="1"
                                    onchange="cesPosAndPresAppointee()">
                                <label class="ml-2 text-sm font-medium text-gray-900" for="is_ces_pos">
                                    CES Position
                                </label>
                            </div>

                            <div class="flex items-center">
                                <input
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"
                                    id="pres_apptee" name="pres_apptee" type="checkbox" value="1">
                                <label class="ml-2 text-sm font-medium text-gray-900" for="pres_apptee">
                                    Presidential Appointee
                                </label>
                            </div>

                            <div class="flex items-center">
                                <input
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"
                                    id="use_func_title" name="use_func_title" type="checkbox" value="1">
                                <label class="ml-2 text-sm font-medium text-gray-900" for="use_func_title">
                                    Use Func Title
                                </label>
                            </div>
                            {{-- <div class="flex items-center">
                                <input
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"
                                    id="is_active" name="is_active" type="checkbox" value="1">
                                <label class="ml-2 text-sm font-medium text-gray-900" for="is_active">
                                    Active
                                </label>
                            </div> --}}
                            <div class="flex items-center">
                                <input
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"
                                    id="is_head" name="is_head" type="checkbox" value="1">
                                <label class="ml-2 text-sm font-medium text-gray-900" for="is_head">
                                    Head of Agency
                                </label>
                            </div>
                            {{-- <div class="flex items-center">
                                <input
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"
                                    id="is_generic" name="is_generic" type="checkbox" value="1">
                                <label class="ml-2 text-sm font-medium text-gray-900" for="is_generic">
                                    Generic
                                </label>
                            </div> --}}
                            {{-- <div class="flex items-center">
                                <input
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"
                                    id="is_vacant" name="is_vacant" type="checkbox" value="1">
                                <label class="ml-2 text-sm font-medium text-gray-900" for="is_vacant">
                                    Vacant
                                </label>
                            </div> --}}
                            {{-- <div class="flex items-center">
                                <input
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"
                                    id="is_occupied" name="is_occupied" type="checkbox" value="1">
                                <label class="ml-2 text-sm font-medium text-gray-900" for="is_occupied">
                                    Occupied
                                </label>
                            </div> --}}

                        </div>

                        <div class="mb-3">
                            <label for="pos_default">Default Title<sup>*</sup></label>
                            <input id="pos_default" name="pos_default" required />
                            @error('pos_default')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>

                        <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-2">
                            <div class="mb-3">
                                <label for="corp_sg">Salary Grade Level<sup>*</sup></label>
                                <input id="corp_sg" name="corp_sg" required type="number" />
                                @error('corp_sg')
                                <span class="invalid" role="alert">
                                    <p>{{ $message }}</p>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="item_no">Item No.<sup>*</sup></label>
                                <input id="item_no" name="item_no" required onchange="itemno(this.value)" />
                                <p class="text-red-500 text-sm" id="item_no_label"></p>
                                @error('item_no')
                                <span class="invalid" role="alert">
                                    <p>{{ $message }}</p>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="remarks">Remarks<sup>*</sup></label>
                            <textarea name="remarks" id="remarks" cols="50" rows="3"></textarea>
                            @error('remarks')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                    </fieldset>

                    <fieldset class="border p-4">
                        <legend>Classification Basis</legend>
                        <div class="mb-3">
                            <label for="cbasis_code">Classification Basis</label>
                            <select id="cbasis_code" name="cbasis_code" required
                                onchange="classificationBasis(this.value)">
                                <option disabled selected>Select Classification Basis</option>
                                @foreach ($classBasis as $data)
                                <option value="{{ $data->cbasis_code }}">{{ $data->basis }}</option>
                                @endforeach
                            </select>
                            @error('cbasis_code')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="titleAndDate">Title/Date</label>
                            <textarea name="titleAndDate" id="titleAndDate" cols="50" rows="3" readonly></textarea>
                            @error('titleAndDate')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="cbasis_remarks">Notes</label>
                            <textarea name="cbasis_remarks" id="cbasis_remarks" cols="50" rows="3"></textarea>
                            @error('cbasis_remarks')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>

                    </fieldset>

                </div>

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