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
            <a href="{{ route('plantilla-position-manager.show', ['sectorid' => $sector->sectorid, 'deptid' => $department->deptid, 'officelocid' => $departmentLocation->officelocid, 'officeid' => $office->officeid, 'plantilla_id' => $planPosition->plantilla_id]) }}"
                class="text-slate-500">{{ $planPosition->positionMasterLibrary->dbm_title }}</a>
        </li>
        <li>
            <svg class="flex-shrink-0 w-5 h-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </li>

        <li>
            <a href="#" class="text-blue-500">create</a>
        </li>
    </ol>
</nav>
<div class="my-5 flex justify-end gap-4">
    <a class="btn btn-primary"
        href="{{ route('plantilla-position-manager.show', ['sectorid' => $sector->sectorid, 'deptid' => $department->deptid, 'officelocid' => $departmentLocation->officelocid, 'officeid' => $office->officeid, 'plantilla_id' => $planPosition->plantilla_id]) }}">
        Go back</a>
</div>

<div class="grid">
    <div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
        <div class="w-full text-left text-gray-500">
            <div class="bg-blue-500 uppercase text-gray-700 text-white">
                <h1 class="px-6 py-3">
                    CES Position - Add Occupant
                </h1>
            </div>

            <div class="bg-white px-6 py-3">

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-3 lg:grid-cols-3">

                    <div class="grid grid-row-2">

                        @if ($personalData)
                        <fieldset class="border p-4">
                            <legend>Profile Information</legend>

                            <div class="flex flex-col gap-4 lg:items-center">
                                <img id="" class="w-44 h-44 rounded-full object-cover"
                                    src="{{ file_exists(public_path('images/' . ($personalData->picture ?? 'images/assets/branding.png'))) ? asset('images/' . $personalData->picture) : asset('images/assets/branding.png') }}" />

                                <div class="flex flex-col gap-2 text-center">

                                    <h1 class="font-seFmibold">
                                        {{ $personalData->title ?? ''}}
                                        {{ $personalData->lastname ?? ''}},
                                        {{ $personalData->firstname ?? ''}}
                                        {{ $personalData->name_extension ?? ''}}
                                        {{ $personalData->middlename ?? ''}}
                                    </h1>
                                    <h1>
                                        {{ $personalData->email ?? '' }}
                                    </h1>
                                    <h1>
                                        {{ \Carbon\Carbon::parse($personalData->birthdate ?? '')->format('m/d/Y') }}
                                    </h1>
                                    <h1>
                                        <span class="mr-2 rounded px-2.5 py-0.5 text-xs font-medium
                                            @if ($personalData->status === 'Active') bg-green-100 text-green-800 @endif
                                            @if ($personalData->status === 'Inactive') bg-orange-100 text-orange-800 @endif
                                            @if ($personalData->status === 'Retired') bg-blue-100 text-blue-800 @endif
                                            @if ($personalData->status === 'Deceased') bg-red-100 text-red-800 @endif">
                                            {{ $personalData->status ?? ''}}
                                        </span>
                                    </h1>
                                    <a href="{{ route('personal-data.show', $personalData->cesno) }}"
                                        class="uppercase text-sm" target="_blank">
                                        View Profile
                                    </a>
                                </div>
                            </div>
                        </fieldset>
                        @endif

                        <fieldset class="border p-4">
                            <legend>Office information</legend>
                            <div class="mb-3">
                                <label for="Department/Agency">Department/Agency</label>
                                <input id="Department/Agency" value="{{ $department->title }}" readonly />
                            </div>
                            <div class="mb-3">
                                <label for="Location">Location</label>
                                <input id="Location" value="{{ $departmentLocation->title }}" readonly />
                            </div>
                            <div class="mb-3">
                                <label for="Office">Office</label>
                                <input id="Office" value="{{ $office->title }}" readonly />
                            </div>
                            <div class="mb-3">
                                <label for="titles">CES Level</label>
                                <input id="titles" value="{{ $planPosition->positionMasterLibrary->dbm_title }}"
                                    readonly />
                            </div>
                            <div class="mb-3">
                                <label for="sg">Salary Grade Level</label>
                                <input id="sg" value="{{ $planPosition->positionMasterLibrary->sg }}" readonly />
                            </div>
                            <hr />
                        </fieldset>

                    </div>


                    <div class="col-span-2">
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

                        <form action="{{ route('appointee-occupant-manager.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="plantilla_id" value="{{ $planPosition->plantilla_id }}">
                            <input type="hidden" name="cesno" value="{{ $cesno }}">
                            <fieldset class="border p-4">
                                <legend>Occupant information</legend>
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
                                                <input id="is_appointee" name="is_appointee" type="radio" value="1">
                                                <label class="ml-2 text-sm font-medium text-gray-900"
                                                    for="is_appointee">Appointee</label>
                                            </div>

                                            <div class="flex items-center mr-4">
                                                <input id="is_occupant" name="is_appointee" type="radio" value="0">
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
                                            value="{{ $personalData->title ?? ''}} {{ $personalData->lastname ?? ''}}, {{ $personalData->firstname ?? ''}} {{ $personalData->name_extension ?? ''}} {{ $personalData->middlename ?? ''}}"
                                            readonly />
                                        @error('cesno')
                                        <span class="invalid" role="alert">
                                            <p>{{ $message }}</p>
                                        </span>
                                        @enderror
                                        @error('plantilla_id')
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

                                    {{-- <div class="mb-3">
                                        <label for="official_code">Appointing Authority</label>
                                        <input id="official_code"
                                            value="{{ $authority->profileLibTblAppAuthority->description ?? '' }}"
                                            readonly />
                                    </div> --}}

                                    <div class="mb-3">
                                        <label for="name">Appointing Authority<sup>*</sup></label>
                                        <select id="name" name="name" required>
                                            <option value="" disabled selected>Appointing Authority</option>
                                            @foreach ($appAuthority as $data)
                                            <option value="{{ $data->code }}">
                                                {{ $data->description }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="appt_date">Appointment Date<sup>*</sup></label>
                                        <input id="appt_date" name="appt_date" type="date"
                                            value="{{ old('appt_date') }}" required/>
                                        @error('appt_date')
                                        <span class="invalid" role="alert">
                                            <p>{{ $message }}</p>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="assum_date">Assumption Date<sup>*</sup></label>
                                        <input id="assum_date" name="assum_date" type="date"
                                            value="{{ old('assum_date') }}" required/>
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


                                </div>

                                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-2">
                                    <div class="mb-3">
                                        <label for="basis">Basis</label>
                                        <textarea name="basis" id="basis" cols="30" rows="10"
                                            readonly>{{ $planPosition->classBasis->basis ?? ''}}</textarea>
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

                            </fieldset>

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
    </div>
</div>

@endsection