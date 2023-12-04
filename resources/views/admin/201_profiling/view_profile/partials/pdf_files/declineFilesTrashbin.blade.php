@extends('layouts.app')
@section('title', 'Decline Files')
@section('sub', 'Decline Files')
@section('content')

<div class="flex justify-between mb-7">
    <a href="#" class="flex items-center">
        <span class="self-center text-2xl font-semibold whitespace-nowrap uppercase text-blue-500">@yield('sub')</span>
    </a>

    <a href="{{ route('show-pending-pdf-files.pendingFiles') }}" class="btn btn-primary">Go Back</a>
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
                    Decline Date
                </th>

                <th scope="col" class="px-6 py-3">
                    Declined By
                </th>

                <th scope="col" class="px-6 py-3">
                    Reason
                </th>

                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pendingFileTrashedRecord as $pendingFileTrashedRecords)
                <tr class="border-b bg-white">
                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        <form action="{{ route('downloadPendingFile', ['ctrlno'=>$pendingFileTrashedRecords->ctrlno, 'fileName'=>$pendingFileTrashedRecords->request_unique_file_name]) }}" target="_blank" method="POST">
                            @csrf
                            <button title="Download File" class="mx-1 font-medium text-blue-600 hover:underline" type="submit">
                                <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
                                <lord-icon
                                    src="https://cdn.lordicon.com/nocovwne.json"
                                    trigger="hover"
                                    colors="primary:#110a5c,secondary:#000000"
                                    state="hover-2"
                                    style="width:24px;height:24px">
                                </lord-icon>
                            </button>
                        </form>
                    </td>

                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        {{ $pendingFileTrashedRecords->request_unique_file_name }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $pendingFileTrashedRecords->created_at }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $pendingFileTrashedRecords->remarks }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $pendingFileTrashedRecords->deleted_at }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $pendingFileTrashedRecords->decline_by }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $pendingFileTrashedRecords->reason }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex">      
                            <form action="{{ route('decline-file.restore',['ctrlno' => $pendingFileTrashedRecords->ctrlno ]) }}" method="POST" id="restore_decline_file_form{{$pendingFileTrashedRecords->ctrlno}}">
                                @csrf
                                <button type="button" id="restoreDeclineFileButton{{$pendingFileTrashedRecords->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Restoration', 'Are you sure you want to restore this file?')">
                                    <lord-icon
                                        src="https://cdn.lordicon.com/nxooksci.json"
                                        trigger="hover"
                                        colors="primary:#121331"
                                        style="width:24px;height:24px">
                                    </lord-icon>
                                </button>
                            </form>

                            <form action="{{ route('show-pdf-files.declineFileForceDelete', ['ctrlno'=>$pendingFileTrashedRecords->ctrlno]) }}" method="POST" id="delete_decline_pending_pdf_file_form{{$pendingFileTrashedRecords->ctrlno}}">
                                @csrf
                                @method('DELETE')

                                <button title="Delete File Permanently" type="button" id="permanentDeleteDeclinePdfFileButton{{$pendingFileTrashedRecords->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Permanent Deletion', 'Are you sure you want to permanently delete this info?')">
                                    <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
                                    <lord-icon
                                        src="https://cdn.lordicon.com/nhfyhmlt.json"
                                        trigger="hover"
                                        colors="primary:#BC0001"
                                        state="hover-3"
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