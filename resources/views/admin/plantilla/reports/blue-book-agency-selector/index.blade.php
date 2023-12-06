
@extends('layouts.app')
@section('content')
@section('title', 'Add Department For Bluebook Selector')

<h1 class="text-center text-2xl font-semibold whitespace-nowrap uppercase text-blue-500 mb-5">
    Add Department For Bluebook Selector
</h1>

<div class="flex justify-end mb-3">
    @include('admin.plantilla.reports.blue-book-agency-selector.create')
</div>
<div class="relative shadow-lg sm:rounded-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th class="px-6 py-3" scope="col">NATIONAL GOVERNMENT AGENCIES</th>
                <th class="sr-only" scope="col">Action</th>
            </tr>

        </thead>
        <tbody>

            @foreach ($motherDepartmentAgency as $data)
            <tr>

                <td class="whitespace-nowrap px-6 py-4 font-medium text-gray-900" scope="row">
                    <a class="text-sm leading-5 text-gray-900 hover:text-blue-500" href="#">
                        {{ $data->title }}
                    </a>
                </td>
                <td class="px-6 py-4 font-medium" scope="row">

                    <form action="{{ route('blue-book-selector.setAsNotNational',  $data->deptid ) }}" class="flex justify-end" method="post">
                        @csrf
                        <button type="submit" class="btn btn-danger" onclick="return window.confirm('Are you sure you want to remove?')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </form>


                </td>

            </tr>
            @endforeach

        </tbody>
    </table>
</div>

@endsection
