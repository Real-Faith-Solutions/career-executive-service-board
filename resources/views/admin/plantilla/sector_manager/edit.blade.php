@extends('layouts.app')
@section('title', 'Sector Manager')
@section('sub', 'Sector Manager')
@section('content')
    @include('admin.plantilla.header')



    <div class="grid lg:grid-cols-2">
        <div class="relative my-10 overflow-x-auto shadow-lg sm:rounded-lg">
            <div class="w-full text-left text-gray-500">
                <div class="bg-blue-500 uppercase text-gray-700 text-white">
                    <h1 class="px-6 py-3">
                        Sector Manager
                    </h1>
                </div>

                <div class="bg-white px-6 py-3">
                    <form action="{{ route('sector-manager.update', $datas->sectorid) }}" method="POST">
                        @csrf

                        <input type="hidden" name="encoder"
                            value="{{ Auth::user()->last_name }} {{ Auth::user()->first_name }} {{ Auth::user()->middle_name }}"
                            readonly>
                        <div class="sm:gid-cols-1 mb-3 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                            <div class="mb-3">
                                <label for="title">Sector name<sup>*</span></label>
                                <input id="title" name="title" type="text" value="{{ $datas->title }}" required>
                                @error('title')
                                    <span class="invalid" role="alert">
                                        <p>{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description">Description<sup>*</span></label>
                                <textarea name="description" id="description" placeholder="Write your thoughts here..." required>{{ $datas->description }}</textarea>
                                @error('description')
                                    <span class="invalid" role="alert">
                                        <p>{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="flex justify-between">
                            <h1 class="text-slate-400 text-sm font-semibold">
                                Created at {{ \Carbon\Carbon::parse($datas->created_at)->format('F d, Y \a\t h:iA') }}
                            </h1>
                            <button type="submit" class="btn btn-primary">
                                Save changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
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

                @foreach ($subDatas as $data)
                    <tr class="border-b bg-white">
                        <td class="whitespace-nowrap px-6 py-4 font-medium text-gray-900" scope="row">
                            {{ $data->deptid }}
                        </td>
                        <td class="px-6 py-3">
                            {{ $data->sectorManager->title ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-3">
                            {{ $data->title ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-3">
                            {{ $data->acronym ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-3">
                            {{ $data->departmentAgencyType->title ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-3">
                            <a href="{{ $data->website ?? 'N/A' }}" target="_blank"
                                class="hover:text-blue-500">{{ $data->website ?? 'N/A' }}</a>
                        </td>

                        <td class="px-6 py-3">
                            {{ \Carbon\Carbon::parse($data->updated_at )->format('m/d/Y \a\t h:iA') }}
                        </td>
                        <td class="px-6 py-3">
                            {{ $data->submitted_by ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-3">
                            {{ $data->remarks ?? 'N/A' }}
                        </td>



                        <td class="px-6 py-4 text-right uppercase">
                            <div class="flex justify-end">
                                <a class="hover:bg-slate-100 rounded-full" href="#">
                                    <lord-icon src="https://cdn.lordicon.com/hbvgknxo.json" trigger="hover"
                                        colors="primary:#ebe6ef,secondary:#4bb3fd,tertiary:#3a3347"
                                        style="width:24px;height:24px">
                                    </lord-icon>
                                </a>
                                <form class="hover:bg-slate-100 rounded-full" action="#" method="POST">
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
            {{ $subDatas->links() }}
        </div>
    </div>


@endsection
