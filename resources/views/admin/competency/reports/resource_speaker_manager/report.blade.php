@extends('layouts.app')
@section('title', 'Resource Speaker')
@section('sub', 'Resource Speaker')
@section('content')

    <h1 class="uppercase font-semibold text-blue-600 text-lg">Resource Speaker Manager Report</h1>

    <div class="my-5 flex justify-between">
        <div class="flex items-center">
            <form action="{{ route('competency-management-sub-modules-report.resourceSpeakerIndexReport') }}" method="GET">
                @csrf
                <div class="flex gap-2">
                    <select name="expertise" id="expertise">
                        <option value="all">All</option>
                        @foreach ($expertise as $resourceSpeakers)
                            @if ($resourceSpeakers->expertise == $search)
                                <option value="{{ $resourceSpeakers->expertise }}" selected>{{ $resourceSpeakers->expertise }}</option>
                            @else
                                <option value="{{ $resourceSpeakers->expertise }}">{{ $resourceSpeakers->expertise }}</option>
                            @endif
                        @endforeach
                    </select>   

                    <button class="btn btn-primary mx-1 font-medium text-blue-600" type="submit">
                        Search
                    </button>
                </div>
            </form>
        </div>

        <div class="flex items-center">
            <form action="{{ route('competency-management-sub-modules-report.resourceSpeakerGenerateReport') }}" target="_blank" method="POST">
                @csrf
                <input type="text" name="expertise" value="{{ $search }}" hidden>
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
                        Name
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Position
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Department
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Office/Company
                    </th>

                    <th scope="col" class="px-6 py-3">
                        No./Building
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Street
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Barangay
                    </th>

                    <th scope="col" class="px-6 py-3">
                        City/Province
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Contact No.
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Email Address
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Expertise
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($resourceSpeaker as $resourceSpeakers)
                    <tr class="border-b bg-white">
                        <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                            {{ $resourceSpeakers->lastname. " " .$resourceSpeakers->firstname. " " .$resourceSpeakers->mi  }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $resourceSpeakers->Position }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $resourceSpeakers->Department }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $resourceSpeakers->Office }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $resourceSpeakers->Bldg }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $resourceSpeakers->Street }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $resourceSpeakers->Brgy }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $resourceSpeakers->City }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $resourceSpeakers->contactno }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $resourceSpeakers->emailadd }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $resourceSpeakers->expertise }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="m-5">
        {{ $resourceSpeaker->links() }}
    </div>

@endsection