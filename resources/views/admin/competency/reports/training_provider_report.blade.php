@extends('layouts.app')
@section('title', 'Training Provider Manager Report')
@section('sub', 'Training Provider Manager')
@section('content')

<div class="my-5 flex justify-between">
    <h1 class="uppercase font-semibold text-blue-600 text-lg">Training Provider Manager Report</h1>

    <form action="{{ route('competency-management-sub-modules-report.trainingProviderGenerateReport') }}" target="_blank" method="POST">
        @csrf
        <button class="btn btn-primary mx-1 font-medium text-blue-600" type="submit">
            Generate PDF Report
        </button>
    </form>
</div>

<div class="table-management-training relative overflow-x-auto sm:rounded-lg shadow-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Provider
                </th>

                <th scope="col" class="px-6 py-3">
                    House Building
                </th>

                <th scope="col" class="px-6 py-3">
                    St. Road
                </th>

                <th scope="col" class="px-6 py-3">
                    Barangay/Village
                </th>

                <th scope="col" class="px-6 py-3">
                    City Code
                </th>

                <th scope="col" class="px-6 py-3">
                    Contact No.
                </th>

                <th scope="col" class="px-6 py-3">
                    Email
                </th>

                <th scope="col" class="px-6 py-3">
                    Contact Person
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($competencyTrainingProvider as $competencyTrainingProviders)
                <tr class="border-b bg-white">
                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        {{ $competencyTrainingProviders->provider }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $competencyTrainingProviders->house_bldg }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $competencyTrainingProviders->st_road }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $competencyTrainingProviders->brgy_vill }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $competencyTrainingProviders->trainingProviderManager->name }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $competencyTrainingProviders->contactno }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $competencyTrainingProviders->emailadd }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $competencyTrainingProviders->contactperson }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection