@extends('layouts.app')
@section('title', 'Rank Tracker')
@section('sub', 'Rank Tracker')
@section('content')
@include('admin.eris.header', ['acno'=>$acno])

    <div class="my-5 flex justify-end">
        <a href="{{ route('eris-rank-tracker.recentlyDeleted', ['acno'=>$acno]) }}">
            <lord-icon
                src="https://cdn.lordicon.com/jmkrnisz.json"
                trigger="hover"
                colors="primary:#DC3545"
                style="width:34px;height:34px">
            </lord-icon>
        </a>
        
        <a href="{{ route('eris-rank-tracker.create', ['acno'=>$acno]) }}" class="btn btn-primary" >Add New Rank Tracker</a>
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
                @foreach ($rankTracker as $rankTrackers) 
                    <tr class="border-b bg-white">
                        <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                            {{ $rankTrackers->ctrlno ?? 'No Record' }} 
                        </td>

                        <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                            {{ \Carbon\Carbon::parse($rankTrackers->submit_dt)->format('m/d/Y H:i:s.v') ?? 'No Record' }} 
                        </td>

                        <td class="px-6 py-3">
                            {{ $rankTrackers->description ?? 'No Record' }} 
                        </td>

                        <td class="px-6 py-3">
                            {{ $rankTrackers->remarks ?? 'No Record' }} 
                        </td>

                        <td class="px-6 py-4 text-right uppercase">
                            <div class="flex">
                                <form action="{{ route('eris-rank-tracker.edit', ['acno'=>$acno, 'ctrlno'=>$rankTrackers->ctrlno]) }}" method="GET">
                                    @csrf
                                    <button class="mx-1 font-medium text-blue-600 hover:underline" type="submit">
                                        <lord-icon
                                            src="https://cdn.lordicon.com/bxxnzvfm.json"
                                            trigger="hover"
                                            colors="primary:#3a3347,secondary:#ffc738,tertiary:#f9c9c0,quaternary:#ebe6ef"
                                            style="width:30px;height:30px">
                                        </lord-icon>
                                    </button>
                                </form>
                            
                                 <form action="{{ route('eris-rank-tracker.destroy', ['ctrlno'=>$rankTrackers->ctrlno]) }}" method="POST" id="delete_rank_tracker_form{{$rankTrackers->ctrlno}}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" id="deleteRankTrackerButton{{$rankTrackers->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Deletion', 'Are you sure you want to delete this info?')">
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
        {{ $rankTracker->links() }}
    </div>

@endsection