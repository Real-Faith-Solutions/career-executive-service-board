@extends('layouts.app')
@section('title', $datas->title)
@section('sub', $datas->title)
@section('content')
@include('admin.plantilla.header')
@include('admin.plantilla.department_agency_manager.create')

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
            <a href="#" class="text-blue-500">{{ $datas->title }}</a>
        </li>
    </ol>
</nav>

{{-- <div class="grid lg:grid-cols-2">
    <div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
        <div class="w-full text-left text-gray-500">
            <div class="bg-blue-500 uppercase text-gray-700 text-white">
                <h1 class="px-6 py-3">
                    Sector Manager
                </h1>
            </div>

            <div class="bg-white px-6 py-3">
                <form action="{{ route('library-sector.update', $datas->sectorid) }}" method="POST">
                    @csrf
                    @method('put')
                    <input type="hidden" name="encoder"
                        value="{{ Auth::user()->last_name }} {{ Auth::user()->first_name }} {{ Auth::user()->middle_name }}"
                        readonly>
                    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                        <div class="mb-3">
                            <label for="title">Sector name<sup>*</span></label>
                            <input id="title" name="title" type="text" value="{{ $datas->title }}" required>
                            @error('title')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description">Description<sup>*</span></label>
                            <textarea name="description" id="description" placeholder="Write your thoughts here..."
                                required>{{ $datas->description }}</textarea>
                            @error('description')
                            <span class="invalid" role="alert">
                                <p>{{ $message }}</p>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-between">
                        <h1 class="text-slate-400 text-sm font-semibold">
                            Last update at {{ \Carbon\Carbon::parse($datas->lastupd_date)->format('m/d/Y \a\t g:iA') }}
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

<div class="flex justify-between my-3 items-center">
    {{-- @include('components.search') --}}
    <a href="#" class="text-blue-500 uppercase text-2xl">
        Department Agencies
    </a>
    <button class="btn btn-primary" id="agencyCreateBtn">
        Add record
    </button>
</div>


{{-- <div class="relative overflow-x-auto shadow-lg sm:rounded-lg"> --}}
    @include('layouts.partials.isLoading')
    <table class="dataTables hidden">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                {{-- <th class="px-6 py-3" scope="col">Department ID</th> --}}
                {{-- <th class="px-6 py-3" scope="col">Sector</th> --}}
                <th class="px-6 py-3" scope="col">Mother Agency</th>
                <th class="px-6 py-3" scope="col">Agency / Bureau</th>
                <th class="px-6 py-3" scope="col">Agency / Bureau Acronym</th>
                <th class="px-6 py-3" scope="col">Office type</th>
                <th class="px-6 py-3" scope="col">Agency website</th>

                <th class="px-6 py-3" scope="col">
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>
        <tbody>

            @foreach ($subDatas as $data)
            <tr>
                <td class="whitespace-nowrap px-6 py-4 font-medium text-gray-900" scope="row">
                    @if($data->mother_deptid == 0)
                    {{ $data->title ?? 'N/A' }}

                    @else
                    {{ $data->motherDepartment->title ?? 'N/A'}}
                    @endif

                </td>
                <td class="px-6 py-3">
                    {{ $data->title ?? 'N/A' }}
                </td>
                <td class="px-6 py-3">
                    {{ $data->acronym ?? 'N/A' }}
                </td>
                <td class="px-6 py-3">
                    {{ $data->departmentAgencyType->title ?? 'N/A' }}
                </td>
                <td class="px-6 py-3">
                    <a href="{{ $data->website ?? 'N/A' }}" target="_blank" class="hover:text-blue-500">
                        {{ $data->website ?? 'N/A' }}
                    </a>
                </td>

                <td class="px-6 py-4 text-right uppercase">
                    <div class="flex justify-end">

                        <a class="hover:bg-slate-100 rounded-full"
                            href="{{ route('department-agency-manager.show', ['sectorid' => $datas->sectorid, 'deptid' => $data->deptid]) }}"
                            title="Department Agency Manager">
                            <lord-icon src="https://cdn.lordicon.com/bxxnzvfm.json" trigger="hover"
                                colors="primary:#3a3347,secondary:#ffc738,tertiary:#f9c9c0,quaternary:#ebe6ef"
                                style="width:24px;height:24px">
                            </lord-icon>
                        </a>

                        <a class="hover:bg-slate-100 rounded-full"
                            href="{{ route('department-agency-manager.showAgency', ['sectorid' => $datas->sectorid, 'deptid' => $data->deptid]) }}"
                            title="View Offices">
                            <lord-icon src="https://cdn.lordicon.com/hbvgknxo.json" trigger="hover"
                                colors="primary:#ebe6ef,secondary:#4bb3fd,tertiary:#3a3347"
                                style="width:24px;height:24px">
                            </lord-icon>
                        </a>
                        <form class="hover:bg-slate-100 rounded-full"
                            action="{{ route('library-department-manager.destroy', $data->deptid )}}" method="POST"
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
    {{-- <div class="m-5">
        {{ $subDatas->links() }}
    </div> --}}

    {{--
</div> --}}
@endsection