<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="png" href="{{ asset('images/assets/branding.png') }}">
    <title>{{ config('app.name') }}</title>

    <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>

</head>

<body class="font-sans text-gray-900 antialiased">
    @include('layouts.tailwindcss')
    <div class="flex min-h-screen flex-col items-center bg-gray-100 pt-6 sm:justify-center sm:pt-0">
        <div>
            <a href="{{ url('/') }}">
                <img src="{{ asset('images/assets/branding.png') }}" class="h-20 fill-current text-gray-500">
            </a>
        </div>

        <div class="mt-6 w-full overflow-hidden bg-white px-6 py-4 shadow-md sm:max-w-md sm:rounded-lg">
            @yield('content')
        </div>
    </div>

    {{-- confirmation dialog --}}
    <div id="confirmationBackdrop" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
        <div id="confirmationDialog" class="bg-white w-1/3 p-6 rounded-lg shadow-lg hidden" data-form-id="">
            <h2 class="text-lg font-bold mb-4" id="confirmationDialogTitle"></h2>
            <p class="mb-4" id="confirmationDialogStatement"></p>
            <div class="text-right">
                <button class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg mr-2 hover:bg-gray-400" onclick="closeConfirmationDialog()">No</button>
                <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700" onclick="deleteItem()">Yes</button>
            </div>
        </div>
    </div>
    {{-- end --}}

    {{-- js script for personal data interaction and validation --}}
    <script src="{{ asset('js/form-interaction-validation.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- end --}}

    {{-- js script for confirmation button --}}
    <script src="{{ asset('js/confirmation.js') }}"></script>
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
