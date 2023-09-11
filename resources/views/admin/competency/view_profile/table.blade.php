@extends('layouts.app')
@section('title', 'Competency 201 profiling table')
@section('sub', 'Competency 201 profiling table')
@section('content')
@include('admin.competency.view_profile.header')

    <section>
        <div class="grid grid-cols-3 mt-10">
            @include('components.search')
        </div>
        
        <div class="relative my-5 overflow-x-auto sm:rounded-lg">
            <table class="w-full text-left text-sm text-gray-500">
                <thead class="bg-gray-50 text-xs uppercase text-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            <a href="{{ route('competency-data.index', ['sort_by' => 'cesno', 'sort_order' => $sortOrder === 'asc' ? 'desc' : 'asc', 'search' => $query]) }}" class="flex items-center space-x-1">
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
                            <a href="{{ route('competency-data.index', ['sort_by' => 'lastname', 'sort_order' => $sortOrder === 'asc' ? 'desc' : 'asc', 'search' => $query]) }}" class="flex items-center space-x-1">
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
                    @foreach ($competencyData as $competencyDatas)
                        <tr class="border-b bg-white hover:bg-slate-400 hover:text-white">

                            <th scope="col" class="px-6 py-3">
                                {{ $competencyDatas->cesno }}        
                            </th>

                            <td scope="col" class="px-6 py-3">
                                {{ $competencyDatas->lastname }}, {{ $competencyDatas->firstname }} {{ $competencyDatas->middlename }}. {{ $competencyDatas->name_extension }} 
                            </td>

                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('competency-view-profile.updateOrCreate', ['cesno'=>$competencyDatas->cesno]) }}" class="font-medium"  title="View Profile">
                                    <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
                                    <lord-icon
                                        src="https://cdn.lordicon.com/bhfjfgqz.json"
                                        trigger="hover"
                                        colors="primary:#000000"
                                        style="width:34px;height:34px">
                                    </lord-icon>
                                </a>
                                
                                <a href="{{ route('non-ces-training-management.index', ['cesno'=>$competencyDatas->cesno]) }}" class="font-medium" title="Non-Ces Trainings">
                                    <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
                                    <lord-icon
                                        src="https://cdn.lordicon.com/usxfmtjg.json"
                                        trigger="hover"
                                        colors="primary:#000000"
                                        style="width:34px;height:34px">
                                    </lord-icon>
                                </a>

                                <a href="{{ route('ces-training.index', ['cesno'=>$competencyDatas->cesno]) }}" title="CES Trainings">
                                    <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
                                    <lord-icon
                                        src="https://cdn.lordicon.com/kipaqhoz.json"
                                        trigger="morph"
                                        colors="primary:#000000"
                                        style="width:34px;height:34px">
                                    </lord-icon>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="my-5">
                {{ $competencyData->links() }}
            </div>
        </div>

    </section>

@endsection
