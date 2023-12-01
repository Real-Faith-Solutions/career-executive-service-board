@extends('layouts.app')
@section('title', '201 Report for Placement')
@section('content')

<nav class="bg-gray-200 border-gray-200 mb-3">
    <div class="flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="#" class="flex items-center">
            <span class="self-center text-2xl font-semibold whitespace-nowrap uppercase text-blue-500">
                REPORTS FOR PLACEMENT
            </span>

            <div class="flex justify-end">
                <a href="" class="btn btn-primary">
                    Generate PDF Report
                </a>
            </div>
        </a>
    </div>
</nav>

    <section>   
        <div class="table-management-rankTrackers relative overflow-x-auto sm:rounded-lg shadow-lg">
            <table class="w-full text-left text-sm text-gray-500">
                <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            CES No.
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>

                        <th scope="col" class="px-6 py-3">
                        
                            Status
                        </th>

                        <th scope="col" class="px-6 py-3">
                        
                            CES Status
                        </th>

                        <th scope="col" class="px-6 py-3">
                        
                            Expertise
                        </th>

                        <th scope="col" class="px-6 py-3">
                        
                            Degree/Major
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($personalData as $datas) 
                        <tr class="border-b bg-white">
                            <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                                {{ $datas->cesno }}
                            </td>

                            <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                                {{ $datas->lastname }},
                                {{ $datas->firstname }},
                                {{ $datas->middlename }},
                                {{ $datas->name_extension }}
                            </td>

                            <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                                {{ $datas->status}}
                            </td>

                            <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                                {{ $datas->cesStatus->description }}
                            </td>
    
                            <td class="px-6 py-3">
                                
                            </td>

                            <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                                
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
