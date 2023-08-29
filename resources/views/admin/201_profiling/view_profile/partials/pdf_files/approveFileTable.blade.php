@extends('layouts.app')
@section('title', 'Approved Files')
@section('sub', 'Approved Files')
@section('content')

<div class="flex justify-between mb-7">
    <a href="#" class="flex items-center">
        <span class="self-center text-2xl font-semibold whitespace-nowrap uppercase text-blue-500">@yield('sub')</span>
    </a>

    <a href="{{ route('show-pending-pdf-files.pendingFiles') }}" class="btn btn-primary" >Go Back</a>
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
                    Date Approved
                </th>

                <th scope="col" class="px-6 py-3">
                    Remarks
                </th>

                <th scope="col" class="px-6 py-3">
                    Approved By
                </th>

                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($approvedFile as $approvedFiles)
                <tr class="border-b bg-white">
                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        <form action="{{ route('streamApprovedFile', ['ctrlno'=>$approvedFiles->ctrlno, 'fileName'=>$approvedFiles->original_pdflink]) }}" target="_blank" method="POST">
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
                        {{ $approvedFiles->original_pdflink }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $approvedFiles->request_date }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $approvedFiles->created_at }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $approvedFiles->remarks }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $approvedFiles->encoder }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex">
                            {{-- <form action="{{ route('show-pdf-files.acceptedFiles', ['ctrlno'=>$pdfFiles->ctrlno, 'cesno'=>$pdfFiles->personal_data_cesno]) }}" method="POST" id="approve_pending_pdf_file_form{{$pdfFiles->ctrlno}}">
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
                            </form> --}}
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="m-5">
    {{ $approvedFile->links() }}
</div>

@endsection