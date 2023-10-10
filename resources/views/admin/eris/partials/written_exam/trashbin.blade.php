@extends('layouts.app')
@section('title', 'Written Exam')
@section('sub', 'Written Exam Trash Bin')
@section('content')
@include('admin.eris.header', ['acno'=>$acno])

<div class="my-5 flex justify-end">
    <a href="{{ route('eris-written-exam.index', ['acno'=>$acno]) }}" class="btn btn-primary" >Go Back</a>
</div>

<div class="table-management-writtenExams relative overflow-x-auto sm:rounded-lg shadow-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Written Exam Date
                </th>

                <th scope="col" class="px-6 py-3">
                    Location
                </th>

                <th scope="col" class="px-6 py-3">
                    Rating
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
            @foreach ($writtenExamTrashedRecord as $writtenExamTrashedRecords)
                <tr class="border-b bg-white">
                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        {{ $writtenExamTrashedRecords->we_date ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $writtenExamTrashedRecords->we_location ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $writtenExamTrashedRecords->we_rating ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $writtenExamTrashedRecords->we_remarks ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex">
                            <form action="{{ route('eris-written-exam.restore', ['ctrlno'=>$writtenExamTrashedRecords->ctrlno]) }}" method="POST" id="restore_written_exam_form{{$writtenExamTrashedRecords->ctrlno}}">
                                @csrf
                                <button type="button" id="restoreWrittenExamButton{{$writtenExamTrashedRecords->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Restoration', 'Are you sure you want to restore this info?')">
                                    <lord-icon
                                        src="https://cdn.lordicon.com/nxooksci.json"
                                        trigger="hover"
                                        colors="primary:#121331"
                                        style="width:24px;height:24px">
                                    </lord-icon>
                                </button>
                            </form>

                            <form action="{{ route('eris-written-exam.forceDelete', ['ctrlno'=>$writtenExamTrashedRecords->ctrlno]) }}" method="POST" id="permanent_written_exam_form{{$writtenExamTrashedRecords->ctrlno}}">
                                @csrf
                                @method('DELETE')
                                <button type="button" id="permanentWrittenExamButton{{$writtenExamTrashedRecords->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Permanent Deletion', 'Are you sure you want to permanently delete this info?')">
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