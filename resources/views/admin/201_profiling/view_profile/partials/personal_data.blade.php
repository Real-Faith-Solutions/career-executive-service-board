<div class="mb-3 bg-blue-500 p-2 uppercase text-white">
    <h1>Personal data</h1>
</div>

<form class="user" id="personal_data" method="POST" enctype="multipart/form-data" action="{{ route('/add-profile-201') }}">

    @csrf
    <div class="border-b bg-white px-6 py-3">
        <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
            <div class="mb-3">
                <label for="cesno">CES Number</label>
                <input id="cesno" type="number" name="cesno" value="{{ $mainProfile->cesno }}" readonly>

            </div>

            <div></div>

            {{-- <div class="mb-3">
                <label for="picture">Upload 2x2 Photo (Min. of 300x300 px)</label>
                <input class="mb-3 p-1" id="picture" name="picture" accept="image/png, image/jpeg" type="file" onclick="validateFileSize(`picture`, 2)" />
            </div> --}}

        </div>

        <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

            <div class="mb-3">
                <label for="title">Title<sup>*</sup></label>
                <input id="title" name="title" value="{{ $mainProfile->title }}" readonly>

            </div>
            <div></div>

            <div class="mb-3">
                <label for="status">Record Status<sup>*</span></label>
                <input name="status" id="status" value="{{ $mainProfile->status }}" readonly>

            </div>

        </div>

        <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

            <div class="mb-3">
                <label for="lastname">Lastname<sup>*</sup></label>
                <input type="text" id="lastname" name="lastname" value="{{ $mainProfile->lastname }}" readonly>
            </div>

            <div class="mb-3">
                <label for="firstname">Firstname<sup>*</sup></label>
                <input type="text" id="firstname" name="firstname" value="{{ $mainProfile->firstname }}" readonly>
            </div>

            <div class="mb-3">
                <label for="name_extension">Name Extension</label>
                <input name="name_extension" id="name_extension" value="{{ $mainProfile->name_extension }}" readonly>
            </div>

        </div>

        <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

            <div class="mb-3">
                <label for="middlename">Middlename<sup>*</sup></label>
                <input type="text" id="middlename" name="middlename" value="{{ $mainProfile->middlename }}" readonly>
            </div>

            <div class="mb-3">
                <label for="mi">Middle initial<sup>*</sup></label>
                <input type="text" id="mi" name="mi" value="{{ $mainProfile->mi }}" readonly>
            </div>

            <div class="mb-3">
                <label for="nickname">Nickname</label>
                <input type="text" id="nickname" name="nickname" value="{{ $mainProfile->nickname }}" readonly>
            </div>
        </div>

        <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

            <div class="mb-3">
                <label for="birthdate">Birthdate<sup>*</sup></label>
                <input type="date" id="birthdate" name="birthdate" value="{{ $mainProfile->birthday }}" readonly>
            </div>
            <div class="mb-3">
                <label for="age">Age<sup class="text-danger">*</sup></label>
                <input type="number" id="age" name="age" value="{{ $mainProfile->age }}" readonly>
            </div>

            <div class="mb-3">
                <label for="birth_place">Birth Place<sup>*</sup></label>
                <input type="text" id="birth_place" name="birth_place" value="{{ $mainProfile->birth_place }}" readonly>
            </div>

        </div>

        <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
            <div class="mb-3">
                <label for="gender">Gender By Birth<sup>*</sup></label>
                <input id="gender" name="gender" value="{{ $mainProfile->gender }}" readonly>
            </div>

            <div class="mb-3">
                <label for="gender_by_choice">Gender By Choice<sup>*</sup></label>
                <input id="gender_by_choice" name="gender_by_choice" value="{{ $mainProfile->gender_by_choice }}" readonly>
            </div>

            <div class="mb-3">
                <label for="civil_status">Civil Status<sup>*</sup></label>
                <input id="civil_status" name="civil_status" value="{{ $mainProfile->civil_status }}" readonly>
            </div>

        </div>

        <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

            <div class="mb-3">
                <label for="religion">Religion<sup>*</sup></label>
                <input id="religion" name="religion" value="{{ $mainProfile->religion }}" readonly>
            </div>

            <div class="mb-3">
                <label for="height">Height (in meters)<sup>*</sup></label>
                <input type="text" id="height" name="height" value="{{ $mainProfile->height }}" readonly>
            </div>
            <div class="mb-3">
                <label for="weight">Weight (in kilograms)<sup>*</sup></label>
                <input type="text" id="weight" name="weight" value="{{ $mainProfile->weight }}" readonly>
            </div>

        </div>

        <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">

            <div class="mb-3">
                <label for="member_of_indigenous_group">Member of Indigenous Group?<sup>*</sup></label>
                <input name="member_of_indigenous_group" id="member_of_indigenous_group" value="{{ $mainProfile->member_of_indigenous_group }}"readonly>
            </div>

            {{-- <div class="mb-3">
                <label for="member_of_indigenous_group_others">If others, please specify</label>
                <input type="text" id="member_of_indigenous_group_others" name="member_of_indigenous_group_others" readonly>
            </div> --}}

            <div class="mb-3">
                <label for="single_parent">Solo Parent?<sup>*</sup></label>
                <input name="sp" id="single_parent" value="{{ $mainProfile->single_parent }}" readonly>
            </div>

        </div>

        <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
            <div class="mb-3">
                <label for="citizenship">Citizenship<sup>*</sup></label>
                <input name="citizenship" id="citizenship" value="{{ $mainProfile->citizenship }}" readonly>
            </div>

            <div class="mb-3">
                <label for="dual_citizenship">If Holder Dual Citizenship By Birth, By Naturalization</label>
                <input type="text" name="dual_citizenship" id="dual_citizenship" value="{{ $mainProfile->dual_citizenship }}" readonly>
            </div>

            <div class="mb-3">
                <label for="person_with_disability" class="ml-2 text-sm font-medium text-gray-900">is PWD?</label>
                <input name="person_with_disability" id="person_with_disability" value="{{ $mainProfile->person_with_disability }}" readonly>
            </div>

        </div>

        {{-- identification cards --}}
        <section>
            <div class="mb-3 bg-blue-500 p-2 uppercase text-white">
                <h1>Identification cards</h1>
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

                    <label for="gsis">GSIS ID No. <sup>*</sup></label>
                    <input type="text" id="gsis" name="gsis" value="{{ $mainProfile->gsis }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="pagibig">PAG-IBIG ID No.<sup>*</sup></label>
                    <input type="text" id="pagibig" name="pagibig" value="{{ $mainProfile->pagibig }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="philhealt">PHILHEALTH ID No.<sup>*</sup></label>
                    <input type="text" id="philhealt" name="philhealt" value="{{ $mainProfile->philhealt }}" readonly>
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
        </section>
    </div>
</form>
