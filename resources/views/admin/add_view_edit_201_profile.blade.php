@extends('layouts.app')
@section('title', 'Create 201 profile')
@section('content')

    <style>
        .nav-pills .nav-link {
            border: 1px solid #111;
            margin: 4px;
        }
    </style>
    <div class="@if (str_contains(Request::url(), 'profile/view'))  @endif">
        <!-- Main content -->
        @if (Auth::user()->role != 'User')
            @if (str_contains(Request::url(), 'profile/view'))

                <section class="col-md-3">
                    <div>
                        <form class="d-flex" action="{{ url('admin/profile/view') }}" role="search" method="post">
                            @csrf
                            <div class="input-group">
                                <input class="form-control me-2" type="search" name="search" placeholder="Search here..." @if (!empty($search)) value="{{ $search }}" @endif>
                                <input class="form-control btn btn-primary" type="submit" value="Search">
                            </div>
                        </form>
                        <div class="my-3 bg-white">
                            <table class="table-striped display-6 table text-black">
                                <thead class="bg-secondary bg-gardient text-white">
                                    <tr>
                                        <th scope="col">Ces No.</th>
                                        <th scope="col">Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($searched) === 0)

                                        <tr>
                                            <td class="text-danger">-</td>
                                            <td class="text-danger">No result found</td>
                                        </tr>
                                    @else
                                        @foreach ($searched as $item)
                                            <tr>
                                                <td>
                                                    <a href="{{ env('APP_URL') }}admin/profile/views/{{ $item->cesno }}">{{ $item->cesno }}</a>
                                                </td>
                                                <td>
                                                    <a href="{{ env('APP_URL') }}admin/profile/views/{{ $item->cesno }}">{{ $item->lastname }}, {{ $item->firstname }} {{ $item->middlename }}</a>
                                                    <a class="badge badge-pill badge-danger float-right" style="display:none">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            @endif
        @endif

        <section class="content @if (str_contains(Request::url(), 'profile/view')) @if (Auth::user()->role == 'User') ml-2 col @else col-md-9 @endif @endif">
            @if (str_contains(Request::url(), 'profile/view'))

                <div class="@if (Auth::user()->role == 'User') p-3 pb-5 @else p-3 pb-5 @endif text-warning bg-blue-500 text-left text-white">
                    @foreach ($personalData as $item)
                        <img id="profile_picture" src="{{ $item->picture == '' ? asset('images/person.png') : asset('external-storage/Photos/201 Photos/' . $item->picture) }}" onerror="this.src = '{{ asset('images/person.png') }}'" class="bg-light float-right mt-2 mr-3 rounded" height="190" width="190" alt="...">
                        <div class="p-4">
                            <div class="row ml-4 text-white">
                                <div class="col-auto mt-2 mr-3 p-0">
                                    <h3 class="h6">CES No. <span class="bg-danger h6 rounded py-1 px-2">{{ $item->cesno }}</span></h3>
                                </div>
                    @endforeach

                    <div class="col-auto mt-2 mr-3 p-0">
                        <h3 class="h6">Ac No. <span id="profile_ac_no" class="bg-danger h6 rounded py-1 px-2">
                                @if ($AssessmentCenter == '[]')---
                                @else
                                    @foreach ($AssessmentCenter as $item)
                                        {{ $loop->last ? $item->an_achr_ces_we : '' }}
                                    @endforeach
                                @endif
                            </span></h3>
                    </div>
                    <div class="col-auto mt-2 mr-3 p-0">
                        <h3 class="h6">CES Status: <span id="profile_ces_status" class="@foreach ($personalData as $item) @if ($item->status == 'Retired') bg-danger @elseif($item->status == 'Deceased') bg-dark @else bg-success @endif @endforeach h6 rounded py-1 px-2">
                                @if ($CesStatus == '[]')---
                                @else
                                    @foreach ($CesStatus as $item)
                                        {{ $loop->last ? $item->cs_cs_ces_we : '' }}
                                    @endforeach
                                @endif
                            </span></h3>
                    </div>
                </div>
                @foreach ($personalData as $item)
                    <h1 class="@if ($item->status == 'Retired') text-danger @elseif ($item->status == 'Deceased') text-dark @else text-success @endif font-weight-bold display-4 text-uppercase">
                        <span id="profile_lastname">{{ $item->lastname }}</span>, <span id="profile_firstname">{{ $item->firstname }}</span> <span id="profile_middlename">{{ $item->middlename }}</span>
                    </h1>
                @endforeach

    </div>
    </div>

    <script>
        setPageTitle('View 201 Profile');
    </script>
