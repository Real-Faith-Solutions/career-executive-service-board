<script>
    const sectorsToggle = () => {
        const form = document.querySelector(".toggleForm");

        form.submit();
    }
    
    const plantillaStatisticsByGender = () => {
        const labels = [
            "Total Male CESO",
            "Total Female CESO",
            "Total Male NON CES",
            "Total Female NON CES",
        ];

        const data = {
            labels: labels,
            datasets: [
                {
                    label: labels,
                    backgroundColor: ["#4299E1", "#9F7AEA", "#BEE3F8", "#E9D8FD"],
                    borderColor: ["#4299E1", "#9F7AEA", "#BEE3F8", "#E9D8FD"],
                    data: [{{ $totalMaleCESOChart }}, {{ $totalFemaleCESOChart }}, {{ $totalMaleNonCESOChart }}, {{ $totalFemaleNonCESOChart }}],
                    fill: false,
                },
            ],
        };

        const configBarChart = {
            type: "doughnut",
            data: data,
            options: {} // You can add chart options here if needed
        };

        var chartBar = new Chart(
            document.getElementById("plantillaStatisticsByGender"),
            configBarChart
        );
    };
</script>

@extends('layouts.app')
@section('content')
@section('title', 'Plantilla Reports')
<h1 class="text-center text-2xl font-semibold whitespace-nowrap uppercase text-blue-500 mb-5">
    @yield('title')
</h1>

