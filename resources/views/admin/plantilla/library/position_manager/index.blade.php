@extends('layouts.app')
@section('title', 'Position Manager')
@section('content')

<div class="lg:flex lg:justify-between my-3">
    <a href="#" class="text-blue-500 uppercase text-2xl">
        @yield('title')
    </a>
    <div class="flex">
        <a href="{{ route('library-position-manager.trash') }}">
            <lord-icon src="https://cdn.lordicon.com/jmkrnisz.json" trigger="hover" colors="primary:#DC3545"
                style="width:34px;height:34px">
            </lord-icon>
        </a>

        <a class="btn btn-primary" href="{{ route('library-position-manager.create') }}">Add record</a>
    </div>
</div>


<table class="dataTables">
    <thead>
        <tr>
            <th>Plantilla ID</th>
            <th>Position Title</th>
            <th>Position Level</th>
            <th>Salary Grade Level</th>
            <th>Item No.</th>
            <th>Vacant</th>
            <th>Pres Appointee</th>
            <th>
                <span class="sr-only">Action</span>
            </th>
        </tr>
    </thead>
    <tbody>

        @foreach ($datas as $data)
        <tr>
            <td class="font-semibold">
                {{ $data->plantilla_id }}
            </td>
            <td>
                {{ $data->positionMasterLibrary->dbm_title }}
            </td>

            <td>
                {{ $data->positionMasterLibrary->positionLevel->title }}
            </td>

            <td>
                {{ $data->corp_sg }}
            </td>

            <td>
                {{ $data->item_no }}
            </td>
            <td>
                <span class="{{ $data->is_vacant == 1 ? 'success' : 'danger'}}">
                    {{ $data->is_vacant == 1 ? 'YES' : 'NO'}}
                </span>
            </td>
            <td>
                <span class="{{ $data->pres_apptee == 1 ? 'success' : 'danger'}}">
                    {{ $data->pres_apptee == 1 ? 'YES' : 'NO'}}
                </span>
            </td>

            <td class="text-right uppercase">
                <div class="flex justify-end">

                    <a class="hover:bg-slate-100 rounded-full"
                        href="{{ route('library-position-manager.edit', $data->plantilla_id) }}">
                        <lord-icon src="https://cdn.lordicon.com/hbvgknxo.json" trigger="hover"
                            colors="primary:#ebe6ef,secondary:#4bb3fd,tertiary:#3a3347" style="width:24px;height:24px">
                        </lord-icon>
                    </a>

                    <form class="hover:bg-slate-100 rounded-full"
                        action="{{ route('library-position-manager.destroy', $data->plantilla_id) }}" method="POST"
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