@extends('layouts.app')
@section('title', 'Board Interview')
@section('sub', 'Board Interview')
@section('content')
@include('admin.201_profiling.view_profile.header', ['cesno' => $cesno])

<div class="my-5 flex justify-between">
    <div class="flex">
        <form action="{{ route('eligibility-rank-tracker.navigate', ['cesno'=>$cesno]) }}" method="GET">
            <div class="grid grid-cols-2 justify-center item-center gap-3 w-full">
                <div>
                    <select class="w-66" name="page" id="">
                        <option>Eligibility and Rank Tracker</option>
                        <option value="Written Exam">Written Exam (Historical Record)</option>
                        <option value="Assessment Center">Assessment Center (Historical Record)</option>
                        <option value="Validation">Validation (Historical Record)</option>
                        <option value="Board Interview" {{ $selectedPage == 'Board Interview' ? 'selected' : '' }}>Board Interview</option>
                        <option value="Rank Tracker">Rank Tracker</option>
                    </select>    
                </div>
    
                <div>   
                    <button class="h-11 btn btn-primary" type="submit">Go</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="table-eligibility-and-rank-tracker">    
    <div class="relative overflow-x-auto sm:rounded-lg shadow-lg mb-3">
        <table class="w-full text-left text-sm text-gray-500">
            <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Board Interview Date
                    </th>

                    <th>
                        Interview Type
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Rating
                    </th>
                </tr>
            </thead>
            <tbody>
                {{-- panel board interview table row --}}
                    @foreach ($panelBoardInterview as $panelBoardInterviews)
                        <tr class="border-b bg-white">
                            <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                                {{ \Carbon\Carbon::parse($panelBoardInterviews->dteiview)->format('m/d/Y ') ?? 'No Record' }}
                            </td>

                            <td>
                                Panel Board Interview
                            </td>
                                
                            <td class="px-6 py-3">
                                {{ $panelBoardInterviews->recom }}
                            </td>
                    @endforeach               
                {{-- end of panel board interview table row --}}

                {{-- in depth validation table row --}}
                    @foreach ($boardInterview as $boardInterviews)
                    <tr class="border-b bg-white">
                        <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                            {{ \Carbon\Carbon::parse($boardInterviews->dteiview)->format('m/d/Y ') ?? 'No Record' }}
                        </td>

                        <td>
                            Board Interview
                        </td>
                    
                        <td class="px-6 py-3">
                            {{ $boardInterviews->recom }}
                        </td>
                    @endforeach               
                {{-- end of in depth validation table row --}}
            </tbody>
        </table>
    </div>
</div>

@endsection
