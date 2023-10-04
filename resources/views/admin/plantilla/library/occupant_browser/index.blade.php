@extends('layouts.app')
@section('title', 'Appointee Occupant Browser')
@section('content')

<div class="lg:flex lg:justify-between my-3">
    <a href="#" class="text-blue-500 uppercase text-2xl">
        @yield('title')
    </a>
    <div class="flex">
        <a href="{{ route('library-occupant-browser.trash') }}">
            <lord-icon src="https://cdn.lordicon.com/jmkrnisz.json" trigger="hover" colors="primary:#DC3545"
                style="width:34px;height:34px">
            </lord-icon>
        </a>

        <a class="btn btn-primary" href="{{ route('library-occupant-browser.create') }}">Add record</a>
    </div>
</div>


<table class="dataTables">
    <thead>
        <tr>
            <th>CESNO</th>
            <th>Officials Name</th>
            <th>Appointee</th>
            <th>Appointment</th>
            <th>CES Status</th>
            <th>Appointment Date</th>
            <th>Assumption Date</th>

            <th>
                <span class="sr-only">Action</span>
            </th>
        </tr>
    </thead>
    <tbody>

        @foreach ($datas as $data)
        <tr>
            <td class="font-semibold">
                {{ $data->cesno }}
            </td>
            <td>
                {{ $data->personalData->lastname }}
                {{ $data->personalData->firstname }}
                {{ $data->personalData->name_extension }}
                {{ $data->personalData->middlename }}
            </td>
            <td>
                <span class="{{ $data->is_appointee == 1 ? 'success' : 'danger'}}">
                    {{ $data->is_appointee == 1 ? 'YES' : 'NO'}}
                </span>
            </td>
            <td>
                {{ $data->apptStatus->title }}
            </td>
            <td>
                {{ $data->personalData->cesStatus->description ?? 'N/A'}}
            </td>
            <td>
                {{ \Carbon\Carbon::parse($data->appt_date)->format('m/d/Y') }}
            </td>
            <td>
                {{ \Carbon\Carbon::parse($data->assum_date)->format('m/d/Y') }}
            </td>

            <td class="text-right uppercase">
                <div class="flex justify-end">

                    <a class="hover:bg-slate-100 rounded-full"
                        href="{{ route('library-occupant-browser.edit', $data->appointee_id) }}">
                        <lord-icon src="https://cdn.lordicon.com/hbvgknxo.json" trigger="hover"
                            colors="primary:#ebe6ef,secondary:#4bb3fd,tertiary:#3a3347" style="width:24px;height:24px">
                        </lord-icon>
                    </a>

                    <form class="hover:bg-slate-100 rounded-full"
                        action="{{ route('library-occupant-browser.destroy', $data->appointee_id) }}" method="POST"
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