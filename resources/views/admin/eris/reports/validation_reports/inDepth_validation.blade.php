@extends('layouts.app')
@section('title', 'Rapid Validation')
@section('content')

    <div class="flex justify-between">
        <h1 class="uppercase font-semibold text-blue-600 text-lg">In Depth Validation</h1>

        <div class="flex items-center">
            <form action="" target="_blank" method="POST">
                @csrf

                {{-- <input type="text" name="validation-type" value="{{ $validation }}" hidden> --}}

                <button class="btn btn-primary mx-1 font-medium text-blue-600" type="submit">
                    Generate PDF Report
                </button>
            </form>
        </div>
    </div>

    <div class="my-5 flex justify-between">
        <div class="flex items-center">
            <input type="text" name="startDate" value="Rapid Validation"> 
            <a href="{{ route('validation-report.index') }}" class="btn btn-primary mx-1 font-medium text-blue-600">Go</a>
        </div>        

        <div class="flex items-center">
            <form action="" method="GET">
                @csrf
                <div class="flex gap-3">
                    <label for="startDate">Start Date</label>
                    <input type="date" name="startDate" value="{{ $startDate }}">

                    <label for="endDate">End Date</label>
                    <input type="date" name="endDate" value="{{ $endDate }}">

                    <button class="btn btn-primary mx-1 font-medium text-blue-600" type="submit">
                        Filter
                    </button>
                </div>
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