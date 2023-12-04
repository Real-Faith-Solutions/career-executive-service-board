@extends('layouts.app')
@section('title', 'In Depth Validation')
@section('content')

    <div class="flex justify-between">
        <h1 class="uppercase font-semibold text-blue-600 text-lg">In Depth Validation</h1>

        <div class="flex items-center">
            <form action="{{ route('in-depth-validation-report.generateDownloadLinks', ['sortBy' => $sortBy,'sortOrder' => $sortOrder, 'startDate' => $startDate, 'endDate' => $endDate]) }}" target="_blank" method="GET">
                @csrf

                {{-- <input type="date" name="startDate" value="{{ $startDate }}" hidden>

                <input type="date" name="endDate" value="{{ $endDate }}" hidden> --}}

                <button class="btn btn-primary mx-1 font-medium text-blue-600" type="submit">
                    Generate PDF Report
                </button>
            </form>
        </div>
    </div>

    <div class="my-5 flex justify-between">
        <div class="flex items-center">
            <input type="text" name="startDate" value="Rapid Validation"> 
            <a href="{{ route('rapid-validation-report.index') }}" class="btn btn-primary mx-1 font-medium text-blue-600">Go</a>
        </div>        

        <div class="flex items-center">
            <form action="{{ route('in-depth-validation-report.index') }}" method="GET">
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
                        <a href="{{ route('in-depth-validation-report.index', [
                            'sortBy' => 'lastname',
                            'sortOrder' => $sortOrder === 'asc' ? 'desc' : 'asc',
                            'startDate' => $startDate,
                            'endDate' => $endDate,
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
                        <a href="{{ route('in-depth-validation-report.index', [
                            'sortBy' => 'dteassign',
                            'sortOrder' => $sortOrder === 'desc' ? 'asc' : 'desc',
                            'startDate' => $startDate,
                            'endDate' => $endDate,
                        ]) }}" class="flex items-center space-x-1">
                            Validation Date
                            @if ($sortBy === 'dteassign')
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
                        Submittion of Document
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

                    <th scope="col" class="px-6 py-3">
                        Deffered Date
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inDepthValidation as $data) 
                    <tr class="border-b bg-white">
                        <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                            <p>{{ $data->erisTblMainInDepthValidation->lastname ?? '' }},</p>
                            <p>{{ $data->erisTblMainInDepthValidation->firstname ?? '' }},</p>
                            <p>{{ $data->erisTblMainInDepthValidation->middlename ?? '' }}</p>
                        </td>

                        <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                            @if ($data->dteassign != null)
                                {{ \Carbon\Carbon::parse($data->dteassign)->format('m/d/Y') ?? '' }}                             
                            @else
                                {{ $data->dteassign ?? '' }} 
                            @endif
                        </td>

                        <td class="px-6 py-3">
                            {{ \Carbon\Carbon::parse($data->dtesubmit)->format('m/d/Y') ?? '' }} 
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

                        <td class="px-6 py-3">
                            {{ \Carbon\Carbon::parse($data->dtedefer)->format('m/d/Y') ?? '' }} 
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="m-5">
        {{ $inDepthValidation->appends([
            'startDate' => $startDate,
            'endDate' => $endDate,
            'sortBy' => $sortBy,
            'sortOrder' => $sortOrder
        ])->links() }}
    </div>
@endsection