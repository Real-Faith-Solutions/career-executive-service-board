@extends('layouts.app')
@section('title', 'PDF File')
@section('sub', 'PDF File')
@section('content')
@include('admin.201_profiling.view_profile.header', ['cesno' => $cesno])

<div class="my-5 flex justify-end">
    <a href="{{ route('show-pdf-files.recentlyDeleted', ['cesno'=>$cesno]) }}" title="Trash Bin">
        <lord-icon
            src="https://cdn.lordicon.com/jmkrnisz.json"
            trigger="hover"
            colors="primary:#DC3545"
            style="width:34px;height:34px">
      </lord-icon>
    </a>

    <a href="{{ route('show-pdf-files.create', ['cesno'=>$cesno]) }}" class="btn btn-primary">PDF File</a>
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
            @foreach ($approvedPdfFile as $approvedPdfFiles)
                <tr class="border-b bg-white">
                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                            @if($approvedPdfFiles->original_pdflink != null)
                                <form action="{{ route('downloadApprovedFile', ['ctrlno'=>$approvedPdfFiles->ctrlno, 'fileName'=>$approvedPdfFiles->original_pdflink]) }}" target="_blank" method="POST">
                            @else
                                <form action="{{ route('downloadApprovedFile', ['ctrlno'=>$approvedPdfFiles->ctrlno, 'fileName'=>$approvedPdfFiles->pdflink]) }}" target="_blank" method="POST">
                            @endif      
                            @csrf
                            <button title="View File" class="mx-1 font-medium text-blue-600 hover:underline" type="submit">
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
                        @if ($approvedPdfFiles->original_pdflink != null)
                            {{ $approvedPdfFiles->original_pdflink }}
                        @else
                            {{ $approvedPdfFiles->pdflink }}
                        @endif
                    </td>    

                    <td class="px-6 py-3">
                        {{ \Carbon\Carbon::parse($approvedPdfFiles->encdate)->format('m/d/Y') }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $approvedPdfFiles->remarks }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $approvedPdfFiles->encoder }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $approvedPdfFiles->request_date }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $approvedPdfFiles->requested_by }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex">
                            <form action="{{ route('show-pdf-files.destroy', ['ctrlno'=>$approvedPdfFiles->ctrlno]) }}" method="POST" id="delete_approved_pdf_file_form{{$approvedPdfFiles->ctrlno}}">
                                @csrf
                                @method('DELETE')
                                <button title="Delete File" type="button" id="deleteApprovedPdfFileButton{{$approvedPdfFiles->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Deletion', 'Are you sure you want to delete this info?')">
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