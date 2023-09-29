@extends('layouts.app')
@section('title', 'In Depth Validation')
@section('sub', 'In Depth Validation Trash Bin')
@section('content')
@include('admin.eris.header', ['acno'=>$acno])

    <div class="my-5 flex justify-end"> 
        <a href="{{ route('eris-in-depth-validation.index', ['acno'=>$acno]) }}" class="btn btn-primary" >Go Back</a>
    </div>

    <div class="table-management-inDepthValidations relative overflow-x-auto sm:rounded-lg shadow-lg">
        <table class="w-full text-left text-sm text-gray-500">
            <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        In Depth Validation Date
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Submittion of Document
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Validator
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Recommendation
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Remarks
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Deffered Date
                    </th>

                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Action</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inDepthValidationTrashedRecord as $inDepthValidationTrashedRecords) 
                    <tr class="border-b bg-white">
                        <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                            {{ $inDepthValidationTrashedRecords->dteassign }} 
                        </td>

                        <td class="px-6 py-3">
                            {{ $inDepthValidationTrashedRecords->dtesubmit }} 
                        </td>

                        <td class="px-6 py-3">
                            {{ $inDepthValidationTrashedRecords->validator }} 
                        </td>

                        <td class="px-6 py-3">
                            {{ $inDepthValidationTrashedRecords->recom }} 
                        </td>

                        <td class="px-6 py-3">
                            {{ $inDepthValidationTrashedRecords->remarks }} 
                        </td>

                        <td class="px-6 py-3">
                            {{ $inDepthValidationTrashedRecords->dtedefer }} 
                        </td>

                        <td class="px-6 py-4 text-right uppercase">
                            <div class="flex">
                                <form action="{{ route('eris-in-depth-validation.restore', ['ctrlno'=>$inDepthValidationTrashedRecords->ctrlno]) }}" method="POST" id="restore_in_depth_validation_form{{$inDepthValidationTrashedRecords->ctrlno}}">
                                    @csrf
                                    <button type="button" id="restoreInDepthValidationButton{{$inDepthValidationTrashedRecords->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Restoration', 'Are you sure you want to restore this info?')">
                                        <lord-icon
                                            src="https://cdn.lordicon.com/nxooksci.json"
                                            trigger="hover"
                                            colors="primary:#121331"
                                            style="width:24px;height:24px">
                                        </lord-icon>
                                    </button>
                                </form>
    
                                <form action="{{ route('eris-in-depth-validation.forceDelete', ['ctrlno'=>$inDepthValidationTrashedRecords->ctrlno]) }}" method="POST" id="permanent_in_depth_validation_form{{$inDepthValidationTrashedRecords->ctrlno}}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" id="permanentInDepthValidationButton{{$inDepthValidationTrashedRecords->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Permanent Deletion', 'Are you sure you want to permanently delete this info?')">
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
        {{ $inDepthValidationTrashedRecord->links() }}
    </div>

@endsection