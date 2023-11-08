@extends('layouts.app')
@section('title', 'Department Agency Manager - Edit')
@section('content')

<div class="my-5 flex justify-between gap-4">
    <a href="#" class="text-blue-500 uppercase text-2xl">
        @yield('title')
    </a>
    <div class="flex gap-2">
        <a class="btn btn-primary"
            href="{{ route('department-agency-manager.showAgency', ['sectorid' =>$department->sectorid , 'deptid' =>$department->deptid]) }}"
            target="_blank">
            Find in Main Screen
        </a>
        <a class="btn btn-primary" href="{{ route('library-department-manager.index') }}">Go back</a>
    </div>
</div>

<div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
    <div class="w-full text-left text-gray-500">
        <div class="bg-blue-500 uppercase text-gray-700 text-white">
            <h1 class="px-6 py-3">
                Department Agency Manager
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
                        <label for="sectorTitle">Sector<sup>*</span></label>
                        <select id="sectorTitle" name="sectorTitle" required>
                            @foreach ($sectorDatas as $data)
                            <option value="{{ $data->sectorid }}" {{ $data->sectorid ==
                                $department->sectorid ? 'selected' : '' }}>
                                {{ $data->title }}
                            </option>
                            @endforeach

                        </select>
                        @error('sectorTitle')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="mother_deptid">Mother Agency<sup>*</sup></label>
                        <select id="mother_deptid" name="mother_deptid" required>
                            @foreach ($motherDepartment as $data)
                            <option value="{{ $data->deptid }}" {{ $data->deptid == $department->mother_deptid ?
                                'selected' : ''}}>
                                {{ $data->title }}
                            </option>
                            @endforeach
                        </select>
                        @error('mother_deptid')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
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
                            maxlength="10" required>
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
                        <label for="remarks">Remarks</label>
                        <textarea name="remarks" id="remarks" cols="30" rows="10">{{ $department->remarks }}</textarea>
                        @error('remarks')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>


                </div>

                <div class="flex justify-between">
                    <h1 class="text-slate-400 text-sm font-semibold">
                        Last update at {{ \Carbon\Carbon::parse($department->lastupd_dt)->format('m/d/Y \a\t
                        g:iA') }}
                    </h1>
                    <div>
                        <button type="button" id="btnEdit" class="btn btn-primary">
                            Edit Record
                        </button>
                        <button type="button" class="btn btn-primary hidden" id="btnSubmit"
                            onclick="openConfirmationDialog(this, 'Confirm changes', 'Are you sure you want to update this record?')">
                            Save Changes
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="{{ asset('js/plantilla/editForm.js') }}"></script>
@endsection