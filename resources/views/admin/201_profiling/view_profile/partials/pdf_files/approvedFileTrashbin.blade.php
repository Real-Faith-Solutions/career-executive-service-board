@extends('layouts.app')
@section('title', 'PDF File Recycle Bin')
@section('sub', 'PDF File Recycle Bin')
@section('content')
@include('admin.201_profiling.view_profile.header', ['cesno' => $cesno])

<div class="my-5 flex justify-end">
    <a href="{{ route('show-pdf-files.index', ['cesno'=>$cesno]) }}" class="btn btn-primary">Go Back</a>
</div>

<div class="relative overflow-x-auto sm:rounded-lg shadow-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">PDF Icon</span>
                </th>

                <th scope="col" class="px-6 py-3">
                    PDF File
                </th>

                <th scope="col" class="px-6 py-3">
                    Date Attached
                </th>

                <th scope="col" class="px-6 py-3">
                    Remarks
                </th>

                <th scope="col" class="px-6 py-3">
                    Encode By
                </th>

                <th scope="col" class="px-6 py-3">
                    Request Date
                </th>

                <th scope="col" class="px-6 py-3">
                    Request By
                </th>

                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pdfFileTrashedRecord as $pdfFileTrashedRecords)
                <tr class="border-b bg-white">
                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
                        <lord-icon
                            src="https://cdn.lordicon.com/nocovwne.json"
                            trigger="hover"
                            colors="primary:#110a5c,secondary:#000000"
                            state="hover-2"
                            style="width:24px;height:24px">
                        </lord-icon>
                    </td>

                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        {{ $pdfFileTrashedRecords->original_pdflink }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $pdfFileTrashedRecords->created_at }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $pdfFileTrashedRecords->remarks }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $pdfFileTrashedRecords->encoder }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $pdfFileTrashedRecords->request_date }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $pdfFileTrashedRecords->requested_by }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex">
                            <form action="{{ route('show-pdf-files.restore', ['ctrlno'=>$pdfFileTrashedRecords->ctrlno]) }}" method="POST" id="restore_approved_pdf_file_form{{$pdfFileTrashedRecords->ctrlno}}">
                                @csrf
                                <button title="Restore File" type="button" id="restoreApprovedPdfFileButton{{$pdfFileTrashedRecords->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Restoration', 'Are you sure you want to restore this info?')">
                                    <lord-icon
                                        src="https://cdn.lordicon.com/nxooksci.json"
                                        trigger="hover"
                                        colors="primary:#121331"
                                        style="width:24px;height:24px">
                                    </lord-icon>
                                </button>
                            </form>

                            <form action="{{ route('show-pdf-files.forceDelete', ['ctrlno'=>$pdfFileTrashedRecords->ctrlno]) }}" method="POST" id="permanent_approved_pdf_file_form{{$pdfFileTrashedRecords->ctrlno}}">
                                @csrf
                                @method('DELETE')
                                <button title="Delete File Permanently" type="button" id="permanentDeleteApprovedPdfFileButton{{$pdfFileTrashedRecords->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Permanent Deletion', 'Are you sure you want to permanently delete this info?')">
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