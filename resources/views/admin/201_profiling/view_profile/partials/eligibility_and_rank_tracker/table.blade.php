@extends('layouts.app')
@section('title', 'Eligibility and Rank Tracker')
@section('sub', 'Eligibility and Rank Tracker')
@section('content')
@include('admin.201_profiling.view_profile.header', ['cesno' => $cesno])

<div class="my-5 flex justify-end">
    <a href="{{ route('eligibility-rank-tracker.recentlyDeleted', ['cesno'=>$cesno]) }}">
        <lord-icon
            src="https://cdn.lordicon.com/jmkrnisz.json"
            trigger="hover"
            colors="primary:#DC3545"
            style="width:34px;height:34px">
      </lord-icon>
    </a>

    <a href="{{ route('eligibility-rank-tracker.create', ['cesno'=>$cesno]) }}" class="btn btn-primary" >Add Eligibility and Rank Tracker</a>
</div>

<div class="table-eligibility-and-rank-tracker">    
    <h1 class="mx-2 text-blue-500 text-bold">CES Status</h1>
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
                        <span class="sr-only">Action</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($profileTblCesStatus as $profileTblCesStatuses)
                    <tr class="border-b bg-white">
                        <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                            {{$profileTblCesStatuses->profileLibTblCesStatus->description}}
                        </td>
                        
                        <td class="px-6 py-3">
                            {{$profileTblCesStatuses->profileLibTblCesStatusAcc->description}}
                        </td>

                        <td class="px-6 py-3">
                            {{$profileTblCesStatuses->profileLibTblCesStatusType->description}}
                        </td>

                        <td class="px-6 py-3">
                            {{$profileTblCesStatuses->profileLibTblAppAuthority->description}}
                        </td>

                        <td class="px-6 py-3">
                            {{$profileTblCesStatuses->resolution_no}}
                        </td>

                        <td class="px-6 py-3">
                            {{$profileTblCesStatuses->appointed_dt}}
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
                                    
                                <form action="{{ route('eligibility-rank-tracker.destroy', ['ctrlno'=>$profileTblCesStatuses->ctrlno]) }}" method="POST">
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

<div class="table-eligibility-and-rank-tracker-2">
    <h1 class="mx-2 text-blue-500 text-bold">Assessment Center (Historical Record)</h1>
    <div class="relative overflow-x-auto sm:rounded-lg shadow-lg mb-3">

        <table class="w-full text-left text-sm text-gray-500">

            <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        AC No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Assessment Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Rating
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Competencies for D.O.
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Action</span>
                    </th>
                </tr>
            </thead>
            <tbody>

                <tr class="border-b bg-white">
                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        -
                    </td>
                    <td class="px-6 py-3">
                        -
                    </td>
                    <td class="px-6 py-3">
                        -
                    </td>
                    <td class="px-6 py-3">
                        -
                    </td>

                    {{-- <td class="px-6 py-4 text-right uppercase">
                        <a href="#" class="mx-1 font-medium text-blue-600 hover:underline">Update</a>
                        <a href="#" class="mx-1 font-medium text-red-600 hover:underline">Delete</a>
                    </td> --}}
                </tr>

            </tbody>
        </table>
    </div>
</div>

<div class="table-eligibility-and-rank-tracker-3">
    <h1 class="mx-2 text-blue-500 text-bold">Validation (Historical Record)</h1>
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

                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Action</span>
                    </th>
                </tr>
            </thead>
            <tbody>

                <tr class="border-b bg-white">
                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        -
                    </td>
                    <td class="px-6 py-3">
                        -
                    </td>
                    <td class="px-6 py-3">
                        -
                    </td>

                    {{-- <td class="px-6 py-4 text-right uppercase">
                        <a href="#" class="mx-1 font-medium text-blue-600 hover:underline">Update</a>
                        <a href="#" class="mx-1 font-medium text-red-600 hover:underline">Delete</a>
                    </td> --}}
                </tr>

            </tbody>
        </table>
    </div>
</div>

<div class="table-eligibility-and-rank-tracker-4">
    <h1 class="mx-2 text-blue-500 text-bold">Board Interview</h1>
    <div class="relative overflow-x-auto sm:rounded-lg shadow-lg mb-3">

        <table class="w-full text-left text-sm text-gray-500">

            <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Board Interview Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Rating
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Action</span>
                    </th>
                </tr>
            </thead>
            <tbody>

                <tr class="border-b bg-white">
                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        -
                    </td>
                    <td class="px-6 py-3">
                        -
                    </td>

                    {{-- <td class="px-6 py-4 text-right uppercase">
                        <a href="#" class="mx-1 font-medium text-blue-600 hover:underline">Update</a>
                        <a href="#" class="mx-1 font-medium text-red-600 hover:underline">Delete</a>
                    </td> --}}
                </tr>

            </tbody>
        </table>
    </div>
</div>

@endsection