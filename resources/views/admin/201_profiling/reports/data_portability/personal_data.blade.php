@extends('layouts.app')
@section('title', '201 profiling table')
@section('content')

<nav class="bg-gray-200 border-gray-200 mb-3">
    <div class="flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="#" class="flex items-center">
            <span class="self-center text-2xl font-semibold whitespace-nowrap uppercase text-blue-500">201 PROFILE - DATA PORTABILITY</span>
        </a>
    </div>
</nav>

    <section>   

        <div class="grid lg:grid-cols-3">
            @include('components.search')
        </div>
        
        <div class="relative my-5 overflow-x-auto sm:rounded-lg">
            <table class="w-full text-left text-sm text-gray-500">
                <thead class="bg-gray-50 text-xs uppercase text-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            <a href="{{ route('view-profile-201.index', ['sort_by' => 'cesno', 'sort_order' => $sortOrder === 'asc' ? 'desc' : 'asc', 'search' => $query]) }}" class="flex items-center space-x-1">
                                Ces No.
                                @if ($sortBy === 'cesno')
                                    @if ($sortOrder === 'asc')
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
                            <a href="{{ route('view-profile-201.index', ['sort_by' => 'lastname', 'sort_order' => $sortOrder === 'asc' ? 'desc' : 'asc', 'search' => $query]) }}" class="flex items-center space-x-1">
                                Name
                                @if ($sortBy === 'lastname')
                                    @if ($sortOrder === 'asc')
                                        <svg class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                                        </svg>
                                    @else
                                        <svg class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                                        </svg>
                                    @endif
                                @endif
                            </a>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Action</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                        @foreach ($personalData as $personalDatas)
                            <tr class="border-b bg-white hover:bg-slate-400 hover:text-white">
                                <th scope="col" class="px-6 py-3">
                                    {{ $personalDatas->cesno }}
                                </th>
                                <td scope="col" class="px-6 py-3">
                                    {{ $personalDatas->lastname }}, {{ $personalDatas->firstname }} {{ $personalDatas->middlename }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('data-portability.generateReport', ['cesno'=>$personalDatas->cesno]) }}" target="_blank" class="font-medium">Generate PDF</a>
                                </td>    
                            </tr>
                        @endforeach
                </tbody>
            </table>
            <div class="my-5">
                {{ $personalData->links() }}
            </div>
        </div>

    </section>

@endsection
