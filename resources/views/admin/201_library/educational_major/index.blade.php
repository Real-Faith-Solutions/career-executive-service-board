@extends('layouts.app')
@section('title', 'Educational Major - 201 Library')
@section('content')

<div class="my-5 flex justify-end gap-4">
    <a href="{{ route('educational-major.recently-deleted') }}">
        <lord-icon
            src="https://cdn.lordicon.com/jmkrnisz.json"
            trigger="hover"
            colors="primary:#DC3545"
            style="width:34px;height:34px">

        </lord-icon>
    </a>

    <a class="btn btn-primary" href="{{ route('educational-major.create') }}">Add Educational Major</a>
</div>

<div class="relative overflow-x-auto shadow-lg sm:rounded-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th class="px-6 py-3" scope="col">
                    Course
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
                        {{ $data->COURSE }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex justify-end">
                            <a class="hover:bg-slate-100 rounded-full" href="{{ route('educational-major.edit', $data->CODE) }}">
                                <lord-icon
                                    src="https://cdn.lordicon.com/bxxnzvfm.json"
                                    trigger="hover"
                                    colors="primary:#3a3347,secondary:#ffc738,tertiary:#f9c9c0,quaternary:#ebe6ef"
                                    style="width:24px;height:24px">
                                </lord-icon>
                            </a>

                            <form class="hover:bg-slate-100 rounded-full" action="{{ route('educational-major.destroy', $data->CODE) }}" method="POST" id="delete_educational_major_form{{$data->CODE}}">
                                @method('DELETE')
                                @csrf
                                <button type="button" id="deleteEducationalMajorButton{{$data->CODE}}" onclick="openConfirmationDialog(this, 'Confirm Deletion', 'Are you sure you want to delete this info?')">
                                    <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
                                    <lord-icon
                                        src="https://cdn.lordicon.com/jmkrnisz.json"
                                        trigger="hover"
                                        colors="primary:#880808"
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
</div>

<div class="m-5">
    {{ $datas->links() }}
</div>

@endsection
