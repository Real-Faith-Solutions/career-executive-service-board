<nav class="bg-white border-gray-200 dark:bg-gray-900">
    <div class="flex flex-wrap items-center justify-between mx-auto p-4">
      <a href="#" class="flex items-center">
          <span class="self-center text-2xl font-semibold whitespace-nowrap uppercase text-blue-500">@yield('sub')</span>
      </a>
      <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
          </svg>
      </button>
      <div class="hidden w-full md:block md:w-auto" id="navbar-default">
        <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white">
            <li>
                <button class="inline-flex items-center rounded-lg px-5 py-2.5 text-center text-sm font-medium uppercase focus:outline-none focus:ring-4 focus:ring-blue-300" data-dropdown-toggle="personalDataTab" id="dropdownDefaultButton" type="button">
                    Personal Information
                    <svg aria-hidden="true" class="ml-2.5 h-2.5 w-2.5" fill="none" viewBox="0 0 10 6" xmlns="http://www.w3.org/2000/svg">
                        <path d="m1 1 4 4 4-4" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" />
                    </svg>
                </button>
                <!-- personalDataTab menu -->
                <div class="z-10 hidden w-44 divide-y divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700" id="personalDataTab">
                    <ul aria-labelledby="dropdownDefaultButton" class="py-2 text-sm uppercase text-gray-700">
                        <li>
                            <a class="btn category-button inline-flex text-blue-500" href="{{ route('personal-data.show', ['cesno' => $cesno]) }}">Personal Data</a>
                        </li>
                        <li>
                            <a class="btn category-button inline-flex" href="{{ route('family-profile.show', ['cesno' => $cesno]) }}">Family Profile</a>
                        </li>
                        <li>
                            <a class="btn category-button inline-flex" href="#addressTab" onclick="addressTab()">Address</a>
                        </li>
                        <li>
                            <a class="btn category-button inline-flex" href="#identificationTab" onclick="identificationTab()">Identification Card</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li>
                <button class="inline-flex items-center rounded-lg px-5 py-2.5 text-center text-sm font-medium uppercase focus:outline-none focus:ring-4 focus:ring-blue-300" data-dropdown-toggle="educationalAttainmentTab" id="dropdownDefaultButton" type="button">
                    Education
                    <svg aria-hidden="true" class="ml-2.5 h-2.5 w-2.5" fill="none" viewBox="0 0 10 6" xmlns="http://www.w3.org/2000/svg">
                        <path d="m1 1 4 4 4-4" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" />
                    </svg>
                </button>
                <!-- educationalAttainmentTab menu -->
                <div class="z-10 hidden w-44 divide-y divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700" id="educationalAttainmentTab">
                    <ul aria-labelledby="dropdownDefaultButton" class="py-2 text-sm uppercase text-gray-700">
                        <li>
                            <a class="btn category-button inline-flex" href="#educationalAttainmentTab" onclick="educationalAttainmentTab()">Educational Background / Attainment</a>
                        </li>
                        <li>
                            <a class="btn category-button inline-flex" href="#examinationsTakenTab" onclick="examinationsTakenTab()">Examinations Taken</a>
                        </li>
                        <li>
                            <a class="btn category-button inline-flex" href="#scholarshipsTab" onclick="scholarshipsTab()">Scholarships</a>
                        </li>
                        <li>
                            <a class="btn category-button inline-flex" href="#researchAndStudiesTab" onclick="researchAndStudiesTab()">Research And Studies</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li>
                <button class="inline-flex items-center rounded-lg px-5 py-2.5 text-center text-sm font-medium uppercase focus:outline-none focus:ring-4 focus:ring-blue-300" data-dropdown-toggle="workExperienceTab" id="dropdownDefaultButton" type="button">
                    Work experience
                    <svg aria-hidden="true" class="ml-2.5 h-2.5 w-2.5" fill="none" viewBox="0 0 10 6" xmlns="http://www.w3.org/2000/svg">
                        <path d="m1 1 4 4 4-4" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" />
                    </svg>
                </button>
                <!-- workExperienceTab menu -->
                <div class="z-10 hidden w-44 divide-y divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700" id="workExperienceTab">
                    <ul aria-labelledby="dropdownDefaultButton" class="py-2 text-sm uppercase text-gray-700">
                        <li>
                            <a class="btn category-button inline-flex" href="#workExperienceTab" onclick="workExperienceTab()">Work Experience</a>
                        </li>
                        <li>
                            <a class="btn category-button inline-flex" href="#fieldExpertiseTab" onclick="fieldExpertiseTab()">Field Expertise</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li>
                <button class="inline-flex items-center rounded-lg px-5 py-2.5 text-center text-sm font-medium uppercase focus:outline-none focus:ring-4 focus:ring-blue-300" data-dropdown-toggle="trainingsTab" id="dropdownDefaultButton" type="button">
                    Trainings
                    <svg aria-hidden="true" class="ml-2.5 h-2.5 w-2.5" fill="none" viewBox="0 0 10 6" xmlns="http://www.w3.org/2000/svg">
                        <path d="m1 1 4 4 4-4" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" />
                    </svg>
                </button>
                <!-- trainingsTab menu -->
                <div class="z-10 hidden w-44 divide-y divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700" id="trainingsTab">
                    <ul aria-labelledby="dropdownDefaultButton" class="py-2 text-sm uppercase text-gray-700">
                        <li>
                            <a class="btn category-button inline-flex" href="#cesTrainingsTab" onclick="cesTrainingsTab()">Ces Trainings</a>
                        </li>
                        <li>
                            <a class="btn category-button inline-flex" href="#otherManagementTrainingsTab" onclick="otherManagementTrainingsTab()">Non-CES Accredited Training</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li>
                <button class="inline-flex items-center rounded-lg px-5 py-2.5 text-center text-sm font-medium uppercase focus:outline-none focus:ring-4 focus:ring-blue-300" data-dropdown-toggle="othersTab" id="dropdownDefaultButton" type="button">
                    Others
                    <svg aria-hidden="true" class="ml-2.5 h-2.5 w-2.5" fill="none" viewBox="0 0 10 6" xmlns="http://www.w3.org/2000/svg">
                        <path d="m1 1 4 4 4-4" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" />
                    </svg>
                </button>
                <!-- othersTab menu -->
                <div class="z-10 hidden w-44 divide-y divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700" id="othersTab">
                    <ul aria-labelledby="dropdownDefaultButton" class="py-2 text-sm uppercase text-gray-700">
                        <li>
                            <a class="btn category-button inline-flex" href="#healthRecordsTab" onclick="healthRecordsTab()">Health Records</a>
                        </li>
                        <li>
                            <a class="btn category-button inline-flex" href="#awardAndCitationsTab" onclick="awardAndCitationsTab()">Award And Citations</a>
                        </li>
                        <li>
                            <a class="btn category-button inline-flex" href="#majorCivicAndProfessionalAffiliationsTab" onclick="majorCivicAndProfessionalAffiliationsTab()">Major Civic and Professional Affiliations</a>
                        </li>
                        <li>
                            <a class="btn category-button inline-flex" href="#caseRecordsTab" onclick="caseRecordsTab()">Case Records</a>
                        </li>

                        <li>
                            <a class="btn category-button inline-flex" href="#languagesDialectsTab" onclick="languagesDialectsTab()">Languages Dialects</a>
                        </li>
                        <li>
                            <a class="btn category-button inline-flex" href="#eligibilityAndRankTrackerTab" onclick="eligibilityAndRankTrackerTab()">Eligibility and Rank Tracker</a>
                        </li>
                        <li>
                            <a class="btn category-button inline-flex" href="#recordOfCespesRatingHrTab" onclick="recordOfCespesRatingHrTab()">Record of Cespes Ratings</a>
                        </li>
                        <li>
                            <a class="btn category-button inline-flex" href="#pdfFilesTab" onclick="pdfFilesTab()">PDF Files</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>

{{-- <div class="grid-rows-7 grid grid-cols-4 gap-1">
    <div class="row-span-5 text-center">

        <img id="profile-avatar" class="profile-avatar rounded-full h-50 w-96 border-2 border-transparent hover:border-blue-500 cursor-pointer" src="{{ asset('images/'.($mainProfile->picture ?: 'placeholder.png')) }}" />

        <h1 class="text-bold text-2xl">
            {{ $mainProfile->title }} {{ $mainProfile->lastname }} {{ $mainProfile->firstname }} {{ $mainProfile->extension_name }} {{ $mainProfile->middlename }}
        </h1>

        <span class="@if ($mainProfile->status === 'Active') bg-green-100 text-green-800 @endif @if ($mainProfile->status === 'Inactive') bg-orange-100 text-orange-800 @endif @if ($mainProfile->status === 'Retired') bg-blue-100 text-blue-800 @endif @if ($mainProfile->status === 'Deceased') bg-red-100 text-red-800 @endif mr-2 rounded px-2.5 py-0.5 text-xs font-medium">
            {{ $mainProfile->status }}
        </span>

        <p>CES number: {{ $mainProfile->cesno }}</p>
    </div>
</div> --}}


