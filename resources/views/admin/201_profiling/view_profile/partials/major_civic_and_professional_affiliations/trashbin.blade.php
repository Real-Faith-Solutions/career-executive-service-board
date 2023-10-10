@extends('layouts.app')
@section('title', 'Affiliation Recycle Bin')
@section('sub', 'Affiliation Recycle Bin')
@section('content')
@include('admin.201_profiling.view_profile.header', ['cesno' => $cesno])

<div class="flex justify-end mb-7">
    <a href="{{ route('affiliation.index', ['cesno'=>$cesno]) }}" class="btn btn-primary" >Go back</a>
</div>

<div class="table-major-civic-and-professional-affiliations relative overflow-x-auto sm:rounded-lg shadow-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Organization
                </th>

                <th scope="col" class="px-6 py-3">
                    Position
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
            @foreach ($affiliationsTrashedRecord as $affiliationsTrashedRecords)
                <tr class="border-b bg-white">
                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        {{ $affiliationsTrashedRecords->organization ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $affiliationsTrashedRecords->position ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $affiliationsTrashedRecords->from_dt." - ".$affiliationsTrashedRecords->to_dt ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $affiliationsTrashedRecords->deleted_at ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex">
                            <form action="{{ route('affiliation.restore', ['ctrlno'=>$affiliationsTrashedRecords->ctrlno]) }}" method="POST" id="restore_affiliation_form{{$affiliationsTrashedRecords->ctrlno}}">
                                @csrf
                                <button type="button" id="restoreAffiliationButton{{$affiliationsTrashedRecords->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Restoration', 'Are you sure you want to restore this info?')">
                                    <lord-icon
                                        src="https://cdn.lordicon.com/nxooksci.json"
                                        trigger="hover"
                                        colors="primary:#121331"
                                        style="width:24px;height:24px">
                                    </lord-icon>
                                </button>
                            </form>

                            <form action="{{ route('affiliation.forceDelete', ['ctrlno'=>$affiliationsTrashedRecords->ctrlno]) }}" method="POST" id="permanent_affiliation__form{{$affiliationsTrashedRecords->ctrlno}}">
                                @csrf
                                @method('DELETE')
                                <button type="button" id="permanentDeleteAffiliationButton{{$affiliationsTrashedRecords->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Permanent Deletion', 'Are you sure you want to permanently delete this info?')">
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

<div class="my-5">
    {{ $affiliationsTrashedRecord->links() }}
</div>

@endsection