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
                plugins: {
                    title: {
                        display: true,
                        text: 'CESOs & Eligibles',
                    }
                }
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
                    data: [{{ $age25below }}, 
                            {{ $age26to35 }} , 
                            {{ $age36to45 }}, 
                            {{ $age46to55 }},
                            {{ $age56to65 }},
                            {{ $age66above }}
                        ],
                    backgroundColor: ["#86efac", "#fdba74", "#fca5a5", "#c4b5fd", "#FFBC42", "#BBE1C3"],
                    borderColor: ["#86efac", "#fdba74", "#fca5a5", "#c4b5fd", "#FFBC42", "#BBE1C3"],
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
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Age Demographics (Active CESOs & Eligibles)',
                    },
                    legend: {
                        display: false,
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
                    d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
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
                    d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
            </svg>
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
                    d="M15.182 16.318A4.486 4.486 0 0012.016 15a4.486 4.486 0 00-3.198 1.318M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75zm-.375 0h.008v.015h-.008V9.75zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75zm-.375 0h.008v.015h-.008V9.75z" />
            </svg>
              
        </div>
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
    </div>

</div>