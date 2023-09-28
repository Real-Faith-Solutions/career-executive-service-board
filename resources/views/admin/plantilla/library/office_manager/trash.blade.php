@extends('layouts.app')
@section('title', 'Department Agency Manager - Trash')
@section('content')

<div class="my-5 flex justify-between gap-4">
    <a href="#" class="text-blue-500 uppercase text-2xl">
        @yield('title')
    </a>
    <a class="btn btn-primary" href="{{ route('library-office-manager.index') }}">Go back</a>
</div>

<div class="relative overflow-x-auto shadow-lg sm:rounded-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th class="px-6 py-3" scope="col">Agency Location</th>
                <th class="px-6 py-3" scope="col">Office</th>
                <th class="px-6 py-3" scope="col">Office Acronym</th>
                <th class="px-6 py-3" scope="col">Office Website</th>
                <th class="px-6 py-3" scope="col">Office Contact no.</th>
                <th class="px-6 py-3" scope="col">Office Email address</th>
                <th class="px-6 py-3" scope="col">Status</th>
                <th class="px-6 py-3" scope="col">Deleted at</th>
                <th class="px-6 py-3" scope="col">
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $data)
            <tr class="border-b bg-white">
                <td class="whitespace-nowrap px-6 py-4 font-medium text-gray-900" scope="row">
                    {{ $data->agencyLocation->title }}
                </td>
                <td class="px-6 py-3">
                    {{ $data->title }}
                </td>
                <td class="px-6 py-3">
                    {{ $data->acronym }}
                </td>
                <td class="px-6 py-3">
                    <a href="{{ $data->website ?? 'N/A' }}" target="_blank" class="hover:text-blue-500">
                        {{ $data->website ?? 'N/A' }}
                    </a>
                </td>
                <td class="px-6 py-3">
                    <a href="tel:{{ $data->officeAddress->contactno ?? 'N/A' }}" target="_blank"
                        class="hover:text-blue-500">
                        {{ $data->officeAddress->contactno ?? 'N/A' }}
                    </a>
                </td>
                <td class="px-6 py-3">
                    <a href="Mailto:{{ $data->officeAddress->emailadd ?? 'N/A' }}" target="_blank"
                        class="hover:text-blue-500">
                        {{ $data->officeAddress->emailadd ?? 'N/A' }}
                    </a>
                </td>
                <td class="px-6 py-3">
                    <span class="{{ $data->isActive == 1 ? 'success' : 'danger'}}">
                        {{ $data->isActive == 1 ? 'ACTIVE' : 'INACTIVE'}}
                    </span>
                </td>
                <td>
                    {{ \Carbon\Carbon::parse($data->deleted_at)->format('m/d/Y \a\t g:iA') }}
                </td>

                <td class="px-6 py-4 text-right uppercase">
                    <div class="flex justify-end">
                        <form class="hover:bg-slate-100 rounded-full"
                            action="{{ route('library-office-manager.restore', $data->officeid) }}" method="POST"
                            onsubmit="return window.confirm('Are you sure you want to restore this item?')">
                            @csrf
                            <button type="submit" class="mx-1 font-medium text-red-600 hover:underline" title="Restore">
                                <lord-icon src="https://cdn.lordicon.com/nxooksci.json" trigger="hover"
                                    colors="primary:#121331" style="width:24px;height:24px">
                                </lord-icon>
                            </button>
                        </form>
                        <form class="hover:bg-slate-100 rounded-full"
                            action="{{ route('library-office-manager.forceDelete', $data->officeid) }}" method="POST"
                            onsubmit="return window.confirm('Are you sure you want to delete this item permanently?')">

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
</div>

@endsection