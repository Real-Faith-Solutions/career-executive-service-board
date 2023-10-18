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
@section('title', 'Plantilla reports')
<h1 class="text-center text-2xl font-semibold whitespace-nowrap uppercase text-blue-500 mb-5">
    Plantilla Reports
</h1>

<div class="sm:gid-cols-1 mb-3 grid gap-2 md:grid-cols-2 lg:grid-cols-4 lg:grid-row-2 sm:grid-row-1">

    <div class="card bg-blue-100">
        <div class="flex justify-between text-blue-500 items-center">
            <div>
                <p>Total Plantilla</p>
                <h1 class="text-3xl font-bold">{{ $plantillaAll }}</h1>
            </div>

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-12 h-12 opacity-75">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
            </svg>
        </div>
    </div>

    <div class="card bg-green-100">
        <div class="flex justify-between text-green-500 items-center">
            <div>
                <p>Total Plantilla CES Only</p>
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
                Percentage of total CES employees.
            </p>
            <span class="text-green-500 rounded opacity-75">
                {{ $percentageCES }} %
            </span>
        </div>
    </div>

    <div class="card bg-orange-100">
        <div class="flex justify-between text-orange-500 items-center">
            <div>
                <p>Total Plantilla Non-CES Only</p>
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
            Percentage of total non-CES employees
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
                                    <p>
                                        {{ $data->planPosition->pos_default }}
                                    </p>
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
                    <div class="bg-blue-100 text-white p-2 grid grid-cols-3 flex items-center">
                        <h1 class=" text-center font-semibold whitespace-nowrap uppercase text-blue-500 col-start-2">
                            Plantilla Statistics Summary per Department
                        </h1>
                        <div class="flex items-center justify-end">
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
                        </div>
                    </div>
                    <div class="overflow-x-auto overflow-y-auto" style="max-height: 500px;">
                        <table class="min-w-full divide-y divide-gray-200">
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
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection