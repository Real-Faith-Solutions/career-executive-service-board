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
            <a href="{{ route('sector-manager.index') }}" class="text-slate-500">Sector Manager</a>
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
            <a href="{{ route('appointee-occupant-manager.show', ['sectorid' => $sector->sectorid, 'deptid' => $department->deptid, 'officelocid' => $departmentLocation->officelocid, 'officeid' => $office->officeid, 'plantilla_id' => $planPosition->plantilla_id, 'appointee_id' => $appointees->appointee_id]) }}"
                class="text-slate-500">
                {{ $appointees->personalData->lastname }} {{ $appointees->personalData->firstname }} {{
                $appointees->personalData->name_extension }} {{ $appointees->personalData->middlename }}
            </a>
        </li>
        <li>
            <svg class="flex-shrink-0 w-5 h-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </li>

        <li>
            <a href="#" class="text-blue-500">
                Other Assignment # {{ $otherAssignment->detailed_code }}
            </a>
        </li>
    </ol>
</nav>

<div class="grid">
    <div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
        <div class="w-full text-left text-gray-500">
            <div class="bg-blue-500 uppercase text-gray-700 text-white">
                <h1 class="px-6 py-3">
                    Occupant Profile
                </h1>
            </div>

            <div class="bg-white px-6 py-3">

                <form
                    action="{{ route('other-assignment.update', ['detailed_code' =>  $otherAssignment->detailed_code ]) }}"
                    method="POST">
                    @csrf
                    <input type="hidden" name="cesno" value="{{ $appointees->personalData->cesno }}">
                    <div class="grid grid-cols-2 gap-2">
                        <div class="mb-3">
                            <label for="name">Name</label>
                            <input id="name" name="name" readonly
                                value="{{ $appointees->personalData->lastname }} {{ $appointees->personalData->firstname }} {{ $appointees->personalData->name_extension }} {{ $appointees->personalData->middlename }}" />
                            @error('name')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="appt_status_code">Status<sup>*</sup></label>
                            <select id="appt_status_code" name="appt_status_code" required>
                                <option disabled selected>Select Status</option>
                                @foreach ($apptStatus as $data)
                                <option value="{{ $data->appt_stat_code }}" {{ $data->appt_stat_code ==
                                    $otherAssignment->appt_status_code ? 'selected' : ''}} >
                                    {{ $data->title }}
                                </option>
                                @endforeach
                            </select>
                            @error('appt_status_code')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="position">Position</label>
                            <input id="position" name="position" readonly
                                value="{{ $planPosition->positionMasterLibrary->dbm_title }}" />
                            @error('name')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="from_dt">From<sup>*</sup></label>
                            <input id="from_dt" name="from_dt" required type="date"
                                value="{{ $otherAssignment->from_dt }}" />
                            @error('from_dt')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="office">Office Agency</label>
                            <input id="office" name="office" readonly value="{{ $departmentLocation->title }}" />
                            @error('office')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="to_dt">To<sup>*</sup></label>
                            <input id="to_dt" name="to_dt" required type="date" value="{{ $otherAssignment->to_dt }}" />
                            @error('to_dt')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="house_bldg">Floor/Bldg</label>
                            <input id="house_bldg" name="house_bldg" value="{{ $otherAssignment->house_bldg }}" />
                            @error('house_bldg')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="st_road">Street</label>
                            <input id="st_road" name="st_road" value="{{ $otherAssignment->st_road }}" />
                            @error('st_road')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="brgy_vill">Barangay</label>
                            <input id="brgy_vill" name="brgy_vill" value="{{ $otherAssignment->brgy_vill }}" />
                            @error('brgy_vill')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="city_code">City</label>
                            <select id="city_code" name="city_code">
                                <option disabled selected>Select City</option>
                                @foreach ($cities as $data)
                                <option value="{{ $data->city_code }}" {{ $data->city_code ==
                                    $otherAssignment->city_code ? 'selected' : ''}}>{{ $data->name }}</option>
                                @endforeach
                            </select>
                            @error('city_code')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="contactno">Contact No</label>
                            <input id="contactno" name="contactno" type="tel"
                                value="{{ $otherAssignment->contactno }}" />
                            @error('contactno')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email_addr">Email address</label>
                            <input id="email_addr" name="email_addr" type="email"
                                value="{{ $otherAssignment->email_addr }}" />
                            @error('email_addr')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>

                    </div>
                    <div class="mb-3">
                        <label for="remarks">Remarks</label>
                        <textarea name="remarks" id="remarks" cols="30"
                            rows="10">{{ $otherAssignment->remarks }}</textarea>
                    </div>
                    <div class="flex justify-end">
                        <button class="btn btn-primary" type="submit">
                            Submit
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>


@endsection