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
            <a href="{{ route('sector-manager.index') }}" class="text-slate-500">Sector Manager</a>
        </li>
        <li>
            <svg class="flex-shrink-0 w-5 h-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </li>

        <li>
            <a href="{{ route('sector-manager.edit', $sector->sectorid) }}" class="text-blue-500">{{ $sector->title
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

<div class="grid lg:grid-cols-2">
    <div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
        <div class="w-full text-left text-gray-500">
            <div class="bg-blue-500 uppercase text-gray-700 text-white">
                <h1 class="px-6 py-3">
                    Department / Agency Manager
                </h1>
            </div>

            <div class="bg-white px-6 py-3">
                <form action="{{ route('library-department-manager.update', $department->deptid) }}" method="POST">
                    @csrf
                    @method('put')

                    <input type="hidden" name="encoder"
                        value="{{ Auth::user()->last_name }} {{ Auth::user()->first_name }} {{ Auth::user()->middle_name }}"
                        readonly>

                    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-2">
                        <div class="mb-3">
                            <label for="mother_deptid">Agency Name<sup>*</sup></label>
                            <select id="mother_deptid" name="mother_deptid" required>
                                @foreach ($motherDepartment as $data)
                                <option value="{{ $data->deptid }}" {{ $data->deptid === $department->mother_deptid ?
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
                            <textarea name="remarks" id="remarks" cols="30"
                                rows="10">{{ $department->remarks }}</textarea>
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
                        <button type="submit" class="btn btn-primary">
                            Save changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="flex justify-between">
    <a href="#" class="text-blue-500 uppercase text-2xl">
        Location Manager
    </a>
    <button class="btn btn-primary" data-modal-target="large-modal" data-modal-toggle="large-modal">
        Add record
    </button>
    @include('admin.plantilla.agency_location_manager.create')
</div>


<table class="dataTables">
    <thead>
        <tr>
            <th>Location</th>
            <th>Location Acronym</th>
            <th>Location type</th>
            <th>Region</th>

            <th>
                <span class="sr-only">Action</span>
            </th>
        </tr>
    </thead>
    <tbody>

        @foreach ($agencyLocation as $data)
        <tr>
            <td class="font-semibold">
                {{ $data->title }}
            </td>
            <td>
                {{ $data->acronym ?? 'N/A' }}
            </td>
            <td>
                {{ $data->agencyLocationLibrary->title ?? 'N/A'}}
            </td>
            <td>
                {{ $data->region ?? 'N/A' }}
            </td>

            <td class="text-right uppercase">
                <div class="flex justify-end">
                    <a class="hover:bg-slate-100 rounded-full"
                        href="{{ route('agency-location-manager.show', ['sectorid' => $sector->sectorid, 'deptid' => $department->deptid, 'officelocid' => $data->officelocid]) }}">
                        <lord-icon src="https://cdn.lordicon.com/hbvgknxo.json" trigger="hover"
                            colors="primary:#ebe6ef,secondary:#4bb3fd,tertiary:#3a3347" style="width:24px;height:24px">
                        </lord-icon>
                    </a>
                    <form class="hover:bg-slate-100 rounded-full"
                        action="{{ route('library-agency-location-manager.destroy', $data->officelocid) }}) }}"
                        method="POST" onsubmit="return window.confirm('Are you sure you want to delete this item?')">
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