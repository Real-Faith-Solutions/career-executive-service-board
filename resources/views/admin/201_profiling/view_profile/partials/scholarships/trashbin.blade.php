@extends('layouts.app')
@section('title', 'Scholarship Taken Recycle Bin')
@section('sub', 'Scholarship Taken Recycle Bin')
@section('content')
@include('admin.201_profiling.view_profile.header', ['cesno' => $cesno])

<div class="flex justify-end mb-7">
    <a href="{{ route('scholarship.index', ['cesno'=>$cesno]) }}" class="btn btn-primary">Go back</a>
</div>

<div class="table-scholarship relative overflow-x-auto sm:rounded-lg shadow-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Control No
                </th>

                <th scope="col" class="px-6 py-3">
                    Scholarship Type
                </th>

                <th scope="col" class="px-6 py-3">
                    Title
                </th>

                <th scope="col" class="px-6 py-3">
                    Sponsor
                </th>

                <th scope="col" class="px-6 py-3">
                    Inclusive Dates
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

            @foreach ($scholarshipTrashedRecord as $scholarshipTrashedRecords)
                <tr class="border-b bg-white">
                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        {{ $scholarshipTrashedRecords->ctrlno }}
                    </td>

                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        {{ $scholarshipTrashedRecords->type }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $scholarshipTrashedRecords->title }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $scholarshipTrashedRecords->sponsor }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $scholarshipTrashedRecords->inclusive_date_from." - ".$scholarshipTrashedRecords->inclusive_date_to }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $scholarshipTrashedRecords->deleted_at }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex">
                            <form action="{{ route('scholarship.restore', ['ctrlno'=>$scholarshipTrashedRecords->ctrlno]) }}" method="POST" id="restore_scholarships_form{{$scholarshipTrashedRecords->ctrlno}}">
                                @csrf
                                <button type="button" id="restoreScholarshipTakenButton{{$scholarshipTrashedRecords->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Restoration', 'Are you sure you want to restore this info?')">
                                    <lord-icon
                                        src="https://cdn.lordicon.com/nxooksci.json"
                                        trigger="hover"
                                        colors="primary:#121331"
                                        style="width:24px;height:24px">
                                    </lord-icon>
                                </button>
                            </form>
                        
                            <form action="{{ route('scholarship.forceDelete', ['ctrlno'=>$scholarshipTrashedRecords->ctrlno]) }}" method="POST" id="permanent_delete_scholarships_form{{$scholarshipTrashedRecords->ctrlno}}">
                                @csrf
                                @method('DELETE')
                                <button type="button" id="permanentDeleteScholarshipsTakenButton{{$scholarshipTrashedRecords->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Permanent Deletion', 'Are you sure you want to permanently delete this info?')">
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