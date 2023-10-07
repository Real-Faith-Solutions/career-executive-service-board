@extends('layouts.app')
@section('title', 'Appointee Occupant Manager')
@section('content')

<div class="lg:flex lg:justify-between my-3">
    <div>
        @include('components.search')
    </div>
    <a href="#" class="text-blue-500 uppercase text-2xl">
        @yield('title')
    </a>
    <div class="flex items-center">
        <a href="{{ route('library-occupant-manager.trash') }}">
            <lord-icon src="https://cdn.lordicon.com/jmkrnisz.json" trigger="hover" colors="primary:#DC3545"
                style="width:34px;height:34px">
            </lord-icon>
        </a>

        <a class="btn btn-primary" href="{{ route('library-occupant-manager.create') }}">Add record</a>
    </div>
</div>


<div class="relative overflow-x-auto shadow-lg sm:rounded-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th class="px-6 py-3" scope="col">CESNO</th>
                <th class="px-6 py-3" scope="col">Officials Name</th>
                <th class="px-6 py-3" scope="col">Appointee</th>
                <th class="px-6 py-3" scope="col">Personnel Movement</th>
                <th class="px-6 py-3" scope="col">CES Status</th>
                <th class="px-6 py-3" scope="col">Appointment Date</th>
                <th class="px-6 py-3" scope="col">Assumption Date</th>

                <th class="px-6 py-3" scope="col">
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>
        <tbody>

            @foreach ($datas as $data)
            <tr>
                <td class="whitespace-nowrap px-6 py-4 font-medium text-gray-900" scope="row">
                    {{ $data->cesno }}
                </td>
                <td class="px-6 py-3">
                    {{ $data->personalData->lastname ?? ''}}
                    {{ $data->personalData->firstname ?? ''}}
                    {{ $data->personalData->name_extension ?? ''}}
                    {{ $data->personalData->middlename ?? ''}}
                </td>
                <td class="px-6 py-3">
                    <span class="{{ $data->is_appointee == 1 ? 'success' : 'danger'}}">
                        {{ $data->is_appointee == 1 ? 'YES' : 'NO'}}
                    </span>
                </td>
                <td class="px-6 py-3">
                    {{ $data->apptStatus->title }}
                </td>
                <td class="px-6 py-3">
                    {{ $data->personalData->cesStatus->description ?? 'N/A'}}
                </td>
                <td class="px-6 py-3">
                    {{ \Carbon\Carbon::parse($data->appt_date)->format('m/d/Y') }}
                </td>
                <td class="px-6 py-3">
                    {{ \Carbon\Carbon::parse($data->assum_date)->format('m/d/Y') }}
                </td>

                <td class="text-right uppercase">
                    <div class="flex justify-end">

                        <a class="hover:bg-slate-100 rounded-full"
                            href="{{ route('library-occupant-manager.edit', $data->appointee_id) }}">
                            <lord-icon src="https://cdn.lordicon.com/hbvgknxo.json" trigger="hover"
                                colors="primary:#ebe6ef,secondary:#4bb3fd,tertiary:#3a3347"
                                style="width:24px;height:24px">
                            </lord-icon>
                        </a>

                        <form class="hover:bg-slate-100 rounded-full"
                            action="{{ route('library-occupant-manager.destroy', $data->appointee_id) }}" method="POST"
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