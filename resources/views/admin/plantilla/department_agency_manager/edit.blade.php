@extends('layouts.app')
@section('title', $department->title)
@section('sub', $department->title)
@section('content')
    @include('admin.plantilla.header')

    <nav class="flex" aria-label="Breadcrumb">
        <ol class="flex items-center space-x-2">
            <li>
                <a href="{{ route('plantilla-management.index') }}" class="text-slate-500">Plantilla</a>
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
                <a href="{{ route('sector-manager.edit', $sector->sectorid) }}"
                    class="text-blue-500">{{ $sector->title }}</a>
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
                    <form action="{{ route('department-agency-manager.updateAgency', ['sectorid' => $sector->sectorid, 'deptid' => $department->deptid]) }}" method="POST">
                        @csrf

                        <input type="hidden" name="encoder"
                            value="{{ Auth::user()->last_name }} {{ Auth::user()->first_name }} {{ Auth::user()->middle_name }}"
                            readonly>

                        <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-2">
                            <div class="mb-3">
                                <label for="sectorTitle">Mother Agency<sup>*</span></label>
                                <select id="sectorTitle" name="sectorTitle" required disabled>
                                    @foreach ($sectorDatas as $data)
                                        <option value="{{ $data->sectorid }}" {{ $data->sectorid == $department->plantilla_tblSector_id ? 'selected' : '' }}>
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
                                <label for="departmentTypeDatas">Office Type<sup>*</span></label>
                                <select id="departmentTypeDatas" name="plantillalib_tblAgencyType_id" required>
                                    @foreach ($departmentTypeDatas as $data)
                                        <option value="{{ $data->agency_typeid }}" {{ $data->agency_typeid == $department->plantillalib_tblAgencyType_id ? 'selected' : '' }}>
                                            {{ $data->title }}
                                        </option>
                                    @endforeach

                                </select>
                                @error('plantillalib_tblAgencyType_id')
                                    <span class="invalid" role="alert">
                                        <p>{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="title">Agency / Bureau<sup>*</span></label>
                                <input id="title" name="title" value="{{ $department->title }}"
                                    required>
                                @error('title')
                                    <span class="invalid" role="alert">
                                        <p>{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="acronym">Agency / Bureau Acronym<sup>*</span></label>
                                <input id="acronym" name="acronym" value="{{ $department->acronym }}" minlength="2" maxlength="10"
                                    required>
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
                                Created at {{ \Carbon\Carbon::parse($department->created_at)->format('F d, Y \a\t h:iA') }}
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

@endsection
