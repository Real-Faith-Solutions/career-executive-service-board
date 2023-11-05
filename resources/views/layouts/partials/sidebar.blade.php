<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 h-screen w-64 -translate-x-full border-r border-gray-200 bg-white pt-20 transition-transform sm:translate-x-0"
    aria-label="Sidebar">
    <div class="h-full overflow-y-auto bg-white px-3 pb-4">
        <ul class="space-y-2 font-medium">

            {{-- dashboard --}}
            <li>
                <a href="{{ route('dashboard') }}"
                    class="group flex w-full items-center rounded-lg p-2 text-gray-900 transition duration-75 hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                        class="h-6 w-6 flex-shrink-0 text-gray-500 transition duration-75 group-hover:text-gray-900">
                        <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                        <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                    </svg>
                    <span class="ml-3 flex-1 whitespace-nowrap">Dashboard</span>
                </a>
            </li>
            {{-- end dashboard --}}

            @if($userRole !== "user")

            {{-- 201 profiling --}}
            <li>

                <button type="button"
                    class="group flex w-full items-center rounded-lg p-2 text-gray-900 transition duration-75 hover:bg-gray-100"
                    aria-controls="dropdown-dashboard" data-collapse-toggle="dropdown-dashboard">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="h-6 w-6 flex-shrink-0 text-gray-500 transition duration-75 group-hover:text-gray-900">
                        <path fill-rule="evenodd"
                            d="M8.25 6.75a3.75 3.75 0 117.5 0 3.75 3.75 0 01-7.5 0zM15.75 9.75a3 3 0 116 0 3 3 0 01-6 0zM2.25 9.75a3 3 0 116 0 3 3 0 01-6 0zM6.31 15.117A6.745 6.745 0 0112 12a6.745 6.745 0 016.709 7.498.75.75 0 01-.372.568A12.696 12.696 0 0112 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 01-.372-.568 6.787 6.787 0 011.019-4.38z"
                            clip-rule="evenodd" />
                        <path
                            d="M5.082 14.254a8.287 8.287 0 00-1.308 5.135 9.687 9.687 0 01-1.764-.44l-.115-.04a.563.563 0 01-.373-.487l-.01-.121a3.75 3.75 0 013.57-4.047zM20.226 19.389a8.287 8.287 0 00-1.308-5.135 3.75 3.75 0 013.57 4.047l-.01.121a.563.563 0 01-.373.486l-.115.04c-.567.2-1.156.349-1.764.441z" />
                    </svg>
                    <span class="ml-3 flex-1 whitespace-nowrap text-left" sidebar-toggle-item>201 Profiling</span>
                    <svg sidebar-toggle-item class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>

                <ul id="dropdown-dashboard" class="hidden space-y-2 py-2">

                    @if ($userPermissions->contains('permission_name', 'personal_data_add'))
                    <li>
                        <a href="{{ route('profile.add') }}"
                            class="group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100">
                            Add Profile
                        </a>
                    </li>
                    @endif

                    <li>
                        <a href="{{ route('view-profile-201.index') }}"
                            class="group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100">
                            View Profile
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('show-pending-pdf-files.pendingFiles') }}"
                            class="group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100">Pending
                            Files
                        </a>
                    </li>

                </ul>

            </li>
            {{-- end 201 profiling --}}

            @else

            {{-- single view profile for user --}}
            <li>
                <a href="{{ route('personal-data.show', ['cesno' => $user_cesno]) }}"
                    class="flex items-center rounded-lg p-2 text-gray-900 hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="h-6 w-6 flex-shrink-0 text-gray-500 transition duration-75 group-hover:text-gray-900">
                        <path fill-rule="evenodd"
                            d="M4.5 3.75a3 3 0 00-3 3v10.5a3 3 0 003 3h15a3 3 0 003-3V6.75a3 3 0 00-3-3h-15zm4.125 3a2.25 2.25 0 100 4.5 2.25 2.25 0 000-4.5zm-3.873 8.703a4.126 4.126 0 017.746 0 .75.75 0 01-.351.92 7.47 7.47 0 01-3.522.877 7.47 7.47 0 01-3.522-.877.75.75 0 01-.351-.92zM15 8.25a.75.75 0 000 1.5h3.75a.75.75 0 000-1.5H15zM14.25 12a.75.75 0 01.75-.75h3.75a.75.75 0 010 1.5H15a.75.75 0 01-.75-.75zm.75 2.25a.75.75 0 000 1.5h3.75a.75.75 0 000-1.5H15z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="ml-3">View Profile</span>
                </a>
            </li>
            {{-- end single view profile for user --}}

            @endif

            @if($userRole !== "user")

            {{-- Eris --}}
            <li>
                <a href="{{ route('eris-index') }}"
                    class="group flex w-full items-center rounded-lg p-2 text-gray-900 transition duration-75 hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="h-6 w-6 flex-shrink-0 text-gray-500 transition duration-75 group-hover:text-gray-900">
                        <path fill-rule="evenodd"
                            d="M7.502 6h7.128A3.375 3.375 0 0118 9.375v9.375a3 3 0 003-3V6.108c0-1.505-1.125-2.811-2.664-2.94a48.972 48.972 0 00-.673-.05A3 3 0 0015 1.5h-1.5a3 3 0 00-2.663 1.618c-.225.015-.45.032-.673.05C8.662 3.295 7.554 4.542 7.502 6zM13.5 3A1.5 1.5 0 0012 4.5h4.5A1.5 1.5 0 0015 3h-1.5z"
                            clip-rule="evenodd" />
                        <path fill-rule="evenodd"
                            d="M3 9.375C3 8.339 3.84 7.5 4.875 7.5h9.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 013 20.625V9.375zM6 12a.75.75 0 01.75-.75h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H6.75a.75.75 0 01-.75-.75V12zm2.25 0a.75.75 0 01.75-.75h3.75a.75.75 0 010 1.5H9a.75.75 0 01-.75-.75zM6 15a.75.75 0 01.75-.75h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H6.75a.75.75 0 01-.75-.75V15zm2.25 0a.75.75 0 01.75-.75h3.75a.75.75 0 010 1.5H9a.75.75 0 01-.75-.75zM6 18a.75.75 0 01.75-.75h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H6.75a.75.75 0 01-.75-.75V18zm2.25 0a.75.75 0 01.75-.75h3.75a.75.75 0 010 1.5H9a.75.75 0 01-.75-.75z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="ml-3 flex-1 whitespace-nowrap">ERIS</span>
                </a>
            </li>
            {{-- end eris --}}

            {{-- Plantilla --}}
            <li>
                <a href="{{ route('sector-manager.index') }}"
                    class="group flex w-full items-center rounded-lg p-2 text-gray-900 transition duration-75 hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="h-6 w-6 flex-shrink-0 text-gray-500 transition duration-75 group-hover:text-gray-900">
                        <path fill-rule="evenodd"
                            d="M4.5 3.75a3 3 0 00-3 3v10.5a3 3 0 003 3h15a3 3 0 003-3V6.75a3 3 0 00-3-3h-15zm4.125 3a2.25 2.25 0 100 4.5 2.25 2.25 0 000-4.5zm-3.873 8.703a4.126 4.126 0 017.746 0 .75.75 0 01-.351.92 7.47 7.47 0 01-3.522.877 7.47 7.47 0 01-3.522-.877.75.75 0 01-.351-.92zM15 8.25a.75.75 0 000 1.5h3.75a.75.75 0 000-1.5H15zM14.25 12a.75.75 0 01.75-.75h3.75a.75.75 0 010 1.5H15a.75.75 0 01-.75-.75zm.75 2.25a.75.75 0 000 1.5h3.75a.75.75 0 000-1.5H15z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="ml-3 flex-1 whitespace-nowrap">Plantilla Main Screen</span>
                </a>
            </li>

            {{-- <li>
                <a href="{{ route('statistics.index') }}"
                    class="group flex w-full items-center rounded-lg p-2 text-gray-900 transition duration-75 hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="h-6 w-6 flex-shrink-0 text-gray-500 transition duration-75 group-hover:text-gray-900">
                        <path fill-rule="evenodd"
                            d="M4.5 3.75a3 3 0 00-3 3v10.5a3 3 0 003 3h15a3 3 0 003-3V6.75a3 3 0 00-3-3h-15zm4.125 3a2.25 2.25 0 100 4.5 2.25 2.25 0 000-4.5zm-3.873 8.703a4.126 4.126 0 017.746 0 .75.75 0 01-.351.92 7.47 7.47 0 01-3.522.877 7.47 7.47 0 01-3.522-.877.75.75 0 01-.351-.92zM15 8.25a.75.75 0 000 1.5h3.75a.75.75 0 000-1.5H15zM14.25 12a.75.75 0 01.75-.75h3.75a.75.75 0 010 1.5H15a.75.75 0 01-.75-.75zm.75 2.25a.75.75 0 000 1.5h3.75a.75.75 0 000-1.5H15z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="ml-3 flex-1 whitespace-nowrap">Plantilla reports</span>
                </a>
            </li> --}}

            <li>
                <button type="button"
                    class="group flex w-full items-center rounded-lg p-2 text-gray-900 transition duration-75 hover:bg-gray-100"
                    aria-controls="dropdown-plantilla-reports" data-collapse-toggle="dropdown-plantilla-reports">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="h-6 w-6 flex-shrink-0 text-gray-500 transition duration-75 group-hover:text-gray-900">
                        <path
                            d="M7.5 3.375c0-1.036.84-1.875 1.875-1.875h.375a3.75 3.75 0 013.75 3.75v1.875C13.5 8.161 14.34 9 15.375 9h1.875A3.75 3.75 0 0121 12.75v3.375C21 17.16 20.16 18 19.125 18h-9.75A1.875 1.875 0 017.5 16.125V3.375z" />
                        <path
                            d="M15 5.25a5.23 5.23 0 00-1.279-3.434 9.768 9.768 0 016.963 6.963A5.23 5.23 0 0017.25 7.5h-1.875A.375.375 0 0115 7.125V5.25zM4.875 6H6v10.125A3.375 3.375 0 009.375 19.5H16.5v1.125c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 013 20.625V7.875C3 6.839 3.84 6 4.875 6z" />
                    </svg>
                    <span class="ml-3 flex-1 whitespace-nowrap text-left" sidebar-toggle-item>Plantilla Reports</span>
                    <svg sidebar-toggle-item class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>

                <ul id="dropdown-plantilla-reports" class="hidden space-y-2 py-2">
                    <li>
                        <a href="{{ route('statistics.index') }}"
                            class="group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100">
                            Plantilla Statistics
                        </a>
                        <a href="{{ route('occupancy-report.index') }}"
                            class="group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100">
                            Occupancy report
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <button type="button"
                    class="group flex w-full items-center rounded-lg p-2 text-gray-900 transition duration-75 hover:bg-gray-100"
                    aria-controls="dropdown-plantilla-library" data-collapse-toggle="dropdown-plantilla-library">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="h-6 w-6 flex-shrink-0 text-gray-500 transition duration-75 group-hover:text-gray-900">
                        <path
                            d="M7.5 3.375c0-1.036.84-1.875 1.875-1.875h.375a3.75 3.75 0 013.75 3.75v1.875C13.5 8.161 14.34 9 15.375 9h1.875A3.75 3.75 0 0121 12.75v3.375C21 17.16 20.16 18 19.125 18h-9.75A1.875 1.875 0 017.5 16.125V3.375z" />
                        <path
                            d="M15 5.25a5.23 5.23 0 00-1.279-3.434 9.768 9.768 0 016.963 6.963A5.23 5.23 0 0017.25 7.5h-1.875A.375.375 0 0115 7.125V5.25zM4.875 6H6v10.125A3.375 3.375 0 009.375 19.5H16.5v1.125c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 013 20.625V7.875C3 6.839 3.84 6 4.875 6z" />
                    </svg>
                    <span class="ml-3 flex-1 whitespace-nowrap text-left" sidebar-toggle-item>Plantilla Library</span>
                    <svg sidebar-toggle-item class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>

                <ul id="dropdown-plantilla-library" class="hidden space-y-2 py-2">
                    <li>
                        <a href="{{ route('library-sector.index') }}"
                            class="group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100">
                            Sector Manager
                        </a>

                        <a href="{{ route('library-department-manager.index') }}"
                            class="group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100">
                            Department / Agency Manager
                        </a>

                        <a href="{{ route('library-agency-location-manager.index') }}"
                            class="group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100">
                            Agency Location Manager
                        </a>

                        <a href="{{ route('library-office-manager.index') }}"
                            class="group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100">
                            Office Manager
                        </a>

                        <a href="{{ route('library-position-manager.index') }}"
                            class="group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100">
                            Plantilla Position Manager
                        </a>

                        <a href="{{ route('library-occupant-browser.index') }}"
                            class="group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100">
                            Appointee - Occupant Browser
                        </a>

                        <a href="{{ route('library-occupant-manager.index') }}"
                            class="group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100">
                            Appointee - Occupant Manager
                        </a>

                        <a href="{{ route('library-mother-dept.index') }}"
                            class="group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100">
                            Mother Agency
                        </a>

                        <a href="{{ route('library-office-type.index') }}"
                            class="group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100">
                            Office type
                        </a>

                        <a href="{{ route('library-location-type.index') }}"
                            class="group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100">
                            Location type
                        </a>

                        <a href="{{ route('library-dbm-position-title.index') }}"
                            class="group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100">
                            DBM Position Title
                        </a>

                        <a href="{{ route('library-class-basis.index') }}"
                            class="group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100">
                            Plantilla Position Classification Manager
                        </a>

                        <a href="{{ route('library-personnel-movement.index') }}"
                            class="group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100">
                            Personnel Movement
                        </a>
                    </li>
                </ul>
            </li>
            {{-- end Plantilla --}}

            {{-- Competency --}}
            <li>
                <a href="{{ route('competency-data.index') }}"
                    class="group flex w-full items-center rounded-lg p-2 text-gray-900 transition duration-75 hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="h-6 w-6 flex-shrink-0 text-gray-500 transition duration-75 group-hover:text-gray-900">
                        <path fill-rule="evenodd"
                            d="M7.502 6h7.128A3.375 3.375 0 0118 9.375v9.375a3 3 0 003-3V6.108c0-1.505-1.125-2.811-2.664-2.94a48.972 48.972 0 00-.673-.05A3 3 0 0015 1.5h-1.5a3 3 0 00-2.663 1.618c-.225.015-.45.032-.673.05C8.662 3.295 7.554 4.542 7.502 6zM13.5 3A1.5 1.5 0 0012 4.5h4.5A1.5 1.5 0 0015 3h-1.5z"
                            clip-rule="evenodd" />
                        <path fill-rule="evenodd"
                            d="M3 9.375C3 8.339 3.84 7.5 4.875 7.5h9.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 013 20.625V9.375zm9.586 4.594a.75.75 0 00-1.172-.938l-2.476 3.096-.908-.907a.75.75 0 00-1.06 1.06l1.5 1.5a.75.75 0 001.116-.062l3-3.75z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="ml-3 flex-1 whitespace-nowrap">Competency</span>
                </a>
            </li>
            {{-- end Competency --}}

            {{-- ERIS Reports --}}
            <li>
                <button type="button"
                    class="group flex w-full items-center rounded-lg p-2 text-gray-900 transition duration-75 hover:bg-gray-100"
                    aria-controls="dropdown-reports" data-collapse-toggle="dropdown-reports">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="h-6 w-6 flex-shrink-0 text-gray-500 transition duration-75 group-hover:text-gray-900">
                        <path
                            d="M5.625 1.5c-1.036 0-1.875.84-1.875 1.875v17.25c0 1.035.84 1.875 1.875 1.875h12.75c1.035 0 1.875-.84 1.875-1.875V12.75A3.75 3.75 0 0016.5 9h-1.875a1.875 1.875 0 01-1.875-1.875V5.25A3.75 3.75 0 009 1.5H5.625z" />
                        <path
                            d="M12.971 1.816A5.23 5.23 0 0114.25 5.25v1.875c0 .207.168.375.375.375H16.5a5.23 5.23 0 013.434 1.279 9.768 9.768 0 00-6.963-6.963z" />
                    </svg>

                    <span class="ml-3 flex-1 whitespace-nowrap text-left" sidebar-toggle-item>ERIS Reports</span>

                    <svg sidebar-toggle-item class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>

                <ul id="dropdown-reports" class="hidden space-y-2 py-2">
                    <li>
                        <li>
                            <a href="{{ route('eris-board-interview-report.index') }}" class="group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100">
                                Board/Panel Interview Reports
                            </a>
                        </li>   

                        <li>
                            <a href="{{ route('rapid-validation-report.index') }}" class="group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100">
                                Validation Reports
                            </a>
                        </li>
                        
                        <li>
                            <a href="{{ route('assessment-center-report.index') }}" class="group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100">
                                Assessment Center
                            </a>
                        </li>
                    </li>
                </ul>
            </li>
            {{-- end ERIS Reports --}}

            {{-- competency reports --}}
            <li>
                <button type="button"
                    class="group flex w-full items-center rounded-lg p-2 text-gray-900 transition duration-75 hover:bg-gray-100"
                    aria-controls="dropdown-reports" data-collapse-toggle="dropdown-reports">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="h-6 w-6 flex-shrink-0 text-gray-500 transition duration-75 group-hover:text-gray-900">
                        <path
                            d="M5.625 1.5c-1.036 0-1.875.84-1.875 1.875v17.25c0 1.035.84 1.875 1.875 1.875h12.75c1.035 0 1.875-.84 1.875-1.875V12.75A3.75 3.75 0 0016.5 9h-1.875a1.875 1.875 0 01-1.875-1.875V5.25A3.75 3.75 0 009 1.5H5.625z" />
                        <path
                            d="M12.971 1.816A5.23 5.23 0 0114.25 5.25v1.875c0 .207.168.375.375.375H16.5a5.23 5.23 0 013.434 1.279 9.768 9.768 0 00-6.963-6.963z" />
                    </svg>

                    <span class="ml-3 flex-1 whitespace-nowrap text-left" sidebar-toggle-item>Competency Reports</span>

                    <svg sidebar-toggle-item class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>

                <ul id="dropdown-reports" class="hidden space-y-2 py-2">
                    <li>
                    <li>
                        <a href="{{ route('competency-management-sub-modules-report.generalReportIndex') }}"
                            class="group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100">
                            General Report
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('competency-management-sub-modules-report.trainingVenueManagerReportIndex') }}"
                            class="group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100">
                            Training Venue Manager Reports
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('competency-management-sub-modules-report.trainingProviderIndexReport') }}"
                            class="group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100">
                            Training Provider Manager Report
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('competency-management-sub-modules-report.resourceSpeakerIndexReport') }}"
                            class="group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100">
                            Resource Speaker Manager Reports
                        </a>
                    </li>
            </li>
        </ul>
        </li>
        {{-- end competency reports --}}

        {{-- 201 reports --}}
        <li>
            <button type="button"
                class="group flex w-full items-center rounded-lg p-2 text-gray-900 transition duration-75 hover:bg-gray-100"
                aria-controls="dropdown-201-reports" data-collapse-toggle="dropdown-201-reports">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="h-6 w-6 flex-shrink-0 text-gray-500 transition duration-75 group-hover:text-gray-900">
                    <path
                        d="M5.625 1.5c-1.036 0-1.875.84-1.875 1.875v17.25c0 1.035.84 1.875 1.875 1.875h12.75c1.035 0 1.875-.84 1.875-1.875V12.75A3.75 3.75 0 0016.5 9h-1.875a1.875 1.875 0 01-1.875-1.875V5.25A3.75 3.75 0 009 1.5H5.625z" />
                    <path
                        d="M12.971 1.816A5.23 5.23 0 0114.25 5.25v1.875c0 .207.168.375.375.375H16.5a5.23 5.23 0 013.434 1.279 9.768 9.768 0 00-6.963-6.963z" />
                </svg>

                <span class="ml-3 flex-1 whitespace-nowrap text-left" sidebar-toggle-item>201 Reports</span>

                <svg sidebar-toggle-item class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>

            <ul id="dropdown-201-reports" class="hidden space-y-2 py-2">
                <li>
                    <a href="{{ route('general-reports.index') }}"
                        class="group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100">
                        General Reports
                    </a>
                </li>

                <li>
                    <a href="#"
                        class="group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100">
                        Statistical Reports
                    </a>
                </li>

                <li>
                    <a href="#"
                        class="group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100">
                        Reports for Placement
                    </a>
                </li>

                <li>
                    <a href="#"
                        class="group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100">
                        Reports for Birthday Cards
                    </a>
                </li>

                <li>
                    <a href="#"
                        class="group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100">
                        Data Portability Report
                    </a>
                </li>
            </ul>
        </li>
        {{-- end 201 reports --}}

        {{-- rights management --}}
        <li>
            <a href="{{ route('roles.index') }}"
                class="group flex w-full items-center rounded-lg p-2 text-gray-900 transition duration-75 hover:bg-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="h-6 w-6 flex-shrink-0 text-gray-500 transition duration-75 group-hover:text-gray-900">
                    <path fill-rule="evenodd"
                        d="M12.516 2.17a.75.75 0 00-1.032 0 11.209 11.209 0 01-7.877 3.08.75.75 0 00-.722.515A12.74 12.74 0 002.25 9.75c0 5.942 4.064 10.933 9.563 12.348a.749.749 0 00.374 0c5.499-1.415 9.563-6.406 9.563-12.348 0-1.39-.223-2.73-.635-3.985a.75.75 0 00-.722-.516l-.143.001c-2.996 0-5.717-1.17-7.734-3.08zm3.094 8.016a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"
                        clip-rule="evenodd" />
                </svg>
                <span class="ml-3">Rights Management</span>
            </a>
        </li>
        {{-- end rights management --}}

        {{-- 201 libraries --}}
        <li>
            <button type="button"
                class="group flex w-full items-center rounded-lg p-2 text-gray-900 transition duration-75 hover:bg-gray-100"
                aria-controls="dropdown-system-utility" data-collapse-toggle="dropdown-system-utility">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="h-6 w-6 flex-shrink-0 text-gray-500 transition duration-75 group-hover:text-gray-900">
                    <path
                        d="M11.25 4.533A9.707 9.707 0 006 3a9.735 9.735 0 00-3.25.555.75.75 0 00-.5.707v14.25a.75.75 0 001 .707A8.237 8.237 0 016 18.75c1.995 0 3.823.707 5.25 1.886V4.533zM12.75 20.636A8.214 8.214 0 0118 18.75c.966 0 1.89.166 2.75.47a.75.75 0 001-.708V4.262a.75.75 0 00-.5-.707A9.735 9.735 0 0018 3a9.707 9.707 0 00-5.25 1.533v16.103z" />
                </svg>
                <span class="ml-3 flex-1 whitespace-nowrap text-left" sidebar-toggle-item>201 Library</span>
                <svg sidebar-toggle-item class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
            <ul id="dropdown-system-utility" class="hidden space-y-2 py-2">
                <li>
                    <a href="{{ route('gender-by-birth.index') }}"
                        class="group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100">
                        Gender by birth
                    </a>

                    <a href="{{ route('gender-by-choice.index') }}"
                        class="group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100">
                        Gender by choice
                    </a>

                    <a href="{{ route('civil-status.index') }}"
                        class="group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100">
                        Civil Status
                    </a>

                    <a href="{{ route('title.index') }}"
                        class="group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100">
                        Title
                    </a>

                    <a href="{{ route('record-status.index') }}"
                        class="group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100">
                        Record Status
                    </a>

                    <a href="{{ route('religion.index') }}"
                        class="group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100">
                        Religion
                    </a>

                    <a href="{{ route('indigeneous-group.index') }}"
                        class="group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100">
                        Indigenous Group
                    </a>

                    <a href="{{ route('pwd.index') }}"
                        class="group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100">
                        PWD Disability
                    </a>

                    {{-- <a href="{{ route('civil-status.index') }}"
                        class="group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100">Citizenship
                    </a>

                    <a href="{{ route('civil-status.index') }}"
                        class="group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100">Identification
                        cards
                    </a> --}}

                    <a href="{{ route('educational-schools.index') }}"
                        class="group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100">
                        Educational Schools
                    </a>

                    <a href="{{ route('educational-major.index') }}"
                        class="group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100">
                        Educational Major
                    </a>

                    <a href="{{ route('educational-degree.index') }}"
                        class="group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100">
                        Educational Degree
                    </a>

                    <a href="{{ route('examination.index') }}"
                        class="group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100">
                        Examination
                    </a>

                    <a href="{{ route('language-library.index') }}"
                        class="group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100">
                        Language
                    </a>

                    <a href="{{ route('ces-status-library.index') }}"
                        class="group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100">
                        CES Status
                    </a>

                    <a href="{{ route('appointing-authority-library.index') }}"
                        class="group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100">
                        Appointing Authority
                    </a>

                    <a href="{{ route('ces-status-type-library.index') }}"
                        class="group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100">
                        Status Type
                    </a>

                    <a href="{{ route('ces-status-acquired-thru-library.index') }}"
                        class="group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100">
                        Acquired Thru
                    </a>

                    <a href="{{ route('case-nature-library.index') }}"
                        class="group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100">
                        Case Nature
                    </a>

                    <a href="{{ route('case-status-library.index') }}"
                        class="group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100">
                        Case Status
                    </a>

                    <a href="{{ route('expertise-general.index') }}"
                        class="group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100">
                        Expertise General
                    </a>

                    <a href="{{ route('expertise-specialization.index') }}"
                        class="group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100">
                        Expertise Specialization
                    </a>
                </li>
            </ul>
        </li>
        {{-- 201 end libraries --}}

        <li>
            <button type="button"
                class="group flex w-full items-center rounded-lg p-2 text-gray-900 transition duration-75 hover:bg-gray-100"
                aria-controls="eris-dropdown-system-utility" data-collapse-toggle="eris-dropdown-system-utility">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="h-6 w-6 flex-shrink-0 text-gray-500 transition duration-75 group-hover:text-gray-900">
                    <path
                        d="M11.25 4.533A9.707 9.707 0 006 3a9.735 9.735 0 00-3.25.555.75.75 0 00-.5.707v14.25a.75.75 0 001 .707A8.237 8.237 0 016 18.75c1.995 0 3.823.707 5.25 1.886V4.533zM12.75 20.636A8.214 8.214 0 0118 18.75c.966 0 1.89.166 2.75.47a.75.75 0 001-.708V4.262a.75.75 0 00-.5-.707A9.735 9.735 0 0018 3a9.707 9.707 0 00-5.25 1.533v16.103z" />
                </svg>
                <span class="ml-3 flex-1 whitespace-nowrap text-left" sidebar-toggle-item>ERIS Library</span>
                <svg sidebar-toggle-item class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
            <ul id="eris-dropdown-system-utility" class="hidden space-y-2 py-2">
                <li>
                    <a href="{{ route('rank-tracker-library.index') }}"
                        class="group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100">
                        Rank Tracker
                    </a>
                </li>
            </ul>
        </li>
        @endif
        </ul>
    </div>
</aside>