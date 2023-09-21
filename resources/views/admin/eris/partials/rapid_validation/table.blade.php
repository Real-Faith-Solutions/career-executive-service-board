@extends('layouts.app')
@section('title', 'Rapid Validation')
@section('sub', 'Rapid Validation')
@section('content')
@include('admin.eris.header', ['acno'=>$acno])

    <div class="my-5 flex justify-end">
        <a href="">
            <lord-icon
                src="https://cdn.lordicon.com/jmkrnisz.json"
                trigger="hover"
                colors="primary:#DC3545"
                style="width:34px;height:34px">
            </lord-icon>
        </a>
        
        <a href="{{ route('eris-rapid-validation.create', ['acno'=>$acno]) }}" class="btn btn-primary" >Add New Rapid Validation</a>
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
                @foreach ($rapidValidation as $rapidValidations) 
                    <tr class="border-b bg-white">
                        <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                            {{ $rapidValidations->dteassign }} 
                        </td>

                        <td class="px-6 py-3">
                            {{ $rapidValidations->dtesubmit }} 
                        </td>

                        <td class="px-6 py-3">
                            {{ $rapidValidations->validator }} 
                        </td>

                        <td class="px-6 py-3">
                            {{ $rapidValidations->recom }} 
                        </td>

                        <td class="px-6 py-3">
                            {{ $rapidValidations->remarks }} 
                        </td>

                        <td class="px-6 py-4 text-right uppercase">
                            <div class="flex">
                                <form action="{{ route('eris-rapid-validation.edit', ['acno'=>$acno, 'ctrlno'=>$rapidValidations->ctrlno]) }}" method="GET">
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
                            
                                {{--  <form action="{{ route('eris-assessment-center.destroy', ['ctrlno'=>$rapidValidations->ctrlno]) }}" method="POST" id="delete_assessment_center_form{{$rapidValidations->ctrlno}}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" id="deleteAssessmentCenterButton{{$rapidValidations->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Deletion', 'Are you sure you want to delete this info?')">
                                        <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
                                        <lord-icon
                                            src="https://cdn.lordicon.com/jmkrnisz.json"
                                            trigger="hover"
                                            colors="primary:#880808"
                                            style="width:24px;height:24px">
                                        </lord-icon>
                                    </button>
                                </form>  --}}
                            </div>
                        </td>
                    </tr>
                @endforeach 
            </tbody>
        </table>
    </div>

    <div class="m-5">
        {{ $rapidValidation->links() }}
    </div>

@endsection