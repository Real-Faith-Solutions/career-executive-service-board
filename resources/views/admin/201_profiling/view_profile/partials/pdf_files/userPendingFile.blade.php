@extends('layouts.app')
@section('title', '201 Pending File')
@section('sub', 'Pending File')
@section('content')
@include('admin.201_profiling.view_profile.header', ['cesno' => $cesno])

<div class="flex justify-end mb-7">
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
                        Request By
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
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="m-5">
        {{ $pdfFile->links() }}
    </div>

@endsection