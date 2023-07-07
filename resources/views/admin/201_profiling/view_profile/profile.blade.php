@extends('layouts.app')
@section('title', 'Create 201 profile')
@section('content')

    <div class="grid-rows-7 grid grid-cols-4 gap-1">
        <div class="row-span-5">
            <img src="{{ asset('images/avatar/' . ($mainProfile->avatar ?: 'placeholder.png')) }}" class="h-50 w-96" />

            <h1 class="text-bold text-2xl">
                {{ $mainProfile->title }} {{ $mainProfile->lastname }} {{ $mainProfile->firstname }} {{ $mainProfile->extension_name }} {{ $mainProfile->middlename }}
            </h1>
            <p class="btn @if ($mainProfile->status === 'Active') text-green-800 bg-green-100 @endif @if ($mainProfile->status === 'Inactive') text-orange-800 bg-orange-100 @endif @if ($mainProfile->status === 'Retire') text-red-800 bg-red-100 @endif @if ($mainProfile->status === 'Deceased') text-yellow-800 bg-yellow-100 @endif">
                {{ $mainProfile->status }}
            </p>
            <p>CES number: {{ $mainProfile->cesno }}</p>
        </div>

        <div class="col-span-3">
            <div class="grid lg:grid-cols-5 sm:grid-cols-1">

                {{-- NAVIGATION --}}
                <div>
                    <button id="dropdownDefaultButton" data-dropdown-toggle="personalDataTab" class="inline-flex items-center rounded-lg px-5 py-2.5 text-center text-sm font-medium uppercase focus:outline-none focus:ring-4 focus:ring-blue-300" type="button">
                        Personal Information
                        <svg class="ml-2.5 h-2.5 w-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <!-- personalDataTab menu -->
                    <div id="personalDataTab" class="z-10 hidden w-44 divide-y divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700">
                        <ul class="py-2 text-sm uppercase text-gray-700" aria-labelledby="dropdownDefaultButton">
                            <li>
                                <a class="inline-flex btn category-button text-blue-500" href="#personDataTab" onclick="personDataTab()">Personal Data</a>
                            </li>
                            <li>
                                <a class="inline-flex btn category-button" href="#familyProfileTab" onclick="familyProfileTab()">Family Profile</a>
                            </li>
                            <li>
                                <a class="inline-flex btn category-button" href="#addressTab" onclick="addressTab()">Address</a>
                            </li>
                            <li>
                                <a class="inline-flex btn category-button" href="#identificationTab" onclick="identificationTab()">Identification Card</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div>
                    <button id="dropdownDefaultButton" data-dropdown-toggle="educationalAttainmentTab" class="inline-flex items-center rounded-lg px-5 py-2.5 text-center text-sm font-medium uppercase focus:outline-none focus:ring-4 focus:ring-blue-300" type="button">
                        Education
                        <svg class="ml-2.5 h-2.5 w-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <!-- educationalAttainmentTab menu -->
                    <div id="educationalAttainmentTab" class="z-10 hidden w-44 divide-y divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700">
                        <ul class="py-2 text-sm uppercase text-gray-700" aria-labelledby="dropdownDefaultButton">
                            <li>
                                <a class="inline-flex btn category-button" href="#educationalAttainmentTab" onclick="educationalAttainmentTab()">Educational Background / Attainment</a>
                            </li>
                            <li>
                                <a class="inline-flex btn category-button" href="#examinationsTakenTab" onclick="examinationsTakenTab()">Examinations Taken</a>
                            </li>
                            <li>
                                <a class="inline-flex btn category-button" href="#scholarshipsTab" onclick="scholarshipsTab()">Scholarships</a>
                            </li>
                            <li>
                                <a class="inline-flex btn category-button" href="#researchAndStudiesTab" onclick="researchAndStudiesTab()">Research And Studies</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div>
                    <button id="dropdownDefaultButton" data-dropdown-toggle="workExperienceTab" class="inline-flex items-center rounded-lg px-5 py-2.5 text-center text-sm font-medium uppercase focus:outline-none focus:ring-4 focus:ring-blue-300" type="button">
                        Work experience
                        <svg class="ml-2.5 h-2.5 w-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <!-- workExperienceTab menu -->
                    <div id="workExperienceTab" class="z-10 hidden w-44 divide-y divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700">
                        <ul class="py-2 text-sm uppercase text-gray-700" aria-labelledby="dropdownDefaultButton">
                            <li>
                                <a class="inline-flex btn category-button" href="#workExperienceTab" onclick="workExperienceTab()">Work Experience</a>
                            </li>
                            <li>
                                <a class="inline-flex btn category-button" href="#fieldExpertiseTab" onclick="fieldExpertiseTab()">Field Expertise</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div>
                    <button id="dropdownDefaultButton" data-dropdown-toggle="trainingsTab" class="inline-flex items-center rounded-lg px-5 py-2.5 text-center text-sm font-medium uppercase focus:outline-none focus:ring-4 focus:ring-blue-300" type="button">
                        Trainings
                        <svg class="ml-2.5 h-2.5 w-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <!-- trainingsTab menu -->
                    <div id="trainingsTab" class="z-10 hidden w-44 divide-y divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700">
                        <ul class="py-2 text-sm uppercase text-gray-700" aria-labelledby="dropdownDefaultButton">
                            <li>
                                <a class="inline-flex btn category-button" href="#cesTrainingsTab" onclick="cesTrainingsTab()">Ces Trainings</a>
                            </li>
                            <li>
                                <a class="inline-flex btn category-button" href="#otherManagementTrainingsTab" onclick="otherManagementTrainingsTab()">Other Trainings</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div>
                    <button id="dropdownDefaultButton" data-dropdown-toggle="othersTab" class="inline-flex items-center rounded-lg px-5 py-2.5 text-center text-sm font-medium uppercase focus:outline-none focus:ring-4 focus:ring-blue-300" type="button">
                        Trainings
                        <svg class="ml-2.5 h-2.5 w-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <!-- othersTab menu -->
                    <div id="othersTab" class="z-10 hidden w-44 divide-y divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700">
                        <ul class="py-2 text-sm uppercase text-gray-700" aria-labelledby="dropdownDefaultButton">
                            <li>
                                <a class="inline-flex btn category-button" href="#healthRecordsTab" onclick="healthRecordsTab()">Health Records</a>
                            </li>
                            <li>
                                <a class="inline-flex btn category-button" href="#awardAndCitationsTab" onclick="awardAndCitationsTab()">Award And Citations</a>
                            </li>
                            <li>
                                <a class="inline-flex btn category-button" href="#majorCivicAndProfessionalAffiliationsTab" onclick="majorCivicAndProfessionalAffiliationsTab()">Major Civic and Professional Affiliations</a>
                            </li>
                            <li>
                                <a class="inline-flex btn category-button" href="#caseRecordsTab" onclick="caseRecordsTab()">Case Records</a>
                            </li>

                            <li>
                                <a class="inline-flex btn category-button" href="#languagesDialectsTab" onclick="languagesDialectsTab()">Languages Dialects</a>
                            </li>
                            <li>
                                <a class="inline-flex btn category-button" href="#eligibilityAndRankTrackerTab" onclick="eligibilityAndRankTrackerTab()">Eligibility and Rank Tracker</a>
                            </li>
                            <li>
                                <a class="inline-flex btn category-button" href="#recordOfCespesRatingHrTab" onclick="recordOfCespesRatingHrTab()">Record of Cespes Ratings</a>
                            </li>
                            <li>
                                <a class="inline-flex btn category-button" href="#pdfFilesTab" onclick="pdfFilesTab()">PDF Files</a>
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- END OF NAVIGATION --}}
            </div>
        </div>

        <div class="col-span-3 col-start-2 row-span-4 row-start-2">

            <div> {{-- Start hiding other category if profile/view --}}
                <div class="category personDataTab">
                    @include('admin.201_profiling.view_profile.partials.personal_data.table')
                </div>
                <div class="category addressTab hidden">
                    @include('admin.201_profiling.view_profile.partials.address.table')
                </div>
                <div class="category identificationTab hidden">
                    @include('admin.201_profiling.view_profile.partials.identification.table')
                </div>
                <div class="category familyProfileTab hidden">
                    @include('admin.201_profiling.view_profile.partials.family_profile.table')
                </div>

                <div class="category educationalAttainmentTab hidden">
                    @include('admin.201_profiling.view_profile.partials.educational_attainment.table')
                </div>

                <div class="category examinationsTakenTab hidden">
                    @include('admin.201_profiling.view_profile.partials.examinations_taken.table')
                </div>

                <div class="category languagesDialectsTab hidden">
                    @include('admin.201_profiling.view_profile.partials.languages_dialects.table')
                </div>

                <div class="category eligibilityAndRankTrackerTab hidden">
                    @include('admin.201_profiling.view_profile.partials.eligibility_and_rank_tracker.table')
                </div>

                <div class="category recordOfCespesRatingHrTab hidden">
                    @include('admin.201_profiling.view_profile.partials.record_of_cespes_rating_hr.table')
                </div>

                <div class="category workExperienceTab hidden">
                    @include('admin.201_profiling.view_profile.partials.work_experience.table')
                </div>

                <div class="category fieldExpertiseTab hidden">
                    @include('admin.201_profiling.view_profile.partials.field_expertise.table')
                </div>

                <div class="category cesTrainingsTab hidden">
                    @include('admin.201_profiling.view_profile.partials.ces_trainings.table')
                </div>

                <div class="category otherManagementTrainingsTab hidden">
                    @include('admin.201_profiling.view_profile.partials.other_management_trainings.table')
                </div>

                <div class="category researchAndStudiesTab hidden">
                    @include('admin.201_profiling.view_profile.partials.research_and_studies.table')
                </div>

                <div class="category scholarshipsTab hidden">
                    @include('admin.201_profiling.view_profile.partials.scholarships.table')
                </div>

                <div class="category majorCivicAndProfessionalAffiliationsTab hidden">
                    @include('admin.201_profiling.view_profile.partials.major_civic_and_professional_affiliations.table')
                </div>

                <div class="category awardAndCitationsTab hidden">
                    @include('admin.201_profiling.view_profile.partials.award_and_citations.table')
                </div>

                <div class="category caseRecordsTab hidden">
                    @include('admin.201_profiling.view_profile.partials.case_records.table')
                </div>

                <div class="category healthRecordsTab hidden">
                    @include('admin.201_profiling.view_profile.partials.health_records.table')
                </div>

                <div class="category pdfFilesTab hidden">
                    @include('admin.201_profiling.view_profile.partials.pdf_files.table')
                </div>

            </div>
        </div>
    </div>

@endsection
