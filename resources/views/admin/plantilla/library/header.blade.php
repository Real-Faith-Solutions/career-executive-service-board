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
                    <a href="{{ route('plantilla-management.index') }}"
                        class="{{'plantilla/plantilla-management' == request()->path() ? 'text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700' : '' }} block py-2 pl-3 pr-4  md:p-0"
                        aria-current="page">Plantilla Management</a>
                </li>
                <li>
                    <a href="{{ route('sector-manager.index') }}"
                        class="{{'plantilla/sector-manager' == request()->path() ? 'text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700' : '' }} block py-2 pl-3 pr-4  md:p-0">Sector
                        Manager</a>
                </li>
                <li>
                    <a href="{{  route('department-agency-manager.index') }}"
                        class="{{'plantilla/department-agency-manager' == request()->path() ? 'text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700' : '' }} block py-2 pl-3 pr-4  md:p-0">Department
                        / Agency Manager</a>
                </li>
                <li>
                    <a href="{{ route('agency-location-manager.index') }}"
                        class="{{'plantilla/agency-location-manager' == request()->path() ? 'text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700' : '' }} block py-2 pl-3 pr-4  md:p-0">Agency
                        Location Manager</a>
                </li>
                <li>
                    <a href="{{ route('office-manager.index') }}"
                        class="{{'plantilla/office-manager' == request()->path() ? 'text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700' : '' }} block py-2 pl-3 pr-4  md:p-0">Office
                        Manager</a>
                </li>
                <li>
                    <a href="{{ route('plantilla-position-manager.index') }}"
                        class="{{'plantilla/plantilla-position-manager' == request()->path() ? 'text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700' : '' }} block py-2 pl-3 pr-4  md:p-0">Plantilla
                        Position Manager</a>
                </li>
                <li>
                    <a href="{{ route('appointee-occupant-manager.index') }}"
                        class="{{'plantilla/appointee-occupant-manager' == request()->path() ? 'text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700' : '' }} block py-2 pl-3 pr-4  md:p-0">Appointee
                        Occupant Manager</a>
                </li>
                <li>
                    <a href="{{ route('appointee-occupant-browser.index') }}"
                        class="{{'plantilla/appointee-occupant-browser' == request()->path() ? 'text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700' : '' }} block py-2 pl-3 pr-4  md:p-0">Appointee
                        Occupant Browser</a>
                </li>
            </ul>
        </div>
    </div>
</nav>