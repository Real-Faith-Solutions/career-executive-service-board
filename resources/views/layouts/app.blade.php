<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="png" href="{{ asset('images/alpha_logo.png') }}">
    <title>@yield('title')</title>
    <script src="{{ asset('js/app.js') }}"></script>
</head>

<body>
    @include('layouts.tailwindcss')
    @include('layouts.modals')
    @include('layouts.partials.header')
    @include('layouts.partials.sidebar')


    <div class="p-4 sm:ml-64">
        <div class="mt-14 rounded-lg border-2 border-dashed border-gray-200 p-4 dark:border-gray-700">
            @yield('content')
        </div>
    </div>
</body>

</html>
