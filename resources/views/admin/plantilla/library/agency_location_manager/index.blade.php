@extends('layouts.app')
@section('title', 'Agency Location Manager')
@section('content')

<div class="lg:flex lg:justify-between my-3">
    <a href="#" class="text-blue-500 uppercase text-2xl">
        @yield('title')
    </a>
    <div class="flex">
        <a href="{{ route('library-agency-location-manager.trash') }}">
            <lord-icon src="https://cdn.lordicon.com/jmkrnisz.json" trigger="hover" colors="primary:#DC3545"
                style="width:34px;height:34px">
            </lord-icon>
        </a>

        <a class="btn btn-primary" href="{{ route('library-agency-location-manager.create') }}">Add record</a>
    </div>
</div>


<table class="dataTables">
    <thead>
        <tr>
            <th>Department Agency</th>
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
                {{ $data->departmentAgency->title }}
            </td>
            <td>
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
                        href="{{ route('library-agency-location-manager.edit', $data->officelocid) }}">
                        <lord-icon src="https://cdn.lordicon.com/hbvgknxo.json" trigger="hover"
                            colors="primary:#ebe6ef,secondary:#4bb3fd,tertiary:#3a3347" style="width:24px;height:24px">
                        </lord-icon>
                    </a>
                    <form class="hover:bg-slate-100 rounded-full"
                        action="{{ route('library-agency-location-manager.destroy', $data->officelocid) }}"
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