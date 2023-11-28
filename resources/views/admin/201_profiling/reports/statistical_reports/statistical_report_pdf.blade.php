<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>201 Profiling Statistical Reports</title>

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
                color: #2b6cb0;
                margin-top: -7px;
                font-size: 15px;
            } 

            .report_name {
                text-transform: uppercase;
                font-size: 16px;
                color: #284F87;
                margin-top: 15px;
            }

            .whole_section{
                margin-top: 150px;
                width: 100%;
            }

            .section_title{
                font-size: 18px;
                font-weight: bold;
                font-family: 'Times New Roman', Times, serif;
            }

            .bullets{
                font-size: 16px;
                font-family: 'Times New Roman', Times, serif;
                padding-left: 15px;
                margin-top: 5px;
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
                <p class="report_name">201 Profiling Statistical Reports</p>
            </div>
        </header>

        <div class="whole_section">

            <div class="line">
                <p class="section_title">
                    Active vs Retired Demographics
                </p>
            </div>

            <div class="bullets">
                Total CESOs:
                <span style="color: #2b6cb0;">{{ $totalCESO }}</span>
            </div>
    
            <div class="bullets">
                Total Active CESOs:
                <span style="color: #2b6cb0;">{{ $totalCESOActive }}</span>
            </div>
    
            <div class="bullets">
                Total Retired CESOs:
                <span style="color: #2b6cb0;">{{ $totalCESORetired }}</span>
            </div>
    
            <div class="bullets">
                Total Inactive CESOs:
                <span style="color: #2b6cb0;">{{ $totalCESOInactive }}</span>
            </div>
    
            <div class="bullets">
                Total Deceased CESOs:
                <span style="color: #2b6cb0;">{{ $totalCESODeceased }}</span>
            </div>

            <div class="line">
                <hr style="margin-top: 15px;">

                <p class="section_title">
                    Age Demographics
                </p>
            </div>

            <div class="bullets">
                25 years old & below:
                <span style="color: #2b6cb0;">{{ $totalCESO }}</span>
            </div>
    
            <div class="bullets">
                26 to 35 years old:
                <span style="color: #2b6cb0;">{{ $totalCESOActive }}</span>
            </div>
    
            <div class="bullets">
                36 to 45 years old:
                <span style="color: #2b6cb0;">{{ $totalCESORetired }}</span>
            </div>
    
            <div class="bullets">
                46 to 55 years old:
                <span style="color: #2b6cb0;">{{ $totalCESOInactive }}</span>
            </div>
    
            <div class="bullets">
                56 to 65 years old:
                <span style="color: #2b6cb0;">{{ $totalCESODeceased }}</span>
            </div>

            <div class="bullets">
                66 years old & above:
                <span style="color: #2b6cb0;">{{ $totalCESODeceased }}</span>
            </div>
            
        </div>

    </body>
</html>