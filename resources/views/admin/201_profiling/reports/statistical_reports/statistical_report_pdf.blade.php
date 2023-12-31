<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>201 Profiling Statistical Reports</title>

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
                text-align: justify;
                bottom: -10px;
                font-size: 10px;
                color: #333;
            }

            .pagenum:before {
                content: counter(page);
            }

            .part-left,
            .page-right {
                display: inline-block;
            }

            .part-left {
                /* text-align: left; */
                position: fixed;
                left: 20px;
            }

            .page-right {
                position: fixed;
                right: 20px;
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

            .bullet-child{
                font-size: 14px;
                font-family: 'Times New Roman', Times, serif;
                padding-left: 50px;
                margin-top: 3px;
            }

            .page-break {
                page-break-after: always;
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

        <footer>
            <span class="page-right">
                Page <span class="pagenum"></span> {{ isset($pageCount) ? 'of '.$pageCount : '' }}
            </span>
        </footer>

        <div class="whole_section">

            <div class="line">
                <p class="section_title">
                    Active vs Retired Demographics
                </p>
            </div>

            <div class="bullets">
                Total Active and Retired (CESOs and CES Eligibles):
                <span style="color: #2b6cb0;">{{ $totalCESO }}</span>
            </div>

            <div class="bullet-child">
                * CESOs:
                <span style="color: #2b6cb0;">{{ $totalActiveRetiredCES }}</span>
            </div>

            <div class="bullet-child">
                * Eligibles:
                <span style="color: #2b6cb0;">{{ $totalActiveRetiredEligibles }}</span>
            </div>

            <br>
    
            <div class="bullets">
                Total Active (CESOs and CES Eligibles):
                <span style="color: #2b6cb0;">{{ $totalCESOActive }}</span>
            </div>

            <div class="bullet-child">
                * CESOs:
                <span style="color: #2b6cb0;">{{ $totalActiveCES }}</span>
            </div>

            <div class="bullet-child">
                * Eligibles:
                <span style="color: #2b6cb0;">{{ $totalActiveEligibles }}</span>
            </div>

            <br>
    
            <div class="bullets">
                Total Retired (CESOs and CES Eligibles):
                <span style="color: #2b6cb0;">{{ $totalCESORetired }}</span>
            </div>

            <div class="bullet-child">
                * CESOs:
                <span style="color: #2b6cb0;">{{ $totalRetiredCES }}</span>
            </div>

            <div class="bullet-child">
                * Eligibles:
                <span style="color: #2b6cb0;">{{ $totalRetiredEligibles }}</span>
            </div>

            <br>
    
            <div class="bullets">
                Total Inactive (CESOs and CES Eligibles):
                <span style="color: #2b6cb0;">{{ $totalCESOInactive }}</span>
            </div>

            <div class="bullet-child">
                * CESOs:
                <span style="color: #2b6cb0;">{{ $totalInactiveCES }}</span>
            </div>

            <div class="bullet-child">
                * Eligibles:
                <span style="color: #2b6cb0;">{{ $totalInactiveEligibles }}</span>
            </div>

            <br>
    
            <div class="bullets">
                Total Deceased (CESOs and CES Eligibles):
                <span style="color: #2b6cb0;">{{ $totalCESODeceased }}</span>
            </div>

            <div class="bullet-child">
                * CESOs:
                <span style="color: #2b6cb0;">{{ $totalDeceasedCES }}</span>
            </div>

            <div class="bullet-child">
                * Eligibles:
                <span style="color: #2b6cb0;">{{ $totalDeceasedEligibles }}</span>
            </div>

            <div class="line margined-line">
                <hr style="margin-top: 15px;">

                <p class="section_title">
                    CES Status Summary (Active CESOs and CES Eligibles)
                </p>
            </div>

            <div class="bullets">
                CESO I:
                <span style="color: #2b6cb0;">{{ $ceso1 }}</span>
            </div>
    
            <div class="bullets">
                CESO II:
                <span style="color: #2b6cb0;">{{ $ceso2 }}</span>
            </div>
    
            <div class="bullets">
                CESO III:
                <span style="color: #2b6cb0;">{{ $ceso3 }}</span>
            </div>
    
            <div class="bullets">
                CESO IV:
                <span style="color: #2b6cb0;">{{ $ceso4 }}</span>
            </div>
    
            <div class="bullets">
                CESO V:
                <span style="color: #2b6cb0;">{{ $ceso5 }}</span>
            </div>

            <div class="bullets">
                CESO VI:
                <span style="color: #2b6cb0;">{{ $age66above }}</span>
            </div>

            <div class="bullets">
                Eligible:
                <span style="color: #2b6cb0;">{{ $eligible }}</span>
            </div>

            <div class="line">
                <hr style="margin-top: 15px;">

                <p class="section_title">
                    Non-CES Status Summary (Active Non-CESOs)
                </p>
            </div>

            <div class="bullets">
                CSEE:
                <span style="color: #2b6cb0;">{{ $csee }}</span>
            </div>
    
            <div class="bullets">
                No Status:
                <span style="color: #2b6cb0;">{{ $noStatus }}</span>
            </div>

            <div class="page-break"></div>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>

            <div class="line">
                <p class="section_title">
                    Age Demographics (Active CESOs and CES Eligibles)
                </p>
            </div>

            <div class="bullets">
                25 years old & below:
                <span style="color: #2b6cb0;">{{ $age25below }}</span>
            </div>
    
            <div class="bullets">
                26 to 35 years old:
                <span style="color: #2b6cb0;">{{ $age26to35 }}</span>
            </div>
    
            <div class="bullets">
                36 to 45 years old:
                <span style="color: #2b6cb0;">{{ $age36to45 }}</span>
            </div>
    
            <div class="bullets">
                46 to 55 years old:
                <span style="color: #2b6cb0;">{{ $age46to55 }}</span>
            </div>
    
            <div class="bullets">
                56 to 65 years old:
                <span style="color: #2b6cb0;">{{ $age56to65 }}</span>
            </div>

            <div class="bullets">
                66 years old & above:
                <span style="color: #2b6cb0;">{{ $age66above }}</span>
            </div>

            <div class="line">
                <hr style="margin-top: 15px;">

                <p class="section_title">
                    Gender By Birth Demographics (Active CESOs and CES Eligibles)
                </p>
            </div>

            <div class="bullets">
                Male:
                <span style="color: #2b6cb0;">{{ $male }}</span>
            </div>
    
            <div class="bullets">
                Female:
                <span style="color: #2b6cb0;">{{ $female }}</span>
            </div>

            <div class="line">
                <hr style="margin-top: 15px;">

                <p class="section_title">
                    Others
                </p>
            </div>

            <div class="bullets">
                Total Person with Disability (Active CESOs and CES Eligibles):
                <span style="color: #2b6cb0;">{{ $pwd }}</span>
            </div>

            <div class="bullet-child">
                * CESOs:
                <span style="color: #2b6cb0;">{{ $pwdCES }}</span>
            </div>

            <div class="bullet-child">
                * Eligibles:
                <span style="color: #2b6cb0;">{{ $pwdEligibles }}</span>
            </div>

            <br>

            <div class="bullets">
                Total Single Parents (Active CESOs and CES Eligibles):
                <span style="color: #2b6cb0;">{{ $singleParents }}</span>
            </div>

            <div class="bullet-child">
                * CESOs:
                <span style="color: #2b6cb0;">{{ $singleParentsCES }}</span>
            </div>

            <div class="bullet-child">
                * Eligibles:
                <span style="color: #2b6cb0;">{{ $singleParentsEligibles }}</span>
            </div>

            <br>

            <div class="bullets">
                Total Member of Indigenous Group (Active CESOs and CES Eligibles):
                <span style="color: #2b6cb0;">{{ $indigenous }}</span>
            </div>

            <div class="bullet-child">
                * CESOs:
                <span style="color: #2b6cb0;">{{ $indigenousCES }}</span>
            </div>

            <div class="bullet-child">
                * Eligibles:
                <span style="color: #2b6cb0;">{{ $indigenousEligibles }}</span>
            </div>

            <br>

            <div class="bullets">
                Total Person with Dual Citizenship (Active CESOs and CES Eligibles):
                <span style="color: #2b6cb0;">{{ $dualCitizenship }}</span>
            </div>

            <div class="bullet-child">
                * CESOs:
                <span style="color: #2b6cb0;">{{ $dualCitizenshipCES }}</span>
            </div>

            <div class="bullet-child">
                * Eligibles:
                <span style="color: #2b6cb0;">{{ $dualCitizenshipEligibles }}</span>
            </div>

            <br>
            
        </div>

    </body>
</html>