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
        if ("{{ $data->cbasis_code }}" == val) {
            titleAndDateTextArea.value = `{!! $data->title !!}, dated {{ \Carbon\Carbon::parse($data->classdate)->format('m/d/Y') }}`;
        }
        @endforeach
    }
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

        @foreach ($planPositionLibrary as $data)
            if ("{{ $data->poslevel_code }}" == val) {
                const option = document.createElement("option");
                option.value = "{{ $data->pos_code }}";
                option.text = "{{ $data->dbm_title }} ,SG {{ $data->sg }}";
                positionTitleDropdown.appendChild(option);
            }
        @endforeach
        
    }

    const posTitle = () => {
        const positionTitleDropdown = document.querySelector("#pos_code");
        const posDefaultInput = document.querySelector('#pos_default');

        const selectedOption = positionTitleDropdown.options[positionTitleDropdown.selectedIndex];
        posDefaultInput.value = selectedOption.textContent;
    }

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
@section('title', 'Position Manager - Edit')
@section('content')

<div class="my-5 flex justify-between gap-4">
    <a href="#" class="text-blue-500 uppercase text-2xl">
        @yield('title')
    </a>
    <div class="flex gap-2">
        <a class="btn btn-primary" href="{{ route('plantilla-position-manager.show', [
            'sectorid' => $datas->office->agencyLocation->departmentAgency->sectorid,
            'deptid' => $datas->office->agencyLocation->departmentAgency->deptid,
            'officelocid' => $datas->office->agencyLocation->officelocid,
            'officeid' => $datas->office->officeid,
            'plantilla_id' => $datas->plantilla_id,
            ]) }}" target="_blank">
            Find in Main Screen
        </a>
        <a class="btn btn-primary" href="{{ route('library-position-manager.index') }}">Go back</a>
    </div>
