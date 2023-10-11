<script>
    const plantillaStatistics = () => {
        const labels = [
            "Plantilla Statistics (CES Only)",
            "Plantilla Statistics (Non-CES Only)",
        ];

        const data = {
            labels: labels,
            datasets: [
                {
                    backgroundColor: ["#1C64F2", "#C05621"],
                    borderColor: ["#1C64F2", "#C05621"],
                    data: [
                        {{ $plantillaCES }},
                        {{ $plantillaNonCES }},
                    ],
                    fill: false,
                },
            ],
        };

        const configLineChart = {
            type: "pie",
            data,
            options: {},
        };

        var chartLine = new Chart(
            document.getElementById("plantillaStatistics"),
            configLineChart
        );
    };

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
                    backgroundColor: ["#1C64F2", "#0E8A16", "#D4C5F9", "#FBCA04"],
                    borderColor: ["#1C64F2", "#0E8A16", "#D4C5F9", "#FBCA04"],
                    data: [{{ $totalMaleCESO }}, {{ $totalFemaleCESO }}, {{ $totalMaleNonCESO }}, {{ $totalFemaleNonCESO }}],
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
<div class="grid gap-4 mb-3 sm:grid-cols-1 sm:gap-3 lg:grid-cols-4 lg:gap-4">
    <div class="w-full rounded sm:w-auto">
        <div class="bg-white">
            <div class="rounded-lg shadow-md">
                <div class="bg-blue-500 text-white p-2">
                    <h1 class="text-center font-semibold whitespace-nowrap uppercase">
                        Plantilla Statistics
                    </h1>
                </div>

                <canvas class="w-full p-2" id="plantillaStatistics"></canvas>
                <script>
                    plantillaStatistics();

                </script>
                <h1 class="text-center text-slate-500 font-semibold">
                    Total Plantilla {{ $plantillaAll }}
                </h1>
            </div>
        </div>
    </div>
    <div class="w-full rounded sm:w-auto">
        <div class="bg-white">
            <div class="rounded-lg shadow-md">
                <div class="bg-blue-500 text-white p-2">
                    <h1 class="text-center font-semibold whitespace-nowrap uppercase">
                        Plantilla Statistics By Gender
                    </h1>
                </div>
                <canvas class="w-full p-2" id="plantillaStatisticsByGender"></canvas>
                <script>
                    plantillaStatisticsByGender();

                </script>
            </div>
        </div>
    </div>
</div>
@endsection