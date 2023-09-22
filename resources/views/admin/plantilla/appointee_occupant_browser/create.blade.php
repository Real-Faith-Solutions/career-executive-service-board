@extends('layouts.app')
@section('title', $planPosition->positionMasterLibrary->dbm_title)
@section('sub', $planPosition->positionMasterLibrary->dbm_title)
@section('content')
@include('admin.plantilla.header')

<div class="my-5 flex justify-end gap-4">
    <a class="btn btn-primary"
        href="{{ route('plantilla-position-manager.show', ['sectorid' => $sector->sectorid, 'deptid' => $department->deptid, 'officelocid' => $departmentLocation->officelocid, 'officeid' => $office->officeid, 'plantilla_id' => $planPosition->plantilla_id]) }}">Go
        back</a>
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

                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-2">
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
                            <input id="titles" value="{{ $planPosition->positionMasterLibrary->dbm_title }}" readonly />
                        </div>
                        <div class="mb-3">
                            <label for="sg">Salary Grade Level</label>
                            <input id="sg" value="{{ $planPosition->positionMasterLibrary->sg }}" readonly />
                        </div>
                    </fieldset>

                    <div class="">


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
                                @error('cesno')
                                <span class="invalid" role="alert">
                                    <p>{{ $message }}</p>
                                </span>
                                @enderror
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
                                            <option disabled selected>Select Personnel Movement</option>
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
                                                <input id="is_occupant" name="is_appointee" type="radio" value="1">
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
                                            value="{{ $personalData->lastname ?? ''}} {{ $personalData->firstname ?? ''}} {{ $personalData->name_extension ?? ''}} {{ $personalData->middlename ?? ''}}"
                                            readonly />
                                    </div>
                                </div>


                                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-2">
                                    <div class="mb-3">
                                        <label for="cesStatus">CES Status</label>
                                        <input id="cesStatus" value="{{ $personalData->cesStatus->description ?? '' }}"
                                            readonly />
                                    </div>

                                    <div class="mb-3">
                                        <label for="assum_date">Assumption Date<sup>*</sup></label>
                                        <input id="assum_date" name="assum_date" type="date"
                                            value="{{ old('assum_date') }}" />
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

                                    <div class="mb-3">
                                        <label for="appt_date">Appointment Date<sup>*</sup></label>
                                        <input id="appt_date" name="appt_date" type="date"
                                            value="{{ old('appt_date') }}" />
                                        @error('appt_date')
                                        <span class="invalid" role="alert">
                                            <p>{{ $message }}</p>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-2">
                                    <div class="mb-3">
                                        <label for="basis">Basis</label>
                                        <textarea name="basis" id="basis" cols="30" rows="10"
                                            readonly>{{ $planPosition->classBasis->basis }}</textarea>
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