<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>
            {{ $monthYear }}Birthday Celebrants
        </title>

        <style>
            @font-face {
                font-family: "Busorama";
                src: url('{{ public_path('fonts/CG Omega.ttf') }}');
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
                left: 20px;
                text-align: right;
                font-size: 10px;
                color: black;
            }

            table {
                border-collapse: collapse;
                /* padding-left: 10px;
                padding-right: 10px; */
                font-family: Arial;
                width: 100%;
            }
        
            td {
                padding-top: 5px;
                padding-right: 10px;
                padding-left: 10px;
                padding-bottom: 5px;
                font-size: 12px;
                text-align: left;
            }
        
            th {
                color: #284F87;
                font-size: 12px;
                padding-right: 10px;
                padding-left: 10px;
                text-transform: uppercase;
                text-align: left;
                background-color: white;
                font-weight: bold; /* Add font weight bold */
            }

        
            span {
                font-size: 10px;
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
                font-size: 9px;
            }
        
            .link {
                margin-top: -7px;
                font-size: 15px;
            } 

            .report_name {
                /* text-transform: uppercase; */
                font-weight: 100;
                font-size: 16px;
                color: #000006;
                margin-top: 15px;
            }
                
            .page-break {
                page-break-after: always;
                margin-top: 185px;
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
                <p class="report_name">
                    {{ $monthYear }} Birthday Celebrants
                </p>

                <footer>
                    <div class="flex-container">
                        Part {{ $partitionNumber }} of {{ $totalParts }}
                     </div>
                </footer>
            </div>
        </header>

        <div>
            <table>
                <thead >
                    <div class="page-break"></div>
                    <tr>
                        <th>
                            
                        </th>

                        <th>
                            Name
                        </th>

                        <th>
                            CES Status
                        </th>

                        <th>
                            Email
                        </th>

                        <th>
                            Mailing Address
                        </th>

                        <th>
                            Office
                        </th>

                        <th>
                            Office Address
                        </th>

                        <th>
                            Office Email
                        </th>
    
                        <th>
                            Birth Date
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $rowNumber = 1;
                    @endphp
                        @foreach ($personalData as $datas)
                            <tr>
                                <td>
                                    {{ $rowNumber++ }}
                                </td>

                                <td>
                                    {{ $datas->lastname }},
                                    {{ $datas->firstname }},
                                    {{ $datas->middlename }},
                                    {{ $datas->name_extension }}
                                </td>
    
                                <td>
                                    {{ $datas->cesStatus->description }}
                                </td>

                                
                                <td>
                                    {{ $datas->email }} 
                                </td>

                               <td>
                                    {{ optional($datas->mailingAddress)->region_name ? $datas->mailingAddress->region_name . ', ' : '' }}
                                    {{ optional($datas->mailingAddress)->city_or_municipality_name ? $datas->mailingAddress->city_or_municipality_name . ', ' : '' }}
                                    {{ optional($datas->mailingAddress)->brgy_name ? $datas->mailingAddress->brgy_name . ', ' : '' }}
                                    {{ optional($datas->mailingAddress)->street_lot_bldg_floor ? $datas->mailingAddress->street_lot_bldg_floor . ', ' : '' }}
                                    {{ optional($datas->mailingAddress)->zip_code ?? '' }}
                                </td>

                                <td>
                                    {{ $datas->planAppointee->planPosition->office->title ?? '' }}
                                </td>
    
                                <td>
                                    {{ optional(optional(optional(optional($datas->planAppointee)->planPosition)->office)->officeAddress)->floor_bldg ? optional(optional(optional(optional($datas->planAppointee)->planPosition)->office)->officeAddress)->floor_bldg . ', ' : '' }}
                                    {{ optional(optional(optional(optional($datas->planAppointee)->planPosition)->office)->officeAddress)->house_no_st ? optional(optional(optional(optional($datas->planAppointee)->planPosition)->office)->officeAddress)->house_no_st . ', ' : '' }} <br>
                                    {{ optional(optional(optional(optional($datas->planAppointee)->planPosition)->office)->officeAddress)->brgy_dist ? optional(optional(optional(optional($datas->planAppointee)->planPosition)->office)->officeAddress)->brgy_dist . ', ' : '' }} 
                                    {{ optional(optional(optional(optional($datas->planAppointee)->planPosition)->office)->officeAddress)->cities ? optional(optional(optional(optional($datas->planAppointee)->planPosition)->office)->officeAddress)->cities->name . ', ' : '' }}                                
                                </td>
 
                                <td>
                                    {{ optional(optional(optional(optional($datas->planAppointee)->planPosition)->office)->officeAddress)->emailadd ? optional(optional(optional(optional($datas->planAppointee)->planPosition)->office)->officeAddress)->emailadd : '' }}
                                </td>
                                    
                                <td>
                                    {{ \Carbon\Carbon::parse($datas->birthdate)->format('m/d/Y ') ?? '' }}
                                </td>
                            </tr>
                        @endforeach                 
                </tbody>
            </table>

            {{-- Here's the magic. This MUST be inside body tag. Page count / total --}}
            <script type="text/php">
                if (isset($pdf)) {
                    $text = "Page {PAGE_NUM} of {PAGE_COUNT}";
                    $size = 7;
                    $font = $fontMetrics->getFont("Verdana");
                    $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
                    $x = ($pdf->get_width() - $width);
                    $y = $pdf->get_height() - 28;
                    $pdf->page_text($x, $y, $text, $font, $size);
                }
            </script>
        </div>
    </body>
</html>