@extends('layouts.app')
@section('title', 'Department / Agency Manager')
@section('sub', 'Department / Agency Manager')
@section('content')
@include('admin.plantilla.header')


<div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3 my-5">
    <div class="col-start-1">
        @include('components.search')
    </div>

    <div class="col-start-3 flex items-center justify-end">
        <a href="#">
            <lord-icon
                src="https://cdn.lordicon.com/jmkrnisz.json"
                trigger="hover"
                colors="primary:#DC3545"
                style="width:34px;height:34px">

            </lord-icon>
        </a>
        <a class="btn btn-primary" href="#">Add record</a>
    </div>
</div>

<div class="relative overflow-x-auto shadow-lg sm:rounded-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th class="px-6 py-3" scope="col">
                    Department ID
                </th>
                <th class="px-6 py-3" scope="col">
                    Mother Agency
                </th>
                <th class="px-6 py-3" scope="col">
                    Agency / Bureau
                </th>
                <th class="px-6 py-3" scope="col">
                    Agency / Bureau Acronym
                </th>
                <th class="px-6 py-3" scope="col">
                    Office type
                </th>
                <th class="px-6 py-3" scope="col">
                    Agency website
                </th>
                <th class="px-6 py-3" scope="col">
                    Last submission date
                </th>
                <th class="px-6 py-3" scope="col">
                    Submitted by
                </th>
                <th class="px-6 py-3" scope="col">
                    Remarks
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
                    {{ $data->deptid }}
                </td>
                <td class="px-6 py-3">
                    {{ $data->sectorManager->title }}
                </td>
                <td class="px-6 py-3">
                    {{ $data->title }}
                </td>
                <td class="px-6 py-3">
                    {{ $data->acronym }}
                </td>
                <td class="px-6 py-3">
                    {{ $data->agency_typeid }}
                </td>
                <td class="px-6 py-3">
                    {{ $data->website }}
                </td>

                <td class="px-6 py-3">
                    {{ $data->updated_at }}
                </td>
                <td class="px-6 py-3">
                    {{ $data->submitted_by }}
                </td>
                <td class="px-6 py-3">
                    {{ $data->remarks }}
                </td>



                <td class="px-6 py-4 text-right uppercase">
                    <div class="flex justify-end">
                        <a class="hover:bg-slate-100 rounded-full" href="#">
                                <lord-icon
                                    src="https://cdn.lordicon.com/bxxnzvfm.json"
                                    trigger="hover"
                                    colors="primary:#3a3347,secondary:#ffc738,tertiary:#f9c9c0,quaternary:#ebe6ef"
                                    style="width:24px;height:24px">
                                </lord-icon>
                        </a>
                        <form class="hover:bg-slate-100 rounded-full" action="#" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="mx-1 font-medium text-red-600 hover:underline">
                                <lord-icon
                                    src="https://cdn.lordicon.com/jmkrnisz.json"
                                    trigger="hover"
                                    colors="primary:#DC3545"
                                    style="width:24px;height:24px">
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
