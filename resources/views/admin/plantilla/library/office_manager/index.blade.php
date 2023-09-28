@extends('layouts.app')
@section('title', 'Office Manager')
@section('content')

<div class="lg:flex lg:justify-between my-3">
    <a href="#" class="text-blue-500 uppercase text-2xl">
        @yield('title')
    </a>
    <div class="flex">
        <a href="{{ route('library-office-manager.trash') }}">
            <lord-icon src="https://cdn.lordicon.com/jmkrnisz.json" trigger="hover" colors="primary:#DC3545"
                style="width:34px;height:34px">
            </lord-icon>
        </a>

        <a class="btn btn-primary" href="{{ route('library-office-manager.create') }}">Add record</a>
    </div>
</div>


<table class="dataTables">
    <thead>
        <tr>
            <th>Agency Location</th>
            <th>Office</th>
            <th>Office Acronym</th>
            <th>Office Website</th>
            <th>Office Contact no.</th>
            <th>Office Email address</th>
            <th>Status</th>

            <th>
                <span class="sr-only">Action</span>
            </th>
        </tr>
    </thead>
    <tbody>

        @foreach ($datas as $data)
        <tr>
            <td class="font-semibold">
                {{ $data->agencyLocation->title }}
            </td>
            <td>
                {{ $data->title }}
            </td>
            <td>
                {{ $data->acronym }}
            </td>
            <td>
                <a href="{{ $data->website ?? 'N/A' }}" target="_blank" class="hover:text-blue-500">
                    {{ $data->website ?? 'N/A' }}
                </a>
            </td>
            <td>
                <a href="tel:{{ $data->officeAddress->contactno ?? 'N/A' }}" target="_blank"
                    class="hover:text-blue-500">
                    {{ $data->officeAddress->contactno ?? 'N/A' }}
                </a>
            </td>

            <td>
                <a href="Mailto:{{ $data->officeAddress->emailadd ?? 'N/A' }}" target="_blank"
                    class="hover:text-blue-500">
                    {{ $data->officeAddress->emailadd ?? 'N/A' }}
                </a>
            </td>

            <td>
                <span class="{{ $data->isActive == 1 ? 'success' : 'danger'}}">
                    {{ $data->isActive == 1 ? 'ACTIVE' : 'INACTIVE'}}
                </span>
            </td>


            <td class="px-6 py-4 text-right uppercase">
                <div class="flex justify-end">
                    <a class="hover:bg-slate-100 rounded-full"
                        href="{{ route('library-office-manager.edit', $data->officeid) }}">
                        <lord-icon src="https://cdn.lordicon.com/hbvgknxo.json" trigger="hover"
                            colors="primary:#ebe6ef,secondary:#4bb3fd,tertiary:#3a3347" style="width:24px;height:24px">
                        </lord-icon>
                    </a>
                    <form class="hover:bg-slate-100 rounded-full"
                        action="{{ route('library-office-manager.destroy', $data->officeid) }}" method="POST"
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