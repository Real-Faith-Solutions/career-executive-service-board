@extends('layouts.app')
@section('title', ' Board Interview')
@section('content')

    <h1 class="uppercase font-semibold text-blue-600 text-lg">Board Interview</h1>

    <div class="my-5 flex justify-between">
        <div class="flex items-center">
            <input type="text" name="panelBoardInterview" value="Panel Board Interview"> 
            <a href="{{ route('panel-board-interview-report.index') }}" class="btn btn-primary mx-1 font-medium text-blue-600">Go</a>
        </div>

        <div class="flex items-center">
            <form action="{{ route('eris-board-interview-report.generateDownloadLinks', ['sortBy' => $sortBy, 'sortOrder' => $sortOrder]) }}" target="_blank" method="GET">
                @csrf

                {{-- <input type="text" name="sort_by" value="{{ $sortBy }}" hidden>

                <input type="text" name="sort_order" value="{{ $sortOrder }}" hidden> --}}

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
                        <a href="{{ route('eris-board-interview-report.index', [
                            'sort_by' => 'lastname', 
                            'sort_order' => $sortOrder === 'asc' ? 'desc' : 'asc'
                            ]) }}" class="flex items-center space-x-1">
                            Name
                            @if ($sortBy === 'lastname')
                                @if ($sortOrder === 'asc')
                                    <svg class="w-4 h-4 text-white-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                                    </svg>
                                @else
                                    <svg class="w-4 h-4 text-white-500 transform rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                                    </svg>
                                @endif
                            @endif
                        </a>
                    </th>

                    <th scope="col" class="px-6 py-3">
                        <a href="{{ route('eris-board-interview-report.index', [
                            'sort_by' => 'dteassign',
                            'sort_order' => $sortOrder === 'asc' ? 'desc' : 'asc'
                            ]) }}" class="flex items-center space-x-1">
                            Assigned Date
                            @if ($sortBy === 'dteassign')
                                @if ($sortOrder === 'asc')
                                    <svg class="w-4 h-4 text-white-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                                    </svg>
                                @else
                                    <svg class="w-4 h-4 text-white-500 transform rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                                    </svg>
                                @endif
                            @endif
                        </a>
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Submition of Document
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
                                @if ($boardInterviews->dteassign != null )
                                    {{ \Carbon\Carbon::parse($boardInterviews->dteassign)->format('m/d/Y') ?? '' }} 
                                @else
                                    {{ $boardInterviews->dteassign ?? '' }} 
                                @endif
                            </td>

                            <td class="px-6 py-3">
                                @if ($boardInterviews->dtesubmit != null)
                                    {{ \Carbon\Carbon::parse($boardInterviews->dtesubmit)->format('m/d/Y') ?? '' }} 
                                @else
                                    {{ $boardInterviews->dtesubmit ?? '' }} 
                                @endif
                            </td>

                            <td class="px-6 py-3">
                                {{ $boardInterviews->intrviewer ?? '' }} 
                            </td>

                            <td class="px-6 py-3">
                                @if ($boardInterviews->dteiview != null)
                                    {{ \Carbon\Carbon::parse($boardInterviews->dteiview)->format('m/d/Y') ?? '' }} 
                                @else
                                    {{ $boardInterviews->dteiview ?? '' }} 
                                @endif
                            </td>

                            <td class="px-6 py-3">
                                {{ $boardInterviews->recom ?? '' }} 
                            </td>
                        </tr>
                    @endforeach
            </tbody>
        </table>
    </div>

    <div class="m-5">
        {{ $boardInterview->appends([
            'sort_by' => $sortBy,
            'sort_order' => $sortOrder,
        ])->links() }}
    </div>
@endsection