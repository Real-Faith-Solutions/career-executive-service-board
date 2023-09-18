<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>General Report</title>

        <style>
            @page {
                margin-top: 100px;
            }

            header{
                position: fixed;
                left: 0px;
                right: 0px;
                height: 60px;
                margin-top: -60px;
                text-align: center;
            }
            table {
                border-collapse: collapse;
                padding-left: 25px;
                padding-right: 25px;
                width: 100%;
            }
        
            td, th {
                text-align: center;
            }
        
            td {
                padding: 15px;
                font-size: 13px;
                text-align: center;
            }
        
            th {
                color: #284F87;
                font-size: 13px;
                text-transform: uppercase;
                padding-bottom: 15px;
                background-color: white;
            }

            span {
                font-size: 12px;
            }
        
            tr:nth-child(even) {
                background-color: #DCD6D0;
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
                font-size: 20px;
                color: #284F87;
                margin-top: 30px;
            }
                
            .page-break {
                page-break-after: always;
                margin-top: 215px;
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
                <p class="report_name">
                    General Report
                    <br>
                    <span>
                        ( {{ $trainingSession->title }})
                    </span>
                </p>
            </div>
        </header>

        <div>
            <table>
                <thead >
                    <div class="page-break"></div>
                    <tr>
                        <th class="thead">
                            Particapants ID
                        </th>

                        <th class="thead">
                            Cesno
                        </th class="thead">

                        <th class="thead">
                            Name
                        </th class="thead">

                        <th class="thead">
                            CES Status
                        </th>

                        <th class="thead">
                            Training Status
                        </th>

                        <th class="thead">
                            Training Hours
                        </th>

                        <th class="thead">
                            Payment Status
                        </th>

                        <th class="thead">
                            Remarks
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($trainingParticipantList as $trainingParticipantLists)
                        <tr class="border-b bg-white">
                            <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                                {{ $trainingParticipantLists->pid }}
                            </td>
        
                            <td class="px-6 py-3">
                                {{ $trainingParticipantLists->cesno }}
                            </td>
        
                            <td class="px-6 py-3">
                                {{ 
                                    $trainingParticipantLists->cesTrainingPersonalData->lastname.', '. 
                                    $trainingParticipantLists->cesTrainingPersonalData->firstname.', '.
                                    $trainingParticipantLists->cesTrainingPersonalData->middleinitial.', '.
                                    $trainingParticipantLists->cesTrainingPersonalData->name_extension
                                }}
                            </td>
        
                            <td class="px-6 py-3">
                                {{-- {{ $trainingParticipantLists->specialization }} --}}
                            </td>
        
                            <td class="px-6 py-3">
                                {{ $trainingParticipantLists->status }}
                            </td>
        
                            <td class="px-6 py-3">
                                {{ $trainingParticipantLists->no_hours}}
                            </td>
        
                            <td class="px-6 py-3">
                                {{ $trainingParticipantLists->payment }}
                            </td>
        
                            <td class="px-6 py-3">
                                {{ $trainingParticipantLists->remarks }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </body>
</html>