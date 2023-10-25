@extends('layouts.app')
@section('title', 'Case Status - 201 Library')
@section('content')

<div class="my-5 flex justify-end gap-4">
    <a href="">
        <lord-icon
            src="https://cdn.lordicon.com/jmkrnisz.json"
            trigger="hover"
            colors="primary:#DC3545"
            style="width:34px;height:34px">

        </lord-icon>
    </a>

    <a class="btn btn-primary" href="{{ route('case-status-library.create') }}">Add New Case Status</a>
</div>

<div class="relative overflow-x-auto shadow-lg sm:rounded-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th class="px-6 py-3" scope="col">
                    Description
                </th>

                <th class="px-6 py-3" scope="col">
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($profileLibTblCaseStatus as $profileLibTblCaseStatuses)
                <tr class="border-b bg-white">
                    <td class="whitespace-nowrap px-6 py-4 font-medium text-gray-900" scope="row">
                        {{ $profileLibTblCaseStatuses->TITLE }}
                    </td>
                    
                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex justify-end">
                            <form action="{{ route('case-status-library.edit', ['code'=>$profileLibTblCaseStatuses->STATUS_CODE]) }}" method="GET">
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

                            <form action="{{ route('case-status-library.destroy', ['code'=>$profileLibTblCaseStatuses->STATUS_CODE]) }}" method="POST" id="delete_case_nature_form{{$profileLibTblCaseStatuses->STATUS_CODE}}">
                                @csrf
                                @method('DELETE')
                                <button type="button" id="deleteCaseNatureButton{{$profileLibTblCaseStatuses->STATUS_CODE}}" onclick="openConfirmationDialog(this, 'Confirm Deletion', 'Are you sure you want to delete this info?')">
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
    {{ $profileLibTblCaseStatus->links() }}
</div>

@endsection
