<div class="tab-pane fade show active" id="person-data" role="tabpanel" aria-labelledby="person-data-tab">
    {{-- @if (str_contains(Request::url(), 'profile/view'))
        <form class="user" id="personal_data" method="POST" enctype="multipart/form-data" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/personal-data/edit`, `personal_data`, `Update`, `updatePersonalDataTable`, `resetPersonalDataForm`, `personal_data_submit`, `None`, `None`)">
        @else --}}
            {{-- <form class="user" id="personal_data" method="POST" enctype="multipart/form-data" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/personal-data/add`, `personal_data`, `Add`, `None`, `None`, `personal_data_submit`, `Yes`, `None`)"> --}}
            <form class="user" id="personal_data" method="POST" enctype="multipart/form-data" action="{{ route('/add-profile-201') }}">
    {{-- @endif --}}

    @csrf

     
        <h1>Personal data</h1>
    </div>

    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
        <div class="mb-3">
            <label for="cesno">CES Number</label>
            <input id="cesno" type="number" name="cesno" required autofocus autocomplete="cesno" @if (str_contains(Request::url(), 'profile/add')) value="{{ $latestCesNo }}" @endif readonly>
            @error('cesno')
                <span class="invalid" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div></div>

        <div class="mb-3">
            <label for="picture">Upload 2x2 Photo (Min. of 300x300 px)</label>
            <input class="mb-3 p-1" id="picture" name="picture" accept="image/png, image/jpeg" type="file" onclick="validateFileSize(`picture`, 2)" />
            @error('picture')
                <span class="invalid" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

    </div>

    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

        <div class="mb-3">
            <label for="title">Title<sup>*</sup></label>
            <select name="title" required>
                <option disabled selected>Please Select</option>
                <option value="Dr.">Dr.</option>
                <option value="Atty.">Atty.</option>
                <option value="Mrs.">Mrs.</option>
                <option value="Ms.">Ms.</option>
                <option value="Mr.">Mr.</option>
            </select>
            @error('title')
                <span class="invalid" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div></div>

        <div class="mb-3">
            <label for="status">Record Status<sup>*</span></label>
            <select name="status" id="status" required>
                <option disabled selected>Please Select</option>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
                <option value="Retired">Retired</option>
                <option value="Deceased">Deceased</option>
            </select>
            @error('status')
                <span class="invalid" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

    </div>

    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

        <div class="mb-3">
            <label for="lastname">Lastname<sup>*</sup></label>
            <input type="text" id="lastname" name="lastname" onchange="validate201Profile()" required>
            @error('lastname')
                <span class="invalid" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="firstname">Firstname<sup>*</sup></label>
            <input type="text" id="firstname" name="firstname" onchange="validate201Profile()" required>
            @error('firstname')
                <span class="invalid" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="ne">Name Extension</label>
            <select name="ne" id="ne" required>
                <option disabled selected>Please Select</option>
                <option value="Jr.">Jr.</option>
                <option value="Sr.">Sr.</option>
                <option value="I">I</option>
                <option value="II">II</option>
                <option value="III">III</option>
                <option value="IV">IV</option>
                <option value="V">V</option>
                <option value="VI">VI</option>
            </select>
            @error('ne')
                <span class="invalid" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

    </div>

    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

        <div class="mb-3">
            <label for="middlename">Middlename<sup>*</sup></label>
            <input type="text" id="middlename" name="middlename" required class="Mn noNotallow" minlength="2" onchange="validate201Profile()">
            @error('middlename')
                <span class="invalid" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="mi">Middle initial<sup>*</sup></label>
            <input type="text" id="mi" name="mi" onchange="validate201Profile()" class="Mi" readonly>
            @error('mi')
                <span class="invalid" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="nickname">Nickname</label>
            <input type="text" id="nickname" name="nickname">
            @error('nickname')
                <span class="invalid" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

        <div class="mb-3">
            <label for="birthdate">Birthdate<sup>*</sup></label>
            <input type="date" id="birthdate" name="birthdate" class="mydob" onchange="validate201Profile()" required>
            @error('birthdate')
                <span class="invalid" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="age">Age<sup class="text-danger">*</sup></label>
            <input type="number" id="age" name="age" class="age form-control w-100 mb-3" readonly>
            @error('age')
                <span class="invalid" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="birth_place">Birth Place<sup>*</sup></label>
            <input type="text" id="birth_place" name="birth_place" required>
            @error('birth_place')
                <span class="invalid" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

    </div>

    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
        <div class="mb-3">
            <label for="gender">Gender By Birth<sup>*</sup></label>
            <select id="gender" name="gender" required>
                <option disabled selected>Please Select</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Prefer not to say">Prefer not to say</option>
            </select>
            @error('gender')
                <span class="invalid" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="gender_by_choice">Gender By Choice<sup>*</sup></label>
            <select id="gender_by_choice" name="gender_by_choice" required>
                <option disabled selected>Please Select</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Prefer not to say">Prefer not to say</option>
            </select>
            @error('gender_by_choice')
                <span class="invalid" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="civil_status">Civil Status<sup>*</sup></label>
            <select id="civil_status" name="civil_status" aria-aria-controls='example' required>
                <option disabled selected>Please Select</option>
                <option value="Married">Married</option>
                <option value="Single">Single</option>
                <option value="Divorced">Divorced</option>
                <option value="Widowed">Widowed</option>
                <option value="Separated">Separated</option>
                <option value="Other">Other</option>
            </select>
            @error('civil_status')
                <span class="invalid" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

    </div>

    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

        <div class="mb-3">
            <label for="religion">Religion<sup>*</sup></label>
            <select id="religion" name="religion" required>
                <option disabled selected>Please Select</option>
                <option value="Roman Catholic">Roman Catholic</option>
                <option value="Prefer not to say">Prefer not to say</option>
            </select>
            @error('religion')
                <span class="invalid" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="height">Height (in meters)<sup>*</sup></label>
            <input type="text" id="height" name="height" required>
            @error('height')
                <span class="invalid" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="weight">Weight (in kilograms)<sup>*</sup></label>
            <input type="text" id="weight" name="weight" required>
            @error('weight')
                <span class="invalid" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

    </div>

    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

        <div class="mb-3">
            <label for="moig">Member of Indigenous Group?<sup>*</sup></label>
            <select name="moig" id="moig" required>
                <option disabled selected>Please Select</option>
                <option value="Not a member">Not a member</option>
                <option value="Igorot">Igorot</option>
                <option value="Lumad">Lumad</option>
                <option value="Mangyan">Mangyan</option>
                <option value="B'laan">B'laan</option>
                <option value="Tagbanua">Tagbanua</option>
                <option value="Others">Others</option>
                <option value="Prefer not to say">Prefer not to say</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="moig_others">If others, please specify</label>
            <input type="text" id="moig_others" name="moig_others" required disabled>
            @error('moig_others')
                <span class="invalid" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="sppd_ip_TxtB">Solo Parent?<sup>*</sup></label>
            <select name="sp" id="sppd_ip_TxtB" class="w-100 form-control mb-3" required>
                <option disabled selected>Please Select</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
            @error('sp')
                <span class="invalid" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

    </div>

    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
        <div class="mb-3">
            <label for="citizenship">Citizenship<sup>*</sup></label>
            <select name="citizenship" id="citizenship" class="form-control w-100 citizenShip mb-3" required>
                <option disabled selected>Please Select</option>
                <option value="Filipino">Filipino</option>
                <option value="Dual Citizenship">Dual Citizenship</option>
            </select>
            @error('citizenship')
                <span class="invalid" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="inputcitizenShip">If Holder Dual Citizenship By Birth, By Naturalization</label>
            <input type="text" name="d_citizenship" class="form-control w-100 mb-3" id="inputcitizenShip" placeholder="Please indicate the Country" required disabled>
            @error('d_citizenship')
                <span class="invalid" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <div class="flex items-start">
                <div class="flex h-5 items-center">
                    <input name="pwd_CheckB" id="pwd_CheckB" type="checkbox" class="focus:ring-3 h-4 w-4 rounded border border-gray-300 bg-gray-50 focus:ring-blue-300">
                </div>
                <label for="pwd_CheckB" class="ml-2 text-sm font-medium text-gray-900">is PWD?</label>
            </div>
            <select name="pwd" id="pwd_TxtB" disabled>
                <option disabled selected>Please Select</option>
                <option value="Psychosocial Disability">Psychosocial Disability</option>
                <option value="Disability due to Chronic Illness">Disability due to Chronic Illness</option>
            </select>
            @error('pwd')
                <span class="invalid" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

    </div>

    {{-- identification cards --}}
    <section>
        <div class="mb-3 bg-blue-500 p-2 uppercase text-white">
            <h1>Identification cards</h1>
        </div>

        <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
            <div class="mb-3">
                <label for="gsis">GSIS ID No. <sup>*</sup></label>
                <input type="text" id="gsis" name="gsis" class="form-control w-100 mb-3" onchange="validateData(`gsis id`,`{{ env('APP_URL') }}api/v1/personal-data/validate-data`,this.value,`gsis`)" required>
                @error('gsis')
                    <span class="invalid" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="pagibig">PAG-IBIG ID No.<sup>*</sup></label>
                <input type="text" id="pagibig" name="pagibig" class="form-control w-100 mb-3" onchange="validateData(`pagibig id`,`{{ env('APP_URL') }}api/v1/personal-data/validate-data`,this.value,`pagibig`)" required>
                @error('pagibig')
                    <span class="invalid" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="philhealt">PHILHEALTH ID No.<sup>*</sup></label>
                <input type="text" id="philhealt" name="philhealt" class="form-control w-100 mb-3" onchange="validateData(`philhealth id`,`{{ env('APP_URL') }}api/v1/personal-data/validate-data`,this.value,`philhealt`)" required>
                @error('philhealt')
                    <span class="invalid" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

        </div>

        <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
            <div class="col-md-4">
                <label for="sss_no">SSS ID No.</label>
                <input type="text" id="sss_no" name="sss_no" class="form-control w-100 mb-3" onchange="validateData(`sss id`,`{{ env('APP_URL') }}api/v1/personal-data/validate-data`,this.value,`sss_no`)">
                @error('sss_no')
                    <span class="invalid" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-md-4">
                <label for="tin">TIN ID No.</label>
                <input type="text" id="tin" name="tin" class="form-control w-100 mb-3" onchange="validateData(`tin id`,`{{ env('APP_URL') }}api/v1/personal-data/validate-data`,this.value,`tin`)">
                @error('tin')
                    <span class="invalid" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </section> 
    {{-- end of identification card --}}

    {{-- permandent address --}}
    {{-- <section> 

        <div class="bg-blue-500 p-2 uppercase text-white">
            <h1>Home / Permanent Address</h1>
        </div>
        <div class="container-fuild m-3">
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Floor / Bldg.</label>
                    <input type="text" name="fb_pa" style="text-transform:capitalize" class="form-control w-100 mb-3">
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">No. / Street</label>
                    <input type="text" name="ns_pa" style="text-transform:capitalize" class="form-control w-100 mb-3">
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Brgy. / District<sup>*</sup></label>
                    <input type="text" name="bd_pa" style="text-transform:capitalize" class="form-control w-100 mb-3" required>
                    <!-- <select name="bd_pa" aria-aria-controls='example' style="text-transform:capitalize" class="w-100 form-control mb-3">
                                                                                                        <option value="">Please Select</option>
                                                                                                        <option value=""></option>
                                                                                                        <option value=""></option>
                                                                                                        <option value=""></option>
                                                                                                        <option value=""></option>
                                                                                                        <option value=""></option>
                                                                                                        <option value=""></option>
                                                                                                    </select> -->
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">City / Municipality<sup>*</sup></label>
                    <select name="cm_pa" aria-aria-controls='example' style="text-transform:capitalize" class="w-100 form-control mb-3" required>
                        <option disabled selected>Please Select</option>
                        @foreach ($CityMunicipality as $item)
                            <option value="{{ $item->CODE }}">{{ $item->NAME }}</option>
                        @endforeach

                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Zip Code<sup>*</sup></label>
                    <input type="number" name="zc_pa" class="form-control w-100 mb-3" required>
                </div>
            </div>
        </div>

    </section>  --}}
    {{-- end of permanent address --}}

    {{-- mailing address --}}
    {{-- <section> 
        <div class="bg-blue-500 p-2 uppercase text-white">
            <h1>Mailing address</h1>
        </div>
        <div class="mb-3">
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Floor / Bldg.</label>
                    <input type="text" name="fb_ma" style="text-transform:capitalize" class="form-control w-100 mb-3">
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">No. / Street</label>
                    <input type="text" name="ns_ma" style="text-transform:capitalize" class="form-control w-100 mb-3">
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Brgy. / District<sup>*</sup></label>
                    <input type="text" name="bd_ma" style="text-transform:capitalize" class="form-control w-100 mb-3" required>
                    <!-- <select name="bd_ma" aria-aria-controls='example' style="text-transform:capitalize" class="w-100 form-control mb-3">
                                                                                                        <option value="">Please Select</option>
                                                                                                        <option value=""></option>
                                                                                                        <option value=""></option>
                                                                                                        <option value=""></option>
                                                                                                        <option value=""></option>
                                                                                                        <option value=""></option>
                                                                                                        <option value=""></option>
                                                                                                    </select> -->
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">City / Municipality<sup>*</sup></label>
                    <select name="cm_ma" aria-aria-controls='example' style="text-transform:capitalize" class="w-100 form-control mb-3" required>
                        <option disabled selected>Please Select</option>
                        @foreach ($CityMunicipality as $item)
                            <option value="{{ $item->CODE }}">{{ $item->NAME }}</option>
                        @endforeach

                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Zip Code<sup>*</sup></label>
                    <input type="number" name="zc_ma" class="form-control w-100 mb-3" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Official Email Address<sup>*</sup></label>
                    <input type="email" id="oea_ma" name="oea_ma" class="form-control w-100 mb-3" onchange="validateData(`email`,`{{ env('APP_URL') }}api/v1/personal-data/validate-data`,this.value,`oea_ma`)" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Tel No.1 (landline) ex. (<span class="badge-success">+63</span><span class="badge-primary">02</span>81234567)</label>
                    <input type="text" name="telno1_ma" maxlength="13" class="form-control w-100 mb-3" placeholder="+63(area code)1234567">
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Personal Mobile No. 1 ex. (<span class="badge-success">+63</span><span class="badge-primary">945</span>1234567)<sup>*</sup></label>
                    <input type="text" id="mobileno1_ma" maxlength="13" name="mobileno1_ma" class="form-control w-100 mb-3" placeholder="+639451234567" onchange="validateData(`mobile no. 1`,`{{ env('APP_URL') }}api/v1/personal-data/validate-data`,this.value,`mobileno1_ma`)" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label ml-2 mb-0">Personal Mobile No. 2 ex. (<span class="badge-success">+63</span><span class="badge-primary">945</span>1234567)</label>
                    <input type="text" name="mobileno2_ma" maxlength="13" placeholder="+639451234567" class="form-control w-100 mb-3">
                </div>
            </div>

        </div>
    </section>  --}}
    {{-- end of mailing address --}}

    {{-- <div class="overflow-auto">

        <table class="table-responsive-lg table-hover table">
            <thead class="bg-secondary bg-gardient text-white">
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Ces No.</th>
                    <th scope="col">Solo Parent?</th>
                    <th scope="col">Member of Indigenous Group?</th>
                    <th scope="col">Is PWD?</th>
                    <th scope="col">Title</th>
                    <th scope="col">GSIS ID No.</th>
                    <th scope="col">PAG-IBIG ID No.</th>
                    <th scope="col">PHILHEALTH ID No.</th>
                    <th scope="col">SSS ID No.</th>
                    <th scope="col">TIN ID No.</th>
                    <th scope="col">Record Status</th>
                    <th scope="col">Citizenship</th>
                    <th scope="col">Dual Citizenship</th>
                    <th scope="col">Lastname</th>
                    <th scope="col">Firstname</th>
                    <th scope="col">Middlename</th>
                    <th scope="col">M.I</th>
                    <th scope="col">Name Extension</th>
                    <th scope="col">Nickname</th>
                    <th scope="col">Birthdate</th>
                    <th scope="col">Age</th>
                    <th scope="col">Birthplace</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Civil Status</th>
                    <th scope="col">Religion</th>
                    <th scope="col">Height</th>
                    <th scope="col">Weight</th>
                    <th scope="col">Home Floor/Bldg.</th>
                    <th scope="col">Home No./Street</th>
                    <th scope="col">Home Brgy./District</th>
                    <th scope="col">Home City/Municipality</th>
                    <th scope="col">Home Zip Code</th>
                    <th scope="col">Mailing Floor/Bldg.</th>
                    <th scope="col">Mailing No./Street</th>
                    <th scope="col">Mailing Brgy./District</th>
                    <th scope="col">Mailing City/Municipality</th>
                    <th scope="col">Mailing Zip Code</th>
                    <th scope="col">Mailing Official Email Address</th>
                    <th scope="col">Mailing Tel. No.1(landline)</th>
                    <th scope="col">Mailing Personal Mobile No.1</th>
                    <th scope="col">Mailing Personal Mobile No.2</th>
                    <th scope="col">Encoded By</th>
                    <th scope="col">Encoded Date</th>
                    <th scope="col">Last Updated By</th>
                    <th scope="col">Last Update Date</th>
                </tr>
            </thead>
            <tbody id="PersonalData_tbody">
                @if (count($personalData) === 0)

                    <tr>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                @else
                    @foreach ($personalData as $item)

                        <tr>
                            <td>
                                @if (str_contains(Request::url(), 'profile/view'))
                                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Personal Data', 'Edit') == 'true')
                                        <a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetPersonalDataForm(`Edit`)">Edit</a>
                                    @endif
                                @endif

                            </td>
                            <td>{{ $item->cesno ?? '-' }}</td>
                            <td>{{ $item->sp ?? '-' }}</td>
                            <td>{{ $item->moig ?? '-' }}</td>
                            <td>{{ $item->pwd ?? '-' }}</td>
                            <td>{{ $item->title ?? '-' }}</td>
                            <td>{{ $item->gsis ?? '-' }}</td>
                            <td>{{ $item->pagibig ?? '-' }}</td>
                            <td>{{ $item->philhealt ?? '-' }}</td>
                            <td>{{ $item->sss_no ?? '-' }}</td>
                            <td>{{ $item->tin ?? '-' }}</td>
                            <td>{{ $item->status ?? '-' }}</td>
                            <td>{{ $item->citizenship ?? '-' }}</td>
                            <td>{{ $item->d_citizenship ?? '-' }}</td>
                            <td>{{ $item->lastname ?? '-' }}</td>
                            <td>{{ $item->firstname ?? '-' }}</td>
                            <td>{{ $item->middlename ?? '-' }}</td>
                            <td>{{ $item->mi ?? '-' }}</td>
                            <td>{{ $item->ne ?? '-' }}</td>
                            <td>{{ $item->nickname ?? '-' }}</td>
                            <td>{{ $item->birthdate ?? '-' }}</td>
                            <td>{{ $item->age ?? '-' }}</td>
                            <td>{{ $item->birth_place ?? '-' }}</td>
                            <td>{{ $item->gender ?? '-' }}</td>
                            <td>{{ $item->civil_status ?? '-' }}</td>
                            <td>{{ $item->religion ?? '-' }}</td>
                            <td>{{ $item->height ?? '-' }}</td>
                            <td>{{ $item->weight ?? '-' }}</td>
                            <td>{{ $item->fb_pa ?? '-' }}</td>
                            <td>{{ $item->ns_pa ?? '-' }}</td>
                            <td>{{ $item->bd_pa ?? '-' }}</td>
                            <td>{{ $item->cm_pa ?? '-' }}</td>
                            <td>{{ $item->zc_pa ?? '-' }}</td>
                            <td>{{ $item->fb_ma ?? '-' }}</td>
                            <td>{{ $item->ns_ma ?? '-' }}</td>
                            <td>{{ $item->bd_ma ?? '-' }}</td>
                            <td>{{ $item->cm_ma ?? '-' }}</td>
                            <td>{{ $item->zc_ma ?? '-' }}</td>
                            <td>{{ $item->oea_ma ?? '-' }}</td>
                            <td>{{ $item->telno1_ma ?? '-' }}</td>
                            <td>{{ $item->mobileno1_ma ?? '-' }}</td>
                            <td>{{ $item->mobileno2_ma ?? '-' }}</td>
                            <td nowrap="nowrap">{{ $item->encoder ?? '-' }}</td>
                            <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->created_at)) ?? '-' }}</td>
                            <td nowrap="nowrap">{{ $item->last_updated_by ?? '-' }}</td>
                            <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->updated_at)) ?? '-' }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div> --}}

    <div class="flex justify-end">
        {{-- <button class="btn btn-primary" type="submit">
            Submit
        </button> --}}
        <input type="submit" value="submit">
    </div>

    </form>

</div>
