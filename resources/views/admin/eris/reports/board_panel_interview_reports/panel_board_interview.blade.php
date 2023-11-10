@extends('layouts.app')
@section('title', ' Board Interview')
@section('content')

    <h1 class="uppercase font-semibold text-blue-600 text-lg">Board And Panel Interview</h1>

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
                        Name
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Assigned Date
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
                {{-- panel board interview --}}
                @foreach ($panelBoardInterview as $panelBoardInterviews) 
                    <tr class="border-b bg-white">
                        @if ($interviewType == 'Panel Board Interview')
                            <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                                {{ $panelBoardInterviews->erisTblMainPanelBoardInterview->lastname ?? '' }},
                                {{ $panelBoardInterviews->erisTblMainPanelBoardInterview->firstname ?? '' }},
                                {{ $panelBoardInterviews->erisTblMainPanelBoardInterview->middlename ?? '' }}
                            </td>

                            <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                                {{ \Carbon\Carbon::parse($panelBoardInterviews->dteassign)->format('m/d/Y') ?? '' }} 
                            </td>

                            <td class="px-6 py-3">
                                {{ \Carbon\Carbon::parse($panelBoardInterviews->dtesubmit)->format('m/d/Y') ?? '' }} 
                            </td>

                            <td class="px-6 py-3">
                                {{ $panelBoardInterviews->intrviewer ?? '' }} 
                            </td>

                            <td class="px-6 py-3">
                                {{ \Carbon\Carbon::parse($panelBoardInterviews->dteiview)->format('m/d/Y') ?? '' }} 
                            </td>

                            <td class="px-6 py-3">
                                {{ $panelBoardInterviews->recom ?? '' }} 
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="m-5">
        {{ $panelBoardInterview->appends(['interview' => $interviewType])->links() }}
    </div>
@endsection