@else
    <script>
        setPageTitle('Create 201 Profile');
    </script>
    @endif

    <div class="container-fluid py-3 pt-3">
        <div class="row">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Personal Data', 'Category Only') == 'true')

                    <li class="nav-item" role="presentation">
                        <a class="btn text-blue-500" id="person-data-tab" data-bs-toggle="tab" href="#person-data" role="tab" aria-controls="home" aria-selected="true">Personal Data</a>
                    </li>
                @endif

                @if (str_contains(Request::url(), 'profile/view')) {{-- Start hiding other category if profile/view --}}
                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Family Background Profile', 'Category Only') == 'true')

                        <li class="nav-item" role="presentation">
                            <a class="btn" id="family-profile-tab" data-bs-toggle="tab" href="#family-profile" role="tab" aria-controls="family-profile" aria-selected="false">Family Profile</a>
                        </li>
                    @endif
                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Educational Background or Attainment', 'Category Only') == 'true')

                        <li class="nav-item" role="presentation">
                            <a class="btn" id="educational_attainment-tab" data-bs-toggle="tab" href="#educational_attainment" role="tab" aria-controls="educational_attainment" aria-selected="false">Educational Background / Attainment</a>
                        </li>
                    @endif
                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Examinations Taken', 'Category Only') == 'true')

                        <li class="nav-item" role="presentation">
                            <a class="btn" id="examinations_taken-tab" data-bs-toggle="tab" href="#examinations_taken" role="tab" aria-controls="examinations_taken" aria-selected="false">Examinations Taken</a>
                        </li>
                    @endif
                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Language Dialects', 'Category Only') == 'true')

                        <li class="nav-item" role="presentation">
                            <a class="btn" id="languages_dialects-tab" data-bs-toggle="tab" href="#languages_dialects" role="tab" aria-controls="languages_dialects" aria-selected="false">Languages Dialects</a>
                        </li>
                    @endif
                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker', 'Category Only') == 'true')

                        <li class="nav-item" role="presentation">
                            <a class="btn" id="eligibility_and_rank_tracker-tab" data-bs-toggle="tab" href="#eligibility_and_rank_tracker" role="tab" aria-controls="eligibility_and_rank_tracker" aria-selected="false">Eligibility and Rank Tracker</a>
                        </li>
                    @endif
                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Record of CESPES Ratings', 'Category Only') == 'true')

                        <li class="nav-item" role="presentation">
                            <a class="btn" id="record_of_cespes_rating_hr-tab" data-bs-toggle="tab" href="#record_of_cespes_rating_hr" role="tab" aria-controls="record_of_cespes_rating_hr" aria-selected="false">Record of Cespes Ratings</a>
                        </li>
                    @endif
                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Work Experience', 'Category Only') == 'true')

                        <li class="nav-item" role="presentation">
                            <a class="btn" id="work_experience-tab" data-bs-toggle="tab" href="#work_experience" role="tab" aria-controls="work_experience" aria-selected="false">Work Experience</a>
                        </li>
                    @endif
                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Records of Field of Expertise or Specialization', 'Category Only') == 'true')

                        <li class="nav-item" role="presentation">
                            <a class="btn" id="field_expertise-tab" data-bs-toggle="tab" href="#field_expertise" role="tab" aria-controls="field_expertise" aria-selected="false">Field Expertise</a>
                        </li>
                    @endif
                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('CES Trainings', 'Category Only') == 'true')

                        <li class="nav-item" role="presentation">
                            <a class="btn" id="ces_trainings-tab" data-bs-toggle="tab" href="#ces_trainings" role="tab" aria-controls="ces_trainings" aria-selected="false">Ces Trainings</a>
                        </li>
                    @endif
                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Other Non-CES Accredited Trainings', 'Category Only') == 'true')

                        <li class="nav-item" role="presentation">
                            <a class="btn" id="other_management_trainings-tab" data-bs-toggle="tab" href="#other_management_trainings" role="tab" aria-controls="other_management_trainings" aria-selected="false">Other Trainings</a>
                        </li>
                    @endif
                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Research and Studies', 'Category Only') == 'true')

                        <li class="nav-item" role="presentation">
                            <a class="btn" id="research_and_studies-tab" data-bs-toggle="tab" href="#research_and_studies" role="tab" aria-controls="research_and_studies" aria-selected="false">Research And Studies</a>
                        </li>
                    @endif
                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Scholarships Received', 'Category Only') == 'true')

                        <li class="nav-item" role="presentation">
                            <a class="btn" id="scholarships-tab" data-bs-toggle="tab" href="#scholarships" role="tab" aria-controls="scholarships" aria-selected="false">Scholarships</a>
                        </li>
                    @endif
                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Major Civic and Professional Affiliations', 'Category Only') == 'true')

                        <li class="nav-item" role="presentation">
                            <a class="btn" id="major_civic_and_professional_affiliations-tab" data-bs-toggle="tab" href="#major_civic_and_professional_affiliations" role="tab" aria-controls="major_civic_and_professional_affiliations" aria-selected="false">Major Civic and Professional Affiliations</a>
                        </li>
                    @endif
                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Awards and Citations Received', 'Category Only') == 'true')

                        <li class="nav-item" role="presentation">
                            <a class="btn" id="award_and_citations-tab" data-bs-toggle="tab" href="#award_and_citations" role="tab" aria-controls="award_and_citations" aria-selected="false">Award And Citations</a>
                        </li>
                    @endif
                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Case Records', 'Category Only') == 'true')

                        <li class="nav-item" role="presentation">
                            <a class="btn" id="case_records-tab" data-bs-toggle="tab" href="#case_records" role="tab" aria-controls="case_records" aria-selected="false">Case Records</a>
                        </li>
                    @endif
                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Health Record', 'Category Only') == 'true')

                        <li class="nav-item" role="presentation">
                            <a class="btn" id="health_records-tab" data-bs-toggle="tab" href="#health_records" role="tab" aria-controls="health_records" aria-selected="false">Health Records</a>
                        </li>
                    @endif
                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Attached PDF Files', 'Category Only') == 'true')

                        <li class="nav-item" role="presentation">
                            <a class="btn" id="pdf_files-tab" data-bs-toggle="tab" href="#pdf_files" role="tab" aria-controls="pdf_files" aria-selected="false">PDF Files</a>
                        </li>
                    @endif
                @endif {{-- End hiding other category if profile/view --}}

            </ul>
        </div>
    </div>
    <hr>

    <div class="row">
        <div class="col-12">
            <div class="tab-content" id="myTabContent">
                @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Personal Data', 'Category Only') == 'true')

                    <!-- start personal data -->
                    <div class="tab-pane fade show active" id="person-data" role="tabpanel" aria-labelledby="person-data-tab">
                        @if (str_contains(Request::url(), 'profile/view'))

                            <form class="user" id="personal_data" method="POST" enctype="multipart/form-data" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/personal-data/edit`, `personal_data`, `Update`, `updatePersonalDataTable`, `resetPersonalDataForm`, `personal_data_submit`, `None`, `None`)">
                            @else
                                <form class="user" id="personal_data" method="POST" enctype="multipart/form-data" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/personal-data/add`, `personal_data`, `Add`, `None`, `None`, `personal_data_submit`, `Yes`, `None`)">
                        @endif

                        @csrf
                        <div class="mb-3 bg-blue-500 p-2 uppercase text-white">
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
                        </section> {{-- end of identification card --}}

                        <section> {{-- permandent address --}}

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
                                            <option value="">Please Select</option>
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

                        </section> {{-- end of permanent address --}}

                        <section> {{-- mailing address --}}
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
                                            <option value="">Please Select</option>
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
                        </section> {{-- end of mailing address --}}


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


                        </form>
                    </div>
                    <!-- end personal data -->
                @endif

                @if (str_contains(Request::url(), 'profile/view')) {{-- Start hiding other category if profile/view --}}
                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Family Background Profile', 'Category Only') == 'true')

                        <!-- start family profile -->
                        <div class="tab-pane fade" id="family-profile" role="tabpanel" aria-labelledby="family-profile-tab">
                            <form class="user" id="spouse_records_form" method="POST" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/spouse-records/add`, `spouse_records_form`, `Add`, `updateSpouseRecordsTable`, `resetSpouseRecordsForm`, `spouse_records_form_submit`, `None`, `None`)">
                                @csrf
                                <div class="bg-blue-500 p-2 uppercase text-white">
                                    <h1>Spouse name</h1>
                                </div>
                                <div class="container-fuild m-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="hidden" id="cesno_spouse_records" name="cesno" class="form-control" @if (str_contains(Request::url(), 'profile/add')) value="{{ $latestCesNo }}" @endif>
                                            <input type="hidden" id="cesno_spouse_records_id" name="cesno_spouse_records_id" class="form-control">
                                            <label class="form-label ml-2 mb-0">Lastname<sup>*</sup></label>
                                            <input type="text" name="lastname_sn_fp" class="form-control w-100 mb-3" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Firstname<sup>*</sup></label>
                                            <input type="text" name="first_sn_fp" class="form-control w-100 mb-3" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Middlename<sup>*</sup></label>
                                            <input type="text" minlength="2" name="middlename_sn_fp" class="noNotallow form-control w-100 mb-3" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label ml-2 mb-0">Name Extension</label>
                                            <select name="ne_sn_fp" class="form-control w-100 mb-3">
                                                <option value="">Please Select</option>
                                                <option value="Jr.">Jr.</option>
                                                <option value="Sr.">Sr.</option>
                                                <option value="I">I</option>
                                                <option value="II">II</option>
                                                <option value="III">III</option>
                                                <option value="IV">IV</option>
                                                <option value="V">V</option>
                                                <option value="VI">VI</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Occupation</label>
                                            <input type="text" class="w-100 form-control mb-3" name="occu_sn_fp" />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Employer / Business Name</label>
                                            <input type="text" class="w-100 form-control mb-3" name="ebn_sn_fp" />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Employer / Business Address</label>
                                            <input type="text" class="w-100 form-control mb-3" name="eba_sn_fp" />
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label ml-2 mb-0">Employer's Telephone No.</label>
                                            <input type="text" class="w-100 form-control mb-3" name="etn_sn_fp" />
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label ml-2 mb-0">Civil Status<sup>*</sup></label>
                                            <select name="civil_status_sn_fp" aria-aria-controls='example' class="w-100 form-control mb-3" required>
                                                <option value="">Please Select</option>
                                                <option value="Married">Married</option>
                                                <option value="Single">Single</option>
                                                <option value="Divorced">Divorced</option>
                                                <option value="Widowed">Widowed</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label ml-2 mb-0">Gender By Birth<sup>*</sup></label>
                                            <select name="gender_sn_fp" aria-aria-controls='example' class="w-100 form-control mb-3" required>
                                                <option value="">Please Select</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label ml-2 mb-0">Birthdate<sup>*</sup></label>
                                            <input type="date" class="mydobs w-100 form-control mb-3" name="birthdate_sn_fp" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label ml-2 mb-0">Age<sup>*</sup></label>
                                            <input type="text" class="ages w-100 form-control mb-3" name="age_sn_fp" readonly />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col my-3">
                                            @if (count($SpouseRecords) === 0)
                                                @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Family Background Profile', 'Add') == 'true')

                                                    <input type="submit" id="spouse_records_form_submit" class="btn btn-primary mb-1" value="Add Record">
                                                @endif
                                            @else
                                                @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Family Background Profile', 'Add') == 'true')

                                                    <input type="submit" id="spouse_records_form_submit" class="btn btn-primary mb-1" value="Add Record" hidden disabled>
                                                    <input type="button" id="spouse_records_form_go_back_to_add_record_button" class="btn btn-info mb-1" value="Go to Add Record" onclick="resetSpouseRecordsForm()">
                                                @elseif(App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Family Background Profile', 'Edit') == 'true')
                                                    <input type="submit" id="spouse_records_form_submit" class="btn btn-secondary mb-1" value="Edit Record" hidden disabled>
                                                @endif
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="overflow-auto">
                                    <table class="table-responsive-lg table-hover table">
                                        <thead class="bg-secondary bg-gardient text-white">
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">Spouse Lastname</th>
                                                <th scope="col">Spouse Firstname</th>
                                                <th scope="col">Spouse Middlename</th>
                                                <th scope="col">Spouse Name Extension</th>
                                                <th scope="col">Spouse Occupation</th>
                                                <th scope="col">Spouse Employer/Business Name</th>
                                                <th scope="col">Spouse Employer/Business Address</th>
                                                <th scope="col">Spouse Employer/Business No.</th>
                                                <th scope="col">Spouse Civil Status</th>
                                                <th scope="col">Spouse Gender</th>
                                                <th scope="col">Spouse Birthdate</th>
                                                <th scope="col">Spouse Age</th>
                                                <th scope="col">Encoded By</th>
                                                <th scope="col">Encoded Date</th>
                                                <th scope="col">Last Updated By</th>
                                                <th scope="col">Last Update Date</th>
                                            </tr>
                                        </thead>
                                        <tbody id="SpouseRecords_tbody">
                                            @if (count($SpouseRecords) === 0)

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
                                                </tr>
                                            @else
                                                @foreach ($SpouseRecords as $item)
                                                    <tr>
                                                        <td>
                                                            <a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetSpouseRecordsForm({{ $item->id }},`View`)">View</a>
                                                            @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Family Background Profile', 'Edit') == 'true')
                                                                <a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetSpouseRecordsForm({{ $item->id }},`Edit`)">Edit</a>
                                                            @endif
                                                            @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Family Background Profile', 'Delete') == 'true')
                                                                <a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`{{ env('APP_URL') }}api/v1/spouse-records/delete/{{ $item->id }}`, `updateSpouseRecordsTable`, `resetSpouseRecordsForm`, `None`, `None`)">Delete</a>
                                                            @endif

                                                        </td>
                                                        <td>{{ $item->lastname_sn_fp ?? '-' }}</td>
                                                        <td>{{ $item->first_sn_fp ?? '-' }}</td>
                                                        <td>{{ $item->middlename_sn_fp ?? '-' }}</td>
                                                        <td>{{ $item->ne_sn_fp ?? '-' }}</td>
                                                        <td>{{ $item->occu_sn_fp ?? '-' }}</td>
                                                        <td>{{ $item->ebn_sn_fp ?? '-' }}</td>
                                                        <td>{{ $item->eba_sn_fp ?? '-' }}</td>
                                                        <td>{{ $item->etn_sn_fp ?? '-' }}</td>
                                                        <td>{{ $item->civil_status_sn_fp ?? '-' }}</td>
                                                        <td>{{ $item->gender_sn_fp ?? '-' }}</td>
                                                        <td>{{ $item->birthdate_sn_fp ?? '-' }}</td>
                                                        <td>{{ $item->age_sn_fp ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ $item->encoder ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->created_at)) ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ $item->last_updated_by ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->updated_at)) ?? '-' }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                            </form>
                            @if (count($FamilyProfile) === 0)

                                <form class="user" id="family_profile_form" method="POST" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/family-profile/add`, `family_profile_form`, `Add`, `updateFamilyProfileTable`, `resetFamilyProfileForm`, `family_profile_form_submit`, `None`, `None`)">
                                @else
                                    <form class="user" id="family_profile_form" method="POST" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/family-profile/edit`, `family_profile_form`, `Update`, `updateFamilyProfileTable`, `resetFamilyProfileForm`, `family_profile_form_submit`, `None`, `None`)">
                            @endif

                            @csrf
                            <div class="bg-blue-500 p-2 uppercase text-white">
                                <h1>Father's name</h1>
                            </div>
                            <div class="container-fuild m-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="hidden" id="cesno_family_profile" name="cesno" class="form-control" @if (str_contains(Request::url(), 'profile/add')) value="{{ $latestCesNo }}" @endif>
                                        <input type="hidden" id="cesno_family_profile_id" name="cesno_family_profile_id" class="form-control">
                                        <label class="form-label ml-2 mb-0">Lastname<sup>*</sup></label>
                                        <input type="text" name="fn_lastname_fp" class="form-control w-100 mb-3" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label ml-2 mb-0">Firstname<sup>*</sup></label>
                                        <input type="text" name="fn_first_fp" class="form-control w-100 mb-3" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label ml-2 mb-0">Middlename<sup>*</sup></label>
                                        <input type="text" minlength="2" name="fn_middlename_fp" class="noNotallow form-control w-100 mb-3" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label ml-2 mb-0">Name Extension</label>
                                        <select name="fn_ne_fp" class="form-control w-100 mb-3">
                                            <option value="">Please Select</option>
                                            <option value="Jr.">Jr.</option>
                                            <option value="Sr.">Sr.</option>
                                            <option value="I">I</option>
                                            <option value="II">II</option>
                                            <option value="III">III</option>
                                            <option value="IV">IV</option>
                                            <option value="V">V</option>
                                            <option value="VI">VI</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-blue-500 p-2 uppercase text-white">
                                <h1>Mothers Maiden name</h1>
                            </div>
                            <div class="container-fuild m-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label ml-2 mb-0">Lastname<sup>*</sup></label>
                                        <input type="text" name="mn_lastname_fp" class="form-control w-100 mb-3" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label ml-2 mb-0">Firstname<sup>*</sup></label>
                                        <input type="text" name="mn_first_fp" class="form-control w-100 mb-3" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label ml-2 mb-0">Middlename<sup>*</sup></label>
                                        <input type="text" minlength="2" name="mn_middlename_fp" class="noNotallow form-control w-100 mb-3" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col my-3">
                                        @if (count($FamilyProfile) === 0)
                                            @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Family Background Profile', 'Add') == 'true')

                                                <input type="submit" id="family_profile_form_submit" class="btn btn-primary mb-1" value="Add Record">
                                            @endif
                                        @else
                                            @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Family Background Profile', 'Edit') == 'true')

                                                <input type="submit" id="family_profile_form_submit" class="btn btn-secondary mb-1" value="Edit Record" hidden disabled>
                                            @endif
                                        @endif

                                    </div>
                                </div>
                            </div>
                            <div class="overflow-auto">
                                <table class="table-responsive-lg table-hover table">
                                    <thead class="bg-secondary bg-gardient text-white">
                                        <tr>
                                            <th scope="col"></th>
                                            <th scope="col">Father Lastname</th>
                                            <th scope="col">Father Firstname</th>
                                            <th scope="col">Father Middlename</th>
                                            <th scope="col">Father Name Extension</th>
                                            <th scope="col">Mother Lastname</th>
                                            <th scope="col">Mother Firstname</th>
                                            <th scope="col">Mother Middlename</th>
                                            <th scope="col">Encoded By</th>
                                            <th scope="col">Encoded Date</th>
                                            <th scope="col">Last Updated By</th>
                                            <th scope="col">Last Update Date</th>
                                        </tr>
                                    </thead>
                                    <tbody id="FamilyProfile_tbody">
                                        @if (count($FamilyProfile) === 0)

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
                                            </tr>
                                        @else
                                            @foreach ($FamilyProfile as $item)
                                                <tr>
                                                    <td>
                                                        <a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetFamilyProfileForm({{ $item->id }},`View`)">View</a>
                                                        @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Family Background Profile', 'Edit') == 'true')
                                                            <a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetFamilyProfileForm({{ $item->id }},`Edit`)">Edit</a>
                                                        @endif

                                                    </td>
                                                    <td>{{ $item->fn_lastname_fp ?? '-' }}</td>
                                                    <td>{{ $item->fn_first_fp ?? '-' }}</td>
                                                    <td>{{ $item->fn_middlename_fp ?? '-' }}</td>
                                                    <td>{{ $item->fn_ne_fp ?? '-' }}</td>
                                                    <td>{{ $item->mn_lastname_fp ?? '-' }}</td>
                                                    <td>{{ $item->mn_first_fp ?? '-' }}</td>
                                                    <td>{{ $item->mn_middlename_fp ?? '-' }}</td>
                                                    <td nowrap="nowrap">{{ $item->encoder ?? '-' }}</td>
                                                    <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->created_at)) ?? '-' }}</td>
                                                    <td nowrap="nowrap">{{ $item->last_updated_by ?? '-' }}</td>
                                                    <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->updated_at)) ?? '-' }}</td>
                                                </tr>
                                            @endforeach
                                        @endif

                                    </tbody>
                                </table>
                            </div>
                            </form>
                            <form class="user" id="children_record_form" method="POST" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/children-records/add`, `children_record_form`, `Add`, `updateChildrenRecordsTable`, `resetChildrenRecordsForm`, `children_record_form_submit`, `None`, `None`)">
                                @csrf
                                <div class="bg-blue-500 p-2 uppercase text-white">
                                    <h1>Childrens record</h1>
                                </div>
                                <div class="container-fuild m-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="hidden" id="cesno_children_record" name="cesno" class="form-control" @if (str_contains(Request::url(), 'profile/add')) value="{{ $latestCesNo }}" @endif>
                                            <input type="hidden" id="cesno_children_record_id" name="cesno_children_record_id" class="form-control">
                                            <label class="form-label ml-2 mb-0">Lastname<sup>*</sup></label>
                                            <input type="text" name="ch_lastname_fp" class="form-control w-100 mb-3" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Firstname<sup>*</sup></label>
                                            <input type="text" name="ch_first_fp" class="form-control w-100 mb-3" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Middlename<sup>*</sup></label>
                                            <input type="text" minlength="2" name="ch_middlename_fp" class="noNotallow form-control w-100 mb-3" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label ml-2 mb-0">Name Extension</label>
                                            <select name="ch_ne_fp" class="form-control w-100 mb-3">
                                                <option value="">Please Select</option>
                                                <option value="Jr.">Jr.</option>
                                                <option value="Sr.">Sr.</option>
                                                <option value="I">I</option>
                                                <option value="II">II</option>
                                                <option value="III">III</option>
                                                <option value="IV">IV</option>
                                                <option value="V">V</option>
                                                <option value="VI">VI</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label ml-2 mb-0">Gender By Birth<sup>*</sup></label>
                                            <select name="ch_gender_fp" aria-aria-controls='example' class="w-100 form-control mb-3" required>
                                                <option value="">Please Select</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label ml-2 mb-0">Birthdate<sup>*</sup></label>
                                            <input type="date" class="mydob w-100 form-control mb-3" name="ch_birthdate_fp" required>
                                        </div>
                                        <div class="col-md-9">
                                            <label class="form-label ml-2 mb-0">Birth Place</label>
                                            <input type="text" class="w-100 form-control mb-3" name="ch_birthplace_fp" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col my-3">
                                            @if (count($ChildrenRecords) === 0)
                                                @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Family Background Profile', 'Add') == 'true')

                                                    <input type="submit" id="children_record_form_submit" class="btn btn-primary mb-1" value="Add Record">
                                                    <input type="button" id="children_record_form_go_back_to_add_record_button" class="btn btn-info mb-1" value="Go to Add Record" onclick="resetChildrenRecordsForm()" hidden>
                                                @endif
                                            @else
                                                @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Family Background Profile', 'Add') == 'true')

                                                    <input type="submit" id="children_record_form_submit" class="btn btn-primary mb-1" value="Add Record" hidden disabled>
                                                    <input type="button" id="children_record_form_go_back_to_add_record_button" class="btn btn-info mb-1" value="Go to Add Record" onclick="resetChildrenRecordsForm()">
                                                @elseif(App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Family Background Profile', 'Edit') == 'true')
                                                    <input type="submit" id="children_record_form_submit" class="btn btn-secondary mb-1" value="Edit Record" hidden disabled>
                                                @endif
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="overflow-auto">
                                    <table class="table-responsive-lg table-hover table">
                                        <thead class="bg-secondary bg-gardient text-white">
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">Lastname</th>
                                                <th scope="col">Firstname</th>
                                                <th scope="col">Middlename</th>
                                                <th scope="col">Name Extension</th>
                                                <th scope="col">Gender By Birth</th>
                                                <th scope="col">Birthdate</th>
                                                <th scope="col">Birth Place</th>
                                                <th scope="col">Encoded By</th>
                                                <th scope="col">Encoded Date</th>
                                                <th scope="col">Last Updated By</th>
                                                <th scope="col">Last Update Date</th>
                                            </tr>
                                        </thead>
                                        <tbody id="ChildrenRecords_tbody">
                                            @if (count($ChildrenRecords) === 0)

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
                                                </tr>
                                            @else
                                                @foreach ($ChildrenRecords as $item)
                                                    <tr>
                                                        <td>
                                                            <a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetChildrenRecordsForm({{ $item->id }},`View`)">View</a>
                                                            @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Family Background Profile', 'Edit') == 'true')
                                                                <a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetChildrenRecordsForm({{ $item->id }},`Edit`)">Edit</a>
                                                            @endif
                                                            @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Family Background Profile', 'Delete') == 'true')
                                                                <a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`{{ env('APP_URL') }}api/v1/children-records/delete/{{ $item->id }}`, `updateChildrenRecordsTable`, `resetChildrenRecordsForm`, `None`, `None`)">Delete</a>
                                                            @endif

                                                        </td>
                                                        <td>{{ $item->ch_lastname_fp ?? '-' }}</td>
                                                        <td>{{ $item->ch_first_fp ?? '-' }}</td>
                                                        <td>{{ $item->ch_middlename_fp ?? '-' }}</td>
                                                        <td>{{ $item->ch_ne_fp ?? '-' }}</td>
                                                        <td>{{ $item->ch_gender_fp ?? '-' }}</td>
                                                        <td>{{ $item->ch_birthdate_fp ?? '-' }}</td>
                                                        <td>{{ $item->ch_birthplace_fp ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ $item->encoder ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->created_at)) ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ $item->last_updated_by ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->updated_at)) ?? '-' }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                        <!-- end family profile -->
                    @endif
                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Educational Background or Attainment', 'Category Only') == 'true')

                        <!-- start educational attainment -->
                        <div class="tab-pane fade" id="educational_attainment" role="tabpanel" aria-labelledby="educational_attainment-tab">
                            <form class="user" id="educational_attainment_form" method="POST" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/educational-attainment/add`, `educational_attainment_form`, `Add`, `updateEducationalAttainmentTable`, `resetEducationalAttainmentForm`, `educational_attainment_form_submit`, `None`, `None`)">
                                @csrf
                                <div class="bg-blue-500 p-2 uppercase text-white">
                                    <h1>HISTORICAL RECORD OF EDUCATION BACKGROUND / ATTAINMENT</h1>
                                </div>
                                <div class="container-fuild m-3">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <input type="hidden" id="cesno_educational_attainment" name="cesno" class="form-control" @if (str_contains(Request::url(), 'profile/add')) value="{{ $latestCesNo }}" @endif>
                                            <input type="hidden" id="cesno_educational_attainment_id" name="cesno_educational_attainment_id" class="form-control">
                                            <label class="form-label ml-2 mb-0">Level<sup>*</sup></label>
                                            <select name="level_ea" class="form-control w-100 mb-3" required>
                                                <option value="">Please Select</option>
                                                <option value="Elementary">Elementary</option>
                                                <option value="Secondary">Secondary</option>
                                                <option value="Vocational/Trade Course">Vocational/Trade Course</option>
                                                <option value="College">College</option>
                                                <option value="Graduate Studies">Graduate Studies</option>
                                                <option value="Others">Others</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label ml-2 mb-0">School<sup>*</sup></label>
                                            <select name="school_ea" class="form-control w-100 mb-3" required>
                                                <option value="">Please Select</option>
                                                @foreach ($School as $item)
                                                    <option value="{{ $item->CODE }}">{{ $item->SCHOOL }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label ml-2 mb-0">Degree<sup>*</sup></label>
                                            <select name="degree_ea" class="form-control w-100 mb-3" required>
                                                <option value="">Please Select</option>
                                                @foreach ($Degree as $item)
                                                    <option value="{{ $item->CODE }}">{{ $item->DEGREE }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label ml-2 mb-0">Year Graduated<sup>*</sup></label>
                                            <input type="year" name="date_grad_ea" id="onlyYear" class="form-control w-100 mb-3" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Major / Specialization<sup>*</sup></label>
                                            <select name="ms_ea" class="form-control w-100 mb-3" required>
                                                <option value="">Please Select</option>
                                                @foreach ($CourseMajor as $item)
                                                    <option value="{{ $item->CODE }}">{{ $item->COURSE }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">School Type / Status<sup>*</sup></label>
                                            <select name="school_type_ea" aria-aria-controls='example' class="date-picker w-100 form-control mb-3" required>
                                                <option value="">Please Select</option>
                                                <option value="Local">Local</option>
                                                <option value="Foreign">Foreign</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Period of Attendance From<sup>*</sup></label>
                                            <input type="date" name="date_f_ea" class="form-control w-100 mb-3" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Period of Attendance To<sup>*</sup></label>
                                            <input type="date" name="date_t_ea" class="form-control w-100 mb-3" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Heighest Level / Unit Earned<sup>*</sup></label>
                                            <input type="text" name="hlu_ea" class="form-control w-100 mb-3" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Academic Honors Received</label>
                                            <input type="text" name="ahr_ea" class="form-control w-100 mb-3">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col my-4">
                                            @if (count($EducationalAttainment) === 0)
                                                @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Educational Background or Attainment', 'Add') == 'true')

                                                    <input type="submit" id="educational_attainment_form_submit" class="btn btn-primary mb-1" value="Add Record">
                                                @endif
                                            @else
                                                @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Educational Background or Attainment', 'Add') == 'true')

                                                    <input type="submit" id="educational_attainment_form_submit" class="btn btn-primary mb-1" value="Add Record" hidden disabled>
                                                    <input type="button" id="educational_attainment_form_go_back_to_add_record_button" class="btn btn-info mb-1" value="Go to Add Record" onclick="resetEducationalAttainmentForm()">
                                                @elseif(App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Educational Background or Attainment', 'Edit') == 'true')
                                                    <input type="submit" id="educational_attainment_form_submit" class="btn btn-secondary mb-1" value="Edit Record" hidden disabled>
                                                @endif
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="overflow-auto">
                                    <table class="table-responsive-lg table-hover table">
                                        <thead class="bg-secondary bg-gardient text-white">
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">Level</th>
                                                <th scope="col">School</th>
                                                <th scope="col">Degree</th>
                                                <th scope="col">Year Graduate</th>
                                                <th scope="col">Major/Specialization</th>
                                                <th scope="col">School Type/Status</th>
                                                <th scope="col">Period of Attendance From</th>
                                                <th scope="col">Period of Attendance To</th>
                                                <th scope="col">Heighest Level/Unit Earned</th>
                                                <th scope="col">Academic Honors Received</th>
                                                <th scope="col">Encoded By</th>
                                                <th scope="col">Encoded Date</th>
                                                <th scope="col">Last Updated By</th>
                                                <th scope="col">Last Update Date</th>
                                            </tr>
                                        </thead>
                                        <tbody id="EducationalAttainment_tbody">
                                            @if (count($EducationalAttainment) === 0)

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
                                                </tr>
                                            @else
                                                @foreach ($EducationalAttainment as $item)
                                                    <tr>
                                                        <td>
                                                            <a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetEducationalAttainmentForm({{ $item->id }},`View`)">View</a>
                                                            @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Educational Background or Attainment', 'Edit') == 'true')
                                                                <a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetEducationalAttainmentForm({{ $item->id }},`Edit`)">Edit</a>
                                                            @endif
                                                            @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Educational Background or Attainment', 'Delete') == 'true')
                                                                <a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`{{ env('APP_URL') }}api/v1/educational-attainment/delete/{{ $item->id }}`, `updateEducationalAttainmentTable`, `resetEducationalAttainmentForm`, `None`, `None`)">Delete</a>
                                                            @endif

                                                        </td>
                                                        <td>{{ $item->level_ea ?? '-' }}</td>
                                                        <td>{{ $item->school_ea ?? '-' }}</td>
                                                        <td>{{ $item->degree_ea ?? '-' }}</td>
                                                        <td>{{ $item->date_grad_ea ?? '-' }}</td>
                                                        <td>{{ $item->ms_ea ?? '-' }}</td>
                                                        <td>{{ $item->school_type_ea ?? '-' }}</td>
                                                        <td>{{ $item->date_f_ea ?? '-' }}</td>
                                                        <td>{{ $item->date_t_ea ?? '-' }}</td>
                                                        <td>{{ $item->hlu_ea ?? '-' }}</td>
                                                        <td>{{ $item->ahr_ea ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ $item->encoder ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->created_at)) ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ $item->last_updated_by ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->updated_at)) ?? '-' }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                        <!-- end educational attainment -->
                    @endif
                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Examinations Taken', 'Category Only') == 'true')

                        <!-- start examination taken -->
                        <div class="tab-pane fade" id="examinations_taken" role="tabpanel" aria-labelledby="examinations_taken-tab">
                            <form class="user" id="examinations_taken_historical_record_of_examinations_taken_form" method="POST" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/examination-taken/add`, `examinations_taken_historical_record_of_examinations_taken_form`, `Add`, `updateExaminationsTakenTable`, `resetExaminationsTakenForm`, `examinations_taken_historical_record_of_examinations_taken_form_submit`, `None`, `None`)">
                                @csrf
                                <div class="bg-blue-500 p-2 uppercase text-white">
                                    <h1>HISTORICAL RECORDS OF EXAMINATIONS TAKEN</h1>
                                </div>
                                <div class="container-fuild m-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="hidden" id="cesno_examinations_taken_historical_records" name="cesno" class="form-control" @if (str_contains(Request::url(), 'profile/add')) value="{{ $latestCesNo }}" @endif>
                                            <input type="hidden" id="cesno_examinations_taken_historical_records_id" name="cesno_examinations_taken_historical_records_id" class="form-control">
                                            <label class="form-label ml-2 mb-0">Type of Examination<sup>*</sup></label>
                                            <select name="tox_et" class="form-control w-100 mb-3" required>
                                                <option value="">Please Select</option>
                                                @foreach ($ExaminationReference as $item)
                                                    <option value="{{ $item->TITLE }}">{{ $item->TITLE }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Rating<sup>*</sup></label>
                                            <input type="text" name="rating_et" class="form-control mb-3" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Date of Examination<sup>*</sup></label>
                                            <input type="date" name="doe_et" class="form-control mb-3" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Place of Examination<sup>*</sup></label>
                                            <input type="text" name="poe_et" class="form-control mb-3" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col my-3">
                                            @if (count($ExaminationsTaken) === 0)
                                                @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Examinations Taken', 'Add') == 'true')

                                                    <input type="submit" id="examinations_taken_historical_record_of_examinations_taken_form_submit" class="btn btn-primary mb-1" value="Add Record">
                                                @endif
                                            @else
                                                @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Examinations Taken', 'Add') == 'true')

                                                    <input type="submit" id="examinations_taken_historical_record_of_examinations_taken_form_submit" class="btn btn-primary mb-1" value="Add Record" hidden disabled>
                                                    <input type="button" id="examinations_taken_historical_record_of_examinations_taken_form_go_back_to_add_record_button" class="btn btn-info mb-1" value="Go to Add Record" onclick="resetExaminationsTakenForm()">
                                                @elseif(App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Examinations Taken', 'Edit') == 'true')
                                                    <input type="submit" id="examinations_taken_historical_record_of_examinations_taken_form_submit" class="btn btn-secondary mb-1" value="Edit Record" hidden disabled>
                                                @endif
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="overflow-auto">
                                    <table class="table-responsive-lg table-hover table">
                                        <thead class="bg-secondary bg-gardient text-white">
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">Type of Examination</th>
                                                <th scope="col">Rating</th>
                                                <th scope="col">Date of Examination</th>
                                                <th scope="col">Place of Examination</th>
                                                <th scope="col">Encoded By</th>
                                                <th scope="col">Encoded Date</th>
                                                <th scope="col">Last Updated By</th>
                                                <th scope="col">Last Update Date</th>
                                            </tr>
                                        </thead>
                                        <tbody id="ExaminationsTaken_tbody">
                                            @if (count($ExaminationsTaken) === 0)

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
                                                </tr>
                                            @else
                                                @foreach ($ExaminationsTaken as $item)
                                                    <tr>
                                                        <td>
                                                            <a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetExaminationsTakenForm({{ $item->id }},`View`)">View</a>
                                                            @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Examinations Taken', 'Edit') == 'true')
                                                                <a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetExaminationsTakenForm({{ $item->id }},`Edit`)">Edit</a>
                                                            @endif
                                                            @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Examinations Taken', 'Delete') == 'true')
                                                                <a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`{{ env('APP_URL') }}api/v1/examination-taken/delete/{{ $item->id }}`, `updateExaminationsTakenTable`, `resetExaminationsTakenForm`, `None`, `None`)">Delete</a>
                                                            @endif

                                                        </td>
                                                        <td>{{ $item->tox_et ?? '-' }}</td>
                                                        <td>{{ $item->rating_et ?? '-' }}</td>
                                                        <td>{{ $item->doe_et ?? '-' }}</td>
                                                        <td>{{ $item->poe_et ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ $item->encoder ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->created_at)) ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ $item->last_updated_by ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->updated_at)) ?? '-' }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                            </form>
                            <form class="user" id="examinations_taken_license_details_form" method="POST" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/license-details/add`, `examinations_taken_license_details_form`, `Add`, `updateLicenseDetailsTable`, `resetLicenseDetailsForm`, `examinations_taken_license_details_form_submit`, `None`, `None`)">
                                @csrf
                                <div class="bg-blue-500 p-2 uppercase text-white">
                                    <h1>LICENSE DETAILS</h1>
                                </div>

                                <div class="container-fuild m-3">
                                    <div class="row g-2">
                                        <div class="col-md-4">
                                            <input type="hidden" id="cesno_examinations_taken_license_details" name="cesno" class="form-control" @if (str_contains(Request::url(), 'profile/add')) value="{{ $latestCesNo }}" @endif>
                                            <input type="hidden" id="cesno_examinations_taken_license_details_id" name="cesno_examinations_taken_license_details_id" class="form-control">
                                            <label class="form-label ml-2 mb-0">License Number<sup>*</sup></label>
                                            <input type="text" name="ld_ln_et" class="form-control mb-3" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label ml-2 mb-0">Date Acquired<sup>*</sup></label>
                                            <input type="date" name="ld_da_et" class="form-control mb-3" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label ml-2 mb-0">Date of Validity<sup>*</sup></label>
                                            <input type="date" name="ld_dov_et" class="form-control mb-3" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col my-3">
                                            @if (count($LicenseDetails) === 0)
                                                @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Examinations Taken', 'Add') == 'true')

                                                    <input type="submit" id="examinations_taken_license_details_form_submit" class="btn btn-primary mb-1" value="Add Record">
                                                @endif
                                            @else
                                                @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Examinations Taken', 'Add') == 'true')

                                                    <input type="submit" id="examinations_taken_license_details_form_submit" class="btn btn-primary mb-1" value="Add Record" hidden disabled>
                                                    <input type="button" id="examinations_taken_license_details_form_go_back_to_add_record_button" class="btn btn-info mb-1" value="Go to Add Record" onclick="resetLicenseDetailsForm()">
                                                @elseif(App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Examinations Taken', 'Edit') == 'true')
                                                    <input type="submit" id="examinations_taken_license_details_form_submit" class="btn btn-secondary mb-1" value="Edit Record" hidden disabled>
                                                @endif
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="overflow-auto">
                                    <table class="table-responsive-lg table-hover table">
                                        <thead class="bg-secondary bg-gardient text-white">
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">License Number</th>
                                                <th scope="col">Date Acquired</th>
                                                <th scope="col">Date of Validity</th>
                                                <th scope="col">Encoded By</th>
                                                <th scope="col">Encoded Date</th>
                                                <th scope="col">Last Updated By</th>
                                                <th scope="col">Last Update Date</th>
                                            </tr>
                                        </thead>
                                        <tbody id="LicenseDetails_tbody">
                                            @if (count($LicenseDetails) === 0)

                                                <tr>
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
                                                @foreach ($LicenseDetails as $item)
                                                    <tr>
                                                        <td>
                                                            <a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetLicenseDetailsForm({{ $item->id }},`View`)">View</a>
                                                            @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Examinations Taken', 'Edit') == 'true')
                                                                <a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetLicenseDetailsForm({{ $item->id }},`Edit`)">Edit</a>
                                                            @endif
                                                            @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Examinations Taken', 'Delete') == 'true')
                                                                <a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`{{ env('APP_URL') }}api/v1/license-details/delete/{{ $item->id }}`, `updateLicenseDetailsTable`, `resetLicenseDetailsForm`, `None`, `None`)">Delete</a>
                                                            @endif

                                                        </td>
                                                        <td>{{ $item->ld_ln_et ?? '-' }}</td>
                                                        <td>{{ $item->ld_da_et ?? '-' }}</td>
                                                        <td>{{ $item->ld_dov_et ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ $item->encoder ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->created_at)) ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ $item->last_updated_by ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->updated_at)) ?? '-' }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                        <!-- end examination taken -->
                    @endif
                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Language Dialects', 'Category Only') == 'true')

                        <!-- start languages dialects -->
                        <div class="tab-pane fade" id="languages_dialects" role="tabpanel" aria-labelledby="languages_dialects-tab">
                            <form class="user" id="languages_dialects_form" method="POST" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/languages-dialects/add`, `languages_dialects_form`, `Add`, `updateLanguagesDialectsTable`, `resetLanguagesDialectsForm`, `languages_dialects_form_submit`, `None`, `None`)">
                                @csrf
                                <div class="bg-blue-500 p-2 uppercase text-white">
                                    <h1>LANGUAGES / DIALECTS</h1>
                                </div>

                                <div class="container-fuild m-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="hidden" id="cesno_languages_dialects" name="cesno" class="form-control" @if (str_contains(Request::url(), 'profile/add')) value="{{ $latestCesNo }}" @endif>
                                            <input type="hidden" id="cesno_languages_dialects_id" name="cesno_languages_dialects_id" class="form-control">
                                            <label class="form-label ml-2 mb-0">Languages<sup>*</sup></label>
                                            <select name="lang_languages_dialects" class="form-control w-100 mb-3" required>
                                                <option value="">Please Select</option>
                                                @foreach ($LanguageDialects as $item)
                                                    <option value="{{ $item->title }}">{{ $item->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col my-3">
                                            @if (count($LanguagesDialects) === 0)
                                                @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Language Dialects', 'Add') == 'true')

                                                    <input type="submit" id="languages_dialects_form_submit" class="btn btn-primary mb-1" value="Add Record">
                                                @endif
                                            @else
                                                @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Language Dialects', 'Add') == 'true')

                                                    <input type="submit" id="languages_dialects_form_submit" class="btn btn-primary mb-1" value="Add Record" hidden disabled>
                                                    <input type="button" id="languages_dialects_form_go_back_to_add_record_button" class="btn btn-info mb-1" value="Go to Add Record" onclick="resetLanguagesDialectsForm()">
                                                @elseif(App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Language Dialects', 'Edit') == 'true')
                                                    <input type="submit" id="languages_dialects_form_submit" class="btn btn-secondary mb-1" value="Edit Record" hidden disabled>
                                                @endif
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="overflow-auto">
                                    <table class="table-responsive-lg table-hover table">
                                        <thead class="bg-secondary bg-gardient text-white">
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">Languages / Dialects</th>
                                                <th scope="col">Encoded By</th>
                                                <th scope="col">Encoded Date</th>
                                                <th scope="col">Last Updated By</th>
                                                <th scope="col">Last Update Date</th>
                                            </tr>
                                        </thead>
                                        <tbody id="LanguagesDialects_tbody">
                                            @if (count($LanguagesDialects) === 0)

                                                <tr>
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                </tr>
                                            @else
                                                @foreach ($LanguagesDialects as $item)
                                                    <tr>
                                                        <td>
                                                            <a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetLanguagesDialectsForm({{ $item->id }},`View`)">View</a>
                                                            @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Language Dialects', 'Edit') == 'true')
                                                                <a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetLanguagesDialectsForm({{ $item->id }},`Edit`)">Edit</a>
                                                            @endif
                                                            @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Language Dialects', 'Delete') == 'true')
                                                                <a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`{{ env('APP_URL') }}api/v1/languages-dialects/delete/{{ $item->id }}`, `updateLanguagesDialectsTable`, `resetLanguagesDialectsForm`, `None`, `None`)">Delete</a>
                                                            @endif

                                                        </td>
                                                        <td>{{ $item->lang_languages_dialects ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ $item->encoder ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->created_at)) ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ $item->last_updated_by ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->updated_at)) ?? '-' }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                        <!-- end languages dialects -->
                    @endif
                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker', 'Category Only') == 'true')

                        <!-- start eligibility and rank tracker -->
                        <div class="tab-pane fade" id="eligibility_and_rank_tracker" role="tabpanel" aria-labelledby="eligibility_and_rank_tracker-tab">
                            <form class="user" id="ceswe_hr_form" method="POST" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/ces-we/add`, `ceswe_hr_form`, `Add`, `updateCesWeTable`, `resetCesWeForm`, `ceswe_hr_form_submit`, `None`, `None`)">
                                @csrf
                                <div class="mb-3 bg-blue-500 p-2 uppercase text-white">
                                    <h1>CES WE ( HISTORICAL RECORD )</h1>
                                </div>
                                <div class="container-fuild m-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="hidden" id="cesno_ceswe_hr" name="cesno" class="form-control" @if (str_contains(Request::url(), 'profile/add')) value="{{ $latestCesNo }}" @endif>
                                            <input type="hidden" id="cesno_ceswe_hr_id" name="cesno_ceswe_hr_id" class="form-control">
                                            <label class="form-label ml-2 mb-0">Examination Date<sup>*</sup></label>
                                            <input type="date" class="form-control w-100 mb-3" name="ed_ces_we" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Rating<sup>*</sup></label>
                                            <input type="text" class="form-control w-100 mb-3" name="r_ces_we" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Rating Definition<sup>*</sup></label>
                                            <select name="rd_ces_we" class="form-control w-100 mb-3" required>
                                                <option value="">Please Select</option>
                                                <option value="Pass">Pass</option>
                                                <option value="Fail">Fail</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Place of Examination<sup>*</sup></label>
                                            <input type="text" class="form-control w-100 mb-3" name="poe_ces_we" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Take No.<sup>*</sup></label>
                                            <input type="text" class="form-control w-100 mb-3" name="tn_ces_we" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col my-3">
                                            @if (count($CesWe) === 0)
                                                @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker', 'Add') == 'true')

                                                    <input type="submit" id="ceswe_hr_form_submit" class="btn btn-primary mb-1" value="Add Record">
                                                @endif
                                            @else
                                                @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker', 'Add') == 'true')

                                                    <input type="submit" id="ceswe_hr_form_submit" class="btn btn-primary mb-1" value="Add Record" hidden disabled>
                                                    <input type="button" id="ceswe_hr_form_go_back_to_add_record_button" class="btn btn-info mb-1" value="Go to Add Record" onclick="resetCesWeForm()">
                                                @elseif(App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker', 'Edit') == 'true')
                                                    <input type="submit" id="ceswe_hr_form_submit" class="btn btn-secondary mb-1" value="Edit Record" hidden disabled>
                                                @endif
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="overflow-auto">
                                    <table class="table-responsive-lg table-hover table">
                                        <thead class="bg-secondary bg-gardient text-white">
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">Examination Date</th>
                                                <th scope="col">Rating</th>
                                                <th scope="col">Rating Definition</th>
                                                <th scope="col">Place of Examination</th>
                                                <th scope="col">Take No.</th>
                                                <th scope="col">Encoded By</th>
                                                <th scope="col">Encoded Date</th>
                                                <th scope="col">Last Updated By</th>
                                                <th scope="col">Last Update Date</th>
                                            </tr>
                                        </thead>
                                        <tbody id="CesWe_tbody">
                                            @if (count($CesWe) === 0)

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
                                                </tr>
                                            @else
                                                @foreach ($CesWe as $item)
                                                    <tr>
                                                        <td>
                                                            <a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetCesWeForm({{ $item->id }},`View`)">View</a>
                                                            @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker', 'Edit') == 'true')
                                                                <a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetCesWeForm({{ $item->id }},`Edit`)">Edit</a>
                                                            @endif
                                                            @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker', 'Delete') == 'true')
                                                                <a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`{{ env('APP_URL') }}api/v1/ces-we/delete/{{ $item->id }}`, `updateCesWeTable`, `resetCesWeForm`, `None`, `None`)">Delete</a>
                                                            @endif

                                                        </td>
                                                        <td>{{ $item->ed_ces_we ?? '-' }}</td>
                                                        <td>{{ $item->r_ces_we ?? '-' }}</td>
                                                        <td>{{ $item->rd_ces_we ?? '-' }}</td>
                                                        <td>{{ $item->poe_ces_we ?? '-' }}</td>
                                                        <td>{{ $item->tn_ces_we ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ $item->encoder ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->created_at)) ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ $item->last_updated_by ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->updated_at)) ?? '-' }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                            </form>
                            <form class="user" id="assessment_center_hr_form" method="POST" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/assessment-center/add`, `assessment_center_hr_form`, `Add`, `updateAssessmentCenterTable`, `resetAssessmentCenterForm`, `assessment_center_hr_form_submit`, `None`, `None`)">
                                @csrf
                                <div class="mb-3 bg-blue-500 p-2 uppercase text-white">
                                    <h1>ASSESSMENT CENTER ( HISTORICAL RECORD )</h1>
                                </div>
                                <div class="container-fuild m-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="hidden" id="cesno_assessment_center_hr" name="cesno" class="form-control" @if (str_contains(Request::url(), 'profile/add')) value="{{ $latestCesNo }}" @endif>
                                            <input type="hidden" id="cesno_assessment_center_hr_id" name="cesno_assessment_center_hr_id" class="form-control">
                                            <label class="form-label ml-2 mb-0">AC No.<sup>*</sup></label>
                                            <input type="text" class="form-control w-100 mb-3" name="an_achr_ces_we" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Assessment Date<sup>*</sup></label>
                                            <input type="date" class="form-control w-100 mb-3" name="ad_achr_ces_we" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Rating<sup>*</sup></label>
                                            <select name="r_achr_ces_we" class="form-control w-100 mb-3" required>
                                                <option value="">Please Select</option>
                                                <option value="Pass">Pass</option>
                                                <option value="Fail">Fail</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Competencies for D.O</label>
                                            <input type="text" class="form-control w-100 mb-3" name="cfd_achr_ces_we" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col my-3">
                                            @if (count($AssessmentCenter) === 0)
                                                @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker', 'Add') == 'true')

                                                    <input type="submit" id="assessment_center_hr_form_submit" class="btn btn-primary mb-1" value="Add Record">
                                                @endif
                                            @else
                                                @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker', 'Add') == 'true')

                                                    <input type="submit" id="assessment_center_hr_form_submit" class="btn btn-primary mb-1" value="Add Record" hidden disabled>
                                                    <input type="button" id="assessment_center_hr_form_go_back_to_add_record_button" class="btn btn-info mb-1" value="Go to Add Record" onclick="resetAssessmentCenterForm()">
                                                @elseif(App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker', 'Edit') == 'true')
                                                    <input type="submit" id="assessment_center_hr_form_submit" class="btn btn-secondary mb-1" value="Edit Record" hidden disabled>
                                                @endif
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="overflow-auto">
                                    <table class="table-responsive-lg table-hover table">
                                        <thead class="bg-secondary bg-gardient text-white">
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">Ac No.</th>
                                                <th scope="col">Assessment Date</th>
                                                <th scope="col">Rating</th>
                                                <th scope="col">Competencies</th>
                                                <th scope="col">Encoded By</th>
                                                <th scope="col">Encoded Date</th>
                                                <th scope="col">Last Updated By</th>
                                                <th scope="col">Last Update Date</th>
                                            </tr>
                                        </thead>
                                        <tbody id="AssessmentCenter_tbody">
                                            @if (count($AssessmentCenter) === 0)

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
                                                </tr>
                                            @else
                                                @foreach ($AssessmentCenter as $item)
                                                    <tr>
                                                        <td>
                                                            <a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetAssessmentCenterForm({{ $item->id }},`View`)">View</a>
                                                            @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker', 'Edit') == 'true')
                                                                <a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetAssessmentCenterForm({{ $item->id }},`Edit`)">Edit</a>
                                                            @endif
                                                            @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker', 'Delete') == 'true')
                                                                <a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`{{ env('APP_URL') }}api/v1/assessment-center/delete/{{ $item->id }}`, `updateAssessmentCenterTable`, `resetAssessmentCenterForm`, `None`, `None`)">Delete</a>
                                                            @endif

                                                        </td>
                                                        <td>{{ $item->an_achr_ces_we ?? '-' }}</td>
                                                        <td>{{ $item->ad_achr_ces_we ?? '-' }}</td>
                                                        <td>{{ $item->r_achr_ces_we ?? '-' }}</td>
                                                        <td>{{ $item->cfd_achr_ces_we ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ $item->encoder ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->created_at)) ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ $item->last_updated_by ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->updated_at)) ?? '-' }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                            </form>
                            <form class="user" id="validation_hr_form" method="POST" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/validation-hr/add`, `validation_hr_form`, `Add`, `updateValidationHrTable`, `resetValidationHrForm`, `validation_hr_form_submit`, `None`, `None`)">
                                @csrf
                                <div class="mb-3 bg-blue-500 p-2 uppercase text-white">
                                    <h1>VALIDATION ( HISTORICAL RECORD )</h1>
                                </div>
                                <div class="container-fuild m-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="hidden" id="cesno_validation_hr" name="cesno" class="form-control" @if (str_contains(Request::url(), 'profile/add')) value="{{ $latestCesNo }}" @endif>
                                            <input type="hidden" id="cesno_validation_hr_id" name="cesno_validation_hr_id" class="form-control">
                                            <label class="form-label ml-2 mb-0">Validation Date<sup>*</sup></label>
                                            <input type="date" class="form-control w-100 mb-3" name="vd_vhr_ces_we" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Type of Validation<sup>*</sup></label>
                                            <select name="tov_vhr_ces_we" class="form-control w-100 mb-3" required>
                                                <option value="">Please Select</option>
                                                <option value="In-Dept">In-Dept</option>
                                                <option value="Rapid">Rapid</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Result<sup>*</sup></label>
                                            <select name="r_vhr_ces_we" class="form-control w-100 mb-3" required>
                                                <option value="">Please Select</option>
                                                <option value="Pass">Pass</option>
                                                <option value="Fail">Fail</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col my-3">
                                            @if (count($ValidationHr) === 0)
                                                @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker', 'Add') == 'true')

                                                    <input type="submit" id="validation_hr_form_submit" class="btn btn-primary mb-1" value="Add Record">
                                                @endif
                                            @else
                                                @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker', 'Add') == 'true')

                                                    <input type="submit" id="validation_hr_form_submit" class="btn btn-primary mb-1" value="Add Record" hidden disabled>
                                                    <input type="button" id="validation_hr_form_go_back_to_add_record_button" class="btn btn-info mb-1" value="Go to Add Record" onclick="resetValidationHrForm()">
                                                @elseif(App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker', 'Edit') == 'true')
                                                    <input type="submit" id="validation_hr_form_submit" class="btn btn-secondary mb-1" value="Edit Record" hidden disabled>
                                                @endif
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="overflow-auto">
                                    <table class="table-responsive-lg table-hover table">
                                        <thead class="bg-secondary bg-gardient text-white">
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">Validation Date</th>
                                                <th scope="col">Type of Validation</th>
                                                <th scope="col">Result</th>
                                                <th scope="col">Encoded By</th>
                                                <th scope="col">Encoded Date</th>
                                                <th scope="col">Last Updated By</th>
                                                <th scope="col">Last Update Date</th>
                                            </tr>
                                        </thead>
                                        <tbody id="ValidationHr_tbody">
                                            @if (count($ValidationHr) === 0)

                                                <tr>
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
                                                @foreach ($ValidationHr as $item)
                                                    <tr>
                                                        <td>
                                                            <a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetValidationHrForm({{ $item->id }},`View`)">View</a>
                                                            @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker', 'Edit') == 'true')
                                                                <a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetValidationHrForm({{ $item->id }},`Edit`)">Edit</a>
                                                            @endif
                                                            @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker', 'Delete') == 'true')
                                                                <a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`{{ env('APP_URL') }}api/v1/validation-hr/delete/{{ $item->id }}`, `updateValidationHrTable`, `resetValidationHrForm`, `None`, `None`)">Delete</a>
                                                            @endif

                                                        </td>
                                                        <td>{{ $item->vd_vhr_ces_we ?? '-' }}</td>
                                                        <td>{{ $item->tov_vhr_ces_we ?? '-' }}</td>
                                                        <td>{{ $item->r_vhr_ces_we ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ $item->encoder ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->created_at)) ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ $item->last_updated_by ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->updated_at)) ?? '-' }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                            </form>
                            <form class="user" id="board_interview_hr_form" method="POST" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/board-interview/add`, `board_interview_hr_form`, `Add`, `updateBoardInterviewTable`, `resetBoardInterviewForm`, `board_interview_hr_form_submit`, `None`, `None`)">
                                @csrf
                                <div class="mb-3 bg-blue-500 p-2 uppercase text-white">
                                    <h1>BOARD INTERVIEW</h1>
                                </div>
                                <div class="container-fuild m-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="hidden" id="cesno_board_interview_hr" name="cesno" class="form-control" @if (str_contains(Request::url(), 'profile/add')) value="{{ $latestCesNo }}" @endif>
                                            <input type="hidden" id="cesno_board_interview_hr_id" name="cesno_board_interview_hr_id" class="form-control">
                                            <label class="form-label ml-2 mb-0">Board Interview Date<sup>*</sup></label>
                                            <input type="date" class="form-control w-100 mb-3" name="bid_bi_ces_we" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Rating<sup>*</sup></label>
                                            <select name="r_bi_ces_we" class="form-control w-100 mb-3" required>
                                                <option value="">Please Select</option>
                                                <option value="Pass">Pass</option>
                                                <option value="Fail">Fail</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col my-3">
                                            @if (count($BoardInterview) === 0)
                                                @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker', 'Add') == 'true')

                                                    <input type="submit" id="board_interview_hr_form_submit" class="btn btn-primary mb-1" value="Add Record">
                                                @endif
                                            @else
                                                @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker', 'Add') == 'true')

                                                    <input type="submit" id="board_interview_hr_form_submit" class="btn btn-primary mb-1" value="Add Record" hidden disabled>
                                                    <input type="button" id="board_interview_hr_form_go_back_to_add_record_button" class="btn btn-info mb-1" value="Go to Add Record" onclick="resetBoardInterviewForm()">
                                                @elseif(App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker', 'Edit') == 'true')
                                                    <input type="submit" id="board_interview_hr_form_submit" class="btn btn-secondary mb-1" value="Edit Record" hidden disabled>
                                                @endif
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="overflow-auto">
                                    <table class="table-responsive-lg table-hover table">
                                        <thead class="bg-secondary bg-gardient text-white">
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">Board Interview Date</th>
                                                <th scope="col">Result</th>
                                                <th scope="col">Encoded By</th>
                                                <th scope="col">Encoded Date</th>
                                                <th scope="col">Last Updated By</th>
                                                <th scope="col">Last Update Date</th>
                                            </tr>
                                        </thead>
                                        <tbody id="BoardInterview_tbody">
                                            @if (count($BoardInterview) === 0)

                                                <tr>
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                </tr>
                                            @else
                                                @foreach ($BoardInterview as $item)
                                                    <tr>
                                                        <td>
                                                            <a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetBoardInterviewForm({{ $item->id }},`View`)">View</a>
                                                            @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker', 'Edit') == 'true')
                                                                <a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetBoardInterviewForm({{ $item->id }},`Edit`)">Edit</a>
                                                            @endif
                                                            @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker', 'Delete') == 'true')
                                                                <a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`{{ env('APP_URL') }}api/v1/board-interview/delete/{{ $item->id }}`, `updateBoardInterviewTable`, `resetBoardInterviewForm`, `None`, `None`)">Delete</a>
                                                            @endif

                                                        </td>
                                                        <td>{{ $item->bid_bi_ces_we ?? '-' }}</td>
                                                        <td>{{ $item->r_bi_ces_we ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ $item->encoder ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->created_at)) ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ $item->last_updated_by ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->updated_at)) ?? '-' }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                            </form>
                            <form class="user" id="ces_status_hr_form" method="POST" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/ces-status/add`, `ces_status_hr_form`, `Add`, `updateCesStatusTable`, `resetCesStatusForm`, `ces_status_hr_form_submit`, `None`, `None`)">
                                @csrf
                                <div class="mb-3 bg-blue-500 p-2 uppercase text-white">
                                    <h1>CES STATUS</h1>
                                </div>
                                <div class="container-fuild m-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="hidden" id="cesno_ces_status_hr" name="cesno" class="form-control" @if (str_contains(Request::url(), 'profile/add')) value="{{ $latestCesNo }}" @endif>
                                            <input type="hidden" id="cesno_ces_status_hr_id" name="cesno_ces_status_hr_id" class="form-control">
                                            <label class="form-label ml-2 mb-0">CES Status<sup>*</sup></label>
                                            <select name="cs_cs_ces_we" class="form-control w-100 mb-3" required>
                                                <option value="">Please Select</option>
                                                <option value="8">Eligible</option>
                                                <option value="7">CSEE</option>
                                                <option value="1">CESO I</option>
                                                <option value="2">CESO II</option>
                                                <option value="3">CESO III</option>
                                                <option value="4">CESO IV</option>
                                                <option value="5">CESO V</option>
                                                <option value="6">CESO VI</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Acquired Thru<sup>*</sup></label>
                                            <select name="at_cs_ces_we" class="form-control w-100 mb-3" required>
                                                <option value="">Please Select</option>
                                                <option value="1">Examination</option>
                                                <option value="2">Motu Propio</option>
                                                <option value="3">Testimonial Nomination</option>
                                                <option value="4">Training</option>
                                                <option value="5">MNSA E.O. 145</option>
                                                <option value="0">Others</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Status Type<sup>*</sup></label>
                                            <select name="st_cs_ces_we" class="form-control w-100 mb-3" required>
                                                <option value="">Please Select</option>
                                                <option value="2">Original</option>
                                                <option value="3">Adjustment</option>
                                                <option value="4">Promotion</option>
                                                <option value="5">Restoration</option>
                                                <option value="1">Conferment</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <!-- <label class="form-label ml-2 mb-0">Appointing Authority<sup>*</sup></label>
                                                                                        <input type="text" class="form-control w-100 mb-3" name="aa_cs_ces_we" placeholder="Name of Presidents" required> -->
                                            <label class="form-label ml-2 mb-0">Appointing Authority<sup>*</sup></label>
                                            <select name="aa_cs_ces_we" class="form-control w-100 mb-3" required>
                                                <option value="">Please Select</option>
                                                <option value="1">Ferdinand E. Marcos</option>
                                                <option value="2">Corazon C. Aquino</option>
                                                <option value="3">Fidel V. Ramos</option>
                                                <option value="5">Gloria Macapagal Arroyo</option>
                                                <option value="4">Joseph Ejercito Estrada</option>
                                                <option value="6">Benigno Aquino Jr.</option>
                                                <option value="7">Rodrigo Roa Duterte</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Resolution No.<sup>*</sup></label>
                                            <input type="text" class="form-control w-100 mb-3" name="rn_cs_ces_we" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Date Acquired<sup>*</sup></label>
                                            <input type="date" class="form-control w-100 mb-3" name="da_cs_ces_we" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col my-3">
                                            @if (count($CesStatus) === 0)
                                                @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker', 'Add') == 'true')

                                                    <input type="submit" id="ces_status_hr_form_submit" class="btn btn-primary mb-1" value="Add Record">
                                                @endif
                                            @else
                                                @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker', 'Add') == 'true')

                                                    <input type="submit" id="ces_status_hr_form_submit" class="btn btn-primary mb-1" value="Add Record" hidden disabled>
                                                    <input type="button" id="ces_status_hr_form_go_back_to_add_record_button" class="btn btn-info mb-1" value="Go to Add Record" onclick="resetCesStatusForm()">
                                                @elseif(App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker', 'Edit') == 'true')
                                                    <input type="submit" id="ces_status_hr_form_submit" class="btn btn-secondary mb-1" value="Edit Record" hidden disabled>
                                                @endif
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="overflow-auto">
                                    <table class="table-responsive-lg table-hover table">
                                        <thead class="bg-secondary bg-gardient text-white">
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">Ces Status</th>
                                                <th scope="col">Acquired Thru</th>
                                                <th scope="col">Status Type</th>
                                                <th scope="col">Appointing Authority</th>
                                                <th scope="col">Resolution No.</th>
                                                <th scope="col">Date Acquired</th>
                                                <th scope="col">Encoded By</th>
                                                <th scope="col">Encoded Date</th>
                                                <th scope="col">Last Updated By</th>
                                                <th scope="col">Last Update Date</th>
                                            </tr>
                                        </thead>
                                        <tbody id="CesStatus_tbody">
                                            @if (count($CesStatus) === 0)

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
                                                </tr>
                                            @else
                                                @foreach ($CesStatus as $item)
                                                    <tr>
                                                        <td>
                                                            <a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetCesStatusForm({{ $item->id }},`View`)">View</a>
                                                            @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker', 'Edit') == 'true')
                                                                <a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetCesStatusForm({{ $item->id }},`Edit`)">Edit</a>
                                                            @endif
                                                            @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Eligibility and Rank Tracker', 'Delete') == 'true')
                                                                <a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`{{ env('APP_URL') }}api/v1/ces-status/delete/{{ $item->id }}`, `updateCesStatusTable`, `resetCesStatusForm`, `None`, `None`)">Delete</a>
                                                            @endif

                                                        </td>
                                                        <td>{{ $item->cs_cs_ces_we ?? '-' }}</td>
                                                        <td>{{ $item->at_cs_ces_we ?? '-' }}</td>
                                                        <td>{{ $item->st_cs_ces_we ?? '-' }}</td>
                                                        <td>{{ $item->aa_cs_ces_we ?? '-' }}</td>
                                                        <td>{{ $item->rn_cs_ces_we ?? '-' }}</td>
                                                        <td>{{ $item->da_cs_ces_we ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ $item->encoder ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->created_at)) ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ $item->last_updated_by ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->updated_at)) ?? '-' }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                        <!-- end eligibility and rank tracker -->
                    @endif
                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Record of CESPES Ratings', 'Category Only') == 'true')

                        <!-- start record of cespes ratings -->
                        <div class="tab-pane fade" id="record_of_cespes_rating_hr" role="tabpanel" aria-labelledby="record_of_cespes_rating_hr-tab">
                            <form class="user" id="record_of_cespes_rating_hr_form" method="POST" enctype="multipart/form-data" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/record-of-cespes-ratings/add`, `record_of_cespes_rating_hr_form`, `Add`, `updateRecordOfCespesRatingsTable`, `resetRecordOfCespesRatingsForm`, `record_of_cespes_rating_hr_form_submit`, `None`, `None`)">
                                @csrf
                                <div class="mb-3 bg-blue-500 p-2 uppercase text-white">
                                    <h1>RECORD OF CESPES RATINGS</h1>
                                </div>
                                <div class="container-fuild m-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="hidden" id="cesno_record_of_cespes_rating_hr" name="cesno" class="form-control" @if (str_contains(Request::url(), 'profile/add')) value="{{ $latestCesNo }}" @endif>
                                            <input type="hidden" id="cesno_record_of_cespes_rating_hr_id" name="cesno_record_of_cespes_rating_hr_id" class="form-control">
                                            <label class="form-label ml-2 mb-0">Date (From)<sup>*</sup></label>
                                            <input type="date" class="form-control w-100 mb-3" name="date_from_rocr" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Date (To)<sup>*</sup></label>
                                            <input type="date" class="form-control w-100 mb-3" name="date_to_rocr" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Rating<sup>*</sup></label>
                                            <input type="text" class="form-control w-100 mb-3" name="rating_rocr" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Status<sup>*</sup></label>
                                            <input type="text" class="form-control w-100 mb-3" name="status_rocr" required>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label ml-2 mb-0">Remarks<sup>*</sup></label>
                                            <textarea class="form-control w-100 mb-3" style="text-transform:capitalize" name="remarks_rocr" id="" rows="4" required></textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Attached Certificate of Rating (PDF Format)<sup>*</sup></label>
                                            <input id="pdf_rating_certificate_rocr" name="pdf_rating_certificate_rocr" accept="application/pdf" type="file" onclick="validateFileSize(`pdf_rating_certificate_rocr`, 25)" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col my-3">
                                            @if (count($RecordOfCespesRatings) === 0)
                                                @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Record of CESPES Ratings', 'Add') == 'true')

                                                    <input type="submit" id="record_of_cespes_rating_hr_form_submit" class="btn btn-primary mb-1" value="Add Record">
                                                @endif
                                            @else
                                                @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Record of CESPES Ratings', 'Add') == 'true')

                                                    <input type="submit" id="record_of_cespes_rating_hr_form_submit" class="btn btn-primary mb-1" value="Add Record" hidden disabled>
                                                    <input type="button" id="record_of_cespes_rating_hr_form_go_back_to_add_record_button" class="btn btn-info mb-1" value="Go to Add Record" onclick="resetRecordOfCespesRatingsForm()">
                                                @elseif(App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Record of CESPES Ratings', 'Edit') == 'true')
                                                    <input type="submit" id="record_of_cespes_rating_hr_form_submit" class="btn btn-secondary mb-1" value="Edit Record" hidden disabled>
                                                @endif
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="overflow-auto">
                                    <table class="table-responsive-lg table-hover table">
                                        <thead class="bg-secondary bg-gardient text-white">
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">Date From</th>
                                                <th scope="col">Date To</th>
                                                <th scope="col">Rating</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Remarks</th>
                                                <th scope="col">Attached Certificate of Rating</th>
                                                <th scope="col">Encoded By</th>
                                                <th scope="col">Encoded Date</th>
                                                <th scope="col">Last Updated By</th>
                                                <th scope="col">Last Update Date</th>
                                            </tr>
                                        </thead>
                                        <tbody id="RecordOfCespesRatings_tbody">
                                            @if (count($RecordOfCespesRatings) === 0)

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
                                                </tr>
                                            @else
                                                @foreach ($RecordOfCespesRatings as $item)
                                                    <tr>
                                                        <td>
                                                            <a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetRecordOfCespesRatingsForm({{ $item->id }},`View`)">View</a>
                                                            @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Record of CESPES Ratings', 'Edit') == 'true')
                                                                <a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetRecordOfCespesRatingsForm({{ $item->id }},`Edit`)">Edit</a>
                                                            @endif
                                                            @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Record of CESPES Ratings', 'Delete') == 'true')
                                                                <a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`{{ env('APP_URL') }}api/v1/record-of-cespes-ratings/delete/{{ $item->id }}`, `updateRecordOfCespesRatingsTable`, `resetRecordOfCespesRatingsForm`, `None`, `None`)">Delete</a>
                                                            @endif

                                                        </td>
                                                        <td>{{ $item->date_from_rocr ?? '-' }}</td>
                                                        <td>{{ $item->date_to_rocr ?? '-' }}</td>
                                                        <td>{{ $item->rating_rocr ?? '-' }}</td>
                                                        <td>{{ $item->status_rocr ?? '-' }}</td>
                                                        <td>{{ $item->remarks_rocr ?? '-' }}</td>
                                                        <td><a href="{{ asset('external-storage/PDF Documents/201 Folder/CESPES Certificate of Rating/' . $item->pdf_rating_certificate_rocr) }}">{{ $item->pdf_rating_certificate_rocr ?? '-' }}</a></td>
                                                        <td nowrap="nowrap">{{ $item->encoder ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->created_at)) ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ $item->last_updated_by ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->updated_at)) ?? '-' }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                        <!-- end record of cespes ratings -->
                    @endif
                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Work Experience', 'Category Only') == 'true')

                        <!-- start work experience -->
                        <div class="tab-pane fade" id="work_experience" role="tabpanel" aria-labelledby="work_experience-tab">
                            <form class="user" id="work_experience_form" method="POST" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/work-experience/add`, `work_experience_form`, `Add`, `updateWorkExperienceTable`, `resetWorkExperienceForm`, `work_experience_form_submit`, `None`, `None`)">
                                @csrf
                                <div class="mb-3 bg-blue-500 p-2 uppercase text-white">
                                    <h1>WORK EXPERIENCE</h1>
                                </div>
                                <div class="container-fuild m-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="hidden" id="cesno_work_experience" name="cesno" class="form-control" @if (str_contains(Request::url(), 'profile/add')) value="{{ $latestCesNo }}" @endif>
                                            <input type="hidden" id="cesno_work_experience_id" name="cesno_work_experience_id" class="form-control">
                                            <label class="form-label ml-2 mb-0">Date (From)<sup>*</sup></label>
                                            <input type="date" name="date_from_work_experience" class="w-100 form-control mb-3" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Date (To)<sup>*</sup></label>
                                            <input type="date" name="date_to_work_experience" class="form-control mb-3" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Position Title / Designation<sup>*</sup></label>
                                            <input type="text" name="destination_from_work_experience" class="form-control w-100 mb-3" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Status<sup>*</sup></label>
                                            <input type="text" name="status_from_work_experience" class="form-control w-100 mb-3" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Monthly Salary<sup>*</sup></label>
                                            <input type="text" name="salary_from_work_experience" class="form-control w-100 mb-3" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Salary/Job/Pay Grade<sup>*</sup></label>
                                            <input type="text" name="salary_job_pay_grade_work_experience" class="form-control w-100 mb-3" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Status of Appointment<sup>*</sup></label>
                                            <input type="text" name="status_of_appointment_work_experience" class="form-control w-100 mb-3" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Government Service<sup>*</sup></label>
                                            <select name="government_service_work_experience" class="form-control w-100 mb-3" required>
                                                <option value="">Please Select</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Department / Agency<sup>*</sup></label>
                                            <input type="text" name="department_from_work_experience" class="form-control w-100 mb-3" required>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label ml-2 mb-0">Remarks<sup>*</sup></label>
                                            <textarea name="remarks_from_work_experience" class="form-control w-100 mb-3" style="text-transform:capitalize" rows="4" required></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col my-3">
                                            @if (count($WorkExperience) === 0)
                                                @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Work Experience', 'Add') == 'true')

                                                    <input type="submit" id="work_experience_form_submit" class="btn btn-primary mb-1" value="Add Record">
                                                @endif
                                            @else
                                                @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Work Experience', 'Add') == 'true')

                                                    <input type="submit" id="work_experience_form_submit" class="btn btn-primary mb-1" value="Add Record" hidden disabled>
                                                    <input type="button" id="work_experience_form_go_back_to_add_record_button" class="btn btn-info mb-1" value="Go to Add Record" onclick="resetWorkExperienceForm()">
                                                @elseif(App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Work Experience', 'Edit') == 'true')
                                                    <input type="submit" id="work_experience_form_submit" class="btn btn-secondary mb-1" value="Edit Record" hidden disabled>
                                                @endif
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="overflow-auto">
                                    <table class="table-responsive-lg table-hover table">
                                        <thead class="bg-secondary bg-gardient text-white">
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">Date From</th>
                                                <th scope="col">Date To</th>
                                                <th scope="col">Destination</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Salary</th>
                                                <th scope="col">Salary/Job/Pay Grade</th>
                                                <th scope="col">Status of Appointment</th>
                                                <th scope="col">Government Service</th>
                                                <th scope="col">Department</th>
                                                <th scope="col">Remarks</th>
                                                <th scope="col">Encoded By</th>
                                                <th scope="col">Encoded Date</th>
                                                <th scope="col">Last Updated By</th>
                                                <th scope="col">Last Update Date</th>
                                            </tr>
                                        </thead>
                                        <tbody id="WorkExperience_tbody">
                                            @if (count($WorkExperience) === 0)

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
                                                </tr>
                                            @else
                                                @foreach ($WorkExperience as $item)
                                                    <tr>
                                                        <td>
                                                            <a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetWorkExperienceForm({{ $item->id }},`View`)">View</a>
                                                            @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Work Experience', 'Edit') == 'true')
                                                                <a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetWorkExperienceForm({{ $item->id }},`Edit`)">Edit</a>
                                                            @endif
                                                            @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Work Experience', 'Delete') == 'true')
                                                                <a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`{{ env('APP_URL') }}api/v1/work-experience/delete/{{ $item->id }}`, `updateWorkExperienceTable`, `resetWorkExperienceForm`, `None`, `None`)">Delete</a>
                                                            @endif

                                                        </td>
                                                        <td>{{ $item->date_from_work_experience ?? '-' }}</td>
                                                        <td>{{ $item->date_to_work_experience ?? '-' }}</td>
                                                        <td>{{ $item->destination_from_work_experience ?? '-' }}</td>
                                                        <td>{{ $item->status_from_work_experience ?? '-' }}</td>
                                                        <td>{{ $item->salary_from_work_experience ?? '-' }}</td>
                                                        <td>{{ $item->salary_job_pay_grade_work_experience ?? '-' }}</td>
                                                        <td>{{ $item->status_of_appointment_work_experience ?? '-' }}</td>
                                                        <td>{{ $item->government_service_work_experience ?? '-' }}</td>
                                                        <td>{{ $item->department_from_work_experience ?? '-' }}</td>
                                                        <td>{{ $item->remarks_from_work_experience ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ $item->encoder ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->created_at)) ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ $item->last_updated_by ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->updated_at)) ?? '-' }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                        <!-- end work experience -->
                    @endif
                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Records of Field of Expertise or Specialization', 'Category Only') == 'true')

                        <!-- start field expertise -->
                        <div class="tab-pane fade" id="field_expertise" role="tabpanel" aria-labelledby="field_expertise-tab">
                            <form class="user" id="field_expertise_form" method="POST" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/field-expertise/add`, `field_expertise_form`, `Add`, `updateFieldExpertiseTable`, `resetFieldExpertiseForm`, `field_expertise_form_submit`, `None`, `None`)">
                                @csrf
                                <div class="mb-3 bg-blue-500 p-2 uppercase text-white">
                                    <h1>RECORDS OF FIELD OF EXPERTISE / SPECIALIZATION</h1>
                                </div>
                                <div class="container-fuild m-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="hidden" id="cesno_field_expertise" name="cesno" class="form-control" @if (str_contains(Request::url(), 'profile/add')) value="{{ $latestCesNo }}" @endif>
                                            <input type="hidden" id="cesno_field_expertise_id" name="cesno_field_expertise_id" class="form-control">
                                            <label class="form-label ml-2 mb-0">Expertise<sup>*</sup></label>
                                            <input type="text" name="ec_field_expertise" class="form-control w-100 mb-3" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Field of Specialization<sup>*</sup></label>
                                            <input type="text" name="ss_field_expertise" class="form-control w-100 mb-3" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col my-3">
                                            @if (count($FieldExpertise) === 0)
                                                @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Records of Field of Expertise or Specialization', 'Add') == 'true')

                                                    <input type="submit" id="field_expertise_form_submit" class="btn btn-primary mb-1" value="Add Record">
                                                @endif
                                            @else
                                                @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Records of Field of Expertise or Specialization', 'Add') == 'true')

                                                    <input type="submit" id="field_expertise_form_submit" class="btn btn-primary mb-1" value="Add Record" hidden disabled>
                                                    <input type="button" id="field_expertise_form_go_back_to_add_record_button" class="btn btn-info mb-1" value="Go to Add Record" onclick="resetFieldExpertiseForm()">
                                                @elseif(App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Records of Field of Expertise or Specialization', 'Edit') == 'true')
                                                    <input type="submit" id="field_expertise_form_submit" class="btn btn-secondary mb-1" value="Edit Record" hidden disabled>
                                                @endif
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="overflow-auto">
                                    <table class="table-responsive-lg table-hover table">
                                        <thead class="bg-secondary bg-gardient text-white">
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">Expertise Category</th>
                                                <th scope="col">Special Skills</th>
                                                <th scope="col">Encoded By</th>
                                                <th scope="col">Encoded Date</th>
                                                <th scope="col">Last Updated By</th>
                                                <th scope="col">Last Update Date</th>
                                            </tr>
                                        </thead>
                                        <tbody id="FieldExpertise_tbody">
                                            @if (count($FieldExpertise) === 0)

                                                <tr>
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                </tr>
                                            @else
                                                @foreach ($FieldExpertise as $item)
                                                    <tr>
                                                        <td>
                                                            <a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetFieldExpertiseForm({{ $item->id }},`View`)">View</a>
                                                            @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Records of Field of Expertise or Specialization', 'Edit') == 'true')
                                                                <a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetFieldExpertiseForm({{ $item->id }},`Edit`)">Edit</a>
                                                            @endif
                                                            @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Records of Field of Expertise or Specialization', 'Delete') == 'true')
                                                                <a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`{{ env('APP_URL') }}api/v1/field-expertise/delete/{{ $item->id }}`, `updateFieldExpertiseTable`, `resetFieldExpertiseForm`, `None`, `None`)">Delete</a>
                                                            @endif

                                                        </td>
                                                        <td>{{ $item->ec_field_expertise ?? '-' }}</td>
                                                        <td>{{ $item->ss_field_expertise ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ $item->encoder ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->created_at)) ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ $item->last_updated_by ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->updated_at)) ?? '-' }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                        <!-- end field expertise -->
                    @endif
                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('CES Trainings', 'Category Only') == 'true')

                        <!-- start ces trainings -->
                        <div class="tab-pane fade" id="ces_trainings" role="tabpanel" aria-labelledby="ces_trainings-tab">
                            <form class="user" id="ces_trainings_form" method="POST" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/ces-trainings/add`, `ces_trainings_form`, `Add`, `updateCesTrainingsTable`, `resetCesTrainingsForm`, `ces_trainings_form_submit`, `None`, `None`)">
                                @csrf
                                <div class="mb-3 bg-blue-500 p-2 uppercase text-white">
                                    <h1>HISTORICAL RECORD OF CES TRAININGS</h1>
                                </div>
                                <div class="container-fuild m-3">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="hidden" id="cesno_ces_trainings" name="cesno" class="form-control" @if (str_contains(Request::url(), 'profile/add')) value="{{ $latestCesNo }}" @endif>
                                            <input type="hidden" id="cesno_ces_trainings_id" name="cesno_ces_trainings_id" class="form-control">
                                            <label class="form-label ml-2 mb-0">Training Date (From)<sup>*</sup></label>
                                            <input type="date" name="date_f_ces_trainings" class="w-100 form-control mb-3" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label ml-2 mb-0">Training Date (To)<sup>*</sup></label>
                                            <input type="date" name="date_t_ces_trainings" class="w-100 form-control mb-3" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label ml-2 mb-0">Session Title / Program<sup>*</sup></label>
                                            <input type="text" name="s_title_ces_trainings" class="form-control w-100 mb-3" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label ml-2 mb-0">Session No.<sup>*</sup></label>
                                            <input type="text" name="s_no_ces_trainings" class="form-control w-100 mb-3" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label ml-2 mb-0">Training Category / Theme<sup>*</sup></label>
                                            <input type="text" name="training_category_ces_trainings" class="form-control w-100 mb-3" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label ml-2 mb-0">Expertise / Field of Specialization<sup>*</sup></label>
                                            <select name="fos_ces_trainings" aria-aria-controls='example' class="date-picker w-100 form-control mb-3" required>
                                                <option value="">Please Select</option>
                                                <option value="fos1">fos1</option>
                                                <option value="fos2">fos2</option>
                                                <option value="fos3">fos3</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label ml-2 mb-0">Venue<sup>*</sup></label>
                                            <input type="text" name="venue_ces_trainings" class="form-control w-100 mb-3" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label ml-2 mb-0">No. of Training hours<sup>*</sup></label>
                                            <input type="number" name="noh_ces_trainings" class="form-control w-100 mb-3" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label ml-2 mb-0">Barrio</label>
                                            <input type="text" name="barrio_ces_trainings" class="form-control w-100 mb-3">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label ml-2 mb-0">Resource Speaker<sup>*</sup></label>
                                            <input type="text" name="rs_ces_trainings" class="form-control w-100 mb-3" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label ml-2 mb-0">Session Director<sup>*</sup></label>
                                            <input type="text" name="sd_ces_trainings" class="form-control w-100 mb-3" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label ml-2 mb-0">Training Status<sup>*</sup></label>
                                            <select name="training_status_ces_trainings" aria-aria-controls='example' class="date-picker w-100 form-control mb-3" required>
                                                <option value="">Please Select</option>
                                                <option value="Registration">Registration</option>
                                                <option value="Completed">Completed</option>
                                                <option value="Pending">Pending</option>
                                                <option value="Cancelled">Cancelled</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="form-label ml-2 mb-0">Remarks<sup>*</sup></label>
                                            <textarea class="form-control w-100 mb-3" style="text-transform:capitalize" name="remarks_ces_trainings" id="exampleFormControlTextarea2" rows="4" required></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col my-3">
                                            @if (count($CesTrainings) === 0)
                                                @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('CES Trainings', 'Add') == 'true')

                                                    <input type="submit" id="ces_trainings_form_submit" class="btn btn-primary mb-1" value="Add Record">
                                                @endif
                                            @else
                                                @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('CES Trainings', 'Add') == 'true')

                                                    <input type="submit" id="ces_trainings_form_submit" class="btn btn-primary mb-1" value="Add Record" hidden disabled>
                                                    <input type="button" id="ces_trainings_form_go_back_to_add_record_button" class="btn btn-info mb-1" value="Go to Add Record" onclick="resetCesTrainingsForm()">
                                                @elseif(App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('CES Trainings', 'Edit') == 'true')
                                                    <input type="submit" id="ces_trainings_form_submit" class="btn btn-secondary mb-1" value="Edit Record" hidden disabled>
                                                @endif
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="overflow-auto">
                                    <table class="table-responsive-lg table-hover table">
                                        <thead class="bg-secondary bg-gardient text-white">
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">Session Title / Program</th>
                                                <th scope="col">Session No.</th>
                                                <th scope="col">Training Category / Theme</th>
                                                <th scope="col">Expertise / Field of Specialization</th>
                                                <th scope="col">Vanue</th>
                                                <th scope="col">No. of Training Hours</th>
                                                <th scope="col">Barrio</th>
                                                <th scope="col">Resource Speaker</th>
                                                <th scope="col">Session Director</th>
                                                <th scope="col">Training Status</th>
                                                <th scope="col">Remarks</th>
                                                <th scope="col">From</th>
                                                <th scope="col">To</th>
                                                <th scope="col">Encoded By</th>
                                                <th scope="col">Encoded Date</th>
                                                <th scope="col">Last Updated By</th>
                                                <th scope="col">Last Update Date</th>
                                            </tr>
                                        </thead>
                                        <tbody id="CesTrainings_tbody">
                                            @if (count($CesTrainings) === 0)

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
                                                </tr>
                                            @else
                                                @foreach ($CesTrainings as $item)
                                                    <tr>
                                                        <td>
                                                            <a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetCesTrainingsForm({{ $item->id }},`View`)">View</a>
                                                            @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('CES Trainings', 'Edit') == 'true')
                                                                <a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetCesTrainingsForm({{ $item->id }},`Edit`)">Edit</a>
                                                            @endif
                                                            @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('CES Trainings', 'Delete') == 'true')
                                                                <a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`{{ env('APP_URL') }}api/v1/ces-trainings/delete/{{ $item->id }}`, `updateCesTrainingsTable`, `resetCesTrainingsForm`, `None`, `None`)">Delete</a>
                                                            @endif

                                                        </td>
                                                        <td>{{ $item->s_title_ces_trainings ?? '-' }}</td>
                                                        <td>{{ $item->s_no_ces_trainings ?? '-' }}</td>
                                                        <td>{{ $item->training_category_ces_trainings ?? '-' }}</td>
                                                        <td>{{ $item->fos_ces_trainings ?? '-' }}</td>
                                                        <td>{{ $item->venue_ces_trainings ?? '-' }}</td>
                                                        <td>{{ $item->noh_ces_trainings ?? '-' }}</td>
                                                        <td>{{ $item->barrio_ces_trainings ?? '-' }}</td>
                                                        <td>{{ $item->rs_ces_trainings ?? '-' }}</td>
                                                        <td>{{ $item->sd_ces_trainings ?? '-' }}</td>
                                                        <td>{{ $item->training_status_ces_trainings ?? '-' }}</td>
                                                        <td>{{ $item->remarks_ces_trainings ?? '-' }}</td>
                                                        <td>{{ $item->date_f_ces_trainings ?? '-' }}</td>
                                                        <td>{{ $item->date_t_ces_trainings ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ $item->encoder ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->created_at)) ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ $item->last_updated_by ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->updated_at)) ?? '-' }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                        <!-- end ces trainings -->
                    @endif
                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Other Non-CES Accredited Trainings', 'Category Only') == 'true')

                        <!-- start other management trainings -->
                        <div class="tab-pane fade" id="other_management_trainings" role="tabpanel" aria-labelledby="other_management_trainings-tab">
                            <form class="user" id="other_management_trainings_form" method="POST" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/other-management-trainings/add`, `other_management_trainings_form`, `Add`, `updateOtherManagementTrainingsTable`, `resetOtherManagementTrainingsForm`, `other_management_trainings_form_submit`, `None`, `None`)">
                                @csrf
                                <div class="mb-3 bg-blue-500 p-2 uppercase text-white">
                                    <h1>OTHER NON-CES ACCREDITED TRAININGS</h1>
                                </div>
                                <div class="container-fuild m-3">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <input type="hidden" id="cesno_other_management_trainings" name="cesno" class="form-control" @if (str_contains(Request::url(), 'profile/add')) value="{{ $latestCesNo }}" @endif>
                                            <input type="hidden" id="cesno_other_management_trainings_id" name="cesno_other_management_trainings_id" class="form-control">
                                            <label class="form-label ml-2 mb-0">Training Date (From)<sup>*</sup></label>
                                            <input type="date" name="date_f_onat" class="w-100 form-control mb-3" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label ml-2 mb-0">Training Date (To)<sup>*</sup></label>
                                            <input type="date" name="date_t_onat" class="w-100 form-control mb-3" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Training Title<sup>*</sup></label>
                                            <input type="text" name="title_traning_onat" class="form-control w-100 mb-3" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Training Category<sup>*</sup></label>
                                            <input type="text" name="training_category_onat" class="form-control w-100 mb-3" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Expertise / Field of Specialization<sup>*</sup></label>
                                            <input type="text" name="expertise_fos_onat" class="form-control w-100 mb-3" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Sponsor / Training Provider<sup>*</sup></label>
                                            <input type="text" name="sponsor_tp_onat" class="form-control w-100 mb-3" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Venue<sup>*</sup></label>
                                            <input type="text" name="vanue_onat" class="form-control w-100 mb-3" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">No. of Traning Hours<sup>*</sup></label>
                                            <input type="number" name="no_training_hours_omt" class="form-control w-100 mb-3" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col my-3">
                                            @if (count($OtherManagementTrainings) === 0)
                                                @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Other Non-CES Accredited Trainings', 'Add') == 'true')

                                                    <input type="submit" id="other_management_trainings_form_submit" class="btn btn-primary mb-1" value="Add Record">
                                                @endif
                                            @else
                                                @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Other Non-CES Accredited Trainings', 'Add') == 'true')

                                                    <input type="submit" id="other_management_trainings_form_submit" class="btn btn-primary mb-1" value="Add Record" hidden disabled>
                                                    <input type="button" id="other_management_trainings_form_go_back_to_add_record_button" class="btn btn-info mb-1" value="Go to Add Record" onclick="resetOtherManagementTrainingsForm()">
                                                @elseif(App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Other Non-CES Accredited Trainings', 'Edit') == 'true')
                                                    <input type="submit" id="other_management_trainings_form_submit" class="btn btn-secondary mb-1" value="Edit Record" hidden disabled>
                                                @endif
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="overflow-auto">
                                    <table class="table-responsive-lg table-hover table">
                                        <thead class="bg-secondary bg-gardient text-white">
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">From</th>
                                                <th scope="col">To</th>
                                                <th scope="col">Training Title</th>
                                                <th scope="col">Training Category</th>
                                                <th scope="col">Expertise / Field of Specialization</th>
                                                <th scope="col">Sponsor / Training Provider</th>
                                                <th scope="col">Vanue</th>
                                                <th scope="col">No. of Training Hours</th>
                                                <th scope="col">Encoded By</th>
                                                <th scope="col">Encoded Date</th>
                                                <th scope="col">Last Updated By</th>
                                                <th scope="col">Last Update Date</th>
                                            </tr>
                                        </thead>
                                        <tbody id="OtherManagementTrainings_tbody">
                                            @if (count($OtherManagementTrainings) === 0)

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
                                                </tr>
                                            @else
                                                @foreach ($OtherManagementTrainings as $item)
                                                    <tr>
                                                        <td>
                                                            <a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetOtherManagementTrainingsForm({{ $item->id }},`View`)">View</a>
                                                            @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Other Non-CES Accredited Trainings', 'Edit') == 'true')
                                                                <a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetOtherManagementTrainingsForm({{ $item->id }},`Edit`)">Edit</a>
                                                            @endif
                                                            @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Other Non-CES Accredited Trainings', 'Delete') == 'true')
                                                                <a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`{{ env('APP_URL') }}api/v1/other-management-trainings/delete/{{ $item->id }}`, `updateOtherManagementTrainingsTable`, `resetOtherManagementTrainingsForm`, `None`, `None`)">Delete</a>
                                                            @endif

                                                        </td>
                                                        <td>{{ $item->date_f_onat ?? '-' }}</td>
                                                        <td>{{ $item->date_t_onat ?? '-' }}</td>
                                                        <td>{{ $item->title_traning_onat ?? '-' }}</td>
                                                        <td>{{ $item->training_category_onat ?? '-' }}</td>
                                                        <td>{{ $item->expertise_fos_onat ?? '-' }}</td>
                                                        <td>{{ $item->sponsor_tp_onat ?? '-' }}</td>
                                                        <td>{{ $item->vanue_onat ?? '-' }}</td>
                                                        <td>{{ $item->no_training_hours_omt ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ $item->encoder ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->created_at)) ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ $item->last_updated_by ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->updated_at)) ?? '-' }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                        <!-- end other management trainings -->
                    @endif
                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Research and Studies', 'Category Only') == 'true')

                        <!-- start research and studies -->
                        <div class="tab-pane fade" id="research_and_studies" role="tabpanel" aria-labelledby="research_and_studies-tab">
                            <form class="user" id="research_and_studies_form" method="POST" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/research-and-studies/add`, `research_and_studies_form`, `Add`, `updateResearchAndStudiesTable`, `resetResearchAndStudiesForm`, `research_and_studies_form_submit`, `None`, `None`)">
                                @csrf
                                <div class="mb-3 bg-blue-500 p-2 uppercase text-white">
                                    <h1>RESEARCH AND STUDIES</h1>
                                </div>
                                <div class="container-fuild m-3">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <input type="hidden" id="cesno_research_and_studies" name="cesno" class="form-control" @if (str_contains(Request::url(), 'profile/add')) value="{{ $latestCesNo }}" @endif>
                                            <input type="hidden" id="cesno_research_and_studies_id" name="cesno_research_and_studies_id" class="form-control">
                                            <label class="form-label ml-2 mb-0">Date (From)<sup>*</sup></label>
                                            <input type="date" name="date_f_ras" class="w-100 form-control mb-3" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label ml-2 mb-0">Date (To)<sup>*</sup></label>
                                            <input type="date" name="date_t_ras" class="w-100 form-control mb-3" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Research Title<sup>*</sup></label>
                                            <input type="text" name="title_ras" class="form-control w-100 mb-3" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Publisher<sup>*</sup></label>
                                            <input type="text" name="publisher_ras" class="form-control w-100 mb-3" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col my-3">
                                            @if (count($ResearchAndStudies) === 0)
                                                @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Research and Studies', 'Add') == 'true')

                                                    <input type="submit" id="research_and_studies_form_submit" class="btn btn-primary mb-1" value="Add Record">
                                                @endif
                                            @else
                                                @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Research and Studies', 'Add') == 'true')

                                                    <input type="submit" id="research_and_studies_form_submit" class="btn btn-primary mb-1" value="Add Record" hidden disabled>
                                                    <input type="button" id="research_and_studies_form_go_back_to_add_record_button" class="btn btn-info mb-1" value="Go to Add Record" onclick="resetResearchAndStudiesForm()">
                                                @elseif(App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Research and Studies', 'Edit') == 'true')
                                                    <input type="submit" id="research_and_studies_form_submit" class="btn btn-secondary mb-1" value="Edit Record" hidden disabled>
                                                @endif
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="overflow-auto">
                                    <table class="table-responsive-lg table-hover table">
                                        <thead class="bg-secondary bg-gardient text-white">
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">From</th>
                                                <th scope="col">To</th>
                                                <th scope="col">Research Title</th>
                                                <th scope="col">Publisher</th>
                                                <th scope="col">Encoded By</th>
                                                <th scope="col">Encoded Date</th>
                                                <th scope="col">Last Updated By</th>
                                                <th scope="col">Last Update Date</th>
                                            </tr>
                                        </thead>
                                        <tbody id="ResearchAndStudies_tbody">
                                            @if (count($ResearchAndStudies) === 0)

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
                                                </tr>
                                            @else
                                                @foreach ($ResearchAndStudies as $item)
                                                    <tr>
                                                        <td>
                                                            <a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetResearchAndStudiesForm({{ $item->id }},`View`)">View</a>
                                                            @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Research and Studies', 'Edit') == 'true')
                                                                <a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetResearchAndStudiesForm({{ $item->id }},`Edit`)">Edit</a>
                                                            @endif
                                                            @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Research and Studies', 'Delete') == 'true')
                                                                <a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`{{ env('APP_URL') }}api/v1/research-and-studies/delete/{{ $item->id }}`, `updateResearchAndStudiesTable`, `resetResearchAndStudiesForm`, `None`, `None`)">Delete</a>
                                                            @endif

                                                        </td>
                                                        <td>{{ $item->date_f_ras ?? '-' }}</td>
                                                        <td>{{ $item->date_t_ras ?? '-' }}</td>
                                                        <td>{{ $item->title_ras ?? '-' }}</td>
                                                        <td>{{ $item->publisher_ras ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ $item->encoder ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->created_at)) ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ $item->last_updated_by ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->updated_at)) ?? '-' }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                        <!-- end research and studies -->
                    @endif
                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Scholarships Received', 'Category Only') == 'true')

                        <!-- start scholarships -->
                        <div class="tab-pane fade" id="scholarships" role="tabpanel" aria-labelledby="scholarships-tab">
                            <form class="user" id="scholarships_form" method="POST" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/scholarships/add`, `scholarships_form`, `Add`, `updateScholarshipsTable`, `resetScholarshipsForm`, `scholarships_form_submit`, `None`, `None`)">
                                @csrf
                                <div class="mb-3 bg-blue-500 p-2 uppercase text-white">
                                    <h1>SCHOLARSHIP RECEIVED</h1>
                                </div>
                                <div class="container-fuild m-3">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="hidden" id="cesno_scholarships" name="cesno" class="form-control" @if (str_contains(Request::url(), 'profile/add')) value="{{ $latestCesNo }}" @endif>
                                            <input type="hidden" id="cesno_scholarships_id" name="cesno_scholarships_id" class="form-control">
                                            <label class="form-label ml-2 mb-0">Date (From)<sup>*</sup></label>
                                            <input type="date" name="date_f_scholarships" class="w-100 form-control mb-3" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label ml-2 mb-0">Date (To)<sup>*</sup></label>
                                            <input type="date" name="date_t_scholarships" class="w-100 form-control mb-3" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label ml-2 mb-0">Scholar Type<sup>*</sup></label>
                                            <select name="scholar_type_scholarships" aria-aria-controls='example' class="date-picker w-100 form-control mb-3" required>
                                                <option value="">Please Select</option>
                                                <option value="Local">Local</option>
                                                <option value="Foreign">Foreign</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Title<sup>*</sup></label>
                                            <input type="text" name="title_scholarships" class="form-control w-100 mb-3" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Sponsor<sup>*</sup></label>
                                            <input type="text" name="sponsor_scholarships" class="form-control w-100 mb-3" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col my-3">
                                            @if (count($Scholarships) === 0)
                                                @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Scholarships Received', 'Add') == 'true')

                                                    <input type="submit" id="scholarships_form_submit" class="btn btn-primary mb-1" value="Add Record">
                                                @endif
                                            @else
                                                @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Scholarships Received', 'Add') == 'true')

                                                    <input type="submit" id="scholarships_form_submit" class="btn btn-primary mb-1" value="Add Record" hidden disabled>
                                                    <input type="button" id="scholarships_form_go_back_to_add_record_button" class="btn btn-info mb-1" value="Go to Add Record" onclick="resetScholarshipsForm()">
                                                @elseif(App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Scholarships Received', 'Edit') == 'true')
                                                    <input type="submit" id="scholarships_form_submit" class="btn btn-secondary mb-1" value="Edit Record" hidden disabled>
                                                @endif
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="overflow-auto">
                                    <table class="table-responsive-lg table-hover table">
                                        <thead class="bg-secondary bg-gardient text-white">
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">From</th>
                                                <th scope="col">To</th>
                                                <th scope="col">Scholarship Type</th>
                                                <th scope="col">Title</th>
                                                <th scope="col">Sponsor</th>
                                                <th scope="col">Encoded By</th>
                                                <th scope="col">Encoded Date</th>
                                                <th scope="col">Last Updated By</th>
                                                <th scope="col">Last Update Date</th>
                                            </tr>
                                        </thead>
                                        <tbody id="Scholarships_tbody">
                                            @if (count($Scholarships) === 0)

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
                                                </tr>
                                            @else
                                                @foreach ($Scholarships as $item)
                                                    <tr>
                                                        <td>
                                                            <a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetScholarshipsForm({{ $item->id }},`View`)">View</a>
                                                            @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Scholarships Received', 'Edit') == 'true')
                                                                <a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetScholarshipsForm({{ $item->id }},`Edit`)">Edit</a>
                                                            @endif
                                                            @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Scholarships Received', 'Delete') == 'true')
                                                                <a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`{{ env('APP_URL') }}api/v1/scholarships/delete/{{ $item->id }}`, `updateScholarshipsTable`, `resetScholarshipsForm`, `None`, `None`)">Delete</a>
                                                            @endif

                                                        </td>
                                                        <td>{{ $item->date_f_scholarships ?? '-' }}</td>
                                                        <td>{{ $item->date_t_scholarships ?? '-' }}</td>
                                                        <td>{{ $item->scholar_type_scholarships ?? '-' }}</td>
                                                        <td>{{ $item->title_scholarships ?? '-' }}</td>
                                                        <td>{{ $item->sponsor_scholarships ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ $item->encoder ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->created_at)) ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ $item->last_updated_by ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->updated_at)) ?? '-' }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                        <!-- end scholarships -->
                    @endif
                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Major Civic and Professional Affiliations', 'Category Only') == 'true')

                        <!-- start major civic and professional affiliations -->
                        <div class="tab-pane fade" id="major_civic_and_professional_affiliations" role="tabpanel" aria-labelledby="major_civic_and_professional_affiliations-tab">
                            <form class="user" id="major_civic_and_professional_affiliations_form" method="POST" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/major-civic-and-professional-affiliations/add`, `major_civic_and_professional_affiliations_form`, `Add`, `updateAffiliationsTable`, `resetAffiliationsForm`, `major_civic_and_professional_affiliations_form_submit`, `None`, `None`)">
                                @csrf
                                <div class="mb-3 bg-blue-500 p-2 uppercase text-white">
                                    <h1>MAJOR CIVIC AND PROFESSIONAL AFFILIATIONS</h1>
                                </div>
                                <div class="container-fuild m-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="hidden" id="cesno_major_civic_and_professional_affiliations" name="cesno" class="form-control" @if (str_contains(Request::url(), 'profile/add')) value="{{ $latestCesNo }}" @endif>
                                            <input type="hidden" id="cesno_major_civic_and_professional_affiliations_id" name="cesno_major_civic_and_professional_affiliations_id" class="form-control">
                                            <label class="form-label ml-2 mb-0">Date (From)<sup>*</sup></label>
                                            <input type="date" name="date_f_mcapa" class="w-100 form-control mb-3" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Date (To)<sup>*</sup></label>
                                            <input type="date" name="date_t_mcapa" class="w-100 form-control mb-3" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Organization<sup>*</sup></label>
                                            <input type="text" name="organization_mcapa" class="form-control w-100 mb-3" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Position<sup>*</sup></label>
                                            <input type="text" name="position_mcapa" class="form-control w-100 mb-3" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col my-3">
                                            @if (count($Affiliations) === 0)
                                                @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Major Civic and Professional Affiliations', 'Add') == 'true')

                                                    <input type="submit" id="major_civic_and_professional_affiliations_form_submit" class="btn btn-primary mb-1" value="Add Record">
                                                @endif
                                            @else
                                                @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Major Civic and Professional Affiliations', 'Add') == 'true')

                                                    <input type="submit" id="major_civic_and_professional_affiliations_form_submit" class="btn btn-primary mb-1" value="Add Record" hidden disabled>
                                                    <input type="button" id="major_civic_and_professional_affiliations_form_go_back_to_add_record_button" class="btn btn-info mb-1" value="Go to Add Record" onclick="resetAffiliationsForm()">
                                                @elseif(App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Major Civic and Professional Affiliations', 'Edit') == 'true')
                                                    <input type="submit" id="major_civic_and_professional_affiliations_form_submit" class="btn btn-secondary mb-1" value="Edit Record" hidden disabled>
                                                @endif
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="overflow-auto">
                                    <table class="table-responsive-lg table-hover table">
                                        <thead class="bg-secondary bg-gardient text-white">
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">From</th>
                                                <th scope="col">To</th>
                                                <th scope="col">Organization</th>
                                                <th scope="col">Position</th>
                                                <th scope="col">Encoded By</th>
                                                <th scope="col">Encoded Date</th>
                                                <th scope="col">Last Updated By</th>
                                                <th scope="col">Last Update Date</th>
                                            </tr>
                                        </thead>
                                        <tbody id="Affiliations_tbody">
                                            @if (count($Affiliations) === 0)

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
                                                </tr>
                                            @else
                                                @foreach ($Affiliations as $item)
                                                    <tr>
                                                        <td>
                                                            <a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetAffiliationsForm({{ $item->id }},`View`)">View</a>
                                                            @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Major Civic and Professional Affiliations', 'Edit') == 'true')
                                                                <a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetAffiliationsForm({{ $item->id }},`Edit`)">Edit</a>
                                                            @endif
                                                            @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Major Civic and Professional Affiliations', 'Delete') == 'true')
                                                                <a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`{{ env('APP_URL') }}api/v1/major-civic-and-professional-affiliations/delete/{{ $item->id }}`, `updateAffiliationsTable`, `resetAffiliationsForm`, `None`, `None`)">Delete</a>
                                                            @endif

                                                        </td>
                                                        <td>{{ $item->date_f_mcapa ?? '-' }}</td>
                                                        <td>{{ $item->date_t_mcapa ?? '-' }}</td>
                                                        <td>{{ $item->organization_mcapa ?? '-' }}</td>
                                                        <td>{{ $item->position_mcapa ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ $item->encoder ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->created_at)) ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ $item->last_updated_by ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->updated_at)) ?? '-' }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                        <!-- end major civic and professional affiliations -->
                    @endif
                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Awards and Citations Received', 'Category Only') == 'true')

                        <!-- start award and citations -->
                        <div class="tab-pane fade" id="award_and_citations" role="tabpanel" aria-labelledby="award_and_citations-tab">
                            <form class="user" id="award_and_citations_form" method="POST" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/award-and-citations/add`, `award_and_citations_form`, `Add`, `updateAwardAndCitationsTable`, `resetAwardAndCitationsForm`, `award_and_citations_form_submit`, `None`, `None`)">
                                @csrf
                                <div class="mb-3 bg-blue-500 p-2 uppercase text-white">
                                    <h1>AWARD AND CITATIONS RECEIVED</h1>
                                </div>
                                <div class="container-fuild m-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="hidden" id="cesno_award_and_citations" name="cesno" class="form-control" @if (str_contains(Request::url(), 'profile/add')) value="{{ $latestCesNo }}" @endif>
                                            <input type="hidden" id="cesno_award_and_citations_id" name="cesno_award_and_citations_id" class="form-control">
                                            <label class="form-label ml-2 mb-0">Date<sup>*</sup></label>
                                            <input type="date" name="date_aac" class="w-100 form-control mb-3" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Title of Award<sup>*</sup></label>
                                            <input type="text" name="title_of_award_aac" class="form-control w-100 mb-3" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Sponsor<sup>*</sup></label>
                                            <input type="text" name="sponsor_aac" class="form-control w-100 mb-3" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col my-3">
                                            @if (count($AwardAndCitations) === 0)
                                                @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Awards and Citations Received', 'Add') == 'true')

                                                    <input type="submit" id="award_and_citations_form_submit" class="btn btn-primary mb-1" value="Add Record">
                                                @endif
                                            @else
                                                @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Awards and Citations Received', 'Add') == 'true')

                                                    <input type="submit" id="award_and_citations_form_submit" class="btn btn-primary mb-1" value="Add Record" hidden disabled>
                                                    <input type="button" id="award_and_citations_form_go_back_to_add_record_button" class="btn btn-info mb-1" value="Go to Add Record" onclick="resetAwardAndCitationsForm()">
                                                @elseif(App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Awards and Citations Received', 'Edit') == 'true')
                                                    <input type="submit" id="award_and_citations_form_submit" class="btn btn-secondary mb-1" value="Edit Record" hidden disabled>
                                                @endif
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="overflow-auto">
                                    <table class="table-responsive-lg table-hover table">
                                        <thead class="bg-secondary bg-gardient text-white">
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Title of Award</th>
                                                <th scope="col">Sponsor</th>
                                                <th scope="col">Encoded By</th>
                                                <th scope="col">Encoded Date</th>
                                                <th scope="col">Last Updated By</th>
                                                <th scope="col">Last Update Date</th>
                                            </tr>
                                        </thead>
                                        <tbody id="AwardAndCitations_tbody">
                                            @if (count($AwardAndCitations) === 0)

                                                <tr>
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
                                                @foreach ($AwardAndCitations as $item)
                                                    <tr>
                                                        <td>
                                                            <a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetAwardAndCitationsForm({{ $item->id }},`View`)">View</a>
                                                            @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Awards and Citations Received', 'Edit') == 'true')
                                                                <a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetAwardAndCitationsForm({{ $item->id }},`Edit`)">Edit</a>
                                                            @endif
                                                            @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Awards and Citations Received', 'Delete') == 'true')
                                                                <a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`{{ env('APP_URL') }}api/v1/award-and-citations/delete/{{ $item->id }}`, `updateAwardAndCitationsTable`, `resetAwardAndCitationsForm`, `None`, `None`)">Delete</a>
                                                            @endif

                                                        </td>
                                                        <td>{{ $item->date_aac ?? '-' }}</td>
                                                        <td>{{ $item->title_of_award_aac ?? '-' }}</td>
                                                        <td>{{ $item->sponsor_aac ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ $item->encoder ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->created_at)) ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ $item->last_updated_by ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->updated_at)) ?? '-' }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                        <!-- end award and citations -->
                    @endif
                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Case Records', 'Category Only') == 'true')

                        <!-- start case record -->
                        <div class="tab-pane fade" id="case_records" role="tabpanel" aria-labelledby="case_records-tab">
                            <form class="user" id="case_records_form" method="POST" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/case-records/add`, `case_records_form`, `Add`, `updateCaseRecordsTable`, `resetCaseRecordsForm`, `case_records_form_submit`, `None`, `None`)">
                                @csrf
                                <div class="mb-3 bg-blue-500 p-2 uppercase text-white">
                                    <h1>CASE RECORDS</h1>
                                </div>
                                <div class="container-fuild m-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="hidden" id="cesno_case_records" name="cesno" class="form-control" @if (str_contains(Request::url(), 'profile/add')) value="{{ $latestCesNo }}" @endif>
                                            <input type="hidden" id="cesno_case_records_id" name="cesno_case_records_id" class="form-control">
                                            <label class="form-label ml-2 mb-0">Parties<sup>*</sup></label>
                                            <input type="text" name="parties_case_records" class="form-control w-100 mb-3" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Offence<sup>*</sup></label>
                                            <input type="text" name="offence_case_records" class="form-control w-100 mb-3" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Nature of Offence<sup>*</sup></label>
                                            <select name="nature_case_records" aria-aria-controls='example' class="date-picker w-100 form-control mb-3" required>
                                                <option value="">Please Select</option>
                                                <option value="Administrative and Criminal">Administrative and Criminal</option>
                                                <option value="Administrative">Administrative</option>
                                                <option value="Criminal">Criminal</option>
                                                <option value="Civil Case">Civil Case</option>
                                                <option value="Violation of Sec. 3(E & F) of RA 3019">Violation of Sec. 3(E & F) of RA 3019</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Case Number<sup>*</sup></label>
                                            <input type="text" name="case_no_case_records" class="form-control w-100 mb-3" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Date Field<sup>*</sup></label>
                                            <input type="date" name="date_field_case_records" class="w-100 form-control mb-3" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Venue<sup>*</sup></label>
                                            <input type="text" name="vanue_case_records" class="form-control w-100 mb-3" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Status<sup>*</sup></label>
                                            <select name="status_case_records" aria-aria-controls='example' class="date-picker w-100 form-control mb-3" required>
                                                <option value="">Please Select</option>
                                                <option value="Acquitted">Acquitted</option>
                                                <option value="Admonished">Admonished</option>
                                                <option value="Awaiting for Formal Investigation">Awaiting for Formal Investigation</option>
                                                <option value="Bail Posted">Bail Posted</option>
                                                <option value="Case dismissed for Lack of Evidence as Approve">Case dismissed for Lack of Evidence as Approve</option>
                                                <option value="Convicted">Convicted</option>
                                                <option value="Dismissed">Dismissed</option>
                                                <option value="Decided">Decided</option>
                                                <option value="Exonerated">Exonerated</option>
                                                <option value="Exonerated (Case Dismissed for Lack of Substance)">Exonerated (Case Dismissed for Lack of Substance)</option>
                                                <option value="Final and Executory">Final and Executory</option>
                                                <option value="For Arraignment">For Arraignment</option>
                                                <option value="For Creation of a Hearing Committee">For Creation of a Hearing Committee</option>
                                                <option value="For Formal Investigation">For Formal Investigation</option>
                                                <option value="Forwarded to OP">Forwarded to OP</option>
                                                <option value="Guilty for Simple Misconduct">Guilty for Simple Misconduct</option>
                                                <option value="Guilty for Simple Negligence">Guilty for Simple Negligence</option>
                                                <option value="Indorsed to OMB">Indorsed to OMB</option>
                                                <option value="On Appeal">On Appeal</option>
                                                <option value="Ongoing Investigation">Ongoing Investigation</option>
                                                <option value="Ongoing Pleminary Investigation">Ongoing Pleminary Investigation</option>
                                                <option value="Ongoing Admistrative Adjudication">Ongoing Admistrative Adjudication</option>
                                                <option value="Order of Dismissal">Order of Dismissal</option>
                                                <option value="Pending">Pending</option>
                                                <option value="Pending - Indoresed to OMB">Pending - Indoresed to OMB</option>
                                                <option value="Pending - Indorsed to OP">Pending - Indorsed to OP</option>
                                                <option value="Pending - CA">Pending - CA</option>
                                                <option value="Resolved">Resolved</option>
                                                <option value="Suspension">Suspension</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Date of Finality<sup>*</sup></label>
                                            <input type="date" name="dof_case_records" class="form-control w-100 mb-3" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="form-label ml-2 mb-0">Decision<sup>*</sup></label>
                                            <input type="text" name="decision_case_records" class="form-control w-100 mb-3" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="form-label ml-2 mb-0">Remarks<sup>*</sup></label>
                                            <textarea name="remarks_case_records" class="form-control w-100 mb-3 rounded" style="text-transform:capitalize" rows="4" required></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col my-3">
                                            @if (count($CaseRecords) === 0)
                                                @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Case Records', 'Add') == 'true')

                                                    <input type="submit" id="case_records_form_submit" class="btn btn-primary mb-1" value="Add Record">
                                                @endif
                                            @else
                                                @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Case Records', 'Add') == 'true')

                                                    <input type="submit" id="case_records_form_submit" class="btn btn-primary mb-1" value="Add Record" hidden disabled>
                                                    <input type="button" id="case_records_form_go_back_to_add_record_button" class="btn btn-info mb-1" value="Go to Add Record" onclick="resetCaseRecordsForm()">
                                                @elseif(App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Case Records', 'Edit') == 'true')
                                                    <input type="submit" id="case_records_form_submit" class="btn btn-secondary mb-1" value="Edit Record" hidden disabled>
                                                @endif
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="overflow-auto">
                                    <table class="table-responsive-lg table-hover table">
                                        <thead class="bg-secondary bg-gardient text-white">
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">Parties</th>
                                                <th scope="col">Offence</th>
                                                <th scope="col">Nature of Offence</th>
                                                <th scope="col">Case Number</th>
                                                <th scope="col">Date Field</th>
                                                <th scope="col">Vanue</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Date of Finality</th>
                                                <th scope="col">Decision</th>
                                                <th scope="col">Remarks</th>
                                                <th scope="col">Encoded By</th>
                                                <th scope="col">Encoded Date</th>
                                                <th scope="col">Last Updated By</th>
                                                <th scope="col">Last Update Date</th>
                                            </tr>
                                        </thead>
                                        <tbody id="CaseRecords_tbody">
                                            @if (count($CaseRecords) === 0)

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
                                                </tr>
                                            @else
                                                @foreach ($CaseRecords as $item)
                                                    <tr>
                                                        <td>
                                                            <a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetCaseRecordsForm({{ $item->id }},`View`)">View</a>
                                                            @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Case Records', 'Edit') == 'true')
                                                                <a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetCaseRecordsForm({{ $item->id }},`Edit`)">Edit</a>
                                                            @endif
                                                            @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Case Records', 'Delete') == 'true')
                                                                <a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`{{ env('APP_URL') }}api/v1/case-records/delete/{{ $item->id }}`, `updateCaseRecordsTable`, `resetCaseRecordsForm`, `None`, `None`)">Delete</a>
                                                            @endif

                                                        </td>
                                                        <td>{{ $item->parties_case_records ?? '-' }}</td>
                                                        <td>{{ $item->offence_case_records ?? '-' }}</td>
                                                        <td>{{ $item->nature_case_records ?? '-' }}</td>
                                                        <td>{{ $item->case_no_case_records ?? '-' }}</td>
                                                        <td>{{ $item->date_field_case_records ?? '-' }}</td>
                                                        <td>{{ $item->vanue_case_records ?? '-' }}</td>
                                                        <td>{{ $item->status_case_records ?? '-' }}</td>
                                                        <td>{{ $item->dof_case_records ?? '-' }}</td>
                                                        <td>{{ $item->decision_case_records ?? '-' }}</td>
                                                        <td>{{ $item->remarks_case_records ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ $item->encoder ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->created_at)) ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ $item->last_updated_by ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->updated_at)) ?? '-' }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                        <!-- end case record -->
                    @endif
                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Health Record', 'Category Only') == 'true')

                        <!-- start health record -->
                        <div class="tab-pane fade" id="health_records" role="tabpanel" aria-labelledby="health_records-tab">
                            <form class="user" id="health_records_magna_carta_for_disabled_persons_form" method="POST" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/health-records/add`, `health_records_magna_carta_for_disabled_persons_form`, `Add`, `updateHealthRecordsTable`, `resetHealthRecordsForm`, `health_records_magna_carta_for_disabled_persons_form_submit`, `None`, `None`)">
                                @csrf
                                <div class="mb-3 bg-blue-500 p-2 uppercase text-white">
                                    <h1>HEALTH RECORDS</h1>
                                </div>
                                <div class="container-fuild m-3">
                                    <div class="row">
                                        <div class="col-md-6 ml-3">
                                            <input type="hidden" id="cesno_health_records_magna_carta_for_disabled_persons" name="cesno" class="form-control" @if (str_contains(Request::url(), 'profile/add')) value="{{ $latestCesNo }}" @endif>
                                            <input type="hidden" id="cesno_health_records_magna_carta_for_disabled_persons_id" name="cesno_health_records_magna_carta_for_disabled_persons_id" class="form-control">
                                            <input class="form-check-input" type="checkbox" id="dhdCheckB">
                                            <label class="form-label ml-2 mb-0" for="DHD">If (Magna Carta for Disabled Persons RA 7277)</label>
                                            <select name="mcfdpra_hr" id="dhdTxtB" disabled aria-aria-controls='example' class="w-75 form-control mb-3">
                                                <option value="">Please Indicate</option>
                                                <option value="Disability">Disability</option>
                                                <option value="Handicap">Handicap</option>
                                                <option value="Defect">Defect</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Blood Type<sup>*</sup></label>
                                            <input type="text" name="blood_type_hr" class="form-control w-100 mb-3" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Identifying Marks<sup>*</sup></label>
                                            <input type="text" name="identify_marks_hr" class="form-control w-100 mb-3" style="text-transform:capitalize" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col my-3">
                                            @if (count($HealthRecords) === 0)
                                                @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Health Record', 'Add') == 'true')

                                                    <input type="submit" id="health_records_magna_carta_for_disabled_persons_form_submit" class="btn btn-primary mb-1" value="Add Record">
                                                @endif
                                            @else
                                                @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Health Record', 'Add') == 'true')

                                                    <input type="submit" id="health_records_magna_carta_for_disabled_persons_form_submit" class="btn btn-primary mb-1" value="Add Record" hidden disabled>
                                                    <input type="button" id="health_records_magna_carta_for_disabled_persons_form_go_back_to_add_record_button" class="btn btn-info mb-1" value="Go to Add Record" onclick="resetHealthRecordsForm()">
                                                @elseif(App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Health Record', 'Edit') == 'true')
                                                    <input type="submit" id="health_records_magna_carta_for_disabled_persons_form_submit" class="btn btn-secondary mb-1" value="Edit Record" hidden disabled>
                                                @endif
                                            @endif

                                        </div>
                                    </div>

                                </div>
                                <div class="overflow-auto">
                                    <table class="table-responsive-lg table-hover table">
                                        <thead class="bg-secondary bg-gardient text-white">
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">Magna Carta for Disabled Person</th>
                                                <th scope="col">BloodType</th>
                                                <th scope="col">Identifying Marks</th>
                                                <th scope="col">Encoded By</th>
                                                <th scope="col">Encoded Date</th>
                                                <th scope="col">Last Updated By</th>
                                                <th scope="col">Last Update Date</th>
                                            </tr>
                                        </thead>
                                        <tbody id="HealthRecords_tbody">
                                            @if (count($HealthRecords) === 0)

                                                <tr>
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
                                                @foreach ($HealthRecords as $item)
                                                    <tr>
                                                        <td>
                                                            <a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetHealthRecordsForm({{ $item->id }},`View`)">View</a>
                                                            @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Health Record', 'Edit') == 'true')
                                                                <a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetHealthRecordsForm({{ $item->id }},`Edit`)">Edit</a>
                                                            @endif
                                                            @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Health Record', 'Delete') == 'true')
                                                                <a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`{{ env('APP_URL') }}api/v1/health-records/delete/{{ $item->id }}`, `updateHealthRecordsTable`, `resetHealthRecordsForm`, `None`, `None`)">Delete</a>
                                                            @endif

                                                        </td>
                                                        <td>{{ $item->mcfdpra_hr ?? '-' }}</td>
                                                        <td>{{ $item->blood_type_hr ?? '-' }}</td>
                                                        <td>{{ $item->identify_marks_hr ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ $item->encoder ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->created_at)) ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ $item->last_updated_by ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->updated_at)) ?? '-' }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                            </form>
                            <form class="user" id="health_records_historical_record_of_medical_condition_form" method="POST" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/historical-record-of-medical-condition/add`, `health_records_historical_record_of_medical_condition_form`, `Add`, `updateHistoricalRecordOfMedicalConditionTable`, `resetHistoricalRecordOfMedicalConditionForm`, `health_records_historical_record_of_medical_condition_form_submit`, `None`, `None`)">
                                @csrf
                                <div class="mb-3 bg-blue-500 p-2 uppercase text-white">
                                    <h1>HISTORICAL RECORD OF MEDICAL CONDTION</h1>
                                </div>
                                <div class="container-fuild m-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="hidden" id="cesno_health_records_historical_record_of_medical_condition" name="cesno" class="form-control" @if (str_contains(Request::url(), 'profile/add')) value="{{ $latestCesNo }}" @endif>
                                            <input type="hidden" id="cesno_health_records_historical_record_of_medical_condition_id" name="cesno_health_records_historical_record_of_medical_condition_id" class="form-control">
                                            <label class="form-label ml-2 mb-0">Date<sup>*</sup></label>
                                            <input type="date" name="date_hronc" class="form-control w-100 mb-3" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0">Medical Condition / Illness<sup>*</sup></label>
                                            <input type="text" name="mci_hronc" class="form-control w-100 mb-3" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="form-label ml-2 mb-0">Notes<sup>*</sup></label>
                                            <textarea name="notes_hronc" class="form-control w-100 mb-3 rounded" style="text-transform:capitalize" rows="4" required></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col my-3">
                                            @if (count($HistoricalRecordOfMedicalCondition) === 0)
                                                @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Health Record', 'Add') == 'true')

                                                    <input type="submit" id="health_records_historical_record_of_medical_condition_form_submit" class="btn btn-primary mb-1" value="Add Record">
                                                @endif
                                            @else
                                                @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Health Record', 'Add') == 'true')

                                                    <input type="submit" id="health_records_historical_record_of_medical_condition_form_submit" class="btn btn-primary mb-1" value="Add Record" hidden disabled>
                                                    <input type="button" id="health_records_historical_record_of_medical_condition_form_go_back_to_add_record_button" class="btn btn-info mb-1" value="Go to Add Record" onclick="resetHistoricalRecordOfMedicalConditionForm()">
                                                @elseif(App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Health Record', 'Edit') == 'true')
                                                    <input type="submit" id="health_records_historical_record_of_medical_condition_form_submit" class="btn btn-secondary mb-1" value="Edit Record" hidden disabled>
                                                @endif
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="overflow-auto">
                                    <table class="table-responsive-lg table-hover table">
                                        <thead class="bg-secondary bg-gardient text-white">
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Medical Condition / Illness</th>
                                                <th scope="col">Notes</th>
                                                <th scope="col">Encoded By</th>
                                                <th scope="col">Encoded Date</th>
                                                <th scope="col">Last Updated By</th>
                                                <th scope="col">Last Update Date</th>
                                            </tr>
                                        </thead>
                                        <tbody id="HistoricalRecordOfMedicalCondition_tbody">
                                            @if (count($HistoricalRecordOfMedicalCondition) === 0)

                                                <tr>
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
                                                @foreach ($HistoricalRecordOfMedicalCondition as $item)
                                                    <tr>
                                                        <td>
                                                            <a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetHistoricalRecordOfMedicalConditionForm({{ $item->id }},`View`)">View</a>
                                                            @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Health Record', 'Edit') == 'true')
                                                                <a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetHistoricalRecordOfMedicalConditionForm({{ $item->id }},`Edit`)">Edit</a>
                                                            @endif
                                                            @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Health Record', 'Delete') == 'true')
                                                                <a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`{{ env('APP_URL') }}api/v1/historical-record-of-medical-condition/delete/{{ $item->id }}`, `updateHistoricalRecordOfMedicalConditionTable`, `resetHistoricalRecordOfMedicalConditionForm`, `None`, `None`)">Delete</a>
                                                            @endif

                                                        </td>
                                                        <td>{{ $item->date_hronc ?? '-' }}</td>
                                                        <td>{{ $item->mci_hronc ?? '-' }}</td>
                                                        <td>{{ $item->notes_hronc ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ $item->encoder ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->created_at)) ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ $item->last_updated_by ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->updated_at)) ?? '-' }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                        <!-- end health record -->
                    @endif
                    @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Attached PDF Files', 'Category Only') == 'true')

                        <!-- start PDF files -->
                        <div class="tab-pane fade" id="pdf_files" role="tabpanel" aria-labelledby="pdf_files-tab">
                            <form class="user" id="pdf_files_form" method="POST" enctype="multipart/form-data" action="javascript:void(0);" onsubmit="submitForm(`{{ env('APP_URL') }}api/v1/pdf-files/add`, `pdf_files_form`, `Add`, `updatePdfFilesTable`, `resetPdfFilesForm`, `pdf_files_form_submit`, `None`, `None`)">
                                @csrf
                                <div class="mb-3 bg-blue-500 p-2 uppercase text-white">
                                    <h1>PDF FILES</h1>
                                </div>
                                <div class="container-fuild m-3">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <input type="hidden" id="cesno_pdf_files" name="cesno" class="form-control" @if (str_contains(Request::url(), 'profile/add')) value="{{ $latestCesNo }}" @endif>
                                            <input type="hidden" id="cesno_pdf_files_id" name="cesno_pdf_files_id" class="form-control">
                                            <label class="form-label ml-2 mb-0">Browse PDF Files<sup>*</sup></label>
                                            <input id="pdflink" name="pdflink" accept="application/pdf" type="file" onclick="validateFileSize(`pdflink`, 25)" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label ml-2 mb-0" for="validated">Validated?<sup>*</sup></label>
                                            <select name="validated" id="validated" class="form-control mb-3" required>
                                                <option value="">Please Select</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="form-label ml-2 mb-0">Remarks<sup>*</sup></label>
                                            <textarea id="remarks_pdf_files" name="remarks_pdf_files" class="form-control w-100 mb-3 rounded" style="text-transform:capitalize" rows="4" required></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col my-3">
                                            @if (count($PdfLinks) === 0)
                                                @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Attached PDF Files', 'Add') == 'true')

                                                    <input type="submit" id="pdf_files_form_submit" class="btn btn-primary mb-1" value="Add Record">
                                                @endif
                                            @else
                                                @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Attached PDF Files', 'Add') == 'true')

                                                    <input type="submit" id="pdf_files_form_submit" class="btn btn-primary mb-1" value="Add Record" hidden disabled>
                                                    <input type="button" id="pdf_files_form_go_back_to_add_record_button" class="btn btn-info mb-1" value="Go to Add Record" onclick="resetPdfFilesForm()">
                                                @elseif(App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Attached PDF Files', 'Edit') == 'true')
                                                    <input type="submit" id="pdf_files_form_submit" class="btn btn-secondary mb-1" value="Edit Record" hidden disabled>
                                                @endif
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="overflow-auto">
                                    <table class="table-responsive-lg table-hover table">
                                        <thead class="bg-secondary bg-gardient text-white">
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">Relevant Path</th>
                                                <th scope="col">Uploaded PDF files</th>
                                                <th scope="col">Validated</th>
                                                <th scope="col">Date Attached</th>
                                                <th scope="col">Remarks</th>
                                                <th scope="col">Encoded By</th>
                                                <th scope="col">Encoded Date</th>
                                                <th scope="col">Last Updated By</th>
                                                <th scope="col">Last Update Date</th>
                                            </tr>
                                        </thead>
                                        <tbody id="PDFFiles_tbody">
                                            @if (count($PdfLinks) === 0)

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
                                                </tr>
                                            @else
                                                @foreach ($PdfLinks as $item)
                                                    <tr>
                                                        <td>
                                                            <a class="badge badge-pill badge-info" href="javascript:void(0);" onclick="resetPdfFilesForm({{ $item->id }},`View`)">View</a>
                                                            @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Attached PDF Files', 'Edit') == 'true')
                                                                <a class="badge badge-pill badge-secondary" href="javascript:void(0);" onclick="resetPdfFilesForm({{ $item->id }},`Edit`)">Edit</a>
                                                            @endif
                                                            @if (App\Http\Controllers\RolesController::validateUserExecutive201RoleAccess('Attached PDF Files', 'Delete') == 'true')
                                                                <a class="badge badge-pill badge-danger" href="javascript:void(0);" onclick="deleteFunction(`{{ env('APP_URL') }}api/v1/pdf-files/delete/{{ $item->id }}`, `updatePdfFilesTable`, `resetPdfFilesForm`, `None`, `None`)">Delete</a>
                                                            @endif

                                                        </td>
                                                        <td nowrap="nowrap">{{ $item->relevant_path_pdf_files ?? '-' }}</td>
                                                        <td><a href="{{ asset('external-storage/' . ($item->relevant_path_pdf_files == '' && $item->pdflink != '' ? 'PDF Documents/201 Folder/' : $item->relevant_path_pdf_files) . $item->pdflink) }}">{{ $item->pdflink ?? '-' }}</a></td>
                                                        <td>{{ $item->validated ?? '-' }}</td>
                                                        <td>{{ strftime('%m/%d/%Y', strtotime($item->updated_at)) ?? '-' }}</td>
                                                        <td>{{ $item->remarks_pdf_files ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ $item->encoder ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->created_at)) ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ $item->last_updated_by ?? '-' }}</td>
                                                        <td nowrap="nowrap">{{ strftime('%m/%d/%Y, %r', strtotime($item->updated_at)) ?? '-' }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                        <!-- end PDF files -->
                    @endif
                @endif {{-- End hiding other category if profile/view --}}

            </div>
        </div>
    </div>

    @if (str_contains(Request::url(), 'profile/view'))
        @foreach ($personalData as $item)
            <script>
                // Disabled all elements in form
                var personal_data_form = document.forms['personal_data'];

                for (var i = 0, personal_data_formLen = personal_data_form.length; i < personal_data_formLen; i++) {
                    personal_data_form.elements[i].disabled = true;
                }

                // Populate Data to form
                var inputFieldNames = [
                    // Personal Data
                    "cesno",
                    "sp",
                    "moig",
                    "pwd",
                    "title",
                    "gsis",
                    "pagibig",
                    "philhealt",
                    "sss_no",
                    "tin",
                    "status",
                    "citizenship",
                    "d_citizenship",
                    "lastname",
                    "firstname",
                    "middlename",
                    "mi",
                    "ne",
                    "nickname",
                    "birthdate",
                    "age",
                    "birth_place",
                    "gender",
                    "civil_status",
                    "religion",
                    "height",
                    "weight",
                    // Home/Permanent address
                    "fb_pa",
                    "ns_pa",
                    "bd_pa",
                    "cm_pa",
                    "zc_pa",
                    // Mailing address
                    "fb_ma",
                    "ns_ma",
                    "bd_ma",
                    "cm_ma",
                    "zc_ma",
                    "oea_ma",
                    "telno1_ma",
                    "mobileno1_ma",
                    "mobileno2_ma",
                ];
                var inputFieldValues = [
                    // Personal Data
                    "{{ $item->cesno }}",
                    "{{ $item->sp }}",
                    "{{ $item->moig }}",
                    "{{ $item->pwd }}",
                    "{{ $item->title }}",
                    "{{ $item->gsis }}",
                    "{{ $item->pagibig }}",
                    "{{ $item->philhealt }}",
                    "{{ $item->sss_no }}",
                    "{{ $item->tin }}",
                    "{{ $item->status }}",
                    "{{ $item->citizenship }}",
                    "{{ $item->d_citizenship }}",
                    "{{ $item->lastname }}",
                    "{{ $item->firstname }}",
                    "{{ $item->middlename }}",
                    "{{ $item->mi }}",
                    "{{ $item->ne }}",
                    "{{ $item->nickname }}",
                    "{{ date_format(date_create($item->birthdate), 'Y-m-d') }}",
                    "{{ $item->age }}",
                    "{{ $item->birth_place }}",
                    "{{ $item->gender }}",
                    "{{ $item->civil_status }}",
                    "{{ $item->religion }}",
                    "{{ $item->height }}",
                    "{{ $item->weight }}",
                    // Home/Permanent address
                    "{{ $item->fb_pa }}",
                    "{{ $item->ns_pa }}",
                    "{{ $item->bd_pa }}",
                    "{{ $item->cm_pa }}",
                    "{{ $item->zc_pa }}",
                    // Mailing address
                    "{{ $item->fb_ma }}",
                    "{{ $item->ns_ma }}",
                    "{{ $item->bd_ma }}",
                    "{{ $item->cm_ma }}",
                    "{{ $item->zc_ma }}",
                    "{{ $item->oea_ma }}",
                    "{{ $item->telno1_ma }}",
                    "{{ $item->mobileno1_ma }}",
                    "{{ $item->mobileno2_ma }}",
                ];

                inputFieldNames.forEach((item, index) => {
                    document.getElementsByName(item)[0].value = inputFieldValues[index];
                })
            </script>
        @endforeach

        @foreach ($SpouseRecords as $item)
            <script>
                // Disabled all elements in form
                var spouse_records_form = document.forms['spouse_records_form'];

                for (var i = 0, spouse_records_formLen = spouse_records_form.length; i < spouse_records_formLen; i++) {
                    spouse_records_form.elements[i].disabled = true;
                }

                // Remove disabled attribute in Go Back to Add Record button
                document.getElementById('spouse_records_form_go_back_to_add_record_button').disabled = false;

                var inputFieldNames = [
                    // Family Profile Spouse
                    "lastname_sn_fp",
                    "first_sn_fp",
                    "middlename_sn_fp",
                    "ne_sn_fp",
                    "occu_sn_fp",
                    "ebn_sn_fp",
                    "eba_sn_fp",
                    "etn_sn_fp",
                    "civil_status_sn_fp",
                    "gender_sn_fp",
                    "birthdate_sn_fp",
                    "age_sn_fp",
                ];
                var inputFieldValues = [
                    // Family Profile Spouse
                    "{{ $item->lastname_sn_fp }}",
                    "{{ $item->first_sn_fp }}",
                    "{{ $item->middlename_sn_fp }}",
                    "{{ $item->ne_sn_fp }}",
                    "{{ $item->occu_sn_fp }}",
                    "{{ $item->ebn_sn_fp }}",
                    "{{ $item->eba_sn_fp }}",
                    "{{ $item->etn_sn_fp }}",
                    "{{ $item->civil_status_sn_fp }}",
                    "{{ $item->gender_sn_fp }}",
                    "{{ $item->birthdate_sn_fp }}",
                    "{{ $item->age_sn_fp }}",
                ];

                inputFieldNames.forEach((item, index) => {
                    document.getElementsByName(item)[0].value = inputFieldValues[index];
                })
            </script>
        @endforeach

        @foreach ($FamilyProfile as $item)
            <script>
                // Disabled all elements in form
                var family_profile_form = document.forms['family_profile_form'];

                for (var i = 0, family_profile_formLen = family_profile_form.length; i < family_profile_formLen; i++) {
                    family_profile_form.elements[i].disabled = true;
                }

                // Populate Data to form
                var inputFieldNames = [
                    // Family Profile Father, Mother Name
                    "fn_lastname_fp",
                    "fn_first_fp",
                    "fn_middlename_fp",
                    "fn_ne_fp",
                    "mn_lastname_fp",
                    "mn_first_fp",
                    "mn_middlename_fp",
                ];
                var inputFieldValues = [
                    // Family Profile Father, Mother Name
                    "{{ $item->fn_lastname_fp }}",
                    "{{ $item->fn_first_fp }}",
                    "{{ $item->fn_middlename_fp }}",
                    "{{ $item->fn_ne_fp }}",
                    "{{ $item->mn_lastname_fp }}",
                    "{{ $item->mn_first_fp }}",
                    "{{ $item->mn_middlename_fp }}",
                ];

                inputFieldNames.forEach((item, index) => {
                    document.getElementsByName(item)[0].value = inputFieldValues[index];
                })
            </script>
        @endforeach

        @foreach ($ChildrenRecords as $item)
            <script>
                // Disabled all elements in form
                var children_record_form = document.forms['children_record_form'];

                for (var i = 0, children_record_formLen = children_record_form.length; i < children_record_formLen; i++) {
                    children_record_form.elements[i].disabled = true;
                }

                // Remove disabled attribute in Go Back to Add Record button
                document.getElementById('children_record_form_go_back_to_add_record_button').disabled = false;

                var inputFieldNames = [
                    // Family Profile Childrens Record
                    "ch_lastname_fp",
                    "ch_first_fp",
                    "ch_middlename_fp",
                    "ch_ne_fp",
                    "ch_gender_fp",
                    "ch_birthdate_fp",
                    "ch_birthplace_fp",
                ];
                var inputFieldValues = [
                    // Family Profile Childrens Record
                    "{{ $item->ch_lastname_fp }}",
                    "{{ $item->ch_first_fp }}",
                    "{{ $item->ch_middlename_fp }}",
                    "{{ $item->ch_ne_fp }}",
                    "{{ $item->ch_gender_fp }}",
                    "{{ $item->ch_birthdate_fp }}",
                    "{{ $item->ch_birthplace_fp }}",
                ];

                inputFieldNames.forEach((item, index) => {
                    document.getElementsByName(item)[0].value = inputFieldValues[index];
                })
            </script>
        @endforeach

        @foreach ($EducationalAttainment as $item)
            <script>
                // Disabled all elements in form
                var educational_attainment_form = document.forms['educational_attainment_form'];

                for (var i = 0, educational_attainment_formLen = educational_attainment_form.length; i < educational_attainment_formLen; i++) {
                    educational_attainment_form.elements[i].disabled = true;
                }

                // Remove disabled attribute in Go Back to Add Record button
                document.getElementById('educational_attainment_form_go_back_to_add_record_button').disabled = false;

                var inputFieldNames = [
                    // Educational Background / Attainment
                    "level_ea",
                    "school_ea",
                    "degree_ea",
                    "date_grad_ea",
                    "ms_ea",
                    "school_type_ea",
                    "date_f_ea",
                    "date_t_ea",
                    "hlu_ea",
                    "ahr_ea",
                ];
                var inputFieldValues = [
                    // Educational Background / Attainment
                    "{{ $item->level_ea }}",
                    "{{ $item->school_ea }}",
                    "{{ $item->degree_ea }}",
                    "{{ $item->date_grad_ea }}",
                    "{{ $item->ms_ea }}",
                    "{{ $item->school_type_ea }}",
                    "{{ $item->date_f_ea }}",
                    "{{ $item->date_t_ea }}",
                    "{{ $item->hlu_ea }}",
                    "{{ $item->ahr_ea }}",
                ];

                inputFieldNames.forEach((item, index) => {
                    document.getElementsByName(item)[0].value = inputFieldValues[index];
                })
            </script>
        @endforeach

        @foreach ($ExaminationsTaken as $item)
            <script>
                // Disabled all elements in form
                var examinations_taken_historical_record_of_examinations_taken_form = document.forms['examinations_taken_historical_record_of_examinations_taken_form'];

                for (var i = 0, examinations_taken_historical_record_of_examinations_taken_formLen = examinations_taken_historical_record_of_examinations_taken_form.length; i < examinations_taken_historical_record_of_examinations_taken_formLen; i++) {
                    examinations_taken_historical_record_of_examinations_taken_form.elements[i].disabled = true;
                }

                // Remove disabled attribute in Go Back to Add Record button
                document.getElementById('examinations_taken_historical_record_of_examinations_taken_form_go_back_to_add_record_button').disabled = false;

                var inputFieldNames = [
                    // Examinations Taken - Historical Records of Examinations taken
                    "tox_et",
                    "rating_et",
                    "doe_et",
                    "poe_et",
                ];
                var inputFieldValues = [
                    // Examinations Taken - Historical Records of Examinations taken
                    "{{ $item->tox_et }}",
                    "{{ $item->rating_et }}",
                    "{{ $item->doe_et }}",
                    "{{ $item->poe_et }}",
                ];

                inputFieldNames.forEach((item, index) => {
                    document.getElementsByName(item)[0].value = inputFieldValues[index];
                })
            </script>
        @endforeach

        @foreach ($LicenseDetails as $item)
            <script>
                // Disabled all elements in form
                var examinations_taken_license_details_form = document.forms['examinations_taken_license_details_form'];

                for (var i = 0, examinations_taken_license_details_formLen = examinations_taken_license_details_form.length; i < examinations_taken_license_details_formLen; i++) {
                    examinations_taken_license_details_form.elements[i].disabled = true;
                }

                // Remove disabled attribute in Go Back to Add Record button
                document.getElementById('examinations_taken_license_details_form_go_back_to_add_record_button').disabled = false;

                var inputFieldNames = [
                    // Examinations Taken - License Details
                    "ld_ln_et",
                    "ld_da_et",
                    "ld_dov_et",
                ];
                var inputFieldValues = [
                    // Examinations Taken - License Details
                    "{{ $item->ld_ln_et }}",
                    "{{ $item->ld_da_et }}",
                    "{{ $item->ld_dov_et }}",
                ];

                inputFieldNames.forEach((item, index) => {
                    document.getElementsByName(item)[0].value = inputFieldValues[index];
                })
            </script>
        @endforeach

        @foreach ($LanguagesDialects as $item)
            <script>
                // Disabled all elements in form
                var languages_dialects_form = document.forms['languages_dialects_form'];

                for (var i = 0, languages_dialects_formLen = languages_dialects_form.length; i < languages_dialects_formLen; i++) {
                    languages_dialects_form.elements[i].disabled = true;
                }

                // Remove disabled attribute in Go Back to Add Record button
                document.getElementById('languages_dialects_form_go_back_to_add_record_button').disabled = false;

                var inputFieldNames = [
                    // Languages Dialects
                    "lang_languages_dialects",
                ];
                var inputFieldValues = [
                    // Languages Dialects
                    "{{ $item->lang_languages_dialects }}",
                ];

                inputFieldNames.forEach((item, index) => {
                    document.getElementsByName(item)[0].value = inputFieldValues[index];
                })
            </script>
        @endforeach

        @foreach ($CesWe as $item)
            <script>
                // Disabled all elements in form
                var ceswe_hr_form = document.forms['ceswe_hr_form'];

                for (var i = 0, ceswe_hr_formLen = ceswe_hr_form.length; i < ceswe_hr_formLen; i++) {
                    ceswe_hr_form.elements[i].disabled = true;
                }

                // Remove disabled attribute in Go Back to Add Record button
                document.getElementById('ceswe_hr_form_go_back_to_add_record_button').disabled = false;

                var inputFieldNames = [
                    // Ces We
                    "ed_ces_we",
                    "r_ces_we",
                    "rd_ces_we",
                    "poe_ces_we",
                    "tn_ces_we",
                ];
                var inputFieldValues = [
                    // Ces We
                    "{{ $item->ed_ces_we }}",
                    "{{ $item->r_ces_we }}",
                    "{{ $item->rd_ces_we }}",
                    "{{ $item->poe_ces_we }}",
                    "{{ $item->tn_ces_we }}",
                ];

                inputFieldNames.forEach((item, index) => {
                    document.getElementsByName(item)[0].value = inputFieldValues[index];
                })
            </script>
        @endforeach

        @foreach ($AssessmentCenter as $item)
            <script>
                // Disabled all elements in form
                var assessment_center_hr_form = document.forms['assessment_center_hr_form'];

                for (var i = 0, assessment_center_hr_formLen = assessment_center_hr_form.length; i < assessment_center_hr_formLen; i++) {
                    assessment_center_hr_form.elements[i].disabled = true;
                }

                // Remove disabled attribute in Go Back to Add Record button
                document.getElementById('assessment_center_hr_form_go_back_to_add_record_button').disabled = false;

                var inputFieldNames = [
                    // Assessment Center
                    "an_achr_ces_we",
                    "ad_achr_ces_we",
                    "r_achr_ces_we",
                    "cfd_achr_ces_we",
                ];
                var inputFieldValues = [
                    // Assessment Center
                    "{{ $item->an_achr_ces_we }}",
                    "{{ $item->ad_achr_ces_we }}",
                    "{{ $item->r_achr_ces_we }}",
                    "{{ $item->cfd_achr_ces_we }}",
                ];

                inputFieldNames.forEach((item, index) => {
                    document.getElementsByName(item)[0].value = inputFieldValues[index];
                })
            </script>
        @endforeach

        @foreach ($ValidationHr as $item)
            <script>
                // Disabled all elements in form
                var validation_hr_form = document.forms['validation_hr_form'];

                for (var i = 0, validation_hr_formLen = validation_hr_form.length; i < validation_hr_formLen; i++) {
                    validation_hr_form.elements[i].disabled = true;
                }

                // Remove disabled attribute in Go Back to Add Record button
                document.getElementById('validation_hr_form_go_back_to_add_record_button').disabled = false;

                var inputFieldNames = [
                    // Validation
                    "vd_vhr_ces_we",
                    "tov_vhr_ces_we",
                    "r_vhr_ces_we",
                ];
                var inputFieldValues = [
                    // Validation
                    "{{ $item->vd_vhr_ces_we }}",
                    "{{ $item->tov_vhr_ces_we }}",
                    "{{ $item->r_vhr_ces_we }}",
                ];

                inputFieldNames.forEach((item, index) => {
                    document.getElementsByName(item)[0].value = inputFieldValues[index];
                })
            </script>
        @endforeach

        @foreach ($BoardInterview as $item)
            <script>
                // Disabled all elements in form
                var board_interview_hr_form = document.forms['board_interview_hr_form'];

                for (var i = 0, board_interview_hr_formLen = board_interview_hr_form.length; i < board_interview_hr_formLen; i++) {
                    board_interview_hr_form.elements[i].disabled = true;
                }

                // Remove disabled attribute in Go Back to Add Record button
                document.getElementById('board_interview_hr_form_go_back_to_add_record_button').disabled = false;

                var inputFieldNames = [
                    // Board Interview
                    "bid_bi_ces_we",
                    "r_bi_ces_we",
                ];
                var inputFieldValues = [
                    // Board Interview
                    "{{ $item->bid_bi_ces_we }}",
                    "{{ $item->r_bi_ces_we }}",
                ];

                inputFieldNames.forEach((item, index) => {
                    document.getElementsByName(item)[0].value = inputFieldValues[index];
                })
            </script>
        @endforeach

        @foreach ($CesStatus as $item)
            <script>
                // Disabled all elements in form
                var ces_status_hr_form = document.forms['ces_status_hr_form'];

                for (var i = 0, ces_status_hr_formLen = ces_status_hr_form.length; i < ces_status_hr_formLen; i++) {
                    ces_status_hr_form.elements[i].disabled = true;
                }

                // Remove disabled attribute in Go Back to Add Record button
                document.getElementById('ces_status_hr_form_go_back_to_add_record_button').disabled = false;

                var inputFieldNames = [
                    // Ces Status
                    "cs_cs_ces_we",
                    "at_cs_ces_we",
                    "st_cs_ces_we",
                    "aa_cs_ces_we",
                    "rn_cs_ces_we",
                    "da_cs_ces_we",
                ];
                var inputFieldValues = [
                    // Ces Status
                    "{{ $item->cs_cs_ces_we }}",
                    "{{ $item->at_cs_ces_we }}",
                    "{{ $item->st_cs_ces_we }}",
                    "{{ $item->aa_cs_ces_we }}",
                    "{{ $item->rn_cs_ces_we }}",
                    "{{ $item->da_cs_ces_we }}",
                ];

                inputFieldNames.forEach((item, index) => {
                    document.getElementsByName(item)[0].value = inputFieldValues[index];
                })
            </script>
        @endforeach

        @foreach ($RecordOfCespesRatings as $item)
            <script>
                // Disabled all elements in form
                var record_of_cespes_rating_hr_form = document.forms['record_of_cespes_rating_hr_form'];

                for (var i = 0, record_of_cespes_rating_hr_formLen = record_of_cespes_rating_hr_form.length; i < record_of_cespes_rating_hr_formLen; i++) {
                    record_of_cespes_rating_hr_form.elements[i].disabled = true;
                }

                // Remove disabled attribute in Go Back to Add Record button
                document.getElementById('record_of_cespes_rating_hr_form_go_back_to_add_record_button').disabled = false;

                var inputFieldNames = [
                    // Record of Cespes Ratings
                    "date_from_rocr",
                    "date_to_rocr",
                    "rating_rocr",
                    "status_rocr",
                    "remarks_rocr",
                ];
                var inputFieldValues = [
                    // Record of Cespes Ratings
                    "{{ $item->date_from_rocr }}",
                    "{{ $item->date_to_rocr }}",
                    "{{ $item->rating_rocr }}",
                    "{{ $item->status_rocr }}",
                    "{{ $item->remarks_rocr }}",
                ];

                inputFieldNames.forEach((item, index) => {
                    document.getElementsByName(item)[0].value = inputFieldValues[index];
                })
            </script>
        @endforeach

        @foreach ($WorkExperience as $item)
            <script>
                // Disabled all elements in form
                var work_experience_form = document.forms['work_experience_form'];

                for (var i = 0, work_experience_formLen = work_experience_form.length; i < work_experience_formLen; i++) {
                    work_experience_form.elements[i].disabled = true;
                }

                // Remove disabled attribute in Go Back to Add Record button
                document.getElementById('work_experience_form_go_back_to_add_record_button').disabled = false;

                var inputFieldNames = [
                    // Work Experience
                    "date_from_work_experience",
                    "date_to_work_experience",
                    "destination_from_work_experience",
                    "status_from_work_experience",
                    "salary_from_work_experience",
                    "salary_job_pay_grade_work_experience",
                    "status_of_appointment_work_experience",
                    "government_service_work_experience",
                    "department_from_work_experience",
                    "remarks_from_work_experience",
                ];
                var inputFieldValues = [
                    // Work Experience
                    "{{ $item->date_from_work_experience }}",
                    "{{ $item->date_to_work_experience }}",
                    "{{ $item->destination_from_work_experience }}",
                    "{{ $item->status_from_work_experience }}",
                    "{{ $item->salary_from_work_experience }}",
                    "{{ $item->salary_job_pay_grade_work_experience }}",
                    "{{ $item->status_of_appointment_work_experience }}",
                    "{{ $item->government_service_work_experience }}",
                    "{{ $item->department_from_work_experience }}",
                    "{{ $item->remarks_from_work_experience }}",
                ];

                inputFieldNames.forEach((item, index) => {
                    document.getElementsByName(item)[0].value = inputFieldValues[index];
                })
            </script>
        @endforeach

        @foreach ($FieldExpertise as $item)
            <script>
                // Disabled all elements in form
                var field_expertise_form = document.forms['field_expertise_form'];

                for (var i = 0, field_expertise_formLen = field_expertise_form.length; i < field_expertise_formLen; i++) {
                    field_expertise_form.elements[i].disabled = true;
                }

                // Remove disabled attribute in Go Back to Add Record button
                document.getElementById('field_expertise_form_go_back_to_add_record_button').disabled = false;

                var inputFieldNames = [
                    // Field Expertise
                    "ec_field_expertise",
                    "ss_field_expertise",
                ];
                var inputFieldValues = [
                    // Field Expertise
                    "{{ $item->ec_field_expertise }}",
                    "{{ $item->ss_field_expertise }}",
                ];

                inputFieldNames.forEach((item, index) => {
                    document.getElementsByName(item)[0].value = inputFieldValues[index];
                })
            </script>
        @endforeach

        @foreach ($CesTrainings as $item)
            <script>
                // Disabled all elements in form
                var ces_trainings_form = document.forms['ces_trainings_form'];

                for (var i = 0, ces_trainings_formLen = ces_trainings_form.length; i < ces_trainings_formLen; i++) {
                    ces_trainings_form.elements[i].disabled = true;
                }

                // Remove disabled attribute in Go Back to Add Record button
                document.getElementById('ces_trainings_form_go_back_to_add_record_button').disabled = false;

                var inputFieldNames = [
                    // Ces Trainings
                    "date_f_ces_trainings",
                    "date_t_ces_trainings",
                    "s_title_ces_trainings",
                    "s_no_ces_trainings",
                    "training_category_ces_trainings",
                    "fos_ces_trainings",
                    "venue_ces_trainings",
                    "noh_ces_trainings",
                    "barrio_ces_trainings",
                    "rs_ces_trainings",
                    "sd_ces_trainings",
                    "training_status_ces_trainings",
                    "remarks_ces_trainings",
                ];
                var inputFieldValues = [
                    // Ces Trainings
                    "{{ $item->date_f_ces_trainings }}",
                    "{{ $item->date_t_ces_trainings }}",
                    "{{ $item->s_title_ces_trainings }}",
                    "{{ $item->s_no_ces_trainings }}",
                    "{{ $item->training_category_ces_trainings }}",
                    "{{ $item->fos_ces_trainings }}",
                    "{{ $item->venue_ces_trainings }}",
                    "{{ $item->noh_ces_trainings }}",
                    "{{ $item->barrio_ces_trainings }}",
                    "{{ $item->rs_ces_trainings }}",
                    "{{ $item->sd_ces_trainings }}",
                    "{{ $item->training_status_ces_trainings }}",
                    "{{ $item->remarks_ces_trainings }}",
                ];

                inputFieldNames.forEach((item, index) => {
                    document.getElementsByName(item)[0].value = inputFieldValues[index];
                })
            </script>
        @endforeach

        @foreach ($OtherManagementTrainings as $item)
            <script>
                // Disabled all elements in form
                var other_management_trainings_form = document.forms['other_management_trainings_form'];

                for (var i = 0, other_management_trainings_formLen = other_management_trainings_form.length; i < other_management_trainings_formLen; i++) {
                    other_management_trainings_form.elements[i].disabled = true;
                }

                // Remove disabled attribute in Go Back to Add Record button
                document.getElementById('other_management_trainings_form_go_back_to_add_record_button').disabled = false;

                var inputFieldNames = [
                    // Other Trainings
                    "date_f_onat",
                    "date_t_onat",
                    "title_traning_onat",
                    "training_category_onat",
                    "expertise_fos_onat",
                    "sponsor_tp_onat",
                    "vanue_onat",
                    "no_training_hours_omt",
                ];
                var inputFieldValues = [
                    // Other Trainings
                    "{{ $item->date_f_onat }}",
                    "{{ $item->date_t_onat }}",
                    "{{ $item->title_traning_onat }}",
                    "{{ $item->training_category_onat }}",
                    "{{ $item->expertise_fos_onat }}",
                    "{{ $item->sponsor_tp_onat }}",
                    "{{ $item->vanue_onat }}",
                    "{{ $item->no_training_hours_omt }}",
                ];

                inputFieldNames.forEach((item, index) => {
                    document.getElementsByName(item)[0].value = inputFieldValues[index];
                })
            </script>
        @endforeach

        @foreach ($ResearchAndStudies as $item)
            <script>
                // Disabled all elements in form
                var research_and_studies_form = document.forms['research_and_studies_form'];

                for (var i = 0, research_and_studies_formLen = research_and_studies_form.length; i < research_and_studies_formLen; i++) {
                    research_and_studies_form.elements[i].disabled = true;
                }

                // Remove disabled attribute in Go Back to Add Record button
                document.getElementById('research_and_studies_form_go_back_to_add_record_button').disabled = false;

                var inputFieldNames = [
                    // Research And Studies
                    "date_f_ras",
                    "date_t_ras",
                    "title_ras",
                    "publisher_ras",
                ];
                var inputFieldValues = [
                    // Research And Studies
                    "{{ $item->date_f_ras }}",
                    "{{ $item->date_t_ras }}",
                    "{{ $item->title_ras }}",
                    "{{ $item->publisher_ras }}",
                ];

                inputFieldNames.forEach((item, index) => {
                    document.getElementsByName(item)[0].value = inputFieldValues[index];
                })
            </script>
        @endforeach

        @foreach ($Scholarships as $item)
            <script>
                // Disabled all elements in form
                var scholarships_form = document.forms['scholarships_form'];

                for (var i = 0, scholarships_formLen = scholarships_form.length; i < scholarships_formLen; i++) {
                    scholarships_form.elements[i].disabled = true;
                }

                // Remove disabled attribute in Go Back to Add Record button
                document.getElementById('scholarships_form_go_back_to_add_record_button').disabled = false;

                var inputFieldNames = [
                    // Scholarships
                    "date_f_scholarships",
                    "date_t_scholarships",
                    "scholar_type_scholarships",
                    "title_scholarships",
                    "sponsor_scholarships",
                ];
                var inputFieldValues = [
                    // Scholarships
                    "{{ $item->date_f_scholarships }}",
                    "{{ $item->date_t_scholarships }}",
                    "{{ $item->scholar_type_scholarships }}",
                    "{{ $item->title_scholarships }}",
                    "{{ $item->sponsor_scholarships }}",
                ];

                inputFieldNames.forEach((item, index) => {
                    document.getElementsByName(item)[0].value = inputFieldValues[index];
                })
            </script>
        @endforeach

        @foreach ($Affiliations as $item)
            <script>
                // Disabled all elements in form
                var major_civic_and_professional_affiliations_form = document.forms['major_civic_and_professional_affiliations_form'];

                for (var i = 0, major_civic_and_professional_affiliations_formLen = major_civic_and_professional_affiliations_form.length; i < major_civic_and_professional_affiliations_formLen; i++) {
                    major_civic_and_professional_affiliations_form.elements[i].disabled = true;
                }

                // Remove disabled attribute in Go Back to Add Record button
                document.getElementById('major_civic_and_professional_affiliations_form_go_back_to_add_record_button').disabled = false;

                var inputFieldNames = [
                    // Major Civic and Professional Affiliations
                    "date_f_mcapa",
                    "date_t_mcapa",
                    "organization_mcapa",
                    "position_mcapa",
                ];
                var inputFieldValues = [
                    // Major Civic and Professional Affiliations
                    "{{ $item->date_f_mcapa }}",
                    "{{ $item->date_t_mcapa }}",
                    "{{ $item->organization_mcapa }}",
                    "{{ $item->position_mcapa }}",
                ];

                inputFieldNames.forEach((item, index) => {
                    document.getElementsByName(item)[0].value = inputFieldValues[index];
                })
            </script>
        @endforeach

        @foreach ($AwardAndCitations as $item)
            <script>
                // Disabled all elements in form
                var award_and_citations_form = document.forms['award_and_citations_form'];

                for (var i = 0, award_and_citations_formLen = award_and_citations_form.length; i < award_and_citations_formLen; i++) {
                    award_and_citations_form.elements[i].disabled = true;
                }

                // Remove disabled attribute in Go Back to Add Record button
                document.getElementById('award_and_citations_form_go_back_to_add_record_button').disabled = false;

                var inputFieldNames = [
                    // Award And Citations
                    "date_aac",
                    "title_of_award_aac",
                    "sponsor_aac",
                ];
                var inputFieldValues = [
                    // Award And Citations
                    "{{ $item->date_aac }}",
                    "{{ $item->title_of_award_aac }}",
                    "{{ $item->sponsor_aac }}",
                ];

                inputFieldNames.forEach((item, index) => {
                    document.getElementsByName(item)[0].value = inputFieldValues[index];
                })
            </script>
        @endforeach

        @foreach ($CaseRecords as $item)
            <script>
                // Disabled all elements in form
                var case_records_form = document.forms['case_records_form'];

                for (var i = 0, case_records_formLen = case_records_form.length; i < case_records_formLen; i++) {
                    case_records_form.elements[i].disabled = true;
                }

                // Remove disabled attribute in Go Back to Add Record button
                document.getElementById('case_records_form_go_back_to_add_record_button').disabled = false;

                var inputFieldNames = [
                    // Case Records
                    "parties_case_records",
                    "offence_case_records",
                    "nature_case_records",
                    "case_no_case_records",
                    "date_field_case_records",
                    "vanue_case_records",
                    "status_case_records",
                    "dof_case_records",
                    "decision_case_records",
                    "remarks_case_records",
                ];
                var inputFieldValues = [
                    // Case Records
                    "{{ $item->parties_case_records }}",
                    "{{ $item->offence_case_records }}",
                    "{{ $item->nature_case_records }}",
                    "{{ $item->case_no_case_records }}",
                    "{{ $item->date_field_case_records }}",
                    "{{ $item->vanue_case_records }}",
                    "{{ $item->status_case_records }}",
                    "{{ $item->dof_case_records }}",
                    "{{ $item->decision_case_records }}",
                    "{{ $item->remarks_case_records }}",
                ];

                inputFieldNames.forEach((item, index) => {
                    document.getElementsByName(item)[0].value = inputFieldValues[index];
                })
            </script>
        @endforeach

        @foreach ($HealthRecords as $item)
            <script>
                // Disabled all elements in form
                var health_records_magna_carta_for_disabled_persons_form = document.forms['health_records_magna_carta_for_disabled_persons_form'];

                for (var i = 0, health_records_magna_carta_for_disabled_persons_formLen = health_records_magna_carta_for_disabled_persons_form.length; i < health_records_magna_carta_for_disabled_persons_formLen; i++) {
                    health_records_magna_carta_for_disabled_persons_form.elements[i].disabled = true;
                }

                // Remove disabled attribute in Go Back to Add Record button
                document.getElementById('health_records_magna_carta_for_disabled_persons_form_go_back_to_add_record_button').disabled = false;

                var inputFieldNames = [
                    // Health Records - Magna Carta
                    "mcfdpra_hr",
                    "blood_type_hr",
                    "identify_marks_hr",
                ];
                var inputFieldValues = [
                    // Health Records - Magna Carta
                    "{{ $item->mcfdpra_hr }}",
                    "{{ $item->blood_type_hr }}",
                    "{{ $item->identify_marks_hr }}",
                ];

                inputFieldNames.forEach((item, index) => {
                    document.getElementsByName(item)[0].value = inputFieldValues[index];
                })
            </script>
        @endforeach

        @foreach ($HistoricalRecordOfMedicalCondition as $item)
            <script>
                // Disabled all elements in form
                var health_records_historical_record_of_medical_condition_form = document.forms['health_records_historical_record_of_medical_condition_form'];

                for (var i = 0, health_records_historical_record_of_medical_condition_formLen = health_records_historical_record_of_medical_condition_form.length; i < health_records_historical_record_of_medical_condition_formLen; i++) {
                    health_records_historical_record_of_medical_condition_form.elements[i].disabled = true;
                }

                // Remove disabled attribute in Go Back to Add Record button
                document.getElementById('health_records_historical_record_of_medical_condition_form_go_back_to_add_record_button').disabled = false;

                var inputFieldNames = [
                    // Health Records - Historical Record of Medical Condition
                    "date_hronc",
                    "mci_hronc",
                    "notes_hronc",
                ];
                var inputFieldValues = [
                    // Health Records - Historical Record of Medical Condition
                    "{{ $item->date_hronc }}",
                    "{{ $item->mci_hronc }}",
                    "{{ $item->notes_hronc }}",
                ];

                inputFieldNames.forEach((item, index) => {
                    document.getElementsByName(item)[0].value = inputFieldValues[index];
                })
            </script>
        @endforeach

        @foreach ($PdfLinks as $item)
            <script>
                // Disabled all elements in form
                var pdf_files_form = document.forms['pdf_files_form'];

                for (var i = 0, pdf_files_formLen = pdf_files_form.length; i < pdf_files_formLen; i++) {
                    pdf_files_form.elements[i].disabled = true;
                }

                // Remove disabled attribute in Go Back to Add Record button
                document.getElementById('pdf_files_form_go_back_to_add_record_button').disabled = false;

                var inputFieldNames = [
                    // PDF Files
                    "validated",
                    "remarks_pdf_files",
                ];
                var inputFieldValues = [
                    // PDF Files
                    "{{ $item->validated }}",
                    "{{ $item->remarks_pdf_files }}",
                ];

                inputFieldNames.forEach((item, index) => {
                    document.getElementsByName(item)[0].value = inputFieldValues[index];
                })
            </script>
        @endforeach
    @endif

    <script>
        $('#onlyYear').datepicker({
            minViewMode: 2,
            format: 'yyyy'
        });
    </script>
    </section>
    </div>

@endsection
