@extends('layouts.app')
@section('title', 'Assessment Center (Historical Record)')
@section('sub', 'Assessment Center (Historical Record)')
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
                        <option value="Assessment Center" {{ $selectedPage == 'Assessment Center' ? 'selected' : '' }}>Assessment Center (Historical Record)</option>
                        <option value="Validation">Validation (Historical Record)</option>
                        <option value="Board Interview">Board Interview</option>
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
                        AC No
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Assessment Date
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Rating
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Competencies for D.O
                    </th>

                    <th scope="col" class="px-6 py-3">
                        No. of Takes
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($assessmentCenter as $assessmentCenters)
                    <tr class="border-b bg-white">
                        <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                            {{$assessmentCenters->acno}}
                        </td>
                        
                        <td class="px-6 py-3">
                            {{$assessmentCenters->acdate}}
                        </td>

                        <td class="px-6 py-3">
                            {{$assessmentCenters->remarks}}
                        </td>

                        <td class="px-6 py-3">
                            {{$assessmentCenters->docdate}}
                        </td>

                        <td class="px-6 py-3">
                            {{$assessmentCenters->numtakes}}
                        </td>
                @endforeach               
            </tbody>
        </table>
    </div>
</div>

@endsection
