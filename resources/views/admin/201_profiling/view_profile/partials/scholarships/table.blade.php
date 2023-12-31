@extends('layouts.app')
@section('title', 'Scholarship Taken')
@section('sub', 'Scholarship Taken')
@section('content')
@include('admin.201_profiling.view_profile.header', ['cesno' => $cesno])

<div class="my-5 flex justify-end">
    <a href="{{ route('scholarship.recycleBin', ['cesno'=>$cesno]) }}">
        <lord-icon
            src="https://cdn.lordicon.com/jmkrnisz.json"
            trigger="hover"
            colors="primary:#DC3545"
            style="width:34px;height:34px">
        </lord-icon>
    </a>

    <a href="{{ route('scholarship.create', ['cesno'=>$cesno]) }}" class="btn btn-primary">Add Scholarship</a>
</div>

<div class="table-scholarship relative overflow-x-auto sm:rounded-lg shadow-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Scholarship Type
                </th>

                <th scope="col" class="px-6 py-3">
                    Title
                </th>

                <th scope="col" class="px-6 py-3">
                    Sponsor
                </th>

                <th scope="col" class="px-6 py-3">
                    Inclusive Dates
                </th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>
        <tbody>

            @foreach ($scholarship as $scholarships)
                <tr class="border-b bg-white">
                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        {{ $scholarships->type ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $scholarships->title ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $scholarships->sponsor ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $scholarships->from_dt ?? 'No Record' }} -
                        {{  $scholarships->to_dt ?? 'No Record'  }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex">
                            <form action="{{ route('scholarship.edit', ['ctrlno'=>$scholarships->ctrlno, 'cesno'=>$cesno]) }}" method="GET">
                                @csrf
                                <button class="mx-1 font-medium text-blue-600 hover:underline" type="submit">
                                    <lord-icon
                                        src="https://cdn.lordicon.com/bxxnzvfm.json"
                                        trigger="hover"
                                        colors="primary:#3a3347,secondary:#ffc738,tertiary:#f9c9c0,quaternary:#ebe6ef"
                                        style="width:30px;height:30px">
                                    </lord-icon>
                                </button>
                            </form>
                        
                            <form action="{{ route('scholarship.destroy', ['ctrlno'=>$scholarships->ctrlno]) }}" method="POST" id="delete_scholarships_form{{$scholarships->ctrlno}}">
                                @csrf
                                @method('DELETE')
                                <button type="button" id="deleteScholarshipsTakenButton{{$scholarships->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Deletion', 'Are you sure you want to delete this info?')">
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

@endsection
