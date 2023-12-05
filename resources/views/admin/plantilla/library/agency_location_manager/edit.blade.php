@extends('layouts.app')
@section('title', 'Agency Location Manager - Edit')
@section('content')

<div class="my-5 flex justify-between gap-4">
    <a href="#" class="text-blue-500 uppercase text-2xl">
        @yield('title')
    </a>
    <div class="flex gap-2">
        <a class="btn btn-primary"
            href="{{ route('agency-location-manager.show', ['sectorid' => $agencyLocation->departmentAgency->sectorid, 'deptid' => $agencyLocation->departmentAgency->deptid, 'officelocid' => $agencyLocation->officelocid]) }}"
            target="_blank">
            Find in Main Screen
        </a>
        <a class="btn btn-primary" href="{{ route('library-agency-location-manager.index') }}">Go back</a>
    </div>
</div>

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Agency Location Manager
            </h1>
        </div>

        <div class="bg-white px-6 py-3">
            <form action="{{ route('library-agency-location-manager.update', $agencyLocation->officelocid) }}"
                method="POST" enctype="multipart/form-data" id="updateForm"
                onsubmit="return checkErrorsBeforeSubmit(updateForm)">
                @csrf
                @method('put')
                <div class="grid grid-cols-2 gap-2">
                    <div class="mb-3">
                        <label for="deptid">Department Agency<sup>*</sup></label>
                        <select id="deptid" name="deptid" required>
                            @foreach ($departmentAgencies as $departmentAgency)
                            <option value="{{ $departmentAgency->deptid }}" {{ $departmentAgency->deptid ==
                                $agencyLocation->deptid ? 'selected' : ''}}>
                                {{ $departmentAgency->title }}
                            </option>
                            @endforeach
                        </select>
                        @error('deptid')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="title">Location<sup>*</sup></label>
                        <input id="title" name="title" required value="{{ $agencyLocation->title}}" />
                        @error('title')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="acronym">Acronym<sup>*</sup></label>
                        <input id="acronym" name="acronym" minlength="2" maxlength="10" required
                            value="{{ $agencyLocation->acronym}}" />
                        @error('acronym')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="loctype_id">Agency Type<sup>*</sup></label>
                        <select id="loctype_id" name="loctype_id" required>
                            @foreach ($agencyLocationLibrary as $data)
                            <option value="{{ $data->agencyloc_Id }}" {{ $data->agencyloc_Id ==
                                $agencyLocation->loctype_id ? 'selected' : '' }}>
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
                        <label for="telno">Telno</label>
                        <input id="telno" name="telno" type="tel" value="{{ $agencyLocation->telno}}" />
                        @error('telno')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="emailaddr">Email</label>
                        <input id="emailaddr" name="emailaddr" type="email" value="{{ $agencyLocation->emailaddr }}" />
                        @error('emailaddr')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="region">Region<sup>*</sup></label>
                        <select id="region" name="region" type="region" required>
                            <option disabled selected>Select Region</option>
                            @foreach ($region as $data)
                            <option value="{{ $data->name }}" {{ $data->name == $agencyLocation->region ? 'selected' :
                                ''}}>
                                {{ $data->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('region')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="flex justify-between">
                    <h1 class="text-slate-400 text-sm font-semibold">
                        Last update at {{ \Carbon\Carbon::parse($agencyLocation->lastupd_dt)->format('m/d/Y \a\t
                        g:iA') }}
                    </h1>
                    <div>
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
                </div>
            </form>
        </div>
    </div>
</div>
<script src="{{ asset('js/plantilla/editForm.js') }}"></script>
@endsection