@extends('layouts.app')
@section('title', 'General Reports')
@section('sub', 'General Reports')
@section('content')

<nav class="bg-gray-200 border-gray-200 mb-3">
    <div class="flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="#" class="flex items-center">
            <span class="self-center text-2xl font-semibold whitespace-nowrap uppercase text-blue-500">201 PROFILE - GENERAL REPORTS</span>
        </a>

        <div class="flex justify-end">
            <a href="{{ route('download-general-reports.pdf', 
                ['sortBy' => $sortBy, 'sortOrder' => $sortOrder, 'filter_active' => $filter_active, 'filter_inactive' => $filter_inactive, 
                 'filter_retired' => $filter_retired, 'filter_deceased' => $filter_deceased, 'filter_retirement' => $filter_retirement, 
                 'with_pending_case' => $with_pending_case, 'without_pending_case' => $without_pending_case, 
                 'cesstat_code' => $cesstat_code, 'authority_code' => $authority_code]) }}" target='_blank' class="btn btn-primary">Generate PDF Report</a>
        </div>
    </div>
</nav>

    <section>

        <form action="{{ route('general-reports.index') }}" class="flex flex-wrap items-center justify-between mx-auto p-4">

            <div class="flex">
        
                <div class="flex items-center px-6 py-3 text-left">
                    <input id="filter_active" type="checkbox" name="filter_active" {{ $filter_active == "true" ? 'checked' : '' }} value="true" class="w-4 h-4 text-blue-600 accent-green-600">
                    <label for="filter_active" class="ml-2 mt-2 text-sm font-medium text-gray-700">Active</label>
                </div>
        
                <div class="flex items-center px-6 py-3 text-left">
                    <input id="filter_inactive" type="checkbox" name="filter_inactive" {{ $filter_inactive == "true" ? 'checked' : '' }} value="true" class="w-4 h-4 text-blue-600 accent-green-600">
                    <label for="filter_inactive" class="ml-2 mt-2 text-sm font-medium text-gray-700">Inactive</label>
                </div>

                <div class="flex items-center px-6 py-3 text-left">
                    <input id="filter_retired" type="checkbox" name="filter_retired" {{ $filter_retired == "true" ? 'checked' : '' }} value="true" class="w-4 h-4 text-blue-600 accent-green-600">
                    <label for="filter_retired" class="ml-2 mt-2 text-sm font-medium text-gray-700">Retired</label>
                </div>

                <div class="flex items-center px-6 py-3 text-left">
                    <input id="filter_deceased" type="checkbox" name="filter_deceased" {{ $filter_deceased == "true" ? 'checked' : '' }} value="true" class="w-4 h-4 text-blue-600 accent-green-600">
                    <label for="filter_deceased" class="ml-2 mt-2 text-sm font-medium text-gray-700">Deceased</label>
                </div>

                <div class="flex items-center px-6 py-3 text-left">
                    <input id="with_pending_case" type="checkbox" name="with_pending_case" {{ $with_pending_case == "true" ? 'checked' : '' }} value="true" class="w-4 h-4 text-blue-600 accent-green-600">
                    <label for="with_pending_case" class="ml-2 mt-2 text-sm font-medium text-gray-700">With Pending Case</label>
                </div>

                <div class="flex items-center px-6 py-3 text-left">
                    <input id="without_pending_case" type="checkbox" name="without_pending_case" {{ $without_pending_case == "true" ? 'checked' : '' }} value="true" class="w-4 h-4 text-blue-600 accent-green-600">
                    <label for="without_pending_case" class="ml-2 mt-2 text-sm font-medium text-gray-700">Without Pending Case</label>
                </div>

                <div class="flex items-center px-6 py-3 text-left">
                    <input id="filter_retirement" type="checkbox" name="filter_retirement" {{ $filter_retirement == "true" ? 'checked' : '' }} value="true" class="w-4 h-4 text-blue-600 accent-green-600">
                    <label for="filter_retirement" class="ml-2 mt-2 text-sm font-medium text-gray-700">Candidate For Retirement</label>
                </div>
            </div>

            <div class="flex">

                <div class="flex items-center px-6 py-3 text-left">
                    <label for="cesstat_code" class="mr-2 mt-2 text-sm font-medium text-gray-700">CES Status<sup>*</sup></label>
                    <select id="cesstat_code" name="cesstat_code" required type="text" class="inline-block">
                        <option disabled selected>Select CES Status</option>
                        @foreach ($profileLibTblCesStatus as $newProfileLibTblCesStatus)
                            <option value="{{ $newProfileLibTblCesStatus->code }}" {{ $newProfileLibTblCesStatus->code == $cesstat_code ? 'selected' : '' }}>{{ $newProfileLibTblCesStatus->description }}</option>
                        @endforeach
                        <option value="all" {{ "all" == $cesstat_code ? 'selected' : '' }}>All</option>
                        <option value="cesos" {{ "cesos" == $cesstat_code ? 'selected' : '' }}>CESOs</option>
                        <option value="cesoseli" {{ "cesoseli" == $cesstat_code ? 'selected' : '' }}>CESOs & Eligibles</option>
                    </select>
                    @error('cesstat_code')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                    @enderror
                </div>

                <div class="flex items-center px-6 py-3 text-left">
                    <label for="authority_code" class="mt-2 text-sm font-medium text-gray-700">Appointing Authority<sup>*</sup></label>
                    <select id="authority_code" name="authority_code" required type="text" class="inline-block">
                        <option disabled selected>Select Appointing Authority</option>
                        @foreach ($profileLibTblAppAuthority as $newProfileLibTblAppAuthority)
                            <option value="{{ $newProfileLibTblAppAuthority->code }}" {{ $newProfileLibTblAppAuthority->code == $authority_code ? 'selected' : '' }}>{{ $newProfileLibTblAppAuthority->description }}</option>
                        @endforeach
                        <option value="all" {{ "all" == $authority_code ? 'selected' : '' }}>All</option>
                    </select>
                    @error('authority_code')
                        <span class="invalid" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                    @enderror
                </div>

                <input type="hidden" id="report_title" name="report_title">

                <div class="my-5 mr-2 flex justify-end">
                    <button class="btn btn-primary" type="submit">Apply Filter</button>
                </div>

                <div class="my-5 flex justify-end">
                    <a class="btn btn-primary" href="{{ route('general-reports.index') }}">Remove Filters</a>
                </div>
            </div>

        </form>

        <div class="relative my-5 overflow-x-auto sm:rounded-lg">
            <table class="w-full text-left text-sm text-gray-500">
                <thead class="bg-gray-50 text-xs uppercase text-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            <a href="{{ route('general-reports.index', [
                                            'sort_by' => 'cesno',
                                            'sort_order' => $sortOrder === 'asc' ? 'desc' : 'asc',
                                            'filter_active' => $filter_active,
                                            'filter_inactive' => $filter_inactive,
                                            'filter_retired' => $filter_retired,
                                            'filter_deceased' => $filter_deceased,
                                            'filter_retirement' => $filter_retirement,
                                            'with_pending_case' => $with_pending_case,
                                            'without_pending_case' => $without_pending_case,
                                            'cesstat_code' => $cesstat_code,
                                            'authority_code' => $authority_code,
                                        ]) }}" class="flex items-center space-x-1">
                                Ces No. {{ $filter_active }}
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
                            <a href="{{ route('general-reports.index', [
                                            'sort_by' => 'lastname', 
                                            'sort_order' => $sortOrder === 'asc' ? 'desc' : 'asc',
                                            'filter_active' => $filter_active,
                                            'filter_inactive' => $filter_inactive,
                                            'filter_retired' => $filter_retired,
                                            'filter_deceased' => $filter_deceased,
                                            'filter_retirement' => $filter_retirement,
                                            'with_pending_case' => $with_pending_case,
                                            'without_pending_case' => $without_pending_case,
                                            'cesstat_code' => $cesstat_code,
                                            'authority_code' => $authority_code,
                                        ]) }}" class="flex items-center space-x-1">
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

                        @if ($filter_active == "true" || $filter_inactive == "true" || $filter_retired == "true" || $filter_deceased == "true")
                            <th scope="col" class="px-6 py-3">
                                <span class="">Status</span>
                            </th>
                        @endif

                        @if ($cesstat_code !== "false")
                            <th scope="col" class="px-6 py-3">
                                <span class="">CES Status</span>
                            </th>
                        @endif

                        @if ($authority_code !== "false")
                            <th scope="col" class="px-6 py-3">
                                <span class="">Appointing Authority</span>
                            </th>
                        @endif

                        @if ($with_pending_case == "true")
                            <th scope="col" class="px-6 py-3">
                                <span class="">Pending Case</span>
                            </th>
                        @endif
                        
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

                                @if ($filter_active == "true" || $filter_inactive == "true" || $filter_retired == "true" || $filter_deceased == "true")
                                    <td scope="col" class="px-6 py-3">
                                        {{ $personalDatas->status ?? '' }}
                                    </td>
                                @endif  

                                @if ($cesstat_code !== "false")
                                    <td scope="col" class="px-6 py-3">
                                        {{ $personalDatas->cesStatus->description ?? 'none' }}
                                    </td>
                                @endif

                                @if ($authority_code !== "false")
                                    <td scope="col" class="px-6 py-3">
                                        {{ $personalDatas->getAppointingAuthorityDescription($personalDatas) ?? 'none' }}
                                    </td>
                                @endif

                                @if ($with_pending_case == "true")
                                    <td scope="col" class="px-6 py-3">
                                        @if ($personalDatas->caseRecords->isNotEmpty())

                                            @php
                                                $pendingCount = 0; 
                                            @endphp

                                            @foreach ($personalDatas->caseRecords as $caseRecord)
                                                @if ($caseRecord->caseStatusCode->TITLE === 'Pending')
                                                    @php
                                                        $pendingCount++;
                                                    @endphp
                                                @endif
                                            @endforeach

                                            @if ($pendingCount > 0)
                                                {{ $pendingCount }} pending case
                                            @else
                                                none
                                            @endif

                                            {{-- @foreach ($personalDatas->caseRecords as $caseRecord)

                                                @if ($caseRecord->caseStatusCode->TITLE !== 'Pending' && $loop->remaining <= 0 && !$loop->first)
                                                    
                                                @elseif ($caseRecord->caseStatusCode->TITLE !== 'Pending' && $loop->remaining <= 0)
                                                    none
                                                @elseif ($caseRecord->caseStatusCode->TITLE !== 'Pending' && $loop->remaining > 0)
                                                    
                                                @elseif ($caseRecord->caseStatusCode->TITLE == 'Pending' && $loop->first)
                                                    {{ $caseRecord->offence }},
                                                @elseif ($caseRecord->caseStatusCode->TITLE == 'Pending' && !$loop->first && !$loop->last)
                                                     {{ $caseRecord->offence }},
                                                @elseif ($caseRecord->caseStatusCode->TITLE == 'Pending' && $loop->last)
                                                     {{ $caseRecord->offence }}
                                                @endif

                                            @endforeach --}}

                                        @else
                                            none
                                        @endif
                                    </td>
                                @endif

                            </tr>
                        @endforeach
                </tbody>
            </table>
            <div class="my-5">
                {{ $personalData->appends([
                    'sort_by' => $sortBy, 
                    'sort_order' => $sortOrder,
                    'filter_active' => $filter_active,
                    'filter_inactive' => $filter_inactive,
                    'filter_retired' => $filter_retired,
                    'filter_deceased' => $filter_deceased,
                    'filter_retirement' => $filter_retirement,
                    'with_pending_case' => $with_pending_case,
                    'without_pending_case' => $without_pending_case,
                    'cesstat_code' => $cesstat_code,
                    'authority_code' => $authority_code,
                    ])->links() }}
            </div>
        </div>

    </section>

    <!-- Modal for generate report -->
    <div id="general_report_modal"
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
        <div class="modal-content bg-white p-6 rounded-lg shadow-lg">
            <div class="sm:gid-cols-1 mb-2 grid gap-4 md:grid-cols-1 lg:grid-cols-1">

                <div class="flex flex-col items-center mb-2">
                    <label for="input_report_title" class="mb-2">Report Title<sup>*</sup></label>
                    <input type="text" id="input_report_title" name="input_report_title" placeholder="Enter Report Title..."
                        oninput="validateInput(input_report_title, 4)"
                        onkeypress="validateInput(input_report_title, 4)"
                        onblur="checkErrorMessage(input_report_title)" required>
                    <p class="input_error text-red-600"></p>
                    @error('input_report_title')
                    <span class="invalid" role="alert">
                        <p>{{ $message }}</p>
                    </span>
                    @enderror
                </div>

            </div>
            <button id="input_report_title_btn"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Confirm</button>
        </div>
    </div>
    {{-- end --}}

@endsection
