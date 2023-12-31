@extends('layouts.app')
@section('title', 'Research and Studies Recyle Bin')
@section('sub', 'Research and Studies Recyle Bin')
@section('content')
@include('admin.201_profiling.view_profile.header', ['cesno' => $cesno])

<div class="flex justify-end">
    <a href="{{ route('research-studies.index', ['cesno' => $cesno]) }}" class="btn btn-primary mb-7" >Go back</a>
</div>

<div class="table-research-and-studies relative overflow-x-auto sm:rounded-lg shadow-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Research Title
                </th>

                <th scope="col" class="px-6 py-3">
                    Publisher
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
            @foreach ($researchAndStudiesTrashedRecord as $researchAndStudiesTrashedRecords)
                <tr class="border-b bg-white">
                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        {{ $researchAndStudiesTrashedRecords->title  }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $researchAndStudiesTrashedRecords->sponsor }}
                    </td>

                    <td class="px-6 py-3">
                        {{     
                            \Carbon\Carbon::parse($researchAndStudiesTrashedRecords->from_dt)->format('m/d/Y')." - ".
                            \Carbon\Carbon::parse($researchAndStudiesTrashedRecords->to_dt)->format('m/d/Y') ?? 'No Record'
                        }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $researchAndStudiesTrashedRecords->deleted_at }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex">
                            <form action="{{ route('research-studies.restore', ['ctrlno'=>$researchAndStudiesTrashedRecords->ctrlno, 'cesno'=>$cesno]) }}" method="POST" id="restore_research_studies_form{{$researchAndStudiesTrashedRecords->ctrlno}}">
                                @csrf
                                <button type="button" id="restoreResearchAndStudiesButton{{$researchAndStudiesTrashedRecords->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Restoration', 'Are you sure you want to restore this info?')">
                                    <lord-icon
                                        src="https://cdn.lordicon.com/nxooksci.json"
                                        trigger="hover"
                                        colors="primary:#121331"
                                        style="width:24px;height:24px">
                                    </lord-icon>
                                </button>
                            </form>

                            <form action="{{ route('research-studies.forceDelete', ['ctrlno'=>$researchAndStudiesTrashedRecords->ctrlno]) }}" method="POST" id="permanent_delete_research_studies_form{{$researchAndStudiesTrashedRecords->ctrlno}}">
                                @csrf
                                @method('DELETE')
                                <button type="button" id="permanentDeleteResearchAndStudiesButton{{$researchAndStudiesTrashedRecords->ctrlno}}" onclick="openConfirmationDialog(this, 'Confirm Permanent Deletion', 'Are you sure you want to permanently delete this info?')">
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