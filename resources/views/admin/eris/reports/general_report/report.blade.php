@extends('layouts.app')
@section('title', 'ERIS-General Report')
@section('content')

    <div class="flex justify-between">
        <h1 class="uppercase font-semibold text-blue-600 text-lg">General Report</h1>

        <div class="flex items-center">
            <form action="{{ route('general-report.generateDownloadLinks', ['sortBy' => $sortBy, 'sortOrder' => $sortOrder]) }}" target="_blank" method="GETT">
                @csrf

                <button class="btn btn-primary mx-1 font-medium text-blue-600" type="submit">
                    Generate PDF Report
                </button>
            </form>
        </div>
    </div>

    <div class="table-management-data relative overflow-x-auto sm:rounded-lg shadow-lg my-5">
        <table class="w-full text-left text-sm text-gray-500">
            <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        <a href="{{ route('general-report.index', [
                            'sortBy' => 'acno',
                            'sortOrder' => $sortOrder === 'asc' ? 'desc' : 'asc',
                        ]) }}" class="flex items-center space-x-1">
                            Account No
                            @if ($sortBy === 'acno')
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
                        <a href="{{ route('general-report.index', [
                            'sortBy' => 'lastname',
                            'sortOrder' => $sortOrder === 'asc' ? 'desc' : 'asc',
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
                        Conferment Status
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($eradTblMain as $data) 
                    <tr class="border-b bg-white">
                        <td class="px-6 py-3">
                            {{ $data->acno ?? '' }} 
                        </td>

                        <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                            {{ $data->lastname ?? '' }},
                            {{ $data->firstname ?? '' }},
                            {{ $data->middlename ?? '' }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $data->c_status ?? '' }} 
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="m-5">
        {{ 
            $eradTblMain->appends([
                'sortBy' => $sortBy,
                'sortOrder' => $sortOrder,
            ])->links() 
        }}
    </div>
@endsection