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

            .report_name {
                text-transform: uppercase;
                font-size: 16px;
                color: #284F87;
                margin-top: 15px;
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

            .image {
                width: 180px;
                height: 180px;
                border: 2px solid transparent;
                position: fixed;
                top: 150px; 
                right: 10px; /* Adjust the right position as needed */
            }

            .ces_status{
                position: fixed;
                top: 320px; 
                right: 75px;
                color: #2b6cb0;
                text-align: center;
            }

            .status{
                position: fixed;
                top: 355px; 
                right: 70px;
                text-align: center;
            }

            .name{ 
                position: fixed;
                top: 180px; 
                left: 20px;
                font-size: 18px;
                font-weight: bold;
            }

            .home-logo{
                position: fixed;
                top: 220px; 
                left: 20px;
            }

            .home-address{
                position: fixed;
                top: 220px; 
                left: 60px;
                font-size: 14px;
            }

            .phone-number{
                position: absolute;
                top: 258px; 
                left: 20px;
            }

            .number{
                position: fixed;
                top: 258px; 
                left: 60px;
            }

            .email-logo{
                position: fixed;
                top: 285px; 
                left: 20px;
            }

            .email{
                position: fixed;
                top: 285px; 
                left: 60px;
                color: #2b6cb0;
                text-decoration: underline;
            }

            .line{
                position: fixed;
                top: 400px;
                width: 100%;
            }

            .personal-information{
                font-size: 18px;
                font-weight: bold;
                padding-left: 20px;
                position: fixed;
                top: 430px;
                font-family: 'Times New Roman', Times, serif;
            }

            .retired{
                background-color: #ebf8ff; 
                color: #2b6cb0;
            }

            .active{
                background-color: #f0fff4;
                color: #047857;
            }

            .inactive{
                background-color: #fff7ed;
                color: #dd6b20;
            }

            .deceased{
                background-color: #f6e1e1;
                color: #7f1d1d;
            }

            .nickname{
                position: fixed;
                top: 495px;
                padding-left: 50px;
            }

            .birthday{
                position: fixed;
                top: 525px;
                padding-left: 50px;
            }

            .age{
                position: fixed;
                top: 555px;
                padding-left: 50px;                
            }

            .birthplace{
                position: fixed;
                top: 585px;
                padding-left: 50px;
            }

            .gender_by_birth{
                position: fixed;
                top: 615px;
                padding-left: 50px;
            }

            .gender_by_choice{
                position: fixed;
                top: 645px;
                padding-left: 50px;
            }

            .civil_status{
                position: fixed;
                top: 675px;
                padding-left: 50px;
            }

            .religion{
                position: fixed;
                top: 705px;
                padding-left: 50px;
            }

            .height{
                position: fixed;
                top: 735px;
                padding-left: 50px;
            }

            .weight{
                position: fixed;
                top: 765px;
                padding-left: 50px;
            }

            .indigineous_group{
                position: fixed;
                top: 795px;
                padding-left: 50px;
            }

            .solo_parent{
                position: fixed;
                top: 825px;
                padding-left: 50px;
            }

            .pwd{
                position: fixed;
                top: 855px;
                padding-left: 50px;
            }

            .citizenship{
                position: fixed;
                top: 885px;
                padding-left: 50px;
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

        <div>

            <div class="line">
                <hr>

                <p class="personal-information">
                    Active vs Retired Demographics
                </p>
            </div>

            <div>
                <div class="nickname">
                    Total CESOs: 
                    <span style="color: #2b6cb0;">
                        {{ $totalCESO }}
                    </span> 
                </div>

                <div class="birthday">
                    Total Active CESOs: 
                    <span style="color: #2b6cb0;">
                        {{ $totalCESOActive }}
                    </span> 
                </div>

                <div class="age">
                    Total Retired CESOs: 
                    <span style="color: #2b6cb0;">
                        {{ $totalCESORetired }}
                    </span> 
                </div>

                <div class="birthplace">
                    Total Inactive CESOs: 
                    <span style="color: #2b6cb0;">
                        {{ $totalCESOInactive }}
                    </span> 
                </div>

                <div class="gender_by_birth">
                    Total Deceased CESOs: 
                    <span style="color: #2b6cb0;">
                        {{ $totalCESODeceased }}
                    </span> 
                </div>
            </div>

        </div>

    </body>
</html>