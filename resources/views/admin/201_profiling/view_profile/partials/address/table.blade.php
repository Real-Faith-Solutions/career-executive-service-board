@extends('layouts.app')
@section('title', 'Identification Cards')
@section('sub', 'Identification Cards')
@section('content')
@include('admin.201_profiling.view_profile.header', ['cesno' => $cesno])
<div class="my-5 flex justify-end">
    <button class="btn btn-primary" onclick="openFormAddress()">Add Address</button>
    <button class="btn btn-primary hidden" onclick="openTableAddress()">Go back</button>
</div>

<div class="form-address hidden">
    @include('admin.201_profiling.view_profile.partials.address.form')
</div>

<div class="table-address relative overflow-x-auto shadow-lg sm:rounded-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th class="px-6 py-3" scope="col">
                    Type
                </th>
                <th class="px-6 py-3" scope="col">
                    Region
                </th>
                <th class="px-6 py-3" scope="col">
                    City/Municipality
                </th>
                <th class="px-6 py-3" scope="col">
                    Brgy.
                </th>
                <th class="px-6 py-3" scope="col">
                    Zip Code
                </th>
                {{-- <th class="px-6 py-3" scope="col">
                    Street/Lot/Bldg/Floor
                </th> --}}
                <th class="px-6 py-3" scope="col">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>

            @foreach ($addressProfile as $data)
                <tr class="border-b bg-white">
                    <td class="whitespace-nowrap px-6 py-4 font-medium text-gray-900" scope="row">
                        {{ $data->type }}
                    </td>
                    <td class="px-6 py-3">
                        {{ $data->region_name }}
                    </td>
                    <td class="px-6 py-3">
                        {{ $data->city_or_municipality_name }}
                    </td>
                    <td class="px-6 py-3">
                        {{ $data->brgy_name }}
                    </td>
                    <td class="px-6 py-3">
                        {{ $data->zip_code }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        {{-- <a class="mx-1 font-medium text-blue-600 hover:underline" href="#">Update</a> --}}
                        <a class="mx-1 font-medium text-red-600 hover:underline" href="#">
                            <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
                            <lord-icon
                                src="https://cdn.lordicon.com/jmkrnisz.json"
                                trigger="hover"
                                colors="primary:#880808"
                                style="width:24px;height:24px">
                            </lord-icon>
                        </a>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>
@endsection
