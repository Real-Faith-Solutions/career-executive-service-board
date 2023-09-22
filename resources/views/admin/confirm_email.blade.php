<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="png" href="{{ asset('images/branding.png') }}">
    <title>Two Factor Authentication - {{ config('app.name') }}</title>

    <link rel='stylesheet'
        href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css'>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.0.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js'></script>

    {{-- sweet alert --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4/bootstrap-4.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    <script src="{{ asset('js/script.js') }}"></script>
    <script src="https://cdn.lordicon.com/bhenfmcm.js"></script> {{-- lord icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
</head>

<body>
    @include('layouts.modals')
    @include('layouts.tailwindcss')
    
    {{-- header --}}
    <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
          <div class="flex items-center justify-between">
            <div class="flex items-center justify-start">
              <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
                  <span class="sr-only">Open sidebar</span>
                  <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                     <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                  </svg>
               </button>
              <a href="{{ config('app.url') }}dashboard" class="flex ml-2 md:mr-24">
                <img src="{{ asset('images/branding.png') }}" class="h-8 mr-3" alt="{{ env('APP_NAME') }}" />
                <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap">{{ config('app.name') }}</span>
              </a>
            </div>
            <div class="flex items-center">
                <div class="flex items-center ml-3">
                  <div>
                    <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                      <span class="sr-only">Open user menu</span>
                      <img class="w-8 h-8 rounded-full" src="{{ asset('images/'.($user_picture ?: 'placeholder.png')) }}">
                    </button>
                  </div>
                  <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow" id="dropdown-user">
                    <div class="px-4 py-3" role="none">
                      <p class="text-sm text-gray-900" role="none">
                        {{ $userName }}
                      </p>
                      <p class="text-sm font-medium text-gray-900 truncate" role="none">
                        {{ Auth::user()->email }}
                      </p>
                    </div>
                    <ul class="py-1" role="none">
                      <li>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" data-modal-target="logout-modal" data-modal-toggle="logout-modal">Sign out</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
          </div>
        </div>
    </nav>
    {{-- end header --}}

    <div class="mt-14 rounded-lg p-4">
        <div class="card bg-slate-50 lg:flex lg:justify-between text-slate-500 text-2xl">
            <h1>Hello {{ $userTitle." ".$userName." [".$userRoleTitle."]" }}</h1>
            <h1 id="currentDateTime"></h1>
        </div>
    </div>

    {{-- toast for personal data success --}}
    @if (Session::has('message'))

    <script>
        toastr.options = {
                "progressBar" : true,
                "closeButton" : true,
            }
            toastr.success("{{ Session::get('message') }}",'Success!',{timeOut:7000});
    </script>

    @endif

    @if (Session::has('info'))

    <script>
        toastr.options = {
                "progressBar" : true,
                "closeButton" : true,
            }
            toastr.info("{{ Session::get('info') }}",'Success!',{timeOut:7000});
    </script>

    @endif

    @if (Session::has('error'))

    <script>
        toastr.options = {
                "progressBar" : true,
                "closeButton" : true,
            }
            toastr.error("{{ Session::get('error') }}",'Error!',{timeOut:7000});
    </script>

    @endif
    {{-- end toast --}}

</body>

</html>