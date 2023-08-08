@extends('layouts.app')
@section('title', 'Pending Files')
@section('sub', 'Pending Files')
@section('content')

<div class="flex justify-between mb-7">
    <a href="#" class="flex items-center">
        <span class="self-center text-2xl font-semibold whitespace-nowrap uppercase text-blue-500">@yield('sub')</span>
    </a>

    <a href="{{ route('show-pdf-files.recentlyDeclineFiles') }}" class="btn btn-primary" >Declined Files</a>
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
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pdfFile as $pdfFiles)
                <tr class="border-b bg-white">
                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        <form action="{{ route('downloadPendingFile', ['ctrlno'=>$pdfFiles->ctrlno, 'fileName'=>$pdfFiles->request_unique_file_name]) }}" method="POST">
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
                        {{ $pdfFiles->request_unique_file_name }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $pdfFiles->created_at }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $pdfFiles->remarks }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $pdfFiles->encoder }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex">
                            <form action="{{ route('show-pdf-files.acceptedFiles', ['ctrlno'=>$pdfFiles->ctrlno, 'cesno'=>$pdfFiles->personal_data_cesno]) }}" method="POST" id="approve_pending_pdf_file_form{{$pdfFiles->ctrlno}}">
                                @csrf
                                <button title="Approve File" type="button" id="ApprovePendingPdfFileButton{{$pdfFiles->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Approval', 'Are you sure you want to approve this pdf?')">
                                    <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
                                    <lord-icon
                                        src="https://cdn.lordicon.com/egiwmiit.json"
                                        trigger="morph"
                                        colors="primary:#3b82f6"
                                        state="hover"
                                        style="width:24px;height:24px">
                                    </lord-icon>
                                </button>
                            </form>
                            
                            <form action="{{ route('declineFile', ['ctrlno'=>$pdfFiles->ctrlno]) }}" method="POST" id="decline_pending_pdf_file_form{{$pdfFiles->ctrlno}}">
                                @csrf
                                <button title="Decline File" type="button" id="DeclinePendingPdfFileButton{{$pdfFiles->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Decline', 'Are you sure you want to decline this pdf?')" >
                                    <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
                                <lord-icon
                                    src="https://cdn.lordicon.com/nhfyhmlt.json"
                                    trigger="hover"
                                    colors="primary:#BC0001"u
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