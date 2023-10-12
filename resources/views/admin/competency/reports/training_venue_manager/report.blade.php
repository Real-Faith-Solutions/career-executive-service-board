@extends('layouts.app')
@section('title', 'Training Venue Manager')
@section('sub', 'Training Venue Manager')
@section('content')

    <h1 class="uppercase font-semibold text-blue-600 text-2xl">Training Venue Manager Report</h1>

    <div class="my-5 flex justify-between">
        {{-- search bar --}}
        <div class="flex items-center">
            <form action="" method="GET">
                <div class="flex gap-4">
                    <input type="text" name="search" id="search" list="searchResults" placeholder="Search..." value="{{ $search }}">
                    <datalist id="searchResults">
                        @foreach($searchProfileLibCities as $searchProfileLibCity)
                            <option value="{{ $searchProfileLibCity->name }}">{{ $searchProfileLibCity->name }}<option>
                        @endforeach
                    </datalist>
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </form>
        </div>

        <div class="flex items-center">
            <form action="{{ route('competency-management-sub-modules-report.trainingVenueManagerReportGeneratePdf') }}" target="_blank" method="POST">
                @csrf
                <input type="hidden" name="search" value="{{ $search }}">
                <button class="btn btn-primary mx-1 font-medium text-blue-600" type="submit">
                    Generate PDF Report
                </button>
            </form>
        </div>
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
                            {{ $trainingVenueManagers->name ?? '' }}
                        </td>

                        <td class="px-6 py-3">
                            {{ 
                                $trainingVenueManagers->no_street ?? ''.', '.
                                $trainingVenueManagers->brgy ?? ''.', '. 
                                $trainingVenueManagers->trainingVenueManager->name ?? ''
                            }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $trainingVenueManagers->contactno ?? '' }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $trainingVenueManagers->emailadd ?? '' }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $trainingVenueManagers->contactperson ?? '' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="my-5">
        {{ $trainingVenueManager->links() }}
    </div>

@endsection