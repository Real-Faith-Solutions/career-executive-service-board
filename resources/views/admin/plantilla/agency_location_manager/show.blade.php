@extends('layouts.app')
@section('title', $departmentLocation->title)
@section('sub', $departmentLocation->title)
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
            <a href="#" class="text-blue-500">{{ $departmentLocation->title }}</a>
        </li>
    </ol>
</nav>

<div class="flex justify-end">
    <a href="{{ route('department-agency-manager.showAgency', ['sectorid' => $sector->sectorid, 'deptid' => $department->deptid]) }}"
        class="btn btn-primary">
        Go Back
    </a>
</div>
<div class="grid lg:grid-cols-2">
    <div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
        <div class="w-full text-left text-gray-500">
            <div class="bg-blue-500 uppercase text-gray-700 text-white">
                <h1 class="px-6 py-3">
                    Office Manager
                </h1>
            </div>

            <div class="bg-white px-6 py-3">
                <form action="{{ route('library-agency-location-manager.update', $departmentLocation->officelocid) }}"
                    method="POST" enctype="multipart/form-data" id="updateForm"
                    onsubmit="return checkErrorsBeforeSubmit(updateForm)">
                    @csrf
                    @method('put')
                    <input name="deptid" type="hidden" value="{{ $department->deptid }}" readonly>
                    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-2">
                        <div class="mb-3">
                            <label for="department">Department Agency</label>
                            <input name="department" id="department" value="{{ $department->title }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="title">Agency Location<sup>*</sup></label>
                            <input name="title" id="title" value="{{ $departmentLocation->title }}">
                            @error('title')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="loctype_id">Location type<sup>*</sup></label>
                            <select name="loctype_id" id="loctype_id">
                                @foreach ($agencyLocationLibrary as $data)
                                <option value="{{ $data->agencyloc_Id }}" {{ $departmentLocation->
                                    agencyLocationLibrary->agencyloc_Id == $data->agencyloc_Id ? 'selected' :''}}>
                                    {{ $data->title }}
                                </option>
                                @endforeach
                            </select>
                            @error('loctype_id')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="acronym">Acronym<sup>*</sup></label>
                            <input name="acronym" id="acronym" value="{{ $departmentLocation->acronym }}" minlength="2"
                                maxlength="10">
                            @error('acronym')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="region">Region<sup>*</sup></label>
                            <select name="region" id="region">
                                <option disabled selected>Select Region</option>
                                @foreach ($region as $data)
                                <option value="{{ $data->name }}" {{ $data->name == $departmentLocation->region ?
                                    'selected' : ''}}>{{
                                    $data->name }}</option>
                                @endforeach

                            </select>
                            @error('region')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="telno">Telno</label>
                            <input name="telno" id="telno" value="{{ $departmentLocation->telno }}" type="tel">
                            @error('telno')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="emailaddr">Email</label>
                            <input name="emailaddr" id="emailaddr" value="{{ $departmentLocation->emailaddr }}"
                                type="email">
                            @error('emailaddr')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <h1 class="text-slate-400 text-sm font-semibold">
                        Last update at {{ \Carbon\Carbon::parse($departmentLocation->lastupd_date)->format('m/d/Y
                        \a\t g:iA') }}
                    </h1>
                    <hr>
                    <div class="flex justify-end gap-2 mt-2">
                        <button type="button" id="btnEdit" class="btn btn-primary">
                            Edit Record
                        </button>
                        <button type="button" class="btn btn-primary hidden" id="btnSubmit"
                            onclick="openConfirmationDialog(this, 'Confirm changes', 'Are you sure you want to update this record?')">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/plantilla/editForm.js') }}"></script>
@endsection