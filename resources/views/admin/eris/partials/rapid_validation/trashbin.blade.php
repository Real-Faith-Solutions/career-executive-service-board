@extends('layouts.app')
@section('title', 'Rapid Validation')
@section('sub', 'Rapid Validation Trash Bin')
@section('content')
@include('admin.eris.header', ['acno'=>$acno])

    <div class="my-5 flex justify-end">
        <a href="{{ route('eris-rapid-validation.index', ['acno'=>$acno]) }}" class="btn btn-primary" >Go Back</a>
    </div>

    <div class="table-management-rapidValidations relative overflow-x-auto sm:rounded-lg shadow-lg">
        <table class="w-full text-left text-sm text-gray-500">
            <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Rapid Validation Date
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
                        <span class="sr-only">Action</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rapidValidationTrashedRecord as $rapidValidationTrashedRecords) 
                    <tr class="border-b bg-white">
                        <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                            {{ \Carbon\Carbon::parse($rapidValidationTrashedRecords->dteassign)->format('m/d/Y H:i:s.v') ?? 'No Record' }} 
                        </td>

                        <td class="px-6 py-3">
                            {{ \Carbon\Carbon::parse($rapidValidationTrashedRecords->dtesubmit)->format('m/d/Y H:i:s.v') ?? 'No Record' }} 
                        </td>

                        <td class="px-6 py-3">
                            {{ $rapidValidationTrashedRecords->validator ?? 'No Record' }} 
                        </td>

                        <td class="px-6 py-3">
                            {{ $rapidValidationTrashedRecords->recom ?? 'No Record' }} 
                        </td>

                        <td class="px-6 py-3">
                            {{ $rapidValidationTrashedRecords->remarks ?? 'No Record' }} 
                        </td>

                        <td class="px-6 py-4 text-right uppercase">
                            <div class="flex">
                                <form action="{{ route('eris-rapid-validation.restore', ['ctrlno'=>$rapidValidationTrashedRecords->ctrlno]) }}" method="POST" id="restore_rapid_validation_form{{$rapidValidationTrashedRecords->ctrlno}}">
                                    @csrf
                                    <button type="button" id="restoreRapidValidationButton{{$rapidValidationTrashedRecords->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Restoration', 'Are you sure you want to restore this info?')">
                                        <lord-icon
                                            src="https://cdn.lordicon.com/nxooksci.json"
                                            trigger="hover"
                                            colors="primary:#121331"
                                            style="width:24px;height:24px">
                                        </lord-icon>
                                    </button>
                                </form>
    
                                <form action="{{ route('eris-rapid-validation.forceDelete', ['ctrlno'=>$rapidValidationTrashedRecords->ctrlno]) }}" method="POST" id="permanent_rapid_validation_form{{$rapidValidationTrashedRecords->ctrlno}}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" id="permanentRapidValidationButton{{$rapidValidationTrashedRecords->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Permanent Deletion', 'Are you sure you want to permanently delete this info?')">
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
        {{ $rapidValidationTrashedRecord->links() }}
    </div>

@endsection