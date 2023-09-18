<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Training Provider Manager Report</title>

        <style>
            @page {
                margin-top: 100px;
                /* margin-bottom: 100px; */
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
            table {
                border-collapse: collapse;
                padding-left: 30px;
                padding-right: 30px;
                width: 100%;
            }
        
            td, th {
                text-align: center;
            }
        
            td {
                padding: 10px;
                font-size: 13px;
                text-align: left;
            }
        
            th {
                color: #284F87;
                font-size: 15px;
                text-transform: uppercase;
                padding-bottom: 5px;
                background-color: white;
            }
        
            tr:nth-child(even) {
                /* background-color: #6aabd1; */
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
        
            .thead {
                font-size: 13px;
            }

            .report_name {
                text-transform: uppercase;
                font-size: 16px;
                color: #284F87;
                margin-top: 30px;
            }
                
            .page-break {
                page-break-after: always;
                margin-top: 200px;
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
                <p class="report_name">Training Provider Manager Report</p>
            </div>
        </header>

        <div>
            <table>
                <thead>
                    <div class="page-break"></div>
                    <tr>
                        <th>
                            Provider
                        </th>
        
                        <th>
                            House Building
                        </th>
        
                        <th>
                            St. Road
                        </th>
        
                        <th>
                            Barangay
                        </th>
        
                        <th>
                            City Code
                        </th>
        
                        <th>
                            Contact No.
                        </th>
        
                        <th>
                            Email
                        </th>
        
                        <th>
                            Contact Person
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($competencyTrainingProvider as $competencyTrainingProviders)
                        <tr>
                            <td>
                                {{ $competencyTrainingProviders->provider }}
                            </td>
        
                            <td>
                                {{ $competencyTrainingProviders->house_bldg }}
                            </td>
        
                            <td>
                                {{ $competencyTrainingProviders->st_road }}
                            </td>
        
                            <td>
                                {{ $competencyTrainingProviders->brgy_vill }}
                            </td>
        
                            <td>
                                {{ $competencyTrainingProviders->trainingProviderManager->name }}
                            </td>
        
                            <td>
                                {{ $competencyTrainingProviders->contactno }}
                            </td>
        
                            <td>
                                {{ $competencyTrainingProviders->emailadd }}
                            </td>
        
                            <td>
                                {{ $competencyTrainingProviders->contactperson }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>    
    </body>
</html>