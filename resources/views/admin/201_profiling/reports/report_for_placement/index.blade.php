@extends('layouts.app')
@section('title', '201 Report for Placement')
@section('content')

<nav class="bg-gray-200 border-gray-200 mb-3">
    <div class="flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="#" class="flex items-center">
            <span class="self-center text-2xl font-semibold whitespace-nowrap uppercase text-blue-500">
                REPORTS FOR PLACEMENT
            </span>

            <div class="flex justify-end">
                <form action="{{ route('reports-for-placement.generateDownloadLinks') }}" target="_blank" method="GET">
                    @csrf

                    <input type="text" name="expertise" value="{{ $expertised }}" hidden>
                    <input type="text" name="degree" value="{{ $degree }}" hidden>
                    <input type="text" name="sortBy" value="{{ $sortBy }}" hidden>
                    <input type="text" name="sortOrder" value="{{ $sortOrder }}" hidden>

                    {{-- <div class="flex items-center mt-7 gap-2"> --}}
                        <button class="btn btn-primary mx-1 font-medium text-blue-600" type="submit">
                            Generate PDF Report
                        </button>
                    {{-- </div> --}}
                </div>
            </form>
            </div>
        </a>
    </div>
</nav>

    <div class="my-5 flex items-center">
        <form action="" method="GET">
                @csrf
            <div class="flex">
                <div class="flex items-center gap-1">
                    <div class="w-48">
                        <label for="expertise">Expertise:</label>
                        <select name="expertise" id="expertise">
                            {{-- <option value="">All</option> --}}
                            @foreach($profileTblExpertise as $data)
                                @if ($data->SpeExp_Code == $expertised)
                                    <option value="{{ $data->SpeExp_Code }}" selected>
                                        {{ $data->Title }}
                                    </option>
                                @else
                                    <option value="{{ $data->SpeExp_Code }}">
                                        {{ $data->Title }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="w-48">
                        <label for="degree">Degree:</label>
                        <select name="degree" id="expertise">
                            <option value="">All</option>
                            @foreach($profileLibTblEducDegree as $data)
                                    @if ($data->CODE == $degree)
                                        <option value="{{ $data->CODE }}" selected>
                                            {{ $data->DEGREE }}
                                        </option>
                                    @else
                                        <option value="{{ $data->CODE }}">
                                            {{ $data->DEGREE }}
                                        </option>
                                    @endif
                            @endforeach
                        </select>
                    </div>
                </div>        
                
                <div class="flex items-center mt-7 gap-2">
                    <button class="btn btn-primary mx-1 font-medium text-blue-600" type="submit">
                        Filter
                    </button>
                </div>
            </div>
        </form>
    </div>

    <section>   
        <div class="table-management-rankTrackers relative overflow-x-auto sm:rounded-lg shadow-lg">
            <table class="w-full text-left text-sm text-gray-500">
                <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            <a href="{{ route('reports-for-placement.index', [
                                'sortBy' => 'cesno',
                                'sortOrder' => $sortOrder === 'asc' ? 'desc' : 'asc',
                                'expertise' => $expertised,
                                'degree' => $degree,
                            ]) }}" class="flex items-center space-x-1">
                            CES No.
                            @if ($sortBy === 'cesno')
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
                        </th>

                        <th scope="col" class="px-6 py-3">
                            <a href="{{ route('reports-for-placement.index', [
                                'sortBy' => 'lastname',
                                'sortOrder' => $sortOrder === 'asc' ? 'desc' : 'asc',
                                'expertise' => $expertised,
                                'degree' => $degree,
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
                            Status
                        </th>

                        <th scope="col" class="px-6 py-3">
                            CES Status
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Expertise
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Degree
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($personalData as $datas) 
                        <tr class="border-b bg-white">
                            <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                                {{ $datas->cesno }}
                            </td>

                            <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                                {{ $datas->lastname }},
                                {{ $datas->firstname }},
                                {{ $datas->middlename }},
                                {{ $datas->name_extension }} 
                            </td>

                            <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                                {{ $datas->status}}
                            </td>

                            <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                                {{ $datas->cesStatus->description }}
                            </td>

                            <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                                @foreach ($datas->expertise as $expertise)
                                    @if ($expertised)
                                        @if ($expertise->SpeExp_Code == $expertised)
                                            {{ $expertise->expertisePersonalData->Title ?? '' }}, <br>
                                        @endif
                                    @else
                                        {{ $expertise->expertisePersonalData->Title ?? '' }}, <br>
                                    @endif
                                @endforeach
                            </td>
                            
                            <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">          
                                @foreach ($datas->educations as $educations)
                                    @if ($degree)
                                        @if ($educations->degree_code == $degree)
                                            {{ $educations->profileLibTblEducDegree->DEGREE ?? '' }}, <br>
                                        @endif
                                    @else
                                        {{ $educations->profileLibTblEducDegree->DEGREE ?? '' }}, <br>
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    
        <div class="m-5">
            {{ $personalData->appends([
                'sortBy' => $sortBy,
                'sortOrder' => $sortOrder,
                'expertise' => $expertised, 
                'degree' => $degree, 
            ])->links() }}
        </div>
    </section>
@endsection
