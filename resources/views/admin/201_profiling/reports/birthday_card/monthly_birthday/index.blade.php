@extends('layouts.app')
@section('title', '201 Birthday Card Monthly')
@section('content')

<nav class="bg-gray-200 border-gray-200 mb-3">
    <div class="flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="#" class="flex items-center">
            <span class="self-center text-2xl font-semibold whitespace-nowrap uppercase text-blue-500">
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

            <span class="self-center text-2xl font-semibold whitespace-nowrap uppercase text-blue-500">
                BIRTHDAY CELEBRANTS FOR THIS {{ $currentMonthFullName }}
            </span>
            
            <div class="flex justify-end">
                <a href="" class="btn btn-primary">
                    Generate PDF Report
                </a>
            </div>
        </a>
    </div>
</nav>

<div class="flex justify-start mb-5 gap-2">
    <div class="btn btn-primary">
        <a href="{{ route('birthday.index') }}">
            Birthday Celebrant
        </a>
    </div>

    <div class="btn btn-primary">
        <a href="">
            Weekly Celebrant
        </a>
    </div>
</div>

    <section>   
        <div class="table-management-rankTrackers relative overflow-x-auto sm:rounded-lg shadow-lg">
            <table class="w-full text-left text-sm text-gray-500">
                <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
                    <tr>
                        <th>

                        </th>

                        <th>
                            Name
                        </th>
    
                        <th scope="col" class="px-6 py-3">
                            Birth Date
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($personalData as $datas) 
                        <tr class="border-b bg-white">
                            <td>
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
                            </td>
    
                            <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                                {{ $datas->lastname }},
                                {{ $datas->firstname }},
                                {{ $datas->middlename }},
                                {{ $datas->name_extension }}
                            </td>
    
                            <td class="px-6 py-3">
                                {{ \Carbon\Carbon::parse($datas->birthdate)->format('m/d/Y ') ?? '' }}
                            </td>
                        </tr>
                    @endforeach 
                </tbody>
            </table>
        </div>
    
        <div class="m-5">
            {{ $personalData->links() }}
        </div>
    </section>
@endsection
