@extends('layouts.app')
@section('title', 'Title - 201 Library')
@section('content')

<div class="my-5 flex justify-end gap-4">
    <a href="{{ route('title.recently-deleted') }}">
        <lord-icon
            src="https://cdn.lordicon.com/jmkrnisz.json"
            trigger="hover"
            colors="primary:#DC3545"
            style="width:34px;height:34px">

        </lord-icon>
    </a>
    <a class="btn btn-primary" href="{{ route('title.create') }}">Add Title</a>
</div>

<div class="relative overflow-x-auto shadow-lg sm:rounded-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th class="px-6 py-3" scope="col">
                    No.
                </th>
                <th class="px-6 py-3" scope="col">
                    Name
                </th>
                <th class="px-6 py-3" scope="col">
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>
        <tbody>

            @php
                $i = 1;
            @endphp
            @foreach ($datas as $data)
                <tr class="border-b bg-white">
                    <td class="whitespace-nowrap px-6 py-4 font-medium text-gray-900" scope="row">
                        {{ $data->ctrlno }}
                    </td>
                    <td class="px-6 py-3">
                        {{ $data->name }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex justify-end">
                            <a class="hover:bg-slate-100 rounded-full" href="{{ route('title.edit', $data->ctrlno) }}">
                                    <lord-icon
                                        src="https://cdn.lordicon.com/bxxnzvfm.json"
                                        trigger="hover"
                                        colors="primary:#3a3347,secondary:#ffc738,tertiary:#f9c9c0,quaternary:#ebe6ef"
                                        style="width:24px;height:24px">
                                    </lord-icon>
                            </a>
                            <form class="hover:bg-slate-100 rounded-full" action="{{ route('title.destroy', $data->ctrlno) }}" method="POST">
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
