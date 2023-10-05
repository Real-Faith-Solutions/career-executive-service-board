@extends('layouts.app')
@section('title', 'Other Assignment')
@section('content')

<div class="lg:flex lg:justify-between my-3">
    <a href="#" class="text-blue-500 uppercase text-2xl">
        @yield('title')
    </a>
    <div class="flex">
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


<table class="dataTables">
    <thead>
        <tr>
            <th>Detailed ID</th>
            <th>Status</th>
            <th>Position</th>
            <th>Office</th>
            <th>Remarks</th>
            <th>From - To</th>
            <th>Flr / Bldg</th>
            <th>Street</th>
            <th>Barangay</th>
            <th>City</th>
            <th>Contact number</th>
            <th>Email</th>
            <th>CESNO</th>

            <th>
                <span class="sr-only">Action</span>
            </th>
        </tr>
    </thead>
    <tbody>

        @foreach ($datas as $data)
        <tr>
            <td class="font-semibold">
                {{ $data->detailed_code }}
            </td>

            <td>{{ $data->apptStatus->title }}</td>
            <td>{{ $data->position }}</td>
            <td>{{ $data->office }}</td>
            <td>{{ $data->remarks }}</td>
            <td>
                {{ \Carbon\Carbon::parse($data->from_dt)->format('m/d/Y') }} -
                {{ \Carbon\Carbon::parse($data->to_dt)->format('m/d/Y') }}
            </td>
            <td>{{ $data->house_bldg }}</td>
            <td>{{ $data->st_road }}</td>
            <td>{{ $data->brgy_vill }}</td>
            <td>{{ $data->cities->name }}</td>
            <td>{{ $data->contactno }}</td>
            <td>{{ $data->email_addr }}</td>
            <td>{{ $data->cesno }}</td>

            <td class="text-right uppercase">
                <div class="flex justify-end">

                    <a class="hover:bg-slate-100 rounded-full"
                        href="{{ route('library-other-assignment.edit', ['library_occupant_manager' => $appointee->appointee_id,'detailed_code' => $data->detailed_code]) }}">
                        <lord-icon src="https://cdn.lordicon.com/hbvgknxo.json" trigger="hover"
                            colors="primary:#ebe6ef,secondary:#4bb3fd,tertiary:#3a3347" style="width:24px;height:24px">
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

@endsection