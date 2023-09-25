<nav class="bg-white border-gray-200">
    <div class="flex flex-wrap items-center justify-between mx-auto p-4">
      
    <a href="#" class="flex items-center">
          <span class="self-center text-2xl font-semibold whitespace-nowrap uppercase text-blue-500">@yield('sub')</span>
      </a>
      
      <div class="hidden w-full md:block md:w-auto" id="navbar-default">
        <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-2 md:mt-0 md:border-0 md:bg-white">
            <li>
                <a class="btn category-button inline-flex text-xs" href="" >Edit Profile</a>
            </li>

            <li>
                <a class="btn category-button inline-flex text-xs" href="{{ route('eris-written-exam.index', ['acno'=>$acno]) }}" >Written Exam</a>
            </li>

            <li>
                <a class="btn category-button inline-flex text-xs" href="{{ route('eris-assessment-center.index', ['acno'=>$acno]) }}" >Assessment Center</a>
            </li>

            <li>
                <button
                    class="inline-flex items-center rounded-lg px-5 py-2.5 text-center text-sm font-medium uppercase focus:outline-none focus:ring-4 focus:ring-blue-300"
                    data-dropdown-toggle="validationTab" id="dropdownDefaultButton" type="button">
                    Validation
                    <svg aria-hidden="true" class="ml-2.5 h-2.5 w-2.5" fill="none" viewBox="0 0 10 6"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="m1 1 4 4 4-4" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            stroke="currentColor" />
                    </svg>
                </button>
                <!-- validationTab menu -->
                <div class="z-10 hidden w-44 divide-y divide-gray-100 rounded-lg bg-white shadow"
                    id="validationTab">
                    <ul aria-labelledby="dropdownDefaultButton" class="py-2 text-sm uppercase text-gray-700">
                        <li>
                            <a class="btn category-button inline-flex text-xs" href="{{ route('eris-rapid-validation.index', ['acno'=>$acno]) }}" >Rapid Validation</a>
                        </li>

                        <li>
                            <a class="btn category-button inline-flex text-xs" href="{{ route('eris-in-depth-validation.index', ['acno'=>$acno]) }}" >In-Depth Validation</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li>
                <button
                    class="inline-flex items-center rounded-lg px-5 py-2.5 text-center text-sm font-medium uppercase focus:outline-none focus:ring-4 focus:ring-blue-300"
                    data-dropdown-toggle="boardInterviewTab" id="dropdownDefaultButton" type="button">
                    Board Interview
                    <svg aria-hidden="true" class="ml-2.5 h-2.5 w-2.5" fill="none" viewBox="0 0 10 6"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="m1 1 4 4 4-4" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            stroke="currentColor" />
                    </svg>
                </button>
                <!-- boardInterviewTab menu -->
                <div class="z-10 hidden w-44 divide-y divide-gray-100 rounded-lg bg-white shadow"
                    id="boardInterviewTab">
                    <ul aria-labelledby="dropdownDefaultButton" class="py-2 text-sm uppercase text-gray-700">
                        <li>
                            <a class="btn category-button inline-flex text-xs" href="{{ route('panel-board-interview.index', ['acno'=>$acno]) }}" >Panel Board Interview</a>
                        </li>
            
                        <li>
                            <a class="btn category-button inline-flex text-xs" href="{{ route('eris-board-interview.index', ['acno'=>$acno]) }}" >Board Interview</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li>
                <a class="btn category-button inline-flex text-xs" href="{{ route('eris-rank-tracker.index', ['acno'=>$acno]) }}" >Rank Tracker</a>
            </li>
        </ul>
    </div>
</nav>
