@extends('layouts.app')
@section('title', 'Field Expertise')
@section('sub', 'Field Expertise Recycle Bin')
@section('content')
@include('admin.201_profiling.view_profile.header', ['cesno' => $cesno])

<div class="my-5 flex justify-end">
    <a href="{{ route('expertise.index', ['cesno' => $cesno]) }}" class="btn btn-primary" >Go Back</a>
</div>

<div class="taw-x-auto sm:rounded-lg shadow-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Control No
                </th>

                <th scope="col" class="px-6 py-3">
                    Expertise / Field of Specialization
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
            @foreach ($profileTblExpertiseTrashedRecord as $profileTblExpertiseTrashedRecords)
                <tr class="border-b bg-white">
                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        {{ $profileTblExpertiseTrashedRecords->ctrlno}}
                    </td>

                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        {{ $profileTblExpertiseTrashedRecords->expertisePersonalData->Title}}
                    </td>

                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        {{ $profileTblExpertiseTrashedRecords->deleted_at}}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex">
                            <form action="{{ route('expertise.restore', ['ctrlno'=>$profileTblExpertiseTrashedRecords->ctrlno]) }}" method="POST" id="restore_expertise_form{{$profileTblExpertiseTrashedRecords->ctrlno}}">
                                @csrf
                                <button type="button" id="restoreExpertiseButton{{$profileTblExpertiseTrashedRecords->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Restoration', 'Are you sure you want to restore this info?')">
                                    <lord-icon
                                        src="https://cdn.lordicon.com/nxooksci.json"
                                        trigger="hover"
                                        colors="primary:#121331"
                                        style="width:24px;height:24px">
                                    </lord-icon>
                                </button>
                            </form>
                        
                            <form action="{{ route('expertise.forceDelete', ['ctrlno'=>$profileTblExpertiseTrashedRecords->ctrlno]) }}" method="POST" id="permanent_expertise_form{{$profileTblExpertiseTrashedRecords->ctrlno}}">
                                @csrf
                                @method('DELETE')
                                <button type="button" id="permanentDeleteExpertiseButton{{$profileTblExpertiseTrashedRecords->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Permanent Deletion', 'Are you sure you want to permanently delete this info?')">
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

@endsection