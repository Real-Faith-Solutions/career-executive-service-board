@extends('layouts.app')
@section('title', $department->title)
@section('sub', $department->title)
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
            <a href="#" class="text-blue-500">{{ $department->title }}</a>
        </li>
    </ol>
</nav>

<div class="flex justify-end">
    <a href="{{ route('sector-manager.edit', $sector->sectorid) }}" class="btn btn-primary">Go Back</a>
</div>

<div class="grid lg:grid-cols-2">
    <div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
        <div class="w-full text-left text-gray-500">
            <div class="bg-blue-500 uppercase text-gray-700 text-white">
                <h1 class="px-6 py-3">
                    Department / Agency Manager
                </h1>
            </div>

            <div class="bg-white px-6 py-3">
                <form action="{{ route('library-department-manager.update', $department->deptid) }}" method="POST"
                    enctype="multipart/form-data" id="updateForm" onsubmit="return checkErrorsBeforeSubmit(updateForm)">
                    @csrf
                    @method('put')

                    <input type="hidden" name="encoder"
                        value="{{ Auth::user()->last_name }} {{ Auth::user()->first_name }} {{ Auth::user()->middle_name }}"
                        readonly>

                    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-2">
                        <div class="mb-3">
                            <label for="mother_deptid">Mother Agency<sup>*</sup></label>
                            <select id="mother_deptid" name="mother_deptid" required {{ $department->mother_deptid == 0
                                ? 'disabled' : '' }}>

                                @if($department->mother_deptid == 0) {{-- 0 means mother agency --}}
                                        <option value="0" selected>
                                            {{ $department->title }}
                                        </option>
                                    @foreach ($motherDepartment as $data)
                                        <option value="{{ $data->deptid }}">
                                            {{ $data->title }}
                                        </option>
                                    @endforeach

                                @else

                                    @foreach ($motherDepartment as $data)
                                        <option value="{{ $data->deptid }}" {{ $data->deptid == $department->mother_deptid ?
                                            'selected' : ''}}>
                                            {{ $data->title }}
                                        </option>
                                    @endforeach

                                @endif

                            </select>

                            @error('mother_deptid')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror

                            @if($department->mother_deptid == 0)
                                <h1 class="text-slate-500 text-sm italic">
                                    Note: This Department is Mother Agency.
                                </h1>
                            @endif

                        </div>

                        <div class="mb-3">
                            <label for="departmentTypeDatas">Office Type<sup>*</span></label>
                            <select id="departmentTypeDatas" name="agency_typeid" required>
                                @foreach ($departmentTypeDatas as $data)
                                    <option value="{{ $data->agency_typeid }}" {{ $data->agency_typeid ==
                                        $department->agency_typeid ? 'selected' : '' }}>
                                        {{ $data->title }}
                                    </option>
                                @endforeach

                            </select>
                            @error('agency_typeid')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="title">Agency / Bureau<sup>*</span></label>
                            <input id="title" name="title" value="{{ $department->title }}" required>
                            @error('title')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="acronym">Agency / Bureau Acronym<sup>*</span></label>
                            <input id="acronym" name="acronym" value="{{ $department->acronym }}" minlength="2"
                                maxlength="25" required>
                            @error('acronym')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="website">Website</label>
                            <input id="website" name="website" type="url" value="{{ $department->website }}">
                            @error('website')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="lastsubmit_dt">Last date submission</label>
                            <input id="lastsubmit_dt" name="lastsubmit_dt" value="{{ \Carbon\Carbon::parse($department->lastsubmit_dt)->format('d, F Y') }}" readonly>
                            <h1 class="text-slate-500 text-sm italic">
                                Note: This field will automatically update.
                            </h1>
                            @error('lastsubmit_dt')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="remarks">Remarks<sup>*</sup></label>
                            <textarea name="remarks" id="remarks" cols="30"
                                rows="10" required>{{ $department->remarks }}</textarea>
                            @error('remarks')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>


                    </div>

                    <h1 class="text-slate-400 text-sm font-semibold">
                        Last update at {{ \Carbon\Carbon::parse($department->lastupd_dt)->format('m/d/Y \a\t
                        g:iA') }}
                    </h1>
                    <hr>
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
</div>
<script src="{{ asset('js/plantilla/editForm.js') }}"></script>
@endsection