<div class="lg:grid sm:gid-cols-1 mb-3 gap-2 md:grid-cols-2 lg:grid-cols-4 lg:grid-row-2 sm:grid-row-1">

    <div class="card bg-blue-100">
        <div class="flex justify-between text-blue-500 items-center">
            <div>
                <p>TOTAL NO. OF CES POSITIONS</p>
                <h1 class="text-3xl font-bold">{{ $plantillaAll }}</h1>
            </div>

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-12 h-12 opacity-75">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
            </svg>
        </div>
        <br /><br />
    </div>

    <div class="card bg-green-100">
        <div class="flex justify-between text-green-500 items-center">
            <div>
                <p>CESOs and Eligibles</p>
                <h1 class="text-3xl font-bold">{{ $plantillaCES }}</h1>
            </div>

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-12 h-12 opacity-75">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" />
            </svg>
        </div>
        <br>
        <div>
            <p class="text-sm">
                Percentage of total Occupied CES Positions
            </p>
            <span class="text-green-500 rounded opacity-75">
                {{ $percentageCES }} %
            </span>
        </div>
    </div>

    <div class="card bg-orange-100">
        <div class="flex justify-between text-orange-500 items-center">
            <div>
                <p>Non-CESOs and Non-Eligibles</p>
                <h1 class="text-3xl font-bold">{{ $plantillaNonCES }}</h1>
            </div>

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-12 h-12 opacity-75">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" />
            </svg>
        </div>
        <br>
        <p class="text-sm">
            Percentage of total Occupied CES Positions
        </p>
        <span class="text-orange-500 rounded opacity-75">
            {{ $percentageNonCES }} %
        </span>
    </div>

    <div class="lg:row-span-2 sm:row-span-1 w-full rounded sm:w-auto">
        <div class="bg-white">
            <div class="rounded-lg shadow-md">
                <div class="bg-blue-100 text-white p-2">
                    <h1 class="text-center font-semibold whitespace-nowrap uppercase text-blue-500">
                        Plantilla Statistics By Gender
                    </h1>
                </div>
                <div class="card flex justify-between text-center font-semibold text-slate-500">
                    <div>
                        <h1>
                            Total Male
                        </h1>
                        <p>{{ $totalMale }}</p>
                    </div>
                    <div>
                        <h1>
                            Total Female
                        </h1>
                        <p>{{ $totalFemale }}</p>
                    </div>
                </div>
                <canvas class="w-full p-2" id="plantillaStatisticsByGender"></canvas>
                <script>
                    plantillaStatisticsByGender();
    
                </script>
            </div>
        </div>
    </div>

    <div class="lg:row-span-2 sm:row-span-1 w-full rounded sm:w-auto">
        <div class="bg-white">
            <div class="rounded-lg shadow-md">
                <div class="bg-green-100 text-white p-2">
                    <h1 class="text-center font-semibold whitespace-nowrap uppercase text-green-500">
                        Recent Appointees
                    </h1>
                </div>

                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Appointee
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($recentAppointee as $data)
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap">
                                <div class="text-sm leading-5 text-gray-900 flex justify-between">
                                    <p>
                                        {{ $data->personalData->title }}
                                        {{ $data->personalData->lastname }},
                                        {{ $data->personalData->firstname }}
                                        {{ $data->personalData->name_extension }}
                                        {{ $data->personalData->mi }}
                                    </p>
                                    <!-- <p class="text-end">
                                        {{ $data->planPosition->pos_default }}
                                    </p> -->
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <div class="col-span-3 row-span-2 row-start-2">
        <div class="w-full rounded sm:w-auto">
            <div class="bg-white">
                <div class="rounded-lg shadow-md">
                    <div class="bg-blue-100 text-white p-4 grid grid-cols-3 flex items-center">
                        <h1 class=" text-center font-semibold whitespace-nowrap uppercase text-blue-500 col-start-2">
                            Blue Book Agency Selector
                        </h1>
                        {{-- <div class="flex items-center justify-end">
                            <form class="toggleForm">
                                <select onchange="sectorsToggle()" style="padding:5 0" name="sectorToggle">
                                    <option value="">All</option>
                                    @foreach ($sectors as $data)
                                    <option value="{{ $data->sectorid }}" {{ $data->sectorid == $sectorToggle ?
                                        'selected' :
                                        ''}}>
                                        {{ $data->title }}
                                    </option>
                                    @endforeach
                                </select>
                            </form>
                        </div> --}}
                    </div>
                    <div class="overflow-x-auto overflow-y-auto" style="max-height: 500px;">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        NATIONAL GOVERNMENT AGENCIES
                                    </th>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Generate reports
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($motherDepartmentAgency as $data)
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        <a class="text-sm leading-5 text-gray-900 hover:text-blue-500" href="#">
                                            {{ $data->title }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm">
                                        <div class="flex gap-2">
                                            <a class="text-gray-900 hover:text-blue-500"
                                                href="{{ route('statistics.pdf', $data->deptid) }}" target="_blank"
                                                title="Generate Department Bluebook report">
                                                <!-- Add a unique ID for this link -->
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                                                </svg>
                                            </a>

                                            <a class="text-gray-900 hover:text-blue-500"
                                                href="{{ route('occupancy-report.pdf', $data->deptid) }}"
                                                target="_blank" title="Generate Department Bluebook Occupancy">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z" />
                                                </svg>
                                            </a>

                                            <!-- Use a unique ID for this link -->
                                            <a class="text-gray-900 hover:text-blue-500"
                                                id="department_{{ $loop->index }}" href="#"
                                                title="Generate Agency Buebook Report">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                                </svg>
                                            </a>
                                            |

                                            {{-- Attached agencies --}}
                                            <a class="text-gray-900 hover:text-blue-500"
                                                href="{{ route('attached-occupancy-report.pdf', $data->deptid) }}"
                                                target="_blank" title="Generate Attached Agency Bluebook Occupancy">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z" />
                                                </svg>
                                            </a>

                                            <a class="text-gray-900 hover:text-blue-500"
                                                id="attachedAgency_{{ $loop->index }}" href="#"
                                                title="Generate Attached Agency Buebook Report">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                                </svg>
                                            </a>

                                        </div>
                                    </td>

                                    <script>
                                        // Use the unique ID for this link in JavaScript
                                        document.getElementById("department_{{ $loop->index }}").addEventListener("click", function() {
                                            window.open("{{ route('ceso-eligibles-ces-position.pdf', $data->deptid) }}", "_blank");
                                            window.open("{{ route('ceso-eligibles-nonces-position.pdf', $data->deptid) }}", "_blank");
                                            window.open("{{ route('nonceso-noneligibles-ces-position.pdf', $data->deptid) }}", "_blank");
                                            window.open("{{ route('vacant-position.pdf', $data->deptid) }}", "_blank");
                                        });

                                        document.getElementById("attachedAgency_{{ $loop->index }}").addEventListener("click", function() {
                                            window.open("{{ route('attached-ceso-eligibles-ces-position.pdf', $data->deptid) }}", "_blank");
                                            window.open("{{ route('attached-ceso-eligibles-nonces-position.pdf', $data->deptid) }}", "_blank");
                                            window.open("{{ route('attached-nonceso-noneligibles-ces-position.pdf', $data->deptid) }}", "_blank");
                                            window.open("{{ route('attached-vacant-position.pdf', $data->deptid) }}", "_blank");
                                        });
                                    </script>
                                </tr>
                                @endforeach

                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        <a class="text-sm leading-5 text-gray-900 hover:text-blue-500" href="#">
                                            CES Occupancy Statistics Report
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        <a class="text-sm leading-5 text-gray-900 hover:text-blue-500"
                                            href="{{ route('ces-occupancy-statistics-report.pdf', 'detailed occupancy') }}"
                                            target="_blank" title="Generate Detailed Occupancy Statistics">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        <a class="text-sm leading-5 text-gray-900 hover:text-blue-500" href="#">
                                            CES Occupancy Statistics Report Summary
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        <a class="text-sm leading-5 text-gray-900 hover:text-blue-500"
                                            href="{{ route('ces-occupancy-statistics-report-summary.pdf', 'occupancy') }}"
                                            target="_blank" title="Generate Statistics Summary">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>

                            </tbody>
                        </table>


                        {{-- <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Department Agency
                                    </th>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Total Plantilla
                                    </th>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Male CESO - Male NonCESO
                                    </th>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Female CESO - Female NonCESO
                                    </th>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Total CESO
                                    </th>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Total NONCESO
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($agencyStatistics as $data)
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        <div class="text-sm leading-5 text-gray-900">
                                            {{ $data['agency']->title }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        <div class="text-sm leading-5 text-gray-900 text-center">
                                            {{ $data['total_plantilla'] }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        <div class="text-sm leading-5 text-gray-900 text-center">
                                            {{ $data['total_male_ceso'] }} - {{ $data['total_male_nonceso'] }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        <div class="text-sm leading-5 text-gray-900 text-center">
                                            {{ $data['total_female_ceso'] }} - {{ $data['total_female_nonceso'] }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        <div class="text-sm leading-5 text-gray-900 text-center">
                                            {{ $data['total_ceso'] }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        <div class="text-sm leading-5 text-gray-900 text-center">
                                            {{ $data['total_nonceso'] }}
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Department Agency
                                    </th>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Total Plantilla
                                    </th>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Male CESO - Male NonCESO
                                    </th>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Female CESO - Female NonCESO
                                    </th>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Total CESO
                                    </th>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Total NONCESO
                                    </th>
                                </tr>
                            </tfoot>
                        </table> --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection