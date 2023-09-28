@extends('layouts.app')
@section('title', 'Department Agency Manager')
@section('content')

<div class="lg:flex lg:justify-between my-3">
    <a href="#" class="text-blue-500 uppercase text-2xl">
        @yield('title')
    </a>
    <div class="flex">
        <a href="#">
            <lord-icon src="https://cdn.lordicon.com/jmkrnisz.json" trigger="hover" colors="primary:#DC3545"
                style="width:34px;height:34px">
            </lord-icon>
        </a>

        <a class="btn btn-primary" href="{{ route('library-department-manager.create') }}">Add record</a>
    </div>
</div>


<table class="dataTables">
    <thead>
        <tr>
            <th>Department ID</th>
            <th>Mother Agency</th>
            <th>Agency / Bureau</th>
            <th>Agency / Bureau Acronym</th>
            <th>Office type</th>
            <th>Agency website</th>

            <th>
                <span class="sr-only">Action</span>
            </th>
        </tr>
    </thead>
    <tbody>

        @foreach ($datas as $data)
        <tr>
            <td class="font-semibold">
                {{ $data->deptid }}
            </td>
            <td>
                {{ $data->sectorManager->title ?? 'N/A' }}
            </td>
            <td>
                {{ $data->title ?? 'N/A' }}
            </td>
            <td>
                {{ $data->acronym ?? 'N/A' }}
            </td>
            <td>
                {{ $data->departmentAgencyType->title ?? 'N/A' }}
            </td>
            <td>
                <a href="{{ $data->website ?? 'N/A' }}" target="_blank" class="hover:text-blue-500">
                    {{ $data->website ?? 'N/A' }}
                </a>
            </td>

            <td class="px-6 py-4 text-right uppercase">
                <div class="flex justify-end">
                    <a class="hover:bg-slate-100 rounded-full"
                        href="{{ route('library-department-manager.edit', $data->deptid) }}">
                        <lord-icon src="https://cdn.lordicon.com/hbvgknxo.json" trigger="hover"
                            colors="primary:#ebe6ef,secondary:#4bb3fd,tertiary:#3a3347" style="width:24px;height:24px">
                        </lord-icon>
                    </a>
                    <form class="hover:bg-slate-100 rounded-full"
                        action="{{ route('library-department-manager.destroy', $data->deptid) }}" method="POST"
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