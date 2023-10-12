@extends('layouts.app')
@section('title', 'Participant List Grid')
@section('sub', 'Participant List Grid')
@section('content')
@include('admin.competency.view_profile.header')


<div class="my-5 flex justify-between">
    <h1 class="self-center text-2xl font-semibold whitespace-nowrap uppercase text-blue-400"><a href="{{ route('training-session.index') }}">{{ $trainingSession->title }}</a></h1>

    <a href="{{ route('training-session.addParticipant', ['sessionId'=>$sessionId]) }}" class="btn btn-primary" >Add Participant</a>
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
            @foreach ($trainingParticipantList as $trainingParticipantLists)
                <tr class="border-b bg-white">
                    <td scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900">
                        {{ $trainingParticipantLists->pid ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingParticipantLists->cesno ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-3">
                        {{ 
                            $trainingParticipantLists->cesTrainingPersonalData->lastname.', '.
                            $trainingParticipantLists->cesTrainingPersonalData->firstname.', '.
                            $trainingParticipantLists->cesTrainingPersonalData->name_extension.', '.
                            $trainingParticipantLists->cesTrainingPersonalData->middleinitial ?? 'No Record'
                        }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingParticipantLists->cesTrainingPersonalData->cesStatus->description ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingParticipantLists->status ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingParticipantLists->no_hours ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingParticipantLists->payment ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $trainingParticipantLists->remarks ?? 'No Record' }}
                    </td>

                    <td class="px-6 py-4 text-right uppercase">
                        <div class="flex">
                            <form action="{{ route('training-session.editParticipant', ['pid'=>$trainingParticipantLists->pid, 'sessionId'=>$sessionId]) }}" method="GET">
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
                            
                            <form action="{{ route('training-participant.destroy', ['pid'=>$trainingParticipantLists->pid]) }}" method="POST" id="delete_training_participant_form{{$trainingParticipantLists->pid}}">
                                @csrf
                                @method('DELETE')
                                <button type="button" id="deleteTrainingParticipantButton{{$trainingParticipantLists->pid}}" onclick="openConfirmationDialog(this, 'Confirm Deletion', 'Are you sure you want to delete this info?')">
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
    {{ $trainingParticipantList->links() }}
</div>

@endsection