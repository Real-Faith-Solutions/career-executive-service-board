@extends('layouts.app')
@section('title', 'Recently Deleted - CES Status - 201 Library')
@section('content')

<div class="my-5 flex justify-end gap-4">
    <a class="btn btn-primary" href="{{ route('ces-status-library.index') }}">Go back</a>
</div>

<div class="relative overflow-x-auto shadow-lg sm:rounded-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th class="px-6 py-3" scope="col">
                    CES Status
                </th>

                <th class="px-6 py-3" scope="col">
                    Deleted at
                </th>

                <th class="px-6 py-3" scope="col">
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($profileLibTblCesStatusTrashRecord as $profileLibTblCesStatusTrashRecords)
                <tr class="border-b bg-white">
                    <td class="whitespace-nowrap px-6 py-4 font-medium text-gray-900" scope="row">
                        {{ $profileLibTblCesStatusTrashRecords->description }}
                    </td>
                    <td class="px-6 py-3">
                        {{ $profileLibTblCesStatusTrashRecords->deleted_at }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex justify-end">
                            <form class="hover:bg-slate-100 rounded-full" action="{{ route('ces-status-library.restore', $profileLibTblCesStatusTrashRecords->code) }}" method="POST" id="restore_ces_status_form{{$profileLibTblCesStatusTrashRecords->code}}">
                                @csrf
                                <button type="button" id="restoreCesStatusButton{{$profileLibTblCesStatusTrashRecords->code}}" onclick="openConfirmationDialog(this, 'Confirm Restoration', 'Are you sure you want to restore this info?')">
                                    <lord-icon
                                        src="https://cdn.lordicon.com/nxooksci.json"
                                        trigger="hover"
                                        colors="primary:#121331"
                                        style="width:24px;height:24px">
                                    </lord-icon>
                                </button>
                            </form>

                            <form class="hover:bg-slate-100 rounded-full" action="{{ route('language-library.forceDelete', $profileLibTblCesStatusTrashRecords->code) }}" method="POST" id="permanent_language_library_form{{ $profileLibTblCesStatusTrashRecords->code}}">
                                @method('DELETE')
                                @csrf
                                <button type="button" id="permanentLanguageLibraryButton{{ $profileLibTblCesStatusTrashRecords->code}}" onclick="openConfirmationDialog(this, 'Confirm Permanent Deletion', 'Are you sure you want to permanently delete this info?')">
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

<div class="m-5">
    {{ $profileLibTblCesStatusTrashRecord->links() }}
</div>

@endsection
