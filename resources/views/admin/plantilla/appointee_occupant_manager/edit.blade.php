<script>
    const classificationBasis = (val) => {
        const titleAndDateTextArea = document.querySelector('#titleAndDate');

        @foreach ($classBasis as $data)
        if ("{{ $data->cbasis_code }}" === val) {
            titleAndDateTextArea.value = "{{ $data->basis }}, dated {{ \Carbon\Carbon::parse($data->classdate)->format('m/d/Y') }}";
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

        // Populate the second dropdown based on the selected value of the first dropdown
        @foreach ($positionMasterLibrary as $data)
            if ("{{ $data->poslevel_code }}" === val) {
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
</script>


@extends('layouts.app')
@section('title', $planPosition->positionMasterLibrary->dbm_title)
@section('sub', $planPosition->positionMasterLibrary->dbm_title)
@section('content')
@include('admin.plantilla.header')

<nav class="flex" aria-label="Breadcrumb">
    <ol class="flex items-center space-x-2">
        <li>
            <a href="{{ route('sector-manager.index') }}" class="text-slate-500">Plantilla</a>
        </li>
        <li>
            <svg class="flex-shrink-0 w-5 h-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </li>
        <li>
            <a href="{{ route('sector-manager.index') }}" class="text-slate-500">Sector Manager</a>
        </li>
        <li>
            <svg class="flex-shrink-0 w-5 h-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </li>

        <li>
            <a href="{{ route('sector-manager.edit', $sector->sectorid) }}" class="text-blue-500">{{ $sector->title
                }}</a>
        </li>
        <li>
            <svg class="flex-shrink-0 w-5 h-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </li>

        <li>
            <a href="{{ route('department-agency-manager.showAgency', ['sectorid' => $sector->sectorid, 'deptid' => $department->deptid]) }}"
                class="text-blue-500">{{
                $department->title }}</a>
        </li>
        <li>
            <svg class="flex-shrink-0 w-5 h-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </li>

        <li>
            <a href="{{ route('agency-location-manager.show', ['sectorid' => $sector->sectorid, 'deptid' => $department->deptid, 'officelocid' => $departmentLocation->officelocid]) }}"
                class="text-blue-500">{{ $departmentLocation->title }}</a>
        </li>
        <li>
            <svg class="flex-shrink-0 w-5 h-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </li>

        <li>
            <a href="{{ route('office-manager.show', ['sectorid' => $sector->sectorid, 'deptid' => $department->deptid, 'officelocid' => $departmentLocation->officelocid, 'officeid' => $office->officeid]) }}"
                class="text-blue-500">{{ $office->title }}</a>
        </li>
        <li>
            <svg class="flex-shrink-0 w-5 h-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </li>

        <li>
            <a href="#" class="text-blue-500">{{ $planPosition->positionMasterLibrary->dbm_title }}</a>
        </li>
    </ol>
</nav>

<div class="grid">
    <div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
        <div class="w-full text-left text-gray-500">
            <div class="bg-blue-500 uppercase text-gray-700 text-white">
                <h1 class="px-6 py-3">
                    Plantilla Position Manager
                </h1>
            </div>

            <div class="bg-white px-6 py-3">
                <form action="{{ route('office-manager.update', $office->officeid) }}" method="POST">
                    @csrf

                    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-2">
                        <fieldset class="border p-4">
                            <legend>Position Details</legend>
                            <div class="mb-3">
                                <label for="pos_suffix">Position Suffix<sup>*</sup></label>
                                <input id="pos_suffix" name="pos_suffix" value="{{ $planPosition->pos_suffix }}" />
                                @error('pos_suffix')
                                <span class="invalid" role="alert">
                                    <p>{{ $message }}</p>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="ces_equivalent">CES Equivalent<sup>*</sup></label>
                                <select id="ces_equivalent" name="ces_equivalent" required
                                    onchange="posCode(this.value)">
                                    <option disabled selected>Select Position Level</option>
                                    @foreach ($planPositionLibrary as $data)
                                    <option value="{{ $data->poslevel_code }}" {{ $data->poslevel_code ===
                                        $planPosition->plantilla_id ? 'selected' : '' }}>
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
                                    @foreach ($positionMasterLibrary as $data)
                                    <option value="{{ $data->pos_code }}" {{ $data->poslevel_code ===
                                        $data->poslevel_code ? 'selected' : ''}}>
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
                                <label for="pos_func_name">Functional Title<sup>*</sup></label>
                                <input id="pos_func_name" name="pos_func_name" required readonly
                                    value="{{ $planPosition->pos_func_name }}" />
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
                                        id="is_ces_pos" name="is_ces_pos" type="checkbox" value="1" {{
                                        $planPosition->is_ces_pos === 1 ? 'checked' : '' }}>
                                    <label class="ml-2 text-sm font-medium text-gray-900" for="is_ces_pos">
                                        CES Position
                                    </label>
                                </div>

                                <div class="flex items-center">
                                    <input
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"
                                        id="pres_apptee" name="pres_apptee" type="checkbox" value="1" {{
                                        $planPosition->pres_apptee === 1 ? 'checked' : '' }}>
                                    <label class="ml-2 text-sm font-medium text-gray-900" for="pres_apptee">
                                        Pres Appointee
                                    </label>
                                </div>

                                <div class="flex items-center">
                                    <input
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"
                                        id="use_func_title" name="use_func_title" type="checkbox" value="1" {{
                                        $planPosition->pos_func_name === NULL ? '' : 'checked' }}>
                                    <label class="ml-2 text-sm font-medium text-gray-900" for="use_func_title">
                                        Use Func Title
                                    </label>
                                </div>
                                <div class="flex items-center">
                                    <input
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"
                                        id="is_active" name="is_active" type="checkbox" value="1" {{
                                        $planPosition->is_active === 1 ? 'checked' : '' }}>
                                    <label class="ml-2 text-sm font-medium text-gray-900" for="is_active">
                                        Active
                                    </label>
                                </div>
                                <div class="flex items-center">
                                    <input
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"
                                        id="is_head" name="is_head" type="checkbox" value="1" {{ $planPosition->is_head
                                    === 1 ? 'checked' : '' }}>
                                    <label class="ml-2 text-sm font-medium text-gray-900" for="is_head">
                                        Head of Agency
                                    </label>
                                </div>
                                <div class="flex items-center">
                                    <input
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"
                                        id="is_generic" name="is_generic" type="checkbox" value="1" {{
                                        $planPosition->is_generic
                                    === 1 ? 'checked' : '' }}>
                                    <label class="ml-2 text-sm font-medium text-gray-900" for="is_generic">
                                        Generic
                                    </label>
                                </div>
                                <div class="flex items-center">
                                    <input
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"
                                        id="is_vacant" name="is_vacant" type="checkbox" value="1" {{
                                        $planPosition->is_vacant
                                    === 1 ? 'checked' : '' }}>
                                    <label class="ml-2 text-sm font-medium text-gray-900" for="is_vacant">
                                        Vacant
                                    </label>
                                </div>
                                <div class="flex items-center">
                                    <input
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"
                                        id="is_occupied" name="is_occupied" type="checkbox" value="1" {{
                                        $planPosition->is_occupied
                                    === 1 ? 'checked' : '' }}>
                                    <label class="ml-2 text-sm font-medium text-gray-900" for="is_occupied">
                                        Occupied
                                    </label>
                                </div>

                            </div>

                            <div class="mb-3">
                                <label for="pos_default">Default Title<sup>*</sup></label>
                                <input id="pos_default" name="pos_default" required
                                    value="{{ $planPosition->pos_default }}" />
                                @error('pos_default')
                                <span class="invalid" role="alert">
                                    <p>{{ $message }}</p>
                                </span>
                                @enderror
                            </div>

                            <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-2">
                                <div class="mb-3">
                                    <label for="corp_sg">Grade Level<sup>*</sup></label>
                                    <input id="corp_sg" name="corp_sg" required type="number"
                                        value="{{ $planPosition->corp_sg }}" />
                                    @error('corp_sg')
                                    <span class="invalid" role="alert">
                                        <p>{{ $message }}</p>
                                    </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="item_no">Item No.<sup>*</sup></label>
                                    <input id="item_no" name="item_no" required value="{{ $planPosition->item_no }}" />
                                    @error('item_no')
                                    <span class="invalid" role="alert">
                                        <p>{{ $message }}</p>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="remarks">Remarks</label>
                                <textarea name="remarks" id="remarks" cols="50"
                                    rows="3">{{ $planPosition->remarks }}"</textarea>
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
                                    <option disabled selected>Select Classification Basis</option>
                                    @foreach ($classBasis as $data)
                                    <option value="{{ $data->cbasis_code }}" {{ $data->cbasis_code ===
                                        $planPosition->cbasis_code ? 'selected': ''}}>
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
                                    readonly>{{ $data->basis }}, dated {{ \Carbon\Carbon::parse($data->classdate)->format('m/d/Y') }}</textarea>
                                @error('titleAndDate')
                                <span class="invalid" role="alert">
                                    <p>{{ $message }}</p>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="cbasis_remarks">Notes</label>
                                <textarea name="cbasis_remarks" id="cbasis_remarks" cols="50"
                                    rows="3">{{ $planPosition->cbasis_remarks }}</textarea>
                                @error('cbasis_remarks')
                                <span class="invalid" role="alert">
                                    <p>{{ $message }}</p>
                                </span>
                                @enderror
                            </div>

                        </fieldset>

                    </div>


                    <div class="flex justify-between">
                        <h1 class="text-slate-400 text-sm font-semibold">
                            Created at {{ \Carbon\Carbon::parse($departmentLocation->created_at)->format('F d, Y
                            \a\t g:iA')
                            }}
                        </h1>
                        <button type="submit" class="btn btn-primary">
                            Save changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="flex justify-end">
    <button class="btn btn-primary" data-modal-target="large-modal" data-modal-toggle="large-modal">
        Add record
    </button>
    @include('admin.plantilla.appointee_occupant_manager.create')
</div>
<table class="dataTables">
    <thead>
        <tr>
            <th>CESNO</th>
            <th>Officials Name</th>
            <th>Appointee</th>
            <th>Appointment Date</th>
            <th>CES Status</th>
            <th>Appointment Date</th>
            <th>Encode Date</th>

            <th>
                <span class="sr-only">Action</span>
            </th>
        </tr>
    </thead>
    <tbody>

        @foreach ($planAppointee as $data)
        <tr>
            <td class="font-semibold">
                {{ $data->cesno }}
            </td>
            <td>
                {{ $data->cesno }}
            </td>
            <td>
                {{ $data->is_appointee }}
            </td>
            <td>
                {{ $data->appt_stat_code }}
            </td>
            <td>
                {{ $data->CESStat_code}}
            </td>
            <td>
                {{ $data->appt_date}}
            </td>
            <td>
                {{ $data->assum_date}}
            </td>

            <td class="text-right uppercase">
                <div class="flex justify-end">
                    <a class="hover:bg-slate-100 rounded-full" href="#">
                        <lord-icon src="https://cdn.lordicon.com/hbvgknxo.json" trigger="hover"
                            colors="primary:#ebe6ef,secondary:#4bb3fd,tertiary:#3a3347" style="width:24px;height:24px">
                        </lord-icon>
                    </a>
                    <form class="hover:bg-slate-100 rounded-full"
                        action="{{ route('plantilla-position-manager.destroy', ['plantilla_id' => $data->plantilla_id]) }}"
                        method="POST" onsubmit="return window.confirm('Are you sure you want to delete this item?')">
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

@endsection