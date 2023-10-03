@extends('layouts.app')
@section('title', 'Case Records')
@section('sub', 'Case Records')
@section('content')
@include('admin.201_profiling.view_profile.header', ['cesno' => $cesno])

<div class="my-5 flex justify-end">
    <a href="{{ route('case-record.recentlyDeleted', ['cesno'=>$cesno]) }}">
        <lord-icon
            src="https://cdn.lordicon.com/jmkrnisz.json"
            trigger="hover"
            colors="primary:#DC3545"
            style="width:34px;height:34px">
      </lord-icon>
    </a>

    <a href="{{ route('case-record.create', ['cesno'=>$cesno]) }}" class="btn btn-primary" >Add Case Record/s</a>
</div>

<div class="table-case-record relative overflow-x-auto sm:rounded-lg shadow-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Parties
                </th>

                <th scope="col" class="px-6 py-3">
                    Offense
                </th>

                <th scope="col" class="px-6 py-3">
                    Nature of Ofense
                </th>

                <th scope="col" class="px-6 py-3">
                    Case Number
                </th>

                <th scope="col" class="px-6 py-3">
                    Date Filed
                </th>

                <th scope="col" class="px-6 py-3">
                    Venue
                </th>

                <th scope="col" class="px-6 py-3">
                    Case Status
                </th>

                <th scope="col" class="px-6 py-3">
                    Date of Finality
                </th>

                <th scope="col" class="px-6 py-3">
                    Decision
                </th>

                <th scope="col" class="px-6 py-3">
                    Remarks
                </th>

                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($caseRecord as $caseRecords)
                <tr class="border-b bg-white">
                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        {{ $caseRecords->parties }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $caseRecords->offence }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $caseRecords->nature_code }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $caseRecords->case_no }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $caseRecords->filed_dt }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $caseRecords->venue }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $caseRecords->status_code }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $caseRecords->finality }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $caseRecords->decision }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $caseRecords->remarks }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex">
                            <form action="{{ route('case-record.edit', ['ctrlno'=>$caseRecords->ctrlno, 'cesno'=>$cesno]) }}" method="GET">
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

                            <form action="{{ route('case-record.destroy', ['ctrlno'=>$caseRecords->ctrlno]) }}" method="POST" id="delete_case_record_form{{$caseRecords->ctrlno}}">
                                @csrf
                                @method('DELETE')
                                <button type="button" id="deleteCaseRecordButton{{$caseRecords->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Deletion', 'Are you sure you want to delete this info?')">
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