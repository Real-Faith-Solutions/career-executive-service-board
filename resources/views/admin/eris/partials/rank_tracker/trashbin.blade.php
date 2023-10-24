@extends('layouts.app')
@section('title', 'Rank Tracker')
@section('sub', 'Rank Tracker Trash Bin')
@section('content')
@include('admin.eris.header', ['acno'=>$acno])

    <div class="my-5 flex justify-end">
        <a href="{{ route('eris-rank-tracker.index', ['acno'=>$acno]) }}" class="btn btn-primary" >Go Back</a>
    </div>

    <div class="table-management-rankTrackers relative overflow-x-auto sm:rounded-lg shadow-lg">
        <table class="w-full text-left text-sm text-gray-500">
            <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Control No.
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Submit Date
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Description
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Remarks
                    </th>

                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Action</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rankTrackerTrashedRecord as $rankTrackerTrashedRecords) 
                    <tr class="border-b bg-white">
                        <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                            {{ $rankTrackerTrashedRecords->ctrlno ?? 'No Record' }} 
                        </td>

                        <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                            {{ \Carbon\Carbon::parse($rankTrackerTrashedRecords->submit_dt)->format('m/d/Y ') ?? 'No Record' }} 
                        </td>

                        <td class="px-6 py-3">
                            {{ $rankTrackerTrashedRecords->description ?? 'No Record' }} 
                        </td>

                        <td class="px-6 py-3">
                            {{ $rankTrackerTrashedRecords->remarks ?? 'No Record' }} 
                        </td>

                        <td class="px-6 py-4 text-right uppercase">
                            <div class="flex">
                                <form action="{{ route('eris-rank-tracker.restore', ['ctrlno'=>$rankTrackerTrashedRecords->ctrlno, 'cesno'=>$cesno]) }}" method="POST" id="restore_rank_tracker_form{{$rankTrackerTrashedRecords->ctrlno}}">
                                    @csrf
                                    <button type="button" id="restoreRankTrackerButton{{$rankTrackerTrashedRecords->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Restoration', 'Are you sure you want to restore this info?')">
                                        <lord-icon
                                            src="https://cdn.lordicon.com/nxooksci.json"
                                            trigger="hover"
                                            colors="primary:#121331"
                                            style="width:24px;height:24px">
                                        </lord-icon>
                                    </button>
                                </form>
    
                                <form action="{{ route('eris-rank-tracker.forceDelete', ['ctrlno'=>$rankTrackerTrashedRecords->ctrlno, 'cesno'=>$cesno]) }}" method="POST" id="permanent_rank_tracker_form{{$rankTrackerTrashedRecords->ctrlno}}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" id="permanentRankTrackerButton{{$rankTrackerTrashedRecords->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Permanent Deletion', 'Are you sure you want to permanently delete this info?')">
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
        {{ $rankTrackerTrashedRecord->links() }}
    </div>

@endsection