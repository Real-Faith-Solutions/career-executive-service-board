<script>
    const profileStatus = () => {
        const labels = [
            "Total Active CESO",
            "Total Deceased CESO",
            "Total Retired CESO",
            "Total Inacitve"
        ];
        const data = {
            labels: labels,
            datasets: [
                {
                    backgroundColor: ["#1F9D55", "#C05621", "#1C64F2","#DC2626"],
                    borderColor: ["#1F9D55", "#C05621", "#1C64F2", "#DC2626"],
                    data: [{{ $totalCESOActive }}, {{ $totalCESODeceased }} , {{ $totalCESORetired }}, {{ $totalCESOInactive }}],
                    fill: true,
                },

            ],
        };

        const configLineChart = {
            type: "pie",
            data,
            options: {},
        };

        var chartLine = new Chart(
            document.getElementById("profileStatus"),
            configLineChart
        );
    };

</script>


@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    @auth
    <div class="card bg-slate-50 lg:flex lg:justify-between text-slate-500 text-2xl">
        <h1>Hello {{ $userTitle." ".$userName." [".$userRoleTitle."]" }}</h1>
        <h1 id="currentDateTime"></h1>
    </div>
    @endauth
    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-4">
        <div class="card bg-slate-50">
            <h1 class="text-2xl font-bold">{{ $totalCESO }}</h1>
            <p>Total CESOs</p>
        </div>
        <div class="card bg-slate-50">
            <h1 class="text-2xl font-bold">{{ $totalCESOActive }}</h1>
            <p>Total Active CESOs</p>
        </div>
        <div class="card bg-slate-50">
            <h1 class="text-2xl font-bold">{{ $totalCESODeceased }}</h1>
            <p>Total Deceased CESOs</p>
        </div>
        <div class="card bg-slate-50">
            <h1 class="text-2xl font-bold">{{ $totalCESORetired }}</h1>
            <p>Total Retired CESOs</p>
        </div>
    </div>

    <div class="grid gap-4 mb-3 uppercase sm:grid-cols-1 sm:gap-3 lg:grid-cols-3 lg:gap-4">
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
    </div>

@endsection
