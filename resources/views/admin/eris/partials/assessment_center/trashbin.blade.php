@extends('layouts.app')
@section('title', 'Assessment Center')
@section('sub', 'Assessment Center Trash Bin')
@section('content')
@include('admin.eris.header', ['acno'=>$acno])

    <div class="my-5 flex justify-end">   
        <a href="{{ route('eris-assessment-center.index', ['acno'=>$acno]) }}" class="btn btn-primary" >Go Back</a>
    </div>

    <div class="table-management-assessmentCenters relative overflow-x-auto sm:rounded-lg shadow-lg">
        <table class="w-full text-left text-sm text-gray-500">
            <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Assessment Center Date
                    </th>

                    <th scope="col" class="px-6 py-3">
                        No. of Takes
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Submittion of Docs  
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
                @foreach ($assessmentCenterTrashedRecord as $assessmentCenterTrashedRecords) 
                    <tr class="border-b bg-white">
                        <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                            {{ \Carbon\Carbon::parse($assessmentCenterTrashedRecords->acdate)->format('m/d/Y') ?? 'No Record' }} 
                        </td>

                        <td class="px-6 py-3">
                            {{ $assessmentCenterTrashedRecords->numtakes ?? 'No Record' }} 
                        </td>

                        <td class="px-6 py-3">
                            {{ \Carbon\Carbon::parse($assessmentCenterTrashedRecords->docdate)->format('m/d/Y') ?? 'No Record' }} 
                        </td>

                        <td class="px-6 py-3">
                            {{ $assessmentCenterTrashedRecords->remarks ?? 'No Record' }} 
                        </td>

                        <td class="px-6 py-4 text-right uppercase">
                            <div class="flex">
                                <form action="{{ route('eris-assessment-center.restore', ['ctrlno'=>$assessmentCenterTrashedRecords->ctrlno]) }}" method="POST" id="restore_assessment_center_form{{$assessmentCenterTrashedRecords->ctrlno}}">
                                    @csrf
                                    <button type="button" id="restoreAssessmentCenterButton{{$assessmentCenterTrashedRecords->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Restoration', 'Are you sure you want to restore this info?')">
                                        <lord-icon
                                            src="https://cdn.lordicon.com/nxooksci.json"
                                            trigger="hover"
                                            colors="primary:#121331"
                                            style="width:24px;height:24px">
                                        </lord-icon>
                                    </button>
                                </form>
    
                                <form action="{{ route('eris-assessment-center.forceDelete', ['ctrlno'=>$assessmentCenterTrashedRecords->ctrlno]) }}" method="POST" id="permanent_assessment_center_form{{$assessmentCenterTrashedRecords->ctrlno}}">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="button" id="permanentAssessmentCenterButton{{$assessmentCenterTrashedRecords->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Permanent Deletion', 'Are you sure you want to permanently delete this info?')">
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
        {{ $assessmentCenterTrashedRecord->links() }}
    </div>

@endsection