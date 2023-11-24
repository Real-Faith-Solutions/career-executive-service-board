<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Training Venue Manager Report</title>

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
                background-color: white;
            }
        
            tr:nth-child(even) { 
                background-color: #F2F2F2;
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
                <p class="report_name">Training Venue Manager Report</p>
                @if ($search != null)
                    <p class="city_name">{{ "( $search )" }}</p>
                @endif
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

                        <th>
                            Venue
                        </th>
        
                        <th>
                            Address
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
                    @php
                        $rowNumber = 1;
                    @endphp

                    @foreach ($trainingVenueManagerByCity as $trainingVenueManagerByCities)
                        <tr>
                            <td>
                                {{ $rowNumber++ }}
                            </td>

                            <td>
                                {{ $trainingVenueManagerByCities->name ?? '' }}
                            </td>
        
                            <td >
                                {{ 
                                    $trainingVenueManagerByCities->no_street ?? ''.', '.
                                    $trainingVenueManagerByCities->brgy ?? ''.', '. 
                                    $trainingVenueManagerByCities->trainingVenueManager->name ?? ''
                                }}
                            </td>
        
                            <td >
                                {{ $trainingVenueManagerByCities->contactno ?? '' }}
                            </td>
        
                            <td >
                                {{ $trainingVenueManagerByCities->emailadd ?? '' }}
                            </td>
        
                            <td >
                                {{ $trainingVenueManagerByCities->contactperson ?? ''}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </body>
</html>