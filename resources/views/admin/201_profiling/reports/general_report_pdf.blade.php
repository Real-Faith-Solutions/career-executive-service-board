<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>201 Profiling General Reports</title>

        <style>
            @font-face {
                font-family: "Busorama";
                src: url('{{ asset(' fonts/busorama.ttf') }}');
                font-weight: normal;
                font-style: normal;
                font-stretch: normal;
            }

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
                background-color: #f1f6ffb2;
            }
        
            tr:nth-child(even) {
                background-color: #f1f6ffb2;
            }
        
            .container {
                text-align: center;
            }
        
            .title {
                margin-top: -20px;
            }
        
            .title_name {
                text-transform: uppercase;
                font-family: 'Busorama';
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

            /* body {
                counter-reset: page 13; 
            }

            footer .pagenum:before {
                content: counter(page);
            } */

            .pagenum:before {
                content: counter(page);
            }
        </style>
    </head>

    <body> 
        <header>
            <div class="container">
                <div class="logo">
                    <img src="{{ public_path("images/assets/branding.png") }}" alt="" style="width: 100px; height: 100px;">
                </div>
            </div>
            
            <div class="title">
                <p class="title_name">Career Executive Service Board</p>
                <p class="title_street">No. 3 Marcelino St., Isidora Hills, Holy Spirit Drive, Diliman, Quezon City 1127</p>
                <p class="link"><a href="www.cesboard.gov.ph" target="_blank">www.cesboard.gov.ph</a></p>
                <p class="report_name">201 Profiling General Reports</p>
            </div>
        </header>

        <footer>
            <div class="flex-container">
                Page <span class="pagenum"></span>
            </div>
        </footer>

        <div>
            <table>
                <thead>
                    <div class="page-break"></div>
                    <tr>
                        <th>
                            
                        </th>

                        <th>
                            Ces No.
                        </th>

                        <th>
                            Name
                        </th>

                        @if ($filter_active == "true" || $filter_inactive == "true" || $filter_retired == "true" || $filter_deceased == "true")
                            <th>
                                <span>Status</span>
                            </th>
                        @endif

                        @if ($cesstat_code !== "false")
                            <th>
                                <span>CES Status</span>
                            </th>
                        @endif

                        @if ($authority_code !== "false")
                            <th>
                                <span>Appointing Authority</span>
                            </th>
                        @endif

                        @if ($with_pending_case == "true")
                            <th>
                                <span>Pending Case</span>
                            </th>
                        @endif

                    </tr>
                </thead>
                <tbody>

                    @foreach ($personalData as $personalDatas)
                        <tr>

                            <td>
                                {{ ++$skippedData }}
                            </td>

                            <td>
                                {{ $personalDatas->cesno }}
                            </td>

                            <td>
                                {{ $personalDatas->lastname }}, {{ $personalDatas->firstname }} {{ $personalDatas->middlename }}
                            </td>

                            @if ($filter_active == "true" || $filter_inactive == "true" || $filter_retired == "true" || $filter_deceased == "true")
                                <td>
                                    {{ $personalDatas->status ?? '' }}
                                </td>
                            @endif  

                            @if ($cesstat_code !== "false")
                                <td>
                                    {{ $personalDatas->cesStatus->description ?? 'none' }}
                                </td>
                            @endif

                            @if ($authority_code !== "false")
                                <td>
                                    {{ $personalDatas->getAppointingAuthorityDescription($personalDatas) ?? 'none' }}
                                </td>
                            @endif

                            @if ($with_pending_case == "true")
                                <td>
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