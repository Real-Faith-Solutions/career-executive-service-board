@extends('layouts.app')
@section('title', ' Board Interview')
@section('content')

    <h1 class="uppercase font-semibold text-blue-600 text-lg">Board Interview</h1>

    <div class="my-5 flex justify-between">
        <div class="flex items-center">
            <form action="{{ route('eris-board-panel-interview-report.displayInterview') }}" method="GET">
                <div class="flex gap-2">
                    <select name="interview" id="expertise">
                        <option value="">Board Interview</option>
                        <option value="Panel Board Interview" {{ $interviewType == 'Panel Board Interview' ? 'selected' : '' }}>Panel Board Interview</option>
                    </select>   

                    <button class="btn btn-primary mx-1 font-medium text-blue-600" type="submit">
                        Search
                    </button>
                </div>
            </form>
        </div>

        <div class="flex items-center">
            <form action="{{ route('eris-interview-report.generateReportPdf') }}" target="_blank" method="POST">
                @csrf

                <input type="text" name="interview-type" value="{{ $interviewType }}" hidden>

                <button class="btn btn-primary mx-1 font-medium text-blue-600" type="submit">
                    Generate PDF Report
                </button>
            </form>
        </div>
    </div>

    <div class="table-management-boardInterviews relative overflow-x-auto sm:rounded-lg shadow-lg">
        <table class="w-full text-left text-sm text-gray-500">
            <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        {{-- <a href="{{ route('eris-board-interview-report.index', ['sort_by' => 'lastname', 'sort_order' => $sortOrder === 'asc' ? 'desc' : 'asc']) }}" class="flex items-center space-x-1"> --}}
                            Name
                            {{-- @if ($sortBy === 'lastname')
                                @if ($sortOrder === 'asc')
                                    <svg class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                                    </svg>
                                @else
                                    <svg class="w-4 h-4 text-gray-500 transform rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                                    </svg>
                                @endif
                            @endif
                        </a> --}}
                    </th>

                    <th scope="col" class="px-6 py-3">
                        <a href="{{ route('eris-board-interview-report.index', ['sort_by' => 'dteassign', 'sort_order' => $sortOrder === 'asc' ? 'desc' : 'asc']) }}" class="flex items-center space-x-1">
                            Assigned Date
                            @if ($sortBy === 'dteassign')
                                @if ($sortOrder === 'asc')
                                    <svg class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                                    </svg>
                                @else
                                    <svg class="w-4 h-4 text-gray-500 transform rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                                    </svg>
                                @endif
                            @endif
                        </a>
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Submittion of Document
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Interviewer
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Interview Date
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Recommendation
                    </th>
                </tr>
            </thead>
            <tbody>
                    @foreach ($boardInterview as $boardInterviews) 
                        <tr class="border-b bg-white">
                            <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                                {{ $boardInterviews->erisTblMainBoardInterview->lastname ?? '' }},
                                {{ $boardInterviews->erisTblMainBoardInterview->firstname ?? '' }},
                                {{ $boardInterviews->erisTblMainBoardInterview->middlename ?? '' }}
                            </td>

                            <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                                {{ \Carbon\Carbon::parse($boardInterviews->dteassign)->format('m/d/Y') ?? 'No Record' }} 
                            </td>

                            <td class="px-6 py-3">
                                {{ \Carbon\Carbon::parse($boardInterviews->dtesubmit)->format('m/d/Y') ?? 'No Record' }} 
                            </td>

                            <td class="px-6 py-3">
                                {{ $boardInterviews->intrviewer ?? 'No Record' }} 
                            </td>

                            <td class="px-6 py-3">
                                {{ \Carbon\Carbon::parse($boardInterviews->dteiview)->format('m/d/Y') ?? 'No Record' }} 
                            </td>

                            <td class="px-6 py-3">
                                {{ $boardInterviews->recom ?? 'No Record' }} 
                            </td>
                        </tr>
                    @endforeach
            </tbody>
        </table>
    </div>

    <div class="m-5">
        {{ $boardInterview->appends([
            'interview' => $interviewType,
            'sortBy' => $sortBy,
            'sortOrder' => $sortOrder,
        ])->links() }}
    </div>
@endsection