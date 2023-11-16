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
                    backgroundColor: ["#86efac", "#fdba74", "#fca5a5","#c4b5fd"],
                    borderColor: ["#86efac", "#fdba74", "#fca5a5", "#c4b5fd"],
                    data: [{{ $totalCESOActive }}, {{ $totalCESODeceased }} , {{ $totalCESORetired }}, {{ $totalCESOInactive }}],
                    fill: true,
                },

            ],
        };

        const configLineChart = {
            type: "pie",
            data,
            options: {
                
            },
        };

        var chartLine = new Chart(
            document.getElementById("profileStatus"),
            configLineChart
        );
    };

    const ageDemographics = () => {
        const labels = [
            "25 & below",
            "26 - 35",
            "36 - 45",
            "46 - 55",
            "56 - 65",
            "66 & above",
        ];
        const data = {
            labels: labels,
            datasets: [
                {
                    // backgroundColor: ["#86efac", "#fdba74", "#fca5a5","#c4b5fd"],
                    // borderColor: ["#86efac", "#fdba74", "#fca5a5", "#c4b5fd"],
                    label: 'Age Demographics',
                    data: [{{ $age25below }}, 
                            {{ $age26to35 }} , 
                            {{ $age36to45 }}, 
                            {{ $age46to55 }},
                            {{ $age56to65 }},
                            {{ $age66above }}
                        ],
                    backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    ],
                    borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)',
                    ],
                    borderWidth: 1,
                    fill: true,
                },

            ],
        };

        const config = {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
        };

        var chartLine = new Chart(
            document.getElementById("ageDemographics"),
            config
        );
    };

</script>

<div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-5">
    <div class="card bg-blue-100">
        <div class="flex justify-between text-blue-500 items-center">
            <div>
                <p>Total CESOs</p>
                <h1 class="text-3xl font-bold">{{ $totalCESO }}</h1>
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
                <p>Total Active CESOs</p>
                <h1 class="text-3xl font-bold">{{ $totalCESOActive }}</h1>
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
                {{-- Percentage of total CES employees. --}}
            </p>
            <span class="text-green-500 rounded opacity-75">
                {{-- {{ $percentageCES }} % --}}
            </span>
        </div>
    </div>

    <div class="card bg-orange-100">
        <div class="flex justify-between text-orange-500 items-center">
            <div>
                <p>Total Deceased CESOs</p>
                <h1 class="text-3xl font-bold">{{ $totalCESODeceased }}</h1>
            </div>

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-12 h-12 opacity-75">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" />
            </svg>
        </div>
        <br>
        <p class="text-sm">
            {{-- Percentage of total non-CES employees --}}
        </p>
        <span class="text-orange-500 rounded opacity-75">
            {{-- {{ $percentageNonCES }} % --}}
        </span>
    </div>
    <div class="card bg-red-100">
        <div class="flex justify-between text-red-500 items-center">
            <div>
                <p>Total Retired CESOs</p>
                <h1 class="text-3xl font-bold">{{ $totalCESORetired }}</h1>
            </div>

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-12 h-12 opacity-75">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" />
            </svg>
        </div>
        <br>
        <p class="text-sm">
            {{-- Percentage of total non-CES employees --}}
        </p>
        <span class="text-red-500 rounded opacity-75">
            {{-- {{ $percentageNonCES }} % --}}
        </span>
    </div>
    <div class="card bg-violet-100">
        <div class="flex justify-between text-violet-500 items-center">
            <div>
                <p>Total Inactive CESOs</p>
                <h1 class="text-3xl font-bold">{{ $totalCESOInactive }}</h1>
            </div>

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-12 h-12 opacity-75">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" />
            </svg>
        </div>
        <br>
        <p class="text-sm">
            {{-- Percentage of total non-CES employees --}}
        </p>
        <span class="text-violet-500 rounded opacity-75">
            {{-- {{ $percentageNonCES }} % --}}
        </span>
    </div>
</div>