@extends('layouts.app')
@section('title', 'Create 201 profile')
@section('content')
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

    <div class="grid">
        {{-- Start hiding other category if profile/view --}}
        <div class="category personDataTab">
            @include('admin.201_profiling.partials.personal_data')
        </div>

        {{-- <div class="category familyProfileTab hidden">
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
            </div> --}}

    </div>
@endsection
