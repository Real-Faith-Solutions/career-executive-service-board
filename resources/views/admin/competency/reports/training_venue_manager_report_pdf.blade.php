<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Training Venue Manager Report</title>

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
                <p class="report_name">Training Venue Manager Report</p>
            </div>
        </header>

        <div>
            <table>
                <thead>
                    <div class="page-break"></div>
                    <tr>
                        <th class="thead">
                            Venue
                        </th>
        
                        <th class="thead">
                            Address
                        </th>
        
                        <th class="thead">
                            Contact No.
                        </th>
        
                        <th class="thead">
                            Email
                        </th>
        
                        <th class="thead">
                            Contact Person
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($trainingVenueManager as $trainingVenueManagers)
                        <tr>
                            <td class="first_row">
                                {{ $trainingVenueManagers->name }}
                            </td>
        
                            <td >
                                {{ 
                                    $trainingVenueManagers->no_street.', '.
                                    $trainingVenueManagers->brgy.', '. 
                                    $trainingVenueManagers->trainingVenueManager->name
                                }}
                            </td>
        
                            <td >
                                {{ $trainingVenueManagers->contactno }}
                            </td>
        
                            <td >
                                {{ $trainingVenueManagers->emailadd }}
                            </td>
        
                            <td >
                                {{ $trainingVenueManagers->contactperson }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </body>
</html>