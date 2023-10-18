@extends('layouts.app')
@section('title', 'Panel Board Interview')
@section('sub', 'Panel Board Interview Trash Bin')
@section('content')
@include('admin.eris.header', ['acno'=>$acno])

    <div class="my-5 flex justify-end">
        <a href="{{ route('panel-board-interview.index', ['acno'=>$acno]) }}" class="btn btn-primary" >Go Back</a>
    </div>

    <div class="table-management-panelBoardInterviews relative overflow-x-auto sm:rounded-lg shadow-lg">
        <table class="w-full text-left text-sm text-gray-500">
            <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Assigned Date
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Submittion of Document
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Interviewer
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Interview Date
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Recommendation
                    </th>

                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Action</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($panelBoardInterviewTrashedRecord as $panelBoardInterviewTrashedRecords) 
                    <tr class="border-b bg-white">
                        <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                            {{ \Carbon\Carbon::parse($panelBoardInterviewTrashedRecords->dteassign)->format('m/d/Y ') ?? 'No Record' }} 
                        </td>

                        <td class="px-6 py-3">
                            {{ \Carbon\Carbon::parse($panelBoardInterviewTrashedRecords->dtesubmit)->format('m/d/Y ') ?? 'No Record' }} 
                        </td>

                        <td class="px-6 py-3">
                            {{ $panelBoardInterviewTrashedRecords->intrviewer ?? 'No Record' }} 
                        </td>

                        <td class="px-6 py-3">
                            {{ \Carbon\Carbon::parse($panelBoardInterviewTrashedRecords->dteiview)->format('m/d/Y ') ?? 'No Record' }} 
                        </td>

                        <td class="px-6 py-3">
                            {{ $panelBoardInterviewTrashedRecords->recom ?? 'No Record' }} 
                        </td>

                        <td class="px-6 py-4 text-right uppercase">
                            <div class="flex">
                                <form action="{{ route('panel-board-interview.restore', ['ctrlno'=>$panelBoardInterviewTrashedRecords->ctrlno]) }}" method="POST" id="restore_panel_board_interview_form{{$panelBoardInterviewTrashedRecords->ctrlno}}">
                                    @csrf
                                    <button type="button" id="restorePanelBoardInterviewButton{{$panelBoardInterviewTrashedRecords->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Restoration', 'Are you sure you want to restore this info?')">
                                        <lord-icon
                                            src="https://cdn.lordicon.com/nxooksci.json"
                                            trigger="hover"
                                            colors="primary:#121331"
                                            style="width:24px;height:24px">
                                        </lord-icon>
                                    </button>
                                </form>
    
                                <form action="{{ route('panel-board-interview.forceDelete', ['ctrlno'=>$panelBoardInterviewTrashedRecords->ctrlno]) }}" method="POST" id="permanent_panel_board_interview_form{{$panelBoardInterviewTrashedRecords->ctrlno}}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" id="permanentPanelBoardInterviewButton{{$panelBoardInterviewTrashedRecords->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Permanent Deletion', 'Are you sure you want to permanently delete this info?')">
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
        {{ $panelBoardInterviewTrashedRecord->links() }}
    </div>

@endsection