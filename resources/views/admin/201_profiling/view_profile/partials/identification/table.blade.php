{{-- @extends('layouts.app')
@section('title', 'Identification Cards')
@section('sub', 'Identification Cards')
@section('content')
@include('admin.201_profiling.view_profile.header', ['cesno' => $cesno])

<div class="my-5 flex justify-end">
    <button class="btn btn-primary" onclick="openFormIdentification()">Add/Edit Identification Card</button>
    <button class="btn btn-primary hidden" onclick="openTableIdentification()">Go back</button>
</div>

<div class="form-identification hidden">
    @include('admin.201_profiling.view_profile.partials.identification.form')
</div>

<div class="table-identification relative overflow-x-auto sm:rounded-lg shadow-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th class="px-6 py-3" scope="col">
                    ID Type
                </th>

                <th class="px-6 py-3" scope="col">
                    ID Number
                </th>

            </tr>
        </thead>

        <tbody>
            <tr class="border-b bg-white">
                <td class="whitespace-nowrap px-6 py-4 font-medium text-gray-900" scope="row">GSIS</td>
                <td class="px-6 py-3">{{ $identification ? $identification->gsis : 'None' }}</td>
            </tr>
            <tr class="border-b bg-white">
                <td class="whitespace-nowrap px-6 py-4 font-medium text-gray-900" scope="row">PAG-IBIG</td>
                <td class="px-6 py-3">{{ $identification ? $identification->pagibig : 'None' }}</td>
            </tr>
            <tr class="border-b bg-white">
                <td class="whitespace-nowrap px-6 py-4 font-medium text-gray-900" scope="row">PHILHEALTH</td>
                <td class="px-6 py-3">{{ $identification ? $identification->philhealth : 'None' }}</td>
            </tr>
            <tr class="border-b bg-white">
                <td class="whitespace-nowrap px-6 py-4 font-medium text-gray-900" scope="row">SSS</td>
                <td class="px-6 py-3">{{ $identification ? $identification->sss_no : 'None' }}</td>
            </tr>
            <tr class="border-b bg-white">
                <td class="whitespace-nowrap px-6 py-4 font-medium text-gray-900" scope="row">TIN</td>
                <td class="px-6 py-3">{{ $identification ? $identification->tin : 'None' }}</td>
            </tr>

        </tbody>
    </table>
</div>

@endsection --}}
