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
                    backgroundColor: ["#DCFCE7", "#ffedd5", "#FEE2E2","#EDE9FE"],
                    borderColor: ["#DCFCE7", "#ffedd5", "#FEE2E2", "#EDE9FE"],
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

<div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-5">
    <div class="card bg-blue-100">
        <div class="flex justify-between text-blue-500 items-center">
            <div>
                <p>Examinations Taken</p>
                <h1 class="text-3xl font-bold">{{ $totalCESO }}</h1>
            </div>

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" 
                stroke="currentColor" class="w-12 h-12 opacity-75">
                <path stroke-linecap="round" stroke-linejoin="round" 
                    d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75" />
            </svg>
        </div>
    </div>

    <div class="card bg-green-100">
        <div class="flex justify-between text-green-500 items-center">
            <div>
                <p>Scholarships</p>
                <h1 class="text-3xl font-bold">{{ $totalCESOActive }}</h1>
            </div>

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" 
                stroke="currentColor" class="w-12 h-12 opacity-75">
                <path stroke-linecap="round" stroke-linejoin="round" 
                    d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
            </svg>
        </div>
    </div>

    <div class="card bg-yellow-100">
        <div class="flex justify-between text-orange-500 items-center">
            <div>
                <p>Research and Studies</p>
                <h1 class="text-3xl font-bold">{{ $totalCESODeceased }}</h1>
            </div>

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" 
                stroke="currentColor" class="w-12 h-12 opacity-75">
                <path stroke-linecap="round" stroke-linejoin="round" 
                    d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5m.75-9l3-3 2.148 2.148A12.061 12.061 0 0116.5 7.605" />
            </svg>
        </div>
    </div>

    <div class="card bg-cyan-100">
        <div class="flex justify-between text-cyan-500 items-center">
            <div>
                <p>CES Trainings</p>
                <h1 class="text-3xl font-bold">{{ $totalCESORetired }}</h1>
            </div>

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" 
                stroke="currentColor" class="w-12 h-12 opacity-75">
                <path stroke-linecap="round" stroke-linejoin="round" 
                    d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z" />
            </svg>
        </div>
    </div>

    <div class="card bg-violet-100">
        <div class="flex justify-between text-violet-500 items-center">
            <div>
                <p>Non-CES Trainings</p>
                <h1 class="text-3xl font-bold">{{ $totalCESOInactive }}</h1>
            </div>

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-12 h-12 opacity-75">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" />
            </svg>

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" 
                stroke="currentColor" class="w-12 h-12 opacity-75">
                <path stroke-linecap="round" stroke-linejoin="round" 
                d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
            </svg>
        </div>
    </div>
</div>

<div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-5">
    <div class="card bg-blue-100">
        <div class="flex justify-between text-blue-500 items-center">
            <div>
                <p>Awards and Citations</p>
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
                <p>Pending Files</p>
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
                <p>Accepted Files</p>
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
                <p>Rejected Files</p>
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
                <p>Pending Case</p>
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