@extends('layouts.app')
@section('title', 'Appointee Occupant Browser')
@section('content')

<div class="my-3">
    <a href="#" class="text-blue-500 uppercase text-2xl">
        @yield('title')
    </a>
</div>


<table class="dataTables">
    <thead>
        <tr>
            <th>DBM Position Title</th>
            <th>Salary Grade</th>
            <th>DBM Item No</th>
            <th>Appointee</th>
            <th>Appointee Status</th>
            <th>Occupant</th>
            <th>Occupant Status</th>
            <th>Classification Basis</th>

            <th>
                <span class="sr-only">Action</span>
            </th>
        </tr>
    </thead>
    <tbody>

        @foreach ($datas as $data)
        <tr>
            <td class="font-semibold">
                {{ $data->planPosition->positionMasterLibrary->dbm_title }}
            </td>
            <td>
                {{ $data->planPosition->corp_sg }}
            </td>
            <td>
                {{ $data->planPosition->item_no }}
            </td>
            <td>
                @if ($data->is_appointee == 1)
                {{ $data->personalData->lastname }}
                {{ $data->personalData->firstname }}
                {{ $data->personalData->name_extension }}
                {{ $data->personalData->middlename }}
                @else
                None
                @endif
            </td>
            <td>
                {{ $data->is_appointee == 1 ? $data->apptStatus->title : 'None'}}
            </td>
            <td>
                @if ($data->is_appointee !== 1)
                {{ $data->personalData->lastname }}
                {{ $data->personalData->firstname }}
                {{ $data->personalData->name_extension }}
                {{ $data->personalData->middlename }}
                @else
                None
                @endif
            </td>

            <td>
                {{ $data->is_appointee !== 1 ? $data->apptStatus->title : 'None'}}
            </td>
            <td>
                {{ $data->basis }}
            </td>

            <td class="text-right uppercase">
                <div class="flex justify-end">

                    <a class="hover:bg-slate-100 rounded-full"
                        href="{{ route('library-occupant-browser.edit', $data->appointee_id) }}">
                        <lord-icon src="https://cdn.lordicon.com/hbvgknxo.json" trigger="hover"
                            colors="primary:#ebe6ef,secondary:#4bb3fd,tertiary:#3a3347" style="width:24px;height:24px">
                        </lord-icon>
                    </a>

                    {{-- <form class="hover:bg-slate-100 rounded-full"
                        action="{{ route('library-occupant-manager.destroy', $data->appointee_id) }}" method="POST"
                        onsubmit="return window.confirm('Are you sure you want to delete this item?')">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="mx-1 font-medium text-red-600 hover:underline">
                            <lord-icon src="https://cdn.lordicon.com/jmkrnisz.json" trigger="hover"
                                colors="primary:#DC3545" style="width:24px;height:24px">
                            </lord-icon>
                        </button>
                    </form> --}}
                </div>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>

@endsection