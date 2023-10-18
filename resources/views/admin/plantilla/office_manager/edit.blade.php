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
            <a href="#" class="text-blue-500">{{ $office->title }}</a>
        </li>
    </ol>
</nav>

<div class="grid lg:grid-cols-2">
    <div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
        <div class="w-full text-left text-gray-500">
            <div class="bg-blue-500 uppercase text-gray-700 text-white">
                <h1 class="px-6 py-3">
                    Office Location Manager
                </h1>
            </div>

            <div class="bg-white px-6 py-3">
                <form action="{{ route('library-office-manager.update', $office->officeid) }}" method="POST">
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

                    <div class="flex justify-between">
                        <h1 class="text-slate-400 text-sm font-semibold">
                            Last update at {{ \Carbon\Carbon::parse($office->lastupd_dt)->format('m/d/Y \a\t g:iA') }}
                        </h1>
                        <button type="submit" class="btn btn-primary">
                            Save changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="flex justify-end items-center gap-2 uppercase font-semibold text-sm">

    {{-- legend
    active = 1 || ces + presidential = white background / black text
    inactive = disabled text
    vacant = 1 = yellow background / red text
    non ces + presidential = white background / blue text
    --}}

    <span>Active</span> <br>
    <span class="p-1 text-slate-500">Inactive</span>
    {{-- <span class="p-1 text-dark-500">CES + Presidential</span> --}}
    <span class="p-1 bg-yellow-100 text-red-500">Vacant</span>
    <span class="p-1 bg-gray-50 text-blue-500">NON ces + Presidential</span>


</div>


<div class="flex justify-between">
    <a href="#" class="text-blue-500 uppercase text-2xl">
        Plantilla Position Manager
    </a>
    <button class="btn btn-primary" data-modal-target="large-modal" data-modal-toggle="large-modal">
        Add record
    </button>
    @include('admin.plantilla.appointee_occupant_manager.create')
</div>
<table class="dataTables">
    <thead>
        <tr>
            <th>Plantilla ID</th>
            <th>Position Title</th>
            <th>Position Level</th>
            <th>Salary Grade Level</th>
            <th>Item No.</th>
            {{-- <th>Vacant</th> --}}
            {{-- <th>Pres. Appointee</th> --}}

            <th>
                <span class="sr-only">Action</span>
            </th>
        </tr>
    </thead>
    <tbody>

        @foreach ($planPositions as $data)
        <tr class="

            @if($data->is_active != 1)
                text-slate-400
            @else
                @if($data->is_vacant == 1)
                    bg-yellow-100 text-red-500
                @else
                    @if ($data->is_ces_pos != 1 && $data->pres_apptee == 1)
                        bg-gray-50 text-blue-500
                    @else
                        text-dark
                    @endif
                @endif
            @endif
        ">
            <td>
                {{ $data->plantilla_id }}
            </td>
            <td>
                {{-- {{ $data->positionMasterLibrary->dbm_title ?? 'N/A'}} --}}
                {{ $data->pos_default ?? 'N/A'}}
            </td>

            <td>
                {{ $data->positionMasterLibrary->positionLevel->title ?? 'N/A'}}
            </td>

            <td>
                {{ $data->corp_sg }}
            </td>

            <td>
                {{ $data->item_no }}
            </td>
            {{-- <td>
                <span class="{{ $data->is_vacant == 1 ? 'success' : 'danger'}}">
                    {{ $data->is_vacant == 1 ? 'YES' : 'NO'}}
                </span>
            </td> --}}

            {{-- <td>
                <span class="{{ $data->pres_apptee == 1 ? 'success' : 'danger'}}">
                    {{ $data->pres_apptee == 1 ? 'YES' : 'NO'}}
                </span>
            </td> --}}

            <td class="text-right uppercase">
                <div class="flex justify-end">
                    <a class="hover:bg-slate-100 rounded-full" href="{{ route('plantilla-position-manager.show', [
                        'sectorid' => $sector->sectorid,
                        'deptid' => $department->deptid,
                        'officelocid' => $departmentLocation->officelocid,
                        'officeid' => $office->officeid,
                        'plantilla_id' => $data->plantilla_id
                    ]) }}">
                        <lord-icon src="https://cdn.lordicon.com/hbvgknxo.json" trigger="hover"
                            colors="primary:#ebe6ef,secondary:#4bb3fd,tertiary:#3a3347" style="width:24px;height:24px">
                        </lord-icon>
                    </a>
                    <form class="hover:bg-slate-100 rounded-full"
                        action="{{ route('library-position-manager.destroy', $data->plantilla_id) }}" method="POST"
                        onsubmit="return window.confirm('Are you sure you want to delete this item?')">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="mx-1 font-medium text-red-600 hover:underline">
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