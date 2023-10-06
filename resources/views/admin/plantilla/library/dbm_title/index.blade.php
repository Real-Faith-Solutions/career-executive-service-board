@extends('layouts.app')
@section('title', 'DBM Position Title')
@section('content')

<div class="lg:flex lg:justify-between my-3">
    <div>
        @include('components.search')
    </div>
    <a href="#" class="text-blue-500 uppercase text-2xl">
        @yield('title')
    </a>
    <div class="flex items-center">
        <a href="{{ route('library-dbm-position-title.trash') }}">
            <lord-icon src="https://cdn.lordicon.com/jmkrnisz.json" trigger="hover" colors="primary:#DC3545"
                style="width:34px;height:34px">
            </lord-icon>
        </a>

        <a class="btn btn-primary" href="{{ route('library-dbm-position-title.create') }}">Add record</a>
    </div>
</div>


<div class="relative overflow-x-auto shadow-lg sm:rounded-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th class="px-6 py-3" scope="col">POS CODE</th>
                <th class="px-6 py-3" scope="col">Position Level</th>
                <th class="px-6 py-3" scope="col">Title</th>
                <th class="px-6 py-3" scope="col">Salary Grade Level</th>
                <th class="px-6 py-3" scope="col">Func Title</th>
                <th class="px-6 py-3" scope="col">
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>
        <tbody>

            @foreach ($datas as $data)
            <tr>
                <td class="whitespace-nowrap px-6 py-4 font-medium text-gray-900" scope="row">
                    {{ $data->pos_code }}
                </td>
                <td class="px-6 py-3">
                    {{ $data->positionLevel->title }}
                </td>
                <td class="px-6 py-3">
                    {{ $data->dbm_title }}
                </td>
                <td class="px-6 py-3">
                    {{ $data->sg }}
                </td>
                <td class="px-6 py-3">
                    {{ $data->func_title }}
                </td>

                <td class="text-right uppercase">
                    <div class="flex justify-end">

                        <a class="hover:bg-slate-100 rounded-full"
                            href="{{ route('library-dbm-position-title.edit', $data->pos_code) }}">
                            <lord-icon src="https://cdn.lordicon.com/hbvgknxo.json" trigger="hover"
                                colors="primary:#ebe6ef,secondary:#4bb3fd,tertiary:#3a3347"
                                style="width:24px;height:24px">
                            </lord-icon>
                        </a>

                        <form class="hover:bg-slate-100 rounded-full"
                            action="{{ route('library-dbm-position-title.destroy', $data->pos_code) }}" method="POST"
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