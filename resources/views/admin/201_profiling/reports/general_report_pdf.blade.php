<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Training Venue Manager Report</title>

        <style>
            @page {
                margin-top: 75px;
                padding-bottom: 100px;
            }

            header{
                position: fixed;
                left: 0px;
                right: 0px;
                height: 60px;
                margin-top: -60px;
                text-align: center;
            }

            footer {
                position: fixed;
                bottom: -20px;
                right: 20px;
                text-align: right;
                font-size: 10px;
                color: #333;
            }
            
            table {
                border-collapse: collapse;
                padding-left: 10px;
                padding-right: 10px;
                font-family: Arial;
                width: 100%;
            }
        
            td {
                padding-top: 5px;
                padding-right: 10px;
                padding-left: 10px;
                padding-bottom: 5px;
                font-size: 10px;
                text-align: left;
                border: none;
            }
        
            th {
                color: #284F87;
                padding-right: 10px;
                padding-left: 10px;
                font-size: 10px;
                text-transform: uppercase;
                text-align: left;
                background-color: white;
            }
        
            tr:nth-child(even) {
                background-color: #3b83f6b2;
            }
        
            .container {
                text-align: center;
            }
        
            .title {
                margin-top: -20px;
            }
        
            .title_name {
                text-transform: uppercase;
                font-size: 20px;
                color: #284F87;
            }
        
            .title_street {
                margin-top: -20px;
                font-size: 12px;
            }
        
            .link {
                margin-top: -7px;
                font-size: 15px;
            } 

            .report_name {
                text-transform: uppercase;
                font-size: 16px;
                color: #284F87;
                margin-top: 15px;
            }

            .city_name {
                margin-top: -12px;
                font-size: 16px;
                color: #284F87;
            }
                
            .page-break {
                page-break-after: always;
                margin-top: 190px;
            }

            .pagenum:before {
                content: counter(page);
            }
        </style>
    </head>

    <body> 
        <header>
            <div class="container">
                <div class="logo">
                    <img src="{{ public_path("images/branding.png") }}" alt="" style="width: 100px; height: 100px;">
                </div>
            </div>
            
            <div class="title">
                <p class="title_name">Career Executive Service Board</p>
                <p class="title_street">No. 3 Marcelino St., Isidora Hills, Holy Spirit Drive, Diliman, Quezon City 1127</p>
                <p class="link"><a href="www.cesboard.gov.ph" target="_blank">www.cesboard.gov.ph</a></p>
                <p class="report_name">201 Profiling General Reports</p>
            </div>

            <footer>
                <div class="flex-container">
                    <div class="">Page <span class="pagenum"></span></div>
                </div>
            </footer>
        </header>

        <div>
            <table>
                <thead>
                    <div class="page-break"></div>
                    <tr>
                        <th>
                            
                        </th>

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

                        @if ($filter_active == "true" || $filter_inactive == "true" || $filter_retired == "true" || $filter_deceased == "true")
                            <th scope="col" class="px-6 py-3">
                                <span class="">Status</span>
                            </th>
                        @endif

                        @if ($cesstat_code !== "")
                            <th scope="col" class="px-6 py-3">
                                <span class="">CES Status</span>
                            </th>
                        @endif

                        @if ($authority_code !== "")
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
                    @php
                        $rowNumber = 1;
                    @endphp

                    @foreach ($personalData as $personalDatas)
                        <tr class="border-b bg-white hover:bg-slate-400 hover:text-white">

                            <td>
                                {{ $rowNumber++ }}
                            </td>

                            <td scope="col" class="px-6 py-3">
                                {{ $personalDatas->cesno }}
                            </td>

                            <td scope="col" class="px-6 py-3">
                                {{ $personalDatas->lastname }}, {{ $personalDatas->firstname }} {{ $personalDatas->middlename }}
                            </td>

                            @if ($filter_active == "true" || $filter_inactive == "true" || $filter_retired == "true" || $filter_deceased == "true")
                                <td scope="col" class="px-6 py-3">
                                    {{ $personalDatas->status ?? '' }}
                                </td>
                            @endif  

                            @if ($cesstat_code !== "")
                                <td scope="col" class="px-6 py-3">
                                    {{ $personalDatas->cesStatus->description ?? 'none' }}
                                </td>
                            @endif

                            @if ($authority_code !== "")
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

                                    @else
                                        none
                                    @endif
                                </td>
                            @endif

                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </body>
</html>