@extends('layouts.app')
@section('title', 'CES Training')
@section('sub', 'CES Training Recycle Bin ')
@section('content')
@include('admin.competency.view_profile.header')

<div class="my-5 flex justify-end">
    <a href="{{ route('ces-training.index', ['cesno'=>$cesno]) }}" class="btn btn-primary" >Go Back</a>
</div>

<div class="table-management-training relative overflow-x-auto sm:rounded-lg shadow-lg">
    <table class="w-full text-left text-sm text-gray-500">
        <thead class="bg-blue-500 text-xs uppercase text-gray-700 text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Participants ID
                </th>

                <th scope="col" class="px-6 py-3">
                    CESNO
                </th>

                <th scope="col" class="px-6 py-3">
                    Name
                </th>

                <th scope="col" class="px-6 py-3">
                    CES Status
                </th>

                <th scope="col" class="px-6 py-3">
                    Session Id
                </th>

                <th scope="col" class="px-6 py-3">
                    Session Name
                </th>

                <th scope="col" class="px-6 py-3">
                    Training Status
                </th>

                <th scope="col" class="px-6 py-3">
                    No. of Training Hours
                </th>

                <th scope="col" class="px-6 py-3">
                    Payment Status
                </th>

                <th scope="col" class="px-6 py-3">
                    Remarks
                </th>

                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($competencyCesTrainingTrashedRecord as $competencyCesTrainingTrashedRecords)
                <tr class="border-b bg-white">
                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        {{ $competencyCesTrainingTrashedRecords->pid }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $competencyCesTrainingTrashedRecords->cesno }}
                    </td>

                    <td class="px-6 py-3">
                        {{ 
                            $competencyCesTrainingTrashedRecords->cesTrainingPersonalData->lastname.', '.$competencyCesTrainingTrashedRecords->cesTrainingPersonalData->firstname.', '.$competencyCesTrainingTrashedRecords->cesTrainingPersonalData->name_extension.', '.$competencyCesTrainingTrashedRecords->cesTrainingPersonalData->middleinitial 
                        }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $description }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $competencyCesTrainingTrashedRecords->sessionid }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $competencyCesTrainingTrashedRecords->participantTrainingSession->title }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $competencyCesTrainingTrashedRecords->status }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $competencyCesTrainingTrashedRecords->no_hours }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $competencyCesTrainingTrashedRecords->payment }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $competencyCesTrainingTrashedRecords->remarks }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex">
                            <form action="{{ route('ces-training.restore', ['ctrlno'=>$competencyCesTrainingTrashedRecords->pid]) }}" method="POST" id="restore_training_participant_form{{$competencyCesTrainingTrashedRecords->pid}}">
                                @csrf
                                <button type="button" id="restoreTrainingParticipantButton{{$competencyCesTrainingTrashedRecords->pid}}" onclick="openConfirmationDialog(this, 'Confirm Restoration', 'Are you sure you want to restore this info?')">
                                    <lord-icon
                                        src="https://cdn.lordicon.com/nxooksci.json"
                                        trigger="hover"
                                        colors="primary:#121331"
                                        style="width:24px;height:24px">
                                    </lord-icon>
                                </button>
                            </form>

                            <form action="{{ route('ces-training.forceDelete', ['ctrlno'=>$competencyCesTrainingTrashedRecords->pid]) }}" method="POST" id="permament_training_participant_form{{$competencyCesTrainingTrashedRecords->pid}}">
                                @csrf
                                @method('DELETE')
                                <button type="button" id="permanentDeleteTrainingParticipantButton{{$competencyCesTrainingTrashedRecords->pid}}" onclick="openConfirmationDialog(this, 'Confirm Permanent Deletion', 'Are you sure you want to permanently delete this info?')">
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