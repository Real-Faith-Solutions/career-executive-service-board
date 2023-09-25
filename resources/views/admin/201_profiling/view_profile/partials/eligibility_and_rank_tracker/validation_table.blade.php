@extends('layouts.app')
@section('title', 'Validation (Historical Record)')
@section('sub', 'Validation (Historical Record)')
@section('content')
@include('admin.201_profiling.view_profile.header', ['cesno' => $cesno])

<div class="my-5 flex justify-between">
    <div class="flex">
        <form action="{{ route('eligibility-rank-tracker.navigate', ['cesno'=>$cesno]) }}" method="GET">
            <div class="grid grid-cols-2 justify-center item-center gap-3 w-full">
                <div>
                    <select class="w-66" name="page" id="">
                        <option>Eligibility and Rank Tracker</option>
                        <option value="Written Exam">Written Exam (Historical Record)</option>
                        <option value="Assessment Center">Assessment Center (Historical Record)</option>
                        <option value="Validation" {{ $selectedPage == 'Validation' ? 'selected' : '' }}>Validation (Historical Record)</option>
                        <option value="Board Interview">Board Interview</option>
                    </select>    
                </div>
    
                <div>   
                    <button class="h-11 btn btn-primary" type="submit">Search</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="table-eligibility-and-rank-tracker">    
    <div class="relative overflow-x-auto sm:rounded-lg shadow-lg mb-3">
        <table class="w-full text-left text-sm text-gray-500">
            <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Validation Date
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Type of Validation
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Result
                    </th>
                </tr>
            </thead>
            <tbody>
                {{-- rapid validation table row --}}
                    @foreach ($rapidValidation as $rapidValidations)
                        <tr class="border-b bg-white">
                            <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                                {{ $rapidValidations->dteassign.' - '.$rapidValidations->dtesubmit }}
                            </td>
                                
                            <td class="px-6 py-3">
                                Rapid Validation
                            </td>

                            <td class="px-6 py-3">
                                {{ $rapidValidations->remarks }}
                            </td>
                    @endforeach               
                {{-- end of rapid validation table row --}}

                {{-- in depth validation table row --}}
                    @foreach ($inDepthValidation as $inDepthValidations)
                    <tr class="border-b bg-white">
                        <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                            {{ $inDepthValidations->dteassign.' - '.$inDepthValidations->dtesubmit }}
                        </td>
                        
                        <td class="px-6 py-3">
                            In Depth Validation
                        </td>

                        <td class="px-6 py-3">
                            {{$inDepthValidations->remarks}}
                        </td>
                    @endforeach               
                {{-- end of in depth validation table row --}}
            </tbody>
        </table>
    </div>
</div>

@endsection
