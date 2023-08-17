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
                <!-- Personal Information -->
                <div class="z-10 hidden w-44 divide-y divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700" id="personalDataTab">
                    <ul aria-labelledby="dropdownDefaultButton" class="py-2 text-sm uppercase text-gray-700">
                        <li>
                            <a class="btn category-button inline-flex"  href="/#">Mailing Address</a>
                        </li>

                        <li>
                            <a class="btn category-button inline-flex" href="{{ route('competency-view-profile.updateOrCreate', ['cesno'=>$cesno]) }}">Contact Information</a>
                        </li>

                        <li>
                            <a class="btn category-button inline-flex" href="">Official Email Address</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li>
                <button class="inline-flex items-center rounded-lg px-5 py-2.5 text-center text-sm font-medium uppercase focus:outline-none focus:ring-4 focus:ring-blue-300" data-dropdown-toggle="educationalAttainmentTab" id="dropdownDefaultButton" type="button">
                    Non-CES and CES Training
                    <svg aria-hidden="true" class="ml-2.5 h-2.5 w-2.5" fill="none" viewBox="0 0 10 6" xmlns="http://www.w3.org/2000/svg">
                        <path d="m1 1 4 4 4-4" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" />
                    </svg>
                </button>
                <!-- Non-CES and CES Training -->
                <div class="z-10 hidden w-44 divide-y divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700" id="educationalAttainmentTab">
                    <ul aria-labelledby="dropdownDefaultButton" class="py-2 text-sm uppercase text-gray-700">
                        <li>
                            <a class="btn category-button inline-flex" href="/#">Record of CES Trainings Attended</a>
                        </li>

                        <li>
                            <a class="btn category-button inline-flex" href="{{ route('competency-data-other-training-management.index', ['cesno'=>$cesno]) }}" >Other Non-CES Accredited Trainings</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li>
                <button class="inline-flex items-center rounded-lg px-5 py-2.5 text-center text-sm font-medium uppercase focus:outline-none focus:ring-4 focus:ring-blue-300" data-dropdown-toggle="workExperienceTab" id="dropdownDefaultButton" type="button">
                    Training Sessions Manager Sub-Module
                    <svg aria-hidden="true" class="ml-2.5 h-2.5 w-2.5" fill="none" viewBox="0 0 10 6" xmlns="http://www.w3.org/2000/svg">
                        <path d="m1 1 4 4 4-4" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" />
                    </svg>
                </button>
                <!-- workExperienceTab menu -->
                <div class="z-10 hidden w-44 divide-y divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700" id="workExperienceTab">
                    <ul aria-labelledby="dropdownDefaultButton" class="py-2 text-sm uppercase text-gray-700">
                        <li>
                            <a class="btn category-button inline-flex" href="" >Training Session List Grid</a>
                        </li>

                        <li>
                            <a class="btn category-button inline-flex" href="" >Participants List Grid</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li>
                <button class="inline-flex items-center rounded-lg px-5 py-2.5 text-center text-sm font-medium uppercase focus:outline-none focus:ring-4 focus:ring-blue-300" data-dropdown-toggle="othersTab" id="dropdownDefaultButton" type="button">
                    Training Type Library
                    <svg aria-hidden="true" class="ml-2.5 h-2.5 w-2.5" fill="none" viewBox="0 0 10 6" xmlns="http://www.w3.org/2000/svg">
                        <path d="m1 1 4 4 4-4" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" />
                    </svg>
                </button>
                <!-- Training Type Library Tab menu -->
                <div class="z-10 hidden w-44 divide-y divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700" id="othersTab">
                    <ul aria-labelledby="dropdownDefaultButton" class="py-2 text-sm uppercase text-gray-700">
                        <li>
                            <a class="btn category-button inline-flex" href="" >Training Category</a>
                        </li>

                        <li>
                            <a class="btn category-button inline-flex" href="" >Field of Specialization</a>
                        </li>

                        <li>
                            <a class="btn category-button inline-flex" href="" >Training Secreteriat</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li>
                <button class="inline-flex items-center rounded-lg px-5 py-2.5 text-center text-sm font-medium uppercase focus:outline-none focus:ring-4 focus:ring-blue-300" data-dropdown-toggle="trainingsTab" id="dropdownDefaultButton" type="button">
                    Trainings Sub Module
                    <svg aria-hidden="true" class="ml-2.5 h-2.5 w-2.5" fill="none" viewBox="0 0 10 6" xmlns="http://www.w3.org/2000/svg">
                        <path d="m1 1 4 4 4-4" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" />
                    </svg>
                </button>
                <!-- trainingsTab menu -->
                <div class="z-10 hidden w-44 divide-y divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700" id="trainingsTab">
                    <ul aria-labelledby="dropdownDefaultButton" class="py-2 text-sm uppercase text-gray-700">
                        <li>
                            <a class="btn category-button inline-flex" href="" >Resource Speakers/Persons Manager</a>
                        </li>

                        <li>
                            <a class="btn category-button inline-flex" href="{{ route('training-venue-manager.index', ['cesno'=>$cesno]) }}" >Training Venue Manager</a>
                        </li>

                        <li>
                            <a class="btn category-button inline-flex" href="{{ route('training-provider-manager.index', ['cesno'=>$cesno]) }}" >Training Provider Manager</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>
