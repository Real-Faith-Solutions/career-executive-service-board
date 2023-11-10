@extends('layouts.app')
@section('title', 'Rapid Validation')
@section('content')

    <div class="flex justify-between">
        <h1 class="uppercase font-semibold text-blue-600 text-lg">Rapid Validation</h1>
   
        <div class="flex items-center">
            <form action="{{ route('rapid-validation-report.generatePdfReport', [
                'sort_by' => $sort_by, 
                'sort_order' => $sort_order
            ]) }}" target="_blank" method="POST">
                @csrf

                <input type="date" name="startDate" value="{{ $startDate }}" hidden>

                <input type="date" name="endDate" value="{{ $endDate }}" hidden>

                <button class="btn btn-primary mx-1 font-medium text-blue-600" type="submit">
                    Generate PDF Report
                </button>
            </form>
        </div>
    </div>

    <div class="my-5 flex justify-between">
        <div class="flex items-center gap-1">
            <input type="text" name="startDate" value="In Depth Validation"> 
            <a href="{{ route('in-depth-validation-report.index') }}" class="btn btn-primary mx-1 font-medium text-blue-600">Go</a>
        </div>        

        <div class="flex items-center">
            <form action="{{ route('rapid-validation-report.index') }}" method="GET">
                @csrf
                <div class="flex gap-3">
                    <label for="startDate">Start Date</label>
                    <input type="date" name="startDate" value="{{ $startDate }}">

                    <label for="endDate">End Date</label>
                    <input type="date" name="endDate" value="{{ $endDate }}">
                    
                    <button class="btn btn-primary mx-1 font-medium text-blue-600" type="submit">
                        Filter
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="table-management-data relative overflow-x-auto sm:rounded-lg shadow-lg">
        <table class="w-full text-left text-sm text-gray-500">
            <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                
                    <th scope="col" class="px-6 py-3">
                        <a href="{{ route('rapid-validation-report.index', [
                            'sort_by' => 'dteassign',
                            'sort_order' => $sort_order === 'desc' ? 'asc' : 'desc',
                            'startDate' => $startDate,
                            'endDate' => $endDate,
                        ]) }}" class="flex items-center space-x-1">
                            Rapid Validation Date
                            @if ($sort_by === 'dteassign')
                                @if ($sort_order === 'desc')
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
                        Submition of Document
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Validator
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Recommendation
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Remarks
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rapidValidation as $data) 
                    <tr class="border-b bg-white">
                        <td class="px-6 py-3">
                            {{ $data->erisTblMainRapidValidation->lastname ?? '' }},
                            {{ $data->erisTblMainRapidValidation->firstname ?? '' }},
                            {{ $data->erisTblMainRapidValidation->middlename ?? '' }} 
                        </td>

                        <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                            @if ($data->dteassign != null)
                                {{ \Carbon\Carbon::parse($data->dteassign)->format('m/d/Y') ?? '' }} 
                            @else
                                {{ $data->dteassign ?? '' }} 
                            @endif
                        </td>

                        <td class="px-6 py-3">
                            @if ($data->dtesubmit != null)
                                {{ \Carbon\Carbon::parse($data->dtesubmit)->format('m/d/Y') ?? '' }} 
                            @else
                                {{ $data->dtesubmit ?? '' }} 
                            @endif
                        </td>

                        <td class="px-6 py-3">
                            {{ $data->validator ?? '' }} 
                        </td>

                        <td class="px-6 py-3">
                            {{ $data->recom ?? '' }} 
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
        {{ $rapidValidation->appends([
            'sort_by' => $sort_by,
            'sort_order' => $sort_order,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ])->links() }}
    </div>
    
@endsection