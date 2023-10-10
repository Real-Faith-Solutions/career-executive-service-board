@extends('layouts.app')
@section('title', 'Language Dialect')
@section('sub', 'Language Dialect Recycle Bin')
@section('content')
@include('admin.201_profiling.view_profile.header', ['cesno' => $cesno])

<div class="flex justify-end">
    <a href="{{ route('language.index', ['cesno'=>$cesno]) }}" class="btn btn-primary mb-7">Go Back</a>
</div>

<div class="table-language-dialect relative overflow-x-auto sm:rounded-lg shadow-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Language
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

            @foreach ($profileTblLanguagesTrashedRecord as $profileTblLanguagesTrashedRecords)
                <tr class="border-b bg-white">
                    <td class="px-6 py-3">
                       {{  $profileTblLanguagesTrashedRecords->languagePersonalData->title ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-3">
                        {{  $profileTblLanguagesTrashedRecords->deleted_at }}
                     </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex justify-end">
                            <form action="{{ route('language.restore', ['ctrlno'=>$profileTblLanguagesTrashedRecords->ctrlno]) }}" method="POST" id="restore_langauge_form{{$profileTblLanguagesTrashedRecords->ctrlno}}">
                                @csrf
                                <button type="button" id="restoreLanguageButton{{$profileTblLanguagesTrashedRecords->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Restoration', 'Are you sure you want to restore this info?')">
                                    <lord-icon
                                        src="https://cdn.lordicon.com/nxooksci.json"
                                        trigger="hover"
                                        colors="primary:#121331"
                                        style="width:24px;height:24px">
                                    </lord-icon>
                                </button>
                            </form>

                            <form action="{{ route('language.forceDelete', ['ctrlno'=>$profileTblLanguagesTrashedRecords->ctrlno]) }}" method="POST" id="permanent_language_form{{$profileTblLanguagesTrashedRecords->ctrlno}}">
                                @csrf
                                @method('DELETE')
                                <button type="button" id="permanentDeleteLanguageButton{{$profileTblLanguagesTrashedRecords->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Permanent Deletion', 'Are you sure you want to permanently delete this info?')">
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

<div class="my-5">
    {{ $profileTblLanguagesTrashedRecord->links() }}
</div>

@endsection
