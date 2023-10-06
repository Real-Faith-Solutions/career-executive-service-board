@extends('layouts.app')
@section('title', 'Appointee Occupant Browser')
@section('content')

<div class="my-3">

    <div class="flex justify-between">
        <div>
            @include('components.search')
        </div>
        <a href="#" class="text-blue-500 uppercase text-2xl">
            @yield('title')
        </a>

        <div></div>
    </div>

</div>


<div class="relative overflow-x-auto shadow-lg sm:rounded-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th class="px-6 py-3" scope="col">DBM Position Title</th>
                <th class="px-6 py-3" scope="col">Salary Grade</th>
                <th class="px-6 py-3" scope="col">DBM Item No</th>
                <th class="px-6 py-3" scope="col">Appointee</th>
                <th class="px-6 py-3" scope="col">Appointee Status</th>
                <th class="px-6 py-3" scope="col">Occupant</th>
                <th class="px-6 py-3" scope="col">Occupant Status</th>
                <th class="px-6 py-3" scope="col">Classification Basis</th>

                <th class="px-6 py-3" scope="col">
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>
        <tbody>

            @foreach ($datas as $data)
            <tr>
                <td class="whitespace-nowrap px-6 py-4 font-medium text-gray-900" scope="row">
                    {{ $data->planPosition->positionMasterLibrary->dbm_title }}
                </td>
                <td class="px-6 py-3">
                    {{ $data->planPosition->corp_sg }}
                </td>
                <td class="px-6 py-3">
                    {{ $data->planPosition->item_no }}
                </td>
                <td class="px-6 py-3">
                    @if ($data->is_appointee == 1)
                    {{ $data->personalData->lastname ?? ''}}
                    {{ $data->personalData->firstname ?? ''}}
                    {{ $data->personalData->name_extension ?? ''}}
                    {{ $data->personalData->middlename ?? ''}}
                    @else
                    None
                    @endif
                </td>
                <td class="px-6 py-3">
                    {{ $data->is_appointee == 1 ? $data->apptStatus->title : 'None'}}
                </td>
                <td class="px-6 py-3">
                    @if ($data->is_appointee !== 1)
                    {{ $data->personalData->lastname ?? ''}}
                    {{ $data->personalData->firstname ?? ''}}
                    {{ $data->personalData->name_extension ?? ''}}
                    {{ $data->personalData->middlename ?? ''}}
                    @else
                    None
                    @endif
                </td>

                <td class="px-6 py-3">
                    {{ $data->is_appointee !== 1 ? $data->apptStatus->title : 'None'}}
                </td>
                <td class="px-6 py-3">
                    {{ $data->basis }}
                </td>

                <td class="text-right uppercase">
                    <div class="flex justify-end">

                        <a class="hover:bg-slate-100 rounded-full"
                            href="{{ route('library-occupant-browser.edit', $data->appointee_id) }}">
                            <lord-icon src="https://cdn.lordicon.com/hbvgknxo.json" trigger="hover"
                                colors="primary:#ebe6ef,secondary:#4bb3fd,tertiary:#3a3347"
                                style="width:24px;height:24px">
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
</div>

<div class="m-5">
    {{ $datas->links() }}
</div>

@endsection