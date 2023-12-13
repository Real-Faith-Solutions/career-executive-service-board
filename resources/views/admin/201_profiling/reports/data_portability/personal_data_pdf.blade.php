<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Data Portability Report</title>

        <style>
            @font-face {
                font-family: "Busorama";
                src: url('{{ asset(' fonts/CG Omega.ttf') }}');
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
            </div>
        </header>

        <div>
            <img id="profile-avatar" class="image" src="{{ public_path('images/' . ($personalData->picture ? $personalData->picture : 'assets/placeholder.png')) }}" />

            <p class="ces_status">
                {{ $cesStatus }}
            </p>

            @if ($personalData->status === 'Active')
                <div class="status">
                    <span class="active">
                        {{ $personalData->status }}
                    </span>
                </div>
            @endif

            @if ($personalData->status === 'Inactive')
                <div class="status">
                    <span class="inactive">
                        {{ $personalData->status }}
                    </span>
                </div>
            @endif

            @if ($personalData->status === 'Retired')
                <div class="status">
                    <span class="retired">
                        {{ $personalData->status }}
                    </span>
                </div>
            @endif

            @if ($personalData->status === 'Deceased')
            <div class="status">
                <span class="deceased" style="position: fixed; right: 71px;">
                    {{ $personalData->status }}
                </span>
            </div>
        @endif
        </div>

        <div>
            <div class="name">
                {{ $personalData->title }}
                {{ $personalData->lastname }}
                {{ $personalData->firstname }} 
                {{ $personalData->middlename }}
                {{ $personalData->name_extension }}
            </div>

            {{-- home address --}}
            <div class="home-logo">
                <img class="" src="{{ public_path('images/assets/home.png') }}" /> 
            </div>

            <div class="home-address">
                @foreach ($address as $data)
                    {{ $data->region_name }}
                    {{ $data->city_or_municipality_name }}
                    {{ $data->brgy_name }}
                    {{ $data->zip_code }}<br>
                    {{ $data->street_lot_bldg_floor }}
                @endforeach
            </div>
            {{-- end of home address --}}

            {{-- contact number --}}
            <div class="phone-number">
                <img class="" src="{{ public_path('images/assets/phone.png') }}" /> 
            </div>

            <div class="number">
                {{ $contactNumber }}
            </div>
            {{-- end of contact number --}}

            {{-- email --}}
            <div class="email-logo">
                <img class="" src="{{ public_path('images/assets/email.png') }}" /> 
            </div>

            <div class="email">
                {{ $personalData->email }}
            </div>
            {{-- end of email --}}

            <div class="line">
                <hr>

                <p class="personal-information">
                    Other Personal Information
                </p>
            </div>

            <div>
                <div class="nickname">
                    Nick Name: 
                    <span style="color: #2b6cb0;">
                        {{ $personalData->nickname }}
                    </span> 
                </div>

                <div class="birthday">
                    Birthday: 
                    <span style="color: #2b6cb0;">
                        {{ \Carbon\Carbon::parse($personalData->birth_date)->format('M-d-Y ')}}
                    </span> 
                </div>

                <div class="age">
                    Age: 
                    <span style="color: #2b6cb0;">
                        {{ $age }}
                    </span> 
                </div>

                <div class="birthplace">
                    Birth Place: 
                    <span style="color: #2b6cb0;">
                        {{ $personalData->cities->name ?? '' }}
                    </span> 
                </div>

                <div class="gender_by_birth">
                    Gender By Birth: 
                    <span style="color: #2b6cb0;">
                        {{ $personalData->gender }}
                    </span> 
                </div>

                <div class="gender_by_choice">
                    Gender By Choice: 
                    <span style="color: #2b6cb0;">
                        {{ $personalData->gender_by_choice }}
                    </span> 
                </div>

                <div class="civil_status">
                    Civil Status:
                    <span style="color: #2b6cb0;">
                        {{ $personalData->civil_status }}
                    </span> 
                </div>

                <div class="religion">
                    Religion:
                    <span style="color: #2b6cb0;">
                        {{ $personalData->religions->name }}
                    </span> 
                </div>

                <div class="height">
                    Height:
                    <span style="color: #2b6cb0;">
                        {{ $personalData->height }}
                    </span> 
                </div>

                <div class="weight">
                    Weight:
                    <span style="color: #2b6cb0;">
                        {{ $personalData->weight }}
                    </span> 
                </div>

                <div class="indigineous_group">
                    Member of Indigineous Group:
                    <span style="color: #2b6cb0;">
                        {{ $personalData->member_of_indigenous_group }}
                    </span> 
                </div>

                <div class="solo_parent">
                    Solo Parent:
                    <span style="color: #2b6cb0;">
                        {{ $personalData->single_parent }}
                    </span> 
                </div>

                <div class="pwd">
                    is PWD:
                    <span style="color: #2b6cb0;">
                        {{ $personalData->person_with_disability }}
                    </span> 
                </div>

                <div class="citizenship">
                    Citizenship:
                    <span style="color: #2b6cb0;">
                        {{ $personalData->citizenship }}
                        {{ $personalData->dual_citizenship }}
                    </span> 
                </div>
            </div>
        </div>
    </body>
</html>