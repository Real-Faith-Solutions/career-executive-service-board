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

<div class="mb-3 grid gap-4 sm:gid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 grid-cols-1">

    <div class="card bg-blue-100">
        <div class="flex justify-between text-blue-500 items-center">
            <div>
                <p>Total Active and Retired (CESOs and CES Eligibles)</p>
                <h1 class="text-3xl font-bold">{{ $totalCESO }}</h1>
                
                <div class="lg:flex md:flex-col sm:flex-col justify-between gap-2 ">
                    <p>
                        Total Active CESOs
                        <span class="font-bold">
                            {{ $totalActiveRetiredCES }}
                        </span>
                    </p>
                    <p>
                        Total Active Eligibles
                        <span class="font-bold">
                            {{ $totalActiveRetiredEligibles }}
                        </span>                    
                    </p>
                </div>
            </div>

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" 
                stroke="currentColor" class="w-12 h-12 opacity-75">
                <path stroke-linecap="round" stroke-linejoin="round" 
                    d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
            </svg>
        </div>
    </div>

    <div class="card bg-green-100">
        <div class="flex justify-between text-green-500 items-center">
            <div>
                <p>Total Active CESOs and CES Eligibles</p>
                <h1 class="text-3xl font-bold">{{ $totalCESOActive }}</h1>
                
                <div class="lg:flex md:flex-col sm:flex-col justify-between gap-2 ">
                    <p>
                        Total Active CESOs
                        <span class="font-bold">
                            {{ $totalActiveCES }}
                        </span>
                    </p>
                    <p>
                        Total Active Eligibles
                        <span class="font-bold">
                            {{ $totalActiveEligibles }}
                        </span>                    
                    </p>
                </div>
            </div>

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" 
                stroke="currentColor" class="w-12 h-12 opacity-75">
                <path stroke-linecap="round" stroke-linejoin="round" 
                    d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
            </svg>
              
        </div>
    </div>

    <div class="card bg-red-100">
        <div class="flex justify-between text-red-500 items-center">
            <div>
                <p>Total Retired CESOs</p>
                <br>
                <h1 class="text-3xl font-bold">{{ $totalCESORetired }}</h1>
                <div class="lg:flex md:flex-col sm:flex-col justify-between gap-2 ">
                    <p>
                        Total Retired CESOs
                        <span class="font-bold">
                            {{ $totalRetiredCES }}
                        </span>
                    </p>
                    <p>
                        Total Retired Eligibles
                        <span class="font-bold">
                            {{ $totalRetiredEligibles }}
                        </span>
                    </p>
                </div>
            </div>

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" 
                stroke="currentColor" class="w-12 h-12 opacity-75">
                <path stroke-linecap="round" stroke-linejoin="round" 
                    d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z" />
            </svg>
              
        </div>
    </div>

    <div class="card bg-orange-100">
        <div class="flex justify-between text-orange-500 items-center">
            <div>
                <p>Total Deceased CESOs</p>
                <br>
                <h1 class="text-3xl font-bold">{{ $totalCESODeceased }}</h1>
                
                <div class="lg:flex md:flex-col sm:flex-col justify-between gap-2 ">
                    <p>
                        Total Deceased CESOs
                        <span class="font-bold">
                            {{ $totalDeceasedCES }}
                        </span>
                    </p>
                    <p>
                        Total Deceased Eligibles
                        <span class="font-bold">
                            {{ $totalDeceasedEligibles }}
                        </span>
                    </p>
                </div>
            </div>

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" 
                stroke="currentColor" class="w-12 h-12 opacity-75">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              
        </div>
    </div>

    

    <div class="card bg-violet-100">
        <div class="flex justify-between text-violet-500 items-center">
            <div>
                <p>Total Inactive CESOs</p>
                <br>
                <h1 class="text-3xl font-bold">{{ $totalCESOInactive }}</h1>
                <div class="lg:flex md:flex-col sm:flex-col justify-between gap-2 ">
                    <p>
                        Total Inactive CESOs
                        <span class="font-bold">
                            {{ $totalInactiveCES }}
                        </span>
                    </p>
                    <p>
                        Total Inactive Eligibles
                        <span class="font-bold">
                            {{ $totalInactiveEligibles }}
                        </span>
                    </p>
                </div>
            </div>

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" 
                stroke="currentColor" class="w-12 h-12 opacity-75">
                <path stroke-linecap="round" stroke-linejoin="round" 
                    d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
            </svg>
              
        </div>
    </div>

</div>