@extends('layouts.app')
@section('title', $appointees->personalData->lastname . " " . $appointees->personalData->firstname)
@section('sub', $appointees->personalData->lastname . " " . $appointees->personalData->firstname)
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
            <a href="{{ route('plantilla-position-manager.show', ['sectorid' => $sector->sectorid, 'deptid' => $department->deptid, 'officelocid' => $departmentLocation->officelocid, 'officeid' => $office->officeid, 'plantilla_id' => $planPosition->plantilla_id]) }}"
                class="text-slate-500">{{ $planPosition->positionMasterLibrary->dbm_title }}</a>
        </li>
        <li>
            <svg class="flex-shrink-0 w-5 h-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </li>

        <li>
            <a href="#" class="text-blue-500">
                {{ $appointees->personalData->lastname }} {{ $appointees->personalData->firstname }} {{
                $appointees->personalData->name_extension }} {{ $appointees->personalData->middlename }}
            </a>
        </li>
    </ol>
</nav>

<div class="flex justify-between">
    <a href="#" class="text-blue-500 uppercase text-2xl">
        Other Assignment
    </a>
    <button class="btn btn-primary" data-modal-target="large-modal" data-modal-toggle="large-modal">
        Add record
    </button>
    @include('admin.plantilla.other_assignment.create')
</div>

@include('layouts.partials.isLoading')
<table class="dataTables hidden">
    <thead>
        <tr>
            <th>Detailed ID</th>
            <th>Status</th>
            <th>Position</th>
            <th>Office</th>
            <th>Remarks</th>
            <th>From - To</th>
            <th>Flr / Bldg</th>
            <th>Street</th>
            <th>Barangay</th>
            <th>City</th>
            <th>Contact number</th>
            <th>Email</th>
            <th>CESNO</th>

            <th>
                <span class="sr-only">Action</span>
            </th>
        </tr>
    </thead>
    <tbody>

        @foreach ($otherAssignment as $data)


        <tr>
            <td class="font-semibold">
                {{ $data->detailed_code }}
            </td>

            <td>{{ $data->apptStatus->title }}</td>
            <td>{{ $data->position }}</td>
            <td>{{ $data->office }}</td>
            <td>{{ $data->remarks }}</td>
            <td>
                {{ \Carbon\Carbon::parse($data->from_dt)->format('m/d/Y') }} -
                {{ \Carbon\Carbon::parse($data->to_dt)->format('m/d/Y') }}
            </td>
            <td>{{ $data->house_bldg }}</td>
            <td>{{ $data->st_road }}</td>
            <td>{{ $data->brgy_vill }}</td>
            <td>{{ $data->cities->name }}</td>
            <td>{{ $data->contactno }}</td>
            <td>{{ $data->email_addr }}</td>
            <td>{{ $data->cesno }}</td>

            <td class="text-right uppercase">
                <div class="flex justify-end">
                    <a class="hover:bg-slate-100 rounded-full" href="{{ route('other-assignment.show', [
                        'sectorid' => $sector->sectorid,
                        'deptid' => $department->deptid,
                        'officelocid' => $departmentLocation->officelocid,
                        'officeid' => $office->officeid,
                        'plantilla_id' => $planPosition->plantilla_id,
                        'appointee_id' => $appointees->appointee_id,
                        'detailed_code' => $data->detailed_code,
                    ]) }}" title="View assignment">
                        <lord-icon src="https://cdn.lordicon.com/bxxnzvfm.json" trigger="hover"
                            colors="primary:#3a3347,secondary:#ffc738,tertiary:#f9c9c0,quaternary:#ebe6ef"
                            style="width:24px;height:24px">
                        </lord-icon>
                    </a>
                    <form class="hover:bg-slate-100 rounded-full"
                        action="{{ route('other-assignment.destroy', ['detailed_code' => $data->detailed_code]) }}"
                        method="POST" onsubmit="return window.confirm('Are you sure you want to delete this item?')">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="mx-1 font-medium text-red-600 hover:underline"
                            title="Delete Assignment">
                            <lord-icon src="https://cdn.lordicon.com/jmkrnisz.json" trigger="hover"
                                colors="primary:#DC3545" style="width:24px;height:24px">
                            </lord-icon>
                        </button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
        {{-- @endforeach --}}

    </tbody>
</table>

@endsection