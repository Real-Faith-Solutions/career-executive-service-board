@extends('layouts.app')
@section('title', 'Classification Basis Title')
@section('content')

<div class="lg:flex lg:justify-between my-3">
    <a href="#" class="text-blue-500 uppercase text-2xl">
        @yield('title')
    </a>
    <div class="flex">
        <a href="{{ route('library-class-basis.trash') }}">
            <lord-icon src="https://cdn.lordicon.com/jmkrnisz.json" trigger="hover" colors="primary:#DC3545"
                style="width:34px;height:34px">
            </lord-icon>
        </a>

        <a class="btn btn-primary" href="{{ route('library-class-basis.create') }}">Add record</a>
    </div>
</div>


<table class="dataTables">
    <thead>
        <tr>
            <th>Class Code</th>
            <th>Basis</th>
            <th>Title</th>
            <th>Class Date</th>
            <th>
                <span class="sr-only">Action</span>
            </th>
        </tr>
    </thead>
    <tbody>

        @foreach ($datas as $data)
        <tr>
            <td class="font-semibold">
                {{ $data->cbasis_code }}
            </td>
            <td>
                {{ $data->basis }}
            </td>
            <td>
                {{ $data->title }}
            </td>
            <td>
                {{ \Carbon\Carbon::parse($data->classdate)->format('m/d/Y') }}
            </td>

            <td class="text-right uppercase">
                <div class="flex justify-end">

                    <a class="hover:bg-slate-100 rounded-full"
                        href="{{ route('library-class-basis.edit', $data->cbasis_code) }}">
                        <lord-icon src="https://cdn.lordicon.com/hbvgknxo.json" trigger="hover"
                            colors="primary:#ebe6ef,secondary:#4bb3fd,tertiary:#3a3347" style="width:24px;height:24px">
                        </lord-icon>
                    </a>

                    <form class="hover:bg-slate-100 rounded-full"
                        action="{{ route('library-class-basis.destroy', $data->cbasis_code) }}" method="POST"
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