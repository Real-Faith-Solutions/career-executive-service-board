<script>
    const classificationBasis = (val) => {
        const titleAndDateTextArea = document.querySelector('#titleAndDate');

        @foreach ($classBasis as $data)
        if ("{{ $data->cbasis_code }}" == val) {
            titleAndDateTextArea.value = "{{ $data->title }}, dated {{ \Carbon\Carbon::parse($data->classdate)->format('m/d/Y') }}";
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
        posDefaultInput.value = selectedOption.text;
    }

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
            <a href="{{ route('sector-manager.index') }}" class="text-slate-500">Sector</a>
        </li>
        <li>
            <svg class="flex-shrink-0 w-5 h-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </li>

        <li>
            <a href="{{ route('sector-manager.edit', $sector->sectorid) }}" class="text-slate-500">{{ $sector->title
                }}</a>
        </li>
        <li>
            <svg class="flex-shrink-0 w-5 h-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </li>

        <li>
            <a href="{{ route('department-agency-manager.showAgency', ['sectorid' => $sector->sectorid, 'deptid' => $department->deptid]) }}"
                class="text-slate-500">{{
                $department->title }}</a>
        </li>
        <li>
            <svg class="flex-shrink-0 w-5 h-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </li>

        <li>
            <a href="{{ route('agency-location-manager.show', ['sectorid' => $sector->sectorid, 'deptid' => $department->deptid, 'officelocid' => $departmentLocation->officelocid]) }}"
                class="text-slate-500">{{ $departmentLocation->title }}</a>
        </li>
        <li>
            <svg class="flex-shrink-0 w-5 h-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </li>

        <li>
            <a href="{{ route('office-manager.show', ['sectorid' => $sector->sectorid, 'deptid' => $department->deptid, 'officelocid' => $departmentLocation->officelocid, 'officeid' => $office->officeid]) }}"
                class="text-slate-500">{{ $office->title }}</a>
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



<div class="flex justify-between">
    <a href="#" class="text-blue-500 uppercase text-2xl">
        Appointee - Occupant Browser
    </a>
    <a href="{{ route('appointee-occupant-manager.create',['sectorid' => $sector->sectorid, 'deptid' => $department->deptid, 'officelocid' => $departmentLocation->officelocid, 'officeid' => $office->officeid, 'plantilla_id' => $planPosition->plantilla_id] ) }}"
        class="btn btn-primary">
        Add record
    </a>
</div>
<table class="dataTables">
    <thead>
        <tr>
            <th>CESNO</th>
            <th>Officials Name</th>
            <th>Is appointed on this position</th>
            <th>Appointment</th>
            <th>CES Status</th>
            <th>Appointment Date</th>
            <th>Assumption Date</th>

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
                {{ $data->personalData->lastname ?? ''}}
                {{ $data->personalData->firstname ?? ''}}
                {{ $data->personalData->name_extension ?? ''}}
                {{ $data->personalData->middlename ?? ''}}
            </td>
            <td>
                <span class="{{ $data->is_appointee == 1 ? 'success' : 'danger'}}">
                    {{ $data->is_appointee == 1 ? 'YES' : 'NO'}}
                </span>
            </td>
            <td>
                {{ $data->apptStatus->title }}
            </td>
            <td>
                {{ $data->personalData->cesStatus->description ?? 'N/A'}}
            </td>
            <td>
                {{ \Carbon\Carbon::parse($data->appt_date)->format('m/d/Y') }}
            </td>
            <td>
                {{ \Carbon\Carbon::parse($data->assum_date)->format('m/d/Y') }}
            </td>

            <td class="text-right uppercase">
                <div class="flex justify-end">
                    <a class="hover:bg-slate-100 rounded-full" href="{{ route('appointee-occupant-manager.edit', [
                        'sectorid' => $sector->sectorid,
                        'deptid' => $department->deptid,
                        'officelocid' => $departmentLocation->officelocid,
                        'officeid' => $office->officeid,
                        'plantilla_id' => $planPosition->plantilla_id,
                        'appointee_id' => $data->appointee_id,
                    ]) }}" title="Appointee - Occupant Manager">
                        <lord-icon src="https://cdn.lordicon.com/bxxnzvfm.json" trigger="hover"
                            colors="primary:#3a3347,secondary:#ffc738,tertiary:#f9c9c0,quaternary:#ebe6ef"
                            style="width:24px;height:24px">
                        </lord-icon>
                    </a>
                    <a class="hover:bg-slate-100 rounded-full" href="{{ route('appointee-occupant-manager.show', [
                        'sectorid' => $sector->sectorid,
                        'deptid' => $department->deptid,
                        'officelocid' => $departmentLocation->officelocid,
                        'officeid' => $office->officeid,
                        'plantilla_id' => $planPosition->plantilla_id,
                        'appointee_id' => $data->appointee_id,
                    ]) }}" title="View Other Assignment">
                        <lord-icon src="https://cdn.lordicon.com/hbvgknxo.json" trigger="hover"
                            colors="primary:#ebe6ef,secondary:#4bb3fd,tertiary:#3a3347" style="width:24px;height:24px">
                        </lord-icon>
                    </a>
                    <form class="hover:bg-slate-100 rounded-full"
                        action="{{ route('appointee-occupant-manager.destroy', ['appointee_id' => $data->appointee_id]) }}"
                        method="POST" onsubmit="return window.confirm('Are you sure you want to delete this item?')">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="mx-1 font-medium text-red-600 hover:underline"
                            title="Delete Record">
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