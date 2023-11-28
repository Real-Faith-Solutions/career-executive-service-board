@extends('layouts.app')
@section('title', 'General Reports')
@section('sub', 'General Reports')
@section('content')

<nav class="bg-gray-200 border-gray-200 mb-3">
    <div class="flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="#" class="flex items-center">
            <span class="self-center text-2xl font-semibold whitespace-nowrap uppercase text-blue-500">201 PROFILE - STATISTICAL REPORTS</span>
        </a>

        <div class="flex justify-end">
            <a href="{{ route('statistical-report.pdf') }}" target='_blank' class="btn btn-primary">Generate PDF Report</a>
        </div>
    </div>
</nav>

    <section>

        @include('admin.dashboard.partials.ceso_status')

        <div class="grid gap-4 items-end mb-3 uppercase sm:grid-cols-1 sm:gap-3 lg:grid-cols-3 lg:gap-4">
            <div class="w-full rounded sm:w-auto">
                <div class="bg-white">
                    <div class="rounded-lg shadow-md">
                        <canvas class="w-full p-2" id="profileStatus"></canvas>
                        <script>
                            profileStatus();
                        </script>
                    </div>
                </div>
            </div>

            <div class="w-full rounded sm:w-auto col-span-2">
                <div class="bg-white">
                    <div class="rounded-lg shadow-md">
                        <canvas class="w-full p-2" id="ageDemographics"></canvas>
                        <script>
                            ageDemographics();
                        </script>
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection
