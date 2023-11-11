@extends('layouts.app')
@section('title', 'Written Exam')
@section('content')

    <div class="flex justify-between">
        <h1 class="uppercase font-semibold text-blue-600 text-lg">Written Exam</h1>

        <div class="flex items-center">
            <form action="{{ route('written-exam-report.generateReportPdf') }}" target="_blank" method="GET">
                @csrf

                <input type="date" name="startDate" value="{{ $startDate }}" hidden>

                <input type="date" name="endDate" value="{{ $endDate }}" hidden>

                <input type="text" name="failed"  value="{{ $failed }}" hidden>

                <input type="text" name="passed"  value="{{ $passed }}" hidden>

                <input type="text" name="retake"  value="{{ $retake }}" hidden>

                <input type="text" name="location"  value="{{ $writtenExamLocation }}" hidden>

                <button class="btn btn-primary mx-1 font-medium text-blue-600" type="submit">
                    Generate PDF Report
                </button>
            </form>
        </div>
    </div>

    <div class="my-5 flex items-center">
        <form action="" method="GET">
                @csrf
            <div class="flex justify-between gap-40">
                <div class="flex items-center gap-1">
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

                    <div class="w-48">
                        <select name="location">
                            <option value="">All</option>
                            @foreach ($location as $data)
                                @if ($data->we_location === $writtenExamLocation)
                                    <option value="{{ $data->we_location }}" selected>{{ $data->we_location }}</option>
                                @else
                                    <option value="{{ $data->we_location }}">{{ $data->we_location }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>        
                
                <div class="flex gap-2">
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

    <div class="table-management-data relative overflow-x-auto sm:rounded-lg shadow-lg">
        <table class="w-full text-left text-sm text-gray-500">
            <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Written Exam Date
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Number of Takes
                    </th>
    
                    <th scope="col" class="px-6 py-3">
                        Location
                    </th>
    
                    <th scope="col" class="px-6 py-3">
                        Rating
                    </th>
    
                    <th scope="col" class="px-6 py-3">
                        Remarks
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($writtenExam as $data) 
                    <tr class="border-b bg-white">
                        <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                            {{ $data->erisTblMainWrittenExam->lastname ?? '' }},
                            {{ $data->erisTblMainWrittenExam->firstname ?? '' }},
                            {{ $data->erisTblMainWrittenExam->middlename ?? '' }}.
                        </td>

                        <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                            {{ \Carbon\Carbon::parse($data->we_date)->format('m/d/Y') ?? '' }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $data->numtakes ?? '' }}
                        </td>
    
                        <td class="px-6 py-3">
                            {{ $data->we_location ?? '' }}
                        </td>
    
                        <td class="px-6 py-3">
                            {{ $data->we_rating ?? '' }}
                        </td>
    
                        <td class="px-6 py-3">
                            {{ $data->we_remarks ?? '' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="m-5">
        {{ 
            $writtenExam->appends([
                'startDate' => $startDate, 
                'endDate' => $endDate, 
                'passed' => $passed, 
                'failed' => $failed,
                'retake' => $retake,
                'location' => $writtenExamLocation,
            ])->links() 
        }}
    </div>
@endsection