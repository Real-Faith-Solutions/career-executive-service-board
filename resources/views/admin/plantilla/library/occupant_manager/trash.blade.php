@extends('layouts.app')
@section('title', 'Appointee Occupant Manager - Trash')
@section('content')

<div class="my-5 flex justify-between gap-4">
    <a href="#" class="text-blue-500 uppercase text-2xl">
        @yield('title')
    </a>
    <a class="btn btn-primary" href="{{ route('library-occupant-manager.index') }}">Go back</a>
</div>

<div class="relative overflow-x-auto shadow-lg sm:rounded-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>

                <th class="px-6 py-3" scope="col">
                    CESNO
                </th>
                <th class="px-6 py-3" scope="col">
                    Officials Name
                </th>
                <th class="px-6 py-3" scope="col">
                    Appointee
                </th>
                <th class="px-6 py-3" scope="col">
                    Appointment
                </th>
                <th class="px-6 py-3" scope="col">
                    CES Status
                </th>
                <th class="px-6 py-3" scope="col">
                    Appointment Date
                </th>
                <th class="px-6 py-3" scope="col">
                    Assumption Date
                </th>
                <th class="px-6 py-3" scope="col">
                    Deleted at
                </th>
                <th class="px-6 py-3" scope="col">
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>
        <tbody>

            @foreach ($datas as $data)
            <tr class="border-b bg-white">
                <td class="whitespace-nowrap px-6 py-4 font-medium text-gray-900" scope="row">
                    {{ $data->cesno }}
                </td>
                <td class="px-6 py-3">
                    {{ $data->personalData->lastname ?? ''}},
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
                <td class="px-6 py-3">
                    {{ \Carbon\Carbon::parse($data->deleted_at)->format('m/d/Y \a\t g:iA') }}
                </td>

                <td class="px-6 py-4 text-right uppercase">
                    <div class="flex justify-end">
                        <form class="hover:bg-slate-100 rounded-full"
                            action="{{ route('library-occupant-manager.restore', $data->appointee_id) }}" method="POST"
                            onsubmit="return window.confirm('Are you sure you want to restore this item?')">
                            @csrf
                            <button type="submit" class="mx-1 font-medium text-red-600 hover:underline" title="Restore">
                                <lord-icon src="https://cdn.lordicon.com/nxooksci.json" trigger="hover"
                                    colors="primary:#121331" style="width:24px;height:24px">
                                </lord-icon>
                            </button>
                        </form>
                        <form class="hover:bg-slate-100 rounded-full"
                            action="{{ route('library-occupant-manager.forceDelete', $data->appointee_id) }}"
                            method="POST"
                            onsubmit="return window.confirm('Are you sure you want to delete this item permanently?')">

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

@endsection