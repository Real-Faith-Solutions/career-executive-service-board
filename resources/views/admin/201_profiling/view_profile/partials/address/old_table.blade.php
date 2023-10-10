@extends('layouts.app')
@section('title', 'Personal Address')
@section('sub', 'Personal Address')
@section('content')
@include('admin.201_profiling.view_profile.header', ['cesno' => $cesno])

<div class="flex items-center justify-between">
    <p class="text-red-500">*Your address is outdated, please submit a new address.</p>
    <div class="my-5 flex">
        <button class="btn btn-primary" onclick="openFormAddress()">Add/Edit Address</button>
        <button class="btn btn-primary hidden" onclick="openTableAddress()">Go back</button>
    </div>
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
                    House/Building no.
                </th>
                <th class="px-6 py-3" scope="col">
                    Street
                </th>
                <th class="px-6 py-3" scope="col">
                    Brgy.
                </th>
                <th class="px-6 py-3" scope="col">
                    City
                </th>
            </tr>
        </thead>
        <tbody>

            @if (count($addressProfile) > 0)
                @foreach ($addressProfile as $data)
                    <tr class="border-b bg-white">
                        <td class="whitespace-nowrap px-6 py-4 font-medium text-gray-900" scope="row">
                            {{ $data->catid ?? '' }}
                        </td>
                        <td class="px-6 py-3">
                            {{ $data->house_bldg ?? '' }}
                        </td>
                        <td class="px-6 py-3">
                            {{ $data->st_road ?? '' }}
                        </td>
                        <td class="px-6 py-3">
                            {{ $data->brgy_vill ?? '' }}
                        </td>
                        <td class="px-6 py-3">
                            {{ $data->city_code ?? '' }}
                        </td>

                    </tr>
                @endforeach
            @else
                <tr class="border-b bg-white">
                    <td colspan="6" class="px-6 py-3 text-center bg-neutral-100">No Records</td>
                </tr>
            @endif
            

        </tbody>
    </table>
</div>
@endsection
