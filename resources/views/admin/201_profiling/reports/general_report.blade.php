@extends('layouts.app')
@section('title', '201 profiling table')
@section('content')

    <section>

        <div class="flex">
            <div class="">
                @include('components.search')
            </div>
    
            <div class="flex items-center px-6 py-3 text-left">
                <input id="two_factor" type="checkbox" name="two_factor" {{ Auth::user()->two_factor ? 'checked' : '' }} value="two_factor" class="w-4 h-4 text-blue-600 accent-green-600">
                <label for="two_factor" class="ml-2 mt-2 text-sm font-medium text-gray-700">Active</label>
            </div>
    
            <div class="flex items-center px-6 py-3 text-left">
                <input id="two_factor" type="checkbox" name="two_factor" {{ Auth::user()->two_factor ? 'checked' : '' }} value="two_factor" class="w-4 h-4 text-blue-600 accent-green-600">
                <label for="two_factor" class="ml-2 mt-2 text-sm font-medium text-gray-700">Inactive</label>
            </div>

            <div class="flex items-center px-6 py-3 text-left">
                <input id="two_factor" type="checkbox" name="two_factor" {{ Auth::user()->two_factor ? 'checked' : '' }} value="two_factor" class="w-4 h-4 text-blue-600 accent-green-600">
                <label for="two_factor" class="ml-2 mt-2 text-sm font-medium text-gray-700">Retired</label>
            </div>

            <div class="flex items-center px-6 py-3 text-left">
                <input id="two_factor" type="checkbox" name="two_factor" {{ Auth::user()->two_factor ? 'checked' : '' }} value="two_factor" class="w-4 h-4 text-blue-600 accent-green-600">
                <label for="two_factor" class="ml-2 mt-2 text-sm font-medium text-gray-700">Deceased</label>
            </div>
        </div>

        <div class="relative my-5 overflow-x-auto sm:rounded-lg">
            <table class="w-full text-left text-sm text-gray-500">
                <thead class="bg-gray-50 text-xs uppercase text-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            <a href="{{ route('general-reports.index', ['sort_by' => 'cesno', 'sort_order' => $sortOrder === 'asc' ? 'desc' : 'asc', 'search' => $query]) }}" class="flex items-center space-x-1">
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
                            <a href="{{ route('general-reports.index', ['sort_by' => 'lastname', 'sort_order' => $sortOrder === 'asc' ? 'desc' : 'asc', 'search' => $query]) }}" class="flex items-center space-x-1">
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
                            <span class="">CES Status</span>
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
                                <td scope="col" class="px-6 py-3">
                                    {{ $personalDatas->cesstatus->description ?? '' }}
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
