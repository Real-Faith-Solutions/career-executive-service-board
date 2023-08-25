<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="png" href="{{ asset('images/branding.png') }}">
    <title>{{ config('app.name') }}</title>
</head>

<body class="font-sans text-gray-900 antialiased">
    @include('layouts.tailwindcss')
    <div class="flex min-h-screen flex-col items-center bg-gray-100 pt-6 sm:justify-center sm:pt-0">
        <div>
            <a href="{{ url('/') }}">
                <img src="{{ asset('images/branding.png') }}" class="h-20 fill-current text-gray-500">
                {{-- AQUA LAB PH --}}
            </a>
        </div>

        <div class="mt-6 w-full overflow-hidden bg-white px-6 py-4 shadow-md sm:max-w-md sm:rounded-lg">
            @yield('content')
        </div>
    </div>

    {{-- js script for personal data interaction and validation --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
