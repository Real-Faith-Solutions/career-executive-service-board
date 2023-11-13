@extends('layouts.app')
@section('title', 'Assessment Center')
@section('content')

    <div class="flex justify-between">
        <h1 class="uppercase font-semibold text-blue-600 text-lg">Assessment Center</h1>

        <div class="flex items-center">
            <form action="{{ route('assessment-center-report.generateReportPdf') }}" target="_blank" method="GET">
                @csrf

                <input type="date" name="startDate" value="{{ $startDate }}" hidden>

                <input type="date" name="endDate" value="{{ $endDate }}" hidden>

                <input type="text" name="retake"  value="{{ $retake }}" hidden>

                <input type="text" name="failed"  value="{{ $failed }}" hidden>

                <input type="text" name="passed"  value="{{ $passed }}" hidden>

                <button class="btn btn-primary mx-1 font-medium text-blue-600" type="submit">
                    Generate PDF Report
                </button>
            </form>
        </div>
    </div>

    {{-- <div class="my-5 flex"> --}}
        <div class="my-5 flex items-center">
            <form action="{{ route('assessment-center-report.index') }}" method="GET">
                @csrf
                <div class="flex justify-between gap-80">
                    <div class="flex items-center gap-3">
                        <div class="flex">
                            <label for="passed" class="mt-1">Passed:</label>
                            <input type="checkbox" name="passed" {{ $passed == "passed" ? 'checked' : '' }} value="passed">
                        </div>
                        
                        <div class="flex">
                            <label for="failed" class="mt-1">Failed:</label>
                            <input type="checkbox" name="failed" {{ $failed == "failed" ? 'checked' : '' }} value="failed">
                        </div>

                        <div class="flex">
                            <label for="retake" class="mt-1">Retakers:</label>
                            <input type="checkbox" name="retake" {{ $retake == "true" ? 'checked' : '' }} value="true">
                        </div>
                    </div>        
    
                    <div class="flex gap-3">
                        <div class="flex">
                            <label for="startDate">Start Date</label>
                            <input type="date" name="startDate" value="{{ $startDate }}">
                        </div>
                        
                        <div class="flex">
                            <label for="endDate">End Date</label>
                            <input type="date" name="endDate" value="{{ $endDate }}">
                        </div>

                        <button class="btn btn-primary mx-1 font-medium text-blue-600" type="submit">
                            Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>
    {{-- </div> --}}

    <div class="table-management-data relative overflow-x-auto sm:rounded-lg shadow-lg">
        <table class="w-full text-left text-sm text-gray-500">
            <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>

                    <th scope="col" class="px-6 py-3">
                        <a href="{{ route('assessment-center-report.index', [
                            'sortBy' => 'acdate',
                            'sortOrder' => $sortOrder === 'desc' ? 'asc' : 'desc',
                            'startDate' => $startDate,
                            'endDate' => $endDate,
                            'passed' => $passed, 
                            'failed' => $failed,
                            'retake' => $retake, 
                        ]) }}" class="flex items-center space-x-1">
                            Assessment Center Date
                            @if ($sortBy === 'acdate')
                                @if ($sortOrder === 'desc')
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
                        No. of Takes
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Submittion of Docs  
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Competencies for D.O  
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Remarks
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($assessmentCenter as $data) 
                    <tr class="border-b bg-white">
                        <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                            {{ $data->erisTblMainAssessmentCenter->lastname ?? '' }},
                            {{ $data->erisTblMainAssessmentCenter->firstname ?? '' }},
                            {{ $data->erisTblMainAssessmentCenter->middlename ?? '' }}
                        </td>

                        <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                            @if ($data->acdate != null)
                                {{ \Carbon\Carbon::parse($data->acdate)->format('m/d/Y') ?? '' }} 
                            @else
                                {{ $data->acdate ?? '' }} 
                            @endif
                        </td>

                        <td class="px-6 py-3">
                            {{ $data->numtakes ?? '' }} 
                        </td>

                        <td class="px-6 py-3">
                            @if ($data->docdate != null)
                                {{ \Carbon\Carbon::parse($data->docdate)->format('m/d/Y') ?? '' }} 
                            @else
                                {{ $data->docdate ?? '' }} 
                            @endif
                        </td>

                        <td class="px-6 py-3">
                            {{ $data->competencies_d_o ?? '' }} 
                        </td>

                        <td class="px-6 py-3">
                            {{ $data->remarks ?? '' }} 
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="m-5">
        {{ 
            $assessmentCenter->appends([
                'startDate' => $startDate, 
                'endDate' => $endDate, 
                'passed' => $passed, 
                'failed' => $failed,
                'retake' => $retake,
                'sortBy' => $sortBy,
                'sortOrder' => $sortOrder,
            ])->links() 
        }}
    </div>
@endsection