@extends('layouts.app')
@section('title', 'Personal Profile')
@section('sub', 'Personal Profile')
@section('content')
@include('admin.201_profiling.view_profile.header')




    <div class="grid-rows-7 grid grid-cols-4 gap-1">
        <div class="row-span-5 text-center">

            <img id="profile-avatar" class="profile-avatar rounded-full h-50 w-96 border-2 border-transparent hover:border-blue-500 cursor-pointer" src="{{ asset('images/'.($mainProfile->picture ?: 'placeholder.png')) }}" />

            <h1 class="text-bold text-2xl">
                {{ $mainProfile->title }} {{ $mainProfile->lastname }} {{ $mainProfile->firstname }} {{ $mainProfile->extension_name }} {{ $mainProfile->middlename }}
            </h1>

            <span class="@if ($mainProfile->status === 'Active') bg-green-100 text-green-800 @endif @if ($mainProfile->status === 'Inactive') bg-orange-100 text-orange-800 @endif @if ($mainProfile->status === 'Retired') bg-blue-100 text-blue-800 @endif @if ($mainProfile->status === 'Deceased') bg-red-100 text-red-800 @endif mr-2 rounded px-2.5 py-0.5 text-xs font-medium">
                {{ $mainProfile->status }}
            </span>

            {{-- <p>CES number: {{ $mainProfile->cesno }}</p> --}}
        </div>


        <div class="col-span-3 col-start-2 row-span-4 row-start-2">

            <div> {{-- Start hiding other category if profile/view --}}
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

    <!-- Modal for Avatar Upload -->
    <div id="profile-avatar-modal" class="modal hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="modal-content bg-white p-6 rounded-lg shadow-lg">
            <form id="uploadFormAvatar" action="{{ route('/upload-avatar-profile-201', ['cesno'=>$mainProfile->cesno]) }}" method="POST" enctype="multipart/form-data" class="flex flex-col items-center">
                @csrf
                <span class="close-avatar absolute top-2 right-2 text-gray-600 cursor-pointer">&times;</span>
                <h2 class="text-2xl font-bold mb-4 text-center">Upload New Avatar</h2>
                <input type="file" id="imageInputAvatar" name="imageInput" class="mb-4 p-2 border border-gray-300 rounded">
                <p class="text-red-600" id="ErrorMessageAvatar"></p>
                <div class="flex justify-center items-center mb-4">
                    <img id="imagePreviewAvatar" src="#" alt="Image Preview" class="hidden w-32 h-32 rounded-full">
                </div>
                <button type="submit" name="submit" id="uploadButtonAvatar" class="px-6 py-3 bg-blue-500 text-white rounded-md shadow hover:bg-blue-600 transition-colors duration-300">Upload</button>
            </form>
        </div>
    </div>

@endsection