</div>

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Position Manager
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="{{ route('library-position-manager.update', $datas->plantilla_id) }}" method="POST"
                enctype="multipart/form-data" id="updateForm" onsubmit="return checkErrorsBeforeSubmit(updateForm)">
                @csrf
                @method('PUT')
                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-2">
                    <fieldset class="border p-4">
                        <legend>Position Details</legend>
                        <div class="mb-3">
                            <label for="pos_suffix">Position Suffix</label>
                            <input id="pos_suffix" name="pos_suffix" value="{{ $datas->pos_suffix }}" />
                            @error('pos_suffix')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="ces_equivalent">CES Equivalent<sup>*</sup></label>
                            <select id="ces_equivalent" name="ces_equivalent" required onchange="posCode(this.value)"
                                disabled>
                                <option disabled selected value="">Select Position Level</option>
                                @foreach ($planPositionLibrary as $data)
                                <option value="{{ $data->poslevel_code }}" {{ $data->poslevel_code ==
                                    $datas->positionMasterLibrary->poslevel_code ? 'selected' : '' }}>
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
                            <select id="pos_code" name="pos_code" required onchange="posTitle()" disabled>
                                <option disabled selected value="">Select Position Title</option>
                                @foreach ($positionMasterLibrary as $data)
                                <option value="{{ $data->pos_code }}" {{ $data->pos_code ==
                                    $datas->pos_code ? 'selected' : ''}}>
                                    {{ $data->dbm_title }}, SG {{ $data->sg }}
                                </option>
                                @endforeach
                            </select>
                            @error('pos_code')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="pos_func_name">Functional Title</label>
                            <input id="pos_func_name" name="pos_func_name" required readonly
                                value="{{ $datas->pos_func_name }}" />
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
                                    id="is_ces_pos" name="is_ces_pos" type="checkbox" value="1" {{ $datas->is_ces_pos
                                == 1 ?
                                'checked' : '' }} onchange="cesPosAndPresAppointee()">
                                <label class="ml-2 text-sm font-medium text-gray-900" for="is_ces_pos">
                                    CES Position
                                </label>
                            </div>

                            <div class="flex items-center">
                                <input
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"
                                    id="pres_apptee" name="pres_apptee" type="checkbox" value="1" {{ $datas->pres_apptee
                                == 1 ?
                                'checked' : '' }}>
                                <label class="ml-2 text-sm font-medium text-gray-900" for="pres_apptee">
                                    Presidential Appointee
                                </label>
                            </div>

                            <div class="flex items-center">
                                <input
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"
                                    id="use_func_title" name="use_func_title" type="checkbox" value="1" {{
                                    $datas->pos_func_name
                                == NULL ? '' : 'checked' }}>
                                <label class="ml-2 text-sm font-medium text-gray-900" for="use_func_title">
                                    Use Func Title
                                </label>
                            </div>

                            <div class="flex items-center">
                                <input
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"
                                    id="is_head" name="is_head" type="checkbox" value="1" {{ $datas->is_head
                                == 1 ? 'checked' : '' }}>
                                <label class="ml-2 text-sm font-medium text-gray-900" for="is_head">
                                    Head of Agency
                                </label>
                            </div>
                            <div class="flex items-center">
                                <input
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"
                                    id="is_active" name="is_active" type="checkbox" value="1" {{ $datas->is_active == 1
                                ?
                                'checked' : '' }}>
                                <label class="ml-2 text-sm font-medium text-gray-900" for="is_active">
                                    Active
                                </label>
                            </div>
                            {{-- <div class="flex items-center">
                                <input
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"
                                    id="is_generic" name="is_generic" type="checkbox" value="1" {{ $datas->is_generic
                                == 1 ? 'checked' : '' }}>
                                <label class="ml-2 text-sm font-medium text-gray-900" for="is_generic">
                                    Generic
                                </label>
                            </div> --}}
                            {{-- <div class="flex items-center">
                                <input
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"
                                    id="is_vacant" name="is_vacant" type="checkbox" value="1" {{ $datas->is_vacant
                                == 1 ? 'checked' : '' }}>
                                <label class="ml-2 text-sm font-medium text-gray-900" for="is_vacant">
                                    Vacant
                                </label>
                            </div> --}}
                            {{-- <div class="flex items-center">
                                <input
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"
                                    id="is_occupied" name="is_occupied" type="checkbox" value="1" {{ $datas->is_occupied
                                == 1 ? 'checked' : '' }}>
                                <label class="ml-2 text-sm font-medium text-gray-900" for="is_occupied">
                                    Occupied
                                </label>
                            </div> --}}

                        </div>

                        <div class="mb-3">
                            <label for="pos_default">Default Title<sup>*</sup></label>
                            <input id="pos_default" name="pos_default" required value="{{ $datas->pos_default }}" />
                            @error('pos_default')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>

                        <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-2">
                            <div class="mb-3">
                                <label for="corp_sg">Salary Grade Level<sup>*</sup></label>
                                <input id="corp_sg" name="corp_sg" required type="number"
                                    value="{{ $datas->corp_sg }}" />
                                @error('corp_sg')
                                <span class="invalid" role="alert">
                                    <p>{{ $message }}</p>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="item_no">Item No.<sup>*</sup></label>
                                <input id="item_no" name="item_no" required value="{{ $datas->item_no }}"
                                    onchange="itemno(this.value)" />
                                <p class="text-red-500 text-sm" id="item_no_label"></p>
                                @error('item_no')
                                <span class="invalid" role="alert">
                                    <p>{{ $message }}</p>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="remarks">Remarks</label>
                            <textarea name="remarks" id="remarks" cols="50" rows="3">{{ $datas->remarks }}</textarea>
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
                            <select id="cbasis_code" name="cbasis_code" onchange="classificationBasis(this.value)">
                                <option disabled selected value="">Select Classification Basis</option>
                                @foreach ($classBasis as $data)
                                <option value="{{ $data->cbasis_code }}" {{ $data->cbasis_code ==
                                    $datas->cbasis_code ? 'selected': ''}}>
                                    {{ $data->basis }}
                                </option>
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
                            <textarea name="titleAndDate" id="titleAndDate" cols="50" rows="3"
                                readonly>{{ $data->title }}, dated {{ \Carbon\Carbon::parse($data->classdate)->format('m/d/Y') }}</textarea>
                            @error('titleAndDate')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="cbasis_remarks">Notes</label>
                            <textarea name="cbasis_remarks" id="cbasis_remarks" cols="50"
                                rows="3">{{ $datas->cbasis_remarks }}</textarea>
                            @error('cbasis_remarks')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>

                    </fieldset>

                </div>


                <h1 class="text-slate-400 text-sm font-semibold">
                    Last update at {{ \Carbon\Carbon::parse($datas->lastupd_date)->format('m/d/Y \a\t g:iA') }}
                </h1>
                <div class="flex justify-end gap-2 mt-2">
                    <button type="button" id="btnEdit" class="btn btn-primary">
                        Edit Record
                    </button>
                    <button type="button" id="btnSubmit" class="btn btn-primary hidden"
                        onclick="openConfirmationDialog(this, 'Confirm changes', 'Are you sure you want to update this record?')">
                        Save Changes
                    </button>
                    <button type="button" id="btnCancelEdit" class="btn btn-secondary hidden">
                        Cancel Edit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="{{ asset('js/plantilla/editForm.js') }}"></script>
@endsection