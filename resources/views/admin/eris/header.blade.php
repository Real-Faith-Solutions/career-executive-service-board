<nav class="bg-white border-gray-200">
    <div class="flex flex-wrap items-center justify-between mx-auto p-4">
      
    <a href="#" class="flex items-center">
          <span class="self-center text-2xl font-semibold whitespace-nowrap uppercase text-blue-500">@yield('sub')</span>
      </a>
      
      <div class="hidden w-full md:block md:w-auto" id="navbar-default">
        <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-0 md:mt-0 md:border-0 md:bg-white">
            <li>
                <a class="btn category-button inline-flex text-xs" href="{{ route('eris-written-exam.index', ['acno'=>$acno]) }}" >Written Exam</a>
            </li>

            <li>
                <a class="btn category-button inline-flex text-xs" href="{{ route('eris-assessment-center.index', ['acno'=>$acno]) }}" >Assessment Center</a>
            </li>

            <li>
                <a class="btn category-button inline-flex text-xs" href="{{ route('eris-rapid-validation.index', ['acno'=>$acno]) }}" >Rapid Validation</a>
            </li>

            <li>
                <a class="btn category-button inline-flex text-xs" href="{{ route('eris-in-depth-validation.index', ['acno'=>$acno]) }}" >In-Depth Validation</a>
            </li>

            <li>
                <a class="btn category-button inline-flex text-xs" href="" >Panel Board Interview</a>
            </li>

            <li>
                <a class="btn category-button inline-flex text-xs" href="" >Board Interview</a>
            </li>

            <li>
                <a class="btn category-button inline-flex text-xs" href="" >Rank Tracker</a>
            </li>
        </ul>
    </div>
</nav>
