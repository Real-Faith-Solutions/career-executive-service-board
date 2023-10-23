@extends('layouts.app')
@section('title', 'Rank Tracker')
@section('sub', 'Rank Tracker')
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
                            <option value="Board Interview">Board Interview</option>
                            <option value="Rank Tracker" {{ $selectedPage == 'Rank Tracker' ? 'selected' : '' }}>Rank Tracker</option>
                        </select>    
                    </div>
        
                    <div>   
                        <button class="h-11 btn btn-primary" type="submit">Go</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="table-management-rankTrackers relative overflow-x-auto sm:rounded-lg shadow-lg">
        <table class="w-full text-left text-sm text-gray-500">
            <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Control No.
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Submit Date
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Description
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Remarks
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rankTracker as $rankTrackers) 
                    <tr class="border-b bg-white">
                        <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                            {{ $rankTrackers->ctrlno ?? 'No Record' }} 
                        </td>

                        <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                            {{ \Carbon\Carbon::parse($rankTrackers->submit_dt)->format('m/d/Y ') ?? 'No Record' }} 
                        </td>

                        <td class="px-6 py-3">
                            {{ $rankTrackers->description ?? 'No Record' }} 
                        </td>

                        <td class="px-6 py-3">
                            {{ $rankTrackers->remarks ?? 'No Record' }} 
                        </td>
                    </tr>
                @endforeach 
            </tbody>
        </table>
    </div>

    <div class="m-5">
        {{ $rankTracker->links() }}
    </div>

@endsection