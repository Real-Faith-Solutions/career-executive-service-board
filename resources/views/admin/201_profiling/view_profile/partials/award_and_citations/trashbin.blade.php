@extends('layouts.app')
@section('title', 'Award and Citation Recycle Bin')
@section('sub', 'Award and Citation Recycle Bin')
@section('content')
@include('admin.201_profiling.view_profile.header', ['cesno' => $cesno])

<div class="flex justify-end mb-7">
    <a href="{{ route('award-citation.index', ['cesno' => $cesno]) }}" class="btn btn-primary" >Go back</a>
</div>

<div class="table-award-and-citation relative overflow-x-auto sm:rounded-lg shadow-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Title of Award
                </th>

                <th scope="col" class="px-6 py-3">
                    Sponsor
                </th>

                <th scope="col" class="px-6 py-3">
                    Date
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

            @foreach ($awardAndCitationsTrashedRecord as $awardAndCitationsTrashedRecords)
                <tr class="border-b bg-white">
                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        {{ $awardAndCitationsTrashedRecords->awards ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $awardAndCitationsTrashedRecords->sponsor ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-3">
                        {{ \Carbon\Carbon::parse($awardAndCitationsTrashedRecords->award_dt)->format('m/d/Y') ?? 'No Record' }}
                    </td>

                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        {{ $awardAndCitationsTrashedRecords->deleted_at ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex">
                            <form action="{{ route('award-citation.restore', ['ctrlno'=>$awardAndCitationsTrashedRecords->ctrlno]) }}" method="POST" id="restore_award_citation_form{{$awardAndCitationsTrashedRecords->ctrlno}}">
                                @csrf
                                <button type="button" id="restoreAwardAndCitationButton{{$awardAndCitationsTrashedRecords->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Restoration', 'Are you sure you want to restore this info?')">
                                    <lord-icon
                                        src="https://cdn.lordicon.com/nxooksci.json"
                                        trigger="hover"
                                        colors="primary:#121331"
                                        style="width:24px;height:24px">
                                    </lord-icon>
                                </button>
                            </form>
                        
                            <form action="{{ route('award-citation.forceDelete', ['ctrlno'=>$awardAndCitationsTrashedRecords->ctrlno]) }}" method="POST" id="permanent_award_citation_form{{$awardAndCitationsTrashedRecords->ctrlno}}">
                                @csrf
                                @method('DELETE')
                                <button type="button" id="permanentDeleteAwardAndCitationButton{{$awardAndCitationsTrashedRecords->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Permanent Deletion', 'Are you sure you want to permanently delete this info?')">
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