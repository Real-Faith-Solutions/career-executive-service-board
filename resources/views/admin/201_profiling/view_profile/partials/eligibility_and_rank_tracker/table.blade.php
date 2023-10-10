@extends('layouts.app')
@section('title', 'Eligibility and Rank Tracker')
@section('sub', 'Eligibility and Rank Tracker')
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
                        <option value="Validation">Validation (Historical Record)</option>
                        <option value="Board Interview">Board Interview</option>
                    </select>    
                </div>
    
                <div>   
                    <button class="h-11 btn btn-primary" type="submit">Go</button>
                </div>
            </div>
        </form>
    </div>

    <div class="flex">
        <a href="{{ route('eligibility-rank-tracker.recentlyDeleted', ['cesno'=>$cesno]) }}">
            <lord-icon
                src="https://cdn.lordicon.com/jmkrnisz.json"
                trigger="hover"
                colors="primary:#DC3545"
                style="width:34px;height:34px">
          </lord-icon>
        </a>
    
        <div class="flex items-center">
            <a href="{{ route('eligibility-rank-tracker.create', ['cesno'=>$cesno]) }}" class="btn btn-primary" >Add Eligibility and Rank Tracker</a>
        </div>
    </div>
</div>

<div class="table-eligibility-and-rank-tracker">    
    <div class="relative overflow-x-auto sm:rounded-lg shadow-lg mb-3">
        <table class="w-full text-left text-sm text-gray-500">
            <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
                <tr>
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
                        <span class="sr-only">Action</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($profileTblCesStatus as $profileTblCesStatuses)
                    <tr class="border-b bg-white">
                        <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                            {{ $profileTblCesStatuses->profileLibTblCesStatus->description ?? 'No Record' }}
                        </td>
                        
                        <td class="px-6 py-3">
                            {{ $profileTblCesStatuses->profileLibTblCesStatusAcc->description ?? 'No Record' }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $profileTblCesStatuses->profileLibTblCesStatusType->description ?? 'No Record' }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $profileTblCesStatuses->profileLibTblAppAuthority->description ?? 'No Record'  }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $profileTblCesStatuses->resolution_no ?? 'No Record' }}
                        </td>

                        <td class="px-6 py-3">
                            {{ \Carbon\Carbon::parse($profileTblCesStatuses->appointed_dt)->format('m/d/Y') ?? 'No Record' }}
                        </td> 
               
                       <td class="px-6 py-4 text-right uppercase">
                            <div class="flex">
                                <form action="{{ route('eligibility-rank-tracker.edit', ['ctrlno'=>$profileTblCesStatuses->ctrlno, 'cesno'=>$cesno]) }}" method="GET">
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
                                    
                                <form action="{{ route('eligibility-rank-tracker.destroy', ['ctrlno'=>$profileTblCesStatuses->ctrlno, 'cesno'=>$cesno]) }}" method="POST" id="delete_eligbility_rank_tracker_form{{$profileTblCesStatuses->ctrlno}}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" id="deleteExaminationsTakenButton{{$profileTblCesStatuses->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Deletion', 'Are you sure you want to delete this info?')">
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