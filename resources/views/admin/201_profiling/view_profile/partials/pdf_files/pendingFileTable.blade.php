@extends('layouts.app')
@section('title', 'Pending Files')
@section('sub', 'Pending Files')
@section('content')

<div class="flex justify-end mb-7">
    {{-- <a href="#" class="flex items-center ">
        <span class="self-center text-2xl font-semibold whitespace-nowrap uppercase text-blue-500">@yield('sub')</span>
    </a> --}}

    <a href="{{ route('show-approved-pdf-files.approvedFile') }}" class="btn btn-primary mr-5" >Approved Files</a>

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
                    Request By
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
                        <form action="{{ route('downloadPendingFile', ['ctrlno'=>$pdfFiles->ctrlno, 'fileName'=>$pdfFiles->request_unique_file_name]) }}" target="_blank" method="POST">
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
                            <button title="Approve File" type="button" id="ApprovePendingPdfFileButton{{$pdfFiles->ctrlno}}" onclick="openConfirmationDialogApprovePendingPdf(this, '{{ $pdfFiles->ctrlno }}', '{{ $pdfFiles->personal_data_cesno }}')">
                                <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
                                <lord-icon
                                    src="https://cdn.lordicon.com/egiwmiit.json"
                                    trigger="morph"
                                    colors="primary:#3b82f6"
                                    state="hover"
                                    style="width:24px;height:24px">
                                </lord-icon>
                            </button>
                            
                            <form action="{{ route('declineFile', ['ctrlno'=>$pdfFiles->ctrlno]) }}" method="POST" id="decline_pending_pdf_file_form{{$pdfFiles->ctrlno}}">
                                @csrf
                                @method('DELETE')
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

<!-- Modal for ApprovePendingPdfFile -->
<div id="approve-pending-pdf-modal"
class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
<div class="modal-content bg-white p-6 rounded-lg shadow-lg">
    <form id="approvePendingPdfForm" action="{{ route('show-pdf-files.acceptedFiles', ['ctrlno'=>$pdfFiles->ctrlno, 'cesno'=>$pdfFiles->personal_data_cesno]) }}"
        method="POST" class="flex flex-col items-center"
        onsubmit="return checkErrorsBeforeSubmit(approvePendingPdfForm)">
        @csrf

        <span class="close-md absolute top-2 right-2 text-gray-600 cursor-pointer">&times;</span>
        <h2 class="text-2xl font-bold mb-4 text-center">Approve PDF File</h2>

        <input type="hidden" id="approve_file_ctrlno" name="ctrlno">
        <input type="hidden" id="approve_file_personal_data_cesno" name="personal_data_cesno">

        <div class="sm:gid-cols-1 mb-2 grid gap-4 md:grid-cols-1 lg:grid-cols-1">

            <div class="mb-2">
                <input type="text" id="approve_file_reason" name="approve_file_reason"
                    oninput="validateInput(approve_file_reason, 4)"
                    onkeypress="validateInput(approve_file_reason, 4)"
                    onblur="checkErrorMessage(approve_file_reason)" required>
                <p class="input_error text-red-600"></p>
                @error('approve_file_reason')
                <span class="invalid" role="alert">
                    <p>{{ $message }}</p>
                </span>
                @enderror
            </div>

        </div>
        <button type="submit" id="approvePendingPdfBtn"
            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Approve</button>
    </form>
</div>
</div>
{{-- end --}}

@endsection