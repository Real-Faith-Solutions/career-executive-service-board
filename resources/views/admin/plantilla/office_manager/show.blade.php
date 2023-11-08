@extends('layouts.app')
@section('title', $office->title)
@section('sub', $office->title)
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
            <a href="#" class="text-blue-500">{{ $office->title }}</a>
        </li>
    </ol>
</nav>

<div class="flex justify-end">
    <a href="{{ route('agency-location-manager.show', ['sectorid' => $sector->sectorid, 'deptid' => $department->deptid, 'officelocid' => $departmentLocation->officelocid]) }}"
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
                <form action="{{ route('library-office-manager.update', $office->officeid) }}" method="POST"
                    enctype="multipart/form-data" id="updateForm" onsubmit="return checkErrorsBeforeSubmit(updateForm)">
                    @csrf
                    @method('put')
                    <input name="officelocid" type="hidden" value="{{ $office->officelocid }}">
                    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-2">
                        <div class="mb-3">
                            <label for="title">Office<sup>*</sup></label>
                            <input name="title" id="title" value="{{ $office->title }}">
                            @error('title')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="acronym">Office acronym<sup>*</sup></label>
                            <input name="acronym" id="acronym" value="{{ $office->acronym }}" minlength="2"
                                maxlength="10">
                            @error('acronym')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="website">Office website<sup>*</sup></label>
                            <input name="website" id="website" value="{{ $office->website }}" type="url">
                            @error('website')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="contactno">Office Contact No.</label>
                            <input id="contactno" name="contactno" value="{{ $office->officeAddress->contactno ?? ''}} "
                                type="tel" />
                            @error('contactno')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="emailadd">Office E-mail Address</label>
                            <input id="emailadd" name="emailadd" value="{{ $office->officeAddress->emailadd ?? ''}}"
                                type="email" />
                            @error('emailadd')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>

                    </div>
                    <hr>
                    <h1 class="font-semibold">Office Address</h1>
                    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-2">


                        <div class="mb-3">
                            <label for="floor_bldg">Floor / Bldg.</label>
                            <input id="floor_bldg" name="floor_bldg"
                                value="{{ $office->officeAddress->floor_bldg ?? ''}}" />
                            @error('floor_bldg')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="house_no_st">No. / Street</label>
                            <input id="house_no_st" name="house_no_st"
                                value="{{ $office->officeAddress->house_no_st ?? ''}}" />
                            @error('house_no_st')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="brgy_dist">Brgy. / District</label>
                            <input id="brgy_dist" name="brgy_dist"
                                value="{{ $office->officeAddress->brgy_dist ?? ''}}" />
                            @error('brgy_dist')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="city_code">City Municipality<sup>*</sup></label>
                            <select id="city_code" name="city_code" required>
                                <option disabled selected>Select City Municipality</option>
                                @foreach ($cities as $data)
                                <option value="{{ $data->city_code }}" {{ $office->officeAddress->city_code ==
                                    $data->city_code ? 'selected' : ''}}>
                                    {{ $data->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('city_code')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-2">
                        <div class="mb-3">
                            <label for="is_active">Office Status<sup>*</sup></label>
                            <select id="is_active" name="is_active" required>
                                <option disabled selected>Select status</option>
                                <option value="1" {{ $office->is_active == 1 ? 'selected' : ''}}>Active</option>
                                <option value="0" {{ $office->is_active == 0 ? 'selected' : ''}}>Inactive</option>
                            </select>
                            @error('is_active')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                    </div>


                    <h1 class="text-slate-400 text-sm font-semibold">
                        Last update at {{ \Carbon\Carbon::parse($office->lastupd_dt)->format('m/d/Y \a\t g:iA') }}
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