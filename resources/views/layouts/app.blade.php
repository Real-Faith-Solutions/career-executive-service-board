<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="png" href="{{ asset('images/branding.png') }}">
    <title>@yield('title')</title>

    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css'>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.0.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js'></script>

    {{-- sweet alert --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4/bootstrap-4.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>

    <script src="https://cdn.lordicon.com/bhenfmcm.js"></script> {{-- lord icons --}}
</head>

<body>
    @include('layouts.tailwindcss')
    @include('layouts.modals')
    @include('layouts.partials.header')
    @include('layouts.partials.sidebar')

    {{-- @include('layouts.partials.preloader') --}}

    <div class="p-4 sm:ml-64">
        <div class="mt-14 rounded-lg p-4">
            @yield('content')
        </div>
    </div>

    {{-- js script for personal data interaction and validation --}}
    <script src="{{ asset('js/form-interaction-validation.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- end --}}

    {{-- js script for location api integration --}}
    <script src="{{ asset('js/location-api-integration.js') }}"></script>
    {{-- end --}}

    {{-- js script for uploading image --}}
    <script src="{{ asset('js/profile-avatar.js') }}"></script>
    {{-- end --}}

    {{-- js script for adding medical history --}}
    <script src="{{ asset('js/medical-history.js') }}"></script>
    {{-- end --}}

    {{-- js script for adding medical history --}}
    <script src="{{ asset('js/languages.js') }}"></script>
    {{-- end --}}

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
