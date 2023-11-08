@extends('layouts.app')
@section('title', 'ERIS-General Report')
@section('content')

    <div class="flex justify-between">
        <h1 class="uppercase font-semibold text-blue-600 text-lg">General Report</h1>

        <div class="flex items-center">
            <form action="" target="_blank" method="GET">
                @csrf

                <button class="btn btn-primary mx-1 font-medium text-blue-600" type="submit">
                    Generate PDF Report
                </button>
            </form>
        </div>
    </div>

    <div class="table-management-data relative overflow-x-auto sm:rounded-lg shadow-lg my-5">
        <table class="w-full text-left text-sm text-gray-500">
            <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Account No
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Conferment Status
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($eradTblMain as $data) 
                    <tr class="border-b bg-white">
                        <td class="px-6 py-3">
                            {{ $data->acno ?? '' }} 
                        </td>

                        <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                            {{ $data->lastname ?? '' }},
                            {{ $data->firstname ?? '' }},
                            {{ $data->middlename ?? '' }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $data->c_status ?? '' }} 
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="m-5">
        {{ 
            $eradTblMain->links() 
        }}
    </div>
@endsection