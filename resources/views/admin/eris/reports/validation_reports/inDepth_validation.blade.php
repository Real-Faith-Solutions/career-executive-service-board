@extends('layouts.app')
@section('title', 'Rapid Validation')
@section('content')

    <h1 class="uppercase font-semibold text-blue-600 text-lg">In Depth Validation</h1>

    <div class="my-5 flex justify-between">
        <div class="flex items-center">
            <form action="{{ route('validation-report.displayValidation') }}" method="GET">
                <div class="flex gap-2">
                    <select name="validation" id="expertise">
                        <option value="">Rapid Validation</option>
                        <option value="In Depth Validation" {{ $validation == 'In Depth Validation' ? 'selected' : '' }}>In Depth Validation</option>
                    </select>   

                    <button class="btn btn-primary mx-1 font-medium text-blue-600" type="submit">
                        Search
                    </button>
                </div>
            </form>
        </div>

        <div class="flex items-center">
            <form action="{{ route('validation-report.generatePdfReport') }}" target="_blank" method="POST">
                @csrf

                <input type="text" name="validation-type" value="{{ $validation }}" hidden>

                <button class="btn btn-primary mx-1 font-medium text-blue-600" type="submit">
                    Generate PDF Report
                </button>
            </form>
        </div>
    </div>

    <div class="table-management-data relative overflow-x-auto sm:rounded-lg shadow-lg">
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
                </tr>
            </thead>
            <tbody>
                {{-- board interview --}}
                @foreach ($inDepthValidation as $data) 
                    <tr class="border-b bg-white">
                        <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                            {{ \Carbon\Carbon::parse($data->dteassign)->format('m/d/Y') ?? 'No Record' }} 
                        </td>

                        <td class="px-6 py-3">
                            {{ \Carbon\Carbon::parse($data->dtesubmit)->format('m/d/Y') ?? 'No Record' }} 
                        </td>

                        <td class="px-6 py-3">
                            {{ $data->validator ?? 'No Record' }} 
                        </td>

                        <td class="px-6 py-3">
                            {{ $data->recom ?? 'No Record' }} 
                        </td>

                        <td class="px-6 py-3">
                            {{ $data->remarks ?? 'No Record' }} 
                        </td>

                        <td class="px-6 py-3">
                            {{ \Carbon\Carbon::parse($data->dtedefer)->format('m/d/Y') ?? 'No Record' }} 
                        </td>
                    </tr>
                @endforeach
                {{-- end of board interview --}}
            </tbody>
        </table>
    </div>

    <div class="m-5">
        {{ $inDepthValidation->links() }}
    </div>
@endsection