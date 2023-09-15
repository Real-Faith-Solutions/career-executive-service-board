@extends('layouts.app')
@section('title', 'Training Venue Manager')
@section('sub', 'Training Venue Manager')
@section('content')

<h1 class="uppercase font-semibold text-blue-600 text-lg">Training Venue Manager Report</h1>

<div class="my-5 flex justify-between">
    {{-- search bar --}}
        <div class="flex items-center">
            <form>
                <div class="w-100">
                    <label for="default-search" class="sr-only mb-2 text-sm font-medium text-gray-900">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <button type="submit">
                                    <svg aria-hidden="true" class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </button>
                        </div>

                        <input type="search" id="default-search" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-4 pl-10 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500" placeholder="Search here..." name="search" @if (!empty($search)) value="{{ $search }}" @endif autofocus autocomplete="search">
                    </div>
                </div>
            </form>
        </div>
    {{-- end of search bar --}}

    <form action="{{ route('competency-management-sub-modules-report.trainingVenueManagerReportGeneratePdf') }}" target="_blank" method="POST">
        @csrf
        <button class="btn btn-primary mx-1 font-medium text-blue-600" type="submit">
            Generate PDF Report
        </button>
    </form>
</div>

<div class="table-management-training relative overflow-x-auto sm:rounded-lg shadow-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Venue
                </th>

                <th scope="col" class="px-6 py-3">
                    Address
                </th>

                <th scope="col" class="px-6 py-3">
                    Contact No.
                </th>

                <th scope="col" class="px-6 py-3">
                    Email
                </th>

                <th scope="col" class="px-6 py-3">
                    Contact Person
                </th>

                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($trainingVenueManager as $trainingVenueManagers)
                <tr class="border-b bg-white">
                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        {{ $trainingVenueManagers->name }}
                    </td>

                    <td class="px-6 py-3">
                        {{ 
                            $trainingVenueManagers->no_street.', '.
                            $trainingVenueManagers->brgy.', '. 
                            $trainingVenueManagers->trainingVenueManager->name
                        }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingVenueManagers->contactno }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingVenueManagers->emailadd }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingVenueManagers->contactperson }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection