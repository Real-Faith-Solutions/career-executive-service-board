<nav class="bg-white border-gray-200">
    <div class="flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="#" class="flex items-center">
            <span
                class="self-center text-2xl font-semibold whitespace-nowrap uppercase text-blue-500">@yield('sub')</span>
        </a>
        <button data-collapse-toggle="navbar-default" type="button"
            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
            aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>
        <div class="hidden w-full md:block md:w-auto" id="navbar-default">
            <ul
                class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white">
                <li>
                    <button
                        class="inline-flex items-center rounded-lg px-5 py-2.5 text-center text-sm font-medium uppercase focus:outline-none focus:ring-4 focus:ring-blue-300"
                        data-dropdown-toggle="personalDataTab" id="dropdownDefaultButton" type="button">
                        Personal Information
                        <svg aria-hidden="true" class="ml-2.5 h-2.5 w-2.5" fill="none" viewBox="0 0 10 6"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="m1 1 4 4 4-4" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                stroke="currentColor" />
                        </svg>
                    </button>
                    <!-- personalDataTab menu -->
                    <div class="z-10 hidden w-44 divide-y divide-gray-100 rounded-lg bg-white shadow"
                        id="personalDataTab">
                        <ul aria-labelledby="dropdownDefaultButton" class="py-2 text-sm uppercase text-gray-700">
                            <li>
                                <a class="btn category-button inline-flex hover:text-blue-500"
                                    href="{{ route('personal-data.show', ['cesno' => $cesno]) }}">Personal Data</a>
                            </li>

                            <li>
                                <a class="btn category-button inline-flex hover:text-blue-500"
                                    href="{{ route('family-profile.show', ['cesno' => $cesno]) }}">Family Profile</a>
                            </li>

                            <li>
                                <a class="btn category-button inline-flex hover:text-blue-500"
                                    href="{{ route('personal-data-address.show', ['cesno'=>$cesno]) }}">Address</a>
                            </li>

                            <li>
                                <a class="btn category-button inline-flex hover:text-blue-500"
                                    href="{{ route('contact-info.show', ['cesno'=>$cesno]) }}">Contact Information</a>
                            </li>

                            <li>
                                <a class="btn category-button inline-flex hover:text-blue-500"
                                    href="{{ route('personal-data-identification.show', ['cesno'=>$cesno]) }}">Identification
                                    Card</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <button
                        class="inline-flex items-center rounded-lg px-5 py-2.5 text-center text-sm font-medium uppercase focus:outline-none focus:ring-4 focus:ring-blue-300"
                        data-dropdown-toggle="educationalAttainmentTab" id="dropdownDefaultButton" type="button">
                        Education
                        <svg aria-hidden="true" class="ml-2.5 h-2.5 w-2.5" fill="none" viewBox="0 0 10 6"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="m1 1 4 4 4-4" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                stroke="currentColor" />
                        </svg>
                    </button>
                    <!-- educationalAttainmentTab menu -->
                    <div class="z-10 hidden w-44 divide-y divide-gray-100 rounded-lg bg-white shadow"
                        id="educationalAttainmentTab">
                        <ul aria-labelledby="dropdownDefaultButton" class="py-2 text-sm uppercase text-gray-700">
                            <li>
                                <a class="btn category-button inline-flex hover:text-blue-500"
                                    href="{{ route('educational-attainment.index', ['cesno' => $cesno]) }}">Educational
                                    Background / Attainment</a>
                            </li>
                            <li>
                                <a class="btn category-button inline-flex hover:text-blue-500"
                                    href="{{ route('examination-taken.index', ['cesno' => $cesno]) }}">Examinations
                                    Taken</a>
                            </li>
                            <li>
                                <a class="btn category-button inline-flex hover:text-blue-500"
                                    href="{{ route('scholarship.index', ['cesno' => $cesno]) }}">Scholarships</a>
                            </li>
                            <li>
                                <a class="btn category-button inline-flex hover:text-blue-500"
                                    href="{{ route('research-studies.index', ['cesno' => $cesno]) }}">Research And
                                    Studies</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <button
                        class="inline-flex items-center rounded-lg px-5 py-2.5 text-center text-sm font-medium uppercase focus:outline-none focus:ring-4 focus:ring-blue-300"
                        data-dropdown-toggle="workExperienceTab" id="dropdownDefaultButton" type="button">
                        Work experience
                        <svg aria-hidden="true" class="ml-2.5 h-2.5 w-2.5" fill="none" viewBox="0 0 10 6"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="m1 1 4 4 4-4" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                stroke="currentColor" />
                        </svg>
                    </button>
                    <!-- workExperienceTab menu -->
                    <div class="z-10 hidden w-44 divide-y divide-gray-100 rounded-lg bg-white shadow"
                        id="workExperienceTab">
                        <ul aria-labelledby="dropdownDefaultButton" class="py-2 text-sm uppercase text-gray-700">
                            <li>
                                <a class="btn category-button inline-flex hover:text-blue-500"
                                    href="{{ route('work-experience.index', ['cesno' => $cesno]) }}">Work Experience</a>
                            </li>
                            <li>
                                <a class="btn category-button inline-flex hover:text-blue-500"
                                    href="{{ route('expertise.index', ['cesno' => $cesno]) }}">Field Expertise</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <button
                        class="inline-flex items-center rounded-lg px-5 py-2.5 text-center text-sm font-medium uppercase focus:outline-none focus:ring-4 focus:ring-blue-300"
                        data-dropdown-toggle="trainingsTab" id="dropdownDefaultButton" type="button">
                        Trainings
                        <svg aria-hidden="true" class="ml-2.5 h-2.5 w-2.5" fill="none" viewBox="0 0 10 6"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="m1 1 4 4 4-4" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                stroke="currentColor" />
                        </svg>
                    </button>
                    <!-- trainingsTab menu -->
                    <div class="z-10 hidden w-44 divide-y divide-gray-100 rounded-lg bg-white shadow" id="trainingsTab">
                        <ul aria-labelledby="dropdownDefaultButton" class="py-2 text-sm uppercase text-gray-700">
                            <li>
                                <a class="btn category-button inline-flex hover:text-blue-500" href="{{ route('ces-training-201.index', ['cesno' => $cesno]) }}">Ces Trainings</a>
                            </li>
                            <li>
                                <a class="btn category-button inline-flex hover:text-blue-500"
                                    href="{{ route('other-training.index', ['cesno' => $cesno]) }}">Non-CES Accredited
                                    Training</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <button
                        class="inline-flex items-center rounded-lg px-5 py-2.5 text-center text-sm font-medium uppercase focus:outline-none focus:ring-4 focus:ring-blue-300"
                        data-dropdown-toggle="othersTab" id="dropdownDefaultButton" type="button">
                        Others
                        <svg aria-hidden="true" class="ml-2.5 h-2.5 w-2.5" fill="none" viewBox="0 0 10 6"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="m1 1 4 4 4-4" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                stroke="currentColor" />
                        </svg>
                    </button>
                    <!-- othersTab menu -->
                    <div class="z-10 hidden w-44 divide-y divide-gray-100 rounded-lg bg-white shadow" id="othersTab">
                        <ul aria-labelledby="dropdownDefaultButton" class="py-2 text-sm uppercase text-gray-700">
                            <li>
                                <a class="btn category-button inline-flex hover:text-blue-500"
                                    href="{{ route('health-record.index', ['cesno' => $cesno]) }}">Health Records</a>
                            </li>
                            <li>
                                <a class="btn category-button inline-flex hover:text-blue-500"
                                    href="{{ route('award-citation.index', ['cesno' => $cesno]) }}">Award And
                                    Citations</a>
                            </li>
                            <li>
                                <a class="btn category-button inline-flex hover:text-blue-500"
                                    href="{{ route('affiliation.index', ['cesno' => $cesno]) }}">Major Civic and
                                    Professional Affiliations</a>
                            </li>
                            <li>
                                <a class="btn category-button inline-flex hover:text-blue-500"
                                    href="{{ route('case-record.index', ['cesno'=>$cesno]) }}">Case Records</a>
                            </li>

                            <li>
                                <a class="btn category-button inline-flex hover:text-blue-500"
                                    href="{{ route('language.index', ['cesno'=>$cesno]) }}">Languages Dialects</a>
                            </li>
                            <li>
                                <a class="btn category-button inline-flex hover:text-blue-500"
                                    href="{{ route('eligibility-rank-tracker.index', ['cesno' => $cesno]) }}">Eligibility
                                    and Rank Tracker</a>
                            </li>
                            <li>
                                <a class="btn category-button inline-flex hover:text-blue-500"
                                    href="#recordOfCespesRatingHrTab" onclick="recordOfCespesRatingHrTab()">Record of
                                    Cespes Ratings</a>
                            </li>
                            <li>
                                <a class="btn category-button inline-flex hover:text-blue-500"
                                    href="{{ route('show-pdf-files.index', ['cesno'=>$cesno]) }}">PDF Files</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>