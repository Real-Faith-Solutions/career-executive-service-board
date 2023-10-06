@extends('layouts.app')
@section('title', 'Other Assignment')
@section('content')

<div class="lg:flex lg:justify-between my-3">
    <div>
        @include('components.search')
    </div>
    <a href="#" class="text-blue-500 uppercase text-2xl">
        @yield('title')
    </a>
    <div class="flex items-center">
        <a
            href="{{ route('library-other-assignment.trash', ['library_occupant_manager' => $appointee->appointee_id]) }}">
            <lord-icon src="https://cdn.lordicon.com/jmkrnisz.json" trigger="hover" colors="primary:#DC3545"
                style="width:34px;height:34px">
            </lord-icon>
        </a>

        <div>
            <a class="btn btn-primary mx-1"
                href="{{ route('library-other-assignment.create', ['library_occupant_manager' => $appointee->appointee_id]) }}">
                Add Other Assignment
            </a>
            <a class="btn btn-primary"
                href="{{ route('library-occupant-manager.edit', ['library_occupant_manager' => $appointee->appointee_id]) }}">
                Go Back</a>
        </div>
    </div>
</div>


<div class="relative overflow-x-auto shadow-lg sm:rounded-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th class="px-6 py-3" scope="col">Detailed ID</th>
                <th class="px-6 py-3" scope="col">Status</th>
                <th class="px-6 py-3" scope="col">Position</th>
                <th class="px-6 py-3" scope="col">Office</th>
                <th class="px-6 py-3" scope="col">Remarks</th>
                <th class="px-6 py-3" scope="col">From - To</th>
                <th class="px-6 py-3" scope="col">Flr / Bldg</th>
                <th class="px-6 py-3" scope="col">Street</th>
                <th class="px-6 py-3" scope="col">Barangay</th>
                <th class="px-6 py-3" scope="col">City</th>
                <th class="px-6 py-3" scope="col">Contact number</th>
                <th class="px-6 py-3" scope="col">Email</th>
                <th class="px-6 py-3" scope="col">CESNO</th>

                <th class="px-6 py-3" scope="col">
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>
        <tbody>

            @foreach ($datas as $data)
            <tr>
                <td class="whitespace-nowrap px-6 py-4 font-medium text-gray-900" scope="row">
                    {{ $data->detailed_code }}
                </td>

                <td class="px-6 py-3">
                    {{ $data->apptStatus->title }}
                </td>
                <td class="px-6 py-3">
                    {{ $data->position }}
                </td>
                <td class="px-6 py-3">
                    {{ $data->office }}
                </td>
                <td class="px-6 py-3">
                    {{ $data->remarks }}
                </td>
                <td class="px-6 py-3">


                    {{ \Carbon\Carbon::parse($data->from_dt)->format('m/d/Y') }} -
                    {{ \Carbon\Carbon::parse($data->to_dt)->format('m/d/Y') }}
                </td>
                <td class="px-6 py-3">
                    {{ $data->house_bldg }}
                </td>
                <td class="px-6 py-3">
                    {{ $data->st_road }}
                </td>
                <td class="px-6 py-3">
                    {{ $data->brgy_vill }}
                </td>
                <td class="px-6 py-3">
                    {{ $data->cities->name }}
                </td>
                <td class="px-6 py-3">
                    {{ $data->contactno }}
                </td>
                <td class="px-6 py-3">
                    {{ $data->email_addr }}
                </td>
                <td class="px-6 py-3">
                    {{ $data->cesno }}
                </td>

                <td class="text-right uppercase">
                    <div class="flex justify-end">

                        <a class="hover:bg-slate-100 rounded-full"
                            href="{{ route('library-other-assignment.edit', ['library_occupant_manager' => $appointee->appointee_id,'detailed_code' => $data->detailed_code]) }}">
                            <lord-icon src="https://cdn.lordicon.com/hbvgknxo.json" trigger="hover"
                                colors="primary:#ebe6ef,secondary:#4bb3fd,tertiary:#3a3347"
                                style="width:24px;height:24px">
                            </lord-icon>
                        </a>

                        <form class="hover:bg-slate-100 rounded-full"
                            action="{{ route('library-other-assignment.destroy', $data->detailed_code) }}" method="POST"
                            onsubmit="return window.confirm('Are you sure you want to delete this item?')">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="mx-1 font-medium text-red-600 hover:underline">
                                <lord-icon src="https://cdn.lordicon.com/jmkrnisz.json" trigger="hover"
                                    colors="primary:#DC3545" style="width:24px;height:24px">
                                </lord-icon>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>

<div class="m-5">
    {{ $datas->links() }}
</div>

@endsection