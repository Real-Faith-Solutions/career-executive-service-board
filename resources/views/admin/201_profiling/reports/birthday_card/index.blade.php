@extends('layouts.app')
@section('title', '201 Birthday Card')
@section('content')

<nav class="bg-gray-200 border-gray-200 mb-3">
    <div class="flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="#" class="flex items-center">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="ml-1 w-6 h-6 text-blue-500">
                    <path 
                        stroke-linecap="round" 
                        stroke-linejoin="round" 
                        d="M12 8.25v-1.5m0 1.5c-1.355 0-2.697.056-4.024.166C6.845 8.51 6 9.473 6 10.608v2.513m6-4.87c1.355 0 2.697.055 4.024.165C17.155 8.51 
                        18 9.473 18 10.608v2.513m-3-4.87v-1.5m-6 1.5v-1.5m12 9.75l-1.5.75a3.354 3.354 0 01-3 0 3.354 3.354 0 00-3 0 3.354 3.354 0 01-3 0 3.354
                        3.354 0 00-3 0 3.354 3.354 0 01-3 0L3 16.5m15-3.38a48.474 48.474 0 00-6-.37c-2.032 0-4.034.125-6 .37m12 0c.39.049.777.102 1.163.16 1.07.16
                        1.837 1.094 1.837 2.175v5.17c0 .62-.504 1.124-1.125 1.124H4.125A1.125 1.125 0 013 20.625v-5.17c0-1.08.768-2.014 1.837-2.174A47.78 47.78 0 
                        016 13.12M12.265 3.11a.375.375 0 11-.53 0L12 2.845l.265.265zm-3 0a.375.375 0 11-.53 0L9 2.845l.265.265zm6 0a.375.375 0 11-.53 0L15 2.845l.265.265z" 
                    />
                </svg>
            </span>
            
            <span class="self-center text-xl font-semibold whitespace-nowrap uppercase text-blue-500 ml-5">
                BIRTHDAY CELEBRANTS FOR THIS {{ $fullDateName }}, TOTAL ({{ $numberOfCelebrant }})
            </span>

            <span class="self-center text-2xl font-semibold whitespace-nowrap uppercase text-blue-500">
                <a href="{{ route('birthday.birthdayCelebrantGeneratePdfReport') }}" target="_blank" class="btn btn-primary">
                    Generate PDF Report
                </a> 
            </span>
        </a>
    </div>
</nav>

<div class="flex justify-start mb-5 gap-2">
    <div class="btn btn-primary">
        <a href="{{ route('birthday.monthlyCelebrant') }}">
            Monthly Celebrant
        </a> 
    </div>
</div>

    <section>   
        <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-5">
            @foreach ($personalData as $datas)
                    <div class="card bg-blue-100 flex justify-between">
                        <div class="flex justify-between text-blue-500 items-center">
                            <div>
                                <p class="font-bold">
                                    {{ $datas->lastname }},
                                    {{ $datas->firstname }},
                                    {{ $datas->middlename }},
                                    {{ $datas->name_extension }}
                                </p>

                                <p class="font-bold">
                                    {{ $datas->cesStatus->description }}
                                </p>
                            </div>                      
                        </div>

                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="ml-1 w-6 h-6 text-blue-500">
                                <path 
                                    stroke-linecap="round" 
                                    stroke-linejoin="round" 
                                    d="M12 8.25v-1.5m0 1.5c-1.355 0-2.697.056-4.024.166C6.845 8.51 6 9.473 6 10.608v2.513m6-4.87c1.355 0 2.697.055 4.024.165C17.155 8.51 
                                    18 9.473 18 10.608v2.513m-3-4.87v-1.5m-6 1.5v-1.5m12 9.75l-1.5.75a3.354 3.354 0 01-3 0 3.354 3.354 0 00-3 0 3.354 3.354 0 01-3 0 3.354
                                    3.354 0 00-3 0 3.354 3.354 0 01-3 0L3 16.5m15-3.38a48.474 48.474 0 00-6-.37c-2.032 0-4.034.125-6 .37m12 0c.39.049.777.102 1.163.16 1.07.16
                                    1.837 1.094 1.837 2.175v5.17c0 .62-.504 1.124-1.125 1.124H4.125A1.125 1.125 0 013 20.625v-5.17c0-1.08.768-2.014 1.837-2.174A47.78 47.78 0 
                                    016 13.12M12.265 3.11a.375.375 0 11-.53 0L12 2.845l.265.265zm-3 0a.375.375 0 11-.53 0L9 2.845l.265.265zm6 0a.375.375 0 11-.53 0L15 2.845l.265.265z" 
                                />
                            </svg>
                        </div>    
                    </div>        
            @endforeach
        </div>
    </section>
@endsection
