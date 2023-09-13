@extends('layouts.app')
@section('title', 'Sector Manager')
@section('sub', 'Sector Manager')
@section('content')
@include('admin.plantilla.header')
<nav class="flex" aria-label="Breadcrumb">
    <ol class="flex items-center space-x-2">
        <li>
            <a href="{{ route('sector-manager.index') }}" class="text-slate-500">Plantilla</a>
        </li>
        <li>
            <svg class="flex-shrink-0 w-5 h-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </li>
        <li>
            <a href="#" class="text-blue-500">Sector Manager</a>
        </li>

    </ol>
</nav>

<div class="lg:flex lg:justify-end my-3">

    <div class="my-3 sm:flex sm:justify-end">
        <div class="flex">
            <a href="{{ route('sector-manager.recentlyDeleted') }}">
                <lord-icon src="https://cdn.lordicon.com/jmkrnisz.json" trigger="hover" colors="primary:#DC3545"
                    style="width:34px;height:34px">

                </lord-icon>
            </a>

            <a class="btn btn-primary" href="{{ route('sector-manager.create') }}">Add record</a>
        </div>
    </div>
</div>


<table class="dataTables">
    <thead>
        <tr>
            <th>Sector ID</th>
            <th>Sector Name</th>
            <th>Description</th>

            <th>
                <span class="sr-only">Action</span>
            </th>
        </tr>
    </thead>
    <tbody>

        @foreach ($datas as $data)
        <tr>
            <td class="font-semibold">
                {{ $data->sectorid }}
            </td>
            <td>
                {{ $data->title }}
            </td>
            <td>
                {{ $data->description }}
            </td>

            <td class="text-right uppercase">
                <div class="flex justify-end">

                    <a class="hover:bg-slate-100 rounded-full"
                        href="{{ route('sector-manager.edit', $data->sectorid) }}">
                        <lord-icon src="https://cdn.lordicon.com/hbvgknxo.json" trigger="hover"
                            colors="primary:#ebe6ef,secondary:#4bb3fd,tertiary:#3a3347" style="width:24px;height:24px">
                        </lord-icon>
                    </a>

                    <form class="hover:bg-slate-100 rounded-full"
                        action="{{ route('sector-manager.destroy', $data->sectorid) }}" method="POST"
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