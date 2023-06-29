<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="png" href="{{ asset('image/branding.png') }}">
    <title>{{ config('app.name') }}</title>
</head>

<body class="font-sans text-gray-900 antialiased">
    @include('layouts.tailwindcss')
    <div class="flex min-h-screen flex-col items-center bg-gray-100 pt-6 sm:justify-center sm:pt-0">
        <div>
            <a href="{{ url('/') }}">
                <img src="{{ asset('image/branding.png') }}" alt="AQUALAB PH" class="h-20 fill-current text-gray-500">
                {{-- AQUA LAB PH --}}
            </a>
        </div>

        <div class="mt-6 w-full overflow-hidden bg-white px-6 py-4 shadow-md sm:max-w-md sm:rounded-lg">
            @yield('content')
        </div>
    </div>
</body>

</html>
