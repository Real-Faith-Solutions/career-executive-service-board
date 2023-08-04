@extends('layouts.app')
@section('title', 'Case Records')
@section('sub', 'Case Records')
@section('content')
@include('admin.201_profiling.view_profile.header', ['cesno' => $cesno])

<div class="flex justify-end mb-7">
    <a href="{{ route('case-record.index', ['cesno'=>$cesno]) }}" class="btn btn-primary" >Go back</a>
</div>

<div class="table-case-record relative overflow-x-auto sm:rounded-lg shadow-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Control No
                </th>

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
                    Deleted At
                </th>

                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>
        <tbody>

            @foreach ($caseRecordTrashedRecord as $caseRecordTrashedRecords)
                <tr class="border-b bg-white">
                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        {{ $caseRecordTrashedRecords->ctrlno }}
                    </td>

                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        {{ $caseRecordTrashedRecords->parties }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $caseRecordTrashedRecords->offence }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $caseRecordTrashedRecords->nature_code }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $caseRecordTrashedRecords->case_no }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $caseRecordTrashedRecords->filed_date }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $caseRecordTrashedRecords->venue }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $caseRecordTrashedRecords->status_code }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $caseRecordTrashedRecords->finality }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $caseRecordTrashedRecords->decision }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $caseRecordTrashedRecords->remarks }}
                    </td>

                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        {{ $caseRecordTrashedRecords->deleted_at }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex">
                            <form action="{{ route('case-record.restore', ['ctrlno'=>$caseRecordTrashedRecords->ctrlno]) }}" method="POST">
                                @csrf
                                <button class="mx-1 font-medium text-blue-600 hover:underline" type="submit">
                                    <lord-icon
                                        src="https://cdn.lordicon.com/nxooksci.json"
                                        trigger="hover"
                                        colors="primary:#121331"
                                        style="width:24px;height:24px">
                                    </lord-icon>
                                </button>
                            </form>

                            <form action="{{ route('case-record.forceDelete', ['ctrlno'=>$caseRecordTrashedRecords->ctrlno]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="mx-1 font-medium text-red-600 hover:underline" type="submit">
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