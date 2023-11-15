@extends('layouts.app')
@section('title', 'Create 201 profile')
@section('content')

    {{-- malaking blue sa taas --}}
    <div class="@if (str_contains(Request::url(), 'profile/view'))  @endif">
        <!-- Main content -->

        <section class="content @if (str_contains(Request::url(), 'profile/view')) @if (Auth::user()->role == 'User') ml-2 col @else col-md-9 @endif @endif">
            @if (str_contains(Request::url(), 'profile/view'))

                <div class="bg-blue-500 text-left text-white">
                    <div class="flex justify-between p-5">
                        <div>
                            @foreach ($personalData as $item)
                                <h1 class="text-2xl uppercase">{{ $item->lastname }} {{ $item->firstname }} {{ $item->ne }} {{ $item->middlename }}</h1>
                                <h3 class="h6">CES number <span class="bg-danger h6 rounded py-1 px-2">{{ $item->cesno }}</span></h3>
                            @endforeach

                            <div class="col-auto mt-2 mr-3 p-0">
                                <h1>Ac No.
                                    @if ($AssessmentCenter == '[]')
                                        ---
                                    @else
                                        @foreach ($AssessmentCenter as $item)
                                            {{ $loop->last ? $item->an_achr_ces_we : '' }}
                                        @endforeach
                                    @endif
                                </h1>
                            </div>

                            <div class="col-auto mt-2 mr-3 p-0">
                                <h1 class="h6">CES Status:
                                    <span id="profile_ces_status" class="@foreach ($personalData as $item) @if ($item->status == 'Retired') bg-danger @elseif($item->status == 'Deceased') bg-dark @else bg-success @endif @endforeach h6 rounded py-1 px-2">
                                        @if ($CesStatus == '[]')---
                                        @else
                                            @foreach ($CesStatus as $item)
                                                {{ $loop->last ? $item->cs_cs_ces_we : '' }}
                                            @endforeach
                                        @endif
                                    </span>
                                </h1>
                            </div>
                        </div>

                        <div>
                            @foreach ($personalData as $item)
                                <img id="profile_picture" src="{{ $item->picture == '' ? asset('images/assets/branding.png') : asset('external-storage/Photos/201 Photos/' . $item->picture) }}" onerror="this.src = '{{ asset('images/assets/branding.png') }}'" class="rounded-full" height="190" width="190">
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </section>

    </div>

    {{-- category section --}}
    <section class="grid grid-cols-6" id="myTab" role="tablist">

        {{-- Start hiding other category if profile/view --}}
        @if (str_contains(Request::url(), 'profile/view'))
            <a class="btn category-button text-blue-500" href="#personDataTab" onclick="personDataTab()">Personal Data</a>
            <a class="btn category-button" href="#familyProfileTab" onclick="familyProfileTab()">Family Profile</a>
            <a class="btn category-button" href="#educationalAttainmentTab" onclick="educationalAttainmentTab()">Educational Background / Attainment</a>
            <a class="btn category-button" href="#examinationsTakenTab" onclick="examinationsTakenTab()">Examinations Taken</a>
            <a class="btn category-button" href="#languagesDialectsTab" onclick="languagesDialectsTab()">Languages Dialects</a>
            <a class="btn category-button" href="#eligibilityAndRankTrackerTab" onclick="eligibilityAndRankTrackerTab()">Eligibility and Rank Tracker</a>
            <a class="btn category-button" href="#recordOfCespesRatingHrTab" onclick="recordOfCespesRatingHrTab()">Record of Cespes Ratings</a>
            <a class="btn category-button" href="#workExperienceTab" onclick="workExperienceTab()">Work Experience</a>
            <a class="btn category-button" href="#fieldExpertiseTab" onclick="fieldExpertiseTab()">Field Expertise</a>
            <a class="btn category-button" href="#cesTrainingsTab" onclick="cesTrainingsTab()">Ces Trainings</a>
            <a class="btn category-button" href="#otherManagementTrainingsTab" onclick="otherManagementTrainingsTab()">Other Trainings</a>
            <a class="btn category-button" href="#researchAndStudiesTab" onclick="researchAndStudiesTab()">Research And Studies</a>
            <a class="btn category-button" href="#scholarshipsTab" onclick="scholarshipsTab()">Scholarships</a>
            <a class="btn category-button" href="#majorCivicAndProfessionalAffiliationsTab" onclick="majorCivicAndProfessionalAffiliationsTab()">Major Civic and Professional Affiliations</a>
            <a class="btn category-button" href="#awardAndCitationsTab" onclick="awardAndCitationsTab()">Award And Citations</a>
            <a class="btn category-button" href="#caseRecordsTab" onclick="caseRecordsTab()">Case Records</a>
            <a class="btn category-button" href="#healthRecordsTab" onclick="healthRecordsTab()">Health Records</a>
            <a class="btn category-button" href="#pdfFilesTab" onclick="pdfFilesTab()">PDF Files</a>
        @endif

    </section>
    <hr>
    {{-- End hiding other category if profile/view --}}

    <div class="grid">
        {{-- Start hiding other category if profile/view --}}
        <div class="category personDataTab">
            @include('admin.201_profiling.partials.personal_data')
        </div>

        @if (str_contains(Request::url(), 'profile/view'))

            <div class="category familyProfileTab hidden">
                @include('admin.201_profiling.partials.family_profile')
            </div>

            <div class="category educationalAttainmentTab hidden">
                @include('admin.201_profiling.partials.educational_attainment')
            </div>

            <div class="category examinationsTakenTab hidden">
                @include('admin.201_profiling.partials.examinations_taken')
            </div>

            <div class="category languagesDialectsTab hidden">
                @include('admin.201_profiling.partials.languages_dialects')
            </div>

            <div class="category eligibilityAndRankTrackerTab hidden">
                @include('admin.201_profiling.partials.eligibility_and_rank_tracker')
            </div>

            <div class="category recordOfCespesRatingHrTab hidden">
                @include('admin.201_profiling.partials.record_of_cespes_rating_hr')
            </div>

            <div class="category workExperienceTab hidden">
                @include('admin.201_profiling.partials.work_experience')
            </div>

            <div class="category fieldExpertiseTab hidden">
                @include('admin.201_profiling.partials.field_expertise')
            </div>

            <div class="category cesTrainingsTab hidden">
                @include('admin.201_profiling.partials.ces_trainings')
            </div>

            <div class="category otherManagementTrainingsTab hidden">
                @include('admin.201_profiling.partials.other_management_trainings')
            </div>

            <div class="category researchAndStudiesTab hidden">
                @include('admin.201_profiling.partials.research_and_studies')
            </div>

            <div class="category scholarshipsTab hidden">
                @include('admin.201_profiling.partials.scholarships')
            </div>

            <div class="category majorCivicAndProfessionalAffiliationsTab hidden">
                @include('admin.201_profiling.partials.major_civic_and_professional_affiliations')
            </div>

            <div class="category awardAndCitationsTab hidden">
                @include('admin.201_profiling.partials.award_and_citations')
            </div>

            <div class="category caseRecordsTab hidden">
                @include('admin.201_profiling.partials.case_records')
            </div>

            <div class="category healthRecordsTab hidden">
                @include('admin.201_profiling.partials.health_records')
            </div>

            <div class="category pdfFilesTab hidden">
                @include('admin.201_profiling.partials.pdf_files')
            </div>

        @endif
        {{-- End hiding other category if profile/view --}}
    </div>

    {{-- script for auto fill --}}
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

@endsection
