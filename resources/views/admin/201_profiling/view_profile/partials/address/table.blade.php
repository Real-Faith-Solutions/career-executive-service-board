@extends('layouts.app')
@section('title', 'Personal Address')
@section('sub', 'Personal Address')
@section('content')
@include('admin.201_profiling.view_profile.header', ['cesno' => $cesno])
<div class="my-5 flex justify-end">
    <button class="btn btn-primary" onclick="openFormAddress()">Add/Edit Address</button>
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

            @if (count($addressProfile) > 0)
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
                            <div class="flex">
                                <form action="{{ route('personal-data-address.delete', ['ctrlno'=>$data->ctrlno]) }}" method="POST" id="delete_address_form{{$data->ctrlno}}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" id="deleteAddressButton{{$data->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Deletion', 'Are you sure you want to delete this info?')">
                                        <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
                                        <lord-icon
                                            src="https://cdn.lordicon.com/jmkrnisz.json"
                                            trigger="hover"
                                            colors="primary:#880808"
                                            style="width:24px;height:24px">
                                        </lord-icon>
                                    </button>
                                </form>
                            </div>
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
