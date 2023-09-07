@extends('layouts.app')
@section('title', 'Participant List Grid')
@section('sub', 'Participant List Grid Recycle Bin')
@section('content')
@include('admin.competency.view_profile.header')


<div class="my-5 flex justify-end">
    {{-- <h1 class="self-center text-2xl font-semibold whitespace-nowrap uppercase text-blue-400">{{ $trainingSession->title }}</h1> --}}

    <a href="{{ route('training-session.recentlyDeleted') }}" class="btn btn-primary" >Go Back</a>
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
            @foreach ($trainingParticipantTrashedRecord as $trainingParticipantTrashedRecords)
                <tr class="border-b bg-white">
                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        {{ $trainingParticipantTrashedRecords->pid }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingParticipantTrashedRecords->cesno }}
                    </td>

                    <td class="px-6 py-3">
                        {{ 
                            $trainingParticipantTrashedRecords->cesTrainingPersonalData->lastname.', '.$trainingParticipantTrashedRecords->cesTrainingPersonalData->firstname.', '.$trainingParticipantTrashedRecords->cesTrainingPersonalData->name_extension.', '.$trainingParticipantTrashedRecords->cesTrainingPersonalData->middleinitial 
                        }}
                    </td>

                    <td class="px-6 py-3">
                        {{-- {{ $training->specialization }} --}}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingParticipantTrashedRecords->participantTrainingSession->sessionid }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingParticipantTrashedRecords->participantTrainingSession->title }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingParticipantTrashedRecords->status }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingParticipantTrashedRecords->no_hours }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingParticipantTrashedRecords->payment }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingParticipantTrashedRecords->remarks }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex">                                
                            <form action="{{ route('training-participant.forceDeleteParticipantList', ['pid'=>$trainingParticipantTrashedRecords->pid]) }}" method="POST" id="delete_training_participant_list_form{{$trainingParticipantTrashedRecords->pid}}">
                                @csrf
                                @method('DELETE')
                                <button type="button" id="permanentDeleteTrainingParticipantListButton{{$trainingParticipantTrashedRecords->pid}}" onclick="openConfirmationDialog(this, 'Confirm Permanent Deletion', 'Are you sure you want to delete this info?')">
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