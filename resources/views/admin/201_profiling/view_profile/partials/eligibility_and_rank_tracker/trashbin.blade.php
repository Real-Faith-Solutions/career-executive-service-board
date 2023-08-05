@extends('layouts.app')
@section('title', 'Eligibility and Rank Tracker Recycle Bin')
@section('sub', 'Eligibility and Rank Tracker Recycle Bin')
@section('content')
@include('admin.201_profiling.view_profile.header', ['cesno' => $cesno])

<div class="flex justify-end mb-7">
    <a href="{{ route('eligibility-rank-tracker.index', ['cesno'=>$cesno]) }}" class="btn btn-primary" >Go back</a>
</div>

<div class="table-eligibility-and-rank-tracker">
    <div class="relative overflow-x-auto sm:rounded-lg shadow-lg mb-3">
        <table class="w-full text-left text-sm text-gray-500">
            <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Control No
                    </th>

                    <th scope="col" class="px-6 py-3">
                        CES Status
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Acquired Thru
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Status Type
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Appointing Authority
                    
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Resolution No.
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Date Acquired
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Deleted At
                    </th>

                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Action</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($profileTblCesStatusTrashedRecord as $profileTblCesStatusTrashedRecords)
                    <tr class="border-b bg-white">
                        <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                            {{$profileTblCesStatusTrashedRecords->ctrlno}}
                        </td>

                        <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                            {{$profileTblCesStatusTrashedRecords->profileLibTblCesStatus->description}}
                        </td>
                        
                        <td class="px-6 py-3">
                            {{$profileTblCesStatusTrashedRecords->profileLibTblCesStatusAcc->description}}
                        </td>

                        <td class="px-6 py-3">
                            {{$profileTblCesStatusTrashedRecords->profileLibTblCesStatusType->description}}
                        </td>

                        <td class="px-6 py-3">
                            {{$profileTblCesStatusTrashedRecords->profileLibTblAppAuthority->description}}
                        </td>

                        <td class="px-6 py-3">
                            {{$profileTblCesStatusTrashedRecords->resolution_no}}
                        </td>

                        <td class="px-6 py-3">
                            {{$profileTblCesStatusTrashedRecords->appointed_dt}}
                        </td> 

                        <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                            {{$profileTblCesStatusTrashedRecords->deleted_at}}
                        </td>
               
                       <td class="px-6 py-4 text-right uppercase">
                            <div class="flex">
                                <form action="{{ route('eligibility-rank-tracker.restore', ['ctrlno'=>$profileTblCesStatusTrashedRecords->ctrlno]) }}" method="POST">
                                    @csrf
                                    <button class="mx-1 font-medium text-blue-600 hover:underline" type="submit">
                                        <lord-icon
                                            src="https://cdn.lordicon.com/nxooksci.json"
                                            trigger="hover"
                                            colors="primary:#121331"
                                            style="width:24px;height:24px">
                                        </lord-icon>
                                    </button>
                                </form>
                                    
                                <form action="{{ route('eligibility-rank-tracker.forceDelete', ['ctrlno'=>$profileTblCesStatusTrashedRecords->ctrlno]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="mx-1 font-medium text-red-600 hover:underline" type="submit">
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
</div>

@endsection