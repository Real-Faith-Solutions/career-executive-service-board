@extends('layouts.app')
@section('title', 'Resource Speaker Recycle Bin')
@section('sub', 'Resource Speaker Recycle Bin')
@section('content')
@include('admin.competency.view_profile.header')

<div class="my-5 flex justify-end">
    <a href="{{ route('resource-speaker.index') }}" class="btn btn-primary" >Go Back</a>
</div>

<div class="table-management-training relative overflow-x-auto sm:rounded-lg shadow-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Name
                </th>

                <th scope="col" class="px-6 py-3">
                    Position
                </th>

                <th scope="col" class="px-6 py-3">
                    Department
                </th>

                <th scope="col" class="px-6 py-3">
                    Office/Company
                </th>

                <th scope="col" class="px-6 py-3">
                    No./Building
                </th>

                <th scope="col" class="px-6 py-3">
                    Street
                </th>

                <th scope="col" class="px-6 py-3">
                    Barangay
                </th>

                <th scope="col" class="px-6 py-3">
                    City/Province
                </th>

                <th scope="col" class="px-6 py-3">
                    Contact No.
                </th>

                <th scope="col" class="px-6 py-3">
                    Email Address
                </th>

                <th scope="col" class="px-6 py-3">
                    Expertise
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
            @foreach ($resourceSpeakerTrashedRecord as $resourceSpeakerTrashedRecords)
                <tr class="border-b bg-white">
                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        {{ $resourceSpeakerTrashedRecords->lastname. " " .$resourceSpeakerTrashedRecords->firstname. " " .$resourceSpeakerTrashedRecords->mi  }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $resourceSpeakerTrashedRecords->Position }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $resourceSpeakerTrashedRecords->Department }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $resourceSpeakerTrashedRecords->Office }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $resourceSpeakerTrashedRecords->Bldg }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $resourceSpeakerTrashedRecords->Street }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $resourceSpeakerTrashedRecords->Brgy }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $resourceSpeakerTrashedRecords->City }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $resourceSpeakerTrashedRecords->contactno }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $resourceSpeakerTrashedRecords->emailadd }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $resourceSpeakerTrashedRecords->expertise }}
                    </td>

                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        {{ $resourceSpeakerTrashedRecords->deleted_at }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex">
                            <form action="{{ route('resource-speaker.restore', ['ctrlno'=>$resourceSpeakerTrashedRecords->speakerID]) }}" method="POST" id="restore_resoure_speaker_form{{$resourceSpeakerTrashedRecords->speakerID}}">
                                @csrf
                                <button type="button" id="restoreResourceSpeakerButton{{$resourceSpeakerTrashedRecords->speakerID}}" onclick="openConfirmationDialog(this, 'Confirm Restoration', 'Are you sure you want to restore this info?')">
                                    <lord-icon
                                        src="https://cdn.lordicon.com/nxooksci.json"
                                        trigger="hover"
                                        colors="primary:#121331"
                                        style="width:24px;height:24px">
                                    </lord-icon>
                                </button>
                            </form>

                            <form action="{{ route('resource-speaker.forceDelete', ['ctrlno'=>$resourceSpeakerTrashedRecords->speakerID]) }}" method="POST" id="permanent_resource_speaker_form{{$resourceSpeakerTrashedRecords->speakerID}}">
                                @csrf
                                @method('DELETE')
                                <button type="button" id="permanentResourceSpeakerButton{{$resourceSpeakerTrashedRecords->speakerID}}" onclick="openConfirmationDialog(this, 'Confirm Permanent Deletion', 'Are you sure you want to permanently delete this info?')">
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

<div class="m-5">
    {{ $resourceSpeakerTrashedRecord->links() }}
</div>

@endsection