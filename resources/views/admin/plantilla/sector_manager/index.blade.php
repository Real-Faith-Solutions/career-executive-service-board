@extends('layouts.app')
@section('title', 'Sector Manager')
@section('sub', 'Sector Manager')
@section('content')
    @include('admin.plantilla.header')

    <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3 my-5">
        <div class="col-start-1">
            @include('components.search')
        </div>

        <div class="col-start-3 flex items-center justify-end">
            <a href="{{ route('sector-manager.recentlyDeleted') }}">
                <lord-icon src="https://cdn.lordicon.com/jmkrnisz.json" trigger="hover" colors="primary:#DC3545"
                    style="width:34px;height:34px">

                </lord-icon>
            </a>
            <a class="btn btn-primary" href="{{ route('sector-manager.create') }}">Add record</a>
        </div>
    </div>

    <div class="relative overflow-x-auto shadow-lg sm:rounded-lg">
        <table class="w-full text-left text-sm text-gray-500">
            <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
                <tr>
                    <th class="px-6 py-3" scope="col">
                        Sector ID
                    </th>
                    <th class="px-6 py-3" scope="col">
                        Sector Name
                    </th>
                    <th class="px-6 py-3" scope="col">
                        Description
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
                            {{ $data->sectorid }}
                        </td>
                        <td class="px-6 py-3">
                            {{ $data->title }}
                        </td>
                        <td class="px-6 py-3">
                            {{ $data->description }}
                        </td>

                        <td class="px-6 py-4 text-right uppercase">
                            <div class="flex justify-end">

                                <a class="hover:bg-slate-100 rounded-full"
                                    href="{{ route('sector-manager.edit', $data->sectorid) }}">
                                    <lord-icon src="https://cdn.lordicon.com/hbvgknxo.json" trigger="hover"
                                        colors="primary:#ebe6ef,secondary:#4bb3fd,tertiary:#3a3347"
                                        style="width:24px;height:24px">
                                    </lord-icon>
                                </a>

                                <form class="hover:bg-slate-100 rounded-full"
                                    action="{{ route('sector-manager.destroy', $data->sectorid) }}" method="POST">
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

        <div class="m-5">
            {{ $datas->links() }}
        </div>
    </div>

@endsection
