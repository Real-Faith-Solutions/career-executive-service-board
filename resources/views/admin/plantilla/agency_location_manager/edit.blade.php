@extends('layouts.app')
@section('title', $departmentLocation->title)
@section('sub', $departmentLocation->title)
@section('content')
@include('admin.plantilla.header')
<h1 class="text-center text-2xl font-semibold whitespace-nowrap uppercase text-blue-700">
    Plantilla Management System - (PMS)
</h1>

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
            <a href="#" class="text-blue-500">{{ $departmentLocation->title }}</a>
        </li>
    </ol>
</nav>

{{-- <div class="grid lg:grid-cols-2">
    <div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
        <div class="w-full text-left text-gray-500">
            <div class="bg-blue-500 uppercase text-gray-700 text-white">
                <h1 class="px-6 py-3">
                    Agency Location Manager
                </h1>
            </div>

            <div class="bg-white px-6 py-3">
                <form action="{{ route('library-agency-location-manager.update', $departmentLocation->officelocid) }}"
                    method="POST">
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

                    <div class="flex justify-between">
                        <h1 class="text-slate-400 text-sm font-semibold">
                            Last update at {{ \Carbon\Carbon::parse($departmentLocation->lastupd_date)->format('m/d/Y
                            \a\t g:iA') }}
                        </h1>
                        <button type="submit" class="btn btn-primary">
                            Save changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> --}}

<div class="flex justify-between">
    <a href="#" class="text-blue-500 uppercase text-2xl">
        Office Manager
    </a>
    <button class="btn btn-primary" data-modal-target="large-modal" data-modal-toggle="large-modal">
        Add record
    </button>
    @include('admin.plantilla.office_manager.create')
</div>

<table class="dataTables">
    <thead>
        <tr>
            <th>Office</th>
            <th>Office Acronym</th>
            <th>Office Website</th>

            <th>
                <span class="sr-only">Action</span>
            </th>
        </tr>
    </thead>
    <tbody>

        @foreach ($office as $data)
        <tr>
            <td class="font-semibold">
                {{ $data->title }}
            </td>
            <td>
                {{ $data->acronym ?? 'N/A' }}
            </td>
            <td>
                {{ $data->website ?? 'N/A' }}
            </td>

            <td class="text-right uppercase">
                <div class="flex justify-end">
                    <a class="hover:bg-slate-100 rounded-full"
                        href="{{ route('office-manager.edit', ['sectorid' => $sector->sectorid, 'deptid' => $department->deptid, 'officelocid' => $departmentLocation->officelocid, 'officeid' => $data->officeid]) }}"
                        title="Office Manager">
                        <lord-icon src="https://cdn.lordicon.com/bxxnzvfm.json" trigger="hover"
                            colors="primary:#3a3347,secondary:#ffc738,tertiary:#f9c9c0,quaternary:#ebe6ef"
                            style="width:24px;height:24px">
                        </lord-icon>
                    </a>
                    <a class="hover:bg-slate-100 rounded-full"
                        href="{{ route('office-manager.show', ['sectorid' => $sector->sectorid, 'deptid' => $department->deptid, 'officelocid' => $departmentLocation->officelocid, 'officeid' => $data->officeid]) }}"
                        title="Position Manager">
                        <lord-icon src="https://cdn.lordicon.com/hbvgknxo.json" trigger="hover"
                            colors="primary:#ebe6ef,secondary:#4bb3fd,tertiary:#3a3347" style="width:24px;height:24px">
                        </lord-icon>
                    </a>
                    <form class="hover:bg-slate-100 rounded-full"
                        action="{{ route('library-office-manager.destroy', $data->officeid) }}" method="POST"
                        onsubmit="return window.confirm('Are you sure you want to delete this item?')">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="mx-1 font-medium text-red-600 hover:underline"
                            title="Delete Record">
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