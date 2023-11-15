{{-- @extends('layouts.app')
@section('title', 'Personal Profile')
@section('sub', 'Personal Profile')
@section('content')
@include('admin.201_profiling.view_profile.header')

    <div class="grid-rows-7 grid grid-cols-4 gap-1">
        <div class="row-span-5 text-center">

            <img id="profile-avatar" class="profile-avatar rounded-full h-50 w-96 border-2 border-transparent hover:border-blue-500 cursor-pointer" src="{{ asset('images/'.($mainProfile->picture ?: 'assets/placeholder.png')) }}" />

            <h1 class="text-bold text-2xl">
                {{ $mainProfile->title }} {{ $mainProfile->lastname }} {{ $mainProfile->firstname }} {{ $mainProfile->extension_name }} {{ $mainProfile->middlename }}
            </h1>

            <span class="@if ($mainProfile->status === 'Active') bg-green-100 text-green-800 @endif @if ($mainProfile->status === 'Inactive') bg-orange-100 text-orange-800 @endif @if ($mainProfile->status === 'Retired') bg-blue-100 text-blue-800 @endif @if ($mainProfile->status === 'Deceased') bg-red-100 text-red-800 @endif mr-2 rounded px-2.5 py-0.5 text-xs font-medium">
                {{ $mainProfile->status }}
            </span>

        </div>


        <div class="col-span-3 col-start-2 row-span-4 row-start-2">

            <div>
                <div class="category personDataTab">
                    @include('admin.201_profiling.view_profile.partials.personal_data.form')
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
 --}